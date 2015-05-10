function BPEnquete() {

	this.votar = function(obj) {
			
		var validado = false;
		
		for (var i=0;i<$(obj).getElementsByTagName("input").length;i++)  {
			if($(obj).getElementsByTagName("input")[i].checked) {
				id_alternativa = $(obj).getElementsByTagName("input")[i].value;
				validado=true;
			} 
		}
		if(!validado) {
			alert("Escolha uma alternativa!");
			return false;
		}
		
		/* if (isie) {
		
			if (!isHomePage()) {
				
				alert("Para votar nesta enquete voce deve ter o "+homenamesite+" como página inicial do seu navegador!");
				return false;
			
			} else {
			
				alert("aguarde um instante");
			
			}
		
		} */
		
		if(!$("oracle_overlay")) {
			BPCtrl.overlay(true);
			BPCtrl.addStyle({style:"http://www.testcase.com.br/css/enquete_resultado.css"});
		}
		if(!$("viewport")) {
			BPCtrl.createViewPort({width:460,height:515});
		}
		
		Ajax.addParameter("page","confirmar_voto");
		Ajax.addParameter("id_alternativa",id_alternativa);
		
		Ajax.Request({
			url:"ajaxRequest.html",
			pack:"ajax"
		});
		
	}
	this.voto = function(idenquete) {
		
		BPCtrl.overlay(true);
		BPCtrl.createViewPort({width:460,height:515});
		BPCtrl.addStyle({style:"http://www.testcase.com.br/css/enquete_resultado.css"});
		
		Ajax.addParameter("page","voto");
		Ajax.addParameter("id_enquete",idenquete);
		
		Ajax.Request({
		
			url:"ajaxRequest.html",
			pack:"ajax"
			
		});
	}
	this.resuladoEnquete = function(idenquete) {
		
		BPCtrl.overlay(true);
		BPCtrl.createViewPort({width:460,height:515});
		BPCtrl.addStyle({style:"http://www.testcase.com.br/css/enquete_resultado.css"});
		
		Ajax.addParameter("page","resultado_enquete");
		Ajax.addParameter("id_enquete",idenquete);
		
		Ajax.Request({
		
			url:"ajaxRequest.html",
			pack:"ajax"
			
		});
		
	}
	this.changeFontSize = function(obj) {
		
		if(obj.size =="-1") size = 12;
		if(obj.size =="0") size = 14;
		if(obj.size =="+1") size = 16;
		
			for(var i=0;i<$(obj.object).getElementsByTagName("li").length;i++) {
				
				$(obj.object).getElementsByTagName("li")[i].style.fontSize = size + "px";
				$(obj.object).getElementsByTagName("li")[i].getElementsByTagName("a")[0].style.fontSize = (size - 2) +"px";
				$(obj.object).getElementsByTagName("li")[i].getElementsByTagName("a")[1].style.fontSize = (size - 2) +"px";
				
		}
		
	}

}
var BPEnquete = new BPEnquete();