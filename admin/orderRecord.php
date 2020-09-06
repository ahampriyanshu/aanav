<?php
session_start();
include('../essentials/config.php');
include('sidebar.php');



if (!isset($_SESSION['admin'])) {
    header('location:logout.php');
}

require('../fpdf/fpdf.php');

class PDF extends FPDF
{
function Header()
{
$this->Image('../logo.png',80,0,45);
$this->Ln(20);
}

 function Footer()
 {
  $this->SetFont('Arial','',8);
  $this->SetY(-21);
  $date = date('Y/d/M h:i:s:A', time());
  $this->Cell(0,10,'This invoice is electronically genrated on '.$date.' No signature needed',0,0,'C');
  $this->SetY(-14);
  $this->Cell(0,10,'MIT Licensed @ahampriyanshu',0,0,'C');
 $this->SetY(-7);
 $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
 }
}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Courier','B',12);
$pdf->Cell(0,8,'Aanav Pvt Ltd',0,1,'C');
$pdf->Cell(0,8,'ahampriyanshu@gmail.com',0,1,'C');
$pdf->Cell(0,20,'',0,1,'C');
$pdf->SetFont('Arial','',12);


$pdf->Output();
?>
