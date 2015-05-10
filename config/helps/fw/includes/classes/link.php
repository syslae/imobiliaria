<?
// incluimos a classe de criptografia
require_once "crypt.php";

// Variavel global similar a $_POST, porém sua função é
// armazenar os valores passados pela querystring do framewok.
$_PAR = array();

class Link {
     // Variável que armazena a chave do checksum
     static $chave = "chavedockecksum";

     // Variável que armazena o link
     var $link = '';

     // construtor, os parametros são simples
     // página = arquovo php a ser chamado
     // parâmetros: parâmetros da chamada ex: "id=10&tipo=noticia"
     function Link($pagina='', $parametros=''){
          // chama o método responsável pela criação do link
          // repassando os parâmetros
          $this->link = $this->criaLink($pagina, $parametros);

          // retorna o link encriptado
          return $this->link;
     }

     static function criaLink($pagina='', $parametros=''){
          // transforma os parametros em um array associativo
          parse_str($parametros, $p);

          // adiciono nesse array na posicao "ß" o arquivo php
          // Usei o "ß" por ser um parametro que nunca irá se repetir
          $p["ß"] = $pagina;

          // Aqui eu adiciono uma chave calculada a partir do que tem no array $p
          // porém adiciono somente os 5 primeiros caracteres para encurtar a chave
          // esse será o parametro responsável por garantir a integridade
          // da informação passada
          $p["γ"] = substr(crypt(json_encode($p), Link::$chave), 0, 5);

         // retornamos a URL encriptando a versão codificada em json dela.
         // rootvirtual é a constante que diz qual o root do site,
         // explicarei mais abaixo de onde ela vem
         return rootvirtual . "?" . Crypt::Encrypt(json_encode($p));
     }

     static function trataQuery(){
          // verifica a existencia de query-string e adiciona ela na variavel $q
          if ($q = $_SERVER['QUERY_STRING']){
               // decodifica a string
               $p = json_decode(Crypt::Decrypt($q), true);
                    // se o retorno for um array, quer dizer que a query é parcialmente válida
                    if (is_array($p) && isset($p["γ"])){
                        // carrega a chave do vetor
                        $chave = $p["γ"];
                        // remove a chave do vetor
                        unset($p["γ"]);
                        // recalcula a chave e verifica se é diferente a chave passada
                        if (substr(crypt(json_encode($p), Link::$chave), 0, 5) != $chave)
                             // Se for, a requisição eh redirecionada para o index.
                             header ("Location: " . rootvirtual);
                        else{
                             // se for válida é criada a varivel global _PAR e o vetor
                             // de parametros é jogado nela
                             $GLOBALS["_PAR"] = $p;
                             // sai da função
                             return true;
                        }
               }else {
                     // se não for um vetor, houve modificação da url, e a requisição
                     // é enviada para o index
                     header ("Location: " . rootvirtual);
               }
               // termina a execução e redireciona
               die();
          }
     }
}
?>
