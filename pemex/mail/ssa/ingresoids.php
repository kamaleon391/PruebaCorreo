<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Ingreso IDS</title>
    <link rel="stylesheet" type="text/css" href="css.css">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script>
    $(document).ready(function(){

    });    

    </script>
  </head>
  <body>

    <div class="wrap">
        <form action="narro.php" method="GET">
          <h3>Ingresar Notas</h3>
          <label>Ingrese lo Ids de las Notas, separados con espacios</label>
          <select name="option" class="styled">
            <option selected="Default">Selecciona una opcion</option>
            <option value="1">José Narro Robles</option>
            <option value="2">Secretaria de Salud</option>
            <option value="3">8 Columnas</option>
            <option value="4">IMSS, DIF, ISSSTE</option>
            <option value="5">
              Durango, SLP y Zacatecas
            </option>
          </select>
          <input type="text" name="ids" id="ids">
          <input type="submit" name="enviar" value="Enviar" class="btn">
        </form>
  </div>

  </body>
</html>
