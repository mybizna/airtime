<?php

namespace Modules\Airtime\Classes;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;

class Airtel
{
    public function buyAirtime($phone, $amount, $direct = true)
    {
        if ($direct) {
            $this->buyAirtimeDirect($phone, $amount);
        } else {
            try {
                $secretKey = 'GIF@2022';
                $url = 'https://globalinternetfortunes.com/airtel';
                $params = [
                    'phone' => $phone,
                    'amount' => $amount,
                    'secret_key' => $secretKey,
                ];

                $response = Http::get($url, $params);
                $data = $response->json();

                if ($data['successful']) {
                    return [
                        'status' => true,
                        'message' => 'Airtel: Airtime purchase is successful',
                    ];
                }
            } catch (\Exception $e) {
                // Handle exception
            }
        }

        return [
            'status' => false,
            'message' => 'Airtel Airtime purchase has failed. Contact Support for Assistance.',
        ];
    }

    public function buyAirtimeDirect($phone, $amount)
    {
        // Read configurations
        $serverIp = config('airtel.airtel_server_ip');
        $serverPort = config('airtel.airtel_server_port');
        $requestGatewayCode = config('airtel.airtel_request_gateway_code');
        $requestGatewayType = config('airtel.airtel_request_gateway_type');
        $login = config('airtel.airtel_login');
        $password = config('airtel.airtel_password');
        $sourceType = config('airtel.airtel_source_type');
        $servicePort = config('airtel.airtel_service_port');

        // Prepare XML and header
        $airtelRequest = $this->prepareXml($phone, $amount);
        $airtelHeader = $this->prepareHeader($airtelRequest);

        // Prepare URL and query parameters
        $url = "https://$serverIp:$serverPort/pretups/C2SReceiver";
        $queryParams = [
            'REQUEST_GATEWAY_CODE' => $requestGatewayCode,
            'REQUEST_GATEWAY_TYPE' => $requestGatewayType,
            'LOGIN' => $login,
            'PASSWORD' => $password,
            'SOURCE_TYPE' => $sourceType,
            'SERVICE_PORT' => $servicePort,
        ];

        // Append query parameters to the URL
        $url .= '?' . http_build_query($queryParams);

        // Send request
        try {
            $response = Http::withHeaders($airtelHeader)->post($url, $airtelRequest);

            if (!$response->successful()) {
                // Handle unsuccessful response
            }
        } catch (\Exception $e) {
            // Handle exception
        }

        return true;
    }

    public function prepareHeader($airtelRequest)
    {
        $header = [
            'Content-type' => 'text/xml;charset="utf-8"',
            'Accept' => 'text/xml',
            'Cache-Control' => 'no-cache',
            'Pragma' => 'no-cache',
            'Content-length' => strlen($airtelRequest),
        ];

        return $header;
    }

    public function prepareXml($phone, $amount)
    {
        $airtelMsisdn = config('airtel.airtel_msisdn');
        $airtelPin = config('airtel.airtel_pin');

        $airtelRequest = "<?xml version=\"1.0\"?>\n";
        $airtelRequest .= "<COMMAND>\n";
        $airtelRequest .= "  <TYPE>EXRCTRFREQ</TYPE>\n";
        $airtelRequest .= "  <DATE></DATE>\n";
        $airtelRequest .= "  <EXTNWCODE>KE</EXTNWCODE>\n";
        $airtelRequest .= "  <MSISDN>" . $airtelMsisdn . "</MSISDN>\n";
        $airtelRequest .= "  <PIN>" . $airtelPin . "</PIN>\n";
        $airtelRequest .= "  <LOGINID></LOGINID>\n";
        $airtelRequest .= "  <PASSWORD></PASSWORD>\n";
        $airtelRequest .= "  <EXTCODE></EXTCODE>\n";
        $airtelRequest .= "  <EXTREFNUM></EXTREFNUM>\n";
        $airtelRequest .= "  <MSISDN2>" . $phone . "</MSISDN2>\n";
        $airtelRequest .= "  <AMOUNT>" . $amount . "</AMOUNT>\n";
        $airtelRequest .= "  <LANGUAGE1></LANGUAGE1>\n";
        $airtelRequest .= "  <LANGUAGE2></LANGUAGE2>\n";
        $airtelRequest .= "  <SELECTOR>1</SELECTOR>\n";
        $airtelRequest .= "</COMMAND>\n";

        return $airtelRequest;
    }

}
