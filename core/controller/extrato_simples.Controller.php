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
    class Extrato_Simples extends ADOdb_Active_Record
    {
      var $_table = 'extrato_simples';
    }
    $obj = new Extrato_Simples();


    if (!empty($id)) $obj->load('id=?', $id);

        $obj->espaco_fisico_id  = $_SESSION["espaco_fisico_id"];

        $obj->usuario_id  = $_SESSION["idusuario_g"];

        $obj->descricao  = $descricao;

        $obj->mes  = $mes;

        $obj->ano  = $ano;

        // $obj->valor  = $valor;

    $obj->status = 1;

  if (empty($id)) $obj->created = date('Y-m-d H:i:s') ;
    try
    {
        $ok = $obj->save();  // esse save() vai retornar um UPDATE ou INSERT
            $sql =  "select * from extrato_simples where  espaco_fisico_id = '".$_SESSION["espaco_fisico_id"]."' order by id desc";
            $Rs = $DB->EXECUTE($sql);
      if($_FILES['extrato_simples']['size'] > 2024000)
            {
                print "<SCRIPT> alert('Seu arquivo não poderá ser maior que 1mb'); window.history.go(-1); </SCRIPT>\n";
                exit;
            }
            /* Defina aqui o diretório destino do upload */
            if (!empty($_FILES['extrato_simples']['tmp_name']) and is_file($_FILES['extrato_simples']['tmp_name']))
            {
                $caminho="../../upload/extrato_simples/";
                $caminho = $caminho.$Rs->fields['id'].".pdf";
                /* Defina aqui o tipo de arquivo suportado */
                if ((eregi(".gif$", $_FILES['extrato_simples']['name'])) || (eregi(".pdf", $_FILES['extrato_simples']['name'])) || (eregi(".png", $_FILES['extrato_simples']['name'])) || (eregi(".jpg$", $_FILES['extrato_simples']['name'])) || (eregi(".txt$", $_FILES['extrato_simples']['name'])))
                {
                    copy($_FILES['extrato_simples']['tmp_name'],$caminho);
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

