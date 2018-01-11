<?php

$estados = array(1 => 'Aguascalientes',
    2 => 'Baja California',
    3 => 'Baja California Sur',
    4 => 'Campeche',
    5 => 'Coahuila',
    6 => 'Colima',
    7 => 'Chiapas',
    8 => 'Chihuahua',
    9 => 'Distrito Federal',
    10 => 'Durango',
    11 => 'Guanajuato',
    12 => 'Guerrero',
    13 => 'Hidalgo',
    14 => 'Jalisco',
    15 => 'Estado de México',
    16 => 'Michoacan',
    17 => 'Morelos',
    18 => 'Nayarit',
    19 => 'Nuevo Leon',
    20 => 'Oaxaca',
    21 => 'Puebla',
    22 => 'Queretaro',
    23 => 'Quintana Roo',
    24 => 'San Luis Potosi',
    25 => 'Sinaloa',
    26 => 'Sonora',
    27 => 'Tabasco',
    28 => 'Tamaulipas',
    29 => 'Tlaxcala',
    30 => 'Veracruz',
    31 => 'Yucatan',
    32 => 'Zacatecas');

if (isset($_GET['p']) && isset($_GET['f'])) {
    include 'querysCONADIC.php';
    // $fecha=base64_decode(base64_decode($_GET['f']));
    $state = $_GET['estado'];
    $valor = base64_decode(base64_decode($_GET['p']));
    $query = query($valor, $_GET['f'], $state);
    //$query = utf8_decode($query);
    switch ($valor) {
        case 1:
            $tema = utf8_decode("Primeras Planas DF");
            $subtema = " ";
            ArmaPdf($query, $tema, $subtema);
            break;
        case 2:
            $tema = utf8_decode("Columnas Politicas");
            $subtema = " ";
            ArmaPdf($query, $tema, $subtema);
            break;
        case 3:
            $tema = utf8_decode("Columnas Financieras");
            $subtema = " ";
            ArmaPdf($query, $tema, $subtema);
            break;
        case 4:
            $tema = utf8_decode("Cartones DF");
            $subtema = " ";
            ArmaPdf($query, $tema, $subtema);
            break;

        case 5: // PRIMERAS PLANAS
            $tema = utf8_decode("Manuel Mondragón y Kalb - DF");
            $subtema = " ";
            ArmaPdf($query, $tema, $subtema);
            break;
        case 6:
            $tema = utf8_decode("CONADIC - DF");
            $subtema = " ";
            ArmaPdf($query, $tema, $subtema);
            break;
        case 7:
            $tema = utf8_decode("Marihuana - DF");
            $subtema = " ";
            ArmaPdf($query, $tema, $subtema);
            break;
        case 8:
            $tema = utf8_decode("Tabaco - DF");
            $subtema = " ";
            ArmaPdf($query, $tema, $subtema);
            break;
        case 9:
            $tema = utf8_decode("Alcohol - DF");
            $subtema = " ";
            ArmaPdf($query, $tema, $subtema);
            break;
        case 10:
            $tema = utf8_decode("Drogas y Adicciones - DF");
            $subtema = " ";
            ArmaPdf($query, $tema, $subtema);
            break;
        case 11:
            $tema = utf8_decode("Secretaría de Salud - DF");
            $subtema = " ";
            ArmaPdf($query, $tema, $subtema);
            break;
        case 12:
            $tema = utf8_decode("Mercedes Juan López - DF");
            $subtema = " ";
            ArmaPdf($query, $tema, $subtema);
            break;
        case 13:
            $tema = utf8_decode("COFEPRIS - DF");
            $subtema = " ";
            ArmaPdf($query, $tema, $subtema);
            break;
        case 14:
            $tema = utf8_decode("Centros de Integración Juvenil - DF");
            $subtema = " ";
            ArmaPdf($query, $tema, $subtema);
            break;
        case 15:
            $tema = utf8_decode("Presidente EPN - DF");
            $subtema = " ";
            ArmaPdf($query, $tema, $subtema);
            break;
        case 16:
            $tema = utf8_decode("Gobierno de la República - DF");
            $subtema = " ";
            ArmaPdf($query, $tema, $subtema);
            break;
        case 17:
            $tema = utf8_decode("Cámara de Diputados - DF");
            $subtema = " ";
            ArmaPdf($query, $tema, $subtema);
            break;
        case 18:
            $tema = utf8_decode("Cámara de Senadores - DF");
            $subtema = " ";
            ArmaPdf($query, $tema, $subtema);
            break;
        case 19: // PRIMERAS PLANAS
            $tema = utf8_decode("Manuel Mondragón y Kalb - " . $estados[$state]);
            $subtema = " ";
            ArmaPdf($query, $tema, $subtema);
            break;
        case 20:
            $tema = utf8_decode("CONADIC - " . $estados[$state]);
            $subtema = " ";
            ArmaPdf($query, $tema, $subtema);
            break;
        case 21:
            $tema = utf8_decode("Marihuana - " . $estados[$state]);
            $subtema = " ";
            ArmaPdf($query, $tema, $subtema);
            break;
        case 22:
            $tema = utf8_decode("Tabaco - " . $estados[$state]);
            $subtema = " ";
            ArmaPdf($query, $tema, $subtema);
            break;
        case 23:
            $tema = utf8_decode("Alcohol - " . $estados[$state]);
            $subtema = " ";
            ArmaPdf($query, $tema, $subtema);
            break;
        case 24:
            $tema = utf8_decode("Drogas y Adicciones - " . $estados[$state]);
            $subtema = " ";
            ArmaPdf($query, $tema, $subtema);
            break;
        case 25:
            $tema = utf8_decode("Secretaría de Salud - " . $estados[$state]);
            $subtema = " ";
            ArmaPdf($query, $tema, $subtema);
            break;
        case 26:
            $tema = utf8_decode("Mercedes Juan López - " . $estados[$state]);
            $subtema = " ";
            ArmaPdf($query, $tema, $subtema);
            break;
        case 27:
            $tema = utf8_decode("COFEPRIS - " . $estados[$state]);
            $subtema = " ";
            ArmaPdf($query, $tema, $subtema);
            break;
        case 28:
            $tema = utf8_decode("Centros de Integración Juvenil - " . $estados[$state]);
            $subtema = " ";
            ArmaPdf($query, $tema, $subtema);
            break;
        case 29:
            $tema = utf8_decode("Presidente EPN - " . $estados[$state]);
            $subtema = " ";
            ArmaPdf($query, $tema, $subtema);
            break;
        case 30:
            $tema = utf8_decode("Gobierno de la República - " . $estados[$state]);
            $subtema = " ";
            ArmaPdf($query, $tema, $subtema);
            break;
        case 31:
            $tema = utf8_decode("Cámara de Diputados - " . $estados[$state]);
            $subtema = " ";
            ArmaPdf($query, $tema, $subtema);
            break;
        case 32:
            $tema = utf8_decode("Cámara de Senadores - " . $estados[$state]);
            $subtema = " ";
            ArmaPdf($query, $tema, $subtema);
            break;

    }
}

