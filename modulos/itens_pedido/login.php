<? session_start();
	require "funcoes.inc.php";
	include "classes/class_anti_injection.php";
	include "config/define.php";
	include "config/conexaoAr.php";
	include('config/appConfig.php');
	$anti = new AntiInjection();
	unsetSession();
	
	if (  (isset ($_POST['login'])!="") && (isset ($_POST['senha'])!=""))
	{
		if(!isset($_SESSION["idusuario_g"]))
		{
			$login= verificaTagString($anti->post('login'));
			$senha= verificaTagString($anti->post('senha'));
		
			if(!logar($login,$senha)) $erro = '<p class="error">Usuário ou senha incorretos!</p>';
		}	
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$config["tituloPagina"]?></title>
<link href="webroot/css/login.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="container">
    	<img src="webroot/img_sistema/sys_lae.jpg" width="298" height="93" border="0" style="border-left:1px solid #c2beb1; border-right:1px solid #c2beb1; border-top:1px solid #c2beb1"  />

    <div class="login_form">
    <?=$erro?>
    <form action="" method="post">
        <label>Usuário</label>
        <input type="text"  name="login" class="inputText" />
        <label>Senha</label>
        <input type="password" name="senha" class="inputText" />
        <br clear="all" />
        <button type="submit" class="green">Logar</button>
        <button type="reset" class="green">Limpar</button>
    </form>
    </div>
</div>
</body>
</html>
