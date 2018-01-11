function textMatch($cadena,$criterio) {

    try {

        // Salida
        $output = "";

        // Arreglo temporal
        $tmp_output = array();

        // Separacion de parrafos
        preg_match_all("#(.*)\.#U",$cadena,$multiMatch);

        if(count($multiMatch[1])>1) {
            for ($i=0; $i < count($multiMatch[1]); $i++) {
                $tmp_text = "";
                for ($y=0; $y < count($criterio); $y++) { 
                    $match = preg_match("/".$criterio[$y]."/i",preg_quote($multiMatch[1][$i]));
                    if($match===1) {
                        if($tmp_text!='') $tmp_text = preg_replace("/".$criterio[$y]."/i", "<strong>".$criterio[$y]."</strong>", $tmp_text);
                        else $tmp_text = preg_replace("/".$criterio[$y]."/i", "<strong>".$criterio[$y]."</strong>", $multiMatch[1][$i]);
                    }
                }
                if($tmp_text!='') $tmp_output[] = $tmp_text . ".";
            }
            if(count($tmp_output)>0) $output = implode("(...) ", $tmp_output);
        } else {
            $tmp_text = "";
            for ($i=0; $i < count($criterio); $i++) { 
                $match = preg_match("/".$criterio[$i]."/i",preg_quote($cadena));
                if($match===1) {
                    if($tmp_text!='') $tmp_text = preg_replace("/".$criterio[$i]."/i", "<strong>".$criterio[$i]."</strong>", $tmp_text);
                    else $tmp_text = preg_replace("/".$criterio[$i]."/i", "<strong>".$criterio[$i]."</strong>", $cadena);
                }
            }
            if($tmp_text!='') $output = $tmp_text;
        }
        return ($output=='' ? $cadena : $output);
        
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}