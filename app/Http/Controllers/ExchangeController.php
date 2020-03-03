<?php

namespace App\Http\Controllers;

use Exception;

class ExchangeController extends Controller
{
    private $supportedCurrencies = [];
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->supportedCurrencies = explode(", ", env("CONFIG_CURRENCIES", "CAD, JPY, USD, GBP, EUR, RUB, HKD, CHF"));
    }

    public function info()
    {
        $message = [
            "error" => 0,
            "msg" => "API written by Decio Quintas",
        ];
        return response()->json($message, 200)->header('Content-Type', 'text/html');
    }

    public function convert($amount, $from, $to)
    {
        if (!in_array($from, $this->supportedCurrencies)) {
            $message = [
                "error" => 1,
                "msg" => "currency " . $from . " not supported"
            ];
            return response()->json($message, 200)->header('Content-Type', 'text/html');;
        }

        if (!in_array($to, $this->supportedCurrencies)) {
            $message = [
                "error" => 1,
                "msg" => "currency " . $to . " not supported"
            ];
            return response()->json($message, 200)->header('Content-Type', 'text/html');;
        }

        try {
            [$price, $isFromCache] = \App\Services\ExchangeService::convert($amount, $from, $to);
            
            $convertedAmount = number_format($amount * $price, 2);

            $message = [
                "error" => 0,
                "amount" => $convertedAmount,
                "fromCache" => $isFromCache
            ];
            return response()->json($message, 200)->header('Content-Type', 'text/html');;
        } catch (Exception $ex) {
            print($ex);
            $message = [
                "error" => 1,
                "msg" => "unkown error. try later"
            ];
            return response()->json($message, 200)->header('Content-Type', 'text/html');;
        }
    }
}
