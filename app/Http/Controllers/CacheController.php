<?php

namespace App\Http\Controllers;

class CacheController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Clear cache table
     * 
     * @return Response
     */    
    public function clear()
    {
        \App\Services\CacheService::clear();

        $message = [
            'error:' => 0,
            'msg' => 'ok'
        ];
        return response()->json($message, 200)->header('Content-Type', 'text/html');;
    }
}
