<? session_start();
	require("../../config/define.php");
	require(DOMAIN_PATH."config/conexaoAr.php");
	require(DOMAIN_PATH."funcoes.inc.php");
	
	//$DB->debug = true;
	verifica ("../login.php");
	
	$idgrupo = (int)$_GET['id'];
	$tabelaPermissoesInt = (int)$_GET['tabela'];
	$idtabela = (int)$_GET['idt'];
	$status = (int)$_GET['status'];
	$idpermissao = (int)$_GET['idp'];
	
	if($tabelaPermissoesInt==1)
	{
		$tabela = 'grupo_usuario_tabelas';
		$campo = 'tabela_id';
	}
	else if($tabelaPermissoesInt==2)
	{
		$tabela = 'grupo_usuario_tabelas';
		$campo = 'tabela_id';
	}
	else if($tabelaPermissoesInt==3)
	{
		$tabela = 'grupo_usuario_menus';
		$campo = 'menu_id';
	}
	else if($tabelaPermissoesInt==4)
	{
		$tabela = 'grupo_usuarios_setor';
		$campo = 'setor_id';
	}
	
	
	if ($idpermissao<>0 and $status<>0)
	{
		$sql="update $tabela set permissao = $status where id=$idpermissao";
		$linha = $DB->Execute($sql);
	}
	else if ($idpermissao==0 and $status<>0)
	{
		if($tabelaPermissoesInt==3)
			$sql="insert into $tabela (grupo_id, $campo, permissao) values ($idgrupo, $idtabela, $status)";	
		else $sql="insert into $tabela (grupo_id, $campo, permissao) values ($idgrupo, $idtabela, $status)";	
		$linha = $DB->Execute($sql);
	}
	else if ($idpermissao<>0 and $status==0)
	{
		$sql="delete from $tabela where id=$idpermissao";
		$linha = $DB->Execute($sql);
	}
	//header("Location: $tabela.php?id=$_SESSION[idgrupo_temp]");
	
	$class01 = $class02 = $class03 = $class04 = '';
	if (empty($status))
		$class01 = 'linkMenu';
	else if ($status == 1)
		$class02 = 'linkMenu';
	else if ($status == 2)
		$class03 = 'linkMenu';
	else if ($status == 3)
		$class04 = 'linkMenu';
		
	$sqlp="select * from $tabela where $campo=$idtabela and grupo_id=$idgrupo";
	$linhap = $DB->Execute($sqlp);
	$idp= (int)$linhap->fields['id'];


	if($tabelaPermissoesInt==3 or $tabelaPermissoesInt==4)
	{ 
		?>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td align="center">
                    <a href="javascript:alterastatus(<?=$idp?>,<?=$idgrupo?>,<?=$idtabela?>,0,<?=$tabelaPermissoesInt?>);" class="<?=$class01?>">Sem Acesso</a>
                </td>
                <td align="center">
                    <a href="javascript:alterastatus(<?=$idp?>,<?=$idgrupo?>,<?=$idtabela?>,3,<?=$tabelaPermissoesInt?>);" class="<?=$class04?>">Com Acesso</a>
                </td>
            </tr>
        </table>
    	<?
	}
	else
	{
?>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td align="center">
                <a href="javascript:alterastatus(<?=$idp?>,<?=$idgrupo?>,<?=$idtabela?>,0,<?=$tabelaPermissoesInt?>);" class="<?=$class01?>">Sem Acesso</a>
            </td>
            <td align="center">
                <a href="javascript:alterastatus(<?=$idp?>,<?=$idgrupo?>,<?=$idtabela?>,1,<?=$tabelaPermissoesInt?>);" class="<?=$class02?>">Ler</a>
            </td>
            <td align="center">
                <a href="javascript:alterastatus(<?=$idp?>,<?=$idgrupo?>,<?=$idtabela?>,2,<?=$tabelaPermissoesInt?>);" class="<?=$class03?>">Ler e Escrever</a>
            </td>
            <td align="center">
                <a href="javascript:alterastatus(<?=$idp?>,<?=$idgrupo?>,<?=$idtabela?>,3,<?=$tabelaPermissoesInt?>);" class="<?=$class04?>">Total</a>
            </td>
        </tr>
    </table>
	<?
    }
	?>