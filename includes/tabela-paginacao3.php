					<table width="400" border="0" cellpadding="4" align="center">
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