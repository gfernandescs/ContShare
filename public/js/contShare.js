/**
 * @author Gabriel
 */

/*
 * função para pegar info do site (titulo, img etc) e criar a div de apresentação.
 */
var request 	 = new Array();
var cont 		 = 0;
var number_group = 0;
function extracturl(url,code) {
	var div   = document.getElementById(code);
	var img   = div.getElementsByTagName('img');
	var title = div.getElementsByTagName('a');

	if (url != "" && url.indexOf("://") > -1) {	
		request[cont] = $.ajax({
			type : 'post',
			url : '/fetch',
			dataType: 'json',
			data : {
				link : url,
				_token: token
			},
			success : function(response) {			
				$('.preloader').hide();				
				$(img).attr("src", response.img);
				$(title).attr("title", response.title);

				
			},
			async: true
		});
	}
	//return true
	cont ++;
			
}
function extracturlProfile(url, comment, code, group, n, cod_user,user_on, searchConts) {
	var div = "<div tabindex = '-1' class='conts file' id='" + code + "'> </div>";
	var val = url;
	var com = comment;
	var cod_file = code;
	var group = group;
	var cod_user = cod_user;
	
	//cria as divs dos links
	//caso vir do campo de pesquisa irá adicionar de acordo com a div do grupo
	if(searchConts == 0){		
		$("._"+number_group).append(div);
	}else{
		$("#files").append(div);
	}

	if (val != "" && val.indexOf("://") > -1) {
		request[cont] = $.ajax({
			type : 'post',
			url : 'extract/fetch_url_profile.php',
			data : {
				link : val,
				comment : com,
				code : cod_file,
				group: group,
				cod_user:cod_user,
				user_on:user_on
			},
			success : function(response) {

				x = document.getElementsByClassName("file");
				x[n].innerHTML = response;
				
				$('.preloader').hide(); 
				$('.toolt').tooltipster({
					side: 'bottom',
					theme: 'tooltipster-borderless'
				});
			},
			async: true
		});
	}
	cont ++;
}
//Aborta requisições 
function abort(){
	for(i=0;i < request.length; i++){
		request[i].abort();
	}	
}

/*=====================================================
	Funçoes AJAX
 =======================================================*/
	/*---------------------------
	 * 	User
	 * ----------------
	 */
/*
 * função ajax que loga um user.(usado no profile.php)
 */	
jQuery('.loginUser').submit(function(){	
	var dados = jQuery(".loginUser").serialize();
	$.ajax({
		type : 'post',
		url  : 'login/index.php',
		data : dados,
		success : function(response) {
				location.reload();				
		}
		
	});
	return false;
});
/*
 * função ajax que edita um profile user.(----Não está em uso----)
 */	
function editProfile(cod_user) {
	var name 	   = document.getElementById('name_u').value;
	var last_name  = document.getElementById('last_name_u').value;
	var name_photo = document.getElementById('name_photo').value;
	var about 	   = document.getElementById('about_u').value;
	var file 	   = document.getElementById('photo_u').files[0];

	$.ajax({
		type : 'post',
		url : 'profile.php?u_code=' + cod_user,
		data : {
			name: name,
			last_name: last_name,
			about: about,
			name_photo: name_photo,
			photo: file
		},
		success : function(response) {
				location.reload();
								
		}
	});
}

	/*---------------------------
	 * 	File
	 * ----------------
	 */

/*
 * função ajax para deletar um file.
 */
function deleteFile(id) {
	//abre um modal para confirmar.
	bootbox.confirm("Deseja Excluir?", function(result) {
		if (result) {
			var method  = "DELETE"; 
			var id_file = id;

			$.ajax({
				type : 'post',
				url : '/files/'+id,
				data : {
					id_file : id,
					_method : method,
					_token  : token
				},
				success : function(response) {
					$("#" + id_file).hide("scale", {
						direction : "left"
					}, "slow");
				}
			});
		}
	});
}

/*
 * função ajax para salvar um file.
 */
jQuery('.saveFile').submit(function(){	
	var dados = jQuery(".saveFile").serialize();
	var route = $('input[name="route"]', this).val();
 
	$.ajax({
		type : 'post',
		url : route,
		data : dados,
		success : function(response) {
			$('#modalCopy').modal('hide');
			$('#alert-success').html("Link Copiado :)").fadeIn('slow');
			$('#alert-success').delay(1500).fadeOut('slow');				
		}
	});
	return false;		
});

/*
 * função ajax para atualizar um file.
 */
jQuery('.updateFile').submit(function(){
	var dados   = jQuery(".updateFile").serialize();

	var id 	    = document.getElementById('file_id').value;
	var comment = document.getElementById('comments_up').value;
	var priv    = document.querySelectorAll('[name=priv_up]:checked');;
	

	$.ajax({
		type : 'post',
		url : '/files/'+id,
		data : dados,
		success : function(response) {
			$('#modalUpd').modal('hide');
			$('#alert-success').html("Link Editado ;)").fadeIn('slow');
			$('#alert-success').delay(1500).fadeOut('slow');
			$('#comment_'+id).html(comment);

			if(priv.length > 0){
				$('#'+id).css({borderTop:"2px solid red", borderBottom: "2px solid red" });
			}else{
				$('#'+id).css({borderTop:"", borderBottom: "" });
			}
				
		}
	});
	return false;
});

/*
 * função ajax para atualizar titulo de um grupo.
 */
jQuery('.updateGroup').submit(function(){
	var dados = jQuery(".updateGroup").serialize();
	console.log(dados)	
	/*$.ajax({
		type : 'post',
		url  : 'index.php',
		data : dados,
		success : function(response) {
				location.reload();				
		}
	});*/
	return false;
});

	/*---------------------------
	* 	Followers
	* ----------------
	*/
	
