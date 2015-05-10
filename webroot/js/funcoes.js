// JavaScript Document
function msgErro(error)
{
	 document.getElementById("mensagem").innerHTML = error;
}
function popup(caminho,nome,largura,altura,rolagem) {
	var esquerda = (screen.width - largura) / 2;
	var cima = (screen.height - altura) / 2 -50;
	window.open(caminho,nome,'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=' + rolagem + ',resizable=no,copyhistory=no,top=' + cima + ',left=' + esquerda + ',width=' + largura + ',height=' + altura);
}
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
function mascaraData(campoData)
{
	//Como usar = onKeyUp="mascaraData(this)"
	var data = campoData.value;
	if (data.length == 2)
	{
		data = data + '-';
		campoData.value = data;
		return true;              
	}
	if (data.length == 5)
	{
		data = data + '-';
		campoData.value = data;
		return true;
	}
}
function MascaraMoeda(objTextBox, SeparadorMilesimo, SeparadorDecimal, e)
{
	//Como usar = onKeyPress="return(MascaraMoeda(this,'.',',',event))"
	var sep = 0;
	var key = '';
	var i = j = 0;
	var len = len2 = 0;
	var strCheck = '0123456789';
	var aux = aux2 = '';
	var whichCode = (window.Event) ? e.which : e.keyCode;
	if ((whichCode == 8) || (whichCode == 0)) return true;
	key = String.fromCharCode(whichCode); // Valor para o código da Chave
	if (strCheck.indexOf(key) == -1) return false; // Chave inválida
	len = objTextBox.value.length;
	for(i = 0; i < len; i++)
		if ((objTextBox.value.charAt(i) != '0') && (objTextBox.value.charAt(i) != SeparadorDecimal)) break;
	aux = '';
	for(; i < len; i++)
		if (strCheck.indexOf(objTextBox.value.charAt(i))!=-1) aux += objTextBox.value.charAt(i);
	aux += key;
	len = aux.length;
	if (len == 0) objTextBox.value = '';
	if (len == 1) objTextBox.value = '0'+ SeparadorDecimal + '0' + aux;
	if (len == 2) objTextBox.value = '0'+ SeparadorDecimal + aux;
	if (len > 2)
	{
		aux2 = '';
		for (j = 0, i = len - 3; i >= 0; i--) 
		{
			if (j == 3) 
			{
				aux2 += SeparadorMilesimo;
				j = 0;
			}
			aux2 += aux.charAt(i);
			j++;
		}
		objTextBox.value = '';
		len2 = aux2.length;
		for (i = len2 - 1; i >= 0; i--)
			objTextBox.value += aux2.charAt(i);
		objTextBox.value += SeparadorDecimal + aux. substr(len - 2, len);
	}
	return false;
}

	String.prototype.trim = function() {
		return this.replace(/^\s+|\s+$/g,"");
	}
	String.prototype.ltrim = function() {
		return this.replace(/^\s+/,"");
	}
	String.prototype.rtrim = function() {
		return this.replace(/\s+$/,"");
	}
	
	function ContaCaracteresCampo(c1, c2, quantidade)
	{
	   intCaracteres = quantidade - document.getElementById(''+c1+'').value.length;
	   if (intCaracteres > 0) {
		  document.getElementById(''+c2+'').value = intCaracteres;
		  return true;
	   }
	   else
	   {
		  document.getElementById(''+c2+'').value= 0;
		  document.getElementById(''+c1+'').value = document.getElementById(''+c1+'').value.substr(0,quantidade)
		  return false;
	   }
	}

function carregaSelect(id,tabela,descricao){
	
	$.ajax({
			method: "get",url: "../../includes/carrega_select.php?tabela="+tabela+"&nome_input="+id+"&descricao="+descricao,
			dataType: "html",
			beforeSend:  function(){
				$("#"+id).show("fast");
				$("#"+id).html("<select disabled='disabled'><option>Carregando..</option></select>");
				},
			success: function(html){ 
						$("#"+id).html("");
						$("#"+id).append(html);
						$("#"+id).show();
		 }
	 }); //close $.ajax(
		
}
function carrega_select_entrada(id,tabela,IdProduto){
	
	$.ajax({
			method: "get",url: "../../includes/carrega_select_entrada.php?tabela="+tabela+"&nome_input="+id+"&IdProduto="+IdProduto+"",
			dataType: "html",
			beforeSend:  function(){
				$("#"+id).show("fast");
				$("#"+id).html("<select disabled='disabled'><option>Carregando..</option></select>");
			    //$("#"+id).html("<img src='../../webroot/img_sistema/carregando.gif'/>");
				},
			success: function(html){ 
						$("#"+id).html("");
						$("#"+id).append(html);
						$("#"+id).show();
		 }
	 }); //close $.ajax(
		
}	
function sair_tick()
{
	tb_remove();
	
}

