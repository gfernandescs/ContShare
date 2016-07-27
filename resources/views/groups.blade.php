@extends('layouts.main')

@section('index-content')
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
	@foreach ($groups as $group)
		<div class='groups index'>
			<a class='ajax-link' href='/{{$group->group}}'> 
				<div class='group'> <p style='margin-top:9px'>{{$group->group}}</p> </div>
			</a>
		</div>			
	@endforeach
	</div>
@stop