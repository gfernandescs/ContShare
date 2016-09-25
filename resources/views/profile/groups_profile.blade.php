@if (count($groups) > 0)
	<div class="row-fluid">
	@foreach ($groups as $group)
		
		<div class='groups index'>
			<a   class='{{Auth::check() ? 'ajax-link' : 'off'}}' href='{{$id_user}}/grupo/{{$group->group}}'> 
				<div class='group'> <p style='margin-top:9px'>{{$group->group}}</p> </div>
			</a>
		</div>			
	@endforeach
	</div>
@else
	<div class='no-have'>não há links para mostrar</div>
@endif
<script >
	$('.groups').on('click', 'a', function(e) {
		if ($(this).hasClass('ajax-link')) {
			e.preventDefault();
			$('.preloader').show();
			var url = $(this).attr('href');
			window.location.hash = url;
			//window.history.pushState('Object', 'Categoria JavaScript', ''+url+'');
			LoadAjaxContent(url);
			//e.preventDefault();
			//window.history.pushState({url: "" + $(this).attr('href') + ""}, $(this).attr('title') , $(this).attr('href'));	 
		}else{
			e.preventDefault();
			$('#modalEnter').modal('show'); 
		}
		if ($(this).attr('href') == '#') {
			e.preventDefault();
		}
	});
</script>