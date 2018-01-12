<?php

if(isset($_GET['p']) && isset($_GET['f'])){
    include 'C:\xampp\htdocs\external\mail\pemex\querysPEMEX.php';
      $fecha=base64_decode(base64_decode($_GET['f']));
       $valor=base64_decode(base64_decode($_GET['p']));
       $query=query($valor, $_GET['f']);
      $tabla=defineFecha($fecha);

    switch ($valor) {
        case 1: // PRIMERAS PLANAS
             $tema="PRIMERAS PLANAS";$subtema=" ";
             ArmaPdf($query,$tema,$subtema);
        break;

        case 2:
             $tema=utf8_decode("COLUMNAS POLÍTICAS");$subtema=" ";
             ArmaPdfColumnas($query,$tema,$subtema);
        break;

        case 3:
             $tema="COLUMNAS FINANCIERAS";$subtema=" ";
             ArmaPdfColumnas($query,$tema,$subtema);
        break;

        case 4:
             $tema="CARTONES";$subtema=" ";
             ArmaPdfColumnas($query,$tema,$subtema);
        break;

        case 5:
             $tema=utf8_decode("Director General - Estados");$subtema=" ";
             ArmaPdf($query,$tema,$subtema);
        break;

        case 6: //PEMEX
             $tema=utf8_decode("PEMEX - Estados");$subtema="";
             ArmaPdf($query,$tema,$subtema);
        break;

        case 7:
             $tema=utf8_decode("Admon. Central - Estados");$subtema=" ";
             ArmaPdf($query,$tema,$subtema);
        break;

        case 8:
             $tema=utf8_decode("Ref. Energética - Estados");$subtema=" ";
             ArmaPdf($query,$tema,$subtema);
        break;
        
        case 9:
             $tema=utf8_decode("Instalaciones - Estados");$subtema=" ";
             ArmaPdf($query,$tema,$subtema);
        break;
        
        case 10: //Petroleo - Estados
             $tema=utf8_decode("Petróleo - Estados");$subtema=" ";
             ArmaPdf($query,$tema,$subtema);
        break;
        
        case 11: //GAS - Estados
             $tema=utf8_decode("Gas - Estados");$subtema=" ";
             ArmaPdf($query,$tema,$subtema);
        break;
        
        case 12: //Petroquímico - Estados
             $tema=utf8_decode("Petroquímica - Estados");$subtema=" ";
             ArmaPdf($query,$tema,$subtema);
        break;
        
        case 13: //Gasolina - Estados
             $tema=utf8_decode("Gasolina - Estados");$subtema=" ";
             ArmaPdf($query,$tema,$subtema);
        break;
        
        case 14: //Reforma Laboral - Estados
             $tema=utf8_decode("Reforma Laboral - Estados");$subtema=" ";
             ArmaPdf($query,$tema,$subtema);
        break;
        
        case 15: //Reforma Laboral - Estados
             $tema=utf8_decode("Sindicato - Estados");$subtema=" ";
             ArmaPdf($query,$tema,$subtema);
        break;
        
        case 16: //Reforma Laboral - Estados
             $tema=utf8_decode("Refinación - Estados");$subtema=" ";
             ArmaPdf($query,$tema,$subtema);
        break;
        
        case 17: //Seguridad Industrial - Estados
             $tema=utf8_decode("Seguridad Industrial - Estados");$subtema=" ";
             ArmaPdf($query,$tema,$subtema);
        break;
}

}
else{

}
function ArmaPdf($query,$tema,$subtema){
require_once('..\fpdf17\fpdf.php');
require_once('..\FPDI-1.4.4\fpdi.php');

$pdf = new FPDI('P','mm','A4');
require '..\conexion.php';


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

                      //$pdf->Image('logopdf.png',5,100,100);
                      $pdf->SetFont("arial", "B",15);
                      $pdf->setTextColor();
                      $pdf->text(120,177,mostrar_fecha_completa($_GET['f']));
        //
        for($j=0;$j<sizeof($periodico);$j++)
        {
            if(file_exists($variable[$j])){
                      $pageCount = $pdf->setSourceFile($variable[$j]);
                      $tplIdx = $pdf->importPage(1);
                      $pdf->addPage();
                      //rectangulo GRis
                      $pdf->SetFillColor(245,245,245);
                      $pdf->Rect(0, 0, 250, 12, 'F');


                      //rentangulo Azul
                      $pdf->SetFillColor(0, 191, 255);
                      $pdf->Rect(0, 0, 140, 12, 'F');


                      $pdf->setTextColor();
                      $pdf->SetFont("arial", "B", 18);
                      $pdf->Text(10,7,strtoupper($periodico[$j]));
                      $pdf->SetFont("arial", "B", 11);
                      $pdf->setTextColor(255,255,255);
                      $pdf->Text(10,11,strtoupper($seccion[$j]));
                      $pdf->SetFont("arial", "B", 9);
                      $pdf->setTextColor();
                      $pdf->SetY(4);
                      $pdf->Cell(0,0,  ($tema).  ($subtema),0,'','R');
                       $pdf->Image('logopdf.png',5,340,30);
                     /*   $pdf->SetFont("arial", "", 9);
                      $pdf->setTextColor();
                      $pdf->Text(170,8,$subtema);
         */
                      $pdf->SetFont("arial", "B",10);
                      $pdf->setTextColor();
                      $pdf->Text(150,9,mostrar_fecha_completa($_GET['f']));
                      //$pdf->WriteHTML($html);
                      //$pdf->addPage('L'); //landscape
                      $pdf->useTemplate($tplIdx, 20,12,150);
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
require_once('..\fpdf17\fpdf.php');
require_once('..\FPDI-1.4.4\fpdi.php');

$pdf = new FPDI('P','mm','legal');
     require '..\conexion.php';


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

                       $pdf->Image('Logo.png',5,100,100);
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
                     $pdf->Image('Logo.png',5,340,30);
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
         $dia_sem3=utf8_decode('Miércoles');
       break;

       case "4":   // Bloque 1
         $dia_sem3='Jueves';
       break;

       case "5":   // Bloque 1
         $dia_sem3='Viernes';
       break;

       case "6":   // Bloque 1
         $dia_sem3=utf8_decode('Sábado');
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
