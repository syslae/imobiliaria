<?
   $ar_temp = $rs->GetRowAssoc(1);
   $ar = array();

   foreach($ar_temp as $key => $row){
        $ar[$key] = $key;
   }

    if(!empty($campos_filtro)){
        //variavel utilizada quando tem inner join na consulta da index
        $ar = array();
        $ar = $campos_filtro;
    }

?>
<form action="<? echo $GLOBALS["paginaAtual"]?>"  name="form" method="get">	
	<style>
		/*ESTILO PARA COLUNAS E COMPONENTES DA TABELA DE FILTRO - BY NATAN EM 23.06.2010*/
		table .tit{font:bold 12px arial;}
        table td .camp{border:1px solid #336699;}
        table td .opera{border:1px solid #336699; font:bold 12px arial;}
		table td .desc{border:1px solid #336699; font:bold 12px arial;}
        table td .bot{margin-left:105px; font:bold 12px arial; cursor:pointer;}	
    </style>	
    <table width="800" border="0" cellspacing="0" cellpadding="0" class="filtro">
        <tr>
            <!-- personalize com os campos que deseja-->
            <td class="tit" width="200" >Campo<br />
                  <select name="campo" id="campo" class="camp">
                     <? foreach($ar as $campo=>$value) :?> 
                           <? if($campo!="id" and $campo!="created" and $campo!="status") : ?> 
                            <option value="<?=$campo?>" 
                                <? if(trim($campo)==trim($campo_sel)) 
                                    echo"selected";?>><?=strtoupper($value)
                                ?>
                            </option> 
                            <? endif; ?>
                     <? endforeach; ?>
                  </select>
            </td>
            <td class="tit" width="200" >Operador<br />
                <select name="operador" id="campo" class="opera">					
                    <option value="qcon" <? if($operador=="qcon") echo"selected";?>>Que Contenha</option> 
                    <option value="qcom" <? if($operador=="qcom") echo"selected";?>>Que Comece</option>                     
                </select>
            </td>                  
            <td class="tit" width="120" >Descrição<br />
                <input name="nome" type="text" id="nome" value="<?=$nome?>" size="30" maxlength="30" class="desc">
            </td>              
            <td class="tit" valign="bottom">
                <input type="submit" name="Procurar" id="Procurar" value="Procurar" class="bot">
            </td>
        </tr>

        <? if($qtde_parcelamento){ ?>
        <tr>
            <td class="tit"> <br />
                Qtde por página <br />
                <select name="options" onchange="$('#form_pesquisa').submit();" class="camp">
                    <option data-value="" value="" > Padrão </option>

                    <?foreach($qtde_parcelamento as $qtde){?>

                    <option data-value="" value="<? echo $qtde['qtde_vezes'];?>" <?if($qtde['qtde_vezes'] == $options) echo "selected";?>><? echo $qtde['qtde_vezes'];?></option>

                    <? }?>

                </select>
            </td>
        </tr>

        <? } ?>
    </table>
</form>