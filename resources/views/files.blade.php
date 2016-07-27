
	<script >
		var token = '{{Session::token()}}';
	</script>
	<div id='search' class="search-conts">
		<div class='input-group input-group-lg'>
			<span class='input-group-addon' id='basic-addon2' style="padding-top:0; padding-bottom:0;"><i class='fa fa-search'></i></span>
			<input type='text' id='search-conts' onkeyup='searchConts(this.value)' class='form-control' placeholder='Pesquisar' aria-describedby='basic-addon2'>
		</div>
	</div>
	<div class="row-fluid">
		<script>
			@foreach($files as $file)
				extracturl('{{$file->url}}','{{$file->cod_file}}')
			@endforeach
		</script>
		<div id='files' class='container-files'>
			@foreach ($files as $file)		
				<div class="conts file" >
					<a class='btn btn-info btn-lg' id='btn-delete' onclick='deleteFile($cod_file)'>
					<span class='glyphicon glyphicon-remove'><span> 
					</a>
				    <a class='btn btn-info btn-lg' id='btn-update' data-toggle='modal' data-target='#modalUpd' onclick='fillFildUpdate($cod_file)'>Editar
				    <span class='glyphicon glyphicon-pencil'></span>
				    </a>
				   
				    <input type='hidden' id='txgroup' value='{{$file->group}}'>
				    <input type='hidden' id='private' value='{{$file->private}}'>	 
					<a href="{{$file->url}}">
						<div class='img-file'><img class='img' id="{{$file->cod_file}}" alt='Responsive image'></div>
					</a>
					<div id='comment'><p>{{$file->comment}}</p></div>
				</div>		
			@endforeach
	</div>
