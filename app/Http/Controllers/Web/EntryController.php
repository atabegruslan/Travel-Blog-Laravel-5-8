<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Entry;
use App\Models\Region;
use App\Models\User;
use App\Notifications\NewEntry;
use Notification;
use Illuminate\Support\Facades\Auth;

class EntryController extends Controller
{
    private $feature = 'entry';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!auth()->user()->can($this->feature . '.read')) 
        {
            abort(403);
        }

        $entries = Entry::orderBy('updated_at', 'DESC')->paginate(PAG);

        $data = ['items' => $entries, 'feature' => $this->feature];

        return view($this->feature . '.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!auth()->user()->can($this->feature . '.create')) 
        {
            abort(403);
        }

        $regions = Region::all();

        $data = [
            'item' => null, 
            'feature' => $this->feature, 
            'regions' => $regions,
            'selectedRegions' => [],
            'selectedRegionIds' => [],
        ];

        return view($this->feature . '.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!auth()->user()->can($this->feature . '.create')) 
        {
            abort(403);
        }

        $this->validate($request, [
            'place'    => 'required|max:15',
            'comments' => 'required|max:50',
            'image'    => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            // @todo validate region_ids as an integer array https://stackoverflow.com/questions/24588975/how-do-i-validate-an-array-of-integers-in-laravel
        ]); 

        $img             = $request->file('image');
        $imgUrl          = $this->makeImage($img);
        $entry           = new Entry;
        $entry->place    = $request->input('place');
        $entry->comments = $request->input('comments');
        $entry->user_id  = $request->input('user_id');
        $entry->img_url  = $imgUrl;

        $entry->save();
        $entry->regions()->sync($request->input('region_ids'));

        \Session::flash('success', ucfirst($this->feature) . ' Created');

        $users = User::all();

        // foreach ($users as $user) 
        // {
        //     $user->notify(new NewEntry);
        // }

        $notice = array(
            'entry_url' => url("/$this->feature/" . $entry->id), //PUB_URL . 'entry/' . $entry->id,
            'entry_id'  => $entry->id,
            'name'      => $entry->place,
            'img_url'   => $imgUrl,
        );

        Notification::send($users, new NewEntry($notice));

        return redirect($this->feature);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!auth()->user()->can($this->feature . '.read')) 
        {
            abort(403);
        }

        $entry   = Entry::where('id', $id)->first();
        $selectedRegions = $entry->regions()->get();

        $data = [
            'item' => $entry, 
            'feature' => $this->feature, 
            'regions' => [],
            'selectedRegions' => $selectedRegions,
            'selectedRegionIds' => [],
        ];

        return view($this->feature . '.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!auth()->user()->can($this->feature . '.update')) 
        {
            abort(403);
        }

        $entry   = Entry::where('id', $id)->first();
        $regions = Region::all();
        $selectedRegions = $entry->regions()->get();
        $selectedRegionIds = $selectedRegions->pluck('id')->toArray();

        $data = [
            'item' => $entry, 
            'feature' => $this->feature, 
            'regions' => $regions,
            'selectedRegions' => $selectedRegions,
            'selectedRegionIds' => $selectedRegionIds,
        ];

        return view($this->feature . '.edit', $data);
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
        if (!auth()->user()->can($this->feature . '.update')) 
        {
            abort(403);
        }

        $this->validate($request, [
            'place'    => 'required|max:15',
            'comments' => 'required|max:50',
            'image'    => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            // @todo validate region_ids as an integer array
        ]); 

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
        
        $entry->regions()->sync($request->input('region_ids'));

        \Session::flash('success', ucfirst($this->feature) . ' Updated');

        return redirect($this->feature);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!auth()->user()->can($this->feature . '.delete')) 
        {
            abort(403);
        }

        $entry = Entry::where('id', $id)->first();

        $this->deleteImage($entry->img_url);

        $entry->delete();

        \Session::flash('success', ucfirst($this->feature) . ' Deleted');

        return redirect($this->feature);
    }

    private function makeImage($img)
    {
        $uniquefier       = rand(10000, 99999) . time();
        $final_image_name = $uniquefier . '.' . $img->getClientOriginalExtension();
        $final_image_path = IMG_DIR;

        $img->move($final_image_path, $final_image_name);

        $src = PUB_URL . 'images/' . $final_image_name;
        $dst = 'images/' . $final_image_name;

        $this->editImage(IMG_RAD, $src, $dst);

        return $src;
    }

    private function deleteImage($imgUrl)
    {
        $imageNameParts = explode('/', $imgUrl);
        $imageName      = $imageNameParts[ count($imageNameParts) - 1 ];

        \File::delete('images/' . $imageName);
    }

    private function editImage($size, $src, $dest, $quality = 80)
    {
        $imgsize = getimagesize($src);
        $width   = $imgsize[0];
        $height  = $imgsize[1];
        $mime    = $imgsize['mime'];
     
        switch ($mime)
        {
            case 'image/gif':
                $image_create = "imagecreatefromgif";
                $image        = "imagegif";

                break;
     
            case 'image/png':
                $image_create = "imagecreatefrompng";
                $image        = "imagepng";
                $quality      = 7;

                break;
     
            case 'image/jpeg':
                $image_create = "imagecreatefromjpeg";
                $image        = "imagejpeg";
                $quality      = 80;

                break;
     
            default:
                return false;

                break;
        }

        $this->makeSquare($size, $src, $dest, $image, $image_create, $width, $height, $quality);
        $this->makeCircle($size, $src, $dest, $image_create);
    }

    private function makeSquare($size, $src, $dest, $image, $image_create, $width, $height, $quality)
    {
        $dst_img = imagecreatetruecolor($size, $size);
        $src_img = $image_create($src);
         
        $width_new  = $height;
        $height_new = $width;

        //if the new width is greater than the actual width of the image, then the height is too large and the rest cut off, or vice versa
        if($width_new > $width)
        {
            //cut point by height
            $h_point = (($height - $height_new) / 2);
            //copy image
            imagecopyresampled($dst_img, $src_img, 0, 0, 0, $h_point, $size, $size, $width, $height_new);
        }
        else
        {
            //cut point by width
            $w_point = (($width - $width_new) / 2);
            imagecopyresampled($dst_img, $src_img, 0, 0, $w_point, 0, $size, $size, $width_new, $height);
        }
        
        $image($dst_img, $dest, $quality);

        if ($src_img) imagedestroy($src_img);
        if ($dst_img) imagedestroy($dst_img);
    }

    private function makeCircle($size, $src, $dest, $image_create)
    {      
        $src_img = $image_create($src);

        $dst_img = imagecreatetruecolor($size, $size);
        imagealphablending($dst_img, true);
        imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, $size, $size, $size, $size);

        $mask        = imagecreatetruecolor($size, $size);
        $transparent = imagecolorallocate($mask, 255, 0, 0);

        imagecolortransparent($mask, $transparent);
        imagefilledellipse($mask, $size / 2, $size / 2, $size, $size, $transparent);
        $red = imagecolorallocate($mask, 0, 0, 0);
        imagecopymerge($dst_img, $mask, 0, 0, 0, 0, $size, $size, 100);
        imagecolortransparent($dst_img, $red);
        imagefill($dst_img, 0, 0, $red);
        
        imagepng($dst_img, $dest); 

        if ($mask) imagedestroy($mask);
        if ($dst_img) imagedestroy($dst_img);       
    }
}
