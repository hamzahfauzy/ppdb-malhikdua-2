<?php

namespace App\Models;

class WaBlast
{

    public static function send_text($to, $message)
    {
        try {
            $apiKey = env('WEBISNIS_API_KEY');
            $deviceId = env('WEBISNIS_DEVICE_ID');
            //code...
            $body = [
                'device_id' => $deviceId,
                'phone' => $to,
                'content' => $message
            ];
            
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://wa.webisnis.id/api/whatsapp/messages/send",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $body,
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Bearer '.$apiKey,
                ),
            ));

            $response = curl_exec($curl);

            Log::info($response);

            curl_close($curl);
            return $response;
        } catch (\Throwable $th) {
            //throw $th;
            return ['error' => $th->getMessage()];
        }
    }
    
    static function send($to, $message, $file_url = '')
    {
        try {
            $apiKey = env('WEBISNIS_API_KEY');
            $deviceId = env('WEBISNIS_DEVICE_ID');
            //code...
            $body = [
                'device_id' => $deviceId,
                'phone' => self::$to,
                'content' => $message,
                'type' => 'media',
                'media' => [
                    'name' => $file_url,
                    'url' => $file_url,
                ]
            ];
            
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://wa.webisnis.id/api/whatsapp/messages/send",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $body,
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Bearer '.$apiKey,
                ),
            ));

            $response = curl_exec($curl);

            Log::info($response);

            curl_close($curl);
            return $response;
        } catch (\Throwable $th) {
            //throw $th;
            return ['error' => $th->getMessage()];
        }
    }
}
