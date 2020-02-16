<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $currentUser;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            
            $this->currentUser = $request->user();

            view()->share([
                'currentUser' => $this->currentUser,
                'token'       => $this->getAccessToken($this->currentUser),
                //'token'       => auth('api')->login($this->currentUser), // This would would work for JWT, but not for Passport
            ]);

            return $next($request);
        });
    }

    private function getAccessToken($user)
    {
    	$clientId = 2;

    	$clientSecret = DB::table('oauth_clients')
            ->where('id', $clientId)
            ->first()
            ->secret;

        $curl = curl_init(); 

        $payload = [    
            'client_id'     => $clientId, 
            'client_secret' => $clientSecret, 
            'grant_type'    => 'password', 
            'username'      => env('ADMIN_EMAIL'), 
            'password'      => env('ADMIN_PASSWORD'), 
            'type'          => 'normal', 
        ];  

        curl_setopt_array($curl, array( 
            CURLOPT_URL            => PUB_URL . "oauth/token", 
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_CUSTOMREQUEST  => "POST",
            CURLOPT_POSTFIELDS     => $payload,  
        )); 

        $response = curl_exec($curl);
        $response = json_decode($response);   

        curl_close($curl);

        if (!isset($response->error))
        {
        	return $response->access_token;
        }
        else
        {
        	return '';
        }  
    }
}
