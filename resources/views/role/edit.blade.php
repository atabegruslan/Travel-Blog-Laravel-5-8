@extends('layouts.app')

@section('content')

@include('parts/menu/_role_crud_nav')

<div class="row">        

    <div class="col-sm-12 col-md-8 col-lg-8 col-xl-8">

        {!! Form::model($param, array('url' => 'role/'.$param['id'],'enctype' => 'multipart/form-data','class'=>'form')) !!}

            {{ Form::hidden('user_id',Auth::user()->id) }}

            <div class="form-group">
                <label for="name">Role: </label>
                {{ Form::text('name',null,array('placeholder'=>'Name','class'=>'form-control','id'=>'name')) }}
            </div>

            <div class="form-group">
                <label for="permission_ids">Permissions: </label>
                <select name="permission_ids[]" id="permission_ids" class="form-control" multiple>
                     @foreach($permissions as $permission)
                        @if(in_array($permission->id, $selectedPermissionIds))
                         <option value="{{ $permission->id }}" selected>
                        @else
                         <option value="{{ $permission->id }}">
                        @endif
                             {{ $permission->name }}
                         </option>
                     @endforeach
                </select>
            </div>

            {{ Form::hidden('_method','PUT') }}

            {!! Form::submit('update', array('class'=>'btn btn-default')) !!}
            
        {!! Form::close() !!} 

    </div>
        
    <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">

        <table class="table">
            <thead>
                <tr>
                    <th>Role: </th>
                    <th>{{ $param->name }}</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Permissions: </td>
                    <td>
                        @foreach($selectedPermissions as $selectedPermission)
                            <p>{{ $selectedPermission->name }}</p>
                        @endforeach
                    </td>
                </tr>
            </tbody>
        </table>

    </div>

</div>

@include('parts/_entry_comments')

@endsection