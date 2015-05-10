<?
session_start();
	
require("config/define.php");
	require("config/conexaoAr.php");
	require("funcoes.inc.php");

 verifica ("login.php");
?>
<html>
<head>

    <title><?=$config["tituloPagina"]?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    
	<!--<link href="<?=URL.'/'?>webroot/css/estilo.css" rel="stylesheet" type="text/css">-->
    <link href="<?=URL.'/webroot/css/'?>estilo.css" rel="stylesheet" type="text/css" media="screen">
    <script src="<?=URL.'/webroot/js/'?>jquery.js"></script>

</head>
<body>
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr> 
    <td height="60" valign="top" bgcolor="#FFFFFF">
      <? 
	  $estaNaRaiz = 1;
	  include ("topo.php") ?>
    </td>
  </tr>
  <tr>
    <td valign="top"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
        <tr> 
          <td width="10" valign="top">
            
          </td>
          <td valign="top">
          <table width="100%" border="0" align="center" cellpadding="0" cellspacing="6" style="margin-top:50px;">
              <tr> 
                <td>
                    <div style="text-align:center;"><!--align="center"-->
                        <br>
                        
                        <?
                        if(!empty($_SESSION["msg_index"]))
                        {?>
                        <table width="830" border="0" cellspacing="0" cellpadding="0" align="center">
                            <tr>
                                <td class="text_bold_vermelho" style="text-align:center; font-size:14px;" height="50" valign="middle">
                                    <?=$_SESSION["nomeusuario_g"]?>, <?=$_SESSION["msg_index"] ?>
                                </td>
                            </tr>
                        </table>
                        <?
                            unset($_SESSION["msg_index"]);
                        }
                        else
                        {
                        ?>
                            <span style="font-size:14px">
                                <p class="text_padrao" style="font-size:16px">Seja Bem Vindo,</p>
                                <br/>
                                <p class="text_bold_preto" style="font-size:14px"><?=$_SESSION["nomeusuario_g"]?></p>
                            </span>
                        <?
                        }
                        ?>
                        <br/>
                        <p>
                            <span class="text_padrao">
                                Este &eacute; o seu <?=$_SESSION["acessosusuario_g"]?>&ordm; acesso.<br>
                                Seu &uacute;ltimo acesso foi em <?=$_SESSION["ultimoacessousuario_g"]?>
                            </span>
                        </p>
                        
                       
    
                        
                    </div>                
                </td>
              </tr>
              <?
			  $MsgRecado='    <tr>
                <td height="50" valign="middle" class="text_bold_vermelho" style="font-size:14px">N�o existe nenhum aviso no momento.</td>
              </tr>
              ';
			  ?>
              <tr>
                <td height="50" valign="middle" class="text_bold_vermelho" style="font-size:14px">&nbsp;</td>
              </tr>
              <tr>
                <td class="text_padrao">  <table width="80%" border="0">                  
                </table>
                </td>
              </tr>
          </table>
          </td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
