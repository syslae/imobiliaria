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
		class Certidao_simplificada extends ADOdb_Active_Record
		{
			var $_table = 'certidao_simplificada';
		}
		$obj = new Certidao_simplificada();
		
		
		if (!empty($id)) $obj->load('id=?', $id);
        
        $data3=explode("/", $data_validade);
 	    $data_validade = $data3[2]."-".$data3[1]."-".$data3[0];
        $obj->data_validade  = $data_validade;
 
    
        $obj->espaco_fisico_id  = $_SESSION["espaco_fisico_id"];
        
        $obj->usuario_id  = $_SESSION["idusuario_g"];
        
        $obj->descricao  = $descricao;

		$obj->status = 1;

	if (empty($id))	$obj->created = date('Y-m-d H:i:s') ;
		 

		try
		{
			 $ok = $obj->save();  // esse save() vai retornar um UPDATE ou INSERT
             $sql =  "select *from certidao_simplificada where espaco_fisico_id = '".$_SESSION["espaco_fisico_id"]."' order by id desc";
             $Rs = $DB->EXECUTE($sql);
            if($_FILES['certidao_simplificada']['size'] > 90024000)
            {
                print "<SCRIPT> alert('Seu arquivo n�o poder� ser maior que 1mb'); window.history.go(-1); </SCRIPT>\n";
                exit;
            }
            /* Defina aqui o diret�rio destino do upload */
            if (!empty($_FILES['certidao_simplificada']['tmp_name']) and is_file($_FILES['certidao_simplificada']['tmp_name'])) 
            {
                $caminho="../../upload/certidao_simplificada/";
                $caminho = $caminho.$Rs->fields['id'].".pdf";
                /* Defina aqui o tipo de arquivo suportado */
                if ((eregi(".gif$", $_FILES['certidao_simplificada']['name'])) || (eregi(".pdf", $_FILES['certidao_simplificada']['name'])) || (eregi(".png", $_FILES['certidao_simplificada']['name'])) || (eregi(".jpg$", $_FILES['certidao_simplificada']['name'])) || (eregi(".txt$", $_FILES['certidao_simplificada']['name'])))
                {
                    copy($_FILES['certidao_simplificada']['tmp_name'],$caminho);
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
		 
