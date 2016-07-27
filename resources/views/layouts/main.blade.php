<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
        <title>ContShare</title>
        <meta name="description" content="description">
        <meta name="author" content="DevOOPS">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="plugins/bootstrap/bootstrap.css" rel="stylesheet">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link href="plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/redmond/jquery-ui.css">
        <link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
        <link href='http://fonts.googleapis.com/css?family=Righteous' rel='stylesheet' type='text/css'>
        <link href="css/style.css" rel="stylesheet">
        
        <script src="plugins/jquery/jquery-2.1.0.min.js"></script>
        <script src="js/ContShares.js"></script>
        <link rel="stylesheet" href="css/file_style.css" type="text/css" media="screen" /> 
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
                <div id="ajax-content">
                    <div class='preloader' style="display:none">
                        <img width='80px' src='img/loading.gif' class='devoops-getdata' alt='preloader'/>
                    </div> 
                    @yield('index-content')
                </div>			
			</div>
		</div>
	</div>
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="plugins/bootstrap/bootstrap.min.js"></script>
<script src="plugins/bootbox/bootbox.min.js"></script>
<script src="plugins/bootstrap-validator-master/dist/validator.min.js"></script>
<!-- All functions for this theme + document.ready processing -->
<script src="js/devoops.js" ></script>
<script src="js/search.js"></script>
</body>
</html>