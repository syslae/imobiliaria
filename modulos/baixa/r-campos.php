<tr>
    <td height="5" align="right" class="text_bold_preto">&nbsp;</td>
    <td class="text_padrao">
        <input name="id" type="hidden" class="<?=$class_id?>" id=""<?=$id?>"" value="<?=$id?>"  size="3" maxlength="3" />
    </td>
</tr>

<tr height="36">
    <!--<td height="36" align="right" class="text_bold_preto"></td>-->
    <td class="text_padrao" id="add_clientes" align="center">
        <a href="<?=URL.'/modulos/pesquisa_cliente/'?>cadastrar.php?keepThis=true&TB_iframe=true&height=350&width=500" class="thickbox" >ADICIONAR CLIENTE</a>
    </td>
</tr>

<tr>
    <!--<td height="36" align="right" class="text_bold_preto"></td>-->
    <td class="text_padrao" id="add_clientes">
        <div id="filhos_clientes">
            <?=retornaFilhosCliente($_POST['cliente_id'])?>
        </div>
                                                    <span id="clientes_i">
                                                    </span>
        <input type="hidden" id="qtd_filhos" value="<?=$qtd_clientes_filhos?>" name="qtdfilhos" />
    </td>
</tr>

<tr>
    <!--<td height="36" align="right" class="text_bold_preto"></td>-->
    <td class="text_padrao">
        <div id="div-parcelas-aberto">
        </div>
    </td>
</tr>
