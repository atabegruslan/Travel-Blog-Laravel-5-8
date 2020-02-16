@extends('layouts.app')

@section('content')

@include('parts/menu/_role_crud_nav')

<div class="row">
        
    <div class="col-sm-12 col-md-8 col-lg-8 col-xl-8">

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
						@foreach($permissions as $permission)
							<p>{{ $permission->name }}</p>
						@endforeach
                    </td>
                </tr>
            </tbody>
        </table>

    </div>
        
</div>

@endsection