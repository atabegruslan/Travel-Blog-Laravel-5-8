@extends('layouts.app')

@section('content')

@include('parts/menu/_entry_crud_nav')

@include('parts/msg/_error')

<div class="row">        

    <div class="col-sm-12 col-md-8 col-lg-8 col-xl-8">

        {!! Form::model($param, array('url' => 'entry/'.$param['id'],'enctype' => 'multipart/form-data','class'=>'form')) !!}

            {{ Form::hidden('user_id',Auth::user()->id) }}

            <div class="form-group">
                <label for="place">Place: </label>
                {{ Form::text('place',$param->place,array('placeholder'=>'Place','class'=>'form-control','id'=>'place')) }}
            </div>

            <!-- @todo multi-select dropmenu for regions -->

            <div class="form-group">
                <label for="comments">Comments: </label>
                {{ Form::textarea('comments',$param->comments,array('placeholder'=>'Comments','class'=>'form-control','id'=>'comments','rows'=>10)) }}
            </div>

            <div class="form-group">
                <label for="region_ids">Regions: </label>
                <select name="region_ids[]" id="region_ids" class="form-control" multiple>
                     @foreach($regions as $region)
                        @if(in_array($region->id, $selectedRegionIds))
                         <option value="{{ $region->id }}" selected>
                        @else
                         <option value="{{ $region->id }}">
                        @endif
                             {{ $region->name }}
                         </option>
                     @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="image">Image: </label>
                {!! Form::file('image',array('class'=>'img-thumbnail form-control-file','id'=>'image')) !!}
            </div>

            {{ Form::hidden('_method','PUT') }}

            {!! Form::submit('update', array('class'=>'btn btn-default')) !!}
            
        {!! Form::close() !!} 

    </div>
        
    <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                
        <img src="{{ $param->img_url }}" class="img-responsive medium" alt="{{ $param->place }}">

        <table class="table">
            <thead>
                <tr>
                    <th>Place: </th>
                    <th>{{ $param->place }}</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>Region: </strong></td>
                    <td>
                        @foreach($param->regions as $region)
                            {!! $region->name !!}<br>
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <td><strong>By: </strong></td>
                    <td>{{ $param->user->name }}</td>
                </tr>
                <tr>
                    <td><strong>Modified: </strong></td>
                    <td>{{ $param->time }}</td>
                </tr>
            </tbody>
        </table>     

        <div>
            <p><strong>Comments: </strong></p>
            <p>{{ $param->comments }}</p>
        </div>   

    </div>

    <!-- Just Test @todo To be done properly later -->
    {{-- route('api.region', 1) --}}

</div>

@include('parts/_entry_comments')

@endsection