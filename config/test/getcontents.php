<?php
		$ddf = fopen('180-index.html','w+');
		
		if (fwrite($ddf,file_get_contents("http://180graus.brasilportais.com.br/index.html")))
		{
			echo ':-)';
		}
?>