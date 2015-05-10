
function Dados(valor) {
	  try {
         ajax = new ActiveXObject("Microsoft.XMLHTTP");
      }
      catch(e) {
         try {
            ajax = new ActiveXObject("Msxml2.XMLHTTP");
         }
	     catch(ex) {
            try {
               ajax = new XMLHttpRequest();
            }
	        catch(exc) {
               alert("Esse browser não tem recursos para uso do Ajax");
               ajax = null;
            }
         }
      }
	  if(ajax) {
		 document.forms[0].cidade_id.options.length = 1;
		 idOpcao  = document.getElementById("opcoes");
	     ajax.open("POST", "../../includes/cidades.php", true);
		 ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		 ajax.onreadystatechange = function() {
			if(ajax.readyState == 1) {
			   idOpcao.innerHTML = "Aguarde...!";
	        }
            if(ajax.readyState == 4 ) {
			   if(ajax.responseXML) {
			      processXML(ajax.responseXML);
			   }
			   else {
				   idOpcao.innerHTML = "Selecione uma Cidade ";
			   }
            }
         }
	     var params = "estado="+valor;
         ajax.send(params);
      }
   }
   function processXML(obj){
      var dataArray   = obj.getElementsByTagName("cidade");
	  if(dataArray.length > 0) {
         for(var i = 0 ; i < dataArray.length ; i++) {
            var item = dataArray[i];
			var codigo    =  item.getElementsByTagName("codigo")[0].firstChild.nodeValue;
			var descricao =  item.getElementsByTagName("descricao")[0].firstChild.nodeValue;
	        idOpcao.innerHTML = "Selecione uma opção";
			var novo = document.createElement("option");
			    novo.setAttribute("id", "opcoes");
			    novo.value = codigo;
			    novo.text  = descricao;
				document.forms[0].cidade_id.options.add(novo);
		 }
	  }
	  else {
		idOpcao.innerHTML = "Selecione o Estado";
	  }
   }
















function Setor(valor) {
	  try {
         ajax = new ActiveXObject("Microsoft.XMLHTTP");
      }
      catch(e) {
         try {
            ajax = new ActiveXObject("Msxml2.XMLHTTP");
         }
	     catch(ex) {
            try {
               ajax = new XMLHttpRequest();
            }
	        catch(exc) {
               alert("Esse browser não tem recursos para uso do Ajax");
               ajax = null;
            }
         }
      }
	  if(ajax) {
		 document.forms[0].setordestino_id.options.length = 1;
		 idOpcao  = document.getElementById("opcoes");
	     ajax.open("POST", "setor.php", true);
		 ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		 ajax.onreadystatechange = function() {
			if(ajax.readyState == 1) {
			   idOpcao.innerHTML = "Aguarde...!";
	        }
            if(ajax.readyState == 4 ) {
			   if(ajax.responseXML) {
			      processXML(ajax.responseXML);
			   }
			   else {
				   idOpcao.innerHTML = "Selecione um Prédio ";
			   }
            }
         }
	     var params = "estado="+valor;
         ajax.send(params);
      }
   
   function processXML(obj){
      var dataArray   = obj.getElementsByTagName("cidade");
	  if(dataArray.length > 0) {
         for(var i = 0 ; i < dataArray.length ; i++) {
            var item = dataArray[i];
			var codigo    =  item.getElementsByTagName("codigo")[0].firstChild.nodeValue;
			var descricao =  item.getElementsByTagName("descricao")[0].firstChild.nodeValue;
	        idOpcao.innerHTML = "Selecione uma opção";
			var novo = document.createElement("option");
			    novo.setAttribute("id", "opcoes");
			    novo.value = codigo;
			    novo.text  = descricao;
				document.forms[0].setordestino_id.options.add(novo);
		 }
	  }
	  else {
		idOpcao.innerHTML = "Selecione o Prédio";
	  }
   }

   
   }
   
function selecionar_tudo(){ 
   for (i=0;i<document.np.elements.length;i++)
      if(document.np.elements[i].type == "checkbox")
         document.np.elements[i].checked=1
} 
function deselecionar_tudo(){ 
   for (i=0;i<document.np.elements.length;i++)
      if(document.np.elements[i].type == "checkbox")
         document.np.elements[i].checked=0
} 

   
   


 
