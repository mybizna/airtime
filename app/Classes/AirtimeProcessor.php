<?php

namespace Modules\Airtime\Classes;

use Carbon\Carbon;
use Modules\Payment\Models\Transaction;
use Modules\Setup\Models\Currency;
use Modules\Setup\Models\Prefix;
use Modules\Setup\Models\Provider;

class AirtimeProcessor
{
    public function autoExtend()
    {
        $test = 1;
    }

    public function prepareContext($airtime)
    {
        $paymentProcessor = new PaymentProcessor();

        if (!$airtime->provider) {
            $this->savePhoneProvider($airtime);
        }

        $converter = Currency::where('code', 'KES')->first();

        $paymentDict = [
            "partner_id" => $airtime->partner_id,
            "app_name" => 'airtime',
            "model_name" => 'Airtime',
            "next_to" => 'user_airtime_list',
            "type" => 'purchase-airtime',
            "is_new" => 1,
            "description" => 'Purchase of Airtime worth ' . $airtime->amount . ' KES to ' . $airtime->phone,
            "quantity" => 1,
            "amount" => $airtime->amount / $converter->rate,
            "source_ident" => $airtime->id,
            "source_package_ident" => $airtime->provider_id,
            "items" => [],
        ];

        $context = $paymentProcessor->prepareContext($paymentDict);

        $context['title'] = 'Airtime Payment';
        $context['airtime'] = $airtime;

        // Save payment
        $airtime->payment()->associate($context['payment']);
        $airtime->save();

        return $context;
    }

    public function updateRecord($airtime, $payment)
    {
        $this->updateAirtime($airtime);
        $this->processAirtime($airtime, $payment);
    }

    public function updateAirtime($airtime)
    {
        $airtime->paid = true;
        $airtime->completed = true;
        $airtime->successful = true;
        $airtime->save();
    }

    public function savePhoneProvider($airtime)
    {
        $phone = $airtime->phone;

        $prefix = $this->getPrefixByPhone($phone);

        if (!$prefix) {
            $prefix = Prefix::where('prefix', '722')->first();
        }

        $airtime->prefix()->associate($prefix);
        $airtime->provider()->associate($prefix->provider);
        $airtime->save();
    }

    public function processAirtime($airtime, $payment = null)
    {
        $type = 'error';
        $responseMessage = '';
        $amount = $airtime->amount;
        $phone = $airtime->phone;
        $prefix = $this->getPrefixByPhone($airtime->phone);
        $phone = $this->getPhoneWithoutCode($airtime->phone);
        $provider = $this->getProviderById($prefix->provider_id);

        $context = $this->buyAirtime($phone, $amount, strtolower($provider->name));

        if ($context['status']) {
            $airtime->status = true;
            $airtime->save();

            if ($payment !== null) {
                $converter = Currency::where('code', 'KES')->first();

                Transaction::create([
                    "partner_id" => $payment->partner_id,
                    "from_partner_id" => $payment->partner_id,
                    "payment_id" => $payment->id,
                    "description" => 'Purchase Airtime to ' . $airtime->phone . ' worth ' . ($airtime->amount / $converter->rate),
                    "money_out" => $payment->amount,
                    "type" => 'airtime-purchase',
                    "source" => $payment->source,
                    "year" => Carbon::now()->year,
                    "month" => Carbon::now()->month,
                    "source_ident" => $payment->source_ident,
                ]);
            }

            $type = 'info';
            $responseMessage = $context['message'] . ' Airtime of ' . $airtime->amount . ' to ' . $airtime->phone . ' Processed successfully.';
        } else {
            $type = 'error';
            $responseMessage = 'Airtime purchase has failed. Contact Support for Assistance.';
        }

        return ['type' => $type, 'message' => $responseMessage];
    }

    public function buyAirtime($phone, $amount, $provider = '')
    {
        $airtel = new Airtel();
        $telkom = new Telkom();
        $africasTalking = new AfricasTalking();

        $airtelEnabled = config('global_preferences.airtime__airtel_enabled');
        $telkomEnabled = config('global_preferences.airtime__telkom_enabled');

        if ($provider === 'airtel' && $airtelEnabled) {
            return $airtel->buyAirtime($phone, $amount, false);
        }

        if ($provider === 'telkom' && $telkomEnabled) {
            return $telkom->buyAirtime($phone, $amount);
        }

        return $africasTalking->buyAirtime($phone, $amount);
    }

    public function getPrefixByPhone($phone)
    {
        $phoneStr = strval($phone);
        $lastNineChars = substr($phoneStr, -9);

        $prefixStr = substr($lastNineChars, 0, 3);

        return Prefix::where('prefix', $prefixStr)->first();
    }

    public function getProviderById($providerId)
    {
        return Provider::find($providerId);
    }

    public function getPhoneWithoutCode($phone)
    {
        $phoneStr = strval($phone);
        $lastNineChars = substr($phoneStr, -9);

        return '0' . strval($lastNineChars);
    }
}
