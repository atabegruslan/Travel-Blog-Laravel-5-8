@extends('layouts.app')

@section('content')


@include('parts/menu/_region_crud_nav')

@include('parts/msg/_error')

<div class="row" >
    {!! Form::open(array('url' => 'region','enctype' => 'multipart/form-data','class'=>'form')) !!}

        {{ Form::hidden('user_id',Auth::user()->id) }}

        <div class="form-group">
            <label for="place">Name: </label>
            {{ Form::text('name',null,array('placeholder'=>'Region\'s name','class'=>'form-control','id'=>'name')) }}
        </div>

        {{ Form::token() }}
        
        {!! Form::submit('Add a new region', array('class'=>'btn btn-default')) !!}

    {!! Form::close() !!}
</div>


@endsection