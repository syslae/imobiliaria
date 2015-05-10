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
    class SimplesNacional extends ADOdb_Active_Record
    {
      var $_table = 'simples_nacional';
    }
    $obj = new SimplesNacional();


    if (!empty($id)) $obj->load('id=?', $id);

        $obj->espaco_fisico_id  = $_SESSION["espaco_fisico_id"];

        $obj->usuario_id  = $_SESSION["idusuario_g"];

        $obj->descricao  = $descricao;

        $obj->mes  = $mes;

        $obj->ano  = $ano;

        $obj->valor  = moeda_ajuste($valor);

    $obj->status = 1;

  if (empty($id)) $obj->created = date('Y-m-d H:i:s') ;
    try
    {
        $ok = $obj->save();  // esse save() vai retornar um UPDATE ou INSERT
            $sql =  "select * from simples_nacional where  espaco_fisico_id = '".$_SESSION["espaco_fisico_id"]."' order by id desc";
            $Rs = $DB->EXECUTE($sql);
      if($_FILES['simples_nacional']['size'] > 2024000)
            {
                print "<SCRIPT> alert('Seu arquivo não poderá ser maior que 1mb'); window.history.go(-1); </SCRIPT>\n";
                exit;
            }
            /* Defina aqui o diretório destino do upload */
            if (!empty($_FILES['simples_nacional']['tmp_name']) and is_file($_FILES['simples_nacional']['tmp_name']))
            {
                $caminho="../../upload/simples_nacional/";
                $caminho = $caminho.$Rs->fields['id'].".pdf";
                /* Defina aqui o tipo de arquivo suportado */
                if ((eregi(".gif$", $_FILES['simples_nacional']['name'])) || (eregi(".pdf", $_FILES['simples_nacional']['name'])) || (eregi(".png", $_FILES['simples_nacional']['name'])) || (eregi(".jpg$", $_FILES['simples_nacional']['name'])) || (eregi(".txt$", $_FILES['simples_nacional']['name'])))
                {
                    copy($_FILES['simples_nacional']['tmp_name'],$caminho);
                }
          }

            $_SESSION['msg_index'] = 'Salvo com sucesso';
      redireciona('index.php');   }
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

