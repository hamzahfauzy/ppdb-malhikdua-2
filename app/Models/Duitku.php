<?php

namespace App\Models;


class Duitku
{

    function callback()
    {
        $apiKey = getenv('DUITKU_MERCHANT_KEY'); // Your api key
        $merchantCode = isset($_POST['merchantCode']) ? $_POST['merchantCode'] : null; 
        $amount = isset($_POST['amount']) ? $_POST['amount'] : null; 
        $merchantOrderId = isset($_POST['merchantOrderId']) ? $_POST['merchantOrderId'] : null; 
        $productDetail = isset($_POST['productDetail']) ? $_POST['productDetail'] : null; 
        $additionalParam = isset($_POST['additionalParam']) ? $_POST['additionalParam'] : null; 
        $paymentMethod = isset($_POST['paymentCode']) ? $_POST['paymentCode'] : null; 
        $resultCode = isset($_POST['resultCode']) ? $_POST['resultCode'] : null; 
        $merchantUserId = isset($_POST['merchantUserId']) ? $_POST['merchantUserId'] : null; 
        $reference = isset($_POST['reference']) ? $_POST['reference'] : null; 
        $signature = isset($_POST['signature']) ? $_POST['signature'] : null; 

        if(!empty($merchantCode) && !empty($amount) && !empty($merchantOrderId) && !empty($signature))
        {
            $params = $merchantCode . $amount . $merchantOrderId . $apiKey;
            $calcSignature = md5($params);

            if($signature == $calcSignature)
            {
                //Your code here
                if($resultCode == "00")
                    return ['success'=>'success','data'=>$_POST];
                else
                    return ['error'=>'fail'];
            }
            else
            {
                return ['error'=>'Bad Signature'];
            }
        }
        else
        {
            return ['error'=>'Bad Parameter'];
        }
    }

    function pay($amount, $method, $personal)
    {
        $name = $personal['name'];
        $email = $personal['email'];
        $phoneNumber = $personal['phone'];
        $merchantCode = getenv('DUITKU_MERCHANT_CODE'); // from duitku
        $merchantKey = getenv('DUITKU_MERCHANT_KEY'); // from duitku
        $paymentAmount = $amount;
        $paymentMethod = $method; // WW = duitku wallet, VC = Credit Card, MY = Mandiri Clickpay, BK = BCA KlikPay
        $merchantOrderId = time(); // from merchant, unique
        $productDetails = 'PPDB Malhikdua';
        $customerVaName = $name; // display name on bank confirmation display
        $callbackUrl = route('duitku-callback'); // getenv('DUITKU_CALLBACK'); // url for callback
        $returnUrl = route('login'); // url for redirect

        $signature = md5($merchantCode . $merchantOrderId . $paymentAmount . $merchantKey);

        $params = array(
            'merchantCode' => $merchantCode,
            'paymentAmount' => $paymentAmount,
            'paymentMethod' => $paymentMethod,
            'merchantOrderId' => $merchantOrderId,
            'productDetails' => $productDetails,
            'customerVaName' => $customerVaName,
            'email' => $email,
            'phoneNumber' => $phoneNumber,
            'callbackUrl' => $callbackUrl,
            'returnUrl' => $returnUrl,
            'signature' => $signature,
        );

        // return $params;

        $params_string = json_encode($params);
        // $url = 'https://sandbox.duitku.com/webapi/api/merchant/v2/inquiry'; // Sandbox
        $url = 'https://passport.duitku.com/webapi/api/merchant/v2/inquiry'; // Production
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url); 
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params_string);                                                                  
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
            'Content-Type: application/json',                                                                                
            'Content-Length: ' . strlen($params_string))                                                                       
        );   
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        //execute post
        $request = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if($httpCode == 200)
        {
            $result = json_decode($request, true);
            $result['merchantOrderId'] = $merchantOrderId;
            return $result;
            // header('location: '. $result['paymentUrl']);
            // echo "paymentUrl :". $result['paymentUrl'] . "<br />";
            // echo "merchantCode :". $result['merchantCode'] . "<br />";
            // echo "reference :". $result['reference'] . "<br />";
            // echo "vaNumber :". $result['vaNumber'] . "<br />";
            // echo "amount :". $result['amount'] . "<br />";
            // echo "statusCode :". $result['statusCode'] . "<br />";
            // echo "statusMessage :". $result['statusMessage'] . "<br />";
        }
        else
            return $httpCode;
    }

    function check($merchantOrderId)
    {
        $merchantCode = getenv('DUITKU_MERCHANT_CODE'); // from duitku
        $merchantKey = getenv('DUITKU_MERCHANT_KEY'); // from duitku

        $signature = md5($merchantCode . $merchantOrderId . $merchantKey);

        $params = array(
            'merchantCode' => $merchantCode,
            'merchantOrderId' => $merchantOrderId,
            'signature' => $signature
        );

        $params_string = json_encode($params);
        $url = 'https://passport.duitku.com/webapi/api/merchant/transactionStatus';
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url); 
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params_string);                                                                  
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
            'Content-Type: application/json',                                                                                
            'Content-Length: ' . strlen($params_string))                                                                       
        );   
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        //execute post
        $request = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if($httpCode == 200)
        {
            $result = json_decode($request, true);
        }
        else
            echo $httpCode;
    }
}
