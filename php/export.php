<?php
try {

	if(($_POST['id'] == 'undefined') && ($_POST['fname'] == 'undefined') && ($_POST['lname'] == 'undefined') && ($_POST['address'] == 'undefined') && ($_POST['phone'] == 'undefined')){
		throw new PDOException('Empty data');
	} 
	
	require('fpdf/fpdf.php');
	include 'dbconnect.php';
	
	//////////////
	$pdf=new FPDF();
	$pdf->AddPage();
$pdf->setFont("Arial","B","20");
	$pdf->Cell(0,10,"My PDF Page",1,1,"C");
	
	
	
	$pdf->write(5, "asdfasdfasdf");
	$pdf->Output();
	////////////////
	
	
	
	
/*	$pdf=new FPDF();
	//Disable automatic page break
	$pdf->SetAutoPageBreak(false);
	
	//Add first page
$pdf->AddPage();

//set initial y axis position per page
$y_axis_initial = 25;

//print column titles for the actual page
$pdf->SetFillColor(232, 232, 232);
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetY($y_axis_initial);
$pdf->SetX(25);
$pdf->Cell(30, 6, 'CODE', 1, 0, 'L', 1);
$pdf->Cell(100, 6, 'NAME', 1, 0, 'L', 1);
$pdf->Cell(30, 6, 'PRICE', 1, 0, 'R', 1);

$y_axis = $y_axis + $row_height;

	
	
	//initialize counter
$i = 0;

//Set maximum rows per page
$max = 25;

//Set Row Height
$row_height = 6;
*/
	$sql = 'SELECT * FROM clients';
	$stmt = $objDb->prepare($sql);
	$result = $stmt->execute($values);
	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	
	
///////////////////

/*
$pdf->AddPage();

			//print column titles for the current page
			$pdf->SetY($y_axis_initial);
			$pdf->SetX(25);
			$pdf->Cell(30, 6, 'Date Of Visit', 1, 0, 'L', 1);
			$pdf->Cell(100, 6, 'Program', 1, 0, 'L', 1);
			$pdf->Cell(30, 6, 'Volunteer', 1, 0, 'R', 1);
			
			//Go to next row
			$y_axis = $y_axis + $row_height;
			
			//Set $i variable to 0 (first row)
			$i = 0;
		

		$code = 'fname';
		$price = 'lname';
		$name = 'address';

		$pdf->SetY($y_axis);
		$pdf->SetX(25);
		$pdf->Cell(30, 6, $code, 1, 0, 'L', 1);
		$pdf->Cell(100, 6, $name, 1, 0, 'L', 1);
		$pdf->Cell(30, 6, $price, 1, 0, 'R', 1);

		//Go to next row
		$y_axis = $y_axis + $row_height;
		$i = $i + 1;
		*/
///////////////////////////////		
	
	/*
	while($row = $stmt->fetchAll()){
		//If the current row is the last one, create new page and print column title
		if ($i == $max)
		{
			$pdf->AddPage();

			//print column titles for the current page
			$pdf->SetY($y_axis_initial);
			$pdf->SetX(25);
			$pdf->Cell(30, 6, 'Date Of Visit', 1, 0, 'L', 1);
			$pdf->Cell(100, 6, 'Program', 1, 0, 'L', 1);
			$pdf->Cell(30, 6, 'Volunteer', 1, 0, 'R', 1);
			
			//Go to next row
			$y_axis = $y_axis + $row_height;
			
			//Set $i variable to 0 (first row)
			$i = 0;
		}

		$code = $row['fname'];
		$price = $row['lname'];
		$name = $row['address'];

		$pdf->SetY($y_axis);
		$pdf->SetX(25);
		$pdf->Cell(30, 6, $code, 1, 0, 'L', 1);
		$pdf->Cell(100, 6, $name, 1, 0, 'L', 1);
		$pdf->Cell(30, 6, $price, 1, 0, 'R', 1);

		//Go to next row
		$y_axis = $y_axis + $row_height;
		$i = $i + 1;
	}
	//Create file
$pdf->Output();
*/
	
	/*
	echo json_encode(array(
		'error' => false,
		'clients' => $row
	), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
	*/

} catch(PDOException $e) {

	echo json_encode(array(
		'error' => true,
		'message' => $e->getMessage()
	), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
	
}