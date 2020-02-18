<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comment;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        // if (!auth()->user()->can('entry.create')) 
        // {
        //     abort(403);
        // }

        try
        {
            $comment               = new Comment;
            $comment->entry_id     = $request->input('entry_id');
            $comment->contents     = $request->input('contents');
            $comment->commentor_id = $request->input('commentor_id');

            $comment->save();

            $response = [
                "msg" => "OK"
            ];

            $statusCode = 200;

            return \Response::json($response, $statusCode); 
        }
        catch(Throwable $t)
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
        // if (!auth()->user()->can('entry.read')) 
        // {
        //     abort(403);
        // }

        try
        {
            $response = Comment::with('commentor')->where('entry_id', $id)->get();

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
}
