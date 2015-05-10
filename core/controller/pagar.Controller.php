<?
    session_start();
    require("../../config/define.php");
	require(DOMAIN_PATH."config/conexaoAr.php");
	require(DOMAIN_PATH."funcoes.inc.php");
	require(DOMAIN_PATH."funcoesValidar.inc.php");
    include("../model/movimentacao.Model.php");
    //$DB->debug=true;
    $data2=explode("/", $data_pagamento);
	$data_pagamento2=$data2[2]."/".$data2[1]."/".$data2[0];
    if(empty($data_pagamento))
    {
      echo "<script>alert('Data pagamento vazia!!!')</script>";
      echo("<script language='javascript'>location.href='javascript:history.go(-1)'</script>");
      exit();  
    }
     $sql_insc = "update movimentacao set data_pagamento = '".$data_pagamento2."',situacao_pagamento_id = 1 where id = '".$movimentacao_id."'";
    $DB->Execute($sql_insc);
    
    //exit();
    $_SESSION['msg_index'] = 'Salvo com sucesso';
	redireciona('../../modulos/movimentacao/index.php');
        
  ?>    