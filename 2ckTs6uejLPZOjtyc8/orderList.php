<?php 
session_start();
require('../fpdf/fpdf.php');
require_once("../essentials/config.php");
if (!$_SESSION['admin']) {
  echo '<script>
  location.href="logout.php"
  </script>';
  }

class PDF extends FPDF
{
function Header()
{
$this->Image('../img/logo.png',80,0,45);
$this->Ln(20);
}
function populate_table($connect){
  $x=$this->GetX();
  $y=$this->GetY();
  $this->setXY($x,$y);
  $this->Cell(10,7,'Ord No',1,2,'L');
  $this->setXY($x+10,$y);
  $this->Cell(40,7,'Name',1,2,'L');
  $this->setXY($x+50,$y);
  $this->Cell(10,7,'Cus Id',1,2,'L');
  $this->setXY($x+60,$y);
  $this->Cell(25,7,'Phone',1,2,'L');
  $this->setXY($x+85,$y);
  $this->Cell(15,7,'Type',1,2,'L');
  $this->setXY($x+100,$y);
  $this->Cell(15,7,'Payment',1,2,'L');
  $this->setXY($x+115,$y);
  $this->Cell(30,7,'Date',1,2,'L');
  $this->setXY($x+145,$y);
  $this->Cell(20,7,'Status',1,2,'L');
  $this->setXY($x+165,$y);
  $this->Cell(10,7,'Qty',1,2,'L');
  $this->setXY($x+175,$y);
  $this->Cell(15,7,'Total Price',1,2,'L');
  $total=0;
  $sql = "SELECT * FROM orders ";
  $result = mysqli_query($connect, $sql);
  while($d = mysqli_fetch_assoc($result)) 
  {
    
                        $this->Ln(0);
                        $x=$this->GetX();
                        $y=$this->GetY();
                        $this->setXY($x,$y);
                        $this->Cell(10,7,$d["order_id"],1,2,'L');
                        $this->setXY($x+10,$y);
                        $this->Cell(40,7,$d["full_name"],1,2,'L');
                        $this->setXY($x+50,$y);
                        $this->Cell(10,7,$d["customer_id"],1,2,'L');
                        $this->setXY($x+60,$y);
                        $this->Cell(25,7,$d["phone"],1,2,'L');
                        $this->setXY($x+85,$y);

                        if ($d['store_id'] == 0) {
                          $this->Cell(15,7,'Home',1,2,'L');
                      
                      } else {
                        $this->Cell(15,7,'Store',1,2,'L');
                      
                      }
                      
                       
                        $this->setXY($x+100,$y);
                        $this->Cell(15,7,$d["payment_type"],1,2,'L');
                        $this->setXY($x+115,$y);
                        $this->Cell(30,7,$d["created_date"],1,2,'L');
                        $this->setXY($x+145,$y);

                         if ($d['status'] == 0) {
                            $this->Cell(20,7,'Cancelled',1,2,'L'); 
                        
                        } else if ($d['status'] == 1) {
                           $this->Cell(20,7,'Placed',1,2,'L'); 
                        
                        } else if ($d['status'] == 2) {
                           $this->Cell(20,7,'Approved',1,2,'L'); 
                        
                        } else if ($d['status'] == 3) {
                           $this->Cell(20,7,'Shipped',1,2,'L'); 
                        
                        } else if ($d['status'] == 4) {
                           $this->Cell(20,7,'Deliverd',1,2,'L'); 
                        
                        } else if ($d['status'] == 5) {
                           $this->Cell(20,7,'Refund Req.',1,2,'L'); 
                        
                        } else if ($d['status'] == 6) {
                           $this->Cell(20,7,'Refunded',1,2,'L'); 
                        
                        } else {  
                          $this->Cell(20,7,'Error',1,2,'L'); 
                         } 
                        $this->setXY($x+165,$y);
                        $this->Cell(10,7,$d["total_qty"],1,2,'L');
                        $this->setXY($x+175,$y);
                        $this->Cell(15,7,$d["total_amt"],1,2,'L');
                        $total += $d["total_amt"];
  }
  $this->Ln(0);
  $x=$this->GetX();
  $y=$this->GetY();
  $this->setXY($x+145,$y);
  $this->Cell(30,7,'Grand Total',1,2,'C');
  $this->setXY($x+175,$y);
  $this->Cell(15,7,round($total,2),1,2,'L');
 }
 function Footer()
 {
 
  $this->SetFont('Arial','',8);
  $this->SetY(-21);
  $date = date('Y/d/M h:i:s:A', time());
  $this->Cell(0,10,'This report is electronically genrated on '.$date.' No signature needed',0,0,'C');
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
$pdf->Cell(0,8,'ahampriyanshu@gmail.com',0,1,'C');
$pdf->Cell(0,20,'',0,1,'C');
$pdf->SetFont('Courier','B',24);
$pdf->Cell(0,8,'Order List',0,1,'C');
$pdf->Cell(0,10,'',0,1,'C');
$pdf->SetFont('Arial','',8);
$pdf->populate_table($connect);
$pdf->Output();
