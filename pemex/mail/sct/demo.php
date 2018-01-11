<?php

$nota="La extrema violencia vivida en el país desde hace ya varios años por la actividad del crimen organizado y también por irresponsables acciones de autoridades civiles y militares cometidas en su pretendida lucha contra los criminales y en su ?afán? de mantener el orden (cuya extrema y artera expresión se da en los casos de Tlatlaya e Iguala) hacen cuestionar la vigencia del régimen de derecho en México. Es claro que sin régimen de derecho garantizado los ciudadanos estamos a expensas de cualquier violación a nuestros derechos humanos y civiles, incluida la pérdida de vida pasando por la extorsión, la tortura, el secuestro o cualquier otra atrocidad imaginable. Así, el Estado se ve debilitado, frágil, sujeto a los vaivenes de los cárteles del crimen que actúan abiertamente fuera de la ley y también presa de los poderes fácticos que amparados en el marco de las instituciones imponen las condiciones que a ellos conviene. Un gobierno emanado de tales circunstancias y no legítimamente de la sociedad no puede ejercer apegado a derecho, ni cumplir y hacer cumplir con la Ley, actúa dando palos de ciego contra el crimen organizado y sometido a los interés particulares de los poderes económicos que lo sostienen o peor aún, en convivencia o abierta complicidad con unos yo otros. Esta es hoy nuestra triste realidad en la que no solo nos atemorizan los hechos violentos de Guerrero o el Estado de México sino también otras muchas muestras más de fragilidad institucional por no decir estado fallido como son la errática actuación de la CNDH, la inconsistencia de la PGR (el Procurador Murillo ya se cansó) o la usencia de canales para un diálogo políticos que den salida a la más seria crisis nacional de los últimos años. SUSURROS. Para colmo de males al ejecutivo federal se le ocurrió cancelar la licitación para la construcción del tren rápido México-Querétaro . Las razones no dadas pero si fincadas en la sospecha de conflicto de interés en el concurso legal (www.visionmx.com dio cuenta de ello en un excelente trabajo de Jorge Vega publicado el jueves pasado) pudieran ser suficientes si se fincaran responsabilidades pero no cuando el titular de la SCT, Gerardo Ruíz Esparza, sostiene a los cuatro vientos que todo fue legal, ¿entonces cuáles son las garantías para las empresas que participan y ganan licitaciones? ¿Quién pagará las indemnizaciones a la empresa China a la que le cancelaron su triunfo? Otra vez en duda la vigencia del Estado de Derecho? Como cereza de pastel publicó 'Aristegui Noticias' un reportaje sobre la mansión de la pareja Peña - Rivera que vale más de 7 millones de dólares (más de 90 millones de pesos) pero que ni siquiera está a nombre de alguno de ellos sino de la constructora Higa, una de las asociadas de la constructora China que había ganado el contrato de construcción del tren ligero por 58 mil millones de pesos? Alguna buena explicación habrá de dar el presidente Peña de todo esto, sobre todo ahora que anda por China, primero en la Reunión de la APEC y luego en visita de estado por el gigante asiático. Email: salvadormartinez@visionmx.com";


//$array=Array('Gerardo Ruiz Esparza','Ruiz Esparza','SCT');
$array=Array('Gerardo Ruíz Esparza','Ruíz Esparza','Gerardo Ruiz Esparza','Ruiz Esparza');
try{
echo utf8_decode(EncuentraArreglo($nota,$array));    
} catch (Exception $ex) {
    echo $ex->getMessage();
}


function EncuentraCoincidencias($cadenaOriginal,$valorBuscado){

    preg_match_all("#(.*)\. #U",$cadenaOriginal,$match);

    if(count($match[1])<1) return false;

    for($i=0;$i<count($match[1]);$i++) {

        $posicion = strpos($match[1][$i], $valorBuscado);

        if( $posicion !== false ){
            if( $i == 0 ) return $match[1][$i] . "(...)";
            else if( $i > 0 && $i < count($match[1]) ) return $match[1][$i] . "(...)" ;
            else if( $i == count($match[1]) ) return $match[1][$i];
        }
    }
}


function EncuentraArreglo($cadenaOriginal,$array){
    $cadena=false;
    foreach ($array as $value)
    {
        $cadena=EncuentraCoincidencias($cadenaOriginal,$value);
        if($cadena!==false){
            break;
        }
    }
    if($cadena!==false)
    {
      return $cadena;
    }
    else
    {
      return $cadenaOriginal;
    } 
}
?>
