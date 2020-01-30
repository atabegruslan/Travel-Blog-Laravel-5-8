@extends('layouts.app')

@section('title')
    Regions
@endsection

@section('content')

	{{-- @include('parts/menu/_region_crud_nav') --}}
	
	{{-- @include('parts/msg/_success') --}}

	{{-- @include('parts/_region_archive') --}}
	
	<regions-tree></regions-tree>

@endsection

@section('script')
	<script src="{{ PUB_URL }}js/modules/region-tree.js?v={{ rand() }}"></script>
@endsection
