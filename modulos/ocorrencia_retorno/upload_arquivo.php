<?
$valid_formats = array("txt","ret","sai","dat"); //formatos válidos pra tratamento

if(empty($_FILES["localizaarquivo1"]['name']))
{
    $errors[]['texto'] = 'Informe um arquivo!';
    $erro .= 'Layout';
}

if(empty($erro)){
    $i = 1;
    while ($i <= $_POST['qtde_arq'])
    {
        //echo "ARQUIVO ".$i."<BR/>";
        $dados_arquivos = explode(".", $_FILES["localizaarquivo".$i.""]['name']);
        $ext = $dados_arquivos[count($dados_arquivos)-1];
        $formato_permitido = true;
        $Condicao = "";

        if(!in_array(strtolower($ext),$valid_formats)){

            $errors[]['texto'] = 'O arquivo '.$de.' não foi tratado!\n motivo: formato inválido.';
            $formato_permitido = false;

        }else{

            //upload do arquivo
            $arq =$_FILES["localizaarquivo".$i.""];
            $de =$_FILES["localizaarquivo".$i.""]['name'];

            //verificando se existe a pasta arquivos
            $caminho = DOMAIN_PATH."modulos/ocorrencia_retorno/arquivos/";
            if (!file_exists($caminho))
            {
                mkdir("$caminho",0777);
                chmod("$caminho",0777);
            }

            // Caminho de onde ficará a arquivo
            $caminho .= $arq['name'];

            // Faz o upload da imagem para seu respectivo caminho
            if(!move_uploaded_file($arq["tmp_name"], $caminho)){
                switch($_FILES["localizaarquivo".$i.""]['error']){
                    case 1:
                        $errors[]['texto'] = 'O arquivo no upload é maior que o definido pelo servidor, '.$tamanho_max_upload.'MB.';
                        break;
                    case 2:
                        $errors[]['texto'] = 'O arquivo no upload ultrapassa o tamanho definido pelo módulo.';
                        break;
                    case 3:
                        $errors[]['texto'] = 'O upload foi feito parcialmente.';
                        break;
                    case 4:
                        $errors[]['texto'] = 'Não foi feito o upload do arquivo.';
                        break;
                    default :
                        $errors[]['texto'] = 'falhou o upload do arquivo.';
                        break;
                }
            }else{
                $upLoadsFeitos[] = $arq['name'];
            }



        }

        $i++;
    }
}
?>