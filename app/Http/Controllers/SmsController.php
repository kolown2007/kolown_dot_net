<?php

namespace App\Http\Controllers;

use Ably\AblyRest;
use App\Events\Sendsms;
use Illuminate\Http\Request;



class SmsController extends Controller
{


 public function TokenRequest()
 {
     $ably = new \Ably\AblyRest(env('ABLY_KEY'));
     $tokenRequest = $ably->auth->createTokenRequest()->toArray();

     return response()->json($tokenRequest);
 }

 
}




