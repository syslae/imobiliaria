<? session_start();
	require("../../config/define.php");
	require(DOMAIN_PATH."config/conexaoAr.php");
	require(DOMAIN_PATH."funcoes.inc.php");

	//$DB->debug = true;
	verifica ("../../login.php");
	
	$tabela= "ocorrencia_retorno";
	$modulo = "Retorno bancário";
	$tabela_id=148;
?>
<html>
<head>
<title><?= $config["tituloPagina"]?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="<?=URL.'/webroot/css/'?>estilo.css" rel="stylesheet" type="text/css">
<script src="<?=URL.'/webroot/js/'?>jquery.js"></script>
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
                                              
                                            <?
                                            if (isset ($_GET['remover']) and empty($_POST['deletar']))
                                            {
                                                if (! isset ($_SESSION['e']))
                                                {
                                                    ?>
                                                        <div class="txt-confirmacao">
                                                            Voce deve selecionar algum registro!
                                                            <br/><a href="javascript:history.go(-1)">Voltar</a>
                                                        </div>
                                                    <?
                                                }
                                                else
                                                {
                                                //////////////
                                                ?>
                                                
                                                <div class="txt-confirmacao">
                                                    Voce realmente deseja excluir?
                                                </div>
                                                
                                                <form name="remover" method="post" action="">
                                                
                                                    <?
                                                        //$nome_arquivo = explode(",",$_GET['arquivos']);
                                                        $i = 0;
                                                        foreach ($_SESSION['e'] as $value)
                                                        {
                                                            $value1 = explode('|',$value);
                                                        ?>
                                                        
                                                            <p class="qtd-registro">Retorno: # <?=$value1[0]?> #</p>
                                                            <input type="hidden" name="c[]" value="<?=$value1[0]?>" checked>
                                                            <!--<input type="hidden" name="nome_arquivo[]" value="<?=$nome_arquivo[$i]?>" checked>
                                                            -->
                                                        <?
                                                            $i++;
                                                        }
                                                        ?>
                                                        
                                                        <? if (($_SESSION["permissao_temp"]==3))
                                                        { ?>
                                                            <input type="hidden" name="deletar" value="deletar"/>
                                                            <input name="Submit" type="submit" class="btn-confirmacao-sim" value="Sim"/>
                                                            <?  
                                                        }?>
                                                        
                                                        <? if (($_SESSION["permissao_temp"]>=1))
                                                        { ?>
                                                            <input name="Submit" type="button" class="btn-confirmacao-nao" value="Não" onClick="document.location='cadastrar.php'"/>
                                                            <?
                                                        }?>
                                                            
                                                        
                                                    </form>
                                                    <? 
                                                    /////////////
                                                }
                                            }
                                            
                                            if (isset ($_POST['deletar']))
                                            {
                                                
                                                $c = $_SESSION['e'];
                                                //$nome_arquivo = $_POST['nome_arquivo'];
                                                $i = 0;
                                                foreach ($c as $value) 
                                                {                   
                                                    /*$sql = "select NumAgencia from $tabela where NumAgencia = $value"; 
                                                    $result = $DB->Execute($sql); 
                                                    */
                                                    $value1 = explode('|',$value);

                                                    $DB->Execute("update baixa set ocorrencia_retorno_id = null where ocorrencia_retorno_id
                                                                 in (
                                                                     select id from ocorrencia_retorno where num_retorno = '$value1[0]' and banco_id = '$value1[1]'
                                                                     ) ");

                                                    $sql = "delete from ocorrencia_retorno where num_retorno = '$value1[0]' and banco_id = '$value1[1]'";

                                                    
                                                    if ($DB->Execute($sql) === false){
                                                        
                                                        alert ('Erro no delete');
                                                    }else{ 
                                                        //unlink(DOMAIN_PATH."modulos/baixa_automatica/arquivos/".$nome_arquivo[$i]);
                                                        alert('Retorno # '.$value1[0].' # apagado do Banco de Dados');

                                                        }
                                                    $i++;
                                                 }

                                                 unset($_SESSION['e']);
                                                echo "<script>window.close();</script>";
                                                 
                                                echo $GLOBALS["botaoIndex"];
                                            }?> 
                                            
                                            <?php
                                            if(isset($_SESSION["msg_index"]))
                                                unset($_SESSION["msg_index"]);
                                            ?>
    
    
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
