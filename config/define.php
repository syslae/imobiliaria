<?
//	define("DOMAIN_PATH",$_SERVER["DOCUMENT_ROOT"]."/os2/");
//	define("APP","app");
//	define("URL","http://medleyacademia.tempsite.ws/os2");
	


    define("DOMAIN_PATH",$_SERVER["DOCUMENT_ROOT"]."/");
	define("APP","app");
	define("URL","http://".$_SERVER['HTTP_HOST']."");
	
	########################################################################################################
	define("CACHE_APP",DOMAIN_PATH."config/cache/app");
	########################################################################################################
	
	
	########################################################################################################
	define("CACHE_ADMIN",DOMAIN_PATH."config/cache/admin");
	########################################################################################################

	$mystring = $_SERVER['HTTP_HOST'];
    	$findme   = 'localhost';
    	$pos = strpos($mystring, $findme);

    	// Note o uso de ===.  Simples == nуo funcionaria como esperado
    	// por causa da posiчуo de 'a' щ 0 (primeiro) caractere.
    	if ($pos === false) {
        	error_reporting(0);
    	} else {
        ini_set('display_errors', 1);
        ini_set('log_errors', 1);
        error_reporting(E_ALL & ~E_NOTICE);
    }

?>