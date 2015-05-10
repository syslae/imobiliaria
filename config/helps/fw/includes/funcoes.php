<?
// Essa função irá retornar valores de $_POST['var'] ou $_PAR['$var']
function p($v){
	global $_POST, $_PAR;
	return isset($_POST[$v]) ? $_POST[$v] : (isset($_PAR[$v]) ? $_PAR[$v] : '');
}
?>
