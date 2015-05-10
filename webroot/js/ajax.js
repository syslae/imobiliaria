// JavaScript Document

// Função para iniciarmos o Ajax no browser do cliente.
function openAjax() {

var ajax;

try{
    ajax = new XMLHttpRequest(); // XMLHttpRequest para browsers decentes, como: Firefox, Safari, dentre outros.
}catch(ee){
    try{
        ajax = new ActiveXObject("Msxml2.XMLHTTP"); // Para o IE da MS
    }catch(e){
        try{
            ajax = new ActiveXObject("Microsoft.XMLHTTP"); // Para o IE da MS
        }catch(E){
            ajax = false;
        }
    }
}
return ajax;
}
