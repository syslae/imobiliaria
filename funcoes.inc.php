<?
	$diratual = getcwd();
	$ip = getenv("REMOTE_ADDR");

	$bg1   = "#efefef"; // F4F4F4 COR DE FUNDO PARA SEÇÕES ONDE SÃO FFFFCC 
	$bg2   = ""; // NECESSÁRIAS CORES INTERCALADAS
	//data formato mssql
	$dataDoBanco = date("Y-m-d H:i:s"); 

 function dataBrasileira() 
	{ 
		// Gerando o array com nome dos dias da semana
		$diaSemana = array("Domingo", "Segunda-feira", "Terça-feira", "Quarta-feira", "Quinta-feira", "Sexta-feira", "Sábado"); 
		// Gerando array com o nome dos meses      
		$mes = array(1=>"janeiro", "fevereiro", "março", "abril", "maio", "junho", "julho", "agosto", "setembro", "outubro", "novembro", "dezembro"); 
		// Retorno da funão
		return $diaSemana[gmdate("w")] . ", " . gmdate("d") . " de " . $mes[gmdate("n")] . " de " . gmdate("Y"); 
	}
	// ip do usuario
	$ip = getenv("REMOTE_ADDR");
	
	// tempo da sessao
	$tempoSessao_g = 80*80;
	
	// tempo do cokkie do do 10e
	$tempoCookieTop10 = 2*60*60;
	
	// de qua
	//l pagina veio
	$veioDaPagina = $_SERVER['HTTP_REFERER'];
	$paginaAtual = $_SERVER['PHP_SELF'];
	// pastas
	
	$msgAsterisco = '<span class="asterisco">*</span>';
	$botaoIndex='<center><input name="Index" type="button" class="botao_branco" value="Listar" onClick="javascript: document.location=\'index.php\';"></center>';
	
	/**
	 * Função para transformar qualquer string em URL amigável! 
	 *
	 * @param unknown_type $texto
	 * @param unknown_type $caracteres
	 * @return unknown
	 */
	function nomeValido($string) {
		$string = implode('',explode(' ',strtolower($string)));
		$string = ereg_replace("[^a-z0-9_]", "", strtr($string, "áàãâéêíóôõúüç", "aaaaeeiooouuc"));
		$chars = '()|:;\/\'"*&%$#@¨ªº°?´`,.+-!§';
		for ($i=0;$i<strlen($chars);$i++) {
			$string = str_replace($chars[$i],'',$string);
		}
		return $string;
	}

	function url_amiga($var) {
	
		$var = html_entity_decode($var);	
		$var = strtolower(stripslashes($var));
		$var = str_replace("[","",$var);				
		$var = str_replace("]","",$var);
		//$var = str_replace("'","",$var);				
		$var = str_replace("{","",$var);				
		$var = str_replace("}","",$var);				
		$var = str_replace("(","",$var);				
		$var = str_replace(")","",$var);				
		$var = str_replace("*","",$var);				
		$var = str_replace("|","",$var);				
		$var = str_replace("+","",$var);				
		$var = str_replace("=","",$var);				
		$var = ereg_replace("[áàâãªäÁÀÂÃÄ]","a",$var);			
		$var = ereg_replace("[éèêëÉÈÊË]","e",$var);		
		$var = ereg_replace("[óòôõºöÓÒÔÕºÖ]","o",$var);		
		$var = ereg_replace("[úùûüÚÙÛÜ]","u",$var);	
		$var = ereg_replace("[íìîÍÌÎ]","i",$var);		
		$var = ereg_replace("[\,.;:?/°~^´`/!\"'@#$%¨&]","",$var);			
		$var = ereg_replace("[çÇ]","c",$var);		
		$var = ereg_replace("[ñÑ]","n",$var);		
		$var = str_replace(" ","-",$var);		
					
		
		return $var;
		
	}
	
	/**
	 * Fim da função URL amigável!
	 */
	
	//corta um texto de acordo com a quantidade de carecteres selecionado
	function cortaTexto ($texto,$caracteres)
	{	
		if (strlen($texto) >= $caracteres)  
		{ 
			$texto = substr($texto,0,$caracteres).'...';   
		} 
		return $texto;
	}
	
	function redireciona ($pagina){
		echo "<script language='javascript'>document.location='$pagina';</script>";
	}
	function voltar ($pagina)
	{
		echo "<script language='javascript'>history.go($pagina);</script>";
	}
	
	function getmicrotime()
	{
		list($sec, $usec) = explode(" ",microtime());
		return ($sec + $usec);
	}
	
	// tempo de execucao
	function tempoDeLoad()
	{
		list($sec, $usec) = explode(" ",microtime());
		return ($sec + $usec);
	}
	
	#######################
	function somaDias($data,$dias,$tipo,$separador)
	{
		$ano = substr($data, 0, 4);
		$mes = substr($data, 5, 2);
		$dia = substr($data, 8, 2);
		$hora = substr($data, 11, 8);
		$dia_previsto = $dia + $dias;
		if ($tipo==1) $data_prevista = date("d".$separador."m".$separador."Y", mktime(0, 0, 0, $mes ,$dia_previsto, $ano));
		else if ($tipo==2) $data_prevista = date("Y".$separador."m".$separador."d", mktime(0, 0, 0, $mes ,$dia_previsto, $ano));
		return $data_prevista.' '.$hora;
	}
	function somaDiasBanco($data,$dias,$tipo,$separador)
	{
		$ano = substr($data, 0, 4);
		$mes = substr($data, 5, 2);
		$dia = substr($data, 8, 2);
		$hora = substr($data, 11, 8);
		$dia_previsto = $dia + $dias;
		if ($tipo==1) $data_prevista = date("d".$separador."m".$separador."Y", mktime(0, 0, 0, $mes ,$dia_previsto, $ano));
		else if ($tipo==2) $data_prevista = date("Y".$separador."m".$separador."d", mktime(0, 0, 0, $mes ,$dia_previsto, $ano));
		return $data_prevista.' '.$hora;
	}
	
	
	function logar ($login,$senha)
	{
		// usar anti injection
		$inicial='index.php';
		$login = trim("$login");
		$senha = trim("$senha");
		
		$login = addslashes($login);
		$senha = addslashes($senha);
		
		
		$senhaSha1 = geraSenha($senha, $login);
		
		if(isset ($login) && isset ($senha))
		{
			include("./config/conexaoFc.php");
			//$DB->debug = true;
			$sql= "select id,( select tipo from grupo_usuarios where id = v.grupo_id ) as tipo,grupo_id, nome, email, login, ultimoacesso, acessos from usuarios v where login = '" . $login . "' and senha = '" . $senhaSha1 . "' and status = 1";
			$result = $DB->Execute($sql);
			 $tr = $result->RecordCount();
			if ($tr>0)	
			{
				session_start();
				$_SESSION["idusuario_g"] = $result->fields['id'];
				$_SESSION["idgrupo_g"] = $result->fields['grupo_id'];
				$_SESSION["idtipo_g"] = $result->fields['tipo'];
				$_SESSION["loginusuario_g"] = $result->fields['login'];
				$_SESSION["nomeusuario_g"] = $result->fields['nome'];
				$_SESSION["emailusuario_g"] = $result->fields['email'];
				$_SESSION["ultimoacessousuario_g"] = $result->UserTimeStamp($result->fields['ultimoacesso'],'d-m-Y H:i:s');
				$_SESSION["acessosusuario_g"] = $result->fields['acessos']+1;
				unset($_SESSION["empresa_g"],$_SESSION["idempresa_g"]);
				$_SESSION["timeout_g"] = time();
				//exit;
				$sqlu= "update usuarios set acessos=acessos+1, ultimoacesso = '$GLOBALS[dataDoBanco]' where login = '$_SESSION[loginusuario_g]'";
				if ($DB->Execute($sqlu) === false)
				{
					echo 'Erro no update';
				}
				else
				{
					$sql2= "insert into logacesso (login, senha, ip, created) VALUES ('$login', '$senhaSha1', '$GLOBALS[ip]', '$GLOBALS[dataDoBanco]')";
					if ($DB->Execute($sql2) === false) echo 'Erro no insert';
					redireciona ("index.php");
				}
			}
			else 
			{
				$sql= "insert into logadmin (login, senha, ip, created) VALUES ('$login', '$senha', '$GLOBALS[ip]', '$GLOBALS[dataDoBanco]')";
				if ($DB->Execute($sql) === false) echo 'Erro no insert';
				return false;
			}
		}
	}
	
	function unsetSession()
	{
		session_start();
		unset($_SESSION["idusuario_g"],$_SESSION["Tabela"],$_SESSION["idtipo_g"],$_SESSION["loginusuario_g"],$_SESSION["nomeusuario_g"],$_SESSION["emailusuario_g"],$_SESSION["ultimoacessousuario_g"],$_SESSION["acessosusuario_g"],$_SESSION["timeout_g"],$_SESSION["empresa_g"],$_SESSION["idempresa_g"]);
	}
	
	function geraSenha($senha, $login=NULL)
	{
		if(empty($login))		
		{
			$salt = '102d10d54sdsdhf4f5f54f50f5s4f4505f';
			$gera_pass = sha1($salt.$senha.'Gênesis');
		}
		else
		{
			$salt = "0c8a1ca3e1316de28f8af408a684284c";
			$gera_pass = md5($login.$salt.$senha);
		}		
		
		return $gera_pass;
	}
	
	function verifica ($pagina)
	{
		session_start();
		$tempo = $GLOBALS["tempoSessao_g"];
		if(!isset($_SESSION["idusuario_g"]))
		{
			header("Location: ".$pagina);
			exit;
		}
		$limite  = time()-($tempo); //em segundos
		if ($_SESSION["timeout_g"] > $limite) 
		{
			$_SESSION["timeout_g"] = time(); ///Inicializa novo tempo da sessao
		}
		else 
		{
			expirou ();
		exit;
		}
	}
	
	function logoff ()
	{
		unsetSession();
		tabelaValidacaoLogin("Sessão finalizada com sucesso!");
	}
	
	function expirou (){
		session_start();
		session_destroy();
		tabelaValidacaoLogin("Sua Sessão expirou!");
	}
	function loginErrado (){
		tabelaValidacaoLogin("Login ou senha inválidos!");
	}
	
	function tabelaValidacaoLogin($msg){
	
	echo "
			<br><br><br><br>
			<table width=\"500\" border=\"0\" cellspacing=\"1\" cellpadding=\"0\" bgcolor=\"#000000\" align=\"center\">
				<tr>
					<td align=\"center\" class=\"texto\" height=\"270\" bgcolor=\"#FFFFFF\">
						<font color=\"#FF0000\" size=\"3\"><b>$msg</b></font><br><br>
						<a href=\"index.php\" class=\"link\">Clique aqui</a> para conectar-se novamente.
					</td>
				</tr>
			</table>
	";
	}
