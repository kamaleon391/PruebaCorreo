<?php
require '/var/www/external/services/mail/funciones_export.php';
class WebReport
{
    public $date;
    public $fullDate;
    public $sideColumn;
    public $sidePlanas;
    public $centralColumn;
    public $mainLogo;
    public $footerLogo;
    public $topics;
    public $message;
    private $mysqli;

    public function __construct($date, $mainLogo, $footerLogo, $idsTopics)
    {
        $this->mysqli        = new mysqli("127.0.0.1", "root", "Gaddp552014", "monitoreoGa");
        if ($this->mysqli->connect_errno) {
            return "Fallo la conexion a la base de datos" . $this->mysqli->error;
        }
        
        if (!$this->mysqli->set_charset('utf8')) {
            printf("Error cargando el conjunto de caracteres utf8: %s\n", $this->mysqli->error);
            exit;
        }
        $this->date          = $date;
        $this->fullDate      = mostrar_fecha_completa($date);
        $this->sideColumn    = '';
        $this->sidePlanas    = '';
        $this->centralColumn = '';
        $this->mainLogo      = $mainLogo;
        $this->footerLogo    = $footerLogo;
        $this->message       = '';
        $this->topics        = $this->getTopics($idsTopics);
        $this->menuTopics    = $this->getMenuTopics();
    }

    public function getTopics($idsTopics)
    {
        $topics = [];
        $query = "SELECT i.id, i.text AS 'topic', i.character, i.query, i.query_count, i.query_estados, i.query_revistas, i.query_web, i.criteria FROM menu_items i WHERE i.id IN (". implode(',', $idsTopics) .") ORDER BY i.order";
        try {
            $query_result = $this->mysqli->query($query, MYSQLI_STORE_RESULT) or die($this->mysqli->error);
            $query_result->data_seek(0);
            while ($row = $query_result->fetch_assoc()) {
                $topics[] = [
                    'id'       => $row['id'],
                    'topic'    => $row['topic'],
                    'query'    => $row['query'],
                    'criteria' => $row['criteria']
                ];
            }
            $query_result->close();
        } catch (Exception $e) {
            return 'Excepción capturada: ' . $e->getMessage() . "\n";
        }
        return $topics;
    }

    public function getMenuTopics()
    {
        $menu = '';
        foreach ($this->topics as $key => $topic) {
            $menu .= "<tr>
                    <td width='1%' class='links'>&nbsp;&nbsp;&nbsp;</td>
                    <td width='75%' style='padding-top:8px'>
                        <font color='#41bcf6' size='1' face='verdana'>
             <span size='2'> &raquo; </span>
                            <a style='text-decoration:underline' href='#". $topic['id'] ."'>
                                <font color='#41bcf6' size='2' face='arial'>
                                    <b> ". utf8_decode($topic['topic']) ."</b>
                                </font>
                            </a>
                        </font>
                    </td>
                </tr>";
        }
        return $menu;
    }

    public function createSideColumn($queryTopic)
    {
        try {
            $query_result = $this->mysqli->query($queryTopic, MYSQLI_STORE_RESULT) or die($this->mysqli->error);
            $query_result->data_seek(0);
            
            while ($row = $query_result->fetch_assoc()) {
                $this->sideColumn .= "<tr >
                    <td width='1%' class='links'>&nbsp;&nbsp;&nbsp;</td>
                    <td width='75%'>
                        <font color='#4F4F4F' size='1' face='verdana'>
                            <a href='http://www.gaimpresos.com" . $row['pdf'] . "' target='_blank' style='text-decoration:underline'>
                                <font color='#0047e6' size='2' face='verdana'><b>" . utf8_decode($row['StringName']) . "</b></font>
                            </a>
                        </font>
                        <font color='#4F4F4F' size='1' face='verdana'>
                            <br>" .  utf8_decode($row['Titulo']) . "<br>
                        </font>
                    </td>
                </tr>";
            }
            
            $query_result->close();
        } catch (Exception $e) {
            return 'Excepción capturada: ' . $e->getMessage() . "\n";
        }
    }

