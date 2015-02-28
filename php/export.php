<?php
try {
	
	
/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Default Header and Footer
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
//require_once('tcpdf_include.php');
require_once('tcpdf/tcpdf.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 001');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
$pdf->setFooterData(array(0,64,0), array(0,64,128));

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('dejavusans', '', 14, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

// set text shadow effect
$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

// Set some content to print
$html = <<<EOD
<h1>Welcome to <a href="http://www.tcpdf.org" style="text-decoration:none;background-color:#CC0000;color:black;">&nbsp;<span style="color:black;">TC</span><span style="color:white;">PDF</span>&nbsp;</a>!</h1>
<i>This is the first example of TCPDF library.</i>
<p>This text is printed using the <i>writeHTMLCell()</i> method but you can also use: <i>Multicell(), writeHTML(), Write(), Cell() and Text()</i>.</p>
<p>Please check the source code documentation and other examples for further information.</p>
<p style="color:#CC0000;">TO IMPROVE AND EXPAND TCPDF I NEED YOUR SUPPORT, PLEASE <a href="http://sourceforge.net/donate/index.php?group_id=128076">MAKE A DONATION!</a></p>
EOD;

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('example_001.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	/*
//require_once('tcpdf/config/lang/eng.php');

	require_once('tcpdf/tcpdf.php');
	
$html = 'My First PDF Page';
 class MYPDF extends TCPDF {
                    //Page header
                    public function Header() {
                        // full background image
                        // store current auto-page-break status
                        $bMargin = $this->getBreakMargin();
                        $auto_page_break = $this->AutoPageBreak;
                        $this->SetAutoPageBreak(false, 0);
                        //$img_file = K_PATH_IMAGES.'synrginvoice.jpg';
                        //$img_file = K_PATH_IMAGES.'images/ciba.png';
                        //$this->Image('images/ciba.png', 0, 0, 300, 210, '', '', '', false, 300, '', false, false, 0);
                        // restore auto-page-break status
                        $this->SetAutoPageBreak($auto_page_break, $bMargin);
                    }
                    // Page footer
                    public function Footer() {
                        // Position at 10 mm from bottom
                        $this->SetY(-10);
                        // Set font
                        $this->SetFont('helvetica', 'I', 8);
                        // Page number
                        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
                    }
					public function CreateTextBox($textval, $x = 0, $y, $width = 0, $height = 10, $fontsize = 10, $fontstyle = '', $align = 'L') {
							$this->SetXY($x+20, $y); // 20 = margin left
							$this->SetFont(PDF_FONT_NAME_MAIN, $fontstyle, $fontsize);
							$this->Cell($width, $height, $textval, 0, false, $align);
					}
                }
                   


                // create new PDF document
                $pdf = new MYPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

                // set document information
                $pdf->SetCreator(PDF_CREATOR);
                $pdf->SetAuthor('Mihai Smarandache');
                $pdf->SetTitle('Patient Record');
                $pdf->SetSubject('TCPDF Tutorial');
                $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

                // set header and footer fonts
                $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));

                //$img_file = K_PATH_IMAGES.'images/ciba.png';
                //$pdf->Image($img_file, 0, 0, 300, 210, '', '', '', false, 300, '', false, false, 0);

                // set default monospaced font
              //  $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

                //set margins
                $pdf->SetMargins(1, 1, 1, 1);
                $pdf->SetHeaderMargin(0);
                $pdf->SetFooterMargin(0);

				//$pdf->SetFont("helvetica", "BI", 10);
                // remove default footer
                //$pdf->setPrintFooter(false);
                //$pdf->Footer();

                //set auto page breaks
               // $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

                //set image scale factor
                $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

                //set some language-dependent strings
                $pdf->setLanguageArray($l);

                // ---------------------------------------------------------

                // add a page
                $pdf->AddPage();
                $pdf->writeHTML($html, true, false, true, false, '');
                $pdf->lastPage();

                //Close and output PDF document
                $pdf->Output('example_051.pdf', 'I');


*/

//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////
/*	require('fpdf/fpdf.php');
	include 'dbconnect.php';
	
	//////////////
	$x = 0;
	$sql = "SELECT * FROM `clients` AS c, `visits` AS v WHERE c.id = :cid AND c.id = v.client_id AND (date_of_visit BETWEEN :from AND :to)";

	$stmt = $objDb->prepare($sql);


	$result = $stmt->execute(array('cid' => $_POST['cid'], 'from' => $_POST['from'], 'to' => $_POST['to']));
	
	
	
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

		$pdf->Output();

*/

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