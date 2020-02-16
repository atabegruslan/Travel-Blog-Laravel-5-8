@extends('layouts.app')

@section('content')

@include('parts/menu/_role_crud_nav')

<div class="row" >
    {!! Form::open(array('url' => 'role','enctype' => 'multipart/form-data','class'=>'form')) !!}

        {{ Form::hidden('user_id',Auth::user()->id) }}

        <div class="form-group">
            <label for="name">Role: </label>
            {{ Form::text('name',null,array('placeholder'=>'Name','class'=>'form-control','id'=>'name')) }}
        </div>

        <div class="form-group">
            <label for="permission_ids">Permissions: </label>
            <select name="permission_ids[]" id="permission_ids" class="form-control" multiple>
                 @foreach($permissions as $permission)
                     <option value="{{ $permission->id }}">
                         {{ $permission->name }}
                     </option>
                 @endforeach
            </select>
        </div>

        {{ Form::token() }}
        
        {!! Form::submit('Add a role', array('class'=>'btn btn-default')) !!}

    {!! Form::close() !!}
</div>


@endsection