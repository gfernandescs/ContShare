<!DOCTYPE html>
<html lang="pt">
	<head>
		<meta charset="utf-8">
		@if(Auth::check())
			<title>{{auth()->user()->name." ".auth()->user()->last_name}}</title>
		@else
			 <title>ContShare</title>
		@endif
		<meta name="description" content="description">
		<meta name="author" content="DevOOPS">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link href="{{asset('plugins/bootstrap/bootstrap.css')}}" rel="stylesheet">
		<link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
		<link href="{{asset('plugins/jquery-ui/jquery-ui.min.css')}}" rel="stylesheet">
		<link href="//code.jquery.com/ui/1.11.4/themes/redmond/jquery-ui.css" rel="stylesheet">
		<link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
		<link href='http://fonts.googleapis.com/css?family=Righteous' rel='stylesheet' type='text/css'>
		<link href="{{asset('css/profile_style.css')}}" rel="stylesheet">
		<link href="{{asset('css/file_style.css')}}" type="text/css" media="screen" rel="stylesheet"/>
		<link href="{{asset('css/following.css')}}" rel="stylesheet"  type="text/css" media="screen" />
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<!--<script src="http://code.jquery.com/jquery.js"></script>-->
		<script src="{{asset('plugins/jquery/jquery-2.1.0.min.js')}}"></script>
		<script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
		<script src="{{asset('plugins/bootstrap/bootstrap.min.js')}}"></script>
		
		<!--Tooltip -->
		<link rel="stylesheet" type="text/css" href="plugins/tooltipster-master/dist/css/tooltipster.bundle.min.css" />
		<link rel="stylesheet" type="text/css" href="plugins/tooltipster-master/dist/css/plugins/tooltipster/sideTip/themes/tooltipster-sideTip-borderless.min.css" />
    	<script type="text/javascript" src="plugins/tooltipster-master/dist/js/tooltipster.bundle.min.js"></script>
    	<script type="text/javascript" src="plugins/tooltipster-master/tooltipster-scrollableTip-master/tooltipster-scrollableTip.min.js"></script>
		<!-- malihu-custom-scrollbar-plugin-master -->
		<link rel="stylesheet" href="plugins/malihu-custom-scrollbar-plugin-master/jquery.mCustomScrollbar.css" />
		<script src="plugins/malihu-custom-scrollbar-plugin-master/jquery.mCustomScrollbar.js"></script>
		<script src="plugins/malihu-custom-scrollbar-plugin-master/jquery.mCustomScrollbar.concat.min.js"></script>
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
				<script src="http://getbootstrap.com/docs-assets/js/html5shiv.js"></script>
				<script src="http://getbootstrap.com/docs-assets/js/respond.min.js"></script>
		<![endif]-->
	</head>
	<style>
		#n-conts{
			color: #337ab7;
			font-weight: bold;
		}
	</style>
	<script>
		function pageNotFound(){
			$("#content-profile").load("error_page.php");
		}
	</script>
<body>


@include('includes.header')
@include('includes.modalCopy')
@if(Auth::check())
	@include('includes.modalEditProfile')
@endif
<!-- Start Modal Enter  -->
<div class="modal fade" id="modalEnter" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
	<div class="modal-dialog" role="document">
		 <div class="modal-content">
		     <div class="modal-header">
		        <h4 class="modal-title" id="myModalLabel">Login</h4>
		      </div>
		      <div class="modal-body">
		        <form class="loginUser" method="post">
			    	<div class="form-group">
						<label for="email" >Email:</label>
						<input type="email" name="email" required class="form-control" id="email" placeholder="Insira seu Email">
					</div>
					<div class="form-group">
						<label for="password" >Senha:</label>
						<input type="password" name="password" required class="form-control" id="password" placeholder="Insira sua Senha">
					</div>
					  <br />
					  <div class="modal-footer">
		        		<button type="submit" class="btn btn-primary" name="entrar">Entrar</button>
		      		  </div>
				</form>
		      </div>
		 </div>
	 </div>
