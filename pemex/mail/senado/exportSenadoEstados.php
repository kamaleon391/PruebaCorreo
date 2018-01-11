<?php

if(isset($_GET['p']) && isset($_GET['f'])){
    include './querysSegob.php';
     // $fecha=base64_decode(base64_decode($_GET['f']));
       $valor=base64_decode(base64_decode($_GET['p']));
       $query=query($valor, $_GET['f']);
      //$tabla=defineFecha($fecha);

    switch ($valor) {
        case 1: // PRIMERAS PLANAS
             $tema="PRIMERAS PLANAS";$subtema=" ";
             ArmaPdf($query,$tema,$subtema);
            break;
        case 2:
             $tema=utf8_decode("COLUMNAS POLÍTICAS");$subtema=" ";
             ArmaPdfColumnas($query,$tema,$subtema);
            break;
        default:
        case 3:
             $tema="COLUMNAS FINANCIERAS";$subtema=" ";
             ArmaPdfColumnas($query,$tema,$subtema);
            break;
        case 4:
             $tema="CARTONES";$subtema=" ";
             ArmaPdfColumnas($query,$tema,$subtema);
            break;
        case 5:
             $tema="SECRETARIO";$subtema=" Parte 1";
             ArmaPdf($query,$tema,$subtema);
            break;
        case 6:
             $tema=" SEGOB ";$subtema=" ";
             ArmaPdf($query,$tema,$subtema);
            break;
        case 7:
             $tema="UNIDAD DE GOBIERNO ";$subtema=" ";
             ArmaPdf($query,$tema,$subtema);
            break;
        case 8:
             $tema="SUB. ENLACE LEGISLATIVO";$subtema=" ";
             ArmaPdf($query,$tema,$subtema);
            break;
        case 9:
             $tema=utf8_decode("UNIDAD PARA EL DESARROLLO POLÍTICO");$subtema=" ";
             ArmaPdf($query,$tema,$subtema);
            break;
        case 10:
             $tema=utf8_decode("SUB. JURIDICO Y DERECHOS HUMANOS");$subtema=" ";
             ArmaPdf($query,$tema,$subtema);
            break;
        case 11:
             $tema=utf8_decode("SUB. POB. MIG. Y ASUNTOS RELIGIOSOS");$subtema=" ";
             ArmaPdf($query,$tema,$subtema);
            break;
        case 12:
             $tema="SUB. NORMATIVIDAD DE MEDIOS";$subtema=" ";
             ArmaPdf($query,$tema,$subtema);
            break;
        case 13:
             $tema="SUB. PREV. Y PART. CIUD";$subtema=" ";
             ArmaPdf($query,$tema,$subtema);
            break;
        case 14:
             $tema=utf8_decode("OFICIALÍA MAYOR");$subtema=" ";
             ArmaPdf($query,$tema,$subtema);
            break;
        case 15:
             $tema=utf8_decode("COORD. GRAL. DE PROTECCIÓN CIVIL");$subtema=" ";
             ArmaPdf($query,$tema,$subtema);
            break;
        case 16:
             $tema=utf8_decode("COM. DIA. PUEB. INDÍGENAS DE MÉXICO");$subtema=" ";
             ArmaPdf($query,$tema,$subtema);
            break;
        case 17:
             $tema=utf8_decode("CNS");$subtema=" ";
             ArmaPdf($query,$tema,$subtema);
            break;
        case 18:
             $tema=utf8_decode("VARIOS");$subtema=" ";
             ArmaPdf($query,$tema,$subtema);
            break;

        /*******Estados******/
        case 19:
             $tema="SECRETARIO - Estados";$subtema=" ";
             ArmaPdf($query,$tema,$subtema);
            break;
        case 20:
             $tema=" SEGOB - Estados";$subtema=" ";
             ArmaPdf($query,$tema,$subtema);
            break;
        case 21:
             $tema="UNIDAD DE GOBIERNO - Estados";$subtema=" ";
             ArmaPdf($query,$tema,$subtema);
            break;
        case 22:
             $tema="SUB. ENLACE LEGISLATIVO - Estados";$subtema=" ";
             ArmaPdf($query,$tema,$subtema);
            break;
        case 23:
             $tema=utf8_decode("UNIDAD PARA EL DESARROLLO POLÍTICO - Estados");$subtema=" ";
             ArmaPdf($query,$tema,$subtema);
            break;
        case 24:
             $tema=utf8_decode("SUB. JURIDICO Y DERECHOS HUMANOS - Estados");$subtema=" ";
             ArmaPdf($query,$tema,$subtema);
            break;
        case 25:
             $tema=utf8_decode("SUB. POB. MIG. Y ASUNTOS RELIGIOSOS - Estados");$subtema=" ";
             ArmaPdf($query,$tema,$subtema);
            break;
        case 26:
             $tema="SUB. NORMATIVIDAD DE MEDIOS - Estados";$subtema=" ";
             ArmaPdf($query,$tema,$subtema);
            break;
        case 27:
             $tema="SUB. PREV. Y PART. CIUD - Estados";$subtema=" ";
             ArmaPdf($query,$tema,$subtema);
            break;
        case 28:
             $tema=utf8_decode("OFICIALÍA MAYOR - Estados");$subtema=" ";
             ArmaPdf($query,$tema,$subtema);
            break;
        case 29:
             $tema=utf8_decode("COORD. GRAL. DE PROTECCIÓN CIVIL - Estados");$subtema=" ";
             ArmaPdf($query,$tema,$subtema);
            break;
        case 30:
             $tema=utf8_decode("COM. DIA. PUEB. INDÍGENAS DE MÉXICO - Estados");$subtema=" ";
             ArmaPdf($query,$tema,$subtema);
            break;
        case 31:
             $tema=utf8_decode("CNS - Estados");$subtema=" ";
             ArmaPdf($query,$tema,$subtema);
            break;
        case 32:
             $tema=utf8_decode("VARIOS - Estados");$subtema=" ";
             ArmaPdf($query,$tema,$subtema);
            break;
        case 33:
             $tema="SECRETARIO";$subtema=" Parte 2 ";
             ArmaPdf($query,$tema,$subtema);  //CDMX
            break;

        case 34:
             $tema="SECRETARIO";$subtema=" Parte 2 ";
             ArmaPdf($query,$tema,$subtema); //Estados
            break;
}

}
else{

}
function ArmaPdf($query,$tema,$subtema){
require_once('../fpdf17/fpdf.php');
require_once('../FPDI-1.4.4/fpdi.php');

$pdf = new FPDI('P','mm','legal');
require '../conexion.php';


    $data=  mysql_query($query);
    if(mysql_affected_rows()>0)
    {
        $i=0;
        $periodico=array();
        $seccion=array();
        $j=0;
        while ($row = mysql_fetch_array($data))
        {
              $variable[$i] = $row['pdf'];
              $periodico[$i] = $row['Periodico'];
              $seccion[$i] = $row['Seccion'];
            $i++;
        }

        //
        $pdf->addPage();

                    //rectangulo GRis ABAJO
                      $pdf->SetFillColor(245,245,245);
                       $pdf->Rect(0, 131, 250, 40, 'F');

                      $pdf->setTextColor();
                      $pdf->SetFont("arial", "B", 25);
                      $pdf->Text(10,156,$tema);
                      $pdf->SetFont("arial", "B", 13);
                      $pdf->setTextColor(255,255,255);
                      $pdf->Text(10,23,"test");

                       $pdf->Image('Logo.jpg',5,100,100);
                     /*   $pdf->SetFont("arial", "", 9);
                      $pdf->setTextColor();
                      $pdf->Text(170,8,$subtema);
         */
                      $pdf->SetFont("arial", "B",15);
                      $pdf->setTextColor();
                      $pdf->Text(130,177,mostrar_fecha_completa(date('Y-m-d')));
        //
        for($j=0;$j<sizeof($periodico);$j++)
        {
            if(file_exists($variable[$j])){
                      $pageCount = $pdf->setSourceFile($variable[$j]);
                      $tplIdx = $pdf->importPage(1);
                      $pdf->addPage();
                      //rectangulo GRis
                      $pdf->SetFillColor(245,245,245);
                       $pdf->Rect(0, 0, 250, 18, 'F');


                      //rentangulo Azul
                      $pdf->SetFillColor(0, 191, 255);
                      $pdf->Rect(0, 10, 140, 15, 'F');


                      $pdf->setTextColor();
                      $pdf->SetFont("arial", "B", 20);
                      $pdf->Text(10,18,strtoupper($periodico[$j]));
                      $pdf->SetFont("arial", "B", 13);
                      $pdf->setTextColor(255,255,255);
                      $pdf->Text(10,23,strtoupper($seccion[$j]));
                      $pdf->SetFont("arial", "B", 9);
                      $pdf->setTextColor();
                      $pdf->SetY(8);
                      $pdf->Cell(0,0,  ($tema).  ($subtema),0,'','R');
                       $pdf->Image('Logo.jpg',5,340,30);
                     /*   $pdf->SetFont("arial", "", 9);
                      $pdf->setTextColor();
                      $pdf->Text(170,8,$subtema);
         */
                      $pdf->SetFont("arial", "B",12);
                      $pdf->setTextColor();
                      $pdf->Text(182,13,date('Y-m-d'));
                      //$pdf->WriteHTML($html);
                      //$pdf->addPage('L'); //landscape
                      $pdf->useTemplate($tplIdx, 30,30,150);
                  }else{ }
        }
        $pdf->Output($tema.$subtema.".pdf", 'D');
    }
    else
    {
        echo "<script>alert('No se encuentran Resultados de ".($tema)."$subtema');</script>";
    }
}

