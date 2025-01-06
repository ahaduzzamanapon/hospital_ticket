<?php

if (!function_exists('send_sms')) {
    function send_sms($to, $message)
    {
        $to = '+88' . $to;

        $curl = curl_init();
        $new_message = curl_escape($curl, $message);

        $url = 'http://103.69.149.50/api/v2/SendSMS?SenderId=8809617612638&Is_Unicode=true&ClientId=ec63aede-1c7e-4a5a-a1ad-36b72ab30817&ApiKey=AeHZPUEZXIILtxg0VEaGjsK%2BuPNlzhCDW0VuFRmcchs%3D&Message=' . $new_message . '&MobileNumbers=' . $to;
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }
}
