<?php

namespace App\Http\Controllers;
use App\Events\Sendsms;
use Illuminate\Http\Request;
use Pusher\Pusher;
use Illuminate\Support\Facades\Log;


class SmsController extends Controller
{
//     public function send(Request $request)
//     {
       
//         $requestData = $request->all();

//         if (isset($requestData['sms'])) {
//             $message = $requestData['sms'];
//             event(new Sendsms('hello'));
//             info('sms: ' . $message);
//         } else {
//             info('Message not sent: sms is not set');
//         }
    
//         return redirect()->back();
    
// }

// public function send(Request $request)
// {
   
//     $requestData = $request->all();

//     if (isset($requestData['sms'])) {
//         $message = $requestData['sms'];
  

//         //pusher things

//         $options = array(
//             'cluster' => 'mt1',
//             'useTLS' => true
//           );
//           $pusher = new Pusher(
//             env('PUSHER_APP_KEY'),
//             env('PUSHER_APP_SECRET'),
//             env('PUSHER_APP_ID'),
//             $options
//           );
        
//           $pusher->trigger('my-channel', 'my-event', $message);





//         info('sms: ' . $message);
//     } else {
//         info('Message not sent: sms is not set');
//     }

//     return redirect()->back();

// }



// public function send(Request $request)
// {
//     $requestData = $request->all();

//     if (isset($requestData['sms'])) {
//         $message = $requestData['sms'];

//         try {
//             $event= new Sendsms($message);
//             event($event);
//             Log::info('event ' ,['event' => (array) $event]);
//         } catch (\Exception $e) {
//             Log::error('Error dispatching Sendsms event: ' . $e->getMessage());
//         }

//     } else {
//         Log::info('Message not sent: sms is not set');
//     }

//     return redirect()->back();
// }




//ably

public function send(Request $request)
{
    $requestData = $request->all();

    if (isset($requestData['sms'])) {
        $message = $requestData['sms'];

        $ably   = new \Ably\AblyRest(env('ABLY_KEY'));
        $channel = $ably->channels->get('get-started');
        $channel->publish('first', $message);


    return redirect()->back();
}


 }

}