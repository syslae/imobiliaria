<? 
	if($_POST['acao']=='atualizar' and empty($id)) 
	{
		$erro .= ' Id'; 
		$class_id = 1; 
	} 
	if(empty($descricao)) 
	{
		$erro .= 'descricao'; 
		$class_descricao = 1; 
	}

    if(is_array($estoque_id)){

        foreach($codigo as $key => $cod_est){

            if(empty($cod_est))
            {
                $erro .= 'cod_est';
                $class_cod_est = 1;
            }

        }

        foreach($estoque as $key => $est){

            if(empty($est))
            {
                $erro .= 'estoque';
                $class_estoque = 1;
            }

        }

        foreach($valor_estoque as $key => $valor_est){

            if($valor_est === '')
            {
                $erro .= 'valor_est';
                $class_valor_est = 1;
            }

        }
    }else{

        $erro .= 'estoque';
        $class_estoque = 1;

    }

	if (empty($erro))
	{
		class Produto extends ADOdb_Active_Record
		{
			var $_table = 'produto';
		}
		$obj = new Produto();
		
		
		if (!empty($id)) $obj->load('id=?', $id);
 
 		$obj->valor = 0;
		$obj->descricao = $descricao; 
        $obj->espaco_fisico_id  = $_SESSION["espaco_fisico_id"];
		$obj->status = 1;
	if (empty($id))	$obj->created = date('Y-m-d H:i:s') ;

        $deu_certo = false;
        //Iniciando o movimento de transação
        $DB->BeginTrans();

		try
		{
            //$DB->debug = 1;
			$ok = $obj->save();  // esse save() vai retornar um UPDATE ou INSERT
            if (empty($id)) $id = $DB->insert_id(); // retorna o último id adcionado

            $objAnteriores = new Produto();
            $dadosAnteriores = $obj->Find('produto_principal_id=?', $id);

            $listA = array();
            foreach ($dadosAnteriores as $idAtual){
                $listA[] = $idAtual->id;
            }

            foreach($estoque_id as $key => $est_id){

                $objEst = new Produto();

                if (!empty($est_id)){
                    $objEst->load('id=?', $est_id);
                }

                $objEst->produto_principal_id = $id;
                $objEst->valor = $valor_estoque[$key];
                $objEst->codigo = $codigo[$key];
                $objEst->descricao = $estoque[$key];
                $objEst->espaco_fisico_id  = $_SESSION["espaco_fisico_id"];
                $objEst->status = $status_estoque[$key];
                if (empty($est_id))	$objEst->created = date('Y-m-d H:i:s') ;

                $ok = $objEst->save();

            }

            $excluidos = array_diff($listA, $estoque_id);

            if($excluidos){
                $excluido = implode("','", $excluidos);
                $sql2 = "delete from produto where produto_principal_id = ". $id . " and id in ('". $excluido . "')";
                $DB->Execute($sql2);
            }

            $deu_certo = true;
		}
		catch(ADODB_Exception $e)
		{
            $deu_certo = false;
			echo 'Ocorreu uma execao do tipo ADODB_Exception no modulo de salvar ';
		}
		catch(exceptions $e)
		{
            $deu_certo = false;
			//echo $e->getMessage();
			echo 'Ocorreu uma execao no modulo de salvar';
		}

        if($deu_certo){
            //caso não ocorra nenhuma falha durante o processamento, realiza-se o a efetivação
            $DB->CommitTrans();

            $_SESSION['msg_index'] = 'Salvo com sucesso';
            redireciona('index.php');

        }else{
            //caso ocorra alguma falha durante o processamento, realiza-se o cancelamento
            $DB->RollbackTrans();

        }
	}
?>
		 
