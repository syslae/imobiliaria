<?
session_start();
set_time_limit(10000);
ini_set('memory_limit', '512M');

require("../../config/define.php");
require(DOMAIN_PATH."config/fpdf/fpdf.php");
//require(DOMAIN_PATH."config/phplot/phplot.php");
require(DOMAIN_PATH."config/conexaoAr.php");
require(DOMAIN_PATH."funcoes.inc.php");
require(DOMAIN_PATH."funcoesValidar.inc.php");
require(DOMAIN_PATH."funcoesFinanceiro.inc.php");



$tabela= "ocorrencia_retorno";
$tituloRel = $modulo = "Retorno Bancário";
$tabela_id = 61;
$idBanco = $_POST['idBanco'];
$Layout = trim($_POST['Layout']);
$Filtro = trim($_POST['Filtro']);
$Ano = trim($_POST['ano']);
//$DB->debug = 1;
$relatorio_por_situacao = $_POST['relatorio_por_situacao'];

if($relatorio_por_situacao){
    $SituacaoM = count($_POST['situacao_boleto']) > 0 ? $_POST['situacao_boleto'] : array(-1);

    $dados1 = $DB->Execute("select Sigla,TamanhoLinha from BancosBoletos where idBanco = '".trim($Layout)."'");
    $idBanco = $Layout;

    $sigla = trim($dados1->fields['Sigla']);
    $tamanho = trim($dados1->fields['TamanhoLinha']);

    switch($sigla){
        case 'BB':
            $Layout = "BANCO DO BRASIL - ".$tamanho;
            break;
        case 'CS':
        case 'CR':
            $Layout = "CAIXA ECONÔMICA SICOB - ".$tamanho;
            break;
        case 'SR':
            $Layout = "CAIXA ECONÔMICA SIGCB - ".$tamanho;
            break;
        case 'RS':
        case 'RC':
            $Layout = "BANCO REAL - ".$tamanho;
            break;
        case 'BN':
            $Layout = "BANCO DO NORDESTE - ".$tamanho;
            break;
        case 'BS':
            $Layout = "BANCO SANTANDER - ".$tamanho;
            break;
        case 'BR':
            $Layout = "BANCO BRADESCO SEM REGISTRO - ".$tamanho;
            break;
        case 'IT':
            $Layout = "BANCO ITAU - ".$tamanho;
            break;
        case 'HS':
            $Layout = "BANCO HSBC - ".$tamanho;
            break;
        case 'BI':
            $Layout = "BIC - BANCO - ".$tamanho;
            break;

    }
}else{

    if(!empty($_SESSION['c']) and empty($_POST['c'])){
        $_POST['c'] = $_SESSION['c'];
        if(empty($_SESSION['ano_retorno'])){

            $retorno_c = explode("a",$_POST['c']);

            $rs_ano = $DB->Execute("select max(year(data_ret)) as ano from ocorrencia_retorno where num_retorno = '".$retorno_c[0]."'")->fields["ano"];
            $_SESSION['ano_retorno'] = (!$rs_ano) ? date('Y') : $rs_ano;
        } //valor padrão para consulta do ano , caso nao venha no arquivo retorno
    }
    if(!empty($_SESSION['DescLayout']) and empty($_POST['Layout'])) $Layout = $_SESSION['DescLayout'];
    if(!empty($_SESSION['idBanco_retorno']) and empty($_POST['idBanco'])) $idBanco = $_POST['idBanco'] = $_SESSION['idBanco_retorno'];
    if(!empty($_SESSION['ano_retorno']) and empty($_POST['ano'])) $Ano = $_POST['ano'] = $_SESSION['ano_retorno'];


}
$Ano = str_replace("-","",$Ano);

if(!empty($Filtro)) $Filtros .= ' #Filtro ='.$Filtro;
else $Filtros .= ' #Filtro = TODOS';

if(!empty($Ano)) $Filtros .= '#Ano ='.$Ano;
else $Filtros .= ' #Ano = TODOS';

if(!empty($Layout)) $Filtros .= ' #Layout ='.$Layout;

//## INCLUDE DOS MODELS #
include (DOMAIN_PATH.'core/model/espelho_retorno.Model.php');


//## INCLUDE DOS CONTROLLERS #
include (DOMAIN_PATH.'core/controller/espelho_retorno.Controller.php');
$relatorioObj = $relatorio;


if (! isset ($_POST['c']) and !$_POST['relatorio_por_situacao'])
{
	echo "<html>
            <script>

                alert('Você deve selecionar algum registro!');
                window.close();

            </script>
            </html>    
            ";
        
        die;

}
else
{

	// INICIO CABECALHO
	$cabecalho = 'RETORNO BANCÁRIO - ';
	if(($Layout == 'BANCO DO BRASIL - 240')or($Layout == 'BANCO DO BRASIL - 400'))
	$cabecalho .= 'BANCO DO BRASIL';
	else
	$cabecalho .= $Layout;

	//este arquivo foi feito recebendo o $_POST['c'] como string mas o arquivo recebe
	//por get as vezes a string, as vezes array. aki é o tratamento do array.
	$caminho_voltar = ''.URL.'/modulos/ocorrencia_retorno/cadastrar.php';

	if(is_array($_POST['c']))
	{
		$_POST['c'] = implode("a",$_POST['c']);
		$_POST['c'] .= 'a';

		$caminho_voltar = 'javascript:history.go(-1)';

	}

	//cabeçalho default    
    include(DOMAIN_PATH."modulos/rel_modelos/topo_rodape.php");
	$modulo = "Financeiro";
	$relatorio = $Layout;

	$pdf = new PDF();
	$pdf->Open();
	$pdf->AddPage('L','A4');
	$pdf->AliasNbPages();

	include("relatorio.php");
}
?>