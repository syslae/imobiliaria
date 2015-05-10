<?php
	// VERIFICO SE É OU NÃO OBRIGATÓRIO
	
	if($_POST['acao']=='atualizar' and empty($id))
	{
		$erro .= " Id";
		$class_id = 1;
	}

	if(empty($nome))
	{
		$erro .= " nome";
		$class_nome = 1;
	}

	if(empty($descricao))
	{
		$erro .= " descricao";
		$class_descricao = 1;
	}

	echo $erro;
	
	if (empty($erro))
	{
		class Grupo_usuarios extends ADOdb_Active_Record
		{
			var $_table = "grupo_usuarios";
		}
		$obj = new Grupo_usuarios();
		
		//echo "<p>Atributos da tabela: ";
		//var_dump($usuarios->getAttributeNames());
		//echo "Ultimo Id gerado:"; print_r($obj->id);
        if (!empty($id)) $obj->load("id=?", $id);

       
        $obj->nome = $nome;
        $obj->descricao = $descricao;
		$obj->tipo = $tipo;
      
		$dataAtual = date('Y-m-d H:i:s');
        if (empty($id))
		{
			
			$obj->created = $dataAtual;
		}
      
        $obj->status = $status;
		
	
		
		try 
		{
			$ok = $obj->save(); // esse save() vai retornar um UPDATE ou INSERT
			$_SESSION["msg_index"] = "Salvo com sucesso";
			
			
			
			redireciona('index.php');
		}
		catch(ADODB_Exception $e)
		{
			echo "Ocorreu uma execao do tipo ADODB_Exception no modulo de salvar usuarios";
		}
		catch(exceptions $e)
		{
			//echo $e->getMessage();
			echo "Ocorreu uma execao no modulo de salvar usuarios";
		}
	}
?>