    public function createSidePlanas($queryTopic)
    {
        try {
            $query_result = $this->mysqli->query($queryTopic, MYSQLI_STORE_RESULT) or die($this->mysqli->error);
            $query_result->data_seek(0);
            while ($row = $query_result->fetch_assoc()) {
                $this->sidePlanas .= "<tr style='padding-top:8px'>
                    <td width='1%' class='links'>&nbsp;&nbsp;&nbsp;</td>
                    <td width='75%'>
                        <font color='#4F4F4F' size='1' face='Arial'>
                            <a href='http://www.gaimpresos.com" . $row['pdf'] . "' target='_blank' style='text-decoration:underline'>
                                <font color='#0047e6' size='2' face='Arial'><b>" . utf8_decode($row['StringName']) . "</b></font>
                            </a>
                        </font>
                        <font color='#000000' size='1' face='Arial'>
                            <br>" .  utf8_decode($row['Titulo']) . "<br>
                        </font>
                    </td>
                </tr>";
            }
            $query_result->close();
        } catch (Exception $e) {
            return 'Excepción capturada: ' . $e->getMessage() . "\n";
        }
    }
/*
    public function createCentralColumn()
    {
        foreach ($this->topics as $key => $topic) {
            $newTopic = true;
            try {
                $query_result = $this->mysqli->query($topic['criteria'], MYSQLI_STORE_RESULT) or die($this->mysqli->error);
                $query_result->data_seek(0);
                
                while ($row = $query_result->fetch_assoc()) {
                    if ($newTopic) {
                        $this->centralColumn .= "<a name='". $topic['id'] ."'>
                            <table style='width: 100%;' border='0'>
                                <tr>
                                    <td width='790' bgcolor='#D8D8D8'><font color='#000000' size='2' face='arial'><b>". utf8_decode($topic['topic']) ."</b></font></td>
                                    <td width='10' bgcolor='#D8D8D8'>
                                        <div align='center'>
                                            <a title='Subir' style='text-decoration:none' href='#Top'>
                                                <font face='arial' size='2' color='#FFFFFF'><b>^</b></font>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            </table>";
                        $newTopic = false;
                    }
                    $this->centralColumn .= "<table style='width: 100%;'>
                        <tr>
                            <td>
                                <font color='#000000' size='2' face='arial'><b>" . utf8_decode($row['Titulo']) . "</b></font>
                                <font color='#000000' size='1' face='arial'>
                                        <br>Pagina: " . $row['PaginaPeriodico'] . "  " . utf8_decode("Sección: " . $row['seccion']) . " " . utf8_decode("Categoría: " . $row['Categoria']) . "  " . utf8_decode($row['StringName']) . ($row['Autor'] == '' ? "" : ", &nbsp;" . utf8_decode($row['Autor'])) . "
                                        <br>                                    
                                </font>
                                <font color='#000000' size='1' face='verdana' align='justify'>
                                    <br>" . utf8_decode(substr($row['Texto'], 0, 300)) . "...
                                </font>
                                <br>
                                ";
                if($row['Num.Categoria']==80){
                 $this->centralColumn .="<a href='". $row['Encabezado'] ."' target='_blank'>
                                    <font color='#0033FF' size='1' face='verdana'><b>Testigo Web</b></font>
                                </a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <hr>";              
                }else{
                $this->centralColumn .="
                     <a href='http://www.gaimpresos.com/noteViewer/". $row['idEditorial'] ."/0/0/pdf' target='_blank'>
                                    <font color='#0033FF' size='1' face='verdana'><b>Testigo</b></font>
                                </a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <a href='http://www.gaimpresos.com/noteViewer/". $row['idEditorial'] ."/0/0/viewer' target='_blank'>
                                    <font color='#0033FF' size='1' face='verdana'><b>Nota</b></font>
                                </a>
                                <hr>
                ";}
                           $this->centralColumn .=" </td>
                            <!--td>
                                <img style='width: 100%; min-width: 100px; max-width: 100px;' src='http://www.gaimpresos.com" . $row['pdf'] . "_mini.jpg' alt='Miniatura'>
                            </td-->
                        </tr>
                    </table>";
                }
                $query_result->close();
            } catch (Exception $e) {
                return 'Excepción capturada: ' . $e->getMessage() . "\n";
            }
        }
    }
*/
    public function createCentralColumn()
    {
        foreach ($this->topics as $key => $topic) {
            $newTopic = true;
            try {
                $query_result = $this->mysqli->query($topic['criteria'], MYSQLI_STORE_RESULT) or die($this->mysqli->error);
                $query_result->data_seek(0);
                
                while ($row = $query_result->fetch_assoc()) {
                    if ($newTopic) {
                        $this->centralColumn .= "<a name='". $topic['id'] ."'>
                            <table style='width: 100%;' border='0'>
                                <tr>
                                    <td width='790' bgcolor='#D8D8D8'><font color='#000000' size='2' face='arial'><b>". utf8_decode($topic['topic']) ."</b></font></td>
                                    <td width='10' bgcolor='#D8D8D8'>
                                        <div align='center'>
                                            <a title='Subir' style='text-decoration:none' href='#Top'>
                                                <font face='arial' size='2' color='#FFFFFF'><b>^</b></font>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            </table>";
                        $newTopic = false;
                    }
                    if($row['Num.Categoria']!=80){
                        $this->centralColumn .= "<table style='width: 100%;'>
                        <tr>
                            <td>
                                <font color='#000000' size='2' face='arial'><b>" . utf8_decode($row['Titulo']) ." / ". utf8_decode($row['Encabezado']) ."</b></font>
                                <font color='#000000' size='1' face='arial' style='font-size: 12px;font-weight: bold;line-height: 20px; text-align: justify;'>    
                                        <br>".($row['Fecha2'])." &nbsp;&nbsp;&nbsp;&nbsp;".utf8_decode($row['StringName'])."&nbsp;&nbsp;&nbsp;&nbsp;".utf8_decode($row['seccion'])." / ".$row['PaginaPeriodico']."&nbsp;&nbsp;&nbsp;&nbsp;".ucwords(strtolower($row['Autor']))."
                                        <br>" .ucwords(strtolower(utf8_decode("Categoría: " . $row['Categoria']))) . "&nbsp;&nbsp;&nbsp;&nbsp;  Tiraje / Alcance: ".$row['Tiraje']." &nbsp;&nbsp;&nbsp;&nbsp; Costo: $".number_format($row['CostoNota'],2,".", ",")."                              
                                </font>
                                <font color='#000000' size='1' face='verdana' align='justify'>
                                    <br>" . utf8_decode(substr($row['Texto'], 0, 800)) . "...
                                </font>
                                <br>
                                <a href='http://www.gaimpresos.com/noteViewer/". $row['idEditorial'] ."/0/0/pdf' target='_blank'>
                                        <font color='#0033FF' size='1' face='verdana'><b>Testigo</b></font>
                                    </a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <!--a href='http://www.gaimpresos.com/noteViewer/". $row['idEditorial'] ."/0/0/viewer' target='_blank'>
                                        <font color='#0033FF' size='1' face='verdana'><b>Nota</b></font>
                                    </a-->
                                <hr align='left' noshade='noshade' size='2' width='100%'' />
                                ";
                    }
                    
                if($row['Num.Categoria']==80){
                    $this->centralColumn .= "<table style='width: 100%;'>
                        <tr>
                            <td>
                                <font color='#000000' size='2' face='arial'><b>" . utf8_decode($row['Titulo'])."</b></font>
                                <font color='#000000' size='1' face='arial' style='font-size: 12px;font-weight: bold;line-height: 20px; text-align: justify;'>    
                                        <br>".($row['Fecha2'])." &nbsp;&nbsp;&nbsp;&nbsp;".utf8_decode($row['StringName'])."&nbsp;&nbsp;&nbsp;&nbsp;".utf8_decode($row['seccion'])." / ".$row['PaginaPeriodico']."&nbsp;&nbsp;&nbsp;&nbsp;".ucwords(strtolower($row['Autor']))."
                                        <br>" .utf8_decode("Categoría: " . $row['Categoria']) . "&nbsp;&nbsp;&nbsp;&nbsp; Tiraje / Alcance: ".$row['Tiraje']." &nbsp;&nbsp;&nbsp;&nbsp; Costo: $".number_format($row['CostoNota'],2,".", ",")."                              
                                </font>
                                <font color='#000000' size='1' face='verdana' align='justify'>
                                    <br>" . utf8_decode(substr($row['Texto'], 0, 800)) . "...
                                </font>
                                <br>
                                <a href='". $row['Encabezado'] ."' target='_blank'>
                                    <font color='#0033FF' size='1' face='verdana'><b>Testigo Web</b></font>
                                </a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <hr align='left' noshade='noshade' size='2' width='100%'' />
                                ";
                }
                           $this->centralColumn .=" </td>
                            <!--td>
                                <img style='width: 100%; min-width: 100px; max-width: 100px;' src='http://www.gaimpresos.com" . $row['pdf'] . "_mini.jpg' alt='Miniatura'>
                            </td-->
                        </tr>
                    </table>";
                }
                $query_result->close();
            } catch (Exception $e) {
                return 'Excepción capturada: ' . $e->getMessage() . "\n";
            }
        }
    }    

