<? session_start();
	require("config/define.php");
	require(DOMAIN_PATH."config/conexaoAr.php");
	require(DOMAIN_PATH."funcoes.inc.php");
	//$conn->debug = true;
	verifica ("login.php");


	$id = $_SESSION["idusuario_g"];
	$login = $_SESSION["loginusuario_g"];
	$msgErro = "É necessário preencher o campo: ";
	if ($_POST['acao']=='cadastrar')
	{	
		$senhac = trim($_POST['senhac']);
			if (empty($senhac)) $erro = $msgErro.'Confirmar senha';
		$senha = trim($_POST['senha']);
				if (empty($senha)) $erro = $msgErro.'Senha ';
		$atual = trim($_POST['atual']);
				if (empty($atual)) $erro = $msgErro.'Atual ';
		
		if ($senhac<>$senha) $erro = 'As senhas digitadas não são iguais!!';
		
		if (empty($erro))
		{
			$atualCript = geraSenha($atual, $login);
			
			$sql1= "select login from usuarios where id = $id and senha='$atualCript'";
			$rs = $DB->Execute($sql1);
			$tr = $rs->recordCount();
			if($tr>0)
			{
				$login = $rs->fields['login'];
				$novasenha = geraSenha($senha, $login);
				
				$sql3= "update usuarios set senha='$novasenha' where id = $id;";
				if ($DB->Execute($sql3) === false) $erro = 'Erro na atualizacao';
				else header("Location: mudarsenha.php?m=1");
			}
			else 
			{
				$erro = 'A senha atual está errada.';
			}
		}
	}	
	
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Mudar senha</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="estilo.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
body {
	background-color: #EFEFEF;
}
-->
</style>
</head>

<body>
<form name="cadastro" action="mudarsenha.php" method="post">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr> 
                  <td colspan="3" valign="top"> 
                    <? if ($_GET['m']=='1')
{?>
                    <div align="center" class="text_bold_azul">
                      <b>Senha atualizada com sucesso.</b>
                    </div> 
                      <?
}
else { ?>
                      <input name="acao" type="hidden" value="cadastrar">
                    
                    <table width="100%" height="100" border="0" cellpadding="4" cellspacing="1">
                      <tr> 
                        <td height="7" colspan="2" class="text_bold_vermelho"><b><? echo $erro?></b></td>
                      </tr>
                      <tr> 
                        <td width="26%" class="text_padrao"><strong>Atual:</strong></td>
                        <td width="74%"><input name="atual" type="password" class="botao_branco" id="atual" size="20" maxlength="20"> 
                        </td>
                      </tr>
					  <tr> 
                        <td width="26%" class="text_padrao"><strong>Nova:</strong></td>
                        <td width="74%"><input name="senha" type="password" class="botao_branco" id="senha" size="20" maxlength="20"> 
                        </td>
                      </tr>
                      <tr> 
                        <td width="26%" class="text_padrao"><strong>Confirme:</strong></td>
                        <td width="74%"><input name="senhac" type="password" class="botao_branco" id="senhac" size="20" maxlength="20"> 
                        </td>
                      </tr>
                      <tr> 
                        <td width="26%" class="text_padrao">&nbsp;</td>
                        <td width="74%">
                        <input name="Enviar" type="submit" class="botao_branco" id="Enviar" value="Enviar" > 
                        </td>
                      </tr>
                    </table>
					
<? }?>					
					
                </td>
              </tr>
            </table>
</form>
</body>
</html>
