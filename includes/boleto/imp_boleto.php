<?php 

  require_once("../verifica_logado.php");
  $mat = $_SESSION["mat"];
  
  include '../../conexao.inc';
  $SQL = "select a.nome, (select descricao from Cursos where idCurso = a.idCurso), a.blocoatual from alunos as a where matricula = '".$mat."'";
  $res = mssql_query($SQL, $conexao); 
  $linha = mssql_fetch_row($res);  
  $nome = $linha[0];
  $curso = $linha[1];
  $bloco = $linha[2];  

?> 

<script language="JavaScript" type="text/JavaScript">
<!--

function janela()
 {
   parc = document.form.parcela.value;
   window.open('boleto.php?parc='+parc,'Janela', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, width=710, height=580')
 }
 
//-->
</script>

<html>
<head>
<title>Sistema NOVAFAPI: Reserva de Equipamento</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<META content="MSHTML 6.00.2900.2604" name=GENERATOR>
<style type="text/css">
<!--
@import url(../../estilos/TEST.css);
-->
</style>
<style type="text/css">
<!--
@import url(../../estilos/catalogo.css);
.style6 {font-family: Tahoma, Verdana, Arial}
-->
</style>
</HEAD>
<BODY bgColor=#dddddd text=#000000 link=#75a60e vLink=#75a60e aLink=#75a60e 
leftMargin=0 topMargin=0 marginwidth="0" marginheight="20" 
onunload="">
<form name="form" method="post" action="">
<TBODY>
  <TR>
      <TD noWrap bgColor=#ffffff><A 
      href="#"></A></TD>
       
    <TD vAlign=top align=right bgColor=#ffffff>
	
	</TD>
  </TR>
  <TR>
    
  <TD colSpan=2>&nbsp;</TD>
</TR>
  <TR></TR></TBODY><DIV style="LEFT: 0px; POSITION: relative; TOP: -5px; HEIGHT: 25px" 
align=center>
<TABLE cellSpacing=0 cellPadding=0 width=755 align=center border=0>
  <TBODY>
    <TR> 
      <TD width="1"><IMG height=1 src="../../imagens/img_default/clear_dot.gif" 
width=1></TD>
      <TD bgColor=#ffffff><IMG height=15 
      src="../../imagens/img_default/mitte_oben.gif" width=100%><IMG height=1 src="../../imagens/img_default/clear_dot.gif" 
width=1></TD>
    </TR>
    <TR> 
      <TD>&nbsp;</TD>
      <TD vAlign=top bgColor=#ffffff> 
        <div align="right"> 
          <table width="100%" border="0" cellspacing="5">
            <tr> 
              <td colspan="3" class="texto_pagina"> <div align="center" class="texto_pagina"><img src="../imagens/img_alunoOnline.jpg" width="342" height="58"></div></td>
            </tr>
            <tr> 
              <td colspan="3" class="texto_pagina"> <div align="center"> 
                  <table width="452" border="0" cellspacing="0">
                    <tr> 
                      <td colspan="3" class="texto_pagina">&nbsp;</td>
                    </tr>
                    <tr> 
                      <td colspan="3" class="texto_pagina"><div align="center"><font size="4"><strong>IMPRESS&Atilde;O 
                          DE BOLETO BANC&Aacute;RIO</strong></font></div></td>
                    </tr>
                    <tr> 
                      <td height="37" colspan="3" class="texto_pagina"> <div align="left"></div></td>
                    </tr>
                    <tr> 
                      <td width="84" class="texto_pagina"><div align="left"><strong>Matr&iacute;cula:</strong></div></td>
                      <td colspan="2" class="texto_pagina">&nbsp; 
                        <?= $mat?>
                      </td>
                    </tr>
                    <tr> 
                      <td class="texto_pagina"><strong>Nome:</strong></td>
                      <td colspan="2" class="texto_pagina">&nbsp; 
                        <?= $nome?>
                      </td>
                    </tr>
                    <tr> 
                      <td class="texto_pagina"><strong>Curso:</strong></td>
                      <td colspan="2" class="texto_pagina">&nbsp; 
                        <?= $curso?>
                      </td>
                    </tr>
                    <tr> 
                      <td class="texto_pagina"><strong>Bloco:&nbsp;</strong></td>
                      <td colspan="2" class="texto_pagina">&nbsp; 
                        <?= $bloco?>
                      </td>
                    </tr>
                    <tr> 
                      <td class="texto_pagina"><strong>Parcela:</strong> </td>
                      <td width="56" class="texto_pagina"> <div align="left">&nbsp; 
                          <select name="parcela" size="1">
                            <?
	                         $SQL = "select parcela from mensalidades where idSituacao = '02' and matricula = '".$mat."'";
                             $res = mssql_query($SQL, $conexao);
                             while ($linha = mssql_fetch_row($res))
                                echo "<option value=$linha[0]>$linha[0]</option>"; 
	                      ?>
                          </select>
                        </div></td>
                      
                  <td width="306" class="texto_pagina"><font size="1">Escolha 
                    a parcela do boleto a qual deseja imprimir.</font></td>
                    </tr>
                  </table>
                </div></td>
            </tr>
            <tr> 
              <td colspan="3" class="texto_pagina">&nbsp;</td>
            </tr>
            <tr> 
              <td width="34%" class="texto_pagina"><div align="center"></div></td>
              
          <td width="27%" class="texto_pagina"><div align="center"> <div align="center">
              <input type="submit" name="Submit" value="Gerar Boleto" onClick = "janela()">
            </div></form>
                </td>
<td class="texto_pagina">&nbsp;</td>
            </tr>
            <tr> 
              <td colspan="3" class="texto_pagina">&nbsp;</td>
            </tr>
            <tr> 
              <td colspan="3" class="texto_pagina"><div align="center"> </div></td>
            </tr>
            <tr> 
              <td colspan="3" class="texto_pagina">&nbsp;</td>
            </tr>
            <tr> 
              <td colspan="3" class="texto_pagina"> <div align="right"></div>
                <div align="right"></div></td>
            </tr>
            <tr> 
              
  <td colspan="2" class="texto_pagina"> <a href="../aluno_online.php"><img src="../../img_editaveis/bot%E3o_voltar.gif" width="80" height="20" border="0"></a></td>
              <td width="39%" class="texto_pagina"><div align="right"> <a href="../fecha_sessao.php"> 
                  <img src="../../img_editaveis/bot%E3o_finalizar.gif" width="80" height="20" border="0"> 
                  </a></div></td>
            </tr></Td>
</TR> 
<TR> 
      <TD><IMG height=1 src="../../imagens/img_default/clear_dot.gif" 
width=1></TD>
      <TD><IMG height=15 
      src="../../imagens/img_default/mitte_unten.gif" width=100%><IMG height=1 src="../../imagens/img_default/clear_dot.gif" 
width=1></TD>
    </TR>
    <TR> 
      <TD height="6" colSpan=2>&nbsp;</TD>
    </TR></TBODY>
</BODY>
</html>
<?
 //$_SESSION["parcela"] = $_POST["parcela"];
?>