    public function createFinancialColumn($queryTopic,$tema)
    {
        $newTopic = true;
        try {
            $query_result = $this->mysqli->query($queryTopic, MYSQLI_STORE_RESULT) or die($this->mysqli->error);
            $query_result->data_seek(0);
                
            while ($row = $query_result->fetch_assoc()) {
                if ($newTopic) {
                    $this->centralColumn .= "<a name='". $tema."'>
                        <table style='width: 100%;' border='0'>
                            <tr>
                                <td width='790' bgcolor='#D8D8D8'><font color='#000000' size='3' face='arial'><b>". utf8_decode($tema)."</b></font></td>
                                <td width='10' bgcolor='#D8D8D8'>
                                    <div align='center'>
                                        <a title='Subir' style='text-decoration:none' href='#Top'>
                                            <font face='arial' size='2' color='#FFFFFF'><b>^</b></font>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        </table>";
                    $newTopic = false;
                }
                $this->centralColumn .= "<table style='width: 100%;'>
                    <tr>
                        <td>
                            <font color='#000000' size='2' face='arial'><b>" . utf8_decode($row['Titulo']) ." / ". utf8_decode($row['Encabezado']) ."</b></font>
                            <font color='#000000' size='1' face='arial' style='font-size: 12px;font-weight: bold;line-height: 20px; text-align: justify;'>    
                                    <br>".($row['Fecha2'])." &nbsp;&nbsp;&nbsp;&nbsp;".utf8_decode($row['StringName'])."&nbsp;&nbsp;&nbsp;&nbsp;".utf8_decode($row['seccion'])." / ".$row['PaginaPeriodico']."&nbsp;&nbsp;&nbsp;&nbsp;".ucwords(strtolower(utf8_decode($row['Autor'])))."
                                    <br>" .ucwords(strtolower(utf8_decode("Categoría: " . $row['Categoria']) )). "&nbsp;&nbsp;&nbsp;&nbsp; Tiraje / Alcance: ".$row['Tiraje']." &nbsp;&nbsp;&nbsp;&nbsp; Costo: $".number_format($row['CostoNota'],2,".", ",")."                              
                            </font>
                            <font color='#000000' size='1' face='verdana' align='justify'>
                                <br>" . utf8_decode(substr($row['Texto'], 0, 800)) . "...
                            </font>
                            <br>
                            <a href='http://www.gaimpresos.com/noteViewer/". $row['idEditorial'] ."/0/0/pdf' target='_blank'>
                                    <font color='#0033FF' size='1' face='verdana'><b>Testigo</b></font>
                                </a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <a href='http://www.gaimpresos.com/noteViewer/". $row['idEditorial'] ."/0/0/viewer' target='_blank'>
                                    <font color='#0033FF' size='1' face='verdana'><b>Nota</b></font>
                                </a>
                            <hr align='left' noshade='noshade' size='2' width='100%'' />
                            ";
                       $this->centralColumn .=" </td>
                        <!--td>
                            <img style='width: 100%; min-width: 100px; max-width: 100px;' src='http://www.gaimpresos.com" . $row['pdf'] . "_mini.jpg' alt='Miniatura'>
                        </td-->
                    </tr>
                </table>";
            }
            $query_result->close();
        } catch (Exception $e) {
            return 'Excepción capturada: ' . $e->getMessage() . "\n";
        }
    }

