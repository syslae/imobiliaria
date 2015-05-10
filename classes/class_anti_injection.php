<?
class AntiInjection 
{
	var $sql;
	var $querystring;
	var $variavel;
	var $vazio;
	
	function anti_injection($sql)
	{
		// remove palavras que contenham sintaxe sql
		$sql = preg_replace(sql_regcase("/(from|select|insert|delete|where|drop table|show tables|#|\*|--|\\\\)/"),"",$sql);
		$sql = trim($sql);//limpa espaços vazio
		$sql = strip_tags($sql);//tira tags html e php
		$sql = addslashes($sql);//Adiciona barras invertidas a uma string
	
		return $sql;
	}

	function anti_inject($sql)
	{
		// remove palavras que contenham sintaxe sql
		$sql = preg_replace(sql_regcase("/(from|select|insert|delete|where|drop table|show tables|#|\*|--|\\\\)/"),"",$sql);
		$sql = strip_tags($sql);//tira tags html e php
		$sql = addslashes($sql);//Adiciona barras invertidas a uma string
	
		return $sql;
	}
	function get($querystring)
	{
		if(!empty($_GET[$querystring]))
		{
			$querystring = $_GET[$querystring];
			// remove palavras que contenham sintaxe sql
			$querystring = preg_replace(sql_regcase("/(from|select|insert|delete|where|drop table|show tables|#|\*|--|\\\\)/"),"",$querystring);
			$querystring = trim($querystring);//limpa espaços vazio
			$querystring = strip_tags($querystring);//tira tags html e php
			$querystring = addslashes($querystring);//Adiciona barras invertidas a uma string
	
			return $querystring;
		}
	}
	
	function post($querystring)
	{
		if(!empty($_POST[$querystring]))
		{
			$querystring = $_POST[$querystring];
			// remove palavras que contenham sintaxe sql
			$querystring = preg_replace(sql_regcase("/(from|select|insert|delete|where|drop table|show tables|#|\*|--|\\\\)/"),"",$querystring);
			$querystring = trim($querystring);//limpa espaços vazio
			$querystring = strip_tags($querystring);//tira tags html e php
			$querystring = addslashes($querystring);//Adiciona barras invertidas a uma string
	
			return $querystring;
		}
	}
	
}
?>