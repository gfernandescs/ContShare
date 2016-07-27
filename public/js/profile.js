function LoadMain(code){
	var ajax_url = location.hash.replace(/^#/, '');
	if (ajax_url.length < 1) {
		ajax_url = "contents_profile.php?u_code="+code;
	}
	LoadAjaxContent(ajax_url);
}

function LoadAjaxContent(url){
	$.ajax({
		mimeType: 'text/html; charset=utf-8', // ! Need set mimeType only when run from local file
		url: url,
		type: 'GET',
		success: function(data) {
			$('#ajax-content').html(data);
		},
		error: function (jqXHR, textStatus, errorThrown) {
			alert(errorThrown);
		},
		dataType: "html",
		async: false
	});
}
/*
 * Função que add no corpo da pagina (AJAX)
 */
$('.groups').on('click', 'a', function(e) {
	if ($(this).hasClass('ajax-link')) {
		e.preventDefault();
		if ($(this).hasClass('add-full')) {
			$('#content').addClass('full-content');
		} else {
			$('#content').removeClass('full-content');
		}
		var url = $(this).attr('href');
		window.location.hash = url;
		LoadAjaxContent(url);
	}
	if ($(this).attr('href') == '#') {
		e.preventDefault();
	}
});

$('#n-conts').on('click', function(e) {
	if ($(this).hasClass('ajax-link')) {
		e.preventDefault();
		if ($(this).hasClass('add-full')) {
			$('#content').addClass('full-content');
		} else {
			$('#content').removeClass('full-content');
		}
		url = $("#n-conts").attr("href");
		window.location.hash = url;
		LoadAjaxContent(url);
	}
	if ($(this).attr('href') == '#') {
		e.preventDefault();
	}
});

$('#n-following').on('click', function(e) {
	if ($(this).hasClass('ajax-link')) {
		e.preventDefault();
		if ($(this).hasClass('add-full')) {
			$('#content').addClass('full-content');
		} else {
			$('#content').removeClass('full-content');
		}
		url = $("#n-following").attr("href");
		window.location.hash = url;
		LoadAjaxContent(url);
	}
	if ($(this).attr('href') == '#') {
		e.preventDefault();
	}
});

$('#n-followers').on('click', function(e) {
	if ($(this).hasClass('ajax-link')) {
		e.preventDefault();
		if ($(this).hasClass('add-full')) {
			$('#content').addClass('full-content');
		} else {
			$('#content').removeClass('full-content');
		}
		url = $("#n-followers").attr("href");
		window.location.hash = url;
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
