<?php
require 'fpdf.php';

class myPDF extends FPDF {

	function header() {
		// $this->Image('', 10,6);
		$this->SetFont('Arial', 'B', '14');
		$this->Cell(276,5,'Werk Beheer',0,0,'c');
		$this->Ln();
		$this->SetFont('Times', '',12);
		$this->Cell(276,10,'Kampman Transport', 0,0,'C');
		$this->Ln(20);
	}
	function weekJaar() {
		// $this->SetY(-150);
		$this->SetFont('Arial','B',10);
		$this->Cell(15,8,'Week',1,0,'C');
		$this->SetFont('Arial','',10);
		$this->Cell(15,8,$_GET['weeknmr'],1,0,'');
		$this->Ln();
		$this->SetFont('Arial','B',10);
		$this->Cell(15,8,'Jaar',1,0,'C');
		$this->SetFont('Arial','',10);
		$this->Cell(15,8,$_GET['jaar'],1,0,'');
		$this->Ln();
	}
	function headerTable() {
		$weeknmr = $_GET['weeknmr'];
		include 'conn.php';
		//1e rij
		$this->Ln();
		$this->SetFont('Arial','B',9);
		$this->Cell(12,10,'datum',1,0,'C');
		$this->SetFont('Arial','',9);
		$this->Cell(12,10,'datum',1,0,'C');
		$this->Cell(66,10,'',0,0,'C');
		$this->SetFont('Arial','B',9);
		$this->Cell(12,10,'datum',1,0,'C');
		$this->SetFont('Arial','',9);
		$this->Cell(12,10,'datum',1,0,'C');
		$this->Ln();
		$this->Ln();
		$this->SetFont('Arial','B',9);
		$this->Cell(15,10,'Km',1,0,'C');
		$this->Cell(20,10,'Locatie',1,0,'C');
		$this->Cell(18,10,'Aankomst',1,0,'C');
		$this->Cell(15,10,'Vertrek',1,0,'C');
		$this->Cell(20,10,'No',1,0,'C');
		$this->SetFont('Arial','',9);
		$sql = "SELECT * FROM gegevens WHERE Week = :week And Dag = 'Maandag'";
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(':week', $weeknmr, PDO::PARAM_INT);
		$stmt->execute();
		$data = $stmt->fetchAll();
		foreach($data as $row) {

			//gegevens
			$this->Ln();
			$this->SetFont('Arial','',9);
			$this->Cell(15,10, $row['Km'] ,1,0,'C');
			$this->Cell(20,10,$row['Locatie'],1,0,'C');
			$this->Cell(18,10,$row['Aankomst'],1,0,'C');
			$this->Cell(15,10,$row['Vertrek'],1,0,'C');
			$this->Cell(20,10,$row['No'],1,0,'C');
			$this->SetFont('Arial','B',9);
			$this->Ln(-10);
			$this->Cell(90,10,'',0,0,'C');
		}	if ($stmt->rowCount() < 1) {
			$this->Cell(2,10,'',0,0,'C');
		}
		//2de colom
		
		$this->Cell(15,10,'Km',1,0,'C');
		$this->Cell(20,10,'Locatie',1,0,'C');
		$this->Cell(18,10,'Aankomst',1,0,'C');
		$this->Cell(15,10,'Vertrek',1,0,'C');
		$this->Cell(20,10,'No',1,0,'C');
		//gegevens dinsdag
		$sql = "SELECT * FROM gegevens WHERE Week = :week And Dag = 'Dinsdag'";
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(':week', $weeknmr, PDO::PARAM_INT);
		$stmt->execute();
		$data = $stmt->fetchAll();
		// echo "text";
		foreach($data as $row) {

			//gegevens
			$this->Ln();
			$this->Cell(90,10,'',0,0,'C');
			$this->SetFont('Arial','',9);
			$this->Cell(15,10, $row['Km'] ,1,0,'C');
			$this->Cell(20,10,$row['Locatie'],1,0,'C');
			$this->Cell(18,10,$row['Aankomst'],1,0,'C');
			$this->Cell(15,10,$row['Vertrek'],1,0,'C');
			$this->Cell(20,10,$row['No'],1,0,'C');
			$this->SetFont('Arial','B',9);
		}
		$this->ln();
		
		//2de rij
		$this->Ln();
		$this->SetFont('Arial','B',9);
		$this->Cell(12,10,'datum',1,0,'C');
		$this->SetFont('Arial','',9);
		$this->Cell(12,10,'datum',1,0,'C');
		$this->Cell(66,10,'',0,0,'C');
		$this->SetFont('Arial','B',9);
		$this->Cell(12,10,'datum',1,0,'C');
		$this->SetFont('Arial','',9);
		$this->Cell(12,10,'datum',1,0,'C');
		$this->Ln();
		//headers
		$this->Ln();
		$this->SetFont('Arial','B',9);
		$this->Cell(15,10,'Km',1,0,'C');
		$this->Cell(20,10,'Locatie',1,0,'C');
		$this->Cell(18,10,'Aankomst',1,0,'C');
		$this->Cell(15,10,'Vertrek',1,0,'C');
		$this->Cell(20,10,'No',1,0,'C');
		//data woensdat
		$sql = "SELECT * FROM gegevens WHERE Week = :week And Dag = 'Woensdag'";
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(':week', $weeknmr, PDO::PARAM_INT);
		$stmt->execute();
		$data = $stmt->fetchAll();
		// echo "text";
		foreach($data as $row) {

			//gegevens
			$this->Ln();
			$this->SetFont('Arial','',9);
			$this->Cell(15,10, $row['Km'] ,1,0,'C');
			$this->Cell(20,10,$row['Locatie'],1,0,'C');
			$this->Cell(18,10,$row['Aankomst'],1,0,'C');
			$this->Cell(15,10,$row['Vertrek'],1,0,'C');
			$this->Cell(20,10,$row['No'],1,0,'C');
			$this->SetFont('Arial','B',9);
			$this->Ln(-10);
			$this->Cell(90,10,'',0,0,'C');
		}	if ($stmt->rowCount() < 1) {
			$this->Cell(2,10,'',0,0,'C');
		}

			//2de colom
			
			$this->Cell(15,10,'Km',1,0,'C');
			$this->Cell(20,10,'Locatie',1,0,'C');
			$this->Cell(18,10,'Aankomst',1,0,'C');
			$this->Cell(15,10,'Vertrek',1,0,'C');
			$this->Cell(20,10,'No',1,0,'C');
			//gegevens donderdag
			$sql = "SELECT * FROM gegevens WHERE Week = :week And Dag = 'Donderdag'";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':week', $weeknmr, PDO::PARAM_INT);
			$stmt->execute();
			$data = $stmt->fetchAll();
			// echo "text";
			foreach($data as $row) {
	
				//gegevens
				$this->Ln();
				$this->Cell(90,10,'',0,0,'C');
				$this->SetFont('Arial','',9);
				$this->Cell(15,10, $row['Km'] ,1,0,'C');
				$this->Cell(20,10,$row['Locatie'],1,0,'C');
				$this->Cell(18,10,$row['Aankomst'],1,0,'C');
				$this->Cell(15,10,$row['Vertrek'],1,0,'C');
				$this->Cell(20,10,$row['No'],1,0,'C');
				$this->SetFont('Arial','B',9);
			}
			$this->ln();

