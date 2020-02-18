<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Region;
use App\Models\RegionTree;
use Illuminate\Support\Facades\DB;

class RegionController extends Controller
{
    private $feature = 'region';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $regions = Region::all();

        $data = ['items' => $regions, 'feature' => $this->feature];

        return view($this->feature . '.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = ['item' => null, 'feature' => $this->feature];

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
        $this->validate($request, [
            'name' => 'required',
        ]); 

        $region       = new Region;
        $region->name = $request->input('name');

        $region->save();

        DB::table('region_tree')->insert(['region_id' => $region->id, 'parent_id' => 0]);

        \Session::flash('success', ucfirst($this->feature) . ' Created');

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
        $region = Region::where('id', $id)->first();

        $data = ['item' => $region, 'feature' => $this->feature];

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
        $region = Region::where('id', $id)->first();

        $data = ['item' => $region, 'feature' => $this->feature];

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
        $this->validate($request, [
            'name' => 'required',
        ]); 

        $region = Region::where('id', $id)->first();

        $region->update([
            'name' => $request->input('name'),
        ]);

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
        $region = Region::where('id', $id)->first();

        $region->delete();

        \Session::flash('success', ucfirst($this->feature) . ' Deleted');

        return redirect($this->feature);
    }
}