function montaSubmenu($id,$raiz=0)
	{
		$ADODB_CACHE_DIR = CACHE_APP;
		if ($raiz==1)
		{
			include("./config/conexaoFc.php");
			require("./config/define.php");
		}
		else
		{
			include("../../config/conexaoFc.php");
			require("../../config/define.php");
		}
		
		if(empty($_SESSION["idusuario_g"]))
		{
			unsetSession();
			redireciona(URL.'/login.php');
			//tabelaValidacaoLogin("Sua sessao expirou, tente novamente!");
			exit;
		}
		$texto="";
		//$DB->debug=true;
		 if($_SESSION["idtipo_g"]==0)
         {
			$sql = "select * from grupo_usuario_tabelas g, tabelas t where g.tabela_id=t.id and t.status = 1 and g.permissao<>0 and g.grupo_id=".$_SESSION["idgrupo_g"]." and t.tabela_id=".$id." order by nome asc";
			$result = $DB->CacheExecute(10,$sql);
			$tr = $result->RecordCount();
			if($tr>0)
			{
			
			    $texto.= '
					  <ul>
					';
					while (!$result->EOF)
					{
					
						
						$sqlS = "select * from grupo_usuario_tabelas g, tabelas t where g.tabela_id=t.id and t.status = 1 and g.permissao<>0 and g.grupo_id=".$_SESSION["idgrupo_g"]." and t.tabela_id=".$result->fields['id']." order by nome asc";
						$rsS = $DB->CacheExecute(10,$sqlS);
						$trS = $rsS->RecordCount();
						if($trS==0)
						{
							 $texto.= '
							<li>
								<a href="'.URL.'/modulos/'.$result->fields['pasta'].'/">'.$result->fields['nome'].'</a>
							</li>
							';
						
						}
						else
						{
						
						 $texto.= '
						<li>
							<a class="qmparent" href="javascript:;">'.$result->fields['nome'].'</a>
							'.montaSubmenu($result->fields['id'],$raiz).'
						</li>
						';
						
						}
						
						
					$result->MoveNext();
					}
				$texto.= '</ul>';	
				
				
			}
			
		 }		
		 if($_SESSION["idtipo_g"]==1)
         {
			$sql = "select * from tabelas where status = 1 and tabela_id=".$id." order by nome asc";
			$result = $DB->CacheExecute(10,$sql);
			$tr = $result->RecordCount();
			if($tr>0)
			{
			
			   $texto.= '
					  <ul>
					';
					while (!$result->EOF)
					{
					
						$sqlS = "select * from tabelas where status = 1 and tabela_id=".$result->fields['id']." order by nome asc";
						$rsS = $DB->CacheExecute(10,$sqlS);
						$trS = $rsS->RecordCount();
						if($trS==0)
						{
							 $texto.= '
							<li>
								<a href="'.URL.'/modulos/'.$result->fields['pasta'].'/">'.$result->fields['nome'].'</a>
							</li>
							';
						
						}
						else
						{
						
						     $texto.= '
						<li>
							<a class="qmparent" href="javascript:;">'.$result->fields['nome'].'</a>
							'.montaSubmenu($result->fields['id'],$raiz).'
						</li>
						';
						
						}
						
						
						
					$result->MoveNext();
					}
				$texto.= '</ul>';	
			
			}
			
		 }	
		return $texto;
	}
	
	
	function montaMenu($raiz=0)
	{
	
		//$ADODB_CACHE_DIR = CACHE_APP;
		if ($raiz==1)
		{
			include("./config/conexaoFc.php");
			require("./config/define.php");
		}
		else
		{
			include("../../config/conexaoFc.php");
			require("../../config/define.php");
		}
		
		
		
		if(empty($_SESSION["idusuario_g"]))
		{
			unsetSession();
			redireciona(URL.'/login.php');
			//tabelaValidacaoLogin("Sua sessao expirou, tente novamente!");
			exit;
		}   
		//$DB->debug=true;	
		echo'
		<ul id="qm0" class="qmmc">
			<li>
				<a href="'.URL.'/index.php">Principal</a>
				
			</li>';
			
		 if($_SESSION["idtipo_g"]==0)
         {
               
                $sql= "select m.id,m.nome from grupo_usuario_menus g, menus m where g.menu_id=m.id and m.status = 1 and g.permissao<>0 and g.grupo_id=".$_SESSION["idgrupo_g"]." order by m.ordem asc";
                $result = $DB->Execute($sql);
                //$result = $DB->CacheExecute(10,$sql); // tempo em segundos -> 300 = 5 minutos
                 
				while (!$result->EOF)
				{
					echo '
					<li >
						<a class="qmparent" href="javascript:;">'.$result->fields['nome'].'</a>
					
					';
						$sql2= "select * from grupo_usuario_tabelas g, tabelas t where g.tabela_id=t.id and t.status = 1 and t.menu_id =".$result->fields['id']." and g.permissao<>0 and g.grupo_id=".$_SESSION["idgrupo_g"]." and t.tabela_id=0 order by nome asc";
						//$result = $DB->Execute($sql);
						$result2 = $DB->Execute($sql2); // tempo em segundos -> 300 = 5 minutos
                 		$tr = $result2->RecordCount();
						if($tr>0)
						{
							echo '
							  <ul>
							';
							while (!$result2->EOF)
							{
								$sqlS = "select * from grupo_usuario_tabelas g, tabelas t where g.tabela_id=t.id and t.status = 1 and g.permissao<>0 and g.grupo_id=".$_SESSION["idgrupo_g"]." and t.tabela_id=".$result2->fields['id']." order by nome asc";
								$rsS = $DB->Execute($sqlS);
								$trS = $rsS->RecordCount();
								if($trS==0)
								{
									echo '
									<li>
										<a href="'.URL.'/modulos/'.$result2->fields['pasta'].'/">'.$result2->fields['nome'].'</a>
									</li>
									';
								
								}
								else
								{
								
								echo '
								<li>
									<a class="qmparent" href="javascript:;">'.$result2->fields['nome'].'</a>
									'.montaSubmenu($result2->fields['id'],$raiz).'
								</li>
								';
								
								}
								
								
								$result2->MoveNext();
							}
						echo '</ul>';	
						}					
					echo '</li>';	
					
				$result->MoveNext();
				}
		}
				
		if($_SESSION["idtipo_g"]==1)
         {
				//$DB->debug=true;               
                $sql= "select id,nome from menus where status = 1 order by ordem asc";
                //$result = $DB->Execute($sql);
                $result = $DB->Execute($sql); // tempo em segundos -> 300 = 5 minutos
                //$result = $DB->CacheExecute(10,$sql); // tempo em segundos -> 300 = 5 minutos
				 
				while (!$result->EOF)
				{
					echo '
					<li>
						<a class="qmparent" href="javascript:;">'.$result->fields['nome'].'</a>
					
					';
						$sql2= "select * from tabelas where status = 1 and menu_id =".$result->fields['id']." and tabela_id=0 order by nome asc";
						//$result = $DB->Execute($sql);
						$result2 = $DB->Execute($sql2); // tempo em segundos -> 300 = 5 minutos
                 		$tr = $result2->RecordCount();
						if($tr>0)
						{
							echo '
							  <ul>
							';
							while (!$result2->EOF)
							{
							
								
								$sqlS = "select * from tabelas where status = 1 and tabela_id=".$result2->fields['id']." order by nome asc";
								$rsS = $DB->Execute($sqlS);
								$trS = $rsS->RecordCount();
								if($trS==0)
								{
									echo '
									<li>
										<a href="'.URL.'/modulos/'.$result2->fields['pasta'].'/">'.$result2->fields['nome'].'</a>
									</li>
									';
								
								}
								else
								{
								
								echo '
								<li>
									<a class="qmparent" href="javascript:;">'.$result2->fields['nome'].'</a>
									'.montaSubmenu($result2->fields['id'],$raiz).'
								</li>
								';
								
								}
								
								$result2->MoveNext();
								
								
							}
						echo '</ul>';	
						}					
					echo '</li>';	
					
				$result->MoveNext();
				}
		}		
		echo '<li class="qmclear">&nbsp;</li>';
		echo '</ul>';
			
		
	}
	
	

	

	
	function verificaAcesso ($idtabela)
    {
        include("../../config/conexaoFc.php");
        if(empty($_SESSION['idusuario_g']))
        {
            redireciona('../../login.php');
            exit;
        }
				
		if ($_SESSION["idtipo_g"]==1)
		{
			$_SESSION["permissao_temp"]=3;
		}
		else
			{
			$sql = "select * from grupo_usuario_tabelas where tabela_id=$idtabela and grupo_id=$_SESSION[idgrupo_g]";        
			$rs = $DB->Execute($sql);
			$permissao=$rs->fields['permissao'];
				if (empty($permissao))
				{
					$_SESSION["msg_index"] = 'Lamentamos mas voc&ecirc; n&atilde;o tem permiss&atilde;o para acessar essa &aacute;rea.';
					//alertAcessoNegado();
					echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL= ../index.php">';
					exit;
					//header("Location: ../index.php");
				}
				else if ($permissao==1) 
				{
				//echo '[Acesso a somente leitura]';
				}
				else if ($permissao==2) 
				{
				//echo '[Acesso a leitura e salvar dados]';
				}
				else if ($permissao==3) 
				{
				//echo '[Acesso total]';
				}
				$_SESSION["permissao_temp"]=$permissao;
				}
			}
	
	function botaoEnviar()
	{
		if (($_SESSION["permissao_temp"]==3))
		{ ?><title>secoes</title>
			<br><br><center><input name="Submit" type="submit" class="botao_branco" value="Gravar"></center><br><br>
	<? 	}
	}
	function botaoRemover()
	{
		if (($_SESSION["permissao_temp"]==3))
		{ ?>
			<input type="submit" name="remover_" value="Excluir" class="botao_branco"> 
			<input type="hidden" name="remover" value="remover" class="input_branco">
	<? 	}
	}
	function botaoEscolher()
	{
		if (($_SESSION["permissao_temp"]==3))
		{ ?>
			<input type="submit" name="remover_" value="Escolher" class="botao_branco"> 
			<input type="hidden" name="remover" value="remover" class="input_branco">
	<? 	}
	}
	
	function botaoSim()
	{
		if (($_SESSION["permissao_temp"]==3))
		{ ?>
			<center><input type="hidden" name="deletar"><input name="Submit" type="submit" class="botao_branco" value="Sim"></center>
	<? 	}
	}
	function botaoNao()
	{
		if (($_SESSION["permissao_temp"]>=1))
		{ ?>
			<center><input name="Submit" type="button" class="botao_branco" value="Não" onclick="document.location='index.php'"></center>
	<? 	}
	}
	
	function botaoCheckbox($valor, $class = 'checkbox')
	{
		if (($_SESSION["permissao_temp"]==3))
		{ 
			echo '<input type="checkbox" name="c[]" class="'.$class.'" value="'.$valor.'">';
		}
	}
	
	function botaoimg($valor)
	{
		if (($_SESSION["permissao_temp"]==3))
		{ 
		?>
		<input type="image" src="../../webroot/img_sistema/estorno.png"  value="<?=$valor?>" name="c"/>
		<?
        }
	}
	
	
	function alert($mensagem)
	{
		echo '<script>alert("'.$mensagem.'");</script>';
	}
	function alertAcessoNegado()
	{
		echo '<script>alert("Você não tem acesso a essa área!");document.location=\' ../index.php?e=n\';</script>';
	}
	
	
	function escreveAlbum($texto, $arquivo)
	{
		$ddf = fopen('../../imgDestaques/'.$arquivo,'w+');
		fwrite($ddf,$texto);
		fclose($ddf);
	}
	
	
	function error($numero,$texto)
	{
		$ddf = fopen('error.log','a');
		fwrite($ddf,"[".date("r")."] Error $numero: $texto\r\n");
		fclose($ddf);
	}
	
	function logs($texto)
	{
		$usuario = $_SESSION["nomeusuario_g"];
		$idusuario = $_SESSION["idusuario_g"];
		$mensagem = "[".date("r")."] - $usuario: $texto\r\n";
		//echo $mensagem;
		
		include("./config/conexao.php");
		//$DB->debug = true;
		$data = date('Y-m-d');
		$sqlM = "select data, log from log where data = '".$data."' and idusuario = $idusuario";
		$rsM = $DB->Execute($sqlM);
		$trM = $rsM->RecordCount();
		if ($trM==0)
		{
			$sql2 = "insert into log (idusuario, data, log) values ($idusuario, '$data', '$mensagem')";
		}
		else
		{
			$log = $rsM->fields['log'].$mensagem;
			$sql2 = "update log set log = '$log' where idusuario = $idusuario and data = '$data'";
		}
		$rs2 = $DB->Execute($sql2);
	}
	
		
	function nomeNaPasta($extensao,$pasta)
	{
		global $config;
		//$temp = substr(md5(uniqid(time())), 0, 10);
		$temp = "file_".date("dmYHis");
		$imagem_nome = $temp . "." . $extensao;
	
		if(file_exists($pasta . $imagem_nome))
		{
			$imagem_nome = nomeNaPasta($extensao);
		}
		return $imagem_nome;
	}
	function nome($extensao,$pasta)
	{
			
			$temp = substr(md5(uniqid(time())), 0, 10);
			$imagem_nome = $temp . "." . $extensao;

			if(file_exists($pasta . $imagem_nome))
			{
				$imagem_nome = nome($extensao,$pasta);
			}
			return $imagem_nome;
	}
					
					
	function fazUpload($arquivo, $pasta)
	{
		if (move_uploaded_file($arquivo, $pasta)) //upload do arquivo HTML
		{
			chmod($pasta,01777);
			return 1;
		}else{
			return 2;
		}
	}
	
	
	function isValidDateTime($dateTime)
	{
		if (preg_match("/^(\d{4})-(\d{2})-(\d{2}) ([01][0-9]|2[0-3]):([0-5][0-9]):([0-5][0-9])$/", $dateTime, $matches)) {
			if (checkdate($matches[2], $matches[3], $matches[1])) {
				return true;
			}
		}
	
		return false;
	}
	
	
	
	
	//FUNÇOES QUE GERAM OS SELECTS
	//Gera select Entrada
	function GeraSelectEntrada($dados)
	{
		include("config/conexaoFc.php");
		//$DB->debug = true;
		$sql = "SELECT dbo.produto_unidade_medida.produto_id, dbo.produto_unidade_medida.unidade_medida_id, 
                dbo.unidade_medida.descricao AS DescricaoUnidadeMedida, dbo.unidade_medida.quantidade AS Quantidade, 
                dbo.medida_basica.descricao AS DescricaoMedidaBasica  FROM  dbo.produto_unidade_medida INNER JOIN
                dbo.unidade_medida ON dbo.produto_unidade_medida.unidade_medida_id = dbo.unidade_medida.id INNER JOIN
                dbo.medida_basica ON dbo.unidade_medida.medida_basica_id = dbo.medida_basica.id WHERE (dbo.produto_unidade_medida.produto_id = '".$dados['IdProduto']."')";		
		$rs = $DB->Execute($sql);
		$texto = '
		<select name="'.$dados["nome_input"].'" id="'.$dados["id"].'"  class="'.$dados["class"].'" onChange="'.$dados["onchange"].'">
		<option  value="0">Escolha uma opção</option>
		';
		while (!$rs->EOF)
		{
			$texto.='<option  id="unidade" value="'.$rs->fields['unidade_medida_id']."-".$rs->fields['Quantidade']."/".$rs->fields['DescricaoUnidadeMedida']."(". $rs->fields['Quantidade']."-".$rs->fields['DescricaoMedidaBasica'].")".'">'.$rs->fields['DescricaoUnidadeMedida']." (". $rs->fields['Quantidade']." - ".$rs->fields['DescricaoMedidaBasica'].")".'</option>'."\r\n";
			$rs->MoveNext();
		}

		$texto.='</select>';
		
		echo $texto;
	}
		
	function geraSelect($dados)
	{
		include("config/conexaoFc.php");
		//$DB->debug = true;
     	$sql = "select ".$dados['primary_key'].",".$dados['nome']." from ".$dados['tabela']." ".$dados['condicao']." ";		
		$rs = $DB->Execute($sql);
		$texto = '
		<select name="'.$dados["nome_input"].'" id="'.$dados["id"].'" class="'.$dados["class"].'" onChange="'.$dados["onchange"].'">
		<option id="'.$dados["id_option"].'" value="0">Escolha uma opção</option>
		';
		while (!$rs->EOF)
		{
			$texto.='<option id="'.$dados["id_option"].'" value="'.$rs->fields[$dados['primary_key']].'"'; 
			if($dados["value"] == $rs->fields[$dados['primary_key']]) $texto.= 'selected'; $texto.='>'
			.$rs->fields[$dados['nome']].'</option>'."\r\n";
			$rs->MoveNext();
		}

		$texto.='</select>';
		
		echo $texto;
	}

	function geraSelectProdutos($dados)
	{
		include("config/conexaoFc.php");
		//$DB->debug = true;
     	$sql = "select ".$dados['primary_key'].",".$dados['nome']." from ".$dados['tabela']." ".$dados['condicao']." ";		
		$rs = $DB->Execute($sql);
		$texto = '
		<select name="'.$dados["nome_input"].'" id="'.$dados["id"].'" class="'.$dados["class"].'" onChange="'.$dados["onchange"].'">
		';
		while (!$rs->EOF)
		{
			$texto.='<option id="'.$dados["id_option"].'" value="'.$rs->fields[$dados['primary_key']].'"'; 
			if($dados["value"] == $rs->fields[$dados['primary_key']]) $texto.= 'selected'; $texto.='>'
			.$rs->fields[$dados['nome']].'</option>'."\r\n";
			$rs->MoveNext();
		}

		$texto.='</select>';
		
		echo $texto;
	}

    function geraSelectNomeFantasia($dados)
	{
		include("config/conexaoFc.php");
		//$DB->debug = true;
        $sql = "select ".$dados['primary_key'].",".$dados['nome'].",".$dados['nome2'].",tipo from ".$dados['tabela']." ".$dados['condicao']." ";		
		$rs = $DB->Execute($sql);
		$texto = '
		<select name="'.$dados["nome_input"].'" id="'.$dados["id"].'" class="'.$dados["class"].'" onChange="'.$dados["onchange"].'">
		<option id="'.$dados["id_option"].'" value="0">Escolha uma opção</option>
		';
		while (!$rs->EOF)
		{
			
            if($rs->fields['tipo'] == 'F')
            {
               $Nome =  'nome';
            }
            else if($rs->fields['tipo'] == 'J')
            {
               $Nome =  'nome_fantasia';
            }   
            
            $texto.='<option id="'.$dados["id_option"].'" value="'.$rs->fields[$dados['primary_key']].'"'; 
			if($dados["value"] == $rs->fields[$dados['primary_key']]) 
            $texto.= 'selected'; $texto.='>'
			.$rs->fields[$Nome].'</option>'."\r\n";
			$rs->MoveNext();
		}

		$texto.='</select>';
		
		echo $texto;
	}	
	function geraSelectEspecifico($dados)
	{
		include("config/conexaoFc.php");
		//$DB->debug = true;
	
		if(isset($dados['nome3']))
		{
		  	$sql = "select ".$dados['primary_key'].",".$dados['nome'].",".$dados['nome3']." from ".$dados['tabela']." ".$dados['condicao']." ";		
		}
		else
		{
		 	$sql = "select ".$dados['primary_key'].",".$dados['primary_key2'].", ".$dados['nome'].",".$dados['nome2'].",(select ".$dados['nome']." from ".$dados['tabela2']." where id = v.".$dados['primary_key2'].") as DescricaoMedidaBasica from ".$dados['tabela']." v ".$dados['condicao']."";	
		}
		$rs = $DB->Execute($sql);
		
		$texto = '
		<select name="'.$dados["nome_input"].'" id="'.$dados["id"].'" class="'.$dados["class"].'" onChange="'.$dados["onchange"].'">
		<option id="'.$dados["id_option"].'" value="0">Escolha uma opção</option>';
		while (!$rs->EOF)
		{
			if(isset($rs->fields[$dados['nome3']]))
			{
				$texto.='<option id="'.$dados["id_option"].'" value="'.$rs->fields[$dados['primary_key']].' '.$rs->fields[$dados['nome']].'('.trim($rs->fields[$dados['nome3']]).'-Grau)"'; 
				if($dados["value"] == $rs->fields[$dados['primary_key']]) $texto.= 'selected'; $texto.='>'.$rs->fields[$dados['nome']].' ('.$rs->fields[$dados['nome3']].'- Grau) </option>'."\r\n";
			}
			else
			{
				$texto.='<option id="'.$dados["id_option"].'" value="'.$rs->fields[$dados['primary_key']].' '.$rs->fields[$dados['nome']].'('.$rs->fields['quantidade'].'-'.$rs->fields['DescricaoMedidaBasica'].')"'; 
				if($dados["value"] == $rs->fields[$dados['primary_key']]) $texto.= 'selected'; $texto.='>'
				.$rs->fields[$dados['nome']].' ('.$rs->fields['quantidade'].' - '.$rs->fields['DescricaoMedidaBasica'].')</option>'."\r\n";
			}
		    $rs->MoveNext();
	   }
		
		$texto.='</select>';
		
		echo $texto;
	}
	
	
	function geraSelectSaida($dados)
	{
		include("config/conexaoFc.php");
		//$DB->debug = true;
		$sql = "select ".$dados['primary_key'].",".$dados['primary_key2'].", ".$dados['nome'].",".$dados['nome2'].",(select ".$dados['nome']." from ".$dados['tabela2']." where id = v.".$dados['primary_key2'].") as DescricaoMedidaBasica from ".$dados['tabela']." v ".$dados['condicao']."";	
		$rs = $DB->Execute($sql);
		
		$texto = '
		<select name="'.$dados["nome_input"].'" id="'.$dados["id"].'" class="'.$dados["class"].'" onChange="'.$dados["onchange"].'">
		<option id="'.$dados["id_option"].'" value="0">Escolha uma opção</option>';
		while (!$rs->EOF)
		{
		
			$texto.='<option id="'.$dados["id_option"].'" value="'.$rs->fields[$dados['primary_key']].'-'.$rs->fields['quantidade'].'/'.$rs->fields[$dados['nome']].'('.$rs->fields['quantidade'].'-'.$rs->fields['DescricaoMedidaBasica'].')"'; 
				if($dados["value"] == $rs->fields[$dados['primary_key']]) $texto.= 'selected'; $texto.='>'
				.$rs->fields[$dados['nome']].' ('.$rs->fields['quantidade'].' - '.$rs->fields['DescricaoMedidaBasica'].')</option>'."\r\n";
			
		$rs->MoveNext();
	   }
		
		$texto.='</select>';
		
		echo $texto;
	}
	
	function checkbox($nome, $value=null)
	{
		$texto = '<input type="checkbox" name="'.$nome.'" id="'.$nome.'" value="1"';
		if($value==1) $texto.= '"checked"'; 
		$texto.=' />';
		return $texto;
	}
	
	
	
	function retornaNome($tabela=null, $campo=null, $value=null)
	{
		include("../../config/conexaoFc.php");
		//$DB->debug = true;
		
		if(!empty($tabela) and !empty($campo) and !empty($value) )
		{
	    $sql = "select ".$campo." from ".$tabela." where id = ".$value;	

			$rs = $DB->Execute($sql);
	$tr = $rs->RecordCount();
			if ($tr==0)
				$texto = '- - - - -';
			else $texto = $rs->fields[$campo];
		}
		
		return   $texto;
	}
	
	
	
	function contaRows($tabela,$condicao=null)
	{
		include("../../config/conexaoFc.php");
		//$DB->debug = true;
		$sql = "select count(*) as id from $tabela $condicao";
			
		$rs = $DB->Execute($sql);
		$tr = $rs->fields['id'];
		
		return $tr;
	}
	

	function checkStatus($status){
	if(!isset($status)) 
		echo "checked";
	else 
		if($status==1)
		echo "checked";
	}
