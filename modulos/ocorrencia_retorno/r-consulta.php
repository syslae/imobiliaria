
        <fieldset class="field-full" style="width: 800px; margin-right: 13px;">
    
                <p>
                	<label>Layout</label>
                    <span class="field"> 
                    
                    <?
                        $entrou = false;

                        $sql = "Select DISTINCT sigla as Sigla,id as idBanco, banco as Banco, tamanho_linha as TamanhoLinha from bancos b where id in (Select distinct(banco_id) from parcelas)";
                        $rs_layout = $DB->Execute($sql);

                        ?>

                        <select name="Layout" id="Layout" class="select" onchange="">
                            <option value="">ESCOLHA O LAYOUT DO RETORNO</option>

                            <? While (!$rs_layout->EOF) {
                            echo '
                                        <option value="'.$rs_layout->fields['idBanco'].'"';
                            if ($Layout == trim($rs_layout->fields['idBanco'])) echo "selected";
                            echo '>'.$rs_layout->fields['idBanco'].' - '.$rs_layout->fields['Banco'].' - '.$rs_layout->fields['TamanhoLinha'].'</option>';

                            $rs_layout->MoveNext();
                        }
                            ?>
                        </select>
                            
                            
                    </span>
                </p>
                
                <p>
                	<label>Filtro</label>
                    <span class="field">                    
                        <?  $sql = "select banco as Banco from bancos where sigla in ('IT','HS','BS','BI')";
                            $rs2 = $DB->Execute($sql);
                        ?>
                        <select name="Filtro" id="Filtro" class="select">
                            <option value="0">TODOS</option>
                            
                            <option value="1"<?if ($Filtro == '1') echo "selected"?>>BOLETOS PAGOS COM VALOR ESPERADO</option>
                            <option value="2"<?if ($Filtro == '2') echo "selected"?>>BOLETOS PAGOS COM VALOR PAGO A MAIOR INCONSISTENTE</option>
                            <option value="3"<?if ($Filtro == '3') echo "selected"?>>BOLETOS PAGOS COM VALOR PAGO A MENOR INCONSISTENTE</option>
                            <option value="4"<?if ($Filtro == '4') echo "selected"?>>BOLETOS PAGOS NÃO ENCONTRADOS</option>
                            <option value="5"<?if ($Filtro == '5') echo "selected"?>>BOLETOS PAGOS CANCELADOS</option>
                            <option value="6"<?if ($Filtro == '6') echo "selected"?>>BOLETOS JÁ PAGOS</option>
                            
                            
                            
                        </select>
                        
                    </span>
                </p>
                
                <p>
                	<label>Ano</label>
                    <span class="field">                    
                        <?  $sql = "select distinct YEAR(data_mov) as ano from ocorrencia_retorno order by ano desc";
                            $rs2 = $DB->Execute($sql);
                        ?>
                        <select name="ano" id="ano" class="select">
                            <option value="">TODOS</option>
                            <? While(!$rs2->EOF) { ?>
                            <option value="<?=$rs2->fields['ano']?>"<?if ($rs2->fields['ano'] == $Ano) echo "selected"?>><?=$rs2->fields['ano']?></option>
                            
                            
                            <?
                            
                            $rs2->MoveNext();
                            } ?>
                            
                        </select>
                        
                    </span>
                </p>

                <p style="display:none;">
                    <input type="checkbox" name="relatorio_por_situacao" value="S" onclick="tratar_form(this);"> Tirar relatório de retorno por situação do boleto
                </p>

            <fieldset class="field-full" style="width: 800px; margin-right: 13px;display: none;" id="fieldset-situacao">
                <legend><input type="checkbox" id="check_situacao_boleto" checked="checked" onclick="check_all('situacao_boleto');"/><span style="margin-left:5px; ">Situação Recebimento</legend>
                <div class="field">
                    <?php
                    foreach ($rs_situacao_parcelas as $situacoes_pagamento) {
                        $id_situacao = $situacoes_pagamento['idSituacao'];
                        $descricao_situacao = $situacoes_pagamento['Descricao'];
                        echo '<input type="checkbox" checked name="situacao_boleto[]" id="situacao_boleto" value="'.$id_situacao. '"/><span style="margin-left:3px; margin-right:20px;"> '.$descricao_situacao.'</span>';
                    }
                    ?>
                </div>
            </fieldset>

        </fieldset>

                
                