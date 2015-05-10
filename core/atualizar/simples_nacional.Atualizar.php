<?php

  class SimplesNacional extends ADOdb_Active_Record
  {
    var $_table = 'simples_nacional';
  }
  $obj = new SimplesNacional();

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

    $created = $dados->created;

    $mes = $dados->mes;

    $ano = $dados->ano;

    $valor = moeda($dados->valor);

    $espaco_fisico_id = $dados->espaco_fisico_id;

    $created = $dados->created;

    $status = $dados->status;











?>
