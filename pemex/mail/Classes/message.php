<?php

if( getHostName() === 'Sauron' )
	require_once '/var/www/external/services/mail/conexion.php';
else
	require_once '/var/www/external/mail/conexion.php';


/* 
 * CLASE QUE SIRVE PARA ABSTRAER LA CREACION DEL MENSAJE DE ENVIO EN UN CORREO DE MONITOREO
 * EL OBJETO DEPENDE QUE SE ALIMENTE CON LA INFORMACION DEL METODO CONFIGMESSAGE
 */
class Message {

	private $html;
	private $directory;
	private $full_dir;
	private $image;
	private $state;
	private $state_id;
	private $info_queries;
	private $done = false;

	/*
	 * METODO PARA CARGAR EL DIRECTORO Y LA IMAGEN
	 */
	public function generalConfig( $directory, $image, $file_html = 'cdmx.html' ){
		$this->directory = $directory;
		$this->full_dir  = 'http://187.247.253.5/external/services/mail/'.$directory.'/';
		$this->image 	 = $this->directory . $image;
		$this->html 	 = file_get_contents( '/var/www/external/services/mail/'.$directory.'/'.$file_html ) ; //RECORDAR STR_REPLANCE DE [[[--MAY--]]]
		$this->html 	 = str_replace( '[[[--MAY--]]]', ucfirst( $this->directory ) , $this->html );
		$this->html 	 = str_replace( '[[[--MIN--]]]', $image , $this->html );
	}

	/*
	 * METODO PARA SETEAR DEMAS CONFIGURACIONES
	 */
	public function configMessage( array $settings ){

		if( !isset( $settings['state'] ) || !isset( $settings['id'] ) || 
			!isset( $settings['date'] ) || !isset( $settings['characters'] ) ){
			return false;
		}
		$this->generalConfig( $settings['directory'], $settings['image'], $settings['html'] );
		$this->state 		= $settings['state'];
		$this->state_id 	= $settings['id'];
		$this->date 		= $settings['date'];
		$this->info_queries = $settings['characters'];
		return true;
	}

	/*
	 * METODO PARA GENERAR EL MENSAJE
	 */
	public function getMessage(){
		if( !isset( $this->directory ) || !isset( $this->state ) ){
			return false;
		}

		foreach ( $this->info_queries as $key => $value) {
			$this->html .= $this->getSubmessage( $key, $value );
		}
		$this->endMessage();
		$this->done = true;
		return $this->html;	
	}

	/*
	 * METODO PARA CREAR EL ROW DE LA TABLA HTML
	 */
	public function getSubmessage( $key, $text ){
	    
	    if( numberNotes( $key , $this->date , $this->state ) ) {
	    	$sub_msg = "<td style='border-bottom: 1pt solid rgb(230, 230, 230);' >
	    				<a href='http://187.247.253.5/external/services/mail/$this->directory/export".ucfirst( $this->directory ).".php?p=".base64_encode( base64_encode( $key ) ).
	    				"&f=$this->date&e=$this->state'>REPORTE</a></td>";
		}
    	else{
    		$sub_msg = "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";
    	}

		return "<tr><td style='border-bottom: 1pt solid rgb(230, 230, 230);text-align:left'><b>".$text."</b></td>
				<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
    			<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>".$sub_msg."</tr>";
	}

	/*
	 * METODO PARA AGREGAR LINKS ESTATICOS COLUMNAS, PRIMERAS PLANAS, ETC...
	 */
	public function addStaticLinks(){
		//recuerdenme jalar eso por file_get_content()
		$this->html .= "<tr><td style='border-bottom: 1pt solid rgb(230, 230, 230);'><b>Primeras Planas</b></td>
    <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td><td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td><td style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/exportTamaulipas.php?p=".base64_encode(base64_encode('1'))."&f=$this->date'>REPORTE</a></td></tr><tr><td style='border-bottom: 1pt solid rgb(230, 230, 230);'><b>Columnas Políticas</b></td><td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td><td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td><td style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/exportTamaulipas.php?p=".base64_encode(base64_encode('2'))."&f=$this->date'>REPORTE</a></td></tr><tr><td style='border-bottom: 1pt solid rgb(230, 230, 230);'><b>Columnas Financieras</b></td><td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td><td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td><td style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/exportTamaulipas.php?p=".base64_encode(base64_encode('3'))."&f=$this->date'>REPORTE</a></td></tr><tr><td style='border-bottom: 1pt solid rgb(230, 230, 230);'><b>Cartones</b></td><td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td><td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td><td style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/external/services/mail/exportTamaulipas.php?p=".base64_encode(base64_encode('4'))."&f=$this->date'>REPORTE</a></td></tr>";
	}

	/*
	 * METODO PARA FINALIZAR LA TABLA Y EL MENSAJE HTML
	 */
	public function endMessage(){
		$this->html .= "<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr></table>
						<br><br><div style='text-align: center; font-size: 14px;'>Para mas contenido visite su <a href='http://www.gaimpresos.com/boards/".$this->directory."'>Sistema de Información</a></div>";
	}
}

/*

$message_settings =  array( 
						'state' 		=> 'CDMX', 
						'id' 			=> 9,
						'html'			=> 'tamaulipas.html'
						'directory' 	=> 'issste',
						'image' 		=> 'logopdf.jpg',
						'date' 			=> '2016-04-16',
						'characters' 	=> array( 
							5  => 'Director ISSSTE',
							21 => 'ISSSTE',
							7  => 'Administración',
							9  => 'Clínicas y Hospitales',
							11 => 'Pensiones y Jubilaciones',
							13 => 'Guarderias',
							15 => 'Medicamentos',
							17 => 'Fovissste',
							19 => 'FESTSE'
						) 
					); 

$message = new Message();
$message->configMessage( $message_settings );
//$message->addStaticLinks();
echo $message->getMessage();

*/
