<? 
	if($_POST['acao']=='atualizar' and empty($id)) 
	{
		$erro .= ' Id'; 
		$class_id = 1; 
	} 
	if(empty($tabela_id)) 
	{
		$erro .= 'tabela_id'; 
		$class_tabela_id = 1; 
	}  
	if(empty($menu_id)) 
	{
		$erro .= 'menu_id'; 
		$class_menu_id = 1; 
	}  
	if(empty($nome)) 
	{
		$erro .= 'nome'; 
		$class_nome = 1; 
	}  
	if(empty($tipo)) 
	{
		$erro .= 'tipo'; 
		$class_tipo = 1; 
	}  
	if(empty($pasta)) 
	{
		$erro .= 'pasta'; 
		$class_pasta = 1; 
	} 


	if (empty($erro))
	{
		class Tabelas extends ADOdb_Active_Record
		{
			var $_table = 'tabelas';
		}
		$obj = new Tabelas();
		
		
		if (!empty($id)) $obj->load('id=?', $id);
 
		$obj->tabela_id = $tabela_id;
 
		$obj->menu_id = $menu_id;
 
		$obj->nome = $nome;
 
		$obj->tipo = $tipo;
 
		$obj->pasta = $pasta;
 
		$obj->status = $status;

	//	if (empty($id))	$obj->created = date('Y-m-d H:i:s') ;
		 

		try
		{
			$ok = $obj->save();  // esse save() vai retornar um UPDATE ou INSERT
			$_SESSION['msg_index'] = 'Salvo com sucesso';
			redireciona('index.php');
		}
		catch(ADODB_Exception $e)
		{
			echo 'Ocorreu uma execao do tipo ADODB_Exception no modulo de salvar ';
		}
		catch(exceptions $e)
		{
			//echo $e->getMessage();
			echo 'Ocorreu uma execao no modulo de salvar';
		}
	}
?>
		 
