<?php
	if(!isset($chave))
	$chave = 'id';
    //Alterada por charles
    //if (empty($campos)) $campos = "*";

	$sql2 = "select $campos from $tabela $criterio"; 
	$result = $DB->Execute($sql2);

     $tr = $result->RecordCount();

	$total_paginas = ceil($tr / $linhas_pagina);

	$n_ = (int) $_GET["n"];
	if (!empty($n_) and (is_int($n_)) and $n_>0 and ($n_<=$total_paginas))
	{
	   $anterior = $n_-1;
       $primeira = 1;
	
	}
	else 
	{
		$i=0;
		$n_=1;
	}
	
	$i = ($n_*$linhas_pagina)-$linhas_pagina;
	if ($n_>1) 
	{	
		$anterior = $n_-1;
		$primeira = 1;
	}
	else 
	{	
		$anterior = 0;
		$primeira = 0;
	}
	
	if ($n_<($total_paginas))
	{
		$proxima = $n_+1;
		$ultima = $total_paginas;
	}
	else 
	{
		$proxima = $total_paginas+1;
		$ultima = 0;
	}
	//$DB->debug = true;
 	$sql = "SELECT $campos from $tabela $criterio $criterio3";
	$rs = $DB->SelectLimit($sql,$linhas_pagina,$i); //seleciona 10 linhas iniciando na linha 100
?>