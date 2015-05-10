function BPController() {

	this.subtitleCampo = function(obj) {
		
		if(obj.className.indexOf("onerror")==-1) {
			span_legend = obj.parentNode.getElementsByTagName("span").item(1);
			span_legend.innerHTML = (span_legend.innerHTML.length==0) ? obj.getAttribute("title"):"";
		} 
	
	}
	this.subtitleCampoEnq = function(obj) {
		
		if(obj.self.parentNode.getElementsByTagName("span")[0].className!=obj.classe) {
			span_legend = obj.self.parentNode.getElementsByTagName("span").item(0);
			span_legend.innerHTML = (span_legend.innerHTML=="&nbsp;&nbsp;&nbsp;") ? obj.self.getAttribute("title"):"&nbsp;&nbsp;&nbsp;";
		} 
	
	}
	this.reloadCaptcha = function(id) {					
		$(id).src+='?';
	}
	this.changeFont = function(obj) {
		
		if(obj.size =="-1") size = 12;
		if(obj.size =="0") size = 14;
		if(obj.size =="+1") size = 16;
		
		$(obj.object).style.fontSize = size+"px";
		
	}
	this.changeMenu = function(obj) {
	
		myul = obj.parentNode.parentNode;				
		menu = myul.getElementsByTagName("a");		
		for(var i=0;i<menu.length;i++) {		
			menu[i].className = "";		
		}
		obj.className = "selected";
	
	}
	this.changeMenuColunaB = function(obj,abanum) {
	
		prefix = "dispatcher_most_";
		
		if (abanum==0) {
		
			$(prefix+"views").className = "selected";
			$(prefix+"votes").className = "mask";
			$(prefix+"coments").className = "mask";
			$("type_list").value = "acessos";
		
		}
		
		if (abanum==1) {
		
			$(prefix+"views").className = "first";
			$(prefix+"votes").className = "mask selected";
			$(prefix+"coments").className = "mask";
			$("type_list").value = "votos";
		
		}
		
		if (abanum==2) {
		
			$(prefix+"views").className = "first";
			$(prefix+"votes").className = "first";
			$(prefix+"coments").className = "mask selected";
			$("type_list").value = "comentarios";
		
		}
		
		BPRequest.getListaMaisColunaB($("list_today"),$("id_secao").value,"today");
	
	}
		this.valueSearch = function(obj) {
	
		obj.value = (obj.value=="") ? "Digite sua pesquisa!":(obj.value=="Digite sua pesquisa!")?"":obj.value;
		
	}
	this.changeFontListaUltimas = function(obj) {
		
		if(obj.size =="-1") size = 12;
		if(obj.size =="0") size = 14;
		if(obj.size =="+1") size = 16;
		
		dts = $(obj.object).getElementsByTagName("dt");
		dds = $(obj.object).getElementsByTagName("dd");
		
		for(var i=0;i<dds.length;i++) {
			
			dts[i].style.fontSize = size-4 + "px";
			dds[i].getElementsByTagName("a")[0].style.fontSize = size + "px";
			dds[i].getElementsByTagName("span")[0].style.fontSize = size + "px";
		
		}
	}
	this.changeFontListaEnquetes = function(obj) {
		
		if(obj.size =="-1") size = 12;
		if(obj.size =="0") size = 14;
		if(obj.size =="+1") size = 16;
		
		lis = $(obj.object).getElementsByTagName("li");
		
		for(var i=0;i<lis.length;i++) {
			
			lis[i].style.fontSize = size + "px";
			lis[i].getElementsByTagName("b")[0].style.fontSize = size + "px";
			if(lis[i].getElementsByTagName("span")[0])
			lis[i].getElementsByTagName("span")[0].style.fontSize = size-2 + "px"; 
			if(lis[i].getElementsByTagName("a")[0])
			lis[i].getElementsByTagName("a")[0].style.fontSize = size -2 + "px"; 
			if(lis[i].getElementsByTagName("a")[1])
			lis[i].getElementsByTagName("a")[1].style.fontSize = size -2 + "px"; 
		
		}
	}
	
	this.changeFontMaisVotadas = function(obj) {
		
		if(obj.size =="-1") size = 12;
		if(obj.size =="0") size = 14;
		if(obj.size =="+1") size = 16;
		
		divs = $(obj.object).getElementsByTagName("div");
		
		for(var i=0;i<divs.length;i++) {
			
			if(divs[i].getElementsByTagName("em")[0])
			divs[i].getElementsByTagName("em")[0].style.fontSize = size-4 + "px"; 
			if(divs[i].getElementsByTagName("a")[0].className=="links_js")
			divs[i].getElementsByTagName("a")[0].style.fontSize = size + "px"; 
			if(divs[i].getElementsByTagName("span")[0].className=="texto_mais_votadas_js")
			divs[i].getElementsByTagName("span")[0].style.fontSize = size + "px";
	
		}
	}
	this.createEl = function(el) {
		return document.createElement(el);
	}
	this.addStyle = function (obj) {
		
		var estilo = this.createEl("link");
		estilo.setAttribute("rel","stylesheet");
		estilo.setAttribute("type","text/css");
		estilo.setAttribute("media","screen");
		estilo.setAttribute("href",obj.style);
		document.getElementsByTagName("head")[0].appendChild(estilo);
		
	}
	this.scrollTopp = function() {

		var yScroll;
		
		if (self.pageYOffset) yScroll = self.pageYOffset;
		else if (document.documentElement && document.documentElement.scrollTop) yScroll = document.documentElement.scrollTop;
		else if (document.body) yScroll = document.body.scrollTop;
		arrayPageScroll = {yScroll:yScroll};
		
		return arrayPageScroll;

	}
	this.getPageSize = function () {
		
		var xScroll, yScroll;
		
		if (window.innerHeight && window.scrollMaxY){
			xScroll = document.body.scrollWidth;
			yScroll = window.innerHeight + window.scrollMaxY;
		} else if (document.body.scrollHeight > document.body.offsetHeight) {
			xScroll = document.body.scrollWidth;
			yScroll = document.body.scrollHeight;
		} else {
			xScroll = document.body.offsetWidth;
			yScroll = document.body.offsetHeight;
		}
		var windowWidth, windowHeight;

		if (self.innerHeight) {
			windowWidth = self.innerWidth;
			windowHeight = self.innerHeight;
		} else if (document.documentElement && document.documentElement.clientHeight) {
			windowWidth = document.documentElement.clientWidth;
			windowHeight = document.documentElement.clientHeight;
		} else if (document.body) {
			windowWidth = document.body.clientWidth;
			windowHeight = document.body.clientHeight;
		}	
		if(yScroll < windowHeight) pageHeight = windowHeight;
		else pageHeight = yScroll;
		if(xScroll < windowWidth) pageWidth = windowWidth;
		else pageWidth = xScroll;
		arrayPageSize = {pageWidth:pageWidth,pageHeight:pageHeight,windowWidth:windowWidth,windowHeight:windowHeight}
		return arrayPageSize;
	
	}
	this.overlay = function(option) {
		
		if (option) {
		
		var size = this.getPageSize();
		overlay = this.createEl("div");
		overlay_style = overlay.style;
		overlay.setAttribute("id","oracle_overlay");
		overlay_style.position = "absolute";
		overlay_style.top = 0;
		if(document.all) overlay_style.left = -(Math.round((size.pageWidth-979)/2))+"px"; 
		else overlay_style.left = -(Math.round((size.pageWidth-963)/2))+"px";
		overlay_style.width = size.pageWidth+"px";
		overlay_style.height = size.pageHeight+"px";
		overlay_style.background = "#000";
		overlay_style.zIndex = "10000";
		overlay_style.opacity = 0.7;
		overlay_style.filter = "alpha(opacity=70)";
		document.body.appendChild(overlay);
		overlay_style.display = "block";
		
		
		this.desabilitySelect(true);
		
		} else {
			
			this.desabilitySelect(false);
			if($("viewport"))
			document.body.removeChild($("viewport"));
			if($("viewfotoexpand"))
			document.body.removeChild($("viewfotoexpand"));
			document.body.removeChild($("oracle_overlay"));
			
		}
	}
	this.desabilitySelect = function(flag) {
		for(var i=0;i<document.body.getElementsByTagName("select").length;i++) {
			document.body.getElementsByTagName("select")[i].style.visibility = (flag)?"hidden":"visible";
		}
	}
	this.createViewPort = function(options) {
			
		pagesize = this.getPageSize();
		
		cordenateX = Math.round((document.body.scrollWidth - options.width)/2);
		cordenateY = this.scrollTopp();
		
		content_viewport = this.createEl("div");
		content_viewport.setAttribute("id","viewport");
		content_viewport.style.position = "absolute";
		content_viewport.style.opacity = 1;
		content_viewport.style.top = cordenateY.yScroll + Math.round((pagesize.windowHeight - options.height - 35 ) / 2) + "px";
		content_viewport.style.left = cordenateX + "px";
		content_viewport.style.width = options.width+"px";
		content_viewport.style.height = options.height+"px";
		content_viewport.style.background = "#fff";
		content_viewport.style.overflow="auto";
		content_viewport.style.overflowX="hidden";
		content_viewport.style.zIndex = "10500";
		document.body.appendChild(content_viewport);
		
		content_viewport.style.display = "block";
	}
	
	this.createViewFotoExpand = function(options) {
		
		this.addStyle({style:"http://www.brasilportais.com.br/css/fotoexpand.css"});		
		pagesize = this.getPageSize();
		cordenateX = Math.round((pagesize.windowWidth - options.width)/2)-(Math.round((pagesize.pageWidth-980)/2));
		cordenateY = this.scrollTopp();
		content_viewport = this.createEl("div");
		content_viewport.setAttribute("id","viewfotoexpand");
		content_viewport.style.position = "absolute";
		content_viewport.style.opacity = 1;
		content_viewport.style.top = cordenateY.yScroll + Math.round((pagesize.windowHeight - options.height - 35 ) / 2) + "px";
		content_viewport.style.left = cordenateX + "px";
		if(document.all)  content_viewport.style.paddingBottom = "11px"; 
		else content_viewport.style.paddingBottom = "6px";
		content_viewport.style.minWidth = options.width+"px";
		content_viewport.style.minHeight = options.height+"px";
		content_viewport.style.background = "#fff";
		content_viewport.style.zIndex = "10500";
		document.body.appendChild(content_viewport);
		//
		var spn = BPCtrl.createEl("span");
		spn.style.display = "none";
		spn.setAttribute("id","barra_titulo");
		spn.innerHTML=options.descricao+"<a href=\"javascript:void(0)\" title=\"Fechar\" onclick=\"BPCtrl.overlay(false)\" class=\"close_viewfoto\">&nbsp;</a>";
		spn.className="barra_titulo";
		spn.style.width=(options.width-16)+"px";
		$("viewfotoexpand").appendChild(spn);
		content_viewport.style.display = "block";
		spn.style.display ="block";
	}
	
	this.enviarEmail = function(obj) {
		
		if(obj.flag) {
			this.overlay(true);
			//HEIGHT COM CAPTCHA 610
			this.createViewPort({width:460,height:550});
			//this.addStyle({style:"http://www.brasilportais.com.br/css/enquete_resultado.css"});
			//this.addStyle({style:"http://www.brasilportais.com.br/css/send_success.css"});
			Ajax.addParameter("page","enviar_email");
			Ajax.addParameter("id_materia",obj.id_materia);
			Ajax.Request({
				url:"ajaxRequest.html",
				pack:"ajax"
			});
		}
		else this.overlay(false);
	} 
	this.contato = function(flag) {
		
		if(flag) {
			this.overlay(true);
			//HEIGHT COM CAPTCHA 650
			this.createViewPort({width:620,height:460});
			//this.addStyle({style:"http://www.testcase.com.br/css/enquete_resultado.css"});
			//this.addStyle({style:"http://www.testcase.com.br/css/send_success.css"});
			Ajax.addParameter("page","contato");
			Ajax.Request({
				url:"ajaxRequest.html",
				pack:"ajax"
			}); 
		}
		else this.overlay(false); 
		
	}
	this.indicarErro = function(obj) {
		
		if(obj.flag) {
			this.overlay(true);
			//HEIGHT COM CAPTCHA 515
			this.createViewPort({width:460,height:475});
			//this.addStyle({style:"http://www.brasilportais.com.br/css/enquete_resultado.css"});
			//this.addStyle({style:"http://www.brasilportais.com.br/css/send_success.css"});
			Ajax.addParameter("page","indicar_erro");
			Ajax.addParameter("id_materia",obj.id_materia);
			Ajax.Request({
				url:"ajaxRequest.html",
				pack:"ajax"
			});
		}
		else this.overlay(false);
	} 

	this.changePesquisa = function (button,e) {
		
		$("image").src =(e.type == "mouseover") ? "http://www.brasilportais.com.br/imgs/button_pesquisa2.jpg":"http://www.brasilportais.com.br/imgs/button_pesquisa2_on.jpg";
		
	} 

	
}

var BPCtrl = new BPController();



function changeButton(button,e) {

	button.style.backgroundColor =(e.type=="mouseover") ? "#dfdfdf":"#cecece";

}