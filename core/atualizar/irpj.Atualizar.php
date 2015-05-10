<?php

	class Irpj extends ADOdb_Active_Record
	{
		var $_table = 'irpj';
	}
	$obj = new Irpj();

	$dadosArray = $obj->Find('id=?', $id);
	$dados = $dadosArray[0];

	if (empty($dados->id))
	{
		$_SESSION['msg_index'] = 'Esse registro n&atilde;o existe';
		header('Location:index.php');
	}


    $id = $dados->id;

  	$descricao   = $dados->descricao;
    $created = $dados->created;

	$data_validade = $dados->data_validade;

    $data3=explode("-", $data_validade);

	$data_validade=$data3[2]."/".$data3[1]."/".$data3[0];

    $status = $dados->status;

	$data1=explode("-", $data_inicio);
	$data_inicio=$data1[2]."/".$data1[1]."/".$data1[0];


	$data2=explode("-", $data_final);
	$data_final=$data2[2]."/".$data2[1]."/".$data2[0];


?>
