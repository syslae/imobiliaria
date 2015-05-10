<?php

	$id = (int)$_POST['id'];

	$cliente_id = $_POST['cliente_id'];

    $qtd_clientes_filhos = count($cliente_id);

    $produto_id = $_POST['produto_id'];

    $qtd_filhos = count($produto_id);

    $quantidade = $_POST['quantidade'];

    $valor_unitario = $_POST['valor_unitario'];

    $valor_total = $_POST['valor_total'];

    $valor_parcela = $_POST['valor_parcela'];

    $options = count($valor_parcela);

    $qtdproduto = (int) $_POST['qtdproduto'];

    $vencimento = $_POST['vencimento'];

    $acao = $_POST['acao'];

    $ValorTotalItem = $_POST['ValorTotalItem'];

    $banco_id = trim($_POST['banco_id']);

    $produto_principal_id = trim($_POST['produto_principal_id']);



?>
