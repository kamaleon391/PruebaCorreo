<?php

class Witness
{
    private $date;
    private $month;
    private $pdf;
    private $src_logo;
    private $destination_path;
    private $filename;
    private $pages;

    private $mysqli;

    public function Witness($date, $name, $destination, $logo, $sheet_size = 'legal')
    {
        $this->pdf              = new FPDI('P', 'mm', $sheet_size);   
        $this->pages            = 0;
        $this->src_logo         = $logo;
        $this->destination_path = $destination;     
        $this->filename         = $name;
        $this->date             = $date;        
        list($a,$m,$d)          = explode("-", $date);
        $this->month            = $m;
        $this->mysqli           = new mysqli("127.0.0.1", "root", "Gaddp552014", "monitoreoGa");

        if ($this->mysqli->connect_errno) {
            return "Fallo la conexion a la base de datos" . $this->mysqli->error;
        }

        if (!$this->mysqli->set_charset('utf8')) {
            printf("Error cargando el conjunto de caracteres utf8: %s\n", $this->mysqli->error);
            exit;
        }
    }

    public function create_frontpage($title)
    {
        $this->pdf->addPage();
        $this->pdf->SetFillColor(245,245,245);
        $this->pdf->Rect(0, 131, 250, 40, 'F');

        $this->pdf->setTextColor(0,0,0);
        $this->pdf->SetFont("arial", "B", 30);
        $this->pdf->Text(10,156,strtoupper( $title ) );
        $this->pdf->SetFont("arial", "B", 13);
        $this->pdf->setTextColor(255,255,255);
        $this->pdf->Text(10,23,"test");

        $this->pdf->Image($this->src_logo,5,90,100); 
        $this->pdf->SetFont("arial", "B",15);
        $this->pdf->setTextColor(0,0,0);
        $this->pdf->Text(110,177,$this->mostrar_fecha_completa($this->date));   

        //$this->pdf->Output($filename, 'F');
    }

    public function create_document_body( $queryTopic )
    {            
        try {
            $query_result = $this->mysqli->query($queryTopic, MYSQLI_STORE_RESULT) or die($this->mysqli->error);
            $query_result->data_seek(0);
            
            while ($row = $query_result->fetch_assoc()) {
              //echo $row['pdf'].'\n';
              if(file_exists($row['pdf'])){

                $pageCount = $this->pdf->setSourceFile( $row['pdf'] );
                $tplIdx    = $this->pdf->importPage(1);
                $this->pdf->addPage(); 
                $this->pdf->useTemplate($tplIdx, 30,30,150);
                $this->pages++;

                if($pageCount > 1) {
                  try {
                    $tplIdx_ = $this->pdf->importPage(2);
                    $this->pdf->addPage();
                    $this->pdf->useTemplate($tplIdx_, 30, 30, 150);
                    $this->pages++;
                  } catch( InvalidArgumentException $e ){ }
                }
              }
            }
            
            $query_result->close();
        } catch (Exception $e) {
            return 'Excepción capturada: ' . $e->getMessage() . "\n";
        }            
    }

    public function save_document()
    {
      if( !empty($this->pdf) && $this->pages > 0)
      {
        $antigua = umask(0);
        if(is_dir($this->destination_path . "/" . $this->month . "/" . $this->date . "/")){
          //echo $this->destination_path . "/" . $this->month . "/" . $this->date . "/";
        }
        else{
            //echo 's2';
            mkdir($this->destination_path . "/" . $this->month . "/" . $this->date,true,0777);
            chmod($this->destination_path . "/" . $this->month . "/" . $this->date,0777);
            umask($antigua);
        }

        $utf8 = array(
            '/[áàâãªä]/u'   =>   'a',
            '/[ÁÀÂÃÄ]/u'    =>   'A',
            '/[ÍÌÎÏ]/u'     =>   'I',
            '/[íìîï]/u'     =>   'i',
            '/[éèêë]/u'     =>   'e',
            '/[ÉÈÊË]/u'     =>   'E',
            '/[óòôõºö]/u'   =>   'o',
            '/[ÓÒÔÕÖ]/u'    =>   'O',
            '/[úùûü]/u'     =>   'u',
            '/[ÚÙÛÜ]/u'     =>   'U',
            '/ç/'           =>   'c',
            '/Ç/'           =>   'C',
            '/ñ/'           =>   'n',
            '/Ñ/'           =>   'N',
            '/–/'           =>   '-', // UTF-8 hyphen to "normal" hyphen
            '/[’‘‹›‚]/u'    =>   ' ', // Literally a single quote
            '/[“”«»„]/u'    =>   ' ', // Double quote
            '/ /'           =>   ' ', // nonbreaking space (equiv. to 0x160)
        );

        $this->filename = preg_replace(array_keys($utf8), array_values($utf8), $this->filename );
        $nombre = $this->destination_path . "/" . $this->month . "/" . $this->date."/". str_replace( ' ', '_', $this->filename ).".pdf";
        if(is_dir($this->destination_path . "/" . $this->month . "/" . $this->date))
        { 
            //echo 's3';
            $this->pdf->Output($nombre, 'F');
        }else{
            
            echo "Error  Escritura<br>".__DIR__;
        } 
      }
    }

    /*
     * FUNCION PARA OBTENER LA FECHA EN FORMATO DE CADENA
     * @params ( $fecha => string )
     * @return ( $fecha => string )
     */
    public function mostrar_fecha_completa( $fecha ) {
      
      $subfecha = explode("-",$fecha); 
      $año      = $subfecha[0]; 
      $mes      = $subfecha[1]; 
      $dia      = $subfecha[2];
      $dia2     = date( "d", mktime(0,0,0,$mes,$dia,$año) );
      $mes2     = date( "m", mktime(0,0,0,$mes,$dia,$año) );
      $año2     = date( "Y", mktime(0,0,0,$mes,$dia,$año) );
      $dia_sem  = date( "w", mktime(0,0,0,$mes,$dia,$año) );

      $dias  = array( '0' => 'Domingo', '1' => 'Lunes', 
                      '2' => 'Martes',  '3' => 'Miercoles',
                      '4' => 'Jueves',  '5' => 'Viernes',
                      '6' => 'Sabado'  );

      $meses = array( '01' => 'Enero',     '02' => 'Febrero', 
                      '03' => 'Marzo',     '04' => 'Abril', 
                      '05' => 'Mayo',      '06' => 'Junio',    
                      '07' => 'Julio',     '08' => 'Agosto',
                      '09' => 'Septiembre','10'=> 'Octubre',
                      '11'=> 'Noviembre', '12'=> 'Diciembre' );     

      if( $mes2 >= '01' && $mes2 <= '12' && $dia_sem >= '0' && $dia_sem <= '6' )
        return $dias[ $dia_sem ].' '.$dia2.' de '. $meses[ $mes2 ] .' de '.$año2;
      return '';
    }
}
