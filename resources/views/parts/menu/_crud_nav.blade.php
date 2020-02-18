<div class='row'>
	<ul class="list-inline">
		@if( strcmp( Route::currentRouteName(), $feature . '.edit') === 0 )
			<li>
		    	{{ link_to_route($feature . '.show', 'Back', [ $item->id ], ['class' => 'btn btn-primary'] ) }}
		    </li>
		@endif

		<li>
			{{ link_to_route($feature . '.index', 'View All', [], ['class' => 'btn btn-primary'] ) }}
		</li>

		@if( strcmp( Route::currentRouteName(), $feature . '.show') === 0 )
			<li>
		    	{{ link_to_route($feature . '.edit', 'Edit', [ $item->id ], ['class' => 'btn btn-primary'] ) }}
		    </li>

			@if ($feature !== 'user')
		    <li>
			    {!! Form::open(['url' => "$feature/$item->id", 'enctype' => 'multipart/form-data', 'class' => 'form-inline']) !!}
			        {{ Form::hidden('_method', 'DELETE') }}
			        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
			    {!! Form::close() !!} 
			</li>
			@endif
		@endif

		@if( strcmp( Route::currentRouteName(), $feature . '.index') === 0 )
			@if ($feature !== 'user')
			<li>
				{{ link_to_route($feature . '.create', 'Create New', [], ['class' => 'btn btn-primary'] ) }}
			</li>
			@endif
		@endif
	</ul>
</div>
