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
		class Alvara extends ADOdb_Active_Record
		{
			var $_table = 'inscricao_municipal';
		}
		$obj = new Alvara();
		
		
		if (!empty($id)) $obj->load('id=?', $id);
 
	   $obj->espaco_fisico_id  = $_SESSION["espaco_fisico_id"];
        
        $obj->usuario_id  = $_SESSION["idusuario_g"];
        
        $obj->descricao  = $descricao;

		$obj->status = 1;

	if (empty($id))	$obj->created = date('Y-m-d H:i:s') ;
		 

		try
		{
		    $ok = $obj->save();  // esse save() vai retornar um UPDATE ou INSERT
            $sql =  "select *from inscricao_municipal  where espaco_fisico_id = '".$_SESSION["espaco_fisico_id"]."' order by id desc";
            $Rs = $DB->EXECUTE($sql);
			if($_FILES['i_m']['size'] > 90024000)
            {
                print "<SCRIPT> alert('Seu arquivo não poderá ser maior que 1mb'); window.history.go(-1); </SCRIPT>\n";
                exit;
            }
            /* Defina aqui o diretório destino do upload */
            if (!empty($_FILES['i_m']['tmp_name']) and is_file($_FILES['i_m']['tmp_name'])) 
            {
                $caminho="../../upload/i_m/";
                $caminho = $caminho.$Rs->fields['id'].".pdf";
                /* Defina aqui o tipo de arquivo suportado */
                if ((eregi(".gif$", $_FILES['i_m']['name'])) || (eregi(".pdf", $_FILES['i_m']['name'])) || (eregi(".png", $_FILES['i_m']['name'])) || (eregi(".jpg$", $_FILES['alvara']['i_m'])) || (eregi(".txt$", $_FILES['i_m']['name'])))
                {
                    copy($_FILES['i_m']['tmp_name'],$caminho);
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
		 
