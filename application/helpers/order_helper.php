<?php
    function fetchId($amount)
    {
        $curl = curl_init();

        $am = $amount*100;
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://api.razorpay.com/v1/orders',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>'{
          "amount": '.$am.',
          "currency": "INR",
          "receipt": "Receipt no. 1"
          
        }',
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Authorization: Basic cnpwX2xpdmVfU0FXcE1TaXlJVHBaRHk6cWxYb3JBb2w2bGpuVWRSRmRZclpWYTBq'
          ),
        ));
        
        $response = curl_exec($curl);
        $result = json_decode($response, true); // true turns it into an array
        curl_close($curl);
        return $result['id'];
    }
?>