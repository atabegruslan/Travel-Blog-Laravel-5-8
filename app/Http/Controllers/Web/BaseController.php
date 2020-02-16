<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

class BaseController extends Controller
{ // @todo Make web controllers extend this BaseController
    protected $currentUser;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
        	
            $this->currentUser = $request->user();

            view()->share([
                'currentUser' => $this->currentUser,
                'token'       => auth('api')->login($this->currentUser),
            ]);

            return $next($request);
        });
    }
}
