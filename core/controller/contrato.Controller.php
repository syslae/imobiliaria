<? 
	if($_POST['acao']=='atualizar' and empty($id)) 
	{
		$erro .= ' Id'; 
		$class_id = 1; 
	} 

	if(empty($cliente_id)) 
	{
		$erro .= 'cliente_id'; 
		$class_cliente_id = 1; 
	}  
	if(empty($numero_contrato)) 
	{
		$erro .= 'numero_contrato'; 
		$class_numero_contrato = 1; 
	}  
	if(empty($data_inicio)) 
	{
		$erro .= 'data_inicio'; 
		$class_data_inicio = 1; 
	}  
	if(empty($data_final)) 
	{
		$erro .= 'data_final'; 
		$class_data_final = 1; 
	}  
	if(empty($valor_mensal)) 
	{
		$erro .= 'valor_mensal'; 
		$class_valor_mensal = 1; 
	}  
	if(empty($volor_total)) 
	{
		$erro .= 'volor_total'; 
		$class_volor_total = 1; 
	}
    	if(empty($servico_id)) 
	{
		$erro .= 'servico_id'; 
		$class_servico_id = 1; 
	}    
	if (empty($erro))
	{
		class Contrato extends ADOdb_Active_Record
		{
			var $_table = 'contrato';
		}
		$obj = new Contrato();
		
		
		if (!empty($id)) $obj->load('id=?', $id);

	
    	$data1=explode("/", $data_inicio);
    	$data_inicio=$data1[2]."-".$data1[1]."-".$data1[0];
                   
    	
    	$data2=explode("/", $data_final);
    	$data_final=$data2[2]."-".$data2[1]."-".$data2[0];
                
		$obj->cliente_id = $cliente_id;
 
		$obj->numero_contrato = $numero_contrato;
        
        $obj->servico_id = $servico_id;

		$obj->data_inicio = $data_inicio;
 
		$obj->data_final = $data_final;
 
		$obj->valor_mensal = moeda_ajuste($valor_mensal);
 
		$obj->volor_total = moeda_ajuste($volor_total);
 
		$obj->status = $status;
        
        $obj->espaco_fisico_id  = $_SESSION["espaco_fisico_id"];

	if (empty($id))	$obj->created = date('Y-m-d H:i:s') ;
		 

		try
		{
			$ok = $obj->save();  // esse save() vai retornar um UPDATE ou INSERT
            
           if(empty($id))
          {  
             $sql =  "select *from contrato order by id desc";
             $Rs = $DB->EXECUTE($sql);
             $id =  $Rs->fields['id'];
          }
           
         for($i=1;$i<=11;$i++) 
         {   
            if($_FILES[$i]['size'] > 9000024000)
            {
                print "<SCRIPT> alert('Seu arquivo não poderá ser maior que 100mb'); window.history.go(-1); </SCRIPT>\n";
                exit;
            }
            /* Defina aqui o diretório destino do upload */
            if (!empty($_FILES[$i]['tmp_name']) and is_file($_FILES[$i]['tmp_name'])) 
            {
                $caminho="../../upload/".$i."/";
               // $DadosTipo = explode("/",$_FILES[$i]['type']);
                //$caminho = $caminho.$Rs->fields['id'].".".$DadosTipo[0];
                $caminho = $caminho.$id.".pdf";
               
                /* Defina aqui o tipo de arquivo suportado */
                if ((eregi(".gif$", $_FILES[$i]['name'])) || (eregi(".pdf", $_FILES[$i]['name'])) || (eregi(".png", $_FILES[$i]['name'])) || (eregi(".jpg$", $_FILES[$i]['name'])) || (eregi(".txt$", $_FILES[$i]['name'])))
                {
                    copy($_FILES[$i]['tmp_name'],$caminho);
                } 
        	}  
		}
        	
            //exit();
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
		 