function incrementa_meses(d, m) {
//funcção de incrementar data
//d corresponde a data formato dd/mm/yyyy
//m corresponde a qtde de meses a serem somados

    d = d.toString();

    var di = parseFloat(d.substr(0, 2));
    var me = parseFloat(d.substr(3, 2));
    var y = parseFloat(d.substr(6, 4));

    var date = new Date(y, me - 1, di);
    //detalhe ele retorna 0 para janeiro e 11 para dezembro
    var month = date.getMonth();
    //crio uma nova váriavel com a nova data, Date(ano, mes(soma da variavel enviada para o metodo + o mes atual, dia que eu coloquei padrão para 1

    var n_date = new Date(date.getFullYear(), eval(m + month), di);
    var n_d = n_date.getDate();
    var n_m = parseFloat(n_date.getMonth()) + 1;
    var n_y = n_date.getFullYear();

    n_d = n_d.toString();
    n_m = n_m.toString();

    if (n_d.length < 2)
        n_d = '0' + n_d;
    if (n_m.length < 2)
        n_m = '0' + n_m;

    var diaData = n_d;

    if (me == 1) {
        if (di > 28) {
            diaData = 28;
            n_m = '0' + 2;
        }
    }
    if (me == 2) {
        if (di > 28) {
            n_m = '0' + 3;
        }
    }

    n_date = diaData + "/" + n_m + "/" + n_y;
    return n_date;
}


/*
 *       Script: Mascaras em Javascript
 *       Autor:  Matheus Biagini de Lima Dias
 *       Data:   26/08/2008
 *       Obs:
 */
/*Função Pai de Mascaras*/

function Mascara_phone(obj) {
    var valor = $(obj).val().replace('-', '').replace('(', '').replace(')', '');
    var new_valor = '';
    switch (valor.length) {
        case 8:
            for (var x = 0; x < 4; x++) {
                new_valor = new_valor + valor[x];
            }
            new_valor = new_valor + '-';
            for (var x = 4; x < 8; x++) {
                new_valor = new_valor + valor[x];
            }
            $(obj).val(new_valor);
            break;
        case 9:
            for (var x = 0; x < 5; x++) {
                new_valor = new_valor + valor[x];
            }
            new_valor = new_valor + '-';
            for (var x = 5; x < 9; x++) {
                new_valor = new_valor + valor[x];
            }
            $(obj).val(new_valor);
            break;
        case 10:
            new_valor = '(';
            for (var x = 0; x < 10; x++) {
                new_valor = new_valor + valor[x];
                if (x === 1) {
                    new_valor = new_valor + ')';
                }
                if (x === 5) {
                    new_valor = new_valor + '-';
                }
            }
            $(obj).val(new_valor);
            break;
        case 11:
            new_valor = '(';
            for (var x = 0; x < 11; x++) {
                new_valor = new_valor + valor[x];
                if (x === 1) {
                    new_valor = new_valor + ')';
                }
                if (x === 6) {
                    new_valor = new_valor + '-';
                }
            }
            $(obj).val(new_valor);
            break;
    }
}

function Mascara(o, f) {
    v_obj = o
    v_fun = f
    setTimeout("execmascara()", 1)
}

/*Função que Executa os objetos*/
function execmascara() {
    v_obj.value = v_fun(v_obj.value)
}

/*Função que Determina as expressões regulares dos objetos*/
function leech(v) {
    v = v.replace(/o/gi, "0")
    v = v.replace(/i/gi, "1")
    v = v.replace(/z/gi, "2")
    v = v.replace(/e/gi, "3")
    v = v.replace(/a/gi, "4")
    v = v.replace(/s/gi, "5")
    v = v.replace(/t/gi, "7")
    return v
}

/*Função que permite apenas numeros*/
function Integer(v) {
    return v.replace(/\D/g, "")
}


function mascSoNumeros(v){
    return v.replace(/\D/g,"")
}


