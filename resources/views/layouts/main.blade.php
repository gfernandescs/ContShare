<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
        <title>ContShare</title>
        <meta name="description" content="description">
        <meta name="author" content="DevOOPS">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{asset('plugins/bootstrap/bootstrap.css')}}" rel="stylesheet">
        <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
        <link href="{{asset('plugins/jquery-ui/jquery-ui.min.css')}}" rel="stylesheet">
        <link href="//code.jquery.com/ui/1.11.4/themes/redmond/jquery-ui.css" rel="stylesheet">
        <link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
        <link href='http://fonts.googleapis.com/css?family=Righteous' rel='stylesheet' type='text/css'>
        <link href="{{asset('css/style.css')}}" rel="stylesheet">
        
        <script src="{{asset('plugins/jquery/jquery-2.1.0.min.js')}}"></script>
        
        <link rel="stylesheet" href="{{asset('css/file_style.css')}}" type="text/css" media="screen" /> 
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
<body>
	@include('includes.header')
	<div id="main" class="container-fluid">
		<div class="row">
            @include('includes.sidebar')
			<div id="content" class="col-xs-12 col-sm-10">
                @include('includes.messages')
                <div id='search' class="search-conts">
                    <div class='input-group input-group-lg'>
                        <span class='input-group-addon' id='basic-addon2' style="padding-top:0; padding-bottom:0;"><i class='fa fa-search'></i></span>
                        <input type='text' id='search-conts' onkeyup='searchConts(this.value)' class='form-control' placeholder='Pesquisar' aria-describedby='basic-addon2'>
                    </div>
                </div>
                <div class='preloader' style="display: none">
                    <img width='80px' src='img/loading.gif' class='devoops-getdata' alt='preloader'/>
                </div>
                 
                <div id="ajax-content">                     
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
                                var ajax_url = location.pathname;
                                if (ajax_url.length < 2) {
                                    ajax_url = '/groups'; 
                                }
                                LoadAjaxContent(ajax_url);
                            });
                        </script>
                    @endif
                </div>			
			</div>
		</div>
	</div>
    @include('includes.modalUpdate')
<script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="{{asset('plugins/bootstrap/bootstrap.min.js')}}"></script>
<script src="plugins/bootbox/bootbox.min.js"></script>
<script src="plugins/bootstrap-validator-master/dist/validator.min.js"></script>
<!-- All functions for this theme + document.ready processing -->
<script src="{{asset('js/devoops.js')}}" ></script>
<script src="{{asset('js/ContShares.js')}}"></script>
<script src="{{asset('js/search.js')}}"></script>
<script>
    var x = document.getElementById("search");

    x.addEventListener("focus", function( event ) {
      document.getElementById("result").style.display = "inline";     
    }, true);
    x.addEventListener("blur", function( event ) {
      setTimeout(function() { document.getElementById("result").style.display = "none"; }, 100);
    }, true);
</script>
</body>
</html>