<?php
	// VERIFICO SE É OU NÃO OBRIGATÓRIO
	
	if($_POST['acao']=='atualizar' and empty($id))
	{
		$erro .= " Id";
		$class_id = 1;
	}

	if(empty($usuario_id))
	{
		$erro .= " usuario_id";
		$class_usuario_id = 1;
	}

	if(empty($tabela_id))
	{
		$erro .= " tabela_id";
		$class_tabela_id = 1;
	}

	if(empty($permissao))
	{
		$erro .= " permissao";
		$class_permissao = 1;
	}

	
	#### debugar
	//echo $erro;
	
	
	##### modelo para envio de foto
	if (empty($erro))
	{
		if(!empty($foto))
		{
			##### inicio do codigo de modelo para upload de imagem
			//require_once "../class_upload.php";
			//$upload = new Upload();
			
			### Pasta de upload
			//$upload->setPastaUpload('$tabela');
			
			### Largura da imagem grande
			//$upload->setLargura(600);
			
			### Se vai ter ou não thumbs
			//$upload->setThumbs(1);
			
			### Largura da imagem thumbs
			//$upload->setLarguraT(200);
			
			### Informo o nome do arquivo que tem a imagem que sera enviada
			//$upload->setCampoUpload('foto');
			//$upload->Envia_Arquivo();
			##### fim do codigo de modelo para upload de imagem
		}
	}
	##### fim do modelo para envio de foto
	

	if (empty($erro))
	{
		class Usuariotabelas extends ADOdb_Active_Record
		{
			var $_table = "usuariotabelas";
		}
		$obj = new Usuariotabelas();
		
		//echo "<p>Atributos da tabela: ";
		//var_dump($usuariotabelas->getAttributeNames());
		//echo "Ultimo Id gerado:"; print_r($obj->id);
        if (!empty($id)) $obj->load("id=?", $id);
        $obj->usuario_id = $usuario_id;
        $obj->tabela_id = $tabela_id;
        $obj->permissao = $permissao;

		try 
		{
			$ok = $obj->save(); // esse save() vai retornar um UPDATE ou INSERT
			$_SESSION["msg_index"] = "Salvo com sucesso";
			redireciona('index.php');
		}
		catch(ADODB_Exception $e)
		{
			echo "Ocorreu uma execao do tipo ADODB_Exception no modulo de salvar usuariotabelas";
		}
		catch(exceptions $e)
		{
			//echo $e->getMessage();
			echo "Ocorreu uma execao no modulo de salvar usuariotabelas";
		}
	}
?>