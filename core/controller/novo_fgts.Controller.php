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
    class Novo_fgts extends ADOdb_Active_Record
    {
      var $_table = 'novo_fgts';
    }
    $obj = new Novo_fgts();


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
            $sql =  "select * from novo_fgts where  espaco_fisico_id = '".$_SESSION["espaco_fisico_id"]."' order by id desc";
            $Rs = $DB->EXECUTE($sql);
      if($_FILES['novo_fgts']['size'] > 2024000)
            {
                print "<SCRIPT> alert('Seu arquivo não poderá ser maior que 1mb'); window.history.go(-1); </SCRIPT>\n";
                exit;
            }
            /* Defina aqui o diretório destino do upload */
            if (!empty($_FILES['novo_fgts']['tmp_name']) and is_file($_FILES['novo_fgts']['tmp_name']))
            {
                $caminho="../../upload/novo_fgts/";
                $caminho = $caminho.$Rs->fields['id'].".pdf";
                /* Defina aqui o tipo de arquivo suportado */
                if ((eregi(".gif$", $_FILES['novo_fgts']['name'])) || (eregi(".pdf", $_FILES['novo_fgts']['name'])) || (eregi(".png", $_FILES['novo_fgts']['name'])) || (eregi(".jpg$", $_FILES['novo_fgts']['name'])) || (eregi(".txt$", $_FILES['novo_fgts']['name'])))
                {
                    copy($_FILES['novo_fgts']['tmp_name'],$caminho);
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

