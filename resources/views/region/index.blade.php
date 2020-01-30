@extends('layouts.app')

@section('title')
    Regions
@endsection

@section('content')

	@include('parts/menu/_region_crud_nav')
	
	{{-- @include('parts/msg/_success') --}}

	{{-- @include('parts/_region_archive') --}}
	
	
    <div class="vuepart">
        <Regions region-route="{{ PUB_URL }}region"></Regions>
    </div>

@endsection
