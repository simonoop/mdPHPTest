<?php

namespace App\Services;

use App\Models\Cache;
use Exception;

class CacheService
{
    public function __construct()
    {
    }

    /**
     * 
     */
    public static function clear()
    {
        Cache::truncate();
    }

    public static function refresh($from, $to)
    {
        $price = \App\Services\ExternalApiService::get($from, $to);
        $cache = new Cache([
            'from' => $from,
            'to' => $to,
            'rate' => $price
        ]);
        return $cache;
    }

    public static function get($from, $to)
    {
        $cacheTTL = env('CONFIG_CACHE_TTL_IN_MINUTES', 120);        
        $cache = self::getRate($from, $to, $cacheTTL);
        return self::calculatePrice($from, $to, $cache);
    }

    private static function getRate($from, $to, $cacheTTL)
    {
        $cache = Cache::where(
            function ($query) use ($from, $to) {
                $query->where('from', $from)->where('to', $to);
            }
        )->orWhere(function ($query) use ($from, $to) {
            $query->where('from', $to)->where('to', $from);
        })->first();

        if ($cache) {
            $cacheCreateTime = strtotime($cache->created_at);
            $cacheMaxAge = strtotime("-$cacheTTL minutes");
            if ($cacheCreateTime <= $cacheMaxAge) {
                $cache->delete();
            } else {
                return $cache;
            }
        }

        return null;
    }

    private static function calculatePrice($from, $to, $cache)
    {
        if (!$cache) {
            return null;
        }

        if ($cache->from == $from and $cache->to == $to) {
            return $cache->rate;
        } else {
            return 1 / $cache->rate;
        }
    }
}
