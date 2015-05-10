<? 	session_start();
	require("../config/define.php");
	require(DOMAIN_PATH."config/conexaoAr.php");
	require(DOMAIN_PATH."funcoes.inc.php");
    require("../includes/funcoes.php");
    header("Content-type: text/html; charset=ISO-8859-1");
	$cliente_id =     (int) $_GET["cliente_id"];

    $situacao_pagamento_aberto = $DB->Execute("select id from situacao_pagamento where descricao like '%abert%'")->fields["id"];

    $rs = $DB->Execute("
      SELECT p.id,p.movimentacao_id,m.cliente_id,c.nome,p.ano,p.parcela,p.data_vencimento,p.valor,p.situacao_pagamento_id,
      sp.descricao, p.nosso_numero from parcelas p inner join movimentacao m on m.id = p.movimentacao_id
      inner join cliente c on c.id = m.cliente_id inner join situacao_pagamento sp on sp.id = p.situacao_pagamento_id
      where 1=1 and m.cliente_id = '$cliente_id' and p.situacao_pagamento_id = '$situacao_pagamento_aberto' and p.status = 1 order by p.created desc, p.data_vencimento desc, p.parcela desc
    ");

    $tr = $rs->recordCount();

 ?>


<table width="830" id="box-table-a" cellspacing="0" cellpadding="2">
    <thead>
    <tr>
        <th>Boleto(s) <input type="checkbox" onclick="marcar_todos('checkbox',this.checked);"></th>
        <th >NossoNumero</th>
        <th width="57"><span title="Movimentação">Mov.</span></th>
        <th>Cliente</th>
        <th>Ano</th>
        <th>Parcela</th>
        <th>Vencimento</th>
        <th>Valor</th>
        <th>Data de Baixa</th>
        <th>Valor Baixa</th>
        <th>Situação</th>
    </tr>
    </thead>
    <?
    if ($tr>0)
    {
        if (!$rs)
        {

            print $DB->ErrorMsg(); //mostra mensagem de erro

        } // fim do IF
        else
        {
            $posicao=1;

            while (!$rs->EOF)
            {

                $id = $rs->fields['id'];

                // campos permitidos ou nao para atualizar

                if (($_SESSION["permissao_temp"]>1))
                {

                    $campo1 = '<a href = "atualizar.php?id='.$rs->fields['id'].'" title="'.$rs->fields['nome'].'" alt="'.$rs->fields['nome'].'">'.$rs->fields['nome'].'</a>';

                    if (!empty($rs->fields['status']))
                    {
                        $status = '<img id="img-'.$posicao.'" name="img-'.$posicao.'" src="../../webroot/img_sistema/bola-verde.gif" onclick="javascript:atualizaStatus('.$posicao.',0,'.$rs->fields['id'].',\'pedido\');"  border="0">';
                    }
                    else
                    {
                        $status = '<img id="img-'.$posicao.'" name="img-'.$posicao.'" src="../../webroot/img_sistema/bola-vermelha.gif" onclick="javascript:atualizaStatus('.$posicao.',1,'.$rs->fields['id'].',\'pedido\');"  border="0">';
                    }
                }
                else
                {

                    $campo1 = '<a href = "javascript:;" title="'.$rs->fields['nome'].'">'.$rs->fields['nome'].'</a>';

                    if ($rs->fields['status']==0)
                        $status='<img src="../../webroot/img_sistema/bola-vermelha.gif">';
                    else
                        $status='<img src="../../webroot/img_sistema/bola-verde.gif">';

                }

                # Fundo da Célula

                $x = $x + 1;

                $div = $x % 2;

                if ($div != 0) $bg = $GLOBALS["bg1"]; else $bg = $GLOBALS["bg2"];

                # fim Fundo da Célula

                echo '

							<tr bgcolor="'.$bg.'">
							<td align="center">';
                                if($rs->fields['situacao_pagamento_id'] == $situacao_pagamento_aberto) botaoCheckbox($rs->fields['id']);

                                echo '&nbsp;</td>
								<td align="center">'.$rs->fields['nosso_numero'].'</td>
								<td align="center">'.$rs->fields['movimentacao_id'].'</td>
                                <td class="text_padrao">'.$rs->fields['cliente_id'].' - '.$rs->fields['nome'].'</td>
								<td class="text_padrao">'.$rs->fields['ano'].'</td>
	                            <td class="text_padrao">'.$rs->fields['parcela'].'</td>
                                <td class="text_padrao">'.$rs->UserTimeStamp($rs->fields['data_vencimento'],'d/m/Y').'</td>
                                <td class="text_padrao">R$ '.moeda($rs->fields['valor']).'</td>
                                <td class="text_padrao"><input type="date" name="data_baixa['.$rs->fields['id'].']"></td>
                                <td class="text_padrao" height="36"><input name="valor_baixa['.$rs->fields['id'].']" type="text"  id="valor_baixa"  size="12" maxlength="12"  onkeypress="Mascara(this,mascValor);" /></td>
	                            <td align="text_padrao">'.$rs->fields['descricao'].'&nbsp;</td>


							 </tr>

							';

                $posicao++;

                $rs->MoveNext();

            }

        }

    }

    else
    {
        echo '<center class="text_vermelho"><b>N&atilde;o existem resultados</b></center><br>';
    }
    ?>
</table>

