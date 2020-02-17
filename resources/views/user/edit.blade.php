@extends('layouts.app')

@section('content')

@include('parts/menu/_user_crud_nav')

<div class="row">        

    <div class="col-sm-12 col-md-8 col-lg-8 col-xl-8">

        {!! Form::model($param, array('url' => 'user/'.$param->id,'enctype' => 'multipart/form-data','class'=>'form')) !!}

            {{ Form::hidden('user_id',Auth::user()->id) }}

            <div class="form-group">
                <label for="name">User: </label>
                {{ Form::text('name',null,array('placeholder'=>$param->name,'class'=>'form-control','id'=>'name', 'readonly')) }}
            </div>

            <div class="form-group">
                <label for="role_ids">Roles: </label>
                <select name="role_ids[]" id="role_ids" class="form-control" multiple>
                     @foreach($roles as $role)
                        @if(in_array($role->id, $selectedRoleIds))
                         <option value="{{ $role->id }}" selected>
                        @else
                         <option value="{{ $role->id }}">
                        @endif
                             {{ $role->name }}
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
                    <th>Name: </th>
                    <th>{{ $param->name }}</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>Email: </strong></td>
                    <td>{{ $param->email }}</td>
                </tr>
                <tr>
                    <td><strong>Created: </strong></td>
                    <td>{{ $param->created_at }}</td>
                </tr>
                <tr>
                    <td><strong>SignUp Type: </strong></td>
                    <td>{{ $param->type }}</td>
                </tr>
                <tr>
                    <td><strong>Roles: </strong></td>
                    <td>
                        @foreach($selectedRoles as $selectedRole)
                            <p>{{ $selectedRole->name }}</p>
                        @endforeach
                    </td>
                </tr>
            </tbody>
        </table>

    </div>

</div>

@endsection