<div id="sidebar-left" class="col-xs-2 col-sm-2">
	<ul class="nav main-menu">
		<li title="Início" class="index">
			<a href="/groups" >
			<i class="glyphicon glyphicon-home"></i>
			<span class="hidden-xs">Início</span>
			</a>
		</li>
				
		<li title="Perfil">
			<a href="{{url('/'.auth()->user()->id)}}" >
			<i class="glyphicon glyphicon-user"></i>
			<span class="hidden-xs">Perfil</span>
			</a>
		</li>
		<li title="Novo Link">
			<a href="#"  data-toggle="modal" data-target="#modalSave">
			<i class="glyphicon glyphicon-plus"></i>
			<span class="hidden-xs">Novo link</span>
			</a>
		</li>
		@if($followings)
			<hr />
			<p style='margin-left: 19px;color:#0d9eb5;font-weight:bold'>Seguindo</p>
		@endif
		@forelse ($followings as $following)			
			<li style="margin-bottom: 10px" title="{{$following->name.' '.$following->last_name}}">
				<a href='{{url('/'.$following->id)}}'>
					<div class='avatar-uf'>
						<img src="{{asset('avatars/'.$following->avatar)}}"  alt="avatar" />
					</div>
					<div>								
						@if(( strlen($following->name) + strlen($following->last_name) > 16))
							{{substr($following->name." ".$following->last_name, 0, 16)."..."}}
						@else
							{{$following->name." ".$following->last_name}}
						@endif						
					</div>
				</a>			
			</li>
		@empty
		@endforelse
	</ul>
</div>

@include('includes.modalSave')
