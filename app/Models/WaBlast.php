<?php

namespace App\Models;

class WaBlast
{

    public static function send_text($to, $message)
    {
        $data = [
            'api_key' => 'b2d95af932eedb4de92b3496f338aa5f97b36ae0',
            'sender'  => '6285799200057',
            'number'  => $to,
            'message' => $message
        ];
        
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://wa.malhikdua.sch.id/app/api/send-message",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => json_encode($data))
        );
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        // echo $response;
        if ($err) {
            // return ['status'=>'error','data'=>"cURL Error #:" . $err];
            return "cURL Error #:" . $err;
        } else {
            return $response;
        }
    }
    
    static function send($to, $message, $file_url = '')
    {
        $curl = curl_init();
        $postfields = [
            'device_id' => getenv('WA_BLAST_DEVICE'),
            'number'    => $to,
            'message'   => $message
        ];
        if($file_url)
            $postfields['file'] = $file_url;
        $postfields = http_build_query($postfields);

        curl_setopt_array($curl, array(
            CURLOPT_URL => getenv('WA_BLAST_URL')."/api/send",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $postfields,
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            // return ['status'=>'error','data'=>"cURL Error #:" . $err];
            return "cURL Error #:" . $err;
        } else {
            return $response;
        }
    }
}
