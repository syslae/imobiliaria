<?php

  class Ferias extends ADOdb_Active_Record
  {
    var $_table = 'ferias';
  }
  $obj = new Ferias();

  $dadosArray = $obj->Find('id=?', $id);
  $dados = $dadosArray[0];

  if (empty($dados->id))
  {
    $_SESSION['msg_index'] = 'Esse registro n&atilde;o existe';
    header('Location:index.php');
  }


    $id = $dados->id;

    $usuario_id = $dados->usuario_id;

    $descricao   = $dados->descricao;

    $data_inicio = $dados->data_inicio;

    $data2=explode("-", $data_inicio);

    $data_inicio=$data2[2]."/".$data2[1]."/".$data2[0];

    $data_fim = $dados->data_fim;

    $data3=explode("-", $data_fim);

    $data_fim=$data3[2]."/".$data3[1]."/".$data3[0];

    $espaco_fisico_id = $dados->espaco_fisico_id;

    $created = $dados->created;

    $status = $dados->status;






?>
