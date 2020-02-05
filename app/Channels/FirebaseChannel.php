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
        $message = $notification->toFirebase($notifiable);

        // Send notification to the $notifiable instance...
        $curl = curl_init();    

        $header = [ 
            'Authorization: Key=' . env('SERVER_API_KEY'), // This should be the legacy key from Firebase console, because 'https://fcm.googleapis.com/fcm/send' is used.
            'Content-Type: Application/json',   
        ];

        $tokens = DB::table('fcm_tokens')
            ->pluck('token')
            ->toArray();

        $payload = [    
            'registration_ids' => $tokens,  
            'data'             => $message, 
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

$myfile = fopen("C:/Users/Victor/Desktop/response" . date("YFd_H-i-s") . rand(1, 99999) . ".txt", "w");
fwrite($myfile, serialize($response));
fclose($myfile);

$myfile = fopen("C:/Users/Victor/Desktop/err" . date("YFd_H-i-s") . rand(1, 99999) . ".txt", "w");
fwrite($myfile, serialize($err));
fclose($myfile);

        curl_close($curl);  
    }
}