<?php

namespace App\Channels;

use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\DB;

class FirebaseChannel
{
    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toFirebase($notifiable, $notification);

        // Send notification to the $notifiable instance...
        $curl = curl_init();    

        $header = [ 
            'Authorization: key=' . env('SERVER_API_KEY'), // This should be the legacy key from Firebase console, because 'https://fcm.googleapis.com/fcm/send' is used.
            'Content-Type: application/json',   
        ];

        $tokens = DB::table('fcm_tokens')
            ->pluck('token')
            ->toArray();

        $payload = [    
            'registration_ids' => $tokens,  
            'data'             => ['notification' => $message], // If you want the service worker's setBackgroundMessageHandler to be called, then structure your message like so. https://stackoverflow.com/questions/47973215/web-push-messaging-setbackgroundmessagehandler-not-working
        ];  

        curl_setopt_array($curl, array( 
            CURLOPT_URL            => "https://fcm.googleapis.com/fcm/send", 
            CURLOPT_RETURNTRANSFER => true,   
            CURLOPT_CUSTOMREQUEST  => "POST",  
            CURLOPT_POSTFIELDS     => json_encode($payload),  
            CURLOPT_HTTPHEADER     => $header 
        )); 

        $response = curl_exec($curl);   
        $err      = curl_error($curl);   

        curl_close($curl);  
    }
}