<?php
//require "/var/www/external/mail/conexion.php";
require "/var/www/external/services/mail/conexion.php";
if(isset($_GET['idNota']))
{
    $idNota = $_GET['idNota'];

    $queryCoords = "SELECT 
                        n.Coords,
                        CONCAT('/Periodicos/',p.Nombre,'/',n.Fecha,'/',n.NumeroPagina,'.jpg') AS 'jpg'
                    FROM noticiasDia n,periodicos p
                    WHERE n.idEditorial = ".$idNota." AND
                        n.Periodico = p.idPeriodico";

    $result = mysql_fetch_row(mysql_query($queryCoords));
    $coordenadas = json_decode($result[0]);


    $img = "/var/www".$result[1];

    $contador = 1;

    header("Content-type: image/png");

    $imagen     = imagecreatefromjpeg($img);
    $tam = getimagesize($img);
    $ancho = $tam[0];
    $alto = $tam[1];


    //Ancho de imagen quitando ancho de bordes
    $separador = 1;
    $ancho -= $separador * 9;

    //Alto de imagen quitando ancho de bordes
    $alto -= $separador * 9;

    $cuadritoAncho = $ancho / 10;
    $cuadritoAlto = $alto / 10;
    //$altoRect=1120;


    $x = 0;
    $y = 710;

    $x1 = 0;
    $x2 = $cuadritoAncho;
    $y1 = 0;
    $y2 = $cuadritoAlto;

    $fondoGris = imagecolorallocatealpha($imagen, 0, 0, 0,75);

    //Segun los cuadros elegidos en las coordenadas, se recorre un grid de 10x10 pintando las casillas que no esten seleccionadas
    while($contador<=100)
    {   
        if(!in_array($contador, $coordenadas))
        {
            imagefilledrectangle($imagen, $x1, $y1, $x2, $y2, $fondoGris);
        }
        if(($contador%10)==0)
        {
            $x1 = 0;
            $x2 = $cuadritoAncho;
            
            $y2 += $cuadritoAlto + $separador;
            $y1 += $cuadritoAlto + $separador;
        }
        else
        {
            $x2 += $cuadritoAncho + $separador;
            $x1 += $cuadritoAncho + $separador;    
        }    
        $contador++;
    }

    try {
     imagejpeg($imagen);  
     imagedestroy($imagen);
    } catch (Exception $ex) {
      echo $ex->getMessage();   
    }

}
else
{
    echo "Se requieren mas parametros";
}



?>