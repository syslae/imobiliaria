<?
$qtde_arq = $_REQUEST['qtde_arq'];
$percentual_arq = round(($cont_arq * 100) / $qtde_arq,1);
$percentual_linhas = round(($cont * 100) / $qtd_linhas,1);


?>

<fieldset class="field-full" style="width: 800px; margin-top: 10px;">

        <legend> Processando ARQUIVOS </legend>

        <br style="clear: left;";><span class="obrigatorio">Aguarde...</span><br>
        Quantidade de <strong>ARQUIVOS DE RETORNO</strong>: <span> <? echo $cont_arq;?> </span> / <strong> <? echo $qtde_arq;?></strong> ( lidos / <strong>total</strong> )
        <h1>Progresso: <? echo $percentual_arq.'%';?></h1>
        <div style="display: table;background-color: #99CCFF;width:<? echo $percentual_arq.'%';?>;margin-top: 10px;">&nbsp;</div>

        <br/>

        <br style="clear: left";><span class="obrigatorio">Aguarde...</span><br>
        Quantidade de <strong>LINHAS NO RETORNO ATUAL</strong >: <span> <? echo $cont;?> </span>  / <strong><? echo $qtd_linhas;?></strong> ( lidas / <strong>total</strong> )
        <h1>Progresso: <? echo $percentual_linhas.'%';?></h1>
        <div style="display: table;background-color: #99CCFF;width:<? echo $percentual_linhas.'%';?>;margin-top: 10px;">&nbsp;</div>

        <? if($cont >=$qtd_linhas){
            $cont_arq++;
            $_SESSION['DataGerRetorno_'.$sistema] = '';
            if(!empty($_POST["nome_arquivo$cont_arq"])) $cont = 1;
        }
        else{
            $cont += $lerQtdeLinhas;
            if($cont > $qtd_linhas) $cont = $qtd_linhas;
        }

        if($cont_arq > $qtde_arq){?>

            <div class="notification msgsuccess">
                <p>Tratamento concluído! Clique no botão para ser enviado ao relatório.</p>
            </div>

            <p>
                <button type="button" class="btn-salvar-inst" onclick="window.location = '<? echo URL."/modulos/ocorrencia_retorno/cadastrar.php";?>';">Realizar outra baixa</button>&nbsp;
                <button type="button" class="btn-salvar-inst" onclick="openRelatorio();">Relatório</button></p>
        <?


        }?>

    </fieldset>

    <input type="hidden" name="cont_arq" id="cont_arq"  value="<? echo $cont_arq;?>">
    <input type="hidden" name="cont" id="cont" value="<? echo $cont;?>">
    <input type="hidden" name="Sigla" id="Sigla" value="<? echo $Sigla;?>">
    <input type="hidden" name="Tamanho" id="Tamanho" value="<? echo $Tamanho;?>">
    <input type="hidden" name="idCaixaRetorno" id="idCaixaRetorno" value="<? echo $idCaixaRetorno;?>">
    <input type="hidden" name="idAberturaCaixaRetorno" id="idAberturaCaixaRetorno" value="<? echo $idAberturaCaixaRetorno;?>">
    <input type="hidden" name="id_FormaPagamento" id="id_FormaPagamento" value="<? echo $id_FormaPagamento;?>">
    <input type="hidden" name="DescLocalPagamento" id="DescLocalPagamento" value="<? echo $DescLocalPagamento;?>">
    <input type="hidden" name="LocalPagamento" id="LocalPagamento" value="<? echo $LocalPagamento;?>">
    <input type="hidden" name="SituacaoPago" id="SituacaoPago" value="<? echo $SituacaoPago;?>">
    <input type="hidden" name="Radical" id="Radical" value="<? echo $Radical;?>">
    <input type="hidden" name="MatriculaBanco" id="MatriculaBanco" value="<? echo $MatriculaBanco;?>">
    <input type="hidden" name="Agencia" id="Agencia" value="<? echo $Agencia;?>">
    <input type="hidden" name="c" id="c" value="<? echo $c;?>">
