<?php

namespace App\Http\Controllers;

class HealthcheckController extends Controller
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

    public function healthcheck(){
        $message = [
            'status:' => "ok"
        ];
        return response()->json($message, 200)->header('Content-Type', 'text/html');;
    }
}
