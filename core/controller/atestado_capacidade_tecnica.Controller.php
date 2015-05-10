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

	if (empty($erro))
	{
		class Atestado_Capacidade_Tecnica extends ADOdb_Active_Record
		{
			var $_table = 'atestado_capacidade_tecnica';
		}
		$obj = new Atestado_Capacidade_Tecnica();
		
		
		if (!empty($id)) $obj->load('id=?', $id);

	
    if (!empty($id)) $obj->load('id=?', $id);
 
	   $obj->espaco_fisico_id  = $_SESSION["espaco_fisico_id"];
        
        $obj->usuario_id  = $_SESSION["idusuario_g"];
        
        $obj->descricao  = $descricao;

		$obj->status = 1;
  
	if (empty($id))	$obj->created = date('Y-m-d H:i:s') ;
		 
		try
		{
		  	$ok = $obj->save();  // esse save() vai retornar um UPDATE ou INSERT
		    $sql =  "select *from atestado_capacidade_tecnica where espaco_fisico_id = '".$_SESSION["espaco_fisico_id"]."' order by id desc";
            $Rs = $DB->EXECUTE($sql);
			if($_FILES['atestado_capacidade_tecnica']['size'] > 2024000)
            {
                print "<SCRIPT> alert('Seu arquivo não poderá ser maior que 1mb'); window.history.go(-1); </SCRIPT>\n";
                exit;
            }
            /* Defina aqui o diretório destino do upload */
            if (!empty($_FILES['atestado_capacidade_tecnica']['tmp_name']) and is_file($_FILES['atestado_capacidade_tecnica']['tmp_name'])) 
            {
                $caminho="../../upload/atestado_capacidade_tecnica/";
                $caminho = $caminho.$Rs->fields['id'].".pdf";
                /* Defina aqui o tipo de arquivo suportado */
                if ((eregi(".gif$", $_FILES['atestado_capacidade_tecnica']['name'])) || (eregi(".pdf", $_FILES['atestado_capacidade_tecnica']['name'])) || (eregi(".png", $_FILES['atestado_capacidade_tecnica']['name'])) || (eregi(".jpg$", $_FILES['atestado_capacidade_tecnica']['name'])) || (eregi(".txt$", $_FILES['atestado_capacidade_tecnica']['name'])))
                {
                    copy($_FILES['atestado_capacidade_tecnica']['tmp_name'],$caminho);
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
		 
