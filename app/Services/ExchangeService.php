<?php

namespace App\Services;

class ExchangeService
{
    public static function convert($amount, $from, $to)
    {

        $isFromCache = 1;
        $price = \App\Services\CacheService::get($from, $to);

        if (!$price) {
            $isFromCache = 0;
            $cache = \App\Services\CacheService::refresh($from, $to);
            $price = $cache->rate;
            $cache->save();
        }

        return [$price , $isFromCache];
    }
}