function ArmaPdfColumnas($query,$tema,$subtema){
require_once('../fpdf17/fpdf.php');
require_once('../FPDI-1.4.4/fpdi.php');

$pdf = new FPDI('P','mm','legal');
     require '../conexion.php';


    $data=  mysql_query($query);
    if(mysql_affected_rows()>0)
    {
         $i=0;
         $periodico=array();
         $seccion=array();
         $j=0;
            while ($row = mysql_fetch_array($data))
            {
                 $variable[$i] = $row['pdf'];
                  $periodico[$i] = $row['Periodico'];
                  $seccion[$i] = substr($row['Titulo'], 0, 45);
                $i++;
            }


                    //
        $pdf->addPage();

                    //rectangulo GRis ABAJO
                      $pdf->SetFillColor(245,245,245);
                       $pdf->Rect(0, 131, 250, 40, 'F');




                      $pdf->setTextColor();
                      $pdf->SetFont("arial", "B", 30);
                      $pdf->Text(10,156,$tema);
                      $pdf->SetFont("arial", "B", 13);
                      $pdf->setTextColor(255,255,255);
                      $pdf->Text(10,23,"test");

                       $pdf->Image('Logo.jpg',5,100,100);
                     /*   $pdf->SetFont("arial", "", 9);
                      $pdf->setTextColor();
                      $pdf->Text(170,8,$subtema);
         */
                      $pdf->SetFont("arial", "B",15);
                      $pdf->setTextColor();
                      $pdf->Text(135,177,mostrar_fecha_completa(date('Y-m-d')));
        //





            for($j=0;$j<sizeof($periodico);$j++)
            {
               if(file_exists($variable[$j])){
                     $pageCount = $pdf->setSourceFile($variable[$j]);
                     $tplIdx = $pdf->importPage(1);
                     $pdf->addPage();
                     //rectangulo GRis
                     $pdf->SetFillColor(245,245,245);
                      $pdf->Rect(0, 0, 250, 18, 'F');
                     //rentangulo Azul
                     $pdf->SetFillColor(0, 191, 255);
                     $pdf->Rect(0, 10, 140, 15, 'F');
                     $pdf->setTextColor();
                     $pdf->SetFont("arial", "B", 20);
                     $pdf->Text(10,18,strtoupper($periodico[$j]));
                     $pdf->SetFont("arial", "B", 13);
                     $pdf->setTextColor(255,255,255);
                     $pdf->Text(10,23,strtoupper($seccion[$j]));
                     $pdf->SetFont("arial", "B", 9);
                     $pdf->setTextColor(128);
                     $pdf->Text(150,8,$tema);
                     $pdf->SetFont("arial", "", 9);
                     $pdf->setTextColor();
                     $pdf->Text(170,8,$subtema);
                     $pdf->SetFont("arial", "B",12);
                     $pdf->setTextColor();
                     $pdf->Text(182,13,date('Y-m-d'));
                     $pdf->Image('Logo.jpg',5,340,30);
                     //$pdf->WriteHTML($html);
                     //$pdf->addPage('L'); //landscape
                     $pdf->useTemplate($tplIdx, 20,30,160);
                 }else{ }
                }
    $pdf->Output($tema.$subtema.".pdf", 'D');
    }else{
        echo "<script>alert('No se encuentran Resultados de ".($tema)."$subtema');</script>";
    }


}


