$(function() {
	$(document).on('focusin', '.field, textarea', function() {
		if(this.title==this.value) {
			this.value = '';
		}
	}).on('focusout', '.field, textarea', function(){
		if(this.value=='') {
			this.value = this.title;
		}
	});

	$('#navigation ul li:first-child').addClass('first');
	$('.footer-nav ul li:first-child').addClass('first');

	$('#navigation a.nav-btn').click(function(){
		$(this).closest('#navigation').find('ul').slideToggle()
		$(this).find('span').toggleClass('active')
		return false;
	})
});

$(window).load(function() {
	$('.flexslider').flexslider({
		animation: "slide",
		controlsContainer: ".slider-holder",
		slideshowSpeed: 5000,
		directionNav: false,
		controlNav: true,
		animationDuration: 2000,
		before:function( slider ){
			$('.img-holder').animate({'bottom' : '-30px'},300)
		},

		after:function( slider ){
			$('.img-holder').animate({'bottom' : '0px'},300)
		}
	});
});


/*
 *    Script:    Mascaras em Javascript
 *    Autor:    Matheus Biagini de Lima Dias
 *    Data:    26/08/2008
 *    Obs:
 */
/*Função Pai de Mascaras*/

function Mascara(o,f){
    v_obj=o
    v_fun=f
    setTimeout("execmascara()",1)
}

/*Função que Executa os objetos*/
function execmascara(){
    v_obj.value=v_fun(v_obj.value)
}

/*Função que Determina as expressões regulares dos objetos*/
function leech(v){
    v=v.replace(/o/gi,"0")
    v=v.replace(/i/gi,"1")
    v=v.replace(/z/gi,"2")
    v=v.replace(/e/gi,"3")
    v=v.replace(/a/gi,"4")
    v=v.replace(/s/gi,"5")
    v=v.replace(/t/gi,"7")
    return v
}

/*Função que permite apenas numeros*/
function Integer(v){
    return v.replace(/\D/g,"")
}

function mascSoNumeros(v){
    return v.replace(/\D/g,"")
}

/*Função que padroniza telefone (11) 4184-1241*/
function mascTelefone(v){
    v=v.replace(/\D/g,"")
    v=v.replace(/^(\d\d)(\d)/g,"($1) $2")
    v=v.replace(/(\d{4})(\d)/,"$1-$2")
    return v
}

/*Função que padroniza telefone (11) 41841241*/
function TelefoneCall(v){
    v=v.replace(/\D/g,"")
    v=v.replace(/^(\d\d)(\d)/g,"($1) $2")
    return v
}

/*Função que padroniza CPF*/
function mascCpf(v){
    v=v.replace(/\D/g,"")
    v=v.replace(/(\d{3})(\d)/,"$1.$2")
    v=v.replace(/(\d{3})(\d)/,"$1.$2")

    v=v.replace(/(\d{3})(\d{1,2})$/,"$1-$2")
    return v
}

/*Função que padroniza CEP*/
function mascCep(v){
    v=v.replace(/D/g,"")
    v=v.replace(/^(\d{5})(\d)/,"$1-$2")
    return v
}

/*Função que padroniza CNPJ*/
function mascCnpj(v){
    v=v.replace(/\D/g,"")
    v=v.replace(/^(\d{2})(\d)/,"$1.$2")
    v=v.replace(/^(\d{2})\.(\d{3})(\d)/,"$1.$2.$3")
    v=v.replace(/\.(\d{3})(\d)/,".$1/$2")
    v=v.replace(/(\d{4})(\d)/,"$1-$2")
    return v
}

/*Função que permite apenas numeros Romanos*/
function Romanos(v){
    v=v.toUpperCase()
    v=v.replace(/[^IVXLCDM]/g,"")

    while(v.replace(/^M{0,4}(CM|CD|D?C{0,3})(XC|XL|L?X{0,3})(IX|IV|V?I{0,3})$/,"")!="")
        v=v.replace(/.$/,"")
    return v
}

/*Função que padroniza o Site*/
function mascSite(v){
    v=v.replace(/^http:\/\/?/,"")
    dominio=v
    caminho=""
    if(v.indexOf("/")>-1)
        dominio=v.split("/")[0]
    caminho=v.replace(/[^\/]*/,"")
    dominio=dominio.replace(/[^\w\.\+-:@]/g,"")
    caminho=caminho.replace(/[^\w\d\+-@:\?&=%\(\)\.]/g,"")
    caminho=caminho.replace(/([\?&])=/,"$1")
    if(caminho!="")dominio=dominio.replace(/\.+$/,"")
    v="http://"+dominio+caminho
    return v
}

/*Função que padroniza DATA*/
function mascData(v){
    v=v.replace(/\D/g,"")
    v=v.replace(/(\d{2})(\d)/,"$1/$2")
    v=v.replace(/(\d{2})(\d)/,"$1/$2")
    return v
}

/*Função que padroniza DATA*/
function mascHora(v){
    v=v.replace(/\D/g,"")
    v=v.replace(/(\d{2})(\d)/,"$1:$2")
    return v
}

/*Função que padroniza valor monétario*/
function mascValor(v){
    v=v.replace(/\D/g,"") //Remove tudo o que não é dígito
    v=v.replace(/^([0-9]{3}\.?){3}-[0-9]{2}$/,"$1.$2");
    //v=v.replace(/(\d{3})(\d)/g,"$1,$2")
    v=v.replace(/(\d)(\d{2})$/,"$1.$2") //Coloca ponto antes dos 2 últimos digitos
    return v
}

/*Função que padroniza Area*/
function mascArea(v){
    v=v.replace(/\D/g,"")
    v=v.replace(/(\d)(\d{2})$/,"$1.$2")
    return v

}
