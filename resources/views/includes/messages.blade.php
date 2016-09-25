@if(Session::has('success'))
	<div class="alert alert-success" role="alert">
		<strong>Sucesso:</strong>{{Session::get('success')}}
	</div>
@endif

<style type="text/css">
	#alert-success{
		width:800px;
		z-index:100;
		display:none;
		font-size: 20px;
		text-align: center;
	}
</style>
<div class="alert alert-success" id="alert-success" role="alert" >
aaaaaa
</div>

<script>
	var w = window.innerWidth
	|| document.documentElement.clientWidth
	|| document.body.clientWidth;

	var h = window.innerHeight
	|| document.documentElement.clientHeight
	|| document.body.clientHeight;

	var x = document.getElementById("alert-success");
	x.style.top =  h/2-50/2+"px";
	x.style.left = w/2-700/2+"px";
	x.style.position = "fixed";
</script>