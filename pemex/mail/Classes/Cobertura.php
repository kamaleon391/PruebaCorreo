<?php 

//require '../funciones_export.php';

class Cobertura{

	private $mysqli;

	public function __construct(){
		$this->mysqli = new mysqli("127.0.0.1", "root", "Gaddp552014", "monitoreoGa");

		if ($this->mysqli->connect_errno) {
            return "Fallo la conexion a la base de datos" . $this->mysqli->error;
        }
        
        if (!$this->mysqli->set_charset('utf8')) {
            printf("Error cargando el conjunto de caracteres utf8: %s\n", $this->mysqli->error);
            exit;
        }

	}
	public function estados(){
		$estados = Array();
		$i=0;
		$sql="SELECT * FROM estados WHERE Nombre = '$_GET[estado]' AND Pais = 1";
		$query_result = $this->mysqli->query($sql, MYSQLI_STORE_RESULT) or die($this->mysqli->error);
		$query_result->data_seek(0);
		while ($row = $query_result->fetch_assoc()) {
                $estados[$i] = Array(
		            'id'       	=> $row['idEstado'],
                    'estado'    => $row['Nombre'],
                    'latitude'  => $row['lat'],
                    'longitude' => $row['long'],
                );
                $i++;
            }
            $query_result->close();
        return $this->primeras_planas($estados);
	}

	public function primeras_planas($estados){
		$medios = Array();$j=0;
		foreach ($estados as $key => $value) {

		 $sql = "SELECT n.Periodico as idPeriodico,p.String_Name as Periodico, p.Nombre Periodico2, n.Titulo,CONCAT('http://187.247.253.5/siscap.la/public/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',CONCAT('/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'jpg' 
			FROM noticiasDia n,periodicos p,seccionesPeriodicos s,categoriasPeriodicos c,estados e 
			WHERE e.idEstado=p.Estado AND p.idPeriodico=n.Periodico AND s.idSeccion=n.Seccion AND c.idCategoria=n.Categoria AND c.idCategoria in(3) AND fecha =CURDATE() AND n.Activo=1 AND p.Estado=$value[id]
			 GROUP BY n.NumeroPagina,p.idPeriodico 
			 ORDER BY p.String_Name";

		$i=0;
		$query_result = $this->mysqli->query($sql, MYSQLI_STORE_RESULT) or die($this->mysqli->error);
		$query_result->data_seek(0);

		while ($row = $query_result->fetch_assoc()) {
                $value['data'][$i] = Array(
		            'id'   		   => $row['idPeriodico'],
		            'periodico'    => ($row['Periodico']==null) ? $row['Periodico2'] :$row['Periodico'],
		            'titulo'       => $row['Titulo'],
		            'pdf'    	   => $row['pdf'],
                );
                $i++;
              
            }
              $query_result->close();
              $medios[$j]=$value;
              $j++;
              
        }
        return json_encode($medios);   
	}
}
header('content-type: application/json; charset=utf-8');
header("access-control-allow-origin: *");

$data = array(1, 2, 3, 4, 5, 6, 7, 8, 9);

echo $_GET['callback'] . '('.json_encode($data).')';
//$cobertura = new Cobertura();
//echo $cobertura->estados();
