<?
if($_POST['acao']=='atualizar' and empty($id))
{
    $erro .= ' Id';
    $class_id = 1;
}

if(empty($cliente_id))
{
    $erro .= 'cliente_id';
    $class_cliente_id = 1;
}

if(empty($produto_id))
{
    $erro .= 'produto_id';
    $class_produto_id = 1;
}

if(is_array($vencimento)){
    foreach($vencimento as $key => $venc){

        if(empty($venc))
        {
            $erro .= 'vencimento';
            $class_vencimento = 1;
        }

    }

}else{
    $erro .= 'vencimento';
    $class_vencimento = 1;
}

if(empty($banco_id))
{
    $erro .= 'banco_id';
    $class_banco_id = 1;
}

if (empty($erro))
{
    class Movimentacao extends ADOdb_Active_Record
    {
        var $_table = 'movimentacao';
    }

    class Itens_movimentacao extends ADOdb_Active_Record
    {
        var $_table = 'itens_movimentacao';
    }

    class Parcelas extends ADOdb_Active_Record
    {
        var $_table = 'parcelas';
    }

    //$DB->debug = 1;
    $deu_certo = false;
    $conjunto_movimentacoes = array();

    //Iniciando o movimento de transação
    $DB->BeginTrans();

    try
    {

        $situacao_aberto = $DB->Execute("select id from situacao_pagamento where descricao like '%abert%' and status = 1")->fields["id"];
        $ds = $DB->Execute('select condicao_juros,base_juros from Parametro');

        $sequencial = 1;

        foreach($cliente_id as $key => $cliente){

            $obj = new Movimentacao();

            if (!empty($id)) $obj->load('id=?', $id);

            $data_servidor = date('Y-m-d H:i:s');

            $obj->cliente_id = $cliente;

            $obj->created = $data_servidor;

            $obj->status = 1;

            $ok = $obj->save();  // esse save() vai retornar um UPDATE ou INSERT

            if (empty($id)) $movimentacao_id = $DB->insert_id(); // retorna o último id adcionado
            else $movimentacao_id = $id;

            $conjunto_movimentacoes[] = $movimentacao_id;

            foreach($produto_id as $key => $produto){

                $objIM = new Itens_movimentacao();

                $objIM->produto_id = $produto;

                $objIM->movimentacao_id = $movimentacao_id;

                $objIM->valor = $valor_total[$key];

                $objIM->created = $data_servidor;

                $objIM->status = 1;

                $ok = $objIM->save();  // esse save() vai retornar um UPDATE ou INSERT

                //atualizando estoque do produto
                $DB->Execute("update produto set status = 0 where id = $produto");


            }

            foreach($vencimento as $key => $venc){

                $objP = new Parcelas();

                $objP->situacao_pagamento_id = $situacao_aberto;

                $objP->movimentacao_id = $movimentacao_id;

                $parcela = ($key + 1);
                $objP->parcela = $parcela;

                $ano = substr($venc,6,4);
                $objP->ano = $ano;

                $objP->data_vencimento = formata_data($venc,"/","-");

                $objP->status = 1;

                $objP->created = $data_servidor;

                $objP->valor = $valor_parcela[$key];

                $objP->sequencial = $sequencial;

                $objP->banco_id = $banco_id;

                $cod_carteira = CodCarteira($banco_id);
                $objP->cod_carteira = $cod_carteira;

                $nosso_numero = GeraNossoNumero($cliente, $parcela, $ano, $sequencial, $banco_id, $cod_carteira);

                $objP->nosso_numero = $nosso_numero;

                $objP->cod_barras = GeraCodBarras($venc, $valor_parcela[$key], $nosso_numero, $banco_id);

                $objP->seu_numero = SeuNumero($parcela, $cliente, $sequencial);

                $objP->moeda = '09';

                $multa = ($valor_parcela[$key] * Multa($banco_id)) / 100;
                if($multa <= 0) $multa = 0;

                $objP->multa = $multa;

                $objP->dt_multa = DtMulta($venc, $banco_id);

                $objP->desconto = Desconto($banco_id);

                $objP->dt_desconto = DtDesconto($venc, $banco_id);

                $juros = ($valor_parcela[$key] * Juros($banco_id)) / 100;
                if($juros <= 0) $juros = 0;
                $juros = number_format($juros,2,'.','');

                $objP->juros = $juros;

                $objP->prazo_protesto_devolucao = PrazoProtestoDevolucao($banco_id);

                $objP->protesto_devolucao = ProtestoDevolucao($banco_id);

                $objP->prazo_multa = PrazoMulta($banco_id);

                $objP->mensagem1 = $mensagem1;

                $objP->mensagem2 = $mensagem2;

                $objP->mensagem3 = $mensagem3;

                $objP->mensagem4 = $mensagem4;

                $objP->mensagem5 = $mensagem5;

                $objP->mensagem6 = $mensagem6;

                $objP->mensagem7 = $mensagem7;

                $objP->mensagem8 = $mensagem8;

                $objP->mensagem9 = $mensagem9;

                $objP->condicao_juros = $ds->fields["condicao_juros"];

                $objP->base_juros = $ds->fields["base_juros"];


                $ok = $objP->save();  // esse save() vai retornar um UPDATE ou INSERT

            }

        }

        $deu_certo = true;

    }
    catch(ADODB_Exception $e)
    {
        $deu_certo = false;
        echo 'Ocorreu uma execao do tipo ADODB_Exception no modulo de salvar ';
    }
    catch(exceptions $e)
    {
        //echo $e->getMessage();
        $deu_certo = false;
        echo 'Ocorreu uma execao no modulo de salvar';
    }

    if($deu_certo){
        //caso não ocorra nenhuma falha durante o processamento, realiza-se o a efetivação
        $DB->CommitTrans();

        $_SESSION['msg_index'] = 'Salvo com sucesso';
        redireciona('index.php?m_id='.implode(",",$conjunto_movimentacoes));

    }else{
        //caso ocorra alguma falha durante o processamento, realiza-se o cancelamento
        $DB->RollbackTrans();

    }

}
?>