function mostrar_fecha_completa($fecha){
    $subfecha = explode("-",$fecha);

    $año=$subfecha[0];
    $mes=$subfecha[1];
    $dia=$subfecha[2];

    $dia2=date( "d", mktime(0,0,0,$mes,$dia,$año));
    $mes2=date( "m", mktime(0,0,0,$mes,$dia,$año));
    $año2=date( "Y", mktime(0,0,0,$mes,$dia,$año));
    $dia_sem=date( "w", mktime(0,0,0,$mes,$dia,$año));

   switch($dia_sem)
   {
       case "0":   // Bloque 1
         $dia_sem3='Domingo';
       break;

       case "1":   // Bloque 1
         $dia_sem3='Lunes';
       break;

       case "2":   // Bloque 1
         $dia_sem3='Martes';
       break;

       case "3":   // Bloque 1
         $dia_sem3='Miercoles';
       break;

       case "4":   // Bloque 1
         $dia_sem3='Jueves';
       break;

       case "5":   // Bloque 1
         $dia_sem3='Viernes';
       break;

       case "6":   // Bloque 1
         $dia_sem3='Sabado';
       break;

      default:   // Bloque 3
    };

    switch($mes2)
    {
        case "1":   // Bloque 1
            $mes3='Enero';
        break;

        case "2":   // Bloque 1
            $mes3='Febrero';
        break;

        case "3":   // Bloque 1
            $mes3='Marzo';
        break;

        case "4":   // Bloque 1
            $mes3='Abril';
        break;

        case "5":   // Bloque 1
            $mes3='Mayo';
        break;

        case "6":   // Bloque 1
            $mes3='Junio';
        break;

        case "7":   // Bloque 1
            $mes3='Julio';
        break;

        case "8":   // Bloque 1
            $mes3='Agosto';
        break;

        case "9":   // Bloque 1
            $mes3='Septiembre';
        break;

        case "10":   // Bloque 1
            $mes3='Octubre';
        break;

        case "11":   // Bloque 1
            $mes3='Noviembre';
        break;

        case "12":   // Bloque 1
            $mes3='Diciembre';
        break;

        default:   // Bloque 3
     break;
  };


$fecha_texto=$dia_sem3.' '.$dia2.' '.'de'.' '.$mes3.' '.'de'.' '.$año2;

return $fecha_texto;
};
?>
