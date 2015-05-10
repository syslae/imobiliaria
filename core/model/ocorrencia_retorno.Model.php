<? 
$Layout = trim($_POST['Layout']);
$Margem = (float) $_POST['Margem'];
$FormaBanco = trim($_POST['FormaBanco']);
$baixarCancelado = trim($_POST['baixarCancelado']);
$tipoRetorno = trim($_POST['tipoRetorno']);
$NumRetorno = trim($_POST['NumRetorno']);
$c =  trim($_POST['c']);
$lerQtdeLinhas = 40;

$situacao_pago = $DB->Execute("select id from situacao_pagamento where descricao like '%pago%' and status = 1")->fields["id"];
$usuario_id = $_SESSION['idusuario_g'];

if(!empty($_POST['valorMaior'])) $BaixaValorMaior =  $_POST['valorMaior']; else  $BaixaValorMaior = 'N';
if(!empty($_POST['naoBaixarBoleto'])) $NaoBaixar = $_POST['naoBaixarBoleto']; else $NaoBaixar = 'N';
$erro .= "";
$er = array();
//vindo apartir da segunda vez, direto do form do retorno_real.php
$cont = $_POST['cont']; //cont com posição lida antes, para continuar de onde parou
$i = $cont_arq = $_POST['cont_arq'];
$Sigla = trim($_POST['Sigla']);
$Tamanho = trim($_POST['Tamanho']);
$idCaixaRetorno = trim($_POST['idCaixaRetorno']);
$idAberturaCaixaRetorno = trim($_POST['idAberturaCaixaRetorno']);
$id_FormaPagamento = trim($_POST['id_FormaPagamento']);
$DescLocalPagamento = trim($_POST['DescLocalPagamento']);
$LocalPagamento = trim($_POST['LocalPagamento']);
$SituacaoPago = trim($_POST['SituacaoPago']);
$Radical = trim($_POST['Radical']);
$MatriculaBanco = trim($_POST['MatriculaBanco']);
$Agencia = trim($_POST['Agencia']);
$DataGerRetorno = $_SESSION['DataGerRetorno_'.$sistema];

$DataMovimentacao = Date('Y-m-d H:i:s');
$formato_permitido = true;

$DescLayout = $_SESSION['DescLayout'];
$ValorPadraoInicial_arq = $_SESSION['ValorPadraoInicial_arq_'.$sistema];
$ValorPadraoFinal_arq =$_SESSION['ValorPadraoFinal_arq_'.$sistema];
$NumRetorno_arq = $_SESSION['NumRetorno_arq_'.$sistema];
$diaDataGerRetorno_arq = $_SESSION['diaDataGerRetorno_arq_'.$sistema];
$mesDataGerRetorno_arq = $_SESSION['mesDataGerRetorno_arq_'.$sistema];
$anoDataGerRetorno_arq = $_SESSION['anoDataGerRetorno_arq_'.$sistema];
$LinhaT_arq = $_SESSION['LinhaT_arq_'.$sistema];
$inicioNossoNumero24_arq = $_SESSION['inicioNossoNumero24_arq_'.$sistema];
$inicioNossoNumero90_arq = $_SESSION['inicioNossoNumero90_arq_'.$sistema];
$inicioNossoNumero024_arq = $_SESSION['inicioNossoNumero024_arq_'.$sistema];
$NossoNumero24_arq = $_SESSION['NossoNumero24_arq_'.$sistema];
$NossoNumero90_arq = $_SESSION['NossoNumero90_arq_'.$sistema];
$idcontasareceberT_arq = $_SESSION['idcontasareceberT_arq_'.$sistema];
$descricao_arq = $_SESSION['descricao_arq_'.$sistema];
$LinhaU_arq = $_SESSION['LinhaU_arq_'.$sistema];
$Valor_arq = $_SESSION['Valor_arq_'.$sistema];
$diaDataOcorrencia_arq = $_SESSION['diaDataOcorrencia_arq_'.$sistema];
$mesDataOcorrencia_arq = $_SESSION['mesDataOcorrencia_arq_'.$sistema];
$anoDataOcorrencia_arq = $_SESSION['anoDataOcorrencia_arq_'.$sistema];
$diaDataCredito_arq = $_SESSION['diaDataCredito_arq_'.$sistema];
$mesDataCredito_arq = $_SESSION['mesDataCredito_arq_'.$sistema];
$anoDataCredito_arq = $_SESSION['anoDataCredito_arq_'.$sistema];
$idcontasareceberU_arq = $_SESSION['idcontasareceberU_arq_'.$sistema];

$arquivosDeTitulos  = array('06','07','15','16','17','32','36','92','93','94','31','33','38','39');

?>