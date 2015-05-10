<?php
 $_SESSION["Tabela"]   = $tabela;
 verificaAcesso($tabela_id); 
?>

 <table width="830" border="0" cellspacing="0" cellpadding="0" class="bordaPesquisa" style="margin:5px" >
  <?  
   
   
   
   if($_REQUEST['tela'] == 0)
   { ?>
    
    <tr>
        <td width="37">
          <img src="<?=URL.'/webroot/img_sistema/'?>quadro.jpg" id="esquerda"/>        </td>
        <td width="719">
           
          <h1><a href="index.php"  style="font-size:16px"><?=$modulo?></a></h1>
            
      	</td>
        
        
         <td width="74" align="left">
        <?
		if($_SESSION["permissao_temp"]>1)
		{
    		if($modulo != "Manutenção Faturamento"  and $modulo != "Estorno" and $modulo != "Manutenção Caixa")
            {
              ?>
            
            <a href="cadastrar.php" id="barra_direito">
              <img src="<?=URL.'/webroot/img_sistema/'?>Add.png" border="0"/><br />
                NOVO
            </a> 
            </td>
          <?}

          // if($modulo == "Cliente" or $modulo == "Produto")
          if($modulo == "Cliente")
        {?>

            <td>

            <a href="importar.php" id="barra_direito">
              <img src="<?=URL.'/webroot/img_sistema/'?>import.png" border="0"/><br />
                IMPORTAR
            </a> 
        <?  } 
		}
		?>
      </td>
    </tr>
<?	} else{?>
	<tr>
        <td width="37">
          <img src="<?=URL.'/webroot/img_sistema/'?>seta_redonda.png" id="esquerda"/>        </td>
        <td width="719">
           
          <h1><a href=""  style="font-size:16px"><?=$modulo?></a></h1>
            
      	</td>
        
         <td width="74" align="left">
    	</td>
   </tr><? }?>
</table>


