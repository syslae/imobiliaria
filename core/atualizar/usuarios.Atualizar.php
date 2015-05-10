<?php
	class Usuarios extends ADOdb_Active_Record
	{
		var $_table = "usuarios";
	}
	$obj = new Usuarios();
	
	$dadosArray = $obj->Find("id=?", $id);
	$dados = $dadosArray[0];
	
	if (empty($dados->id))
	{
		$_SESSION["msg_index"] = 'Esse registro n&atilde;o existe';
		header('Location:index.php');
	}
    	
    $id = $dados->id;
	$grupo_id = $dados->grupo_id;
    $login = $dados->login;
    $senha = $dados->senha;
    $nome = $dados->nome;
    $email = $dados->email;
    $msn = $dados->msn;
    $orkut = $dados->orkut;
    $fone = $dados->fone;
    $celular = $dados->celular;
   

	$ultimoacesso = $dados->ultimoacesso;
	list($data_ultimoacesso, $hora_ultimoacesso) = explode(" ", $ultimoacesso);
	list($ano_ultimoacesso, $mes_ultimoacesso, $dia_ultimoacesso) = explode("-", $data_ultimoacesso);
	list($hora_ultimoacesso, $min_ultimoacesso, $seg_ultimoacesso) = explode(":", $hora_ultimoacesso);
	
	
    $acessos = $dados->acessos;

	$created = $dados->created;
	list($data_created, $hora_created) = explode(" ", $created);
	list($ano_created, $mes_created, $dia_created) = explode("-", $data_created);
	list($hora_created, $min_created, $seg_created) = explode(":", $hora_created);
	
	

	$modified = $dados->modified;
	list($data_modified, $hora_modified) = explode(" ", $modified);
	list($ano_modified, $mes_modified, $dia_modified) = explode("-", $data_modified);
	list($hora_modified, $min_modified, $seg_modified) = explode(":", $hora_modified);
	
	
    $status = $dados->status;


?>