<?php 
session_start();
error_reporting(E_ALL);
require_once("essentials/config.php");
$sql = "SELECT order_id, total_amt, total_qty, payment_type FROM orders ";
$resultset = mysqli_query($connect, $sql) or die("database error:". mysqli_error($connect));
require('fpdf/fpdf.php');
$company = "company";
$address = "addredmfdafmss";
$email = "email";
$telephone = "telephone";
$number = "number";
$item = "item";
$price = "545";
$vat = "10";
$bank = "bank";
$iban = "iban";
$paypal = "paypal";
$com = "com";
$pay = 'Payment information';
$price = str_replace(",",".",$price);
$vat = str_replace(",",".",$vat);
$p = explode(" ",$price);
$v = explode(" ",$vat);
$re = $p[0] + $v[0];
function r($r)
{
$r = str_replace("$","",$r);
$r = str_replace(" ","",$r);
$r = $r." $";
return $r;
}
$price = r($price);
$vat = r($vat);

class PDF extends FPDF
{
function Header()
{

$logo = "logo.png";

$this->Image($logo,80,0,45);
$this->SetFont('Courier','B',12);
$this->Ln(20);
}
function Footer()
{
$this->SetY(-15);
$this->SetFont('Courier','I',8);
$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}

}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Courier','B',12);
$pdf->SetTextColor(32);
$pdf->Cell(0,8,'Aanav Pvt Ltd',0,1,'C');
$pdf->Cell(0,8,'ahampriyanshu@gmail.com',0,1,'C');
$pdf->Cell(0,30,'',0,1,'C');
$pdf->Cell(0,20,'',0,1,'R');
$pdf->Cell(170,7,'Item',1,0,'L');
$pdf->Cell(20,7,'Price',1,1,'C');
$pdf->Cell(170,7,$item,1,0,'L',0);
$pdf->Cell(20,7,$price,1,1,'C',0);
$pdf->Cell(0,0,'',0,1,'R');
$pdf->Cell(170,7,'VAT',1,0,'R',0);
$pdf->Cell(20,7,$vat,1,1,'C',0);
$pdf->Cell(170,7,'Total',1,0,'R',0);
$pdf->Cell(20,7,$re." $",1,0,'C',0);
$pdf->Cell(0,20,'',0,1,'R');
$pdf->Cell(0,5,$pay,0,1,'L');
$pdf->Cell(0,5,$bank,0,1,'L');
$pdf->Cell(0,5,$iban,0,1,'L');
$pdf->Cell(0,20,'',0,1,'R');
$pdf->Cell(0,5,'PayPal:',0,1,'L');
$pdf->Cell(0,5,$paypal,0,1,'L');
$pdf->Cell(190,40,$com,0,0,'C');
$pdf->Output();
?>
