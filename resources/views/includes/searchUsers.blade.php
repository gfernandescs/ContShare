<div class='search'>	
	@forelse ($users as $user) 
		<a id='link-search' href='{{url('/'.$user->id)}}'>
			<div class='search-users'>							
					<div class='avatar photo-search'>
						<img src="{{asset('avatars/'.$user->avatar)}}" class='img-rounded' alt='avatar' />
					</div>
					{{$user->name." ".$user->last_name}}																
			</div>
		</a>
	@empty
		@if($value === 0) 
            <img style="margin-left: 170px" width='50px' src='img/loading_searchUser.gif' ' alt='preloader'/>
        @else
			<p>{{$value}} - Não Encontrado</p>
		@endif
	@endforelse
</div>