<? session_start();
    require("../../config/define.php");
	require(DOMAIN_PATH."config/conexaoAr.php");
	require(DOMAIN_PATH."funcoes.inc.php");
	require(DOMAIN_PATH."funcoesValidar.inc.php");
	
	verifica ("../../login.php");
	###        CONFIGURACAO        ###
	$tabela = 'ocorrencia_retorno';
	$modulo = "Retorno bancário";
	$tabela_id=148;
    $upLoadsFeitos = array();
	$acao = 'upload';
    $_SESSION['DataGerRetorno_'.$sistema] = '';

    if(!empty($_POST['acao']) and $_POST['acao'] == 'upload'){

        $errors = array();
        include("upload_arquivo.php");

        if(empty($errors)){
            $action_form = URL."/core/controller/ocorrencia_retorno.Controller.php";
            $acao = 'Tratar';

        }

    }
	
	if($_SESSION["permissao_temp"]<2)
	{
		$_SESSION["msg_index"] = 'Lamentamos mas voc&ecirc; n&atilde;o tem permiss&atilde;o para acessar essa &aacute;rea.';
		echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL= ../index.php">';
		exit;
	}

    $existe_situacao_pago = verifica_situacao_pagamento('PAGO');
?>
<html>
<head>
<title><?= $config["tituloPagina"]?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="<?=URL.'/webroot/css/'?>estilo.css" rel="stylesheet" type="text/css">
<script src="<?=URL.'/webroot/js/'?>funcoes.js"></script>
<script src="<?=URL.'/webroot/js/'?>mascaras.js"></script>
<script src="<?=URL.'/webroot/js/'?>jquery.js"></script>

<link rel="stylesheet" type="text/css" media="screen" href="<?=URL.'/webroot/css/'?>datePicker.css">	
<script src="<?=URL.'/webroot/js/'?>date.js"></script>
<script src="<?=URL.'/webroot/js/'?>jquery.datePicker.js"></script>
<script type="text/javascript" charset="utf-8">
		$(function()
		{
		
	
              $('#data_ret').datePicker(); 
              $('#data_mov').datePicker(); 
              $('#data_credito').datePicker(); 
	       });
		
	</script>

    <script type="text/javascript" src="<?=URL.'/webroot/js/'?>jquery.form.js"></script>
    
    <script>

    var estaTrantando = false;
    var aAbas = new Array();  // Lista de abas do documento atual
    var sAbaAtiva = "";            // Define qual é a aba ativa no momento
    var ABA_ID = 1;
    var ABA_BLOCO = 2;
    var ABA_CAMPOS = 3;
    function defineAba(sId, sBloco) {
        var aAba = new Array(ABA_CAMPOS);
        aAba[ ABA_ID    ] = sId;
        aAba[ ABA_BLOCO ] = sBloco;
        aAbas.push(aAba);
    }

    function defineAbaAtiva(sId) {
        trataCliqueAba(sId);
    }

    function trataMouseAba(oAba) {
        oAba.style.cursor = "pointer";
    }

    function trataCliqueAba(sId) {
        for (var iAba = 0; iAba < aAbas.length; iAba++) {
            var aAba = aAbas[ iAba ];
            if (aAba[ ABA_ID ] === sId)
                ativaAba(aAba);
            else
                inativaAba(aAba);
        }
    }

    function ativaAba(aAba) {
        var sAba = aAba[ ABA_ID ];
        var oAba = document.getElementById(sAba);
        mudaClasse(oAba, "ativa"); // Esse comando chama a classe css para fazer a troca
        var sBlocoAba = aAba[ ABA_BLOCO ];
        var oBlocoAba = document.getElementById(sBlocoAba);
        oBlocoAba.style.display = "block";
    }

    function inativaAba(aAba) {
        var sAba = aAba[ ABA_ID ];
        var oAba = document.getElementById(sAba);
        mudaClasse(oAba, "inativa"); // Esse comando chama a classe css para fazer a troca
        var sBlocoAba = aAba[ ABA_BLOCO ];
        var oBlocoAba = document.getElementById(sBlocoAba);
        oBlocoAba.style.display = "none";
    }

    function mudaClasse(oObjeto, sClasse) {
        oObjeto.className = sClasse;
    }

    function carregaBanco(valor)
    {
        if (valor == 'BANCO ITAU - 400' || valor == 'BANCO HSBC - 400' || valor == 'BANCO SANTANDER - 240' || valor == 'BIC - BANCO - 400') $('#Banco').removeAttr('disabled');
        else $('#Banco').attr('disabled', true);
        
    }
    
    function inserirLocalizaArquivo()
    {
        var arquivo = $('#qtde_arq').val();
        arquivo++;
        
        $('#arquivo'+arquivo).show("slow");
        
        $("#removerLocaliza").show("slow");
        
        $('#qtde_arq').val(arquivo);
        
        if (arquivo == 5) $("#inserirLocaliza").hide("hide");
        
        
        
        
    }
    
    function removerLocalizaArquivo()
    {
        var arquivo = $('#qtde_arq').val();
        
        
        $('#arquivo'+arquivo).hide("hide");
        
        $('#arquivo'+arquivo).html("");
        
        $('#arquivo'+arquivo).append('<p>'+
                    '<label>Arquivo'+arquivo+'</label>'+
                    '<span class="field">'+                    
                    '<input type="file" name="localizaarquivo'+arquivo+'" id="localizaarquivo'+arquivo+'" />'+
                    '</span>'+
                '</p>');
                
        $("#inserirLocaliza").show("slow");
        
        arquivo--;
        
        $('#qtde_arq').val(arquivo);
        if (arquivo == 1) $("#removerLocaliza").hide("hide");

    }

    function openRelatorio(){
        window.open('<? echo URL."/modulos/rel_ocorrencia_retorno/controller.php";?>','_blank');
        window.location = '<? echo URL."/modulos/ocorrencia_retorno/cadastrar.php";?>';
    }

    function tratarArquivo(tipoRetorno){

        $('#tipoRetorno').val(tipoRetorno);

        $.ajax({
            type: "POST", url: "<? echo URL;?>/core/controller/ocorrencia_retorno.Controller.php",
            data: $('#form').serialize(),
            dataType: 'html',
            beforeSend: function() {
                if(tipoRetorno == 'js') tb_show('', "../../webroot/img_sistema/carregando.gif");
            },
            complete: function() {
                if(tipoRetorno == 'js') tb_remove();
            },
            success: function(html){

                if(tipoRetorno == 'js'){

                    if(html.indexOf('podeTratarArquivo(') >= 0){

                        var dados_string = html.split("@#@");
                        $("#NumRetorno").val(dados_string[1]);

                        estaTrantando = true;
                        $('#botao').html('<span class="obrigatorio" style="font-size: 30px;">Aguarde...</span>');

                    }else if(html.indexOf('redireciona(') > 0){

                        var dados_string = html.split('redireciona(');

                        if(confirm(dados_string[0])){

                            window.open(dados_string[1],'_blank');
                        }else{
                            window.location = '<? echo URL."/modulos/ocorrencia_retorno/cadastrar.php";?>';
                        }

                    }
                    else
                    {
                        alert(html);
                    }

                }else  if(tipoRetorno == 'html'){


                    $('#div3').html(html);
                    trataCliqueAba('celAba3');

                    estaTrantando = true;

                    if((html.indexOf('relatório') > 0 ) || (html.indexOf('Entre em contato com o analista') > -1 ))
                        estaTrantando = false;

                }

                //$('#result').html('').append(html);
            }
        });

    }

    function Salvar(){
        var layout = $('#Layout').val();

        if(layout == ''){
            alert('Informe o Layout do Banco.');
            return null;

        }

        tratarArquivo('js');

    }

    function verificaTratarArquivo(){

        if(estaTrantando){
            estaTrantando = false;
            tratarArquivo('html');
        }
    }


    var int=self.setInterval(function(){verificaTratarArquivo()},1000);

    </script>
	
