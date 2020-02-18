@extends('layouts.app')

@section('title')
    {{ ucfirst($feature) }}
@endsection

@section('content')

    @include('parts/menu/_crud_nav')

    <div class="row">
        <table class="table">
            <thead>
                <tr>
                    <th>{{ ucfirst($feature) }}</th>
                </tr>
            </thead>

            <tbody>
        	    @foreach($items as $k => $v)
        	    	<tr>
                        <td>
                            <b>{{ link_to_route($feature . '.show', $v->name, [ $v->id ] ) }}</b>
                        </td>
        	    	</tr>
        	    @endforeach
            </tbody>
        </table> 
    </div>

@endsection
