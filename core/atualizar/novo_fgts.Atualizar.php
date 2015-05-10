<?php

  class Novo_fgts extends ADOdb_Active_Record
  {
    var $_table = 'novo_fgts';
  }
  $obj = new Novo_fgts();

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
