<?
#############    datas   ################
function dataBrasileira() 
{ 
	// Gerando o array com nome dos dias da semana
	$diaSemana = array("Domingo", "Segunda-feira", "Terça-feira", "Quarta-feira", "Quinta-feira", "Sexta-feira", "Sábado"); 
	// Gerando array com o nome dos meses      
	$mes = array(1=>"janeiro", "fevereiro", "março", "abril", "maio", "junho", "julho", "agosto", "setembro", "outubro", "novembro", "dezembro"); 
	// Retorno da funão
	return $diaSemana[gmdate("w")] . ", " . gmdate("d") . " de " . $mes[gmdate("n")] . " de " . gmdate("Y"); 
} 
//Converte a data mySQL(yyyy-mm-dd h:m:s) para o padrão BR(dd-mm-yyyy)
function geradatabr($data) {
        $tirahora = substr($data,0,-9);
        list ($ano,$mes,$dia) = split ('[-]', $tirahora);
        $databr = "$dia-$mes-$ano";
    return $databr;
}
//Converte a data mySQL(yyyy-mm-dd) para o padrão BR(dd/mm/yyyy)
function geradatabr1($data) {
        list ($ano,$mes,$dia) = split ('[-]', $data);
        $databr = "$dia/$mes/$ano";
    return $databr;
}
//Converte a data mySQL(yyyy-mm-dd) para o padrão BR(mm-yyyy)
function geradatabr2($data) {
        list ($ano,$mes,$dia) = split ('[-]', $data);
        $databr = "$mes-$ano";
    return $databr;
}
//Converte a data mySQL(yyyy-mm-dd) para o padrão BR(dd-mm-yyyy)
function geradatabr3($data) {
        list ($ano,$mes,$dia) = split ('[-]', $data);
        $databr = "$dia-$mes-$ano";
    return $databr;
}
//Converte a data mySQL(yyyy-mm-dd) para o padrão BR(dd-mm)
function geradatabr4($data) {
        list ($ano,$mes,$dia) = split ('[-]', $data);
        $databr = "$dia-$mes";
    return $databr;
}
//Converte a data mySQL(yyyy-mm-dd h:m:s) para o padrão BR(dd-mm-yyyy  as h:m:s)
function geradatahorabr($data) {
        $hora = substr($data,11);
        list ($G,$m,$s) = split ('[:]', $data);
        $tirahora = substr($data,0,-9);
        list ($ano,$mes,$dia) = split ('[-]', $tirahora);
        $databr = "$dia-$mes-$ano"." às "."$hora";
    return $databr;
}
//Converte a data mySQL(yyyy-mm-dd h:m:s) para o padrão BR(dd-mm-yyyy h:m:s)
function geradatahorabr1($data) {
        $hora = substr($data,11);
        list ($G,$m,$s) = split ('[:]', $data);
        $tirahora = substr($data,0,-9);
        list ($ano,$mes,$dia) = split ('[-]', $tirahora);
        $databr = "$dia-$mes-$ano $hora";
    return $databr;
}
//Converte a data mySQL(yyyy-mm-dd h:m:s) para o padrão BR(dd-mm)
function geradatahorabr2($data) {
        $hora = substr($data,11);
        list ($G,$m,$s) = split ('[:]', $data);
        $tirahora = substr($data,0,-9);
        list ($ano,$mes,$dia) = split ('[-]', $tirahora);
        $databr = "$dia.$mes";
    return $databr;
}
//Converte a data BR(dd-mm-yyyy) para o padrão mySQL(yyyy-mm-dd).
function geradatamy($data) {
        list ($dia,$mes,$ano) = split ('[/]',$data);
        $datamy = "$ano-$mes-$dia";
    return $datamy;
}
//Converte a data BR(dd-mm-yyyy) para o padrão mySQL(yyyy-mm-dd 00:00:00).
function geradatamyc($data) {
    $hora = date ("G:i:s");
        list ($dia,$mes,$ano) = split ('[-]',$data);
        $datamy = "$ano-$mes-$dia"." ".$hora;
    return $datamy;
}
//Pega a hora em um campo datatime da base de dados ou variável e retorna h:m:s.
function pegahora($hora){
        $hora = substr($hora,11);
        list ($h,$m,$s) = split ('[:]', $hora);
        $hora = "$h".":"."$m".":"."$s";
    return $hora;
}
    function dataHora($tipo){
    
        $hora  = date("G:m");
        $dia = date("D");
        $diaN = date("d");
        $mes = date("n");
        $ano = date("Y");
        
        if(($hora >= 0) AND ($hora  < 6)){$Saudacao = "Boa Madrugada";}
	if(($hora >= 6) AND ($hora  < 12)){$Saudacao = "Bom Dia";}
        if(($hora >= 12) AND ($hora  < 18)){$Saudacao = "Boa Tarde";}
        if(($hora >= 18) AND ($hora  < 23)){$Saudacao = "Boa Noite";}
        
        $diaSemana = array();
        $diaSemana["Sun"] = "Domingo";
        $diaSemana["Mon"] = "Segunda";
        $diaSemana["Tue"] = "Terça";
        $diaSemana["Wed"] = "Quarta";
        $diaSemana["Thu"] = "Quinta";
        $diaSemana["Fri"] = "Sexta";
        $diaSemana["Sat"] = "Sábado";
        
        $mesAno = array();
        $mesAno[0] = "Janeiro";
        $mesAno[1] = "Fevereiro";
        $mesAno[2] = "Março";
        $mesAno[3] = "Abril";
        $mesAno[4] = "Maio";
        $mesAno[5] = "Junho";
        $mesAno[6] = "Julho";
        $mesAno[7] = "Agosto";
        $mesAno[8] = "Setembro";
        $mesAno[9] = "Outubro";
        $mesAno[10] = "Novembro";
        $mesAno[11] = "Dezembro";
    
        $mesAno2 = array();
        $mesAno2[0] = "Jan";
        $mesAno2[1] = "Fev";
        $mesAno2[2] = "Mar";
        $mesAno2[3] = "Abr";
        $mesAno2[4] = "Mai";
        $mesAno2[5] = "Jun";
        $mesAno2[6] = "Jul";
        $mesAno2[7] = "Ago";
        $mesAno2[8] = "Set";
        $mesAno2[9] = "Out";
        $mesAno2[10] = "Nov";
        $mesAno2[11] = "Dez";
        
        if ( !isset($tipo)){
            echo "Tipo de saída não setado!";
        } else {
            if ($tipo == 1){
                echo  $Saudacao."! ".$diaSemana[$dia].", ".$diaN." de ".$mesAno[$mes]." de ".$ano;
            } else if ($tipo == 2){
                echo  $diaN."/0".$mes."/".$ano;
            }else if ($tipo == 3){
                echo $Saudacao;
            }else if ($tipo == 4){
                echo $diaN." de ".$mesAno[$mes]." de ".$ano;
            }else if ($tipo == 5){
                echo $diaSemana[$dia].", ".$diaN.".".$mesAno2[$mes].".".$ano;
            }else if ($tipo > 5){
                echo "Tipo de saída inválido";
            }
        }
    }
###################################
?>