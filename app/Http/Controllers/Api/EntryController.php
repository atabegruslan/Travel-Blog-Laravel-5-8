<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Entry;

class EntryController extends Controller
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
            $response   = Entry::with('user')->get()->all();
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
            $entry           = new Entry;
            $entry->place    = $request->input('place');
            $entry->comments = $request->input('comments');
            $entry->user_id  = $request->input('user_id');
            $entry->img_url  = $this->makeImage($request->file('image'));

            $entry->save();

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
        try
        {
            $response   = Entry::with('user')->where('id', $id)->first();
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
        try
        {
            $entry     = Entry::where('id', $id)->first();
            $img       = $request->file('image');
            $oldImgUrl = $entry->img_url;

            if ($img)
            {
                $newImgUrl = $this->makeImage($img);

                $this->deleteImage($oldImgUrl);
            }

            $entry->update([
                'place'    => $request->input('place'),
                'comments' => $request->input('comments'),
                'user_id'  => $request->input('user_id'),
                'img_url'  => isset($newImgUrl) ? $newImgUrl : $oldImgUrl
            ]);

            $response = [
                "msg" => "OK"
            ];

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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try
        {
            $entry = Entry::where('id', $id)->first();

            $this->deleteImage($entry->img_url);

            $entry->delete();

            $response = [
                "msg" => "OK"
            ];

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

    private function makeImage($img)
    {
        $uniquefier       = rand(10000, 99999) . time();
        $final_image_name = $uniquefier . '.' . $img->getClientOriginalExtension();
        $final_image_path = IMG_DIR;

        $img->move($final_image_path, $final_image_name);

        return PUB_URL . 'images/' . $final_image_name;
    }

    private function deleteImage($imgUrl)
    {
        $imageNameParts = explode('/', $imgUrl);
        $imageName      = $imageNameParts[ count($imageNameParts) - 1 ];

        \File::delete('images/' . $imageName);
    }

    public function images()
    {    
        $images = glob(IMG_DIR . "*.png");

        foreach($images as &$image) 
        {
            $image = str_replace(IMG_DIR, PUB_URL . 'images/', $image);
        }

        echo json_encode($images);
    }
}
