<? session_start();
	require "funcoes.inc.php";
	include "classes/class_anti_injection.php";
	include "config/define.php";
	include "config/conexaoAr.php";
	include('config/appConfig.php');
	$anti = new AntiInjection();
    session_destroy();    
    unsetSession();
	
	if (  (isset ($_POST['login'])!="") && (isset ($_POST['senha'])!=""))
	{
		if(!isset($_SESSION["idusuario_g"]))
		{
			$login= verificaTagString($anti->post('login'));
			$senha= verificaTagString($anti->post('senha'));
		
			if(!logar($login,$senha)) $erro = 'login ou senha incorretos!';
		}	
	}
	
?>
<!doctype html>
<!--[if lt IE 7 ]><html class="ie ie6" > <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" > <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" > <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> 	<html> <!--<![endif]-->
<head>

    <!-- General Metas -->
    <meta charset="ISO-8859-1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">	<!-- Force Latest IE rendering engine -->
    <title><?=$config["tituloPagina"]?></title>
    <!--[if lt IE 9]>
    <!--<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>-->
    <![endif]-->

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <!-- Folhas de estilo -->
    <!-- Stylesheets -->
    <link rel="stylesheet" href="<?=URL?>/webroot/css/base.css">
    <link rel="stylesheet" href="<?=URL?>/webroot/css/skeleton.css">
    <link rel="stylesheet" href="<?=URL?>/webroot/css/layout.css">

    <!-- Arquivos javascript -->
    <script src="<?=URL?>/webroot/js/jquery-1.8.0.min.js" type="text/javascript"></script>
    <script src="<?=URL?>/webroot/js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
    <!--[if lt IE 9]>
    <script src="<?=URL?>/webroot/js/modernizr.custom.js"></script>
    <![endif]-->
    <script src="<?=URL?>/webroot/js/jquery.flexslider-min.js" type="text/javascript"></script>
    <script src="<?=URL?>/webroot/js/functions.js" type="text/javascript"></script>
    <script type="text/javascript" src="<?=URL?>/webroot/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="<?=URL?>/webroot/js/ui.datepicker.js"></script>
    <script type="text/javascript" src="<?=URL?>/webroot/js/main.js"></script>

</head>

<body>

<? if($erro != ''){ ?>>
<div class="notice">
    <div class="warn"> <?=$erro?></div>
</div>
<? } ?>



<!-- Primary Page Layout -->

<div class="container">

    <div class="form-bg">
        <form action=""  name="formulario" method="post" enctype="multipart/form-data">
            <h2><?=$config["tituloPagina"]?></h2>
            <label class="" >Digite seu login...</label>
            <p><input type="text" name="login" value="" ></p>
            <label class="" >Digite sua senha...</label>
            <p><input type="password" name="senha" value="" ></p>
            <input type="hidden" name="acao" value="login">

            <button type="submit"></button>

            <p class="forgot">Esqueceu login ou senha? <br/><!--<a href="javascript:;" onclick="">Clique aqui para recuperá-la.</a>--><a href="javascript:;" onclick="">Procure o administrador.</a></p>

        </form>
    </div>

    <input type="hidden" name="caminho" id="caminho" value="">




</div><!-- container -->
<!-- End Document -->
</body>
</html>
