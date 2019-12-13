@extends('layouts.app')

@section('content')

<div class="row" >
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Time</th>
                <th>Actor ID</th>
                <th>Actor Name</th>
                <th>Model</th>
                <th>Table</th>
                <th>Method</th>
                <th>Record key name</th>
                <th>Record ID</th>
                <th>Previous State</th>
                <th>Modified State</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        	@foreach($logs as $log)
	            <tr>
	                <td>{!! $log['id'] !!}</td>
	                <td>{!! $log['time'] !!}</td>
	                <td>{!! $log['user_id'] !!}</td>
	                <td>{!! $log['user_name'] !!}</td>
	                <td>{!! $log['model'] !!}</td>
	                <td>{!! $log['table_name'] !!}</td>
	                <td>@php {{ echo ucfirst(str_replace('_', ' ', $log['method'])); }} @endphp</td>
	                <td>{!! $log['record_key_name'] !!}</td>
	                <td>{!! $log['record_id'] !!}</td>
	                @php {{ $skips = ['created_at','updated_at',/*'deleted_at',*/'created_by','updated_by','deleted_by']; }} @endphp
	                <td>
                		@if ($log['method'] !== 'update_pivot')
							<table class="table">
								@foreach ($log['params']['before'] as $initLabel => $initValue)
									@if (!in_array($initLabel, $skips))
										<tr>
											@if ($initLabel === 'img_url')
												<th>Image</th>
												<td><img class="log_img" src="{{ $initValue }}" /></td>
											@else
												<th>{!! $initLabel !!}</th>
												<td>{!! $initValue !!}</td>
											@endif;
										</tr>
									@endif
								@endforeach
							</table>
						@else
							@foreach ($log['params']['before'] as $pivotEntry)
								<table class="table">
									@foreach ($pivotEntry as $pivotKey => $pivotValue)
										@if (!in_array($pivotKey, $skips))
											<tr>
												<th>{!! $pivotKey !!}</th>
												<td>{!! $pivotValue !!}</td>
											</tr>
										@endif
									@endforeach
								</table>
							@endforeach
						@endif
	                </td>
	                <td>
                		@if ($log['method'] !== 'update_pivot')
							<table class="table">
								@foreach ($log['params']['after'] as $modLabel => $modValue)
									@if (!in_array($modLabel, $skips))
										<tr>
											@if ($modLabel === 'img_url')
												<th>Image</th>
												<td><img class="log_img" src="{{ $modValue }}" /></td>
											@else
												<th>{!! $modLabel !!}</th>
												<td>{!! $modValue !!}</td>
											@endif;
										</tr>
									@endif
								@endforeach
							</table>
						@else
							@foreach ($log['params']['after'] as $pivotEntry)
								<table class="table">
									@foreach ($pivotEntry as $pivotKey => $pivotValue)
										@if (!in_array($pivotKey, $skips))
											<tr>
												<th>{!! $pivotKey !!}</th>
												<td>{!! $pivotValue !!}</td>
											</tr>
										@endif
									@endforeach
								</table>
							@endforeach
						@endif
	                </td>
	                <td>
	                	@if ($log['is_restored'] === 0)
		                	<form method="POST" action="log/restore" accept-charset="UTF-8" enctype="multipart/form-data" class="form-inline">
		                		@csrf
	                            <input type="hidden" name="log_id" value="<?php echo $log['id']; ?>" />

	                            <input type="submit" value="Restore" class="'btn btn-default" />
	                        </form>	
	                    @endif
	                </td>
	            </tr>
	        @endforeach
        </tbody>
	</table>
</div>

@endsection
