<?php
include "/var/www/external/services/mail/conexion.php";
require_once '/var/www/external/services/mail/fpdf17/fpdf.php';
require_once '/var/www/external/services/mail/FPDI-1.4.4/fpdi.php';

$fecha         = date("Y-m-d");
$_path_portada = 'http://192.168.3.154';

$medios = ['El universal', 'Reforma', 'Milenio', 'La Jornada', 'Excelcior', 'El Sol de México', '24 Horas', 'El Financiero', 'Cronica', 'El Economista'];
$img    = [
    $_path_portada . '/siscap.la/public/Periodicos/El%20Universal/' . $fecha . '/A_1.pdf_fb.jpg',
    $_path_portada . '/siscap.la/public/Periodicos/El%20Reforma/' . $fecha . '/A_1.pdf_fb.jpg',
    $_path_portada . '/siscap.la/public/Periodicos/El%20milenio%20Nacional/' . $fecha . '/1_A.pdf_fb.jpg',
    $_path_portada . '/siscap.la/public/Periodicos/La%20Jornada%20De%20Mexico/' . $fecha . '/1_A.pdf_fb.jpg',
    $_path_portada . '/siscap.la/public/Periodicos/Excelsior/' . $fecha . '/A_1.pdf_fb.jpg',
    $_path_portada . '/siscap.la/public/Periodicos/el%20sol%20de%20mexico/' . $fecha . '/1_A.pdf_fb.jpg',
    $_path_portada . '/siscap.la/public/Periodicos/Veinticuatro%20Horas/' . $fecha . '/A_1.pdf_fb.jpg',
    $_path_portada . '/siscap.la/public/Periodicos/Financiero/' . $fecha . '/1_A.pdf_fb.jpg',
    $_path_portada . '/siscap.la/public/Periodicos/La%20cronica/' . $fecha . '/1_A.pdf_fb.jpg',
    $_path_portada . '/siscap.la/public/Periodicos/El%20Economista/' . $fecha . '/1_A.pdf_fb.jpg',
];
$testigo = [
    $_path_portada . '/siscap.la/public/Periodicos/El%20Universal/' . $fecha . '/A_1.pdf',
    $_path_portada . '/siscap.la/public/Periodicos/El%20Reforma/' . $fecha . '/A_1.pdf',
    $_path_portada . '/siscap.la/public/Periodicos/El%20milenio%20Nacional/' . $fecha . '/1_A.pdf',
    $_path_portada . '/siscap.la/public/Periodicos/La%20Jornada%20De%20Mexico/' . $fecha . '/1_A.pdf',
    $_path_portada . '/siscap.la/public/Periodicos/Excelsior/' . $fecha . '/A_1.pdf',
    $_path_portada . '/siscap.la/public/Periodicos/el%20sol%20de%20mexico/' . $fecha . '/1_A.pdf',
    $_path_portada . '/siscap.la/public/Periodicos/Veinticuatro%20Horas/' . $fecha . '/A_1.pdf',
    $_path_portada . '/siscap.la/public/Periodicos/Financiero/' . $fecha . '/1_A.pdf',
    $_path_portada . '/siscap.la/public/Periodicos/La%20cronica/' . $fecha . '/1_A.pdf',
    $_path_portada . '/siscap.la/public/Periodicos/El%20Economista/' . $fecha . '/1_A.pdf',
];
$xCell = 30;
$yCell = 5;
$xImg  = 15;
$yImg  = 10;
$cont  = 0;

//echo '<img src="192.168.3.154/siscap.la/public/Periodicos/El Universal/'.$fecha.'/A_1.pdf_fb.jpg"></img>';
$pdf = new FPDI('P', 'mm', 'legal');
$pdf->AddPage();
$pdf->SetFont('Arial', '', 8);
$pdf->Image('../imgpgr/PGR2a.png', 0, 0, 220, 10);
$pdf->Image('../imgpgr/PGR2b.png', 0, 330, 220, 30);
$pdf->setXY(190, 3);

$pdf->SetFont('Arial', '', 10);
for ($i = 0; $i < 10; $i++) {
    if ($i % 2 == 0) {
        $pdf->SetXY($xCell, $yCell);
        //$pdf->Cell(25, 20, utf8_decode($medios[$i]), 0, 0, 'C');
        $pdf->Image($img[$i], $xImg, $yImg, 80, 100, 'JPG', $testigo[$i]);
        $xCell = 150;
        $xImg  = 120;
    } else {
        $pdf->SetXY($xCell, $yCell);
        //$pdf->Cell(25, 20, utf8_decode($medios[$i]), 0, 0, 'C');
        $pdf->Image($img[$i], $xImg, $yImg, 80, 100, 'JPG', $testigo[$i]);
        $xCell = 30;
        $xImg  = 10;
        $yCell = $yCell + 105;
        $yImg  = $yImg + 105;
        if ($i == 5) {
            $pdf->AddPage();
            $pdf->SetFont('Arial', '', 8);
            $pdf->Image('../imgpgr/PGR2a.png', 0, 0, 220, 10);
            $pdf->Image('../imgpgr/PGR2b.png', 0, 330, 220, 30);
            $yCell = 5;
            $yImg  = 10;
        }

    }
}

$pdf->Output();
