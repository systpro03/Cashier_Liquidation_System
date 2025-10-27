<?php 

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