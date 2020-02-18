@extends('layouts.app')

@section('title')
    {{ ucfirst($feature) }}
@endsection

@section('content')

	@include('parts/menu/_crud_nav')
	
	@include('parts/msg/_success')

    <div class="vuepart">
        <Regions region-route="{{ PUB_URL }}region"></Regions>
    </div>

@endsection
