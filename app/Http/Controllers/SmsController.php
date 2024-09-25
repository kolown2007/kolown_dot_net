<?php

namespace App\Http\Controllers;

use Ably\AblyRest;
use Pusher\Pusher;
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

 public function PusherTokenRequest(Request $request)
 {
     // Validate the request parameters
     $request->validate([
         'socket_id' => 'required|string',
         'channel_name' => 'required|string',
     ]);

     // Retrieve the parameters
     $socketId = $request->input('socket_id');
     $channelName = $request->input('channel_name');

     // Debugging: Log the parameters
    //  \Log::info('PusherTokenRequest - socket_id: ' . $socketId . ', channel_name: ' . $channelName);

     // Initialize Pusher
     $pusher = new Pusher(
         env('PUSHER_APP_KEY'),
         env('PUSHER_APP_SECRET'),
         env('PUSHER_APP_ID'),
         [
             'cluster' => env('PUSHER_APP_CLUSTER'),
             'useTLS' => true
         ]
     );

     // Authorize the channel
     $auth = $pusher->authorizeChannel($channelName, $socketId);

     // Return the response
     return response()->json(json_decode($auth));
 }


}




