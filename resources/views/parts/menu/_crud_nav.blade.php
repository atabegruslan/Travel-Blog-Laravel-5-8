<div class='row'>
	<ul class="list-inline">
		@if( strcmp( Route::currentRouteName(), $feature . '.edit') === 0 )
			@if (auth()->user()->can($feature . '.read'))
			<li>
		    	{{ link_to_route($feature . '.show', 'Back', [ $item->id ], ['class' => 'btn btn-primary'] ) }}
		    </li>
		    @endif
		@endif

		@if (auth()->user()->can($feature . '.read'))
		<li>
			{{ link_to_route($feature . '.index', 'View All', [], ['class' => 'btn btn-primary'] ) }}
		</li>
		@endif

		@if( strcmp( Route::currentRouteName(), $feature . '.show') === 0 )
			@if (auth()->user()->can($feature . '.update'))
			<li>
		    	{{ link_to_route($feature . '.edit', 'Edit', [ $item->id ], ['class' => 'btn btn-primary'] ) }}
		    </li>
		    @endif

			@if ($feature !== 'user' && auth()->user()->can($feature . '.delete'))
		    <li>
			    {!! Form::open(['url' => "$feature/$item->id", 'enctype' => 'multipart/form-data', 'class' => 'form-inline']) !!}
			        {{ Form::hidden('_method', 'DELETE') }}
			        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
			    {!! Form::close() !!} 
			</li>
			@endif
		@endif

		@if( strcmp( Route::currentRouteName(), $feature . '.index') === 0 )
			@if ($feature !== 'user' && auth()->user()->can($feature . '.create'))
			<li>
				{{ link_to_route($feature . '.create', 'Create New', [], ['class' => 'btn btn-primary'] ) }}
			</li>
			@endif
		@endif
	</ul>
</div>