function selectStatus($status){

$texto = '
		<select name="status">
		<option value="1" >Ativado</option>
		<option value="0" ';
				
if(($status==0) and (isset($status)))
	$texto.='selected ';
 
$texto.='>Desativado</option>';
		
				
return $texto;
}
	
	
	
	function retirar_acentos_caracteres_especiais($string) {
		$palavra = strtr($string, "ŠŒŽšœžŸ¥µÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýÿ", "SOZsozYYuAAAAAAACEEEEIIIIDNOOOOOOUUUUYsaaaaaaaceeeeiiiionoooooouuuuyy");
		$palavranova = str_replace("_", " ", $palavra);
	return $palavranova; 
	}
	
//##############FUNÇÕES DE SEGURANÇA DE CHAVE	##################
	function Chave($id)
	{
		include("config/conexaoFc.php");
		$div = str_split($id);//retorna a string em um array
		$cont=0;
		$chave ="";
		foreach($div as $valor)
		{
			$cont++;
			$rsGeraChave = $DB->Execute("select chave from chaves where numero=".$valor."");	
			$c = $rsGeraChave->fields['chave'];
			if($cont==1)$chave.=$c;
			else $chave.="i".$c;
		}
		
		return $chave;
	
	}
	function retornaValorChave($chave)
	{
		include("config/conexaoFc.php");
		$descr = explode("i",$chave);
		//print_r($descr);
		$numero="";
		foreach($descr as $valor)
		{   
		  
			$rsChave = $DB->Execute("select chave,numero from chaves where chave = '".$valor."'");
			$tr=$rsChave->RecordCount();
			if($tr==0)
			{
			    echo "Letras apagadas";
				misturaChaveBanco(1);
			    return false;
			}
			
			$chave = $rsChave->fields['chave'];
		
			if(strcmp ( $chave, $valor)!=0)
			{
			    echo "Letras alteradas";
				misturaChaveBanco(1);
				return false;
			}
				
				
			$n = $rsChave->fields['numero'];
			
			$numero .=$n;
		  	  
		}
		return $numero;
	}
	function atualizaQtdChaveBanco()
	{
		include("config/conexaoFc.php");
		////$misturada = str_shuffle($str);//Mistura uma string aleatoriamente
		$DB->debug=true;
		$rs = $DB->Execute("select * from chaves");
		while(!$rs->EOF)
		{
			$cont=strlen($rs->fields['chave']);
			$DB->Execute("update chaves set qtd=".$cont." where id=".$rs->fields['id']."");
			echo "Update<br>";
			$rs->MoveNext();
		}
	}
	function misturaChaveBanco($var=0)
	{
		include("config/conexaoFc.php");
		//$misturada = str_shuffle($str);//Mistura uma string aleatoriamente
		$DB->debug=true;
		$rsT = $DB->Execute("select * from datachave");
		
		$data=explode("-",date("Y-m-d"));
		$data_hoje=$data[2]."-".$data[1]."-".$data[0];
		$data=explode("-",$rsT->fields['data']);
		$data_banco=$data[2]."-".$data[1]."-".$data[0];
		
		$inicial = strtotime($data_banco); // 07/04/2003 (mm/dd/aaaa) data menor
  		$final = strtotime($data_hoje);    // 07/10/2003 (mm/dd/aaaa) data maior
		
		if(($final-$inicial)/86400>=0)
		{
			$rs = $DB->Execute("select * from chaves");
			while(!$rs->EOF)
			{
				$chav=gerarandonstring($rs->fields['qtd']);
				$DB->Execute("update chaves set chave='".$chav."' where id=".$rs->fields['id']."");
				echo "Update<br>";
				$rs->MoveNext();
			}
			$data=somaDias(date("Y-m-d"),3,2,'-');			
			$DB->Execute("update datachave set data='".$data."' where id=1 ");
		}
		if($var==1)
		{
			$rs = $DB->Execute("select * from chaves");
			while(!$rs->EOF)
			{
				$chav=gerarandonstring($rs->fields['qtd']);
				$DB->Execute("update chaves set chave='".$chav."' where id=".$rs->fields['id']."");
				echo "Update<br>";
				$rs->MoveNext();
			}
		}
		
	}
	function gerarandonstring($n){
		$str = "ABCDEFGHIJLMNOPQRSTUVXZYWKabcdefghjlmnopqrstuvxzywk0123456789_-";
		$cod = "";
		for($a = 0;$a < $n;$a++){
		$rand = rand(0,63);
		$cod .= substr($str,$rand,1);}
		return $cod;
	}
