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
    $result = $database->runQuery("SELECT id,name,surname,salary FROM staff");


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
AND `TABLE_NAME`='staff'
and `COLUMN_NAME` in ('id','name','surname','salary')");

    foreach ($header as $heading) {
        foreach ($heading as $column_heading)
            $pdf->Cell(25, 10, $column_heading, 1);
    }
    $pdf->Cell(20, 10, "1.7%", 1);
    $pdf->Cell(20, 10, "9.5%", 1);
    $pdf->Cell(20, 10, "1.7%", 1);
    $pdf->Cell(20, 10, "15%", 1);
    $pdf->Cell(15, 10, "TAP", 1);

    foreach ($result as $row) {
        if ($row['salary'] <= 30000) $tap = 0;
        if ($row['salary'] >= 30000 && $row['salary'] <= 130000) $tap = 0.13 * $row['salary'];
        else if ($row['salary'] > 130000) $tap = 0.23 * $row['salary'];
        $pdf->Ln();
        $pdf->Cell(25, 10, $row['id'], 1);
        $pdf->Cell(25, 10, $row['name'], 1);
        $pdf->Cell(25, 10, $row['surname'], 1);
        $pdf->Cell(25, 10, $row['salary'], 1);
        $pdf->Cell(20, 10, $row['salary'] * 0.017, 1);
        $pdf->Cell(20, 10, $row['salary'] * 0.095, 1);
        $pdf->Cell(20, 10, $row['salary'] * 0.017, 1);
        $pdf->Cell(20, 10, $row['salary'] * 0.15, 1);
        $pdf->Cell(15, 10, $tap, 1);
    }
    $pdf->Text(160, 250, "Drejtoria e Financave");
    $pdf->Text(160, 255, $_SESSION['name']." ".$_SESSION['surname']);

    $pdf->Output();
}