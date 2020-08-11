<?php
require_once("essentials/config.php");
$sql = "SELECT order_id, total_amt, total_qty, payment_type FROM orders ";
$resultset = mysqli_query($connect, $sql) or die("database error:". mysqli_error($connect));
require('fpdf/fpdf.php');
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);
while ($field_info = mysqli_fetch_field($resultset)) {
    $pdf->Cell(47,12,$field_info->name,1);
}
while($rows = mysqli_fetch_assoc($resultset)) {
	$pdf->SetFont('Arial','',12);	
	$pdf->Ln();
	foreach($rows as $column) {
		$pdf->Cell(47,12,$column,1);
	}
}
$pdf->Output();
?>