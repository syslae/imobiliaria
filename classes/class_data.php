<?php

class Data
{
    protected $data;
              
    function __construct()
    {
	$this->data = getdate();

    if($this->data[mon]<10)
      $this->data[mon] = "0".$this->data[mon];
    if($this->data[mday]<10)
      $this->data[mday] = "0".$this->data[mday];
    }
    
  public function dataISO()
  {
    $hoje = $this->data[year]."-".$this->data[mon]."-".$this->data[mday];
    return $hoje;
  }
  
  public function dataBR()
  {
    $hoje     = $this->data[mday]."/".$this->data[mon]."/".$this->data[year];
    return $hoje;
  }
  
  public function convertDataBRISO($data)
  {
  $explodida =  explode("/",$data);
    $dataIso = $explodida[2]."-".$explodida[1]."-".$explodida[0];
     return $dataIso;
  }
  
  public function convertDataISOBR($data)
  {
	$data = (string)$data;
	
	$explodida =  explode(" ",$data);
	$data = $explodida[0];
	$hora = $explodida[1];
	
	$explodida =  explode("-",$data);
	$dataIso = $explodida[2]."-".$explodida[1]."-".$explodida[0].' '.$hora;
	return $dataIso;
	exit;
 }

  public function diferencaDias($dataInicial, $dataFinal)
  {
    list($dia_inicial, $mes_inicial, $ano_inicial) = explode("/", $dataInicial);
    list($dia_final, $mes_final, $ano_final) = explode("/", $dataFinal);

    $inicial = mktime(0,0,0,$mes_inicial,$dia_inicial,$ano_inicial);
    $final = mktime(0,0,0,$mes_final,$dia_final,$ano_final);

    $dias = ($final - $inicial)/86400;

    return $dias;
  }
  
  public function somarDias($data,$dias)
  {
  $data = explode("/",$data);
  $dia = (int)$data[0];
  $mes = (int)$data[1];
  $ano = (int)$data[2];
$data = date ("d-m-Y",mktime (0,0,0,$mes,$dia+$dias,$ano)); 
return $data;
  }
  
public function diminuirDias($data,$dias)
  {
  $data = explode("/",$data);
  $dia = (int)$data[0];
  $mes = (int)$data[1];
  $ano = (int)$data[2];
$data = date("d-m-Y",mktime (0,0,0,$mes,$dia-$dias,$ano)); 
return $data;
  }
  
  public function diaExtenso($dia)
  {
  $resultado = "Dia inválido!";
  $dias  = array( 'Domingo', 
  'Segunda-Feira', 
  'Terça-Feira', 
  'Quarta-Feira', 
  'Quinta-Feira', 
  'Sexta-Feira', 
  'Sábado');
  if(($dia >= 0)&&
     ($dia < 6))
  $resultado = $dias[$dia];
  
  return $resultado;
  }
  
  public function mesExtenso($mes)
  {
  $resultado = "Mes inválido";
  $meses = array("Janeiro",
     "Fevereiro",
     "Março",
     "Abril",
     "Maio",
     "Junho",
     "Julho",
     "Agosto",
     "Setembro",
     "Outubro",
     "Novembro",
     "Dezembro");
  if(($mes >= 0)&&
     ($mes < 11))
  $resultado = $meses[$mes];
  
  return $resultado;
  }
  
public function dataExtenso()
  {
  $oTexto    = new Texto();
  
  $dia       = $oTexto->poeZeros($this->hoje[mday],2,"E");
  $diaSemana = $this->diaExtenso($this->hoje[wday]);
  $mes       = $this->mesExtenso($this->hoje[mon]);
  $ano       = $hoje[year];
  
  $dataExtenso = $diaSemana.", ".$dia." de ".$mes." de ".$ano;
  
  unset($oTexto);
  
  return $dataExtenso;
  }
}
?>