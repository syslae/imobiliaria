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
		class ContratoSocial extends ADOdb_Active_Record
		{
			var $_table = 'contrato_social';
		}
		$obj = new ContratoSocial();
		
		
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
            
             $sql =  "select *from contrato_social  where espaco_fisico_id = '".$_SESSION["espaco_fisico_id"]."' order by id desc";
             $Rs = $DB->EXECUTE($sql);
          
         for($i=1;$i<=12;$i++) 
         {   
            if($_FILES[$i]['size'] > 9024000)
            {
                print "<SCRIPT> alert('Seu arquivo não poderá ser maior que 9mb'); window.history.go(-1); </SCRIPT>\n";
                exit;
            }
            /* Defina aqui o diretório destino do upload */
            if (!empty($_FILES[$i]['tmp_name']) and is_file($_FILES[$i]['tmp_name'])) 
            {
               $caminho="../../upload/contrato_social/".$i."/";
              
               // $DadosTipo = explode("/",$_FILES[$i]['type']);
                //$caminho = $caminho.$Rs->fields['id'].".".$DadosTipo[0];
                $caminho = $caminho.$Rs->fields['id'].".pdf";
               
                /* Defina aqui o tipo de arquivo suportado */
                if ((eregi(".gif$", $_FILES[$i]['name'])) || (eregi(".pdf", $_FILES[$i]['name'])) || (eregi(".png", $_FILES[$i]['name'])) || (eregi(".jpg$", $_FILES[$i]['name'])) || (eregi(".txt$", $_FILES[$i]['name'])))
                {
                    copy($_FILES[$i]['tmp_name'],$caminho);
                } 
        	}  
		}
        	
           // exit();
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
		 
