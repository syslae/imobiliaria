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
    class Ferias extends ADOdb_Active_Record
    {
      var $_table = 'ferias';
    }
    $obj = new Ferias();


    if (!empty($id)) $obj->load('id=?', $id);


        $data1=explode("/", $data_inicio);
        $nova_data_inicio=$data1[2]."-".$data1[1]."-".$data1[0];

        $data2=explode("/", $data_fim);
        $nova_data_fim=$data2[2]."-".$data2[1]."-".$data2[0];

        $obj->espaco_fisico_id  = $_SESSION["espaco_fisico_id"];

        $obj->usuario_id  = $_SESSION["idusuario_g"];

        $obj->descricao  = $descricao;

        $obj->data_inicio  = $nova_data_inicio;

        $obj->data_fim  = $nova_data_fim;

        $obj->status = 1;


  if (empty($id)) $obj->created = date('Y-m-d H:i:s') ;
    try
    {
        $ok = $obj->save();  // esse save() vai retornar um UPDATE ou INSERT
            $sql =  "select * from ferias where  espaco_fisico_id = '".$_SESSION["espaco_fisico_id"]."' order by id desc";
            $Rs = $DB->EXECUTE($sql);
      if($_FILES['ferias']['size'] > 2024000)
            {
                print "<SCRIPT> alert('Seu arquivo não poderá ser maior que 1mb'); window.history.go(-1); </SCRIPT>\n";
                exit;
            }
            /* Defina aqui o diretório destino do upload */
            if (!empty($_FILES['ferias']['tmp_name']) and is_file($_FILES['ferias']['tmp_name']))
            {
                $caminho="../../upload/ferias/";
                $caminho = $caminho.$Rs->fields['id'].".pdf";
                /* Defina aqui o tipo de arquivo suportado */
                if ((eregi(".gif$", $_FILES['ferias']['name'])) || (eregi(".pdf", $_FILES['ferias']['name'])) || (eregi(".png", $_FILES['ferias']['name'])) || (eregi(".jpg$", $_FILES['ferias']['name'])) || (eregi(".txt$", $_FILES['ferias']['name'])))
                {
                    copy($_FILES['ferias']['tmp_name'],$caminho);
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

