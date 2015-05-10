function BPRequest() {

	this.loadingImage = function(m) {
	
		return '<h2 style="text-align:center;font:bold 16px arial;color:#999;margin-top:'+m+'px;"><img src="http://www.brasilportais.com.br/imgs/ajax-loader.gif" style="display:block" />www.brasilportais.com.br</h2><br/>'
	
	}

	this.loadCidades = function(obj) {		

		state = obj.options[obj.selectedIndex].value;		
	
		if (state!="0") {

			$("cidade").disabled = true;
			$("cidade").options[0].text = "Carregando...";
			
			Ajax.addParameter("id_estado",state);
			Ajax.addParameter("page",document.getElementById("load_cidades").value);
			
			Ajax.Request({
				url:"ajaxRequest.html",
				pack:"ajax"
			});			
			
		}
	}
	this.avaliar = function(obj,id) {
		
		Ajax.addParameter("page","avaliar_materia");							
		Ajax.addParameter("id",id);							
		Ajax.addParameter("nota",obj.innerHTML);							
		
		Ajax.Request({
			url:"ajaxRequest.html",
			pack:"ajax"
		});
	
		obj.parentNode.innerHTML = "Enviando Informaçoes...";
		
	}
	this.showMateriaByAssunto = function(obj,id_secao,assunto) {
	
		Ajax.addParameter("id_secao",id_secao);
		Ajax.addParameter("assunto",assunto);
		Ajax.addParameter("page","materia_por_assunto");
		
		BPCtrl.changeMenu(obj);
		
		$("list_notas").innerHTML = this.loadingImage(120);
		
		Ajax.Request({
			url:"ajaxRequest.html",
			pack:"ajax"
		});
	
	}
	this.showComentsByAssunto = function(obj,id_secao) {
		
		Ajax.addParameter("id_secao",id_secao);
		Ajax.addParameter("page","coments_por_assunto");
		
		BPCtrl.changeMenu(obj);
		
		$("list_notas").innerHTML = this.loadingImage(120);
		
		Ajax.Request({
			url:"ajaxRequest.html",
			pack:"ajax"
		});
		
		
	}
	this.getListaMais = function(obj,secao,tipo, period) {
	
		Ajax.addParameter("secao",secao);
		Ajax.addParameter("tipo",tipo);
		Ajax.addParameter("period",period);
		Ajax.addParameter("page","lista_mais");
		
		BPCtrl.changeMenu(obj);
		
		$("mais_"+tipo).innerHTML = this.loadingImage(120);
		
		Ajax.Request({
			url:"ajaxRequest.html",
			pack:"ajax"
			
		});
	
	}
	this.getListaMaisColunaB = function(obj, secao, period) {
		
		tipo = $("type_list").value;
		
		Ajax.addParameter("secao",secao);
		Ajax.addParameter("tipo",tipo);
		Ajax.addParameter("period",period);
		Ajax.addParameter("page","lista_mais");
		Ajax.addParameter("coluna_b","yes");
		
		BPCtrl.changeMenu(obj);
		
		$("container_mais").innerHTML = this.loadingImage(120);
		
		Ajax.Request({
			url:"ajaxRequest.html",
			pack:"ajax"
		
		}); 
	
	}
	this.getUltimasBySection = function(obj,section)	 {
	
		BPCtrl.changeMenu(obj);
		
		$("lastest_news").innerHTML = this.loadingImage(160);
		
		Ajax.addParameter("page","ultimas_noticias");
		Ajax.addParameter("section",section);
		Ajax.Request({
			url:"ajaxRequest.html",
			pack:"ajax"
		});
		
	}
	this.getMaisVotadasBySection = function(obj) {
	
		BPCtrl.changeMenu(obj);
		
		$("list_voted").innerHTML = this.loadingImage(160);
		Ajax.addParameter("page","mais_votadas");
		
		Ajax.Request({
			url:"ajaxRequest.html",
			pack:"ajax"
		});
		
	}
	this.loadDestaques = function(obj,section) {
			
		BPCtrl.changeMenu(obj);
		
		slideshow.stop();
		
		$("destaques_materias").innerHTML = this.loadingImage(120);
		
		Ajax.addParameter("page","materias_destaque");
		Ajax.addParameter("section",section);
		Ajax.Request({
			url:"ajaxRequest.html",
			pack:"ajax"
		});
		
	}
	this.submitSend = function(obj,id) {
		
		obj.disabled=true;
		obj.value="Enviando...";
		Ajax.Submit(id);
		
	}
	
}


var BPRequest = new BPRequest();