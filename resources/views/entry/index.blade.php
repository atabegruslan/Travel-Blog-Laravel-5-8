@extends('layouts.app')

@section('title')
    {{ ucfirst($feature) }}
@endsection

@section('content')

	@include('parts/menu/_crud_nav')

	@include('parts/msg/_success')

	<div class="row">
	    <table class="table">
	        <thead>
	            <tr>
	                <th></th>
	                <th>Place</th>
	                <th>Region</th>
	                <th>Review</th>
	                <th>User</th>
	                <th>Time</th>
	            </tr>
	        </thead>

	        <tbody>
	    	    @foreach($items as $k => $v)
	    	    	<tr>
	                    <td>
	                        <img src="{{ $v->img_url }}" class="img-responsive small" alt="{{ $v->place }}">
	                    </td>
	                    <td>
	                    	<b>{{ link_to_route($feature . '.show', $v->place, [ $v->id ] ) }}</b>
	                    </td>
	                    <td>
	                        @foreach($v->regions as $region)
	                            {!! $region->name !!}<br>
	                        @endforeach
	                    </td>
	                    <td>{!! $v->comments !!}</td>
	                    <td>{!! $v->user->name !!}</td>
	                    <td>{!! date('Y-m-d h:i:s', strtotime($v->updated_at) ) !!}</td>
	    	    	</tr>
	    	    @endforeach
	        </tbody>
	    </table> 
	</div>

	<div class="row" >
	    <div id="paginate">
	        {{ $items->links() }}
	    </div>
	</div>

@endsection