		//3de rij
		$this->Ln();
		$this->SetFont('Arial','B',9);
		$this->Cell(12,10,'datum',1,0,'C');
		$this->SetFont('Arial','',9);
		$this->Cell(12,10,'datum',1,0,'C');
		$this->Cell(64,10,'',0,0,'C');
		$this->SetFont('Arial','B',9);
		$this->Cell(12,10,'datum',1,0,'C');
		$this->SetFont('Arial','',9);
		$this->Cell(12,10,'datum',1,0,'C');
		$this->Ln();
		$this->Ln();
		$this->SetFont('Arial','B',9);
		$this->Cell(15,10,'Km',1,0,'C');
		$this->Cell(20,10,'Locatie',1,0,'C');
		$this->Cell(18,10,'Aankomst',1,0,'C');
		$this->Cell(15,10,'Vertrek',1,0,'C');
		$this->Cell(20,10,'No',1,0,'C');

		$sql = "SELECT * FROM gegevens WHERE Week = :week And Dag = 'Vrijdag'";
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(':week', $weeknmr, PDO::PARAM_INT);
		$stmt->execute();
		$data = $stmt->fetchAll();
		// echo "text";
		foreach($data as $row) {

			//gegevens
			$this->Ln();
			$this->SetFont('Arial','',9);
			$this->Cell(15,10, $row['Km'] ,1,0,'C');
			$this->Cell(20,10,$row['Locatie'],1,0,'C');
			$this->Cell(18,10,$row['Aankomst'],1,0,'C');
			$this->Cell(15,10,$row['Vertrek'],1,0,'C');
			$this->Cell(20,10,$row['No'],1,0,'C');
			$this->SetFont('Arial','B',9);
			$this->Ln(-10);
			$this->Cell(90,10,'',0,0,'C');
		}
		if ($stmt->rowCount() < 1) {
			$this->Cell(2,10,'',0,0,'C');
		}

			//2de colom
			
			$this->Cell(15,10,'Km',1,0,'C');
			$this->Cell(20,10,'Locatie',1,0,'C');
			$this->Cell(18,10,'Aankomst',1,0,'C');
			$this->Cell(15,10,'Vertrek',1,0,'C');
			$this->Cell(20,10,'No',1,0,'C');
			//gegevens donderdag
			$sql = "SELECT * FROM gegevens WHERE Week = :week And Dag = 'Zaterdag'";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':week', $weeknmr, PDO::PARAM_INT);
			$stmt->execute();
			$data = $stmt->fetchAll();
			// echo "text";
			foreach($data as $row) {
	
				//gegevens
				$this->Ln();
				$this->Cell(90,10,'',0,0,'C');
				$this->SetFont('Arial','',9);
				$this->Cell(15,10, $row['Km'] ,1,0,'C');
				$this->Cell(20,10,$row['Locatie'],1,0,'C');
				$this->Cell(18,10,$row['Aankomst'],1,0,'C');
				$this->Cell(15,10,$row['Vertrek'],1,0,'C');
				$this->Cell(20,10,$row['No'],1,0,'C');
				$this->SetFont('Arial','B',9);
			}
			$this->ln();


	}
}
// Week, Dag, Jaar, Km, Locatie, Aankomst, Vertrek, No
$pdf = new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('P','A4',0);
$pdf->weekJaar();
$pdf->headerTable();

$pdf->Output();