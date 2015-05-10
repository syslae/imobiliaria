<? 
	if($_POST['acao']=='atualizar' and empty($id)) 
	{
		$erro .= ' Id'; 
		$class_id = 1; 
	} 
	if(empty($motivo)) 
	{
		$erro .= 'motivo'; 
		$class_motivo = 1; 
	}  
	if(empty($usuario_id)) 
	{
		$erro .= 'usuario_id'; 
		$class_usuario_id = 1; 
	}

    if(empty($cliente_id))
    {
        $erro .= 'cliente_id';
        $class_cliente_id = 1;
    }
    if(empty($parcela_id_array))
	{
		$erro .= 'parcela_id'; 
		$class_parcela_id = 1; 
	} 


	if (empty($erro))
	{
		class Motivo_cancelamento extends ADOdb_Active_Record
		{
			var $_table = 'motivo_cancelamento';
		}

        class Parcelas extends ADOdb_Active_Record
        {
            var $_table = 'parcelas';
        }


        //$DB->debug = 1;
        //Iniciando o movimento de transação
        $DB->BeginTrans();

        try
        {
            $situacao_cancelado = $DB->Execute("select id from situacao_pagamento where descricao like '%cancelad%' and status = 1")->fields["id"];

            foreach($parcela_id_array as $key => $parcela_id){

                $objP = new Parcelas();

                $objP->load('id=?', $parcela_id);
                $objP->situacao_pagamento_id = $situacao_cancelado;
                $ok = $objP->save();  // esse save() vai retornar um UPDATE ou INSERT

                $obj = new Motivo_cancelamento();

                $obj->motivo = $motivo;

                $obj->usuario_id = $usuario_id;

                $obj->parcela_id = $parcela_id;

                $obj->status = $status;

                $obj->created = date('Y-m-d H:i:s') ;

                $ok = $obj->save();  // esse save() vai retornar um UPDATE ou INSERT


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
            //echo $e->getMessage();
            $deu_certo = false;
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
		 
