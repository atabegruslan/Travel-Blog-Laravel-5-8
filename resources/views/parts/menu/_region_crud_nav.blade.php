<div class='row'>
	<ul class="list-inline">
		@if( strcmp( Route::currentRouteName(), 'region.edit') === 0 )
			<li>
		    	{{ link_to_route('region.show', 'Back', [ $param['id'] ], ['class' => 'btn btn-primary'] ) }}
		    </li>
		@endif

		<li>
			{{ link_to_route('region.index', 'View All', [], ['class' => 'btn btn-primary'] ) }}
		</li>

		@if( strcmp( Route::currentRouteName(), 'region.show') === 0 )
			<li>
		    	{{ link_to_route('region.edit', 'Edit', [ $param['id'] ], ['class' => 'btn btn-primary'] ) }}
		    </li>

		    <li>
			    {!! Form::open(array('url' => 'region/'.$param['id'],'enctype' => 'multipart/form-data','class'=>'form-inline')) !!}
			        {{ Form::hidden('_method','DELETE') }}
			        {!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}
			    {!! Form::close() !!} 
			</li>
		@endif

		@if( strcmp( Route::currentRouteName(), 'region.index') === 0 )
			<li>
				{{ link_to_route('region.create', 'Create New', [], ['class' => 'btn btn-primary'] ) }}
			</li>
		@endif

	</ul>
</div>
