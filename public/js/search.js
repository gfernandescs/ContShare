var req;
var xhr = null;
 
// Função para pesquisa
function search(valor) {
 
// Verificando Browser
if(window.XMLHttpRequest) {
   req = new XMLHttpRequest();
}
else if(window.ActiveXObject) {
   req = new ActiveXObject("Microsoft.XMLHTTP");
}
 
// Arquivo PHP juntamente com o valor digitado no campo (método GET)
var url = "control/control_search.php?value="+valor;
 
// Chamada do método open para processar a requisição
req.open("Get", url, true);
 
// Quando o objeto recebe o retorno, chamamos a seguinte função;
req.onreadystatechange = function() {
 	
	// Exibe a mensagem "Buscando..." enquanto carrega
	if(req.readyState == 1) {
		document.getElementById('result').innerHTML = 'Buscando...';
	}
 
	// Verifica se o Ajax realizou todas as operações corretamente
	if(req.readyState == 4 && req.status == 200) {
 
	// Resposta retornada pelo busca.php
	var resposta = req.responseText;
	
	// Abaixo colocamos a(s) resposta(s) na div resultado
	document.getElementById('result').innerHTML = resposta;
	}
};
req.send(null);
}

function searchConts(value,profile,user_on) {
	if(value == ""){
		if(xhr != null){
			abort();
		}
		if(profile){
			$(".cont-profile").load("contents_profile.php?u_code="+profile+" .row-fluid",function(){
			    $.getScript("js/profile.js"); 
			});
			

		}else{		
	        $(".row-fluid").load("contents.php .row-fluid",function(){
			    $.getScript("js/ContShares.js"); 
			});
		}
	}else{		
		if(xhr != null){
			abort();
		}
		if(profile){
			if(location.hash != ""){
 				window.history.pushState('Object', 'ContShare', 'profile.php?u_code='+profile);
 			}
			xhr = $.ajax({
		        url: 'control/control_search.php?value_conts='+value+'&cod_user='+profile+'&user_on='+user_on,
		        success: function(data) {
		            $(".cont-profile").html(data);
		        }
        	}); 
		}else{
			if(location.hash != ""){
 				window.history.pushState('Object', 'ContShare', '/Contshare/');
 			}		
	        xhr = $.ajax({
		        url: 'control/control_search.php?value_conts='+value,
		        success: function(data) {
		            $(".row-fluid").html(data);
		        }
        	}); 
		}		       
	}
}