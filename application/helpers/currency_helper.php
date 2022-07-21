<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function get_exchange_rate(string $to, string $from, int $amount = 1)
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.apilayer.com/exchangerates_data/convert?to=$to&from=$from&amount=$amount",
    CURLOPT_HTTPHEADER => array(
        "Content-Type: text/plain",
        "apikey: T2BM3t3X5Aff2pCH18qGjp39tW53hRPh"
    ),
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET"
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    
    if (!$response) {
        return null;
    }

    $response = json_decode($response, true);
    return round($response['info']['rate'], 2);
}