<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try
        {
            $users      = User::all();
            $response   = ['data' => $users, 'pagination' => []]; // @todo Finish pagination
            $statusCode = 200;

            return \Response::json($response, $statusCode); 
        }
        catch (Throwable $t)
        {
            $response = [
                "error" => "Error"
            ];

            $statusCode = 404;

            return \Response::json($response, $statusCode); 
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try
        {
            // check if user already exist using composite key email and type
            if ( User::where('email', $request->input('email'))->where('type', $request->input('type'))->first() )
            {
                if( strcmp( $request->input('type') , 'normal' ) === 0 )
                {
                    $response = [
                        "error" => "Duplicate"
                    ];

                    $statusCode = 404;
                }
                else
                {
                    $response = [
                        "msg" => "OK"
                    ];

                    $statusCode = 200;
                }
            }
            else
            {
                // insert new entry into database
                $user            = new User;
                $user->name      = $request->input('name');
                $user->email     = $request->input('email');
                $user->password  = bcrypt($request->input('password'));
                $user->type      = $request->input('type');
                //$user->social_id = $request->input('social_id');  

                $user->save();

                $response = [
                    "msg" => "OK"
                ];

                $statusCode = 200;
            }

            return \Response::json($response, $statusCode); 
        }
        catch (Throwable $t)
        {
            $response = [
                "error" => "Error"
            ];

            $statusCode = 404;

            return \Response::json($response, $statusCode); 
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function autosuggest(Request $request, $name)
    {
        try
        {
            $response   = User::where('name', 'like', $name . '%')->get();
            $statusCode = 200;

            return \Response::json($response, $statusCode); 
        }
        catch (Throwable $t)
        {
            $response = [
                "error" => "Error"
            ];

            $statusCode = 404;

            return \Response::json($response, $statusCode); 
        }
    }
}
