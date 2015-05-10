					  <table width="830" height="15" border="0" align="center" cellpadding="0" cellspacing="0" id="paginacao" style="margin:5px;">
                          <form name="form1" method="get" action="<? echo $_SERVER['PHP_SELF']?>">
                            <tr> 
                              <td width="276" align="center" class="text_bold_preto">Total: <? echo $tr?> - mostrando <? echo $linhas_pagina?> por p&aacute;gina </td>
							  <td width="399" align="center" class="text_titulo"> 
                                <? 
								/*if ($anterior!=0) echo "&nbsp;&nbsp;<a href='$PHP_SELF?n=".$primeira.$parametros."'><img src=\"../images/seta1-e.gif\" border=\"0\"></a>&nbsp;&nbsp;";	
								else echo "&nbsp;&nbsp;<img src=\"../images/seta1-e.gif\" border=\"0\">&nbsp;&nbsp;";
								
								if ($anterior!=0) echo "&nbsp;&nbsp;<a href='$PHP_SELF?n=".$anterior.$parametros."'><img src=\"../images/seta2-e.gif\" border=\"0\"></a>&nbsp;&nbsp;";	
								else echo "&nbsp;&nbsp;<img src=\"../images/seta2-e.gif\" border=\"0\">&nbsp;&nbsp;";

								if ($proxima!=$total_paginas+1) echo "&nbsp;&nbsp;<a href='$PHP_SELF?n=".$proxima.$parametros."'><img src=\"../images/seta2-d.gif\" border=\"0\"></a>&nbsp;&nbsp;";
									else echo "&nbsp;&nbsp;<img src=\"../images/seta2-d.gif\" border=\"0\">&nbsp;&nbsp;";
									
								if ($proxima!=$total_paginas+1) echo "&nbsp;&nbsp;<a href='$PHP_SELF?n=".$ultima.$parametros."'><img src=\"../images/seta1-d.gif\" border=\"0\"></a>&nbsp;&nbsp;";
									else echo "&nbsp;&nbsp;<img src=\"../images/seta1-d.gif\" border=\"0\">&nbsp;&nbsp;";
									*/
								?>
                                <table border="0" cellpadding="4" align="center">
                                  <tr>
                                    <?
                                    $lnk_impressos=0;
                                    $temp = $n_; // 
                                    $maxlnk = 11;			  // MÁXIMO DE LINKS POR PÁGINA
                                    if ($temp >= $maxlnk)
                                    {
                                        if ($total_paginas > $maxlnk) 
                                        {
                                            $n_maxlnk = $temp + 5;
                                            $maxlnk = $n_maxlnk;
                                            $n_start = $temp - 6;
                                            $lnk_impressos = $n_start;
                                        }
                                    }
                                    while(($lnk_impressos < $total_paginas) and ($lnk_impressos < $maxlnk))
                                    {
                                        $lnk_impressos ++;?>
                                        <td> 
                                        <? 
                                            if ($pg_atual != $lnk_impressos)
                                            {
                                                echo '<a href="'.$PHP_SELF.'?n='.$lnk_impressos.$parametros.'">';
                                            }
                                            if ($temp == $lnk_impressos)
                                            {
                                                echo '<b>['.$lnk_impressos.']</b>';
                                            } 
                                            else 
                                            {
                                                echo $lnk_impressos;
                                            }
                                            echo '</a>';
                                            ?>
                                        </td>
                                        <? 
                                    }
                                ?>
                                  </tr>
                                </table>
                              </td>
                              
                              <td width="155" align="left" class="text_bold_preto"> 
                                <? echo $n_?> /<? echo $total_paginas?> <input name="n" type="text" class="input_branco" size="2" maxlength="4"> 
                                <input name="p" type="hidden" class="input_branco" size="2" value="<? echo $p?>"> 
                              <input name="s" type="submit" class="botao_branco" value="Mostrar"></td>

                            </tr>
                          </form>
                        </table>