    public function createMessage()
    {
        $this->message = "<!DOCTYPE html>
            <html>
            <head>
                <meta charset='utf-8'>
                <meta http-equiv='X-UA-Compatible' content='IE=edge'>
                <meta content='width=device-width, initial-scale=1.0' name='viewport'>
                <title>GAComunicación</title>
            </head>
            <body style='width: 100%; height: auto;margin:auto;  max-width: 800px; min-width: 600px; font-family: Arial Narrow;'>
                <table style='width: 100%;' border='0' align='left'>
                    <tr>
                        <td>
                            <br>
                            <a>
                                <font color='#606060' size='2' face='arial'><b>Reporte de notas:</b></font>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td colspan='3'><img src='$this->mainLogo' style='width: 100%; align: center; min-width: 490px;' /></td>
                    </tr>
                    <tr>
                        <td>
                            <font color='#646464' size='1' face='verdana'><b>$this->fullDate</b></font>
                        </td>
                    </tr>
                </table>
                <br clear=left>
                <table style='width: 100%; min-width: 600px;max-width:800px'  border=0 cellpadding=0 cellspacing=0 class=MsoTableGrid>
                    <tr>
                        <td width='25%' height='42' align='center' valign='top' style='padding: 10px;'>
                            <table width='100%' height='1' border=0 cellspacing=0 cellpadding=0 align='up'>
                                <tr>
                                    <td style='background-color:#D8D8D8' ><center><font color='black' size='2' face='verdana'><b>Temas</b></font></center></td>
                                </tr>
                            </table>
                            <table width='100%' height='1' border=0 cellpadding=0 cellspacing=0 align='up'>$this->menuTopics</table>
                <br>
                            <hr>
                <br>
                            <table width='100%' height='1' border=0 cellspacing=0 cellpadding=0 align='up'>
                                <tr style='background-color:#D8D8D8' >
                                    <td><center> <font color='black' size='2' face='verdana'><b>Primeras Planas</b></font> </center></td>
                                </tr>
                            </table>
                            <table width='100%' height='1' border=0 cellpadding=0 cellspacing=0 align='up'>$this->sidePlanas</table>
                <br>
                            <hr>
                <br>
                            <!--table width='100%' height='1' border=0 cellspacing=0 cellpadding=0 align='up'>
                                <tr style='background-color:#D8D8D8'>
                                    <td><center> <font color='black' size='2' face='verdana'><b>Columnas de Negocios</b></font></center> </td>
                                </tr>
                            </table-->
                            <table width='100%' height='1' border=0 cellpadding=0 cellspacing=0 align='up'>$this->sideColumn</table>
                        </td>
                        <td width='75%' rowspan='1' valign='top' style='padding: 10px;'>
                            <table BORDER='0' align='up'>
                            </table>
                            <table style='width: 100%;' align='up' border='0'>
                                        <a name='Top'>
                                        $this->centralColumn
                            </table>
                        </td>
                    </tr>
                </table>
            </body>
            </html>";
    }
}