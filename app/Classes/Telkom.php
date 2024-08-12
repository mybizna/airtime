<?php

namespace Modules\Airtime\Classes;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class Telkom
{
    public function buyAirtime($phone, $amount)
    {
        $encryptedPassword = $this->generateKey();

        return $this->callTelkomViaCurl($phone, $amount, $encryptedPassword);
    }

    private function callTelkomViaCurl($phone, $amount, $encryptedPassword)
    {
        $telkomApiType = config('airtime.telkom_api_type');
        $telkomApiBase64Encode = config('airtime.telkom_api_base64_encode');
        $telkomApiUsername = config('airtime.telkom_api_username');
        $telkomAirtimePin = config('airtime.telkom_airtime_pin');
        $telkomAirtimeCode = config('airtime.telkom_airtime_code');
        $telkomAirtimeSourceMsisdn = config('airtime.telkom_airtime_sourceMsisdn');

        $accessToken = $this->getAccessToken();

        $telkomUrl = "https://$telkomApiType.telkom.co.ke/ejaze/v3/ejazeAtp";

        $airtimeDtl = [
            "loginId" => $telkomApiUsername,
            "pin" => $telkomAirtimePin,
            "code" => $telkomAirtimeCode,
            "sourceMsisdn" => $telkomAirtimeSourceMsisdn,
            "destMsisdn" => $phone,
            "amount" => $amount,
            "extrefnum" => $telkomAirtimeCode,
        ];

        $urlParams = ["airtimeRequest" => $airtimeDtl];

        $headers = [
            "Content-type" => "application/json",
            "Authorization" => "Bearer $accessToken",
        ];

        try {
            $response = Http::withHeaders($headers)->get($telkomUrl, $urlParams);

            if (!$response->successful()) {
                return [
                    'status' => false,
                    'message' => "Airtime purchase failed. Please try again later.",
                ];
            } else {
                return [
                    'status' => true,
                    'message' => "Airtime purchase successful.",
                ];
            }
        } catch (\Exception $e) {
            return [
                'status' => false,
                'message' => "Airtime purchase failed. Please try again later.",
            ];
        }
    }

    private function getAccessToken()
    {
        $telkomApiType = config('airtime.telkom_api_type');
        $telkomApiBase64Encode = config('airtime.telkom_api_base64_encode');

        $keyName = 'getAccessTokenTelkom';

        $accessToken = Cache::get($keyName);

        if ($accessToken) {
            return $accessToken;
        }

        $telkomUrl = "https://$telkomApiType.telkom.co.ke/token";

        $headers = [
            "Authorization" => 'Basic ' . $telkomApiBase64Encode,
        ];

        try {
            $response = Http::withHeaders($headers)->get($telkomUrl);

            if (!$response->successful()) {
                return false;
            }

            $jsonObj = $response->json();

            Cache::put($keyName, $jsonObj['access_token'], 3600);

            return $jsonObj['access_token'];
        } catch (\Exception $e) {
            return false;
        }
    }

    private function generateKey()
    {
        $telkomApiPassword = config('airtime.telkom_api_password');
        $certPath = Storage::path('airtime/classes/cert/php_telkom_kash.cer');

        $command = 'php ' . base_path('airtime/classes/rsa_encrypt_password.php') . ' --certpath="' . $certPath . '" --password="' . $telkomApiPassword . '"';
        $encryptedPassword = shell_exec($command);

        return $encryptedPassword;
    }
}
