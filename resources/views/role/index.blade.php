@extends('layouts.app')

@section('content')

@include('parts/menu/_role_crud_nav')

<div class="row">
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
            </tr>
        </thead>

        <tbody>
    	    @foreach($param as $k => $v)
    	    	<tr>
                    <td><b>{{ link_to_route('role.show', $v->name, [ $v->id ] ) }}</b></td>
    	    	</tr>
    	    @endforeach
        </tbody>
    </table> 
</div>

@endsection