//############################################


	function verificaTagString($str)//verifica se tem tags html ou php
	{
		return strip_tags($str);
	}
	
	function retornaFilhosCliente($id=NULL)
	{
        global $DB;

		if(empty($id)) return;
		else
		{
			foreach($id as $cliente)
			{
				$rs_cliente = $DB->Execute(" select * from cliente where id = $cliente");
                if($rs_cliente->RecordCount() >0 ) echo '<div id="filhos_clientes'.$rs_cliente->fields["id"].'">Cliente: &nbsp;&nbsp;<strong>'.$rs_cliente->fields["nome"].'</strong><input type="hidden" name="cliente_id[]" value="'.$rs_cliente->fields["id"].'" id="cliente_id" "/><a href="javascript:;" onclick="javascript: ExcluirCliente('.$rs_cliente->fields["id"].')"> <img src="../../webroot/img_sistema/nao_permite.png" title="Remover Cliente do Pedido" align="right" border="0"/></a><hr><br></div>';

			}
		}
		
	}

	function retornaFilhosProduto($id=NULL)
	{
        global $DB;

        if(empty($id)) return;
        else
        {
            foreach($id as $produto)
            {
                $rs_produto = $DB->Execute(" select * from produto where id = $produto");
                if($rs_produto->RecordCount() >0 ) echo '<div id="filho'.$rs_produto->fields["id"].'">Produto: &nbsp;<strong>'.$rs_produto->fields["codigo"].' '.$rs_produto->fields["descricao"].'</strong><br>Quantidade: &nbsp;<strong>1</strong> &nbsp; Valor Unitario: R$ &nbsp;<strong>'.$rs_produto->fields["valor"].'</strong> &nbsp; Valor Total: R$ &nbsp;<strong>'.$rs_produto->fields["valor"].'</strong><input type="hidden" name="produto_id[]" value="'.$rs_produto->fields["id"].'" /><input type="hidden" name="quantidade[]" value="1" /><input type="hidden" name="valor_unitario[]" value="'.$rs_produto->fields["valor"].'" /><input type="hidden" name="valor_total[]" value="'.$rs_produto->fields["valor"].'" /><a href="javascript:;" onclick="javascript: excluir('.$rs_produto->fields["id"].','.$rs_produto->fields["id"].','.$rs_produto->fields["valor"].')"><img src="../../webroot/img_sistema/nao_permite.png" title="Remover Item do Pedido" align="right" border="0"/></a><hr><br></div>';

            }
        }
		
	}

    function retornaFilhosParcelas($vencimento,$valor_parcela)
    {
        if(empty($valor_parcela)) echo 'Total: 0 ';
        else
        {
            foreach($valor_parcela as $key => $valor)
            {
                $i = $key + 1;
                echo '<div id="filho_parcela'.$i.'">Parcela: &nbsp;<strong>'.$i.'</strong> &nbsp; Vencimento: &nbsp;<strong><input type="text" class="input_branco data" name="vencimento[]" maxlength="10" onkeypress="Mascara(this,mascData);" value="'.$vencimento[$key].'"/></strong> &nbsp; Valor: R$ &nbsp;<strong> R$ '.$valor.'</strong><input type="hidden" name="valor_parcela[]" value="'.$valor.'" /><hr><br></div>';

            }
        }

    }

    function retornaFilhosEstoque($estoque_id,$codigo,$estoque,$valor_estoque,$status_estoque)
    {

        if(is_array($estoque_id)){

            foreach($estoque_id as $key => $id)
            {
                $i = $key + 1;
                echo '<div id="filhos_estoque'.$i.'"><input type="hidden" class="input_branco" name="estoque_id[]" value="'.$id.'"/>
                Código: &nbsp;<strong><input type="text" class="input_branco" name="codigo[]" maxlength="30" size="10" value="'.$codigo[$key].'"/></strong> &nbsp;
                Estoque: &nbsp;<strong><input type="text" class="input_branco" name="estoque[]" maxlength="80" size="32" value="'.$estoque[$key].'"/></strong> &nbsp; Valor: R$ &nbsp;<input type="text" class="input_branco" name="valor_estoque[]" maxlength="11" onkeypress="Mascara(this,mascValor);" value="'.$valor_estoque[$key].'"/> &nbsp; Disponível: &nbsp;
                <select name="status_estoque[]"><option value="1">SIM</option><option value="0" '; if($status_estoque[$i] == 0) echo 'selected'; echo '>NÃO</option></select>
                <a href="javascript:;" onclick="javascript: ExcluirCliente('.$i.')"> <img src="../../webroot/img_sistema/nao_permite.png" title="Remover Item" align="right" border="0"/></a><hr><br></div>';

            }

        }

    }



    function ValitarDel($tabela_id,$descricao,$tabela1,$tabela2,$id)
	{
		include("config/conexaoFc.php");

	 $sql = "select ".$tabela_id.", (select ".$descricao." from ".$tabela1." where id = v.".$tabela_id.") as 
descricao from  ".$tabela2." v where ".$tabela_id." = ".$id." and  status = 1";   
		 $rs  = $DB->Execute($sql);	
		 $descricao = $rs->fields['descricao'];
		 $num_linhas = $rs->RecordCount();		
	   	 
		 if($num_linhas > 0)
		 {
		 	$num_linhas = 1;		
		 
		 }
		 
		 $dados = array("num_linhas"=>"$num_linhas","descricao"=>"$descricao"); 
	        
	return $dados;
	}
		
		
		
		function retornaProdutosAdd($id=NULL)
	{
		if(empty($id)) return;
		else
		{
			include("../../config/conexaoFc.php");
			ECHO $sql="SELECT produto_id,unidade_medida_id,quantidade_final,valor,
				(SELECT descricao FROM produto WHERE id=i.produto_id) as nome_produto
				FROM itens i WHERE entrada_id='".$id."'";
				
			$rs=$DB->Execute($sql);
			
			while(!$rs->EOF)
			{
				echo '<input type="hidden" value="1" id="'.$rs->fields["produto_id"].'p" />';
				
				$rs->MoveNext();	
			}
		}
		
	}	
	function moeda($valor) 
    {
		$valor = str_replace(",","", $valor);
	    $valor = number_format($valor, 2, ',', '.');
	    return $valor;
	}	
	function retornaFilhosSaida($id=NULL)
	{
		if(empty($id)) return;
		else
		{
			include("../../config/conexaoFc.php");
				
			$sql = ("SELECT dbo.saida.id, dbo.itens.produto_id, dbo.itens.quantidade_final, dbo.itens.unidade_medida_id, 		dbo.produto.descricao,dbo.unidade_medida.quantidade AS DescricaoQuantidade, dbo.unidade_medida.descricao AS DescricaoUnidadeMedida,dbo.medida_basica.descricao AS DescricaoMedidaBasica FROM  dbo.saida INNER JOIN dbo.itens ON dbo.saida.id = dbo.itens.saida_id INNER JOIN dbo.produto ON dbo.itens.produto_id = dbo.produto.id INNER JOIN dbo.unidade_medida ON dbo.itens.unidade_medida_id = dbo.unidade_medida.id INNER JOIN dbo.medida_basica ON dbo.unidade_medida.medida_basica_id = dbo.medida_basica.id WHERE     (dbo.saida.id = ".$id.")");
			$rs=$DB->Execute($sql);
			while(!$rs->EOF)
			{
				echo '<div id="filho'.$rs->fields["produto_id"].$rs->fields["unidade_medida_id"].'">Produto:'.$rs->fields["descricao"].'<br> Unidade Medida:'.$rs->fields["DescricaoUnidadeMedida"].' ('.$rs->fields["DescricaoQuantidade"].' - '.$rs->fields["DescricaoMedidaBasica"].')<br>Qtd Final:'.$rs->fields["quantidade_final"];
				echo '<br><input type="hidden" name="produto_id[]" value="'.$rs->fields["produto_id"].'" /><input type="hidden"  name="unidade_medida_id[]" value="'.$rs->fields["unidade_medida_id"].'" /><input type="hidden"  name="quantidade_final[]" value="'.$rs->fields["quantidade_final"].'" /><a href="javascript:;" onclick="javascript: excluir('.$rs->fields["produto_id"].$rs->fields["unidade_medida_id"].','.$rs->fields["produto_id"].')">Deletar</a><hr></div>';
				
				$rs->MoveNext();	
			}
		}
		
	}
     function verificarMax($tabela)
	{
	   include("../../config/conexaoFc.php");
	   $sql = ("select  *from ".$tabela."");
	   $rs = $DB->Execute($sql);
       $NumLinhas = $rs->RecordCount();
	   $numero =  $NumLinhas+1;
		 return $numero;
	}
	
		  function TrazerNome($id)
{
    require(DOMAIN_PATH."config/conexaoFc.php");
    $Sql = "select *from cliente where id = '".$id."'";
   	$rs = $DB->Execute($Sql);
    
    if($rs->fields['tipo'] == "F")
    {
        
        $Nome = $rs->fields['nome'];
        
    }
    else
    {
       $Nome = $rs->fields['nome_fantasia'];
        
    }
    
    return $Nome;
}