</div>
<!--End Modal -->
<!--Start Container-->
<div id="main" class="container-fluid sidebar-show profile">
	<div class="row">
		<!--Start Content-->
		<div id="content" class="col-xs-12 col-sm-10">
			<div id="content-profile">
				@forelse($users as $user)
				<div class="header">
					<br />
					<div class="avatar photo">
						<img src="{{asset('avatars/'.$user->avatar)}}" class="img-rounded" alt="avatar" />
					</div>
					
					<div class="info-user" >
						<h1>{{$user->name." ".$user->last_name}}</h1>
						
						@if(Auth::check() && $user->id == auth()->user()->id)
							<div class="btn-follow">
								<input id="cod_user_r" name="cod_user" type="hidden" value="{{auth()->user()->id}}"/>
								<input id="cod_follower_r" name="cod_follower" type="hidden" value="{{$user->id}}"/>
								<input id="remove" name="type" type="hidden" value="add"/>								
								<button type="button" class="btn btn-default" data-toggle="modal" data-target="#modalEdit" onclick="fillFildEdit('{{auth()->user()->name}}','{{auth()->user()->last_name}}','{{auth()->user()->avatar}}','{{auth()->user()->about}}')">
									Editar Perfil
								</button>
							</div>
							<div class="divider"></div>
						@else
							<div class="btn-follow">	
								@if($is_following['is'])
									<form action="#"  method="post" class="deleteFollower">
										{{ method_field('DELETE') }}
										{{ csrf_field() }}																
										<input id="id_follower" name="id_follower" type="hidden" value="{{$is_following['id']}}"/>	
										<button type="submit" class="btn btn-default">Seguindo
											  <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
										</button>
									</form>
								@else
									<form action="#"  method="post" class="saveFollower">
										{{ csrf_field() }}						
										<input id="id_user_s" name="id_user" type="hidden" value="{{Auth::check() ? auth()->user()->id : ''}}"/>
										<input id="id_follower_s" name="id_follower" type="hidden" value="{{$user->id}}"/>
										<input id="route" name="route" type="hidden" value="{{route('followings.store')}}"/>
										<button type="{{Auth::check() ? 'submit' : 'button'}}" class="btn btn-default">
											Seguir
											<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
										</button>
									</form>
								@endif																			
							</div>
						@endif
						<div class="about-user"> {{$user->about}} </div>
						<div style="clear: both"> </div>
						
					</div>
					<hr />
					<div class="info-f ">						
						<ul>
							<a href="{{'/groups/'.$user->id}}"  id="n-conts" class="ajax-link">
								<li>
									Conts<span class="n">{{$count_files}}</span>
								</li>
							</a>							
							<a href="{{'/'.$user->id.'/seguindo'}}" id="n-following" class="ajax-link">
								<li>
									Seguindo<span class="n">{{$count_followings}}</span>
								</li>
							</a>
							<a href="{{'/'.$user->id.'/seguidores'}}" id="n-followers" class="ajax-link">
								<li>
									Seguidores<span class="n">{{$count_followers}}</span>
								</li>
							</a>						
						</ul>
					</div>
					
				</div>
				<div id='search' style='width:50%; margin-left: 25%; margin-top: 50px'>
					<div class='input-group input-group-lg' >
						<span class='input-group-addon' id='basic-addon2' style="padding-top:0; padding-bottom:0;"><i class='fa fa-search'></i></span>
						<input type='text' id='search-conts' onkeyup='searchConts(this.value,{{$user->id}},1)' class='form-control' placeholder='Pesquisar' aria-describedby='basic-addon2'>
					</div>
				</div>
				<div class="row">
					@include('includes.messages')
					<div class='preloader' style="display: none">
                    <img width='80px' src='img/loading.gif' class='devoops-getdata' alt='preloader'/>
                </div>					
					<div id="ajax-content">
						<div class="">
							@if(session('no_ajax'))
		                        <script type="text/javascript">
		                            $(document).ready(function () { 
		                                var ajax_url = "{{session('no_ajax')}}";
		                                LoadAjaxContent(ajax_url);
		                                history.pushState('', '', ''+ajax_url+'');
		                            });
		                        </script>
		                    @else
		                        <script type="text/javascript">
		                            $(document).ready(function () {
		                                var ajax_url = "/groups/{{$user->id}}"; 
		                                /*if (ajax_url.length < 2) {
		                                    ajax_url = "/groups/{{$user->id}}"; 
		                                }*/
		                                //alert(ajax_url);
		                                LoadAjaxContent(ajax_url);
		                            });
		                        </script>
		                    @endif
						</div> 				
					</div>
				</div>
			</div>
			@empty
			@endforelse
		</div>
		<!--End Content-->
	</div>
</div>
<!--End Container-->

<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="plugins/justified-gallery/jquery.justifiedgallery.min.js"></script>
<script src="plugins/tinymce/tinymce.min.js"></script>
<script src="plugins/tinymce/jquery.tinymce.min.js"></script>
<script src="js/contShare.js"></script>
<!-- All functions for this theme + document.ready processing -->
<script src="{{asset('js/profile.js')}}"></script>
<script src="{{asset('js/search.js')}}"></script>
<script>
$(document).ready(function() {
	$('.notifi').tooltipster({
	content: 'Carregando',
	trigger: 'click',
    contentAsHTML: true,
    interactive: true,
    // 'instance' is basically the tooltip. More details in the "Object-oriented Tooltipster" section.
    functionBefore: function(instance, helper) {
        
        var $origin = $(helper.origin);
        
        // we set a variable so the data is only loaded once via Ajax, not every time the tooltip opens
        if ($origin.data('loaded') !== true) {

            $.get('notifications.php', function(data) {

                // call the 'content' method to update the content of our tooltip with the returned data
                instance.content(data);

                // to remember that the data has been loaded
                $origin.data('loaded', true);
            });
        }
    }
});

});
</script>
</body>
</html>
