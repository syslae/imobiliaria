
											<tr>
                                                <td height="24" align="right" class="text_bold_preto">Id</td>
                                                <td class="text_padrao">
													 <?=$id?>
                                                </td>
                                            </tr>
											<tr>
                                                <td height="24" align="right" class="text_bold_preto">Login</td>
                                                <td class="text_padrao">
													 <?=$login?>
                                                </td>
                                            </tr>
											<tr>
                                                <td height="24" align="right" class="text_bold_preto">Senha</td>
                                                <td class="text_padrao">
													 <?=$senha?>
                                                </td>
                                            </tr>
											<tr>
                                                <td height="24" align="right" class="text_bold_preto">Nome</td>
                                                <td class="text_padrao">
													 <?=$nome?>
                                                </td>
                                            </tr>
											<tr>
                                                <td height="24" align="right" class="text_bold_preto">Email</td>
                                                <td class="text_padrao">
													 <?=$email?>
                                                </td>
                                            </tr>
											<tr>
                                                <td height="24" align="right" class="text_bold_preto">Msn</td>
                                                <td class="text_padrao">
													 <?=$msn?>
                                                </td>
                                            </tr>
											<tr>
                                                <td height="24" align="right" class="text_bold_preto">Orkut</td>
                                                <td class="text_padrao">
													 <?=$orkut?>
                                                </td>
                                            </tr>
											<tr>
                                                <td height="24" align="right" class="text_bold_preto">Fone</td>
                                                <td class="text_padrao">
													 <?=$fone?>
                                                </td>
                                            </tr>
											<tr>
                                                <td height="24" align="right" class="text_bold_preto">Celular</td>
                                                <td class="text_padrao">
													 <?=$celular?>
                                                </td>
                                            </tr>
											<tr>
                                                <td height="24" align="right" class="text_bold_preto">Foto</td>
                                                <td class="text_padrao">
                                                    <?
													if (empty($foto))
														echo "- - - -";
													else
														echo '<a href="'.URL.'/webroot/img/'.$tabela.'/'.$foto.'" rel="lightbox"><img src="'.URL.'/webroot/img/'.$tabela.'/'.$foto.'" height=70 border=0></a>';
													?>
                                                </td>
                                            </tr>
											<tr>
                                                <td height="24" align="right" class="text_bold_preto">Ultimoacesso</td>
                                                <td class="text_padrao">
													<?
													if(!empty($ultimoacesso) and $ultimoacesso<>"    -  -     :  :  " and $ultimoacesso<>NULL)
													{
														$data = new data();
														echo $data->convertDataISOBR($ultimoacesso);
													}
													?>
                                                </td>
                                            </tr>
											<tr>
                                                <td height="24" align="right" class="text_bold_preto">Acessos</td>
                                                <td class="text_padrao">
													 <?=$acessos?>
                                                </td>
                                            </tr>
											<tr>
                                                <td height="24" align="right" class="text_bold_preto">Created</td>
                                                <td class="text_padrao">
													<?
													if(!empty($created) and $created<>"    -  -     :  :  " and $created<>NULL)
													{
														$data = new data();
														echo $data->convertDataISOBR($created);
													}
													?>
                                                </td>
                                            </tr>
											<tr>
                                                <td height="24" align="right" class="text_bold_preto">Modified</td>
                                                <td class="text_padrao">
													<?
													if(!empty($modified) and $modified<>"    -  -     :  :  " and $modified<>NULL)
													{
														$data = new data();
														echo $data->convertDataISOBR($modified);
													}
													?>
                                                </td>
                                            </tr>
											<tr>
                                                <td height="24" align="right" class="text_bold_preto">Status</td>
                                                <td class="text_padrao">
                                                    <? if($status==1) echo "Ativo"; else echo "N&atilde;o ativo";?>
                                                </td>
                                            </tr>