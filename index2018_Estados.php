<?php
    require 'Mailin.php';
    require 'conexion.php';
    require 'querysPEMEX.php';

    $fecha=  date("Y-m-d");
    $mensaje="<meta charset='utf8' />
    <style>
      body{
        font-family: Century gothic;
        font-size: 10px;}

      tr {
        border-bottom: 1pt solid black;
      }
    </style>
    <table width='150px' align='center' cellspacing='0' border='0' style='font-size: 13px; border: solid 1px gray'>
      <tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
         <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
          <td width='49%' style='border-bottom: 1pt solid rgb(230, 230, 230);'> Dir. General</td>";

          if(numberNotes(5, $fecha))
            $mensaje .= "<td width='25%'  style='border-bottom: 1pt solid rgb(230, 230, 230);'><a href='http://187.247.253.5/PruebaCorreo/pemex/exportpemex1.php?p=".base64_encode(base64_encode('5'))."&f=$fecha'>".'Clic aquí'."</a></td>";
          else
            $mensaje .= "<td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>";

         $mensaje .= "
          <td width='6%' style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
          <td width='4%' style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
          <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
          <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
        </tr>
        <tr>
          <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
          <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>PEMEX</td>";

          $mensaje .= "
          <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
          <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
          <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
          <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
        </tr>
        <tr>
          <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
          <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>Admon. Central</td>";

          $mensaje .= "
          <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
          <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
          <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
          <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
        </tr>
        <tr>
          <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
          <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>Ref. Energética</td>";

          $mensaje .= "
          <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
          <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
          <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
          <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
        </tr>
        <tr>
          <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
          <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>Instalaciones</td>";

          $mensaje .= "
          <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
          <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
          <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
          <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
        </tr>
        <tr>
          <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
          <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>Petróleo</td>";

          $mensaje .= "
          <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
          <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
          <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
          <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
        </tr>
        <tr>
          <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
          <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>Gas</td>";

          $mensaje .= "
          <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
          <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
          <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
          <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
        </tr>
        <tr>
          <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
          <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>Petroquímica</td>";

         $mensaje .= "
          <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
          <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
          <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
          <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
        </tr>
        <tr>
          <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
          <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>Gasolina</td>";

          $mensaje .= "
          <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
          <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
          <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
          <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
        </tr>
        <tr>
          <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
          <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>Ref. Laboral</td>";

          $mensaje .= "
          <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
          <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
          <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
          <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
        </tr>
        <tr>
          <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
          <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>Sindicato</td>";

          $mensaje .= "
          <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
          <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
          <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
          <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
        </tr>
        <tr>
          <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
          <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>Refinación</td>";

          $mensaje .= "
          <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
          <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
          <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
          <td style='border-bottom: 1pt solid rgb(230, 230, 230);' >&nbsp;</td>
        </tr>
        <tr>
          <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>&nbsp;</td>
          <td style='border-bottom: 1pt solid rgb(230, 230, 230);'>Seguridad Industrial</td>";

          $mensaje .= "
        </tr>

        <td colspan='7' style='text-align: right;'><span style='text-align: right;
          font-size: 8px;
          color: rgb(139, 139, 139);'>Monitoreo de prensa 2018</span></td>
      </tr>
    </table>
    <br><br>
    <div style='text-align: center; font-size: 14px;'>Para mas contenido visite su <a href='https://www.taringa.net'>Sistema de Informacion</a></div>";

    echo $mensaje."<br><br>";

    sendinblue($mensaje);
    function sendinblue($message){

        $subject="Mensaje de prueba";
        $mailin = new Mailin("https://api.sendinblue.com/v2.0", "wjSbMAENLm2TGfpW");
        $data   = array(
            "to" => array(
                  "kamaleon391@gmail.com" => "Correo de prueba",
            ),
            "cc" => array(
                "ehb1703@me.com"=>"Edgar Hernandez",
            ),            
            "bcc" => array(
                "ehb1703@gmail.com" => "Edgar Hernandez",
            ),
            "from" => array("gaimpresos@gmail.com", "Ga Comunicacion"),
            "subject" =>$subject,
            "html" => $message,
            "headers" => array("Content-Type"=> "text/html; charset=iso-8859-1s", "X-Mailin-Tag" => "Impresos")
        );

        /*
         * ENVIANDO EMAIL...
         */
        var_dump($mailin->send_email($data));
    }   
?>