@if (count($groups) > 0)
	<div class="row-fluid">
	@foreach ($groups as $group)
		
		<div class='groups {{$is_profile ? 'groups_profile' : 'groups_index'}}'>
			<a class='{{Auth::check() ? 'ajax-link' : 'off'}}'  
				href="{{$is_profile == 0 ? 'grupo/'.$group->group : $id_user.'/grupo/'.$group->group}}">
				<div class='group'> <p style='margin-top:9px'>{{$group->group}}</p> </div>
			</a>
		</div>			
	@endforeach
	</div>
@else
	<div class='no-have'>{{$is_profile == 0 ? 'Salve um Link!' : 'Não há links para mostrar'}}</div>
@endif
<script >
	$('.groups').on('click', 'a', function(e) {
		if ($(this).hasClass('ajax-link')) {
			e.preventDefault();
			$('.preloader').show();
			var url = $(this).attr('href');
			//window.location.hash = url;
			LoadAjaxContent(url);
			history.pushState('', '', ''+url+'');	 
		}else{
			e.preventDefault();
			$('#modalEnter').modal('show'); 
		}
		if ($(this).attr('href') == '#') {
			e.preventDefault();
		}
	});
</script>