<?php


/*
$tam=getimagesize("1_A.pdf.jpg");
$ancho=$tam[0];
$alto=$tam[1];
*/

header("Content-type: image/png");
//$im     = imagecreatefrompng("img.png");
$imagen     = imagecreatefromjpeg("1_A.pdf.jpg");
$tam=getimagesize("1_A.pdf.jpg");
$ancho=$tam[0];
$alto=$tam[1];

//$imagen=  imagecreatetruecolor($ancho, $alto);
//imagecolorallocate($imagen, 224, 224, 224);

$anchoRect=$ancho;
$altoRect=1120;


$x=0;
$y=710;

$fondoGris = imagecolorallocatealpha($imagen, 0, 0, 0,40);
imagefilledrectangle($imagen, 0, 0, $ancho, $y, $fondoGris);//cuadroSuperior


//$fondoNota = imagecolorallocatealpha($imagen, 0, 0, 0,50);//NEGRO ALPHA
//imagefilledrectangle($imagen, $x, $y, $anchoRect, $altoRect, $fondoNota);


$fondo = imagecolorallocatealpha($imagen, 0, 0, 0,40);
//imagefilledrectangle($imagen, 0, $y+1120, $ancho, $y+$altoRect+1250, $fondo);//Cuadro Inferior
imagefilledrectangle($imagen, 0, $y+$altoRect, $ancho, $alto, $fondo);//Cuadro Inferior


try {
 imagejpeg($imagen);  
 imagedestroy($imagen);
} catch (Exception $ex) {
  echo $ex->getMessage();   
}
 
//imagedestroy($im);

?>