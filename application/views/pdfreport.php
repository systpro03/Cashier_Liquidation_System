<?php 

/*tcpdf();
$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$obj_pdf->SetCreator(PDF_CREATOR);
$title = "PDF Report";
$obj_pdf->SetTitle($title);
$obj_pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $title, PDF_HEADER_STRING);
$obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$obj_pdf->SetDefaultMonospacedFont('helvetica');
$obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$obj_pdf->SetFont('helvetica', '', 9);
$obj_pdf->setFontSubsetting(false);
$obj_pdf->AddPage();
ob_start();
    
    $content = ob_get_contents();
ob_end_clean();
$obj_pdf->writeHTML($content, true, false, true, false, '');
$obj_pdf->Output('output.pdf', 'I');*/

/*====================================================================================================================*/

$this->ppdf = new TCPDF();
$this->ppdf->SetTitle(" NICO JOBTRANS");
$this->ppdf->SetMargins(15, 20, 20);
$this->ppdf->setPrintHeader(false);
$this->ppdf->AddPage("P","A5");
$this->ppdf->SetAutoPageBreak(false);

$this->ppdf->SetFont('Times','B',13);   
$this->ppdf->SetFont('Times','',11);


$this->ppdf->Cell(0, 7,'Date');
$this->ppdf->SetX(33);
$this->ppdf->Cell(2, 6,":");
$this->ppdf->SetX(40);
$this->ppdf->Cell(40,7, 'safdsf  fsdf');
    $this->ppdf->Ln();

$this->ppdf->Cell(0, 7,'To');   
$this->ppdf->SetX(33);
$this->ppdf->Cell(2, 6,":");
$this->ppdf->SetX(40);
$this->ppdf->Cell(40,7, 'fsdf  sdfdsfsdf');
$this->ppdf->Ln();

$this->ppdf->Cell(0, 7,'From');
$this->ppdf->SetX(33);
$this->ppdf->Cell(2, 6,":");
$this->ppdf->SetX(40);
$this->ppdf->Cell(40,7, 'dsfg dsfdsfsd');
$this->ppdf->Ln();


$this->ppdf->Cell(0, 7,'Re');
$this->ppdf->SetX(33);
$this->ppdf->Cell(2, 6,":");
$this->ppdf->SetX(40);
$this->ppdf->Cell(40,7,'Job Transfer');
$this->ppdf->Ln();
$this->ppdf->SetFont('helvetica','B',11);
$this->ppdf->Cell(120,6, "____________________________________________________");

$this->ppdf->Ln(7);
$this->ppdf->SetFont('helvetica','',11);
$this->ppdf->Multicell(120,7,'Effective you are hereby transferred from  under the direct supervision of .');

$this->ppdf->Ln(7);
$this->ppdf->Multicell(0,7,'Whatever accountabilities you may have in your present section should be settled first before you move to your new assignment.');

$this->ppdf->Ln(7);
$this->ppdf->Cell(0,7,'For your guidance and compliance.');

$this->ppdf->Ln(15);
$this->ppdf->Cell(0,7,'MS. MARIA NORA A. PAHANG');
$this->ppdf->Ln(5);
$this->ppdf->Cell(0,7,'HRD MANAGER');

$this->ppdf->Ln(15);
$this->ppdf->Cell(0,7,'C O N F O R M E  ;
$this->ppdf->Ln(10);
$this->ppdf->Cell(0,7,'Cc ;
$this->ppdf->SetX(30);
$this->ppdf->Cell(30,7, 'sdfs');
$this->ppdf->Ln(5);
$this->ppdf->SetX(30);
$this->ppdf->Cell(30,7, 'sfds ');
$this->ppdf->Ln(5);
$this->ppdf->SetX(30);
$this->ppdf->Cell(30,7, 'fdsfs ');
$this->ppdf->Ln(5);
$this->ppdf->SetX(30);
$this->ppdf->Cell(30,7, 'sdfsdf');
$this->ppdf->Ln(5);
$this->ppdf->SetX(30);
$this->ppdf->Cell(30,7,'');
$this->ppdf->Ln(5);
$this->ppdf->SetX(30);
$this->ppdf->Cell(30,7,'');

$this->ppdf->Output();
$this->ppdf->Output($data['path'],'F');


?>