<?php

  class Rescisao extends ADOdb_Active_Record
  {
    var $_table = 'rescisao';
  }
  $obj = new Rescisao();

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

    $data = $dados->data;

    $data3=explode("-", $data);

    $data=$data3[2]."/".$data3[1]."/".$data3[0];

    $espaco_fisico_id = $dados->espaco_fisico_id;

    $created = $dados->created;

    $status = $dados->status;











?>
