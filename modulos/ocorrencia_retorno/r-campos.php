<tr>
    <td colspan="2"> 
        <? foreach($upLoadsFeitos as $key => $uf){?>

        <input type="hidden" name="nome_arquivo<?echo $key+1;?>" value="<? echo $uf;?>">
    <? } ?>

    <ul id="selecaoAbas" class="selecaoAbas">
        <li id="celAba1" class="abaativa" style="cursor: context-menu;"><img src="<?= URL . '/webroot/img_sistema/autorizar2.png' ?>infor-user.png" style="vertical-align:middle; margin: 0 5px 0 0;" alt=""/>Passo 1 - Enviar arquivos</li>
        <li id="celAba2" style="cursor: context-menu;"><img src="<?= URL . '/webroot/img_sistema/Donate.png' ?>icon-finance.png" style="vertical-align:middle; margin: 0 5px 0 0;" alt=""/>Passo 2 - Dados bancários</li>
        <li id="celAba3" style="cursor: context-menu;"><img src="<?= URL . '/webroot/img_sistema/fornecer_2.png' ?>icon-book.png" style="vertical-align:middle; margin: 0 5px 0 0;" alt=""/>Passo 3 - Tratando</li>
    </ul>

    <?if(!empty($errors)){

        foreach($errors as $er){?>
        <div class="message error">
            <p><? echo $er['texto'];?></p>
        </div>

    <? }
    } ?>

    <div id="div1">

        <div class="message warning">
            <p>Formatos válidos dos arquivos de retorno: txt,ret,sai,dat</p>
        </div>
        <fieldset class="field-full">
                <legend>Localizar arquivos de retorno</legend>
                    <div id="arquivo1">
                    <p>
                        <label>Arquivo1</label>
                        <span class="field">
                            <!-- <form >
                                 <input type="file" name="localizaarquivo1" id="localizaarquivo1" onchange="upload_arquivo(this.form,'upload_arquivo.php','caminho_localizaarquivo1','Carregando...','Erro ao carregar')" />

                             </form>
                            <input type="hidden" name="caminho_localizaarquivo1" id="caminho_localizaarquivo1">-->

                              <input type="file" name="localizaarquivo1" id="localizaarquivo1" />

                        </span>
                    </p>

                    </div>

                    <div id="arquivo2">
                    <p>
                        <label>Arquivo2</label>
                        <span class="field">
                            <input type="file" name="localizaarquivo2" id="localizaarquivo2" />

                        </span>
                    </p>

                    </div>

                    <div id="arquivo3">
                    <p>
                        <label>Arquivo3</label>
                        <span class="field">
                            <input type="file" name="localizaarquivo3" id="localizaarquivo3" />

                        </span>
                    </p>

                    </div>

                    <div id="arquivo4">
                    <p>
                        <label>Arquivo4</label>
                        <span class="field">
                            <input type="file" name="localizaarquivo4" id="localizaarquivo4" />

                        </span>
                    </p>

                    </div>

                    <div id="arquivo5">
                    <p>
                        <label>Arquivo5</label>
                        <span class="field">
                            <input type="file" name="localizaarquivo5" id="localizaarquivo5" />

                        </span>
                    </p>

                    </div>

                    <p id="removerLocaliza">
                        <label>&nbsp;</label>
                        <span>
                            <a href="javascript:;" onclick="removerLocalizaArquivo()">Remover Localizar Arquivo</a>

                        </span>
                    </p>

                    <p id="inserirLocaliza">
                        <label><input type="hidden" name="qtde_arq" id="qtde_arq" value="1"/></label>

                        <span>
                            <a href="javascript:;" onclick="inserirLocalizaArquivo()">Adicionar Localizar Arquivo</a>
                        </span>
                    </p>
               </fieldset>

                <input name="FormaBanco" type="hidden" id="FormaBanco" value="<?=$FormaBanco?>"/>

                <div><button type="button" class="btn-salvar" onclick="$('#form').submit();">Próximo Passo</button></div>
                <input name="acao" type="hidden" id="acao" value="<? echo $acao;?>"/>
                <input name="tipoRetorno" type="hidden" id="tipoRetorno" value=""/>
                <input type="hidden" name="NumRetorno" id="NumRetorno"  value="">



    </div>

    <div id="div2">
        <fieldset class="field-full">
            <legend>Layout do retorno</legend>
            <p>
                <label>Layout</label>
                        <span class="field">

                        <?
                            $entrou = false;

                            $sql = "select distinct sigla as Sigla,id as idBanco, banco as Banco, tamanho_linha as TamanhoLinha
                                    from bancos b where id in (select distinct(banco_id) from parcelas)";
                            $rs = $DB->Execute($sql);

                            ?>

                            <select name="Layout" id="Layout" class="select" onchange="carregaBanco(this.value)">
                                <option value="">ESCOLHA O LAYOUT DO RETORNO</option>

                                <? While (!$rs->EOF) {
                                echo '
                                            <option value="'.$rs->fields['idBanco'].'"';
                                if ($Layout == trim($rs->fields['idBanco'])) echo "selected";
                                echo '>'.$rs->fields['idBanco'].' - '.$rs->fields['Banco'].' - '.$rs->fields['TamanhoLinha'].'</option>';

                                $rs->MoveNext();
                            }
                                ?>
                            </select>


                        </span>
            </p>
        </fieldset>

        <fieldset class="field-full">
            <legend>Configurações do tratamento</legend>

            <fieldset class="field-full">
                <div class="base_99">
                    <label><strong>Num.:</strong></label> <br/>
                    <input type="checkbox" name="valorMaior" value="S"<?if ($BaixaValorMaior == 'S') echo "checked"?>/> <strong>Baixar boletos com o valor pago maior que o esperado</strong><br/>
                    <input type="checkbox" name="baixarCancelado" value="S" /> <strong>Baixar boletos cancelados</strong>

                </div>

                <?if(empty($Margem)) $Margem = '5';?>
                <div class="base_99">
                            <span class="field">
                            <label><strong>Margem de Diferença entre valor pago e o esperado ( Juros, Multa e Descontos )</strong></label>
                                <input onkeypress="Mascara(this,mascValor)" name="Margem" type="text" class="<?=$class_desconto?> input_branco" id="Margem" value="<?=stripslashes($Margem)?>"  size="20" maxlength="20"/>
                            </span>
                </div>

            </fieldset>
            <p>
                        <span class="field">
                            <input type="checkbox" name="naoBaixarBoleto" value="S"<?if ($NaoBaixar == 'S') echo "checked"?>/> <strong>Não baixar boletos ( realizar somente o tratamento para fins de conferência)</strong>

                        </span>
            </p>

            <div id="botao"><button type="button" class="btn-salvar" onclick="Salvar();">Tratar Arquivo(s)</button></div>

        </fieldset>

    </div>

    <div id="div3"></div>

    <br/>
    <div id="result"></div>
    <script>
     
    $("#arquivo2").hide("hide");
    $("#arquivo3").hide("hide");
    $("#arquivo4").hide("hide");
    $("#arquivo5").hide("hide");
    $("#removerLocaliza").hide("hide");

    defineAba("celAba1", "div1");
    defineAba("celAba2", "div2");
    defineAba("celAba3", "div3");

    <? if($acao == 'upload'){?>
        defineAbaAtiva("celAba1");

    <?}else if($acao == 'Tratar'){?>
        defineAbaAtiva("celAba2");

    <? } ?>

    </script>

    </td>
</tr>