function formata_data($data, $explode = "-", $concatena = "/") {
    $DataFormat = '';
    if ($data) {
        $data2 = explode(" ", $data);
        $data2 = explode($explode, $data2[0]);
        $DataFormat = $data2[2] . $concatena . $data2[1] . $concatena . $data2[0];
    }
    return $DataFormat;
}

function valida_pesquisa($campo_sel,$nome){

    if(strpos($campo_sel,'data')){

        $nome = formata_data($nome, "/", "-");
    }

    return array($campo_sel, $nome);
}


function Completa($valorPar, $tipo, $quantidade,$cortar = 1) {
    $valor = $valorPar;
    if($cortar){
        $valor = substr($valor,0,$quantidade);
    }

    if ($valor != ' ') {
        $valori = strlen($valor);
    }else {
        $valori = 0;
        if(($tipo=='NI') || ($tipo=='NF')){
            $valor = 0;
            $valori = 1;
        }
    }

    while ($valori < $quantidade) {

        if ($tipo == 'AI') {
            $valor = ' ' . $valor;
        }

        if ($tipo == 'AF') {
            $valor = $valor . ' ';
        }

        if ($tipo == 'NI') {
            if ($valor == ' ')
                $valor = 0;
            $valor = '0' . $valor;
        }

        if ($tipo == 'NF') {
            if ($valor == ' ')
                $valor = 0;
            $valor = $valor . '0';
        }

        $valori = strlen($valor);
    }

    return $valor;
}

