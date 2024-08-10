<?php

namespace App\Http\Controllers;

use Ably\AblyRest;
use App\Events\Sendsms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;


class SmsController extends Controller
{


public function send(Request $request)
{

 
    $requestData = $request->all();

    if (isset($requestData['sms'])) {
        $message = $requestData['sms'];

          // Append the message to a .txt file
     // Storage::append('message.txt', $message);

        $ably   = new \Ably\AblyRest(env('ABLY_KEY'));
        $channel = $ably->channels->get('get-started');
        $channel->publish('first', $message);


    return redirect()->back();
}


 }

 public function TokenRequest()
 {
     $ably = new \Ably\AblyRest(env('ABLY_KEY'));
     $tokenRequest = $ably->auth->createTokenRequest()->toArray();

     return response()->json($tokenRequest);
 }
}




