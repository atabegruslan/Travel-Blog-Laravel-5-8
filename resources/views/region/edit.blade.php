@extends('layouts.app')

@section('content')

@include('parts/menu/_region_crud_nav')

@include('parts/msg/_error')

<div class="row">        

    <div class="col-sm-12 col-md-8 col-lg-8 col-xl-8">

        {!! Form::model($param, array('url' => 'region/'.$param['id'],'enctype' => 'multipart/form-data','class'=>'form')) !!}

            {{ Form::hidden('user_id',Auth::user()->id) }}

            <div class="form-group">
                <label for="name">Region: </label>
                {{ Form::text('name',$param->name,array('placeholder'=>'Region\'s name','class'=>'form-control','id'=>'name')) }}
            </div>

            {{ Form::hidden('_method','PUT') }}

            {!! Form::submit('update', array('class'=>'btn btn-default')) !!}
            
        {!! Form::close() !!} 

    </div>
        
    <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                
        <table class="table">
            <thead>
                <tr>
                    <th>Region: </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $param->name }}</td>
                </tr>
            </tbody>
        </table>     

    </div>

</div>

@endsection