function Brancos($quantidade) {


    $retorno = '';
    while (strlen($retorno) < $quantidade) {

        $retorno = $retorno . ' ';
    }

    return $retorno;
}

function RemoveAcentos($str) {

    $str = str_replace('á', 'a', $str);
    $str = str_replace('Á', 'A', $str);
    $str = str_replace('Â', 'A', $str);
    $str = str_replace('à', 'a', $str);
    $str = str_replace('À', 'A', $str);
    $str = str_replace('é', 'e', $str);
    $str = str_replace('É', 'E', $str);
    $str = str_replace('è', 'e', $str);
    $str = str_replace('È', 'E', $str);
    $str = str_replace('ã', 'a', $str);
    $str = str_replace('Ã', 'A', $str);
    $str = str_replace('õ', 'o', $str);
    $str = str_replace('Õ', 'O', $str);
    $str = str_replace('Ô', 'O', $str);
    $str = str_replace('Ó', 'O', $str);
    $str = str_replace('ó', 'o', $str);
    $str = str_replace('ç', 'c', $str);
    $str = str_replace('Ç', 'C', $str);
    $str = str_replace('í', 'i', $str);
    $str = str_replace('Í', 'I', $str);
    $str = str_replace('ê', 'e', $str);
    $str = str_replace('Ê', 'E', $str);
    $str = str_replace('ú', 'u', $str);
    $str = str_replace('Ú', 'U', $str);
    $str = str_replace(array("'","(",")","º","%","*",'"'), '', $str);

    return $str;
}

