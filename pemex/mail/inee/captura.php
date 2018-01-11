<section id="captura">
    <header>
        <h1>Captura Noticias Portales</h1>
    </header>
    
    <section>
        <div>
            <select id="Periodico">
             <?php
                require '../conexion.php';
                $SQL="SELECT 
                                idPeriodico,Nombre 
                        FROM
                                periodicos 
                        ORDER BY Nombre";
                $result=  mysql_query($SQL);
                while ($row = mysql_fetch_array($result))
                {
                    echo "<option value='$row[idPeriodico]'>$row[Nombre]</option>";
                }
                ?>
            </select>
        </div>
        <br>
        <div>
            <label for="titulo">Titulo :</label>
            <input id="titulo" type="text">
        </div>
        <br>
        <div>
            <label for="Estado">Estado :</label>
            <select id="Estado">
                <?php
                require '../conexion.php';
                $SQL="SELECT idEstado,Nombre FROM estados";
                $result=  mysql_query($SQL);
                while ($row = mysql_fetch_array($result))
                {
                    echo "<option value='$row[idEstado]'>$row[Nombre]</option>";
                }
                ?>
            </select>
        </div>
        <br>
        <div>
            <label for="seccion"><?php echo utf8_decode('Sección :')?></label>
             <select id="seccion">
                <?php
                require '../conexion.php';
                $SQL="SELECT idseccion,seccion FROM seccionesPeriodicos";
                $result=  mysql_query($SQL);
                while ($row = mysql_fetch_array($result))
                {
                    echo "<option value='$row[idseccion]'>$row[seccion]</option>";
                }
                ?>
            </select>
        </div>
        <br>
        <div>
            <label for="categoria"><?php echo utf8_decode('Categoria :')?></label>
             <select id="categoria">
                 <option>Selecciona una opcion</option>
                 <option value="80">Contenido Web</option>
                 <option value="98">Opinion Sonora Web</option>
            </select>
        </div>
        <br>
         <div>
            <label for="autor"><?php echo utf8_decode('Autor :')?></label>
              <input id="autor" type="text">
        </div>
        <br>
        <br>
         <div>
             <label for="texto"><?php echo utf8_decode('Texto :')?></label><br>
            <textarea id="texto" cols="100" rows="20">
                
            </textarea>
        </div>
        <br>
        <br>
         <div>
             <label for="encabezado"><?php echo utf8_decode('LINK :')?></label><br>
             <input type="url" id="encabezado" size="100">
        </div>
        <br>
         <div>
             <label for="fecha"><?php echo utf8_decode('Fecha :')?></label><br>
             <input type="date" id="fecha">
        </div>
        <br>
         <div>
             <label for="hora"><?php echo utf8_decode('Hora :')?></label><br>
             <input type="time" id="hora" value="<?php echo DATE('H:i:s')?>">
        </div>
        <br>
         <div>
             <label for="foto"><?php echo utf8_decode('Foto :')?></label><br>
             <input type="checkbox" id="foto">
        </div>
        <br>
        <br>
         <div>
             <label for="PFoto"><?php echo utf8_decode('Pie de Foto :')?></label><br>
             <input type="Texto" id="PFoto">
        </div>
        <br>
        <input type="button" id="guardar" value="Guardar">
    </section>
    
    <footer>
        
    </footer>
</section>
<style>
    body{
        margin: 0;
        padding: 0;
        background-color: #666666;
    }
    #captura{
        margin: 0 auto;
        width: 80%;
        height: 1024px;
        border: white solid medium;
        text-align: center;
    }
</style>
<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script>
    $(function (){
        $('#guardar').click(function (){
            $.post('capturaWEB.php',{
                periodico:$('#Periodico').val(),
                titulo:$('#titulo').val(),
                Estado:$('#Estado').val(),
                seccion:$('#seccion').val(),
                categoria:$('#categoria').val(),
                autor:$('#autor').val(),
                texto:$('#texto').val(),
                encabezado:$('#encabezado').val(),
                fecha:$('#fecha').val(),
                hora:$('#hora').val(),
                foto:$('#foto').val(),
                PFoto:$('#PFoto').val(),
            },function(resp){
                if(resp==="ok"){
                    alert("Nota almacenada");
                    $('#titulo').val(' ');
                    $('#seccion').val(' ');
                    $('#autor').val(' ');
                    $('#texto').val(' ');
                    $('#fecha').val(' ');
                    $('#hora').val(' ');
                    $('#PFoto').val(' ');
                }else{
                    alert("Error");
                    console.log(resp);
                }
            });
        });
    });
</script>    
