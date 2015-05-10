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
    	if(empty($data_validade)) 
	{
		$erro .= 'data_validade'; 
		$class_data_validade = 1; 
	}    

	if (empty($erro))
	{
		class Trabalhista extends ADOdb_Active_Record
		{
			var $_table = 'trabalhista';
		}
		$obj = new Trabalhista();
		
		
		if (!empty($id)) $obj->load('id=?', $id);
        	$data3=explode("/", $data_validade);
 	    $data_validade = $data3[2]."-".$data3[1]."-".$data3[0];
       
        $obj->data_validade  = $data_validade;
      
 
	    $obj->espaco_fisico_id  = $_SESSION["espaco_fisico_id"];
        $obj->descricao  = $descricao;
        $obj->usuario_id  = $_SESSION["idusuario_g"];
 
		$obj->status = 1;

	if (empty($id))	$obj->created = date('Y-m-d H:i:s') ;
		 

		try
		{
			$ok = $obj->save();  // esse save() vai retornar um UPDATE ou INSERT
            
            $sql =  "select *from trabalhista where espaco_fisico_id = '".$_SESSION["espaco_fisico_id"]."' order by id desc";
            $Rs = $DB->EXECUTE($sql);
            if($_FILES['trabalhista']['size'] > 1024000)
            {
                print "<SCRIPT> alert('Seu arquivo não poderá ser maior que 1mb'); window.history.go(-1); </SCRIPT>\n";
                exit;
            }
            /* Defina aqui o diretório destino do upload */
            if (!empty($_FILES['trabalhista']['tmp_name']) and is_file($_FILES['trabalhista']['tmp_name'])) 
            {
                $caminho="../../upload/trabalhista/";
                $caminho = $caminho.$Rs->fields['id'].".pdf";
                /* Defina aqui o tipo de arquivo suportado */
                if ((eregi(".gif$", $_FILES['trabalhista']['name'])) || (eregi(".pdf", $_FILES['trabalhista']['name'])) || (eregi(".png", $_FILES['trabalhista']['name'])) || (eregi(".jpg$", $_FILES['trabalhista']['name'])) || (eregi(".txt$", $_FILES['trabalhista']['name'])))
                {
                    copy($_FILES['trabalhista']['tmp_name'],$caminho);
                } 
        	}  
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
		 
