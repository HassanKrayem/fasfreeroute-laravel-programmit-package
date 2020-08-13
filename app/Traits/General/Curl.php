<?php

namespace Programmit\Traits\General;

trait Curl
{
    public function curlRequest($url, $fields)
    {
        $fields_string = "";
        foreach($fields as $key=>$value)
        {
                $fields_string .= $key.'='.$value.'&';
        }
        $fields_string = rtrim($fields_string,'&');

        $ch = curl_init();
        //set the url, number of POST vars, POST data
        $headers = [
            "Cache-Control: no-cache", 
        ];

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, count($fields));
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        //curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

        //execute post
        $response  = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $responseHeader = substr($response, 0, $header_size);
        $responseBody = substr($response, $header_size);
        curl_close($ch);

        return [
            'output' => $response,
            'response' => $responseBody,
            'status' => $httpcode
        ];
    }
}