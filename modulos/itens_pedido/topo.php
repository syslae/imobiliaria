    <meta http-equiv="Cache-Control" content="No-Cache">
    <meta http-equiv="Pragma"        content="No-Cache">
    <meta http-equiv="Expires"       content="0"> 
    
    <link href="<?=URL.'/webroot/css/'?>thickbox.css" rel="stylesheet" type="text/css">
    <script src="<?=URL.'/webroot/js/'?>thickbox-compressed.js"></script>
    
    <?
	if($estaNaRaiz) $js_menu ="jqueryslidemenu_raiz.js";
	else $js_menu ="jqueryslidemenu.js";
    ?>
	
    <link href="<?=URL.'/webroot/css/'?>jqueryslidemenu.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="<?=URL.'/webroot/js/'?><?=$js_menu?>"></script>
    
    <link href="<?=URL.'/'?>webroot/css/style.css" rel="stylesheet" type="text/css">
    
	<div id="mainTop">
    <img src="<?=URL.'/'?>webroot/img_sistema/sys_lae.jpg" id="topo" width="400">        
    <div id="profile_info">
        <!--<img id="avatar" alt="avatar" src="<?=URL.'/'?>webroot/img_sistema/avatar.jpg"/>-->
        <p>Usuário:<p>
            <p><strong><?=$_SESSION["nomeusuario_g"]?></strong></p>
	    <!--<p>Empresa:</p>-->
			<p><?=$_SESSION["nome_fantasia"]?></p>
    </div>
</div>    
<div id="myslidemenu" class="jqueryslidemenu" >                      
    <?
//    $DB->debug=true;
    $ADODB_CACHE_DIR = CACHE_APP;
    //$sqlEmpr = "select * from tabelas";

    /*
    $estaNaRaiz é uma variavel que aperece apenas em app/index.php e serve para indicar que estou na pagina inicial. Por tanto os includes da lateral devem ter apenas
    */
    montaMenu($estaNaRaiz);        
    ?>
<br style="clear: left" />
</div>

<span style="float:right; height:20px; margin:0 10px 5px 0;">
  <a href="<?=URL.'/'?>mudarsenha.php?keepThis=true&TB_iframe=true&height=165&width=300" title="Alterar senha" class="thickbox">
  	<img src="<?=URL.'/webroot/img_sistema/onebit_09.png'?>" title="Altere sua Senha." border="0" width="20" height="20" align="absbottom"/>
  </a>
  &nbsp;|&nbsp;
  <a href="<?=URL.'/'?>logoff.php">
  	<img src="<?=URL.'/webroot/img_sistema/shut_down.png'?>" title="Sair, Fazer Logoff" border="0" width="20" height="20" align="absbottom"/>
  </a>
</span>