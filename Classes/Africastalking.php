<?php

namespace Modules\Airtime\Classes;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;

class Africastalking
{
    public function buyAirtime($phone, $amount)
    {
        // Set your app credentials
        $isLive = config('africastalking.airtime_is_live');
        $username = config('africastalking.africastalking_username');
        $apiKey = config('africastalking.africastalking_api_key');

        if (!$isLive) {
            return [
                'status' => false,
                'message' => "Airtime purchase is not live. Please enable AIRTIME_IS_LIVE in your configuration.",
            ];
        }

        // Initialize Africa's Talking API
        $response = Http::post('https://api.africastalking.com/version1/airtime/send', [
            'username' => $username,
            'recipients' => [[
                'phoneNumber' => '+254' . $phone,
                'amount' => $amount,
                'currencyCode' => 'KES',
            ]],
        ], [
            'apiKey' => $apiKey,
        ]);

        // Parse the response
        $responseData = $response->json();

        // Check if the response was successful
        if ($responseData['status'] === 'success') {
            return [
                'status' => true,
                'message' => $responseData['message'],
            ];
        } else {
            return [
                'status' => false,
                'message' => $responseData['errorMessage'],
            ];
        }
    }
}
