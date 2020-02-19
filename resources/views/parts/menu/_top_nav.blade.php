<div class='row'>
	<ul class="list-inline col-md-12">
		<li>
			<a class="btn btn-link" href="{{ url('/') }}">Home</a>
		</li>

		<li>
			{{ link_to_route('entry.index', 'Places', [], ['class' => 'btn btn-link'] ) }}
		</li>

		<li>
			{{ link_to_route('region.index', 'Regions', [], ['class' => 'btn btn-link'] ) }}
		</li>

		@auth
			@if (auth()->user()->hasRole('Admin'))
				<li>
					{{ link_to_route('user.index', 'Users', [], ['class' => 'btn btn-link'] ) }}
				</li>

				<li>
					{{ link_to_route('role.index', 'Roles', [], ['class' => 'btn btn-link'] ) }}
				</li>

				<li>
					<a class="btn btn-link" href="{{ url('/log') }}">Logs</a>
				</li>
			@endif
		@endauth

		<li>
			<a class="btn btn-link" href="{{ url('android') }}">Android</a>
		</li>

		<li>
			<a class="btn btn-link" href="{{ url('contact') }}">Contact</a>
		</li>

		@auth
			<li id="notices">
				<div class="dropdown">

					<button 
						class="dropbtn btn btn-link" 
						onclick="markNotificationsAsRead('{{ count(auth()->user()->unreadNotifications) }}')"
					>
						<span class="glyphicon glyphicon-globe"></span> 
						Notifications 
						<span class="badge">{{ count(auth()->user()->unreadNotifications) }}</span>
					</button>

					<div class="dropdown-content">
						@foreach(auth()->user()->unreadNotifications as $notification)
							<a href="{{ $notification->data['url'] }}">{{ $notification->data['name'] }}</a>
						@endforeach
					</div>
					
				</div>     
			</li>
		@endauth

		<li id="auth">
            @if (Auth::guest())
				<div class="dropdown">
					<button class="dropbtn btn btn-link">Login</button>
					<div class="dropdown-content">
						<a href="{{ route('register') }}">Register</a>
						<a href="{{ route('login') }}">Login</a>
					</div>
				</div>     
            @else
				<div class="dropdown">
					<button class="dropbtn btn btn-link">
						<a href="{{ url('user/' . Auth::user()->id) }}">
							{{ Auth::user()->name }}'s Account
						</a>
					</button>
					<div class="dropdown-content">
	                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>

	                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
	                        {{ csrf_field() }}
	                    </form>		
	                </div>
				</div>                 
			@endif				
		</li>
	</ul>
</div>
