<?php

require_once '/var/www/external/services/mail/PHPMailer/PHPMailerAutoload.php';

/********************************
 * CLASE PARA ENVIOS DE CORREOS
 *
 ********************************/

class MySending {
  private $mailer;

  /*
   * METODO PARA CREAR Y CONFIGURAR OBJETO QUE PHPMAILER
   * @param $settings -> Un array asociativo son informacion para la conexion 
   */
  public function config( array $settings = null ){

    $this->mailer             = new PHPMailer();
    $this->mailer->IsSMTP();
    $this->mailer->SMTPAuth   = true;                                                              // enable SMTP authentication
    $this->mailer->SMTPSecure = 'tls';                                                             // sets the prefix to the servier
    $this->mailer->Host       = $settings === null ? 'smtp.gmail.com'       : $settings[ 'host' ]; // sets GMAIL as the SMTP server
    $this->mailer->Port       = $settings === null ? 587                    : $settings[ 'port' ]; // set the SMTP port for the GMAIL
    $this->mailer->Username   = $settings === null ? 'gaimpresos@gmail.com' : $settings[ 'user' ]; // GMAIL username
    $this->mailer->Password   = $settings === null ? 'Gacomunicacion#@2014' : $settings[ 'password' ];   

  }

  /*
   * METODO AGREGAR LAS DIRECCIONES DE DESTINATARIOS 
   * @param $addresses -> Un array con los emails 
   */
  public function addAddresses( array $addresses ){
    if( !isset( $this->mailer ) )
      return false;
    foreach ( $addresses as $email ) {
      $this->mailer->AddAddress( $email );
    }
    return true;
  }

  /*
   * METODO AGREGAR LAS DIRECCIONES DE DESTINATARIOS QUE SERAN PUESTOS COMO COPIA OCULTA
   * @param $addresses -> Un array con los emails 
   */
  public function addBccs( array $addresses ){
    if( !isset( $this->mailer ) )
      return false;
    foreach ( $addresses as $email ) {
      $this->mailer->AddBCC( $email );
    }
    return true;
  }

  /*
   * METODO AGREGAR CONTENIDO DEL CORREO
   * @param $from       -> Direccion que mostrara el correo
   *        $from_name  -> Nombre de la persona que envio
   *        $subject    -> Titulo del email
   *        $body       -> Curepo del correo
   */
  public function addContent( $from, $from_name, $subject, $body ) {
    if( !isset( $this->mailer ) )
      return false;
    $this->mailer->From     = $from;      //  gaimpresos@gacomunicacion.com
    $this->mailer->FromName = $from_name; //  Monitoreo Impresos
    $this->mailer->Subject  = $subject;   //  
    $this->mailer->WordWrap = 50;
    $this->mailer->IsHTML(TRUE);
    $this->mailer->Body = $body;

    return true;
  }

  /*
   * METODO ENVIAR EMAIL
   * @return (true/false)
   */
  public function send_mail(){
    return $this->mailer->Send();
  }

  /*
   * METODO OBTENER ERRORES
   * @return mensaje de errores
   */
  public function errorInfo(){
    return $this->mailer->ErrorInfo;
  }

}

/* TEST SECTION 
$message = file_get_contents( '/var/www/external/mail/asa/cdmx.html' );
$sending = new MySending();

$sending->config();
$sending->addAddresses( array( 'vazquezoliver@gmail.com' ) );
$sending->addBccs( array( 'vazquezoliver@gmail.com' ) );
$sending->addContent( 'gaimpresos@gacomunicacion.com', 'Monitoreo Impresos', 'Test', $message );

if ( $sending->send_mail() ){
  echo 'Envio hecho';
} else {
  echo $sending->errorInfo();
}
*/
