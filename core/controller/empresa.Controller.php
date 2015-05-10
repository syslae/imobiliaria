<? 
	if($_POST['acao']=='atualizar' and empty($id)) 
	{
		$erro .= ' Id'; 
		$class_id = 1; 
	} 
	if(empty($razao_social)) 
	{
		$erro .= 'razao_social'; 
		$class_razao_social = 1; 
	}  
	if(empty($nome_fantasia)) 
	{
		$erro .= 'nome_fantasia'; 
		$class_nome_fantasia = 1; 
	}  
	if(empty($cnpj)) 
	{
		$erro .= 'cnpj'; 
		$class_cnpj = 1; 
	}  
	if(empty($ie)) 
	{
		$erro .= 'ie'; 
		$class_ie = 1; 
	}  
	if(empty($logradouro)) 
	{
		$erro .= 'logradouro'; 
		$class_logradouro = 1; 
	}  
	if(empty($bairro)) 
	{
		$erro .= 'bairro'; 
		$class_bairro = 1; 
	}  
	if(empty($cep)) 
	{
		$erro .= 'cep'; 
		$class_cep = 1; 
	}  
	if(empty($telefone)) 
	{
		$erro .= 'telefone'; 
		$class_telefone = 1; 
	}  
	if(empty($pessoa_contato)) 
	{
		$erro .= 'pessoa_contato'; 
		$class_pessoa_contato = 1; 
	}  
	if(empty($atuacao)) 
	{
		$erro .= 'atuacao'; 
		$class_atuacao = 1; 
	} 

    //$DB->debug=true;
	if (empty($erro))
	{
		class Empresa extends ADOdb_Active_Record
		{
			var $_table = 'empresa';
		}
		$obj = new Empresa();
		
		
		if (!empty($id)) $obj->load('id=?', $id);
 
		$obj->razao_social = $razao_social;
 
		$obj->nome_fantasia = $nome_fantasia;
 
		$obj->cnpj = $cnpj;
 
		$obj->ie = $ie;
 
		$obj->logradouro = $logradouro;
 
		$obj->bairro = $bairro;
 
		$obj->numero = $numero;
 
		$obj->cep = $cep;
 
		$obj->telefone = $telefone;
 
		$obj->celular = $celular;
 
		$obj->fax = $fax;
 
		$obj->email = $email;
        
        $obj->cidade_id = $cidade_id;
 
		$obj->estado_id = $estado_id;
       
        $obj->status = $status;
 
		$obj->site = $site;
 
		$obj->pessoa_contato = $pessoa_contato;
 
		$obj->atuacao = $atuacao;

	if (empty($id))	$obj->created = date('Y-m-d') ;
		 

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
		 
