{{Date::setLocale('pt')}}
<head>
	<style>	
		.photo-notif {
			float: left;
			width: 15%;
			height: 55px;
			overflow: hidden;
		}
		.photo-notif > img {
			width: 100%;
			height: 100%;
			border-radius: 0;
		}
		#notifications-list {
			height: 500px;
			width: 420px;
			overflow-x: hidden;
		}
		#notifications-list a {
			text-decoration: none;
			color: #525252;
		}
		.notification {
			border-bottom: 1px solid #CCC;
			padding: 10px 15px 0 5px;
			margin: 0;
		}
		.notification:hover {
			background: #DBDBDB;
		}
		.content {
			margin-bottom: 5px;
		}
		.description {
			margin-left: 60px;
			font-size: 14px;
		}
		.date-notification{
			color: #999;
			margin-left: -60px
		}
		.tooltipster-sidetip .tooltipster-box {
			background: #ebebeb;
			border: 1px solid #525252;
			box-shadow: 0 3px 8px rgba(0, 0, 0, .25);
		}
		.tooltipster-sidetip .tooltipster-content{padding: 6px 1px;}
		.tooltipster-sidetip.tooltipster-bottom .tooltipster-arrow-background{border-bottom-color: #ebebeb}
		.tooltipster-sidetip.tooltipster-bottom .tooltipster-arrow-border{border-bottom-color: #525252}	

		#nav-notifications{
			background-color: rgba(236, 227, 227, 0.87);
			border-radius: 3px;
		}
		#nav-notifications a{
			color: #2f6798;
		}

		/*Mobile*/
		@media (max-width: 767px){
			#notifications-list {
			height: 100%;
			width: 100%;
		}
		.description {
			margin-left: 17%;
			font-size: 14px;
		}
		.date-notification{
			color: #999;
			margin-left: -16%;
		}
		@media (min-width: 500px){
			.photo-notif{
				height: 70px;
			}
		}
		}	
	</style>
</head>
<div id="notifications-list" >
	@forelse ($notifications as $notification)
		<a href="{{'/'.$notification['user']->id.'/grupo/'.$notification['file']->group.'/'.$notification['file']->id}}">
			<div class="notification" >
				<div class="content">
					<div class='avatar photo-notif'>
						<img src="{{asset('avatars/'.$notification['user']->avatar)}}" class="img-rounded" alt="avatar" />
					</div>
					<div class="description">
						<b>{{$notification['user']->name." ".$notification['user']->last_name}}</b>
						<small class="time">- Adicionou um novo link: </small>
						<div style="margin-top: 5px;font-size: 12px;">
							<b>{{$notification['file']->comment}}</b>
							<br />
							{{substr($notification['file']->url, 0, 45)."..."}}
							<div class="date-notification">
								@if(Date::now()->format('Ymd')*12 > Date::parse($notification['notification']->date)->format('Ymd')*12)						
									{{Date::parse($notification['notification']->date)->format('l j F Y H:i')}}
								@else
									{{Date::parse($notification['notification']->date)->ago()}}
								@endif							
							</div>
						</div>
					</div>
				</div>
			</div> 
		</a>	
	@empty
		<div class='no-have'>Sem notificações </div>
	@endforelse
</div>
<script>
$(document).ready(function() {
	$("#notifications-list").mCustomScrollbar({
		theme:"minimal-dark",
	});
});
</script>