function ArmaPdf($query, $tema, $subtema)
{

    require_once '../fpdf17/fpdf.php';
    require_once '../FPDI-1.4.4/fpdi.php';
    $pdf = new FPDI('P', 'mm', 'legal');
    require '../conexion.php';

    $data = mysql_query($query);
    if (mysql_affected_rows() > 0) {
        $i = 0; //Contador de Paginas
        $periodico = array();
        $seccion = array();
        $estados = array();
        $j = 0;
        while ($row = mysql_fetch_array($data)) {
            $variable[$i] = $row['pdf'];
            $periodico[$i] = $row['periodico'];
            $seccion[$i] = $row['seccion'];
            $estados[$i] = $row['Estado'];
            $i++;
        }

        $pdf->addPage();
        //Recuadro Gris Inferior
        $pdf->SetFillColor(245, 245, 245);
        $pdf->Rect(0, 131, 250, 40, 'F');
        $pdf->setTextColor();
        $pdf->SetFont("arial", "B", 25);
        $pdf->Text(10, 156, $tema . " " . $subtema);
        $pdf->SetFont("arial", "B", 13);
        $pdf->setTextColor(255, 255, 255);
        //$pdf->Text(10,23,"test");

        $pdf->Image('logoGA2.png', 5, 100, 100);
        $pdf->SetFont("arial", "B", 15);
        $pdf->setTextColor();
        $pdf->Text(130, 177, mostrar_fecha_completa(date('Y-m-d')));
        //
        for ($j = 0; $j < sizeof($periodico); $j++) {
            if (file_exists($variable[$j])) {
                $pageCount = $pdf->setSourceFile($variable[$j]);
                $tplIdx = $pdf->importPage(1);
                $pdf->addPage();
                //rectangulo GRis
                $pdf->SetFillColor(245, 245, 245);
                $pdf->Rect(0, 0, 250, 18, 'F');

                //rentangulo Tinto
                $pdf->SetFillColor(157, 22, 46);
                $pdf->Rect(0, 10, 140, 15, 'F');

                $pdf->setTextColor();
                $pdf->SetFont("arial", "B", 18);
                $pdf->Text(10, 18, $estados[$j] . " | " . strtoupper($periodico[$j]));
                $pdf->SetFont("arial", "B", 13);
                $pdf->setTextColor(255, 255, 255);
                $pdf->Text(10, 23, strtoupper($seccion[$j]));
                $pdf->SetFont("arial", "B", 9);
                $pdf->setTextColor();
                $pdf->Text(150, 8, $tema);
                $pdf->Image('logoGA2.png', 5, 340, 30);
                $pdf->SetFont("arial", "B", 12);
                $pdf->setTextColor();
                $pdf->Text(150, 13, mostrar_fecha_completa(date('Y-m-d')));
                //$pdf->WriteHTML($html);
                //$pdf->addPage('L'); //landscape
                $pdf->useTemplate($tplIdx, 30, 30, 150);
            } else {
                $pdf->addPage();
                $pdf->setTextColor();
                $pdf->SetFont("arial", "B", 10);
                $pdf->Text(10, 156, "No se Encontro : " . $variable[$j]);
            }
        }
        $pdf->Output($tema . $subtema . ".pdf", 'D');
    } else {

        echo "<script>alert('No se encuentran Resultados de " . utf8_decode($tema) . "$subtema');</script>";

        echo "<br><br>" . mysql_error();
    }
    $periodico = array();
    $seccion = array();
    $estados = array();
    mysql_close();

}
function ArmaPdfColumnas($query, $tema, $subtema)
{
    require_once '../fpdf17/fpdf.php';
    require_once '../FPDI-1.4.4/fpdi.php';

    $pdf = new FPDI('P', 'mm', 'legal');
    require '../conexion.php';

    $data = mysql_query($query);
    if (mysql_affected_rows() > 0) {
        $i = 0;
        $periodico = array();
        $seccion = array();
        $j = 0;
        while ($row = mysql_fetch_array($data)) {
            $variable[$i] = $row['pdf'];
            $periodico[$i] = $row['periodico'];
            $seccion[$i] = substr($row['Titulo'], 0, 45);
            $estados[$i] = $row['Estado'];
            $i++;
        }

        //
        $pdf->addPage();
        $pdf->SetFillColor(245, 245, 245);
        $pdf->Rect(0, 131, 250, 40, 'F');
        $pdf->setTextColor();
        $pdf->SetFont("arial", "B", 25);
        $pdf->Text(10, 156, $tema);
        $pdf->SetFont("arial", "B", 13);
        $pdf->setTextColor(255, 255, 255);
        $pdf->Text(10, 23, "test");

        $pdf->Image('logoGA2.png', 5, 100, 100);
        $pdf->SetFont("arial", "B", 15);
        $pdf->setTextColor();
        $pdf->Text(130, 177, mostrar_fecha_completa(date('Y-m-d')));

        for ($j = 0; $j < sizeof($periodico); $j++) {
            if (file_exists($variable[$j])) {
                $pageCount = $pdf->setSourceFile($variable[$j]);
                $tplIdx = $pdf->importPage(1);
                $pdf->addPage();
                //rectangulo GRis
                $pdf->SetFillColor(245, 245, 245);
                $pdf->Rect(0, 0, 250, 18, 'F');
                //rentangulo Azul
                $pdf->SetFillColor(0, 191, 255);
                $pdf->Rect(0, 10, 140, 15, 'F');
                $pdf->setTextColor();
                $pdf->SetFont("arial", "B", 20);
                $pdf->Text(10, 18, $estados[$j] . " | " . strtoupper($periodico[$j]));
                $pdf->SetFont("arial", "B", 13);
                $pdf->setTextColor(255, 255, 255);
                $pdf->Text(10, 23, strtoupper($seccion[$j]));
                $pdf->SetFont("arial", "B", 9);
                $pdf->setTextColor(128);
                $pdf->Text(150, 8, $tema);
                $pdf->SetFont("arial", "", 9);
                $pdf->setTextColor();
                $pdf->Text(170, 8, $subtema);
                $pdf->SetFont("arial", "B", 12);
                $pdf->setTextColor();
                $pdf->Text(182, 13, date('Y-m-d'));
                $pdf->Image('logoGA2.png', 5, 340, 30);
                //$pdf->WriteHTML($html);
                //$pdf->addPage('L'); //landscape
                $pdf->useTemplate($tplIdx, 20, 30, 160);
            } else {
                $pdf->addPage();
                $pdf->setTextColor();
                $pdf->SetFont("arial", "B", 10);
                $pdf->Text(10, 156, "No se Encontro : " . $variable[$j]);
            }
        }
        $pdf->Output($tema . $subtema . ".pdf", 'D');
    } else {
        /*
        $pdf->addPage();
        //rectangulo GRis
        $pdf->SetFillColor(245,245,245);
        $pdf->Rect(0, 0, 250, 50, 'F');
        $pdf->setTextColor();
        $pdf->SetFont("arial", "B", 30);
        $pdf->Text(10,180,strtoupper("NO SE ENCONTRARON RESULTADOS"));
        $pdf->Image('salud/logopdf.png',5,10,80);
        $pdf->Output(utf8_decode($tema).$subtema.".pdf", 'D');   */

        echo "<script>alert('No se encuentran Resultados de " . utf8_decode($tema) . "$subtema');</script>";
    }

}
function mostrar_fecha_completa($fecha)
{
    $subfecha = explode("-", $fecha);

    $año = $subfecha[0];
    $mes = $subfecha[1];
    $dia = $subfecha[2];

    $dia2 = date("d", mktime(0, 0, 0, $mes, $dia, $año));
    $mes2 = date("m", mktime(0, 0, 0, $mes, $dia, $año));
    $año2 = date("Y", mktime(0, 0, 0, $mes, $dia, $año));
    $dia_sem = date("w", mktime(0, 0, 0, $mes, $dia, $año));

    switch ($dia_sem) {
        case "0": // Bloque 1
            $dia_sem3 = 'Domingo';
            break;

        case "1": // Bloque 1
            $dia_sem3 = 'Lunes';
            break;

        case "2": // Bloque 1
            $dia_sem3 = 'Martes';
            break;

        case "3": // Bloque 1
            $dia_sem3 = 'Miercoles';
            break;

        case "4": // Bloque 1
            $dia_sem3 = 'Jueves';
            break;

        case "5": // Bloque 1
            $dia_sem3 = 'Viernes';
            break;

        case "6": // Bloque 1
            $dia_sem3 = 'Sabado';
            break;

        default: // Bloque 3
    };

    switch ($mes2) {
        case "1": // Bloque 1
            $mes3 = 'Enero';
            break;

        case "2": // Bloque 1
            $mes3 = 'Febrero';
            break;

        case "3": // Bloque 1
            $mes3 = 'Marzo';
            break;

        case "4": // Bloque 1
            $mes3 = 'Abril';
            break;

        case "5": // Bloque 1
            $mes3 = 'Mayo';
            break;

        case "6": // Bloque 1
            $mes3 = 'Junio';
            break;

        case "7": // Bloque 1
            $mes3 = 'Julio';
            break;

        case "8": // Bloque 1
            $mes3 = 'Agosto';
            break;

        case "9": // Bloque 1
            $mes3 = 'Septiembre';
            break;

        case "10": // Bloque 1
            $mes3 = 'Octubre';
            break;

        case "11": // Bloque 1
            $mes3 = 'Noviembre';
            break;

        case "12": // Bloque 1
            $mes3 = 'Diciembre';
            break;

        default: // Bloque 3
            break;
    };

    $fecha_texto = $dia_sem3 . ' ' . $dia2 . ' ' . 'de' . ' ' . $mes3 . ' ' . 'de' . ' ' . $año2;

    return $fecha_texto;
};