/*Função que padroniza telefone (11) 4184-1241 8 digitos*/
function mascTelefone(v) {
    v = v.replace(/\D/g, "")
    v = v.replace(/^(\d\d)(\d)/g, "($1) $2")
    v = v.replace(/(\d)(\d{4})$/, "$1-$2")
    return v
}

/*Função que padroniza telefone (11) 44184-1241 9 digitos*/
function mascTelefone9D(v) {
    v = v.replace(/\D/g, "")
    v = v.replace(/^(\d\d)(\d)/g, "($1) $2")
    v = v.replace(/(\d{5})(\d)/, "$1-$2")
    return v
}

/*Função que padroniza telefone (11) 41841241*/
function mascTelefoneCall(v) {
    v = v.replace(/\D/g, "")
    v = v.replace(/^(\d\d)(\d)/g, "($1) $2")
    return v
}

/*Função que padroniza CPF*/
function mascCpf(v) {
    v = v.replace(/\D/g, "")
    v = v.replace(/(\d{3})(\d)/, "$1.$2")
    v = v.replace(/(\d{3})(\d)/, "$1.$2")

    v = v.replace(/(\d{3})(\d{1,2})$/, "$1-$2")

    return v
}

/*Função que padroniza CEP*/
function mascCep(v) {
    v = v.replace(/D/g, "")
    v = v.replace(/^(\d{5})(\d)/, "$1-$2")
    return v
}

/*Função que padroniza CEP*/
function mascPeriodoMasc(v) {
    v = v.replace(/D/g, "")
    v = v.replace(/^(\d{4})(\d)/, "$1-$2")
    return v
}

/*Função que padroniza CNPJ*/
function mascCnpj(v) {
    v = v.replace(/\D/g, "")
    v = v.replace(/^(\d{2})(\d)/, "$1.$2")
    v = v.replace(/^(\d{2})\.(\d{3})(\d)/, "$1.$2.$3")
    v = v.replace(/\.(\d{3})(\d)/, ".$1/$2")
    v = v.replace(/(\d{4})(\d)/, "$1-$2")
    return v
}

/*Função que permite apenas numeros Romanos*/
function mascRomanos(v) {
    v = v.toUpperCase()
    v = v.replace(/[^IVXLCDM]/g, "")

    while (v.replace(/^M{0,4}(CM|CD|D?C{0,3})(XC|XL|L?X{0,3})(IX|IV|V?I{0,3})$/, "") != "")
        v = v.replace(/.$/, "")
    return v
}

/*Função que padroniza o Site*/
function mascSite(v) {
    v = v.replace(/^http:\/\/?/, "")
    dominio = v
    caminho = ""
    if (v.indexOf("/") > -1)
        dominio = v.split("/")[0]
    caminho = v.replace(/[^\/]*/, "")
    dominio = dominio.replace(/[^\w\.\+-:@]/g, "")
    caminho = caminho.replace(/[^\w\d\+-@:\?&=%\(\)\.]/g, "")
    caminho = caminho.replace(/([\?&])=/, "$1")
    if (caminho != "")
        dominio = dominio.replace(/\.+$/, "")
    v = "http://" + dominio + caminho
    return v
}

/*Função que padroniza DATA*/
function mascData(v) {
    v = v.replace(/\D/g, "")
    v = v.replace(/(\d{2})(\d)/, "$1/$2")
    v = v.replace(/(\d{2})(\d)/, "$1/$2")
    return v
}

/*Função que padroniza DATA*/
function mascHora(v) {
    v = v.replace(/\D/g, "")
    v = v.replace(/(\d{2})(\d)/, "$1:$2")
    return v
}

/*Função que padroniza valor monétario*/
function mascValor(v) {
    v = v.replace(/\D/g, "") //Remove tudo o que não é dígito
    v = v.replace(/^([0-9]{3}\.?){3}-[0-9]{2}$/, "$1.$2");
    //v=v.replace(/(\d{3})(\d)/g,"$1,$2")
    v = v.replace(/(\d)(\d{2})$/, "$1.$2") //Coloca ponto antes dos 2 últimos digitos
    return v
}

/*Função que padroniza Area*/
function mascArea(v) {
    v = v.replace(/\D/g, "")
    v = v.replace(/(\d)(\d{2})$/, "$1.$2")
    return v

}

function marcar_todos(nome_classe, valor_logico){
    $('.'+nome_classe).attr('checked', valor_logico);
}




