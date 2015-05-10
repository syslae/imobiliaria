<?php 	 
	$id = (int)$_POST['id'];
     
	$cliente_id = (int)$_POST['cliente_id'];
     
	$servico_id = (int)$_POST['servico_id'];
     
	$situacao_pagamento_id = (int)$_POST['situacao_pagamento_id'];
     
	$numero_nota_empenho = trim($_POST['numero_nota_empenho']);
	$numero_nota_empenho = substr($numero_nota_empenho,0,50);
	$numero_nota_empenho=addslashes($numero_nota_empenho); 
          
	$nf = trim($_POST['nf']);
	$nf = substr($nf,0,20);
	$nf=addslashes($nf); 
     
	$mes_emissao = trim($_POST['mes_emissao']);
	$mes_emissao = substr($mes_emissao,0,10);
	$mes_emissao=addslashes($mes_emissao); 
     
	$data_pagamento = trim($_POST['data_pagamento']); 
	$ano_emissao = (int)$_POST['ano_emissao'];
     
	$n_pd = trim($_POST['n_pd']);
	$n_pd = substr($n_pd,0,50);
	$n_pd=addslashes($n_pd); 
     
	$valor = trim($_POST['valor']); 
	$data_nota = trim($_POST['data_nota']); 
	$status = (int)$_POST['status'];
    
?>