</head>
<body>
    <table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
        <tr><td height="80" valign="top" bgcolor="#FFFFFF"><? include (DOMAIN_PATH.'topo.php') ?></td></tr>
        <tr>
            <td valign="top">
            	<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr> 
                        <td width="20" valign="top"></td>
                        <td valign="top">
                            <table width="100%" border="0" cellspacing="6" cellpadding="0">
                                <tr>
                                    <td height="25">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td align="center" valign="top"><? include(DOMAIN_PATH."includes/barra.php")?></td>
                                </tr>
                                <tr> 
                                    <td align="center" valign="top">
                                    
                                    
                                    <form action="<? echo $action_form;?>" id="form" name="form" method="post" enctype="multipart/form-data">				
                                         <table width="830" border="0" cellspacing="2" cellpadding="0" class="borda" style="margin:5px" >
                                            <tr><td colspan="2" class="text_bold_azul">&nbsp;</td></tr>
                                            <? if (!empty($erro_consulta)) {?>
                                            <tr align="center"> 
                                                <td colspan="2" width="330" >
													<div class="message error">
														<p> <strong> Desculpe, &eacute; necess&aacute;rio preencher corretamente os campos em destaque.</strong></p>
													</div>
                                                </td>
                                            </tr>
                                            <? }?>
                                            <tr>
                                                <td width="22%" height="20" align="center" class="text_bold_preto"><div id="msgUpload" style="text-align:center"><?=$msgUpload?></div></td>
                                                <td width="78%" class="text_padrao">&nbsp;</td>
                                            </tr>
                                            
                                            <?php include('r-campos.php')?>
                                            
                                            
                                            <tr> 
                                                <td colspan="2" align="right" class="text_bold_preto">&nbsp;</td>
                                            </tr>
                                        </table>
                                    </form>
                                    
                                    
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
				</table>
            </td>
        </tr>
    </table>
</body>
</html>
