<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Entry;

class SearchController extends Controller
{
    public function index()
    {
    	$search = \Request::get('search');

	    $entries = Entry::where('place', 'LIKE', '%'.$search.'%')
            ->orWhere('comments', 'LIKE', '%'.$search.'%')
            ->orderBy('place')
            ->paginate(PAG);

        $entries_array = json_decode( json_encode($entries) , true);

        if ( !intval($entries_array['total']) )
        {
            \Session::flash('search_err', 'No results found for search: '. $search );
        }
        else
        {
            \Session::flash('search_success', 'Results for search: '. $search );
        }
    
	 	return view('search/search', ['param' => $entries]);
    }
}
