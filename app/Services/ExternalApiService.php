<?php

namespace App\Services;

class ExternalapiService
{
    public static function get($from, $to)
    {
        $api =  env("CONFIG_EXTERNALAPI", "https://api.exchangeratesapi.io/latest");

        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', $api);
        $result = json_decode($response->getBody());

        $fromToEUR = ($from == 'EUR' ? 1 : $result->rates->$from);
        $toToEUR = ($to == 'EUR' ? 1 : $result->rates->$to);

        $ratio = $toToEUR / $fromToEUR;

        return $ratio;
    }
}
