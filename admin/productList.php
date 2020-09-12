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
        $this->Image('../img/logo.png', 80, 0, 45);
        $this->Ln(20);
    }
    function populate_table($connect)
    {
        $x = $this->GetX();
        $y = $this->GetY();
        $this->setXY($x, $y);
        $this->Cell(10, 7, 'Id', 1, 2, 'L');
        $this->setXY($x + 10, $y);
        $this->Cell(40, 7, 'Name', 1, 2, 'L');
        $this->setXY($x + 50, $y);
        $this->Cell(15, 7, 'Status', 1, 2, 'L');
        $this->setXY($x + 65, $y);
        $this->Cell(20, 7, 'Code', 1, 2, 'L');
        $this->setXY($x + 85, $y);
        $this->Cell(30, 7, 'Created', 1, 2, 'L');
        $this->setXY($x + 115, $y);
        $this->Cell(30, 7, 'Updated', 1, 2, 'L');
        $this->setXY($x + 145, $y);
        $this->Cell(15, 7, 'Retail', 1, 2, 'L');
        $this->setXY($x + 160, $y);
        $this->Cell(15, 7, 'Price', 1, 2, 'L');
        $this->setXY($x + 175, $y);
        $this->Cell(15, 7, 'Units', 1, 2, 'L');

        $sql = "SELECT * FROM product ";
        $result = mysqli_query($connect, $sql);
        while ($d = mysqli_fetch_assoc($result)) {

            $this->Ln(0);
            $x = $this->GetX();
            $y = $this->GetY();
            $this->setXY($x, $y);
            $this->Cell(10, 7, $d["id"], 1, 2, 'L');
            $this->setXY($x + 10, $y);
            $this->Cell(40, 7, $d["name"], 1, 2, 'L');
            $this->setXY($x + 50, $y);
            if ($d['status'] == 0) {
                $this->Cell(15, 7, 'Unactive', 1, 2, 'L');
            } else {
                $this->Cell(15, 7, 'Active', 1, 2, 'L');
            }
            $this->setXY($x + 65, $y);
            $this->Cell(20, 7, $d["code"], 1, 2, 'L');
            $this->setXY($x + 85, $y);
            $this->Cell(30, 7, $d["created_date"], 1, 2, 'L');
            $this->setXY($x + 115, $y);
            $this->Cell(30, 7, $d["modified_date"], 1, 2, 'L');
            $this->setXY($x + 145, $y);
            $this->Cell(15, 7, 'Rs ' . $d["MRP"], 1, 2, 'L');
            $this->setXY($x + 160, $y);
            $this->Cell(15, 7, 'Rs ' . $d["cost"], 1, 2, 'L');
            $this->setXY($x + 175, $y);
            $this->Cell(15, 7, $d["qty"], 1, 2, 'L');
        }
    }
    function Footer()
    {

        $this->SetFont('Arial', '', 8);
        $this->SetY(-21);
        $date = date('Y/d/M h:i:s:A', time());
        $this->Cell(0, 10, 'This report is electronically genrated on ' . $date . ' No signature needed', 0, 0, 'C');
        $this->SetY(-14);
        $this->Cell(0, 10, 'MIT Licensed @ahampriyanshu', 0, 0, 'C');
        $this->SetY(-7);
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Courier', 'B', 12);
$pdf->Cell(0, 8, 'ahampriyanshu@gmail.com', 0, 1, 'C');
$pdf->Cell(0, 20, '', 0, 1, 'C');
$pdf->SetFont('Courier', 'B', 24);
$pdf->Cell(0, 8, 'Product List', 0, 1, 'C');
$pdf->Cell(0, 10, '', 0, 1, 'C');
$pdf->SetFont('Arial', '', 8);
$pdf->populate_table($connect);
$pdf->Output();
