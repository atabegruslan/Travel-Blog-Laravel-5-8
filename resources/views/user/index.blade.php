@extends('layouts.app')

@section('title')
    Users
@endsection

@section('content')

	{{-- @include('parts/msg/_success') --}}

    <div class="vuepart">
        <Users></Users>
    </div>

@endsection
