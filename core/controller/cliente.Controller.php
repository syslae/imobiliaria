<? 
	if($_POST['acao']=='atualizar' and empty($id)) 
	{
		$erro .= ' Id'; 
		$class_id = 1; 
	} 

	if(empty($cidade_id)) 
	{
		$erro .= 'cidade_id'; 
		$class_cidade = 1; 
	}  

    if(empty($razao_social))
    {
        $tipo = 'F';
        
    }
    else
    {
       $tipo = 'J';
    }
    if(empty($pessoa_contato)) 
	{
		$erro .= 'pessoa_contato'; 
		$class_pessoa_contato = 1; 
	}  

	if (empty($erro))
	{
		class Cliente extends ADOdb_Active_Record
		{
			var $_table = 'cliente';
		}
		$obj = new Cliente();
		
		
		if (!empty($id)) $obj->load('id=?', $id);
 
    	$obj->nome = $nome;
        $obj->nome_fantasia = $nome_fantasia;
        $obj->razao_social = $razao_social;
        $obj->tipo = $tipo;
        $obj->cnpj = $cnpj;
      	$obj->identidade = $identidade;
        $obj->estado_id = $estado_id;
		$obj->cpf = $cpf;
       	$obj->pessoa_contato = $pessoa_contato;
       
        $obj->espaco_fisico_id  = $_SESSION["espaco_fisico_id"];
 
		$obj->logradouro = $logradouro;
 
		$obj->bairro = $bairro;
 
		$obj->numero = $numero;
        
        $obj->complemento = $complemento;
 
 
		$obj->cep = $cep;
 
		$obj->telefone = $telefone;
 
		$obj->celular = $celular;
        
        $obj->inscricao_estadual = $inscricao_estadual;
 
		$obj->cidade_id = $cidade_id;
 
		$obj->email = $email;
 
		$obj->observacao = $observacao;
 
		$obj->status = $status;
        
        	
		$data1=explode("/", $data_nascimento);
	  //  $DB->debug=true;
		
		$data = $data1[2]."-".$data1[1]."-".$data1[0];
        $obj->data_nascimento =  $data;


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
		 
