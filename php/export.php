<?php
try {

	if(($_POST['id'] == 'undefined') && ($_POST['fname'] == 'undefined') && ($_POST['lname'] == 'undefined') && ($_POST['address'] == 'undefined') && ($_POST['phone'] == 'undefined')){
		throw new PDOException('Empty data');
	} 
	
	require('fpdf/fpdf.php');
	include 'dbconnect.php';
	
	//////////////
	$x = 0;
	$sql = "SELECT * FROM `clients` AS c, `visits` AS v WHERE c.id = 111522 AND c.id = v.client_id AND (date_of_visit BETWEEN '2011-01-30 14:15:55' AND '2013-09-29 10:15:55')";

	$stmt = $objDb->prepare($sql);
	$result = $stmt->execute($values);
	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	$pdf=new FPDF();
	$pdf->AddPage();
$pdf->SetFont('Arial','B',16);

$row = $stmt->fetchAll();
//while($row = $stmt->fetchAll()){


			$y=0; // col count that resets every row
			$fieldvalues = array_values($row); //output field values
			
			foreach ($fieldvalues as $fieldvalue){
			
				if($y==0){
					$pdf->Cell(40,10,$fieldvalue['fname'],0,1); // print on beginning of next line if first col
					$pdf->Cell(40,10,$fieldvalue['lname'],0,1); // print on beginning of next line if first col
				}

			  if ($y==3){			   			   

			    $pdf->Cell(40,10,$fieldvalue['date_of_visit'],0,1); // print on beginning of next line if first col

			  }else{
			    $pdf->Cell(40,10,$fieldvalue['date_of_visit'],0,0);
			    $y++;
			  }
			 
			
			
			} 




/*
		if ($x==0){ // output field names once at top
		
			  $fieldnames = array_keys($row);
			  foreach ($fieldnames as $fieldname){
			   $pdf->Cell(40,10,$fieldname,0,0);
			  }
			  
			  $x++;
		  
			$y=0; // col count that resets every row
			$fieldvalues = array_values($row); //output field values
			
			foreach ($fieldvalues as $fieldvalue){
			  if ($y==2){
			   $pdf->Cell(40,10,$fieldvalue['date_of_visit'],0,1); // print on beginning of next line if first col
			  }else{
			   $pdf->Cell(40,10,$fieldvalue['date_of_visit'],0,0);
			  }
			  $y++;
			 }
			 
		}
		*/
		 
		$pdf->Output();
 	
//	}
	
	/////////////////////////////////
	

	
	/*
	$sql = "SELECT *
	FROM `visits`
	WHERE (date_of_visit BETWEEN '2011-01-30 14:15:55' AND '2013-09-29 10:15:55')";
		$sql = 'SELECT * FROM visits';

	$stmt = $objDb->prepare($sql);
	$result = $stmt->execute($values);
	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	
			$pdf=new FPDF();
$pdf->AddPage();
		$pdf->setFont("Arial","B","20");
		$pdf->Cell(0,10,"My PDF Page",1,1,"C");
		
		while($row = $stmt->fetchAll()){ 
	$pdf->write(5, $row['date_of_visit']);
	}
	*/
/*	while($row = $stmt->fetchAll()){ 
		$pdf->AddPage();
		$pdf->setFont("Arial","B","20");
		$pdf->Cell(0,10,"My PDF Page",1,1,"C");
		$pdf->write(5, $row['date_of_visit']);
	$pdf->write(6, 'asfasde454');
*/
	
	/*
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
		*/
//	}
	
//	$pdf->Output();
	
	
	
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

/*
	$sql = 'SELECT * FROM clients';
	$stmt = $objDb->prepare($sql);
	$result = $stmt->execute($values);
	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	*/
	
	
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
	
	
	echo json_encode(array(
		'error' => false,
		'clients' => $row
	), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
	

} catch(PDOException $e) {

	echo json_encode(array(
		'error' => true,
		'message' => $e->getMessage()
	), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
	
}