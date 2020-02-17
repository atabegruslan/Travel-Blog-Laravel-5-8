<div class='row'>
	<ul class="list-inline">
		@if( strcmp( Route::currentRouteName(), 'user.edit') === 0 )
			<li>
		    	{{ link_to_route('user.show', 'Back', [ $param->id ], ['class' => 'btn btn-primary'] ) }}
		    </li>
		@endif

		<li>
			{{ link_to_route('user.index', 'View All', [], ['class' => 'btn btn-primary'] ) }}
		</li>

		@if( strcmp( Route::currentRouteName(), 'user.show') === 0 )
			<li>
		    	{{ link_to_route('user.edit', 'Edit', [ $param->id ], ['class' => 'btn btn-primary'] ) }}
		    </li>
		@endif

	</ul>
</div>
