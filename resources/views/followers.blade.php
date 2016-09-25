<style>
	#n-followers{
		color: #337ab7;
		font-weight: bold;
	}
	#n-conts{
		color: #666;
		font-weight: normal;
	}
</style>
<div class="row-fluid">
	@forelse ($followers as $follower)		
		<div class='followers' id='followers'>
				<div class='pull-left' style='width:100%;'>
					<a href='{{url('/'.$follower->id)}}'>
						<div class='avatar photo-foll'>
							<img src="{{asset('avatars/'.$follower->avatar)}}" class="img-rounded" alt="avatar" />
						</div>
						<div class='name-foll'>
						{{$follower->name." ".$follower->last_name}}
						</div>
					</a>
					<div class='conts-foll'>
						Conts: {{$count_files[$follower->id]}}
					</div>
				</div>
				@if(Auth::check() && $follower->id == auth()->user()->id)
							
				@else
					@if(in_array($follower->id, $user_on_folls))											
						<form action="#"  method="post" class="deleteFollower_followers">
							{{ method_field('DELETE') }}
							{{ csrf_field() }}																							
							<input name="route" type="hidden" value="{{route('followings.destroy', ['id' => $is_following[$follower->id]])}}"/>	
							<button type="submit" class="btn btn-default">
								Seguindo<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
							</button>
						</form>
					@else							
						<form action="#"  method="post" class="saveFollower_followers">
							{{ csrf_field() }}						
							<input id="id_user_s" name="id_user" type="hidden" value="{{Auth::check() ? auth()->user()->id : ''}}"/>
							<input id="id_follower_s" name="id_follower" type="hidden" value="{{$follower->id}}"/>
							<input name="route" type="hidden" value="{{route('followings.store')}}"/>
							<button type="{{Auth::check() ? 'submit' : 'button'}}" class="btn btn-default">
								Seguir<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
							</button>
						</form>															
					@endif
				@endif
				</div>			
	@empty
		<div class='no-have'>Não tem seguidores</div>
	@endforelse
</div>
<script type="text/javascript">

jQuery('.deleteFollower_followers').submit(function(){
	var dados = jQuery(this).serialize();
	var route = $('input[name="route"]', this).val();
		
	$.ajax({
		type : 'post',
		url  : route,
		data : dados,
		success : function(response) {
				location.reload();				
		}
	});
	return false;
});

jQuery('.saveFollower_followers').submit(function(){
	var dados = jQuery(this).serialize();
	var route = $('input[name="route"]', this).val();	
	$.ajax({
		type : 'post',
		url  : route,
		data : dados,
		success : function(response) {
				location.reload();				
		}
	});
	return false;
});
</script>