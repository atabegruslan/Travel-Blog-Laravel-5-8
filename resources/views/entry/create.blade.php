@extends('layouts.app')

@section('title')
    {{ ucfirst($feature) }}
@endsection

@section('content')

    @include('parts/menu/_crud_nav')

    @include('parts/msg/_error')

    <div class="row" >

        <div class="col-sm-12 col-md-8 col-lg-8 col-xl-8">

        @include('parts/entry/form')

        </div>
        
    </div>

@endsection