<?php
require('fpdf17/fpdf.php');
include("dbconnect.php");

$pdf = new FPDF();
$pdf->open();
$pdf->AddPage('L');
$pdf->SetAutoPageBreak(false);

if($_POST['report'] == 'clientVisits'){
	
} else {
	
	$pdf->SetFillColor(170, 170, 170); //gray
	$pdf->setFont("times","","11");
	$pdf->setXY(3, 3);
	$pdf->Cell(17, 10, "Client ID", 1, 0, "C", 1);
	$pdf->Cell(30, 10, "First Name", 1, 0, "C", 1);
	$pdf->Cell(35, 10, "Last Name", 1, 0, "C", 1);
	$pdf->Cell(60, 10, "Address", 1, 0, "C", 1);
	$pdf->Cell(25, 10, "Phone", 1, 0, "C", 1);
	$pdf->Cell(15, 10, "Inhouse", 1, 0, "C", 1);
	$pdf->Cell(50, 10, "Email", 1, 0, "C", 1);
	$pdf->Cell(25, 10, "Annual income", 1, 0, "C", 1);
	$pdf->Cell(30, 10, "Income updated", 1, 0, "C", 1);
	
	$pdf->Ln();

	$y = $pdf->GetY();
	$x = 3;
	$pdf->setXY($x, $y);
	 
	$sql = "SELECT id, fname, lname, address, phone, inhouse, email, annual_income, income_updated FROM `clients`";
	$stmt = $objDb->prepare($sql);
	$result = $stmt->execute();
	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	while($row = $stmt->fetch())
	{
		$pdf->Cell(17, 10, $row['id'], 1);
		$pdf->Cell(30, 10, $row['fname'], 1);
		$pdf->Cell(35, 10, $row['lname'], 1);
		$pdf->Cell(60, 10, $row['address'], 1);
		$pdf->Cell(25, 10, $row['phone'], 1);
		$pdf->Cell(15, 10, $row['inhouse'], 1);
		$pdf->Cell(50, 10, $row['email'], 1);
		$pdf->Cell(25, 10, $row['annual_income'], 1);
		$pdf->Cell(30, 10, $row['income_updated'], 1);
	
		$y += 10;
		
		if ($y > 180)
		{
			$pdf->AddPage('L');
			$y = 20;
		}
		
		$pdf->setXY($x, $y);
	}
}
$pdf->Output();

?>