<?php
class MailSummary
{
    public $counts;
    public $actors;
    public $newspapers;
    public $message;

    public $mysqli;

    public function MailSummary()
    {
        $this->counts     = [];
        $this->actors     = [];
        $this->newspapers = [];
        

        $this->mysqli = new mysqli("127.0.0.1", "root", "Gaddp552014", "monitoreoGa");
        if ($this->mysqli->connect_errno) {
            return "Fallo la conexion a la base de datos" . $this->mysqli->error;
        }

        if (!$this->mysqli->set_charset('utf8')) {
            printf("Error cargando el conjunto de caracteres utf8: %s\n", $this->mysqli->error);
            exit;
        }
    }

    public function start_message()
    {
        $this->message ='
                <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml">
                <html lang="es">
                  <head>
                  <meta charset="utf-8"/>
                        <meta content="es"/>
                        <meta lang="es"/>
                        <meta http-equiv="Content-Language" content="es">
                        <meta name="viewport" content="width=device-width, initial-scale=1">
                        <meta name="apple-mobile-web-app-capable" content="yes">
                  </head>
                 
                  <body>
                <table width="70%" align="center" cellspacing="0" border="0" style="font-size: 12px;border: solid 1px gray;">
                 <tr>
                    <td colspan="3" align="center"><img src="http://187.247.253.5/external/services/mail/GA/logoGA2.png"style="width: 280px;"></td>
                 </tr>';
    }

    public function close_message()
    {
        $this->message .='
                </table>
                </body>
                </html>';    
    }

    public function highlight($cadena, $arr_palabras) 
    {
        if (!is_array ($arr_palabras) || empty ($arr_palabras) || !is_string ($cadena)) 
        {
            return false;
        }

        $str_palabras = implode ('|', $arr_palabras);

        return preg_replace ('@\b('.$str_palabras.')\b@si', '<strong style="background-color:yellow">$1</strong>', $cadena);
    }

    public function textMatchV2($cadena,$criterio) {
        // Salida
        $output = array();

        // Separacion de parrafos
        preg_match_all("#(.*)\.#U",$cadena,$multiMatch);

        if(count($multiMatch[0])>0) {
            for ($i=0; $i < count($multiMatch[0]); $i++) {
                for ($y=0; $y < count($criterio); $y++) {
                    if(preg_match("/".$criterio[$y]."/i",preg_quote($multiMatch[0][$i]))===1) {
                        $output[] = $multiMatch[0][$i];
                        break;
                    }
                }
            }
        }

        if(count($output)<1) $output = $cadena;

        return (is_array($output) ? implode("(...) ", $output) : $output);
        
    }

    public function get_and_append_notes($actor, $criteria, $keywords)
    {
        $_message = '<tr>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                     </tr>
                     <tr>
                        <th colspan="3" style="font-family: Arial Narrow;text-align:left; background:#FFFFFF; color:#B30000; height: 30px; font-size: 19px;text-transform: uppercase;">'.$actor.'</th>
                     </tr>
                     <tr>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                     </tr>';

        $query = "SELECT
            n.cutted,
            n.Periodico as idPeriodico,
            n.idEditorial,
              n.Titulo,
              p.Nombre as Periodico,
              p.String_Name,
              e.Nombre AS estado,
              n.PaginaPeriodico,
              s.seccion,
              c.Categoria as Categoria,
              n.Autor,
              n.Texto,
              CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
              CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina,'.jpg') AS 'jpg',
              n.Categoria as 'Num.Categoria',
              n.NumeroPagina,
              n.Fecha,
              n.Hora,
              n.Encabezado,
              n.Foto,
              n.PieFoto,
            n.Cutted
            FROM
              noticiasDia n,
              periodicos p,
              seccionesPeriodicos s,
              categoriasPeriodicos c,
              estados e
            WHERE
              p.idPeriodico=n.Periodico AND
              s.idSeccion=n.Seccion AND
              c.idCategoria=n.Categoria AND
              p.Estado=e.idEstado AND
              n.Categoria <> 80 AND
            n.Activo = 1 AND
              fecha = CURDATE() AND " . $criteria;

