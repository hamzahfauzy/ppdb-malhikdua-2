<?php

namespace App\Models;

class Fonnte
{

    private $send_url = 'https://fonnte.com/api/send_message.php';
    private $check_status = 'https://fonnte.com/api/status.php';

    public function send_text($phone,$message)
    {
        $data = [
            'phone' => $phone,
            'type' => 'text',
            'delay' => 2, // delay 2 detik (optional)
            'delay_req' => 2, // delay 2 detik setiap request (optional)
            'text' => $message
        ];

        $curl = curl_init();
        $token = getenv('FONNTE_TOKEN');

        curl_setopt($curl, CURLOPT_HTTPHEADER,
            array(
                "Authorization: $token",
            )
        );
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($curl, CURLOPT_URL, $this->send_url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        $result = curl_exec($curl);
        curl_close($curl);

        return json_decode($result, 1);
    }
}