//##################################################################################################################################
//###################       BANCO RURAL (BRADESCO)      ############################################################################
//##################################################################################################################################
function CalculaDV10BRD($numero_base) {
    /* {------------------------------------------------------------------------------}
	  { function do Calculo de DV Módulo 10 }
	  {------------------------------------------------------------------------------} */

    $tamanho_num = strlen($numero_base);
    $peso = 3;
    $soma = 0;

    $i = $tamanho_num;


    While ($i != 1) {

        $soma = $soma + ((int) ($numero_base[$i]) * $peso);


        if ($peso == 3)
            $peso = 7;
        elseif ($peso == 7)
            $peso = 9;
        elseif ($peso == 9)
            $peso = 1;
        elseif ($peso == 1)
            $peso = 3;

        $i--;
    }

    $resto = $soma % 10;

    if (($resto == 0) || ($resto == 10))
        $resto = 0;

    if ($resto == 1)
        $resto = 9;

    if ($resto == 2)
        $resto = 8;

    if ($resto == 3)
        $resto = 7;

    if ($resto == 4)
        $resto = 6;

    if ($resto == 5)
        $resto = 5;

    if ($resto == 6)
        $resto = 4;

    if ($resto == 7)
        $resto = 3;

    if ($resto == 8)
        $resto = 2;

    if ($resto == 9)
        $resto = 1;

    return (string) $resto;
}

