var req;
var xhr = null;
 
// Função para pesquisa de Usuarios
function searchUsers(value) {
	if(xhr != null){
		xhr.abort();
	}
	xhr = $.ajax({
		url: "/searchUsers/"+value,
		success: function(data) {
			$("#result").html(data);
		}
	});
	/*if(xhr.readyState == 1) {
		document.getElementById('result').innerHTML = "<div class='search'><img style='margin-left: 170px' width='50px' src='img/loading_searchUser.gif' ' alt='preloader'/></div>";
	}*/
 
}
// Função para pesquisa de Links
function searchConts(value,id_user,profile) {
	$('.preloader').show();

	if(value == ""){
		if(xhr != null){
			abort();
			xhr.abort();
		}
		if(profile){
			xhr = $.ajax({
		        url: '/groups/'+id_user,
		        success: function(data) {
		        	$('.preloader').hide();
		            $("#ajax-content").html(data);
		        }
        	});
			
		}else{		
	        xhr = $.ajax({
		        url: '/groups',
		        success: function(data) {
		        	$('.preloader').hide();
		            $("#ajax-content").html(data);
		        }
        	});
		}
	}else{		
		if(xhr != null){
			abort();
			xhr.abort();
		}
		if(profile){
			if(location.pathname != ""){
 				window.history.pushState('Object', 'ContShare', '/'+id_user);
 			}
			xhr = $.ajax({
		        url: '/searchConts/'+id_user+'/'+value+'/1',
		        success: function(data) {
		            $("#ajax-content").html(data);
		        }
        	}); 
		}else{
			if(location.pathname != ""){
 				window.history.pushState('Object', 'ContShare', '/');
 			}
		    xhr = $.ajax({
			    url: '/searchConts/'+id_user+'/'+value,
			    success: function(data) {
			        $("#ajax-content").html(data);
			    }
	        });
		    
		}		       
	}
}

function searchContsMobile(value){
	$('.mobile').show();
	if(xhr != null){
		abort();
		xhr.abort();
	}
	xhr = $.ajax({
		url: '/searchConts/'+-1+'/'+value,
			success: function(data) {
			$("#ajax-content-mobile").html(data);
		}
	});
}