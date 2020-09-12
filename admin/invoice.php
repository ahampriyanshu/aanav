<?php 
session_start();
require('../fpdf/fpdf.php');
require_once("../essentials/config.php");
if (!$_SESSION['admin']) {
  echo '<script>
  location.href="logout.php"
  </script>';
  }
  if (!$_GET['id']) {
      echo '<script>
      location.href="logout.php"
      </script>';
  }
  
$order_id = $_GET['id'];

class PDF extends FPDF
{
function Header()
{
$this->Image('../img/logo.png',80,0,45);
$this->Ln(20);
}
function populate_table($order_id,$connect){
  $x=$this->GetX();
  $y=$this->GetY();
  $this->setXY($x,$y);
  $this->Cell(20,7,'S.No.',1,2,'L');
  $this->setXY($x+20,$y);
  $this->Cell(50,7,'Product name',1,2,'L');
  $this->setXY($x+70,$y);
  $this->Cell(30,7,'Variant',1,2,'L');
  $this->setXY($x+100,$y);
  $this->Cell(20,7,'Qty',1,2,'L');
  $this->setXY($x+120,$y);
  $this->Cell(30,7,'Unit Price',1,2,'L');
  $this->setXY($x+150,$y);
  $this->Cell(30,7,'Total Price',1,2,'L');
  $i=1;
  $total=0;
  $sql = "SELECT * FROM order_detail WHERE order_id = '$order_id' ";
  $result = mysqli_query($connect, $sql);
  while($d = mysqli_fetch_assoc($result)) 
  {
    $vid = $d["variant_id"];
    $result_2 = mysqli_query($connect, "SELECT color,size FROM variant where variant_id='$vid'");
                        $attr_prop = mysqli_fetch_assoc($result_2);
                        $color_id = $attr_prop['color'];
                        $size_id = $attr_prop['size'];

                        $result_3 = mysqli_query($connect, "SELECT value FROM attribute where attr_id='$color_id'");
                        $variant_prop = mysqli_fetch_assoc($result_3);
                        $color = $variant_prop['value'];
                        
                        $result_4 = mysqli_query($connect, "SELECT value FROM attribute where attr_id='$size_id'");
                        $variant_prop = mysqli_fetch_assoc($result_4);
                        $size = $variant_prop['value'];


                        $price = $d["price"]*$d["units"];
                        $this->Ln(0);
                        $x=$this->GetX();
                        $y=$this->GetY();
                        $this->setXY($x,$y);
                        $this->Cell(20,7,$i,1,2,'L');
                        $this->setXY($x+20,$y);
                        $this->Cell(50,7,$d["product_name"],1,2,'L');
                        $this->setXY($x+70,$y);
                        $this->Cell(30,7,$color.", " .$size,1,2,'L');
                        $this->setXY($x+100,$y);
                        $this->Cell(20,7,$d["units"],1,2,'L');
                        $this->setXY($x+120,$y);
                        $this->Cell(30,7,$d["price"],1,2,'L');
                        $this->setXY($x+150,$y);
                        $this->Cell(30,7,$price,1,2,'L');
                        $total += $price;
                        $i++;
  }
  $this->Ln(0);
  $x=$this->GetX();
  $y=$this->GetY();
  $this->setXY($x+120,$y);
  $this->Cell(30,7,'Grand Total',1,2,'C');
  $this->setXY($x+150,$y);
  $this->Cell(30,7,round($total,2),1,2,'L');
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
$sql = "SELECT * FROM orders WHERE order_id = '$order_id' ";
$result = mysqli_query($connect, $sql);
while($row = mysqli_fetch_assoc($result)) 
{
  $pdf->Cell(0,8,'Name : '.$row['full_name'],0,1,'L');
  $pdf->Cell(0,8,'Email : '.$row['email'],0,1,'L');
  $pdf->Cell(0,8,'Phone : '.$row['phone'],0,1,'L');
  if ($row['store_id'] != 0 )
  {
  $pdf->Cell(0,8,'  '.$row['email'],0,1,'L');
  $pdf->Cell(0,8,'  '.$row['email'],0,1,'L');
  $pdf->Cell(0,8,'  '.$row['email'],0,1,'L');
  }
  else
  {
  $pdf->Cell(0,8,'Address : '.$row['street_address']." , ",0,1,'L');
  $pdf->Cell(0,8,'            '.$row['city']." , ".$row['state'],0,1,'L');
  $pdf->Cell(0,8,'            '.$row['pincode'],0,1,'L');
  }

$pdf->Cell(0,10,'',0,1,'C');
$pdf->populate_table($order_id,$connect);
$pdf->Cell(0,10,'',0,1,'C');
$pdf->Cell(0,8,'Payment Type : '.$row['payment_type'],0,1,'L');

if ($row['status'] != 4 )
  {
    $pdf->Cell(0,8,'Payment Status : Not Received',0,1,'L');
  }
  else
  {
    $pdf->Cell(0,8,'Payment Status : Received',0,1,'L');
  }

$pdf->Cell(0,8,'Order Placed On :'.$row['created_date'],0,1,'L');
}
$pdf->Output();
?>
