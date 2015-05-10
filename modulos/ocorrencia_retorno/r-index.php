<table width="830" id="box-table-a" cellspacing="0" cellpadding="2">
    <thead>
        <tr>
            <th width="57">Ações</th> 
            <th >Número Retorno</th>
            <th>Banco</th>
            <th>Data de Pagamento</th> 
            <th>Data da Movimentação</th> 
            <th>Quantidade boletos</th> 

        </tr>
    </thead>
    <?
    if ($tr > 0) {

        if (!$rs) {

            print $DB->ErrorMsg(); //mostra mensagem de erro
        } // fim do IF
        else {
            $posicao = 1;

            while (!$rs->EOF) {


                $id = $rs->fields['NumRetorno'];


                # Fundo da Célula

                $x = $x + 1;

                $div = $x % 2;

                if ($div != 0)
                    $bg = $GLOBALS["bg1"];
                else
                    $bg = $GLOBALS["bg2"];

                # fim Fundo da Célula

                echo '

							<tr bgcolor="' . $bg . '">

							         <td align="center">';
                botaoCheckbox($id);
                echo '&nbsp;</td>';

                echo '
                                    
                                    
                                       <td class="text_padrao">' . $rs->fields['NumRetorno'] . '</td>
                                        <td class="text_padrao">' . $rs->fields['banco'] . '</td>
                                       <td class="text_padrao">' . $rs->fields['DataRet'] . '</td>
                                       <td class="text_padrao">' . $rs->fields['DataMov'] . '</td>
                                       <td class="text_padrao">' . (int) $rs->fields['qtd_boletos'] . '
                                       </td>
                                       
                                    
                                    
                                    
                                ';

                $posicao++;

                $rs->MoveNext();
            }
        }
    }

    else {
        echo '<div>Nao existem resultados</div>';
    }
    ?>
</table>

