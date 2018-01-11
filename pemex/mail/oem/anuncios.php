<script type="text/javascript" src="jquery-1.11.1 (1).js"></script>
<script type="text/javascript">
    
</script>
<body>
    <style>
        body{
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }
    </style>
    <style type="text/css">
    .fancybox-custom .fancybox-skin{
        box-shadow: 0 0 50px #222;
    }
  /********************************/  
  #accordion { /* el rectángulo contenedor */
    /*width:450px;*/
     visiblilty: hidden;
  }
  #accordion h3 { /* los enlaces que despliegan y contraen el contenido */
-moz-border-radius: 3px;
-webkit-border-radius: 3px;
border-radius: 3px;
background-color: white;
height: 301px;
font-family: century gothic;
margin: 0 auto 0;
padding: 0 20px;
position: relative;
margin-bottom: 7px;
border: solid 1px rgb(213, 213, 213);
background-image: url('../../../LoteriaNacional.com/caf9b6b99962bf5c2264824231d7a40c/1/img/bg.png');
background-position: left;
width: 900px;
  }
  #accordion h3:hover { /* efecto hover sobre esos enlaces */
    
    background-color: #EFFFEF;
    
  }  
  .periodico{
position: absolute;
top: 9px;
left: 261px;
color: #00789E;
font-size: 27px;
    }
  .contenidocom{
font-size: 14px;
margin-left: 241px;
top: 39px;
position: absolute;
    }
  .minipdf{
        position: absolute;
top: 10px;
right: 12px;
width: 64px;
    }
  .ciudad{
        color: black;
font-weight: normal;font-size: 10px;
    }
  .forma3{
        width: 297px;
margin: 60px auto 30px;
padding: 15px;
position: relative;
background: rgb(252, 252, 252);
border-radius: 4px;
font-family: century gothic;
font-size: 14px;
font-weight: bold;
width: 334px;
background-image: -moz-linear-gradient(top,#ededed,#cecece);
background-image: -ms-linear-gradient(top,#ededed,#cecece);
background-image: -o-linear-gradient(top,#ededed,#cecece);
background-image: -webkit-linear-gradient(top,#ededed,#cecece);
background-image: linear-gradient(top,#ededed,#cecece);
border: 1px solid #999;
border-radius: 8px 8px 8px 8px;
box-shadow: 0 0 3px #999;
top: 100px;
margin-left: 32%;

    }
  .styled-select select {
   background: transparent;
   width: 100%;
   padding: 5px;
   font-size: 13px;
   line-height: 1;
   border: 0;
   border-radius: 0;
   height: 34px;
   -webkit-appearance: none;
   }
  .styled-select {
       display: inline-block;
width: 200px;
height: 34px;
overflow: hidden;
background: url(img/new_arrow.png) no-repeat right #ddd;
border: 1px solid #ccc;
margin-top: 6px;border-left: 4px solid orange;
   }
   
 @media only screen 
and (min-device-width : 768px) 
and (max-device-width : 1024px) 
and (orientation : landscape) {
    .styled-select select {
   background: transparent;
   width: 100%;
   padding: 5px;
   font-size: 13px;
   line-height: 1;
   border: 0;
   border-radius: 0;
   height: 34px;
   -webkit-appearance: none;
   }
  .styled-select {
       display: inline-block;
width: 139px;
height: 34px;
overflow: hidden;
background: url(img/new_arrow.png) no-repeat right #ddd;
border: 1px solid #ccc;
margin-top: 6px;border-left: 4px solid orange;
   }
}
</style>
<?php
require '../conexion.php';

$sql="SELECT 
	a.idAnuncio,
	p.idPeriodico as 'idPeriodico',
	p.Nombre as 'periodico',
	a.NumeroPagina,
	a.Categoria as 'idCategoria',
	c.Categoria,
	a.Seccion as 'idseccion',
	s.seccion as 'seccion',
	a.TextoAnuncio,
	a.empresaAnuncio as 'idEmpresaAnuncio',
	m.marca as 'EmpresaAnuncio',
	a.Producto as 'idProducto',
	pr.nombre as 'Producto',
	if(a.Modelo='','No Disponible',a.Modelo) as 'Modelo',
	a.Marca as 'idMarca',
	m.marca as 'marcaAnuncio',
	a.Fecha,
	a.Hora,
	a.PaginaPeriodico,
	a.Medida as 'idMedida',
	ma.medidas as 'Medida',
	a.tipoColorAnuncio as 'idtipoColor',
	tc.tipo as 'TipoColor',
	a.tipoPagina,
	a.Alto,
	a.Ancho,
	a.Area,
	a.Activo,
	(ROUND( RAND(5)*10000,2))as 'Costo',
	CONCAT('/Periodicos/',p.Nombre,'/',a.Fecha,'/',a.NumeroPagina) AS 'pdf',
	CONCAT('/Periodicos/',p.Nombre,'/',a.Fecha,'/',a.NumeroPagina,'.jpg') AS 'jpg'
FROM 
	anunciosDia a,
	periodicos p,
	categoriasPeriodicos c,
	seccionesPeriodicos s,
	marcas m,
	medidasAnuncio ma,
	tipoColorAnuncio tc,
	productos pr
WHERE
	a.Periodico=p.idPeriodico AND
	a.Categoria=c.idCategoria AND
	a.Seccion=s.idSeccion AND
	a.empresaAnuncio=m.idmarca AND	
	a.Marca=m.idmarca AND
	a.Medida=ma.id_medidas AND
	a.tipoColorAnuncio=tc.id AND
	a.Producto=pr.idProducto AND
	a.Fecha BETWEEN DATE('2014-11-01') AND DATE('2014-12-16')
ORDER BY a.Periodico";

$result=  mysql_query($sql);

while ($row = mysql_fetch_array($result))
{
    $img=$row['jpg'];
    ?>
    <div id="accordion" >
        <h3>
            <div>
                <a class="fancybox" href="<?php echo $img;?>" data-fancybox-group="gallery" title="<?php echo strtoupper($row['periodico'])." | ".$row['TextoAnuncio'];?>">
                    <img src="<?php echo 'http://192.168.3.154'.$img;?>" alt=""  width="190px" height= "266px"/>
                </a>
            </div>
            <span class="periodico"><?php echo strtoupper($row['periodico']);?></span>
            <span class="contenidocom"><?php echo mostrar_fecha_completa($row['Fecha']);?></span>
            <span class="contenidocom" style="top:67px; border-bottom: dashed 1px rgb(223, 211, 211);"><span style="background-color: rgb(231, 231, 231);  width: 88px;position: inherit;">GUIA :</span>
            <span style="margin-left: 94px;color: rgb(95, 90, 90);"><?php echo strtoupper(utf8_encode($row['TextoAnuncio']));?></span></span>
            <span class="contenidocom" style="top:87px; border-bottom: dashed 1px rgb(223, 211, 211);"><span  style="background-color: rgb(231, 231, 231);width: 88px;position: inherit;">PERIODICO :</span>
                <span  style="margin-left: 95px; color: rgb(95, 90, 90);border-bottom: dashed 1px rgb(223, 211, 211);"><?php echo strtoupper($row['periodico']);?></span>
            </span>
            <span class="contenidocom" style="top:107px; border-bottom: dashed 1px rgb(223, 211, 211);">
                <span  style="background-color: rgb(231, 231, 231); width: 88px;position: inherit;"><?php echo utf8_decode('SECCIÓN :')?></span>
                <span  style="margin-left: 95px;color: rgb(95, 90, 90);border-bottom: dashed 1px rgb(223, 211, 211);"><?php echo strtoupper($row['seccion'])." <span class='ciudad'>| Pagina : ".utf8_encode(strtoupper($row['PaginaPeriodico']))."</span>";?></span>
            </span>
            <span class="contenidocom" style="top:127px; border-bottom: dashed 1px rgb(223, 211, 211);"><span style="background-color: rgb(231, 231, 231);  width: 88px;position: inherit;">MARCA :</span >
                <span  style="margin-left: 94px;color: rgb(95, 90, 90);"><?php echo strtoupper($row['marcaAnuncio']);?></span>
            </span>
            <span class="contenidocom" style="top:147px; border-bottom: dashed 1px rgb(223, 211, 211);"><span style="background-color: rgb(231, 231, 231);  width: 88px;position: inherit;">CATEGORIA :</span>
                <span  style="margin-left: 95px;color: rgb(95, 90, 90);"><?php echo strtoupper(utf8_encode($row['Categoria']));?></span>
            </span>
            <span class="contenidocom" style="top:167px; border-bottom: dashed 1px rgb(223, 211, 211);"><span style="background-color: rgb(231, 231, 231);  width: 88px;position: inherit;">PRODUCTO :</span>
                <span  style="margin-left: 95px;color: rgb(95, 90, 90);"><?php echo strtoupper(utf8_encode($row['Producto']));?></span>
            </span>
            <span class="contenidocom" style="top:187px; border-bottom: dashed 1px rgb(223, 211, 211);"><span style="background-color: rgb(231, 231, 231);  width: 88px;position: inherit;">MEDIDA :</span>
                <span  id="medida<?php echo $row['idAnuncio'];?>" style="margin-left: 95px;color: rgb(95, 90, 90);"><?php echo strtoupper(utf8_encode($row['Medida']))." ( ".$row['Alto']." x ".$row['Ancho']." )";?></span>
            </span>
            <span class="contenidocom" style="top:207px; border-bottom: dashed 1px rgb(223, 211, 211);"><span style="background-color: rgb(231, 231, 231);  width: 88px;position: inherit;">COLOR :</span>
                <span id="color<?php echo $row['idAnuncio'];?>" style="margin-left: 95px;color: rgb(95, 90, 90);"><?php echo strtoupper(utf8_encode($row['TipoColor']));?></span>
            </span>
            <span class="contenidocom" style="top:227px; border-bottom: dashed 1px rgb(223, 211, 211);"><span style="background-color: rgb(231, 231, 231);  width: 88px;position: inherit;">COSTO :</span>
                <span id="cosot<?php echo $row['idAnuncio'];?>" style="margin-left: 95px;color: rgb(95, 90, 90);"><img src="moneda.png" style="width: 23px" />$ <?php echo strtoupper(utf8_encode($row['Costo']));?></span>
            </span>
            <span ><a  onclick="javascript:peticiones.veer('<?php echo $campos['pdf']?>');" target="_black"><img src="" class="minipdf"></a></span>
        </h3>
    </div>
    <?php
}
function mostrar_fecha_completa($fecha){
    $subfecha=split("-",$fecha); 
   for($i=0;$subfecha[$i];$i++); 
    $año=$subfecha[0];
    $mes=$subfecha[1];
    $dia=$subfecha[2];

    $dia2=date( "d", mktime(0,0,0,$mes,$dia,$año));
    $mes2=date( "m", mktime(0,0,0,$mes,$dia,$año));
    $año2=date( "Y", mktime(0,0,0,$mes,$dia,$año));
    $dia_sem=date( "w", mktime(0,0,0,$mes,$dia,$año));

   switch($dia_sem)
   { 
       case "0":   // Bloque 1 
         $dia_sem3='Domingo'; 
       break; 
       
       case "1":   // Bloque 1 
         $dia_sem3='Lunes'; 
       break; 
       
       case "2":   // Bloque 1 
         $dia_sem3='Martes'; 
       break; 
   
       case "3":   // Bloque 1 
         $dia_sem3='Miercoles'; 
       break; 
       
       case "4":   // Bloque 1 
         $dia_sem3='Jueves'; 
       break;
   
       case "5":   // Bloque 1 
         $dia_sem3='Viernes'; 
       break; 
   
       case "6":   // Bloque 1 
         $dia_sem3='Sabado'; 
       break; 
   
      default:   // Bloque 3 
    };
   
    switch($mes2) 
    { 
        case "1":   // Bloque 1 
            $mes3='Enero'; 
        break; 
    
        case "2":   // Bloque 1 
            $mes3='Febrero';
        break; 
    
        case "3":   // Bloque 1 
            $mes3='Marzo';
        break; 
    
        case "4":   // Bloque 1 
            $mes3='Abril'; 
        break;  
        
        case "5":   // Bloque 1 
            $mes3='Mayo';
        break;   
        
        case "6":   // Bloque 1 
            $mes3='Junio';    
        break; 
        
        case "7":   // Bloque 1 
            $mes3='Julio';
        break; 
    
        case "8":   // Bloque 1 
            $mes3='Agosto';
        break; 
    
        case "9":   // Bloque 1 
            $mes3='Septiembre';
        break; 
    
        case "10":   // Bloque 1 
            $mes3='Octubre';
        break; 
    
        case "11":   // Bloque 1 
            $mes3='Noviembre';
        break;           
    
        case "12":   // Bloque 1 
            $mes3='Diciembre';  
        break; 
    
        default:   // Bloque 3 
     break; 
  }; 
   
   
$fecha_texto=$dia_sem3.' '.$dia2.' '.'de'.' '.$mes3.' '.'de'.' '.$año2;

return $fecha_texto;
};
?>
</body>