/*
 * função ajax para salvar um novo seguidor.
 */
/*function saveFollower(route,id_user,id_follower) {
	console.log(route,id_user,id_follower);
	$.ajax({
		type : 'post',
		url : route,
		data : {
			id_user: id_user,
			id_follower: id_follower
		},
		success : function(response) {
				//location.reload();				
		}
	});
}*/
jQuery('.saveFollower').submit(function(){
	var dados = jQuery(this).serialize();
	var route = $('input[name="route"]', this).val();

	$.ajax({
		type : 'post',
		url  : route,
		data : dados,
		success : function(response) {
				location.reload();				
		}
	});
	return false;
});

/*
 * função ajax para deletar um seguidor.
 */
jQuery('.deleteFollower').submit(function(){
	var dados = jQuery(this).serialize(); 
	var id 	  = $('input[name="id_follower"]', this).val();

	$.ajax({
		type : 'post',
		url  : 'followings/'+id,
		data : dados,
		success : function(response) {
				location.reload();				
		}
	});
	return false;
});

/*
 * pega valor do Dropdowns e coloca no input text (modal save)(modal copy)
 */

function getDropdown(id) {
	document.getElementById('group_s').value = id;
}
/*
 * pega valor do Dropdowns e coloca no input text (modal update)
 */
function getDropdownUp(id) {
	document.getElementById('group_up').value = id;
}

/*
 * Preenche os campos do modal update(index.php)
 */
function fillFildUpdate(id){
	var div  	 = document.getElementById(id);
	var url 	 = div.getElementsByTagName('a');
	var comment  = div.getElementsByTagName('p');
	var input 	 = div.getElementsByTagName('input');

	document.getElementById('url_up').value  = url[0].href;
	document.getElementById('comments_up').innerHTML = comment[0].innerHTML;
	document.getElementById('group_up').value  = (input[0].value);
	document.getElementById('file_id').value  = (id);
	
	if(input[1].value == "s"){		
		document.getElementById("priv_up").checked = true;
	}else{
		document.getElementById("priv_up").checked = false;
	}
}
/*
 * Preenche os campos do modal editProfile(profile.php)
 */
function fillFildEdit(name,last_name,avatar,about){
	document.getElementById('name_u').value  = name;
	document.getElementById('last_name_u').value  = last_name;
	document.getElementById('about_u').value  = (about);
	document.getElementById('name_photo').value  = (avatar);
}
/*
 * Preenche os campos do modal copyFile(profile.php)
 */
function fillFildCopy(id){
	var div  	 = document.getElementById(id);
	var url 	 = div.getElementsByTagName('a');
	var comment  = div.getElementsByTagName('p');
	var group 	 = div.getElementsByTagName('input');

	document.getElementById('url').value  = url[0].href;
	document.getElementById('comments').value = comment[0].innerHTML;
	document.getElementById('group_s').value  = (group[0].value);
	document.getElementById('txcode').value  = (id);
}

$(document).ready(function () {	
	//RadioButton
	$('#all_contents').on('click', function(e) {
		if ($(this).hasClass('ajax-link')) {
			e.preventDefault();
			if ($(this).hasClass('add-full')) {
				$('#content').addClass('full-content');
			} else {
				$('#content').removeClass('full-content');
			}
			var url = "all_contents.php";
			//window.location.hash = url;
			LoadAjaxContent(url);
		}
		if ($(this).attr('href') == '#') {
			e.preventDefault();
		}
	});
	//RadioButton
	$('#group').on('click', function(e) {
		if ($(this).hasClass('ajax-link')) {
			e.preventDefault();
			if ($(this).hasClass('add-full')) {
				$('#content').addClass('full-content');
			} else {
				$('#content').removeClass('full-content');
			}
			var url = "contents.php";
			//window.location.hash = url;
			LoadAjaxContent(url);
		}
		if ($(this).attr('href') == '#') {
			e.preventDefault();
		}
	});

});


/*
 * Botões menu(sidebar && sidebar-navbar)
 */

//Botão Inicio
$('.index').on('click', 'a', function(e) {
    e.preventDefault();
    abort();	
    $('#files').remove();
    LoadAjaxContent('/groups');
    history.pushState('', '', ''+'/groups'+'');
});

//Botão pesquisar
$('#nav-searchconts').on('click', 'a', function(e) {
    e.preventDefault();
    /*$('#top-panel').remove();
    $('.groups').remove();
    $('.search-conts').show();
    $('#input-search-conts').focus(); 
    $('#sidebar-navbar').css( "margin-top", "0" );
    $('#sidebar-navbar').css( "height", "50px" );
    $('#main').css( "margin-top", "21px" );*/
    LoadAjaxContent('/searchConts');
    history.pushState('', '', ''+'/searchConts'+'');    
});

//Botão notificações
$('#nav-notifications').on('click', 'a', function(e) {
    e.preventDefault();
    LoadAjaxContent('/notificationUsers');
    history.pushState('', '', ''+'/notificationUsers'+'');    
});

/*
 * Função que faz funcionar botão voltar do navegador
 */
/*window.onhashchange = function(e) {
	var pagina = window.location.hash.substring(1);
	if(pagina.length==0){
		LoadAjaxContent("/groups");
	}else{
		LoadAjaxContent(pagina);
	}	  	
};*/
window.addEventListener('popstate', function(e) {
	var character = e.state;
 	if (character == null) {
	   LoadAjaxContent("/groups");
	} else {  	
	    LoadAjaxContent(location.href);
	}

});