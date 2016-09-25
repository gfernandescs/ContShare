<script >
		var token = '{{Session::token()}}';
</script>
<div class="row-fluid">

	<div id='files' class='container-files'>

		@forelse ($files as $file)	
			
			@if($g != $file->group )

				{{--*/ @$number_group +=1   /*--}}

				@if($number_group > 1)
					</div>
				@endif
				
				<div class='_{{$number_group}}' style='overflow:hidden; margin-top: 25px;padding-bottom:10px;padding-left:15px;'>
					@if(!isset($profile) && isset($group))
						@include('includes.modalEditGroup')
						<button type='button' class='config_group' data-toggle='modal' data-target='#modalConfig'>
							<i class='fa fa-cog' aria-hidden='true'></i>
						</button>
					@endif
					<h3 class='title-group' id='title-group'>{{$file->group}}</h3>
			@endif

			{{--*/ @$g = $file->group  /*--}}

					<div class="conts file" tabindex="-1" id={{$file->id}} 
							style="{{$file->private == 's' ? 'border-bottom: 2px solid red;border-top: 2px solid red;' : ''}}">
						@if(isset($profile) && !$profile)
							<button class='btn btn-info btn-lg' id='btn-delete' data-toggle='modal' data-target='#modalCopy' onclick='fillFildCopy({{$file->id}})'>
								<span class='glyphicon glyphicon-star-empty'></span>
							</button>
						@elseif(isset($profile) && $profile)
						@else
							<button class='btn btn-info btn-lg' id='btn-delete' onclick='deleteFile({{$file->id}})'>
								<span class='glyphicon glyphicon-remove'></span> 
							</button>
							<button class='btn btn-info btn-lg' id='btn-update' data-toggle='modal' data-target='#modalUpd' 
									onclick='fillFildUpdate({{$file->id}})'>Editar
								<span class='glyphicon glyphicon-pencil'></span>
							</button>
						@endif
						   
						<input type='hidden' id='txgroup' value='{{$file->group}}'>
						<input type='hidden' id='private' value='{{$file->private}}'>	 
						<a href="{{$file->url}}" target="_blank">
							<div class='img-file'><img class='img' ></div>
						</a>
						<div class='comment' id="comment_{{$file->id}}"><p>{{$file->comment}}</p></div>
					</div>
			<script type="text/javascript">
				
				
			extracturl('{{$file->url}}','{{$file->id}}')
			</script>

			
					
		@empty
			<script>$('.preloader').hide();</script>
			<div class='no-have'>Não Encontrado</div>
		@endforelse
	</div>
</div>
<script type="text/javascript">
	/*
	 * função ajax para atualizar titulo de um grupo.
	*/
	jQuery('.updateGroup').submit(function(){
		var dados = jQuery(".updateGroup").serialize();
		var id 	  = 0;
		var title = document.getElementById('titulo').value; 
		$.ajax({
			type : 'post',
			url  : '/files/'+id,
			data : dados,
			success : function(response) {
				$('#modalConfig').modal('hide');
				$('#alert-success').html("Grupo Editado ;)").fadeIn('slow');
				$('#alert-success').delay(1500).fadeOut('slow');
				document.getElementById('title-group').innerHTML = title;				
			}
		});
		return false;
	});
</script>
@if(isset($id_file))
	<script>
	    setTimeout(function() { $('#{{$id_file}}').focus(); }, 100);
	</script>
@endif