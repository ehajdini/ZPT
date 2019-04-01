<?php
/**
 * Created by PhpStorm.
 * User: german
 * Date: 17-06-06
 * Time: 6.45.MD
 */
/**
 * Created by PhpStorm.
 * User: Planet
 * Date: 1/30/2017
 * Time: 11:42 PM
 */
session_start();
include('DB.php');
require('fpdf/fpdf.php');
$database = new DB();
if(isset($_SESSION['name']) && $_SESSION['surname']) {
    $result = $database->runQuery("SELECT * FROM jobseeker,assistance where assistance.money>0 AND assistance.jobseeker_id=jobseeker.ID");


    $pdf = new FPDF('P', 'mm', 'A4');
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Image('images/logo.png', 10, 6, 30);
    $pdf->SetY($pdf->GetY() + 40);
    $pdf->Ln();
    $pdf->Text(10, 30, "Zyra e Punes Tirane");
    $pdf->Text(10, 35, "Drejtoria e Financave");
    $pdf->Text(10, 40, date('d-m-Y') . " " . date("H:m:s"));

    $header = $database->runQuery("SELECT UCASE(`COLUMN_NAME`) 
FROM `INFORMATION_SCHEMA`.`COLUMNS` 
WHERE `TABLE_SCHEMA`='web16_ehajdini14' 
AND `TABLE_NAME`='jobseeker'
and `COLUMN_NAME` in ('ID','Name','Surname','Number','Registerdate')");

    foreach ($header as $heading) {
        foreach ($heading as $column_heading)
            $pdf->Cell(30, 10, $column_heading, 1);
    }
    $pdf->Cell(40, 10, "Financial Assistance", 1);


    foreach ($result as $row) {
        $pdf->Ln();
        $pdf->Cell(30, 10, $row['ID'], 1);
        $pdf->Cell(30, 10, $row['Name'], 1);
        $pdf->Cell(30, 10, $row['Surname'], 1);
        $pdf->Cell(30, 10, $row['Registerdate'], 1);
        $pdf->Cell(30, 10, $row['Number'], 1);
        $pdf->Cell(40, 10, $row['money']." lek", 1);

    }
    $pdf->Text(160, 250, "Drejtoria e Financave");
    $pdf->Text(160, 255, $_SESSION['name']." ".$_SESSION['surname']);

    $pdf->Output();
}