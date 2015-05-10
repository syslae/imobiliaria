<?
// vamos incluir o inicio.php
include "includes/inicio.php";
?>
Exemplo de Link:
<p><a href="<? echo Link::criaLink('') ?>">Página inicial</a></p>
<p><a href="<? echo Link::criaLink('usuarios.php', 'id=10') ?>">Exemplo 1</a></p>
<p><a href="<? echo Link::criaLink('principal.php') ?>">Exemplo 2</a></p>
<p><a href="<? echo Link::criaLink('brasilportais2/fw/noticia.php', 'id=10&tipo=ultima&skin=azul') ?>">Exemplo 3</a></p>

<p>
<? if (p('ß')){ ?>
Parabéns, a página <? echo p('ß') ?> foi passada
<? }else{ ?>
Nenhuma página passada, ou alguem tentou mudar a URL, entao essa é a pagina incial
<? } ?>
</p>


Resultados:
<p><strong>Página:</strong><br />
<? echo p('ß') ?></p>
<p><strong>Parametros:</strong></br >
<? var_dump($_PAR) ?></p>