        try {
            $query_result = $this->mysqli->query($query, MYSQLI_STORE_RESULT) or die($this->mysqli->error);
            $query_result->data_seek(0);
            

            while ($row = $query_result->fetch_assoc()) {

                $texto =  $this->textMatchV2($row['Texto'], $keywords);
                
                $texto = ( !empty($keywords) )? $this->highlight( $texto  , $keywords) :  $texto ; 
                $texto = utf8_decode($texto);

                $periodico = ( !empty($keywords) )? $this->highlight( $row['String_Name'], $keywords) : $row['String_Name'];   
                $periodico = utf8_decode($periodico);

                $titulo =  ( !empty($keywords) )? $this->highlight( $row['Titulo'], $keywords) : $row['Titulo'] ;
                $titulo = utf8_decode($titulo);

                $_message .='
                <tr>
                    <td colspan="1" style="text-align:left; font-weight:bold;FONT-SIZE: 14px;">' . $titulo . ' - ' . $periodico . ' - ' . utf8_decode($row['estado']) . ' - '.$row['NumeroPagina'].' - '.ucwords(strtolower($row['Autor'])).' - '.$row['Categoria'].'</td>
                </tr>
                <tr>
                    <td colspan="3" style="text-align:justify;font-family: Arial Narraow;font-size: 14px;">
                      ' . $texto . '
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <a href="http://www.gaimpresos.com' . $row['pdf'] . '" target="_blank">Ir al PDF</a> &nbsp;  &nbsp; &nbsp;<a href="http://www.gaimpresos.com' . $row['jpg'] . '" target="_blank">Ir a la Imagen</a>&nbsp;&nbsp;&nbsp; Link: <span style="color: blue;">http://www.gaimpresos.com' . $row['pdf'] . '</span>
                    </td>
                </tr>
                <tr style="height: 10px;">
                    <td colspan="3"></td>
                </tr>'; 
            }
            
            $query_result->close();
        } catch (Exception $e) {
            return 'Excepción capturada: ' . $e->getMessage() . "\n";
        }    

        $query = "SELECT
            n.cutted,
            n.Periodico as idPeriodico,
            n.idEditorial,
              n.Titulo,
              p.Nombre as Periodico,
              p.String_Name,
              e.Nombre AS estado,
              n.PaginaPeriodico,
              s.seccion,
              c.Categoria as Categoria,
              n.Autor,
              n.Texto,
              CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
              CONCAT('/Periodicos/',REPLACE(p.Nombre,' ','%20'),'/',n.Fecha,'/',NumeroPagina,'.jpg') AS 'jpg',
              n.Categoria as 'Num.Categoria',
              n.NumeroPagina,
              n.Fecha,
              n.Hora,
              n.Encabezado,
              n.Foto,
              n.PieFoto,
            n.Cutted
            FROM
              noticiasDia n,
              periodicos p,
              seccionesPeriodicos s,
              categoriasPeriodicos c,
              estados e
            WHERE
              p.idPeriodico=n.Periodico AND
              s.idSeccion=n.Seccion AND
              c.idCategoria=n.Categoria AND
              p.Estado=e.idEstado AND
              n.Categoria = 80 AND
            n.Activo = 1 AND
              fecha = CURDATE() AND " . $criteria;

        try {
            $query_result = $this->mysqli->query($query, MYSQLI_STORE_RESULT) or die($this->mysqli->error);
            $query_result->data_seek(0);
            

            while ($row = $query_result->fetch_assoc()) {

                $texto =  $this->textMatchV2($row['Texto'], $keywords);
                
                $texto = ( !empty($keywords) )? $this->highlight( $texto  , $keywords) :  $texto ; 
                $texto = utf8_decode($texto);

                $periodico = ( !empty($keywords) )? $this->highlight( $row['String_Name'], $keywords) : $row['String_Name'];   
                $periodico = utf8_decode($periodico);

                $titulo =  ( !empty($keywords) )? $this->highlight( $row['Titulo'], $keywords) : $row['Titulo'] ;
                $titulo = utf8_decode($titulo);

                $_message .='
                <tr>
                    <td colspan="1" style="text-align:left; font-weight:bold;FONT-SIZE: 14px;">' . $titulo . ' - ' . $periodico . ' - ' . utf8_decode($row['estado']) . ' - '.ucwords(strtolower($row['Autor'])).'</td>
                </tr>
                <tr>
                    <td colspan="3" style="text-align:justify;font-family: Arial Narraow;font-size: 14px;">
                      ' . $texto . '
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <a href="' . $row['Encabezado'] . '" target="_blank">Ir al Testigo</a> &nbsp;&nbsp;&nbsp; Link: <span style="color: blue;text-decoration: underline;">' . $row['Encabezado'] . '</span>
                    </td>
                </tr>
                <tr style="height: 10px;">
                    <td colspan="3"></td>
                </tr>'; 
            }
            
            
            $query_result->close();
        } catch (Exception $e) {
            return 'Excepción capturada: ' . $e->getMessage() . "\n";
        }  

        $this->message .= $_message;
        
    }
}
