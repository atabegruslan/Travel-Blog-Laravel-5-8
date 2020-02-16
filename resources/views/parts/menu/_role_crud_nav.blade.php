<div class='row'>
	<ul class="list-inline">
		@if( strcmp( Route::currentRouteName(), 'role.edit') === 0 )
			<li>
		    	{{ link_to_route('role.show', 'Back', [ $param['id'] ], ['class' => 'btn btn-primary'] ) }}
		    </li>
		@endif

		<li>
			{{ link_to_route('role.index', 'View All', [], ['class' => 'btn btn-primary'] ) }}
		</li>

		@if( strcmp( Route::currentRouteName(), 'role.show') === 0 )
			<li>
		    	{{ link_to_route('role.edit', 'Edit', [ $param['id'] ], ['class' => 'btn btn-primary'] ) }}
		    </li>

		    <li>
			    {!! Form::open(array('url' => 'role/'.$param['id'],'enctype' => 'multipart/form-data','class'=>'form-inline')) !!}
			        {{ Form::hidden('_method','DELETE') }}
			        {!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}
			    {!! Form::close() !!} 
			</li>
		@endif

		@if( strcmp( Route::currentRouteName(), 'role.index') === 0 )
			<li>
				{{ link_to_route('role.create', 'Create New', [], ['class' => 'btn btn-primary'] ) }}
			</li>
		@endif

	</ul>
</div>