function Modulo11($Valor, $Base = 9, $Resto = false)
    /*
  Rotina muito usada para calcular dígitos verificadores
  Pega-se cada um dos dígitos contidos no parâmetro VALOR, da direita para a
  esquerda e multiplica-se pela seqüência de pesos 2, 3, 4 ... até BASE.
  Por exemplo: se a base for 9, os pesos serão 2,3,4,5,6,7,8,9,2,3,4,5...
  Se a base for 7, os pesos serão 2,3,4,5,6,7,2,3,4...
  Soma-se cada um dos subprodutos.
  Divide-se a soma por 11.
  Faz-se a operação 11-Resto da divisão e devolve-se o resultado dessa operação
  como resultado da função Modulo11.
  Obs.: Caso o resultado seja
  maior que 9, deverá ser substituído por 0 (ZERO).
 */
    /* var
  Soma : integer;
  Contador, Peso, Digito : integer; */ {
    $Soma = 0;
    $Peso = 2;
    //for $Contador = strlen(Valor) downto 1 do
    for ($Contador = (strlen($Valor) - 1); $Contador >= 0; $Contador--) {
        $Soma = $Soma + ((int) ($Valor[$Contador]) * $Peso);
        if ($Peso < $Base)
            $Peso = $Peso + 1;
        else
            $Peso = 2;
    }

    if ($Resto)
        return (string) ($Soma % 11);
    else {
        $Digito = 11 - ($Soma % 11);
        if ($Digito > 9)
            $Digito = 0;
        return (string) ($Digito);
    }
}

function CalcularDVNNBIC($Carteira, $NossoNumero, $Origem) {

    if ($Origem == 'A') {  //arquivo remessa
        //BicBanco
        $APesos = '29876543298765432';
        $AComposicao = $Carteira . '' . $NossoNumero;

        $ASoma = 0;
        $len = strlen($AComposicao);

        for ($AContador = 0; $AContador < $len; $AContador++) {
            $ASoma = $ASoma + ( (int) ($AComposicao[$AContador]) * (int) ($APesos[$AContador]) );
        }


        $AResto = ($ASoma % 11);
        if (($AResto == 0) or ($AResto == 10))
            return '1';
        else {
            if ($AResto == 1)
                return '0';
            else
                return (string) (11 - $AResto);
        }
    }

    if ($Origem == 'B') {   //boleto
        // correspondente - bradesco
        $APesos = '276543276543276543276543276543';
        $AComposicao = $Carteira . '' . $NossoNumero;

        $ASoma = 0;
        for ($AContador = 0; $AContador < $AComposicao; $AContador++) {
            $ASoma = $ASoma + ( (int) ($AComposicao[$AContador]) * (int) ($APesos[$AContador]) );
        }

        $AResto = ($ASoma % 11);
        if ($AResto == 0)
            return '0';
        else {
            if ($AResto == 1)
                return 'P';
            else
                return (string) (11 - $AResto);
        }
    }
}

function verifica_situacao_pagamento($situacao){
    global $DB;

    $existe_situacao_cancelado = $DB->Execute("select count(id) as qtde from situacao_pagamento where descricao like '%$situacao%' and status = 1")->fields["qtde"];

    if($existe_situacao_cancelado == 0){

        try{

            $DB->Execute("insert into situacao_pagamento (descricao,status,created) values('$situacao',1,now());")->fields["qtde"];
        }
        catch (ADODB_Exception $e){
            return 0;
        }

    }

    return 1;

}

?>