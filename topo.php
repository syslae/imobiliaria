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
    <script>    

    function MM_jumpMenu(targ,selObj,restore)
    { //v3.0

        eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");

        if (restore) selObj.selectedIndex=0;

    }
	</script>
    
	<?
  //   $DB->debug=true;
	if(!empty($_SESSION["espaco_fisico_id"]))
	{
	  // $DB->debug=true;
     	$sql_espaco_fisico = "select descricao,classificacao,log_empresa from espaco_fisico where id = ".$_SESSION["espaco_fisico_id"];	
		$rs_espaco = $DB->Execute($sql_espaco_fisico);
		$class_ar=explode(".",$rs_espaco->fields["classificacao"]);
		$classificacao_uni = $class_ar[0];
     	$log_empresa = 	$rs_espaco->fields['log_empresa'];
		$rs_un=$DB->Execute("select descricao from espaco_fisico where classificacao='".$classificacao_uni."'");
		$unidade = $rs_un->fields["descricao"];
	}
	
	?>
    <div id="mainTop">
        <img src="<?=URL.'/'?>webroot/img_modulos/empresas/<?=$log_empresa?>"  style="float: left;"/>
        
        <div id="profile_info">
            <ul>
                <li class="sair"><a href="<?=URL.'/'?>login.php"><img src="<?=URL.'/'?>webroot/img_sistema/shut_down.png"/></a></li>
                <li>Bem Vindo, <span class="usuario"><?=$_SESSION["nomeusuario_g"]?></span></li>
                <li class="empress"><?=$unidade?></li>
                <li class="databrasileira"><?=dataBrasileira()?></li>
            </ul>            
        </div>
    </div>
    
    <div id="myslidemenu" class="jqueryslidemenu" >
                        
        <?
        //$DB->debug=true;
        $ADODB_CACHE_DIR = CACHE_APP;
        //$sqlEmpr = "select * from tabelas";
    	
	    $sqlEmpr = "SELECT id,descricao FROM espaco_fisico WHERE status=1 AND id IN 
					(SELECT espaco_fisico_id FROM usuarios_predios WHERE usuarios_id=".$_SESSION["idusuario_g"] .") order by descricao";

		$rsEmpr = $DB->Execute($sqlEmpr); // tempo em segundos ->18000 = 5 horas

		$WsTk = trim($_GET['WsTk']);

		if (!empty($WsTk) and strlen($WsTk)==40)

		{

			while (!$rsEmpr->EOF)

			{

				if (sha1('web'.$rsEmpr->fields['id'].'site') == $WsTk)

				{

					$_SESSION["espaco_fisico_id"] = $rsEmpr->fields["id"];
					
					redireciona($paginaAtual);

					break;

				}

				$rsEmpr->MoveNext();

			}

			$rsEmpr->MoveFirst();

		}
		
        /*
        $estaNaRaiz é uma variavel que aperece apenas em app/index.php e serve para indicar que estou na pagina inicial. Por tanto os includes da lateral devem ter apenas
        */
        montaMenu($estaNaRaiz);
        
        ?>
        <div style="float: right;margin: 2px 10px 0 0;">
            <label>Empresa: </label>
            <select name="menuAdmin" id="menuAdmin" onChange="MM_jumpMenu('parent',this,0)" class="amarelo">
<?

				while (!$rsEmpr->EOF)

				{

				?>
               <option value="?WsTk=<?=sha1('web'.$rsEmpr->fields["id"].'site')?>" <? if($_SESSION["espaco_fisico_id"] == $rsEmpr->fields["id"]) echo 'selected';?> ><?=$rsEmpr->fields["descricao"]?></option>
                <?
                $rsEmpr->MoveNext();

                    }

					?>
            </select>
        </div>
        <br style="clear: left" />
    </div>
    
    <script>
	<?
	//$_SESSION["espaco_fisico_id"]=1;	
	$espaco_fisico_topo_id=$_SESSION["espaco_fisico_id"];	
//	exit;
	if(empty($espaco_fisico_topo_id)):
	?>
		$(function()
		{
			tb_show('','<?=URL.'/'?>includes/espaco_fisico.php?height=120&width=300&modal=true&keepThis=true&TB_iframe=true',"webroot/img/loading.gif");	
		});
		function sair_tick()
		{
			tb_remove();
			document.location="<?=URL.'/'?>index.php";
			
		}
		
	<? endif; ?>
	</script>