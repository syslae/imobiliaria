 <?include(DOMAIN_PATH."modulos/relatorios/modelos/topo_rodape.php" );
        
   
    $pdf = new PDF();
    $pdf->Open();
    $pdf->AddPage('L','A4');
    
    $pdf->AliasNbPages();
        
 ?>