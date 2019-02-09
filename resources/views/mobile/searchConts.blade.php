 <style type="text/css">
 	.mobile{
 		top:80px;
 	}
 	#nav-searchconts{
 		background-color: rgba(236, 227, 227, 0.87);
		border-radius: 3px;
 	}
	#nav-searchconts a{
		color: #2f6798;
	}
 </style>

 <div id='search' class="search-conts" style="display:block">
    <div class='input-group input-group-lg'>
        <span class='input-group-addon' id='basic-addon2' style="padding-top:0; padding-bottom:0;"><i class='fa fa-search'></i></span>
        <input type='text' id='input-search-conts-mobile' onkeyup='searchContsMobile(this.value)' class='form-control' placeholder='Pesquisar' aria-describedby='basic-addon2'>
    </div>
</div>

<div class='preloader mobile' style="display: none">
    <img width='80px' src='img/loading.gif' class='devoops-getdata' alt='preloader'/>
</div> 

<div id="ajax-content-mobile"></div>
<script >
    $('#input-search-conts-mobile').focus();
</script>