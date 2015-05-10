<? 	session_start();
	require("../config/define.php");
	require(DOMAIN_PATH."funcoes.inc.php");
    header("Content-type: text/html; charset=ISO-8859-1");
	$ValorSomado   = $_REQUEST["valor_somado"];
    $ValorDesconto = $_REQUEST["valor_desconto"];
    $ValorTotal    = $_REQUEST["Valor_Total"];
    $TipoDesconto  = $_REQUEST["TipoDesconto"];
    if($TipoDesconto == 1)
    {
        $TotalValorDesconto = $ValorTotal - $ValorDesconto; 
        if($TotalValorDesconto > $ValorTotal)
        {
         $id = " <tr>
                    <td>
                        <h1><font color='#FF0000'>O valor somado é superior ao valor estimado!!</font></h1> <input type='hidden' name='valor_somado' value=".$TotalValorDesconto." id='valor_somado' />
                     </td>
                </tr>";
        }
        else
        {
            $id = " 
                    <tr>
                        <td><h1>Desconto:<font color='#FF0000'>".moeda($ValorDesconto)."</font></h1> 
                           <input type='hidden' name='valor_total_desconto' value=".$ValorDesconto." id='valor_total_desconto' />
                       </td>
                    </tr>
                     <tr>
                        <td>
                            <h1>Sub Total:<font color='#FF0000'>".moeda($TotalValorDesconto)."</font></h1> 
                            <input type='hidden' name='valor_somado' value=".$TotalValorDesconto." />
                         </td>
                    </tr>
                    <tr>
                        <td>
                            <h1>Valor Pago:<font color='#FF0000'>".moeda($ValorSomado)."</font></h1> 
                            <input type='hidden' name='valor_somado' value=".$ValorSomado." id='valor_somado' />
                         </td>
                    </tr>"; 
        }
    
   }
   else if($TipoDesconto == 2)
   {
        $percentual = $ValorDesconto / 100.0; //
        $TotalValorDesconto = $ValorTotal - ($percentual * $ValorTotal);
        if($TotalValorDesconto > $ValorTotal)
        {
         $id = " <tr>
                    <td>
                        <h1><font color='#FF0000'>O valor somado é superior ao valor estimado!!</font></h1> <input type='hidden' name='valor_somado' value=".$TotalValorDesconto." id='valor_somado' />
                     </td>
                </tr>";
        }
        else
        {
            $id = "<tr>
                        <td><h1>Desconto:<font color='#FF0000'>".$ValorDesconto."%</font></h1> 
                           <input type='hidden' name='valor_total_desconto' value=".$percentual * $ValorTotal." id='valor_total_desconto' />
                       </td>
                    </tr>
                    <tr>
                        <td>
                            <h1>Sub Total:<font color='#FF0000'>".moeda($TotalValorDesconto)."</font></h1> 
                            <input type='hidden' name='valor_somado' value=".$TotalValorDesconto." id='ValorTotal' />
                         </td>
                    </tr>
                    <tr>
                        <td>
                            <h1>Valor Pago:<font color='#FF0000'>".moeda($ValorSomado)."</font></h1> 
                            <input type='hidden' name='valor_somado' value=".$ValorSomado." id='valor_somado' />
                         </td>
                    </tr>"; 
        }
  
    
   }
    echo $id; 
 
 ?>
