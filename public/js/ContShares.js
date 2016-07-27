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
				//console.log(response);
				$('.preloader').hide();
					$("#"+code).attr("src", response.img);

				

			},
			async: true
		});
	}
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
	//caso vir do campo pesquisa add de acordo com a div do grupo
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
function deleteFile(cod_file) {
	//abri um modal para confirmar.
	bootbox.confirm("Deseja Excluir?", function(result) {
		if (result) {
			var id_file = cod_file;

			$.ajax({
				type : 'post',
				url : 'index.php',
				data : {
					cod_file : cod_file
				},
				success : function(response) {
					$("#" + cod_file).hide("scale", {
						direction : "left"
					}, "slow");
					//$( "#"+cod_file).remove();
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
	$.ajax({
		type : 'post',
		url : 'index.php',
		data : dados,
		success : function(response) {
				location.reload();				
		}
	});
	return false;		
});

/*
 * função ajax para atualizar um file.
 */
jQuery('.updateFile').submit(function(){
	var dados = jQuery(".updateFile").serialize();	
	$.ajax({
		type : 'post',
		url : 'index.php',
		data : dados,
		success : function(response) {
				location.reload();				
		}
	});
	return false;
});

/*
 * função ajax para atualizar titulo de um grupo.
 */
jQuery('.updateGroup').submit(function(){
	var dados = jQuery(".updateGroup").serialize();	
	$.ajax({
		type : 'post',
		url  : 'index.php',
		data : dados,
		success : function(response) {
				location.reload();				
		}
	});
	return false;
});

	/*---------------------------
	* 	Followers
	* ----------------
	*/
	
/*
 * função ajax para salvar um novo seguidor.
 */
function saveFollower(cod_user,cod_follower) {
	$.ajax({
		type : 'post',
		url : 'profile.php',
		data : {
			cod_user_s: cod_user,
			cod_follower_s: cod_follower
		},
		success : function(response) {
				location.reload();				
		}
	});
}

/*
 * função ajax para deletar um seguidor.
 */
function deleteFollower(cod_user,cod_follower) {
	//var cod_user     = document.getElementById('cod_user_r').value;
	//var cod_follower = document.getElementById('cod_follower_r').value;
	
	//var cod_follower = document.getElementById("followers");
	//var name = cod_follower.getElementsByTagName('input');
	
	$.ajax({
		type : 'post',
		url : 'profile.php',
		data : {
			cod_user_r: cod_user,
			cod_follower_r: cod_follower
		},
		success : function(response) {
				location.reload();				
		}
	});
}



/*
 * pega valor do Dropdowns e coloca no input text (modal save)(modal copy)
 */

function getDropdown(id) {
	document.getElementById('groupsc').value = id;
}
/*
 * pega valor do Dropdowns e coloca no input text (modal update)
 */
function getDropdownUp(id) {
	document.getElementById('groupup').value = id;
}

/*
 * Preenche os campos do modal update(index.php)
 */
function fillFildUpdate(cod_file){
	var div  	 = document.getElementById(cod_file);
	var url 	 = div.getElementsByTagName('a');
	var comment  = div.getElementsByTagName('p');
	var input 	 = div.getElementsByTagName('input');

	document.getElementById('urlup').value  = url[2].href;
	document.getElementById('commup').value = comment[0].innerHTML;
	document.getElementById('groupup').value  = (input[0].value);
	document.getElementById('txcode').value  = (cod_file);
	
	if(input[1].value == "s"){		
		document.getElementById("privateup").checked = true;
	}else{
		document.getElementById("privateup").checked = false;
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
function fillFildCopy(cod_file){
	var div  	 = document.getElementById(cod_file);
	var url 	 = div.getElementsByTagName('a');
	var comment  = div.getElementsByTagName('p');
	var group 	 = div.getElementsByTagName('input');

	document.getElementById('url').value  = url[1].href;
	document.getElementById('comm').value = comment[0].innerHTML;
	document.getElementById('groupsc').value  = (group[0].value);
	document.getElementById('txcode').value  = (cod_file);
}

$(document).ready(function () {
	/*
	 * Função que add no corpo da pagina (AJAX)
	 */
	$('.groups').on('click', 'a', function(e) {
		if ($(this).hasClass('ajax-link')) {
			e.preventDefault();
			$('.preloader').show();
			var url = $(this).attr('href');
			window.location.hash = url;
			LoadAjaxContent(url);
		}
		if ($(this).attr('href') == '#') {
			e.preventDefault();
		}
	});
});
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


/*
 * Função que faz funcionar botão voltar do navegador
 */
window.onhashchange = function(e) {
	var pagina = window.location.hash.substring(1);
	if(pagina.length==0){
		location.reload(true);
	}else{
		LoadAjaxContent(pagina);
	}	  	
};
