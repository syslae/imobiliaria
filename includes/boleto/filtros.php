
<fieldset class="field-full">
    <legend>Impressão de Documentos</legend>

    <div class="base_40">
        <label>Histórico Processamento</label>
	    <span class="field">
	    	<? if(empty($class_Matricula)) $class_Matricula = 'input_branco'; else $class_Matricula = 'input_erro'; ?>
            <!--<input name="Matricula" type="text" class="<?=$class_Matricula?>" onBlur="retornaNomeAluno()" id="Matricula" value="<?=stripslashes($Matricula)?>"  size="8" maxlength="8" onKeyUp="ContaCaracteresCampo('Matricula', 'MatriculaT', 8);" />-->
			<input type="hidden" id="id_HistoricoGeraBoleto" name="id_HistoricoGeraBoleto" value=""/>
            <input name="Nome_pesquisa_CodProcessamento" type="text" id="Nome_pesquisaCodProcessamento" class="Nome_pesquisaCodProcessamento" value=""  size="150" maxlength="150" />
	        <!--<input name="MatriculaT" type="text" disabled class="input_caracteres" id="MatriculaT" value="8" size="1" style="width:20px" />-->
	        <!--<a href="busca_registro.php?modulo=Ocorrencias_Impeditivas&tabela=Alunos&campo=Nome&height=520&width=560&keepThis=true&TB_iframe=true" title="Busca Registro" class="thickbox"><img src="../../images/icons/search.png" border="0"></a>-->
	    </span>
    </div>

    <br style="clear: left"/>

    <div class="base_99-height-150">

        <div class="base_22">
            <label>Opções para impressão </label>

        <span class="field">
            <div class="base-check-item">
                <input type="checkbox" class="checkbox" name="chSeq" id="chSeq" value="S" checked/> Imprimir último Sequencial
            </div>

            <div class="base-check-item">
                <input type="checkbox" class="checkbox" name="chPornome" id="chPornome" value="S" checked/> Ordenar por nome
            </div>

            <div class="base-check-item">
                <input type="checkbox" class="checkbox" name="chPagos" id="chPagos" value="S"/> Imprimir documentos pagos
            </div>
        </span>
        </div>

        <div class="base_30">
            <label>Vencimento (Data Inicial / DataFinal)</label>
        <span class="field">
            <? if (empty($class_DataInicial)) $class_Data = ''; else $class_Data = 'input_erro'; ?>
            <input name="DataInicialRelVencimento" type="text" onkeypress="Mascara(this,Data);" maxlength="10" class="data input_branco" id="DataInicial" value="<?= stripslashes($Data) ?>"  size="20" maxlength="20" onKeyUp="ContaCaracteresCampo('Data', 'DataT', 20);" />

            <? if (empty($class_DataFinal)) $class_Data = ''; else $class_Data = 'input_erro'; ?>
            <input name="DataFinalRelPagamento" type="text" onkeypress="Mascara(this,Data);" maxlength="10" class="data input_branco" id="DataFinal" value="<?= stripslashes($Data) ?>"  size="20" maxlength="20" onKeyUp="ContaCaracteresCampo('Data', 'DataT', 20);" />

        </span>
        </div>


        <div class="base_40">
            <label>Quantidade de documentos por página:  </label>

        <span class="field">
            <div class="base-check-item">
                <input type="radio" class="checkbox" name="QtdeBoletosPorPagina" value="1" checked=""/>  3 documentos (Dimensões: 297 mm x 210 mm)
            </div>
            <div class="base-check-item">
                <input type="radio" class="checkbox" name="QtdeBoletosPorPagina" value="0" />1 documento (Dimensões: 99 mm x 210 mm)
            </div>
        </span>

        </div>

        <div class="base_30">
            <label>Tipo Documento</label>
            <?
            $dados = array('primary_key' => 'idTipoDocumentoFin',
                'nome' => 'Descricao',
                'tabela' => 'TipoDocumentoFin',
                'condicao' => "where status = 'A'",
                'nome_input' => 'tipoDoc',
                'id' => 'tipoDoc',
                'class' => 'select',
                'value' => $tipoDoc);

            geraSelect($dados);
            ?>
        </div>


    </div>
</fieldset>


<button onClick="imprimirBoleto('form_boleto')" class="btn-salvar">Imprimir documentos</button>