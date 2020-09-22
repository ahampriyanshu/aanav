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
        $this->Cell(45, 7, 'Email', 1, 2, 'L');
        $this->setXY($x + 110, $y);
        $this->Cell(25, 7, 'Phone', 1, 2, 'L');
        $this->setXY($x + 135, $y);
        $this->Cell(30, 7, 'Created', 1, 2, 'L');
        $this->setXY($x + 165, $y);
        $this->Cell(30, 7, 'Last Visit', 1, 2, 'L');

        $sql = "SELECT * FROM customer ";
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
                $this->Cell(15, 7, 'Unverified', 1, 2, 'L');
            } else if ($d['status'] == 1)  {
                $this->Cell(15, 7, 'Active', 1, 2, 'L');
            }
            else if ($d['status'] == 2)  {
                $this->Cell(15, 7, 'Unactive', 1, 2, 'L');
            }
            else if ($d['status'] == 3)  {
                $this->Cell(15, 7, 'Disable', 1, 2, 'L');
            }
            else  {
                $this->Cell(15, 7, 'Error', 1, 2, 'L');
            }
            $this->setXY($x + 65, $y);
            $this->Cell(45, 7, $d["email"], 1, 2, 'L');
            $this->setXY($x + 110, $y);
            $this->Cell(25, 7, $d["phone"], 1, 2, 'L');
            $this->setXY($x + 135, $y);
            $this->Cell(30, 7, $d["datetym"], 1, 2, 'L');
            $this->setXY($x + 165, $y);
            $this->Cell(30, 7, $d["last_login"], 1, 2, 'L');
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
$pdf->Cell(0, 8, 'Customer List', 0, 1, 'C');
$pdf->Cell(0, 10, '', 0, 1, 'C');
$pdf->SetFont('Arial', '', 8);
$pdf->populate_table($connect);
$pdf->Output();