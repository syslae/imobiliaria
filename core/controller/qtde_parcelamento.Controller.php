<? 
	if($_POST['acao']=='atualizar' and empty($id)) 
	{
		$erro .= ' Id'; 
		$class_id = 1; 
	} 
	if(empty($qtde_vezes)) 
	{
		$erro .= 'qtde_vezes'; 
		$class_qtde_vezes = 1; 
	} 


	if (empty($erro))
	{
		class Qtde_parcelamento extends ADOdb_Active_Record
		{
			var $_table = 'qtde_parcelamento';
		}
		$obj = new Qtde_parcelamento();
		
		
		if (!empty($id)) $obj->load('id=?', $id);
 
		$obj->qtde_vezes = $qtde_vezes;
 
		$obj->status = $status;

	if (empty($id))	$obj->created = date('Y-m-d H:i:s') ;
		 

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
		 
