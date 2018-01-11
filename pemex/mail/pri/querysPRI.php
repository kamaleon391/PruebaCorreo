<?php
function query($op, $Tabla, $estado)
{
    $fecha = $Tabla;
    $FechaCliente = strtotime($Tabla);

    $fecha_actual1 = date('Y-m-d');
    $fecha_actual = strtotime($fecha_actual1);

    if ($fecha == date('Y-m-d')) {
        $Tabla = "noticiasDia";
    } else {
        $Tabla = "noticiasSemana";
    }
    switch ($op) {

        case 1: // PRIMERAS PLANAS
            $query = "SELECT
                    n.idEditorial,
                    n.Periodico as 'idPeriodico',
                    p.Nombre as 'periodico',
                    s.seccion,
                    n.Categoria as 'Num.Categoria',
                    c.Categoria as 'Categoria',
                    n.NumeroPagina,
                    n.Autor,
                    n.Fecha,
                    n.Hora,
                    n.Titulo,
                    n.Encabezado,
                    n.Texto,
                    n.PaginaPeriodico,
                    n.Foto,
                    n.PieFoto,
                    CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                    e.Nombre as 'Estado'
                    FROM $Tabla n, periodicos p, ordenGeneral o, seccionesPeriodicos s, categoriasPeriodicos c,estados e
                    WHERE p.idPeriodico=n.Periodico AND
                    p.idPeriodico=o.periodico AND
                    s.idSeccion=n.Seccion AND
                    c.idCategoria=n.Categoria AND
                    c.idCategoria in(3) AND
                    fecha =DATE('$fecha')  AND
                    p.estado=e.idEstado AND n.Activo=1
                    GROUP BY n.NumeroPagina,p.idPeriodico
                    ORDER BY o.posicion
                    ";
            return $query;
            break;
        case 2: // COLUMNAS POLITICAS
            $query = "SELECT
                    n.idEditorial,
                    n.Periodico as 'idPeriodico',
                    p.Nombre as 'periodico',
                    s.seccion,
                    n.Categoria as 'Num.Categoria',
                    c.Categoria as 'Categoria',
                    n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                    CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                    e.Nombre as 'Estado'
                    FROM
                    $Tabla n,
                    periodicos p,
                    ordenGeneral o,
                    seccionesPeriodicos s,
                    categoriasPeriodicos c,
                    estados e
                    WHERE
                    p.idPeriodico=n.Periodico AND
                    p.idPeriodico=o.periodico AND
                    n.Periodico=o.periodico AND
                    s.idSeccion=n.Seccion AND
                    c.idCategoria=n.Categoria AND
                    c.idCategoria in(19) AND
                    p.estado=e.idEstado AND
                    fecha =DATE('$fecha') AND n.Activo=1
                    GROUP BY n.idEditorial, n.NumeroPagina,p.idPeriodico
                    ORDER BY o.id";
            return $query;
            break;
        case 3: // COLUMNAS FINANCIERAS
            $query = "SELECT n.idEditorial,n.Periodico as 'idPeriodico',
                    p.Nombre as 'periodico',s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                    CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                    e.Nombre as 'Estado'
                    FROM
                    $Tabla n,
                    periodicos p,
                    seccionesPeriodicos s,
                    categoriasPeriodicos c,
                    estados e
                    WHERE
                    p.idPeriodico=n.Periodico AND
                    s.idSeccion=n.Seccion AND
                    c.idCategoria=n.Categoria AND
                    c.idCategoria in(20) AND
                    fecha =DATE('$fecha') AND
                    p.estado=e.idEstado AND n.Activo=1
                    GROUP BY n.idEditorial, n.NumeroPagina,p.idPeriodico ";
            return $query;
            break;
        case 4: //CARTONES
            $query = "SELECT n.idEditorial,n.Periodico as 'idPeriodico',
                    p.Nombre as 'periodico',s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                    CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                    e.Nombre as 'Estado'
                    FROM
                    $Tabla n,
                    periodicos p,
                    ordenGeneral o,
                    seccionesPeriodicos s,
                    categoriasPeriodicos c,
                    estados e
                    WHERE
                    p.idPeriodico=n.Periodico AND
                    p.idPeriodico=o.periodico AND
                    s.idSeccion=n.Seccion AND
                    c.idCategoria=n.Categoria AND
                    c.idCategoria in(18) AND
                    p.estado=9 AND
                    p.estado=e.idEstado AND
                    fecha =DATE('$fecha') AND n.Activo=1
                    GROUP BY n.idEditorial, n.NumeroPagina,p.idPeriodico
                    ORDER BY o.posicion
                    ";
            return $query;
            break;

        /*****************DF*********************/

        case 5: //Presidencia
            $query = "SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   e.Nombre as 'Estado'
                   FROM $Tabla n, periodicos p, ordenGeneral o,seccionesPeriodicos s,categoriasPeriodicos c, estados e
                   WHERE p.idPeriodico=n.Periodico AND
                   p.idPeriodico=o.periodico AND
                   s.idSeccion=n.Seccion AND
                   c.idCategoria=n.Categoria AND
                   p.estado=e.idEstado AND
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND  (
                     Titulo like '%Manlio Fabio Beltrones%' OR 
                    Texto like '%Manlio Fabio Beltrones%' OR 
                    Encabezado like '%Manlio Fabio Beltrones%'
                           )
                GROUP BY n.Periodico,n.NumeroPagina
                ORDER BY o.posicion";
            return $query;
            break;

            case 6: //Secretaria General
            $query = "SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   e.Nombre as 'Estado'
                   FROM $Tabla n, periodicos p, ordenGeneral o,seccionesPeriodicos s,categoriasPeriodicos c, estados e
                   WHERE p.idPeriodico=n.Periodico AND
                   p.idPeriodico=o.periodico AND
                   s.idSeccion=n.Seccion AND
                   c.idCategoria=n.Categoria AND
                   p.estado=e.idEstado AND
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND  (
                      Titulo like '%Carolina Monroy del Mazo%' OR Titulo like 'secretaria General' OR
                      Texto like '%Carolina Monroy%' OR Texto like 'secretaria General' OR
                      Encabezado like '%Carolina Monroy%' OR  Encabezado like '%secretaria General%'
                    )
                GROUP BY n.Periodico,n.NumeroPagina
                ORDER BY o.posicion";
            return $query;
            break;

            case 7: //CEN
            $query = "SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   e.Nombre as 'Estado'
                   FROM $Tabla n, periodicos p, ordenGeneral o,seccionesPeriodicos s,categoriasPeriodicos c, estados e
                   WHERE p.idPeriodico=n.Periodico AND
                   p.idPeriodico=o.periodico AND
                   s.idSeccion=n.Seccion AND
                   c.idCategoria=n.Categoria AND
                   p.estado=e.idEstado AND
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND  (
                      Titulo like '%Comite Ejecutivo Nacional%' OR Titulo like 'Comite Ejecutivo Nacional' OR Titulo like 'CEN' AND (Titulo like 'PRI')  OR
                      Texto like '%Comite Ejecutivo Nacional%' OR Texto like 'Comite Ejecutivo Nacional' OR Texto like 'CEN' AND (Titulo like 'PRI') OR
                      Encabezado like '%Comite Ejecutivo Nacional%' OR  Encabezado like '%Comite Ejecutivo Nacional%' OR  Encabezado like '%CEN%' AND (Encabezado like 'PRI')
                    )
                GROUP BY n.Periodico,n.NumeroPagina
                ORDER BY o.posicion";
            return $query;
            break;

            case 8: //Diputado PRI
            $query = "SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   e.Nombre as 'Estado'
                   FROM $Tabla n, periodicos p, ordenGeneral o,seccionesPeriodicos s,categoriasPeriodicos c, estados e
                   WHERE p.idPeriodico=n.Periodico AND
                   p.idPeriodico=o.periodico AND
                   s.idSeccion=n.Seccion AND
                   c.idCategoria=n.Categoria AND
                   p.estado=e.idEstado AND
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND (
                      Titulo like '% Diputado del PRI %' OR 
                      Texto like '% Diputado del PRI %' OR 
                      Encabezado like '% Diputado del PRI %' OR
                      Texto LIKE '%Soralla  Bañuelos de la Torre %' OR
                      Texto LIKE '% Samuel Aguilar Solís %' OR
                      Texto LIKE '% Diego Aguilar %' OR
                      Texto LIKE '% José Rosas Aispuro Torres %' OR
                      Texto LIKE '% Jesús Sergio Alcántara Núñez %' OR
                      Texto LIKE '% Luis Ricardo Aldana Prieto %' OR
                      Texto LIKE '% Daniel Amador Gaxiola %' OR
                      Texto LIKE '% Alberto Amador Leal %' OR
                      Texto LIKE '% Joel Ayala Almeida %' OR
                      Texto LIKE '% Roberto Badillo Martínez %' OR
                      Texto LIKE '% Toro Salvador Barajas Del %' OR
                      Texto LIKE '% Ramón Barajas López %' OR
                      Texto LIKE '% Alfredo Barba Hernández %' OR
                      Texto LIKE '% Israel Beltrán Montes %' OR
                      Texto LIKE '%Dora Luz De León Villard Sasil%' OR
                      Texto LIKE '%Daniela De Los Santos Torres %' OR
                      Texto LIKE '% Carlos Armando Biebrich Torres %' OR
                      Texto LIKE '% José Luis  Blanco Pajón %' OR
                      Texto LIKE '% Gustavo Fernando Caballero Camargo %' OR
                      Texto LIKE '% César Octavio Camacho Quiroz %' OR
                      Texto LIKE '% Jesús Ricardo Canavati Tafich %' OR
                      Texto LIKE '% Andrés Carballo Bustamante %' OR
                      Texto LIKE '% Avellano Enrique Cárdenas Del %' OR
                      Texto LIKE '% Oscar Gustavo Cárdenas Monroy %' OR
                      Texto LIKE '% Roberto Efrén Cerezo Torres %' OR
                      Texto LIKE '% Carlos Chaurand Arzate %' OR
                      Texto LIKE '% María Mercedes Colín Guadarrama %' OR
                      Texto LIKE '% Arnulfo Elías Cordero Alfonzo %' OR
                      Texto LIKE '% Garza Treviño Jorge Luis De la %' OR
                      Texto LIKE '% Antonio de Jesús Díaz Athié %' OR
                      Texto LIKE '% Elmar Darinel Díaz Solorzano %' OR
                      Texto LIKE '% Nemesio Domínguez Domínguez %' OR
                      Texto LIKE '% César Duarte Jáquez %' OR
                      Texto LIKE '% José Rubén Escajeda Jiménez %' OR
                      Texto LIKE '% Eduardo Elías Espinosa Abuxapqui %' OR
                      Texto LIKE '% Charbel Jorge Estefan Chidiac %' OR
                      Texto LIKE '% Patricio Flores Sandoval %' OR
                      Texto LIKE '% Octavio Fuentes Téllez %' OR
                      Texto LIKE '% Emilio Gamboa Patrón %' OR
                      Texto LIKE '% Horacio Emigdio Garza Garza %' OR
                      Texto LIKE '% Yary del Carmen Gebhardt Garduza %' OR
                      Texto LIKE '% Tomás Gloria Requena %' OR
                      Texto LIKE '% Elda Gómez Lugo %' OR
                      Texto LIKE '% Martha Hilda González Calderón %' OR
                      Texto LIKE '% Miguel Ángel González Salum %' OR
                      Texto LIKE '% Mariano González Zarur %' OR
                      Texto LIKE '% Javier Guerrero García %' OR
                      Texto LIKE '% Joel Guerrero Juárez %' OR
                      Texto LIKE '% Daniel Gurrión Matías %' OR
                      Texto LIKE '% Juana Leticia Herrera Ale %' OR
                      Texto LIKE '% Wenceslao Herrera Coyac %' OR
                      Texto LIKE '% Alfonso Rolando Izquierdo Bustamante %' OR
                      Texto LIKE '% Gerardo Lagunes Gallina %' OR
                      Texto LIKE '% Jorge Mario Lescieur Talavera %' OR
                      Texto LIKE '% Guillermina López Balbuena %' OR
                      Texto LIKE '% Arely Madrid Tovilla %' OR
                      Texto LIKE '% Arturo Martínez Rocha %' OR
                      Texto LIKE '% Lorena Martínez Rodríguez %' OR
                      Texto LIKE '% Víctor Manuel Méndez Lanz %' OR
                      Texto LIKE '% Gustavo Ildefonso Mendívil Amparán %' OR
                      Texto LIKE '% Lilia Guadalupe Merodio Reza %' OR
                      Texto LIKE '% Elizabeth Morales García %' OR
                      Texto LIKE '% Adolfo Mota Hernández %' OR
                      Texto LIKE '% José Murat %' OR
                      Texto LIKE '% Rogelio Muñoz Serna %' OR
                      Texto LIKE '% Hilda Areli Narvaez Bravo %' OR
                      Texto LIKE '% Arnoldo Ochoa González %' OR
                      Texto LIKE '% Gilberto Ojeda Camacho %' OR
                      Texto LIKE '% Alejandro Olivares Monterrubio %' OR
                      Texto LIKE '% Héctor Hugo Olivares Ventura %' OR
                      Texto LIKE '% Ismael Ordaz Jiménez %' OR
                      Texto LIKE '% José Ascención Orihuela Bárcenas %' OR
                      Texto LIKE '% María Dolores Lucía Ortega Tzitzihua %' OR
                      Texto LIKE '% Carpio Víctor Ortiz Del %' OR
                      Texto LIKE '% Mauricio Ortiz Proal %' OR
                      Texto LIKE '% Héctor Padilla Gutiérrez %' OR
                      Texto LIKE '% Rebollar María Beatriz Pagés Llergo %' OR
                      Texto LIKE '% Víctor Samuel Palma César %' OR
                      Texto LIKE '% Juan Manuel Parás González %' OR
                      Texto LIKE '% Martha Rocío Partida Guzmán %' OR
                      Texto LIKE '% Jesús Manuel Patrón Montalvo %' OR
                      Texto LIKE '% Ismael Peraza Valdéz %' OR
                      Texto LIKE '% Daniel Pérez Valdés %' OR
                      Texto LIKE '% María del Carmen Pinete Vargas %' OR
                      Texto LIKE '% Lourdes Quiñones Canales %' OR
                      Texto LIKE '% José Edmundo Ramírez Martínez %' OR
                      Texto LIKE '% Carlos Ramírez Ruiz %' OR
                      Texto LIKE '% Jesús Ramírez Stabros %' OR
                      Texto LIKE '% José Jesús Reyna García %' OR
                      Texto LIKE '% Alfredo Adolfo Ríos Camarena %' OR
                      Texto LIKE '% Juan Francisco Rivera Bedoya %' OR
                      Texto LIKE '% Miguel Rivero Acosta %' OR
                      Texto LIKE '% Alicia Rodríguez Martínez %' OR
                      Texto LIKE '% Bertha Yolanda Rodríguez Ramírez %' OR
                      Texto LIKE '% Carlos Rojas Gutiérrez %' OR
                      Texto LIKE '% Sara Latife Ruiz Chávez %' OR
                      Texto LIKE '% Ramón Salas López %' OR
                      Texto LIKE '% Eduardo Sánchez Hernández %' OR
                      Texto LIKE '% Sergio Sandoval Paredes %' OR
                      Texto LIKE '% Enrique Serrano Escobar %' OR
                      Texto LIKE '% Gerardo Sosa Castelán %' OR
                      Texto LIKE '% Gerardo Octavio Vargas Landeros %' OR
                      Texto LIKE '% Juan Carlos Velasco Pérez %' OR
                      Texto LIKE '% Isael Villa Villa %' OR
                      Texto LIKE '% Víctor Manuel Virgen Carrera %' OR
                      Texto LIKE '% Carlos Ernesto Zatarain González %'
                   )
                GROUP BY n.Periodico,n.NumeroPagina
                ORDER BY o.posicion";
            return $query;
            break;

            case 9: //Senadores PRI
            $query = "SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   e.Nombre as 'Estado'
                   FROM $Tabla n, periodicos p, ordenGeneral o,seccionesPeriodicos s,categoriasPeriodicos c, estados e
                   WHERE p.idPeriodico=n.Periodico AND
                   p.idPeriodico=o.periodico AND
                   s.idSeccion=n.Seccion AND
                   c.idCategoria=n.Categoria AND
                   p.estado=e.idEstado AND
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND  (
                      Titulo like '% Senador del PRI %' OR 
                      Texto like '% Senador del PRI %' OR 
                      Encabezado like '% Senador del PRI %' OR
                      Texto LIKE '%Anabel Acosta Islas%' OR
                      Texto LIKE '%Roberto Armando Albores Gleason%' OR
                      Texto LIKE '%Blanca María del Socorro Alcalá Ruiz%' OR
                      Texto LIKE '%Ivonne Liliana Álvarez García%' OR
                      Texto LIKE '%Daniel Amador Gaxiola%' OR
                      Texto LIKE '%Angélica del Rosario Araujo Lara%' OR
                      Texto LIKE '%Joel Ayala Almeida%' OR
                      Texto LIKE '%Ricardo Barroso Agramont%' OR
                      Texto LIKE '%Enrique Burgos García%' OR
                      Texto LIKE '%Jesús Casillas Romero%' OR
                      Texto LIKE '%Manuel Cavazos Lerma%' OR
                      Texto LIKE '%Raúl Cervantes Andrade%' OR
                      Texto LIKE '%Miguel Ángel Chico Herrera%' OR
                      Texto LIKE '%Manuel Humberto Cota Jiménez%' OR
                      Texto LIKE '%María Cristina Díaz Salazar%' OR
                      Texto LIKE '%María Hilaria Domínguez Arvizu%' OR
                      Texto LIKE '%Omar Fayad Meneses%' OR
                      Texto LIKE '%Braulio Manuel Fernández Aguirre%' OR
                      Texto LIKE '%Hilda Esthela Flores Escalera%' OR
                      Texto LIKE '%Margarita Flores Sánchez%' OR
                      Texto LIKE '%Emilio Gamboa Patrón%' OR
                      Texto LIKE '%Ernesto Gándara Camou%' OR
                      Texto LIKE '%Diva Hadamira Gastélum Bajo%' OR
                      Texto LIKE '%Félix Arturo González Canto%' OR
                      Texto LIKE '%Isaías González Cuevas%' OR
                      Texto LIKE '%Marcela Guerra Castillo%' OR
                      Texto LIKE '%Ismael Hernández Deras%' OR
                      Texto LIKE '%Lisbeth Hernández Lecona%' OR
                      Texto LIKE '%Ana Lilia Herrera Anzaldo%' OR
                      Texto LIKE '%Aarón Irízar López%' OR
                      Texto LIKE '%René Juárez Cisneros%' OR
                      Texto LIKE '%Patricio Martínez García%' OR
                      Texto LIKE '%Humberto Domingo Mayans Canabal%' OR
                      Texto LIKE '%Armando Neyra Chávez%' OR
                      Texto LIKE '%José Ascención Orihuela Bárcenas%' OR
                      Texto LIKE '%Graciela Ortiz González%' OR
                      Texto LIKE '%David Penchyna Grub%' OR
                      Texto LIKE '%Ma. del Rocío Pineda Gochi%' OR
                      Texto LIKE '%Raúl Aarón Pozos Lanz%' OR
                      Texto LIKE '%Itzel Sarahí Ríos de la Mora%' OR
                      Texto LIKE '%Mely Romero Celis%' OR
                      Texto LIKE '%Carlos Romero Deschamps%' OR
                      Texto LIKE '%Miguel Romo Medina%' OR
                      Texto LIKE '%Óscar Román Rosas González%' OR
                      Texto LIKE '%María Lucero Saldaña Pérez%' OR
                      Texto LIKE '%Gerardo Sánchez García%' OR
                      Texto LIKE '%Alejandro Tello Cristerna%' OR
                      Texto LIKE '%Adriana Terrazas Porras%' OR
                      Texto LIKE '%Jorge Toledo Luis%' OR
                      Texto LIKE '%Teófilo Torres Corzo%' OR
                      Texto LIKE '%Héctor Yunes Landa%' OR
                      Texto LIKE '%José Francisco Yunes Zorrilla%' OR
                      Texto LIKE '%Arturo Zamora Jiménez%'

                      )
                GROUP BY n.Periodico,n.NumeroPagina
                ORDER BY o.posicion";
            return $query;
            break;

            case 10: //PRI
            $query = "SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   e.Nombre as 'Estado'
                   FROM $Tabla n, periodicos p, ordenGeneral o,seccionesPeriodicos s,categoriasPeriodicos c, estados e
                   WHERE p.idPeriodico=n.Periodico AND
                   p.idPeriodico=o.periodico AND
                   s.idSeccion=n.Seccion AND
                   c.idCategoria=n.Categoria AND
                   p.estado=e.idEstado AND
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND  (
                     Titulo like '% PRI %' OR 
                     Titulo like '% (PRI) %' OR 
                     Titulo like '%Partido Revolucionario Institucional%' OR 
                    Texto like '% PRI %' OR 
                    Texto like '% (PRI) %' OR 
                    Texto like '%Partido Revolucionario Institucional%' OR 
                    Encabezado like '% PRI %' OR
                    Encabezado like '% (PRI) %' OR
                    Encabezado like '%Partido Revolucionario Institucional%'
                   )
                GROUP BY n.Periodico,n.NumeroPagina
                ORDER BY o.posicion";
            return $query;
            break;

            case 11: //Comites Estatales
            $query = "SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   e.Nombre as 'Estado'
                   FROM $Tabla n, periodicos p, ordenGeneral o,seccionesPeriodicos s,categoriasPeriodicos c, estados e
                   WHERE p.idPeriodico=n.Periodico AND
                   p.idPeriodico=o.periodico AND
                   s.idSeccion=n.Seccion AND
                   c.idCategoria=n.Categoria AND
                   p.estado=e.idEstado AND
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND  (
                      Titulo like '%Manlio Fabio Beltrones%' OR  Texto like '%Manlio Fabio Beltrones%' OR Encabezado like '%Manlio Fabio Beltrones%' OR
                      Titulo like '%Carolina Monroy del Mazo%' OR Titulo like 'secretaria General' OR Texto like '%Carolina Monroy del Mazo%' OR Texto like 'secretaria General' 
                      OR Encabezado like '%Carolina Monroy del Mazo%' OR  Encabezado like '%secretaria General%' OR 
                      Titulo like '%Comite Ejecutivo Nacional%' OR Titulo like 'CEN' OR Titulo like '%Comite Directivo Estatal%' AND Titulo like 'PRI' OR 
                      Texto like '%Comite Ejecutivo Nacional%' OR Texto like 'CEN' OR Texto like '%Comite Directivo Estatal%' AND Texto like 'PRI' OR Encabezado like '%Comite Ejecutivo Nacional%' 
                      OR  Encabezado like '%Comite Ejecutivo Nacional%' OR  Encabezado like 'CEN' OR Encabezado like '%Comite Directivo Estatal%'AND Encabezado like 'PRI' OR  Titulo like 'CDE' 
                      OR Texto like 'CDE' or Encabezado like 'CDE' AND Texto Like 'CDE' OR Titulo like '%Congreso del Estado%' OR Texto like '%Congreso del Estado%' 
                      or Encabezado like '%Congreso del Estado%' AND Texto Like 'PRI'
                    ) 
                GROUP BY n.Periodico,n.NumeroPagina
                ORDER BY o.posicion";
            return $query;
            break;

            case 12: //Ricardo Anaya
            $query = "SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   e.Nombre as 'Estado'
                   FROM $Tabla n, periodicos p, ordenGeneral o,seccionesPeriodicos s,categoriasPeriodicos c, estados e
                   WHERE p.idPeriodico=n.Periodico AND
                   p.idPeriodico=o.periodico AND
                   s.idSeccion=n.Seccion AND
                   c.idCategoria=n.Categoria AND
                   p.estado=e.idEstado AND
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND  (
                     Titulo like '%Ricardo Anaya%' OR 
                    Texto like '%Ricardo Anaya%' OR 
                    Encabezado like '%Ricardo Anaya%'
                   )
                GROUP BY n.Periodico,n.NumeroPagina
                ORDER BY o.posicion";
            return $query;
            break;

            case 13: //Carlos Navarrete
            $query = "SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   e.Nombre as 'Estado'
                   FROM $Tabla n, periodicos p, ordenGeneral o,seccionesPeriodicos s,categoriasPeriodicos c, estados e
                   WHERE p.idPeriodico=n.Periodico AND
                   p.idPeriodico=o.periodico AND
                   s.idSeccion=n.Seccion AND
                   c.idCategoria=n.Categoria AND
                   p.estado=e.idEstado AND
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND  (
                       Titulo like '%Carlos Navarrete%' OR 
                      Texto like '%Carlos Navarrete%' OR 
                      Encabezado like '%Carlos Navarrete%'
                    )
                GROUP BY n.Periodico,n.NumeroPagina
                ORDER BY o.posicion";
            return $query;
            break;

            case 14: //INE
            $query = "SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   e.Nombre as 'Estado'
                   FROM $Tabla n, periodicos p, ordenGeneral o,seccionesPeriodicos s,categoriasPeriodicos c, estados e
                   WHERE p.idPeriodico=n.Periodico AND
                   p.idPeriodico=o.periodico AND
                   s.idSeccion=n.Seccion AND
                   c.idCategoria=n.Categoria AND
                   p.estado=e.idEstado AND
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND  (
                      Titulo like '% INE %' OR 
                      Titulo like '% Instituto Nacional Electoral %' OR 
                      Texto like '% INE %' OR 
                      Texto like '% Instituto Nacional Electoral %' OR 
                      Encabezado like '% Instituto Nacional Electoral %' OR 
                      Encabezado like '% INE %'
                    )
                GROUP BY n.Periodico,n.NumeroPagina
                ORDER BY o.posicion";
            return $query;
            break;

            case 15: //Enrique Peña Nieto
            $query = "SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   e.Nombre as 'Estado'
                   FROM $Tabla n, periodicos p, ordenGeneral o,seccionesPeriodicos s,categoriasPeriodicos c, estados e
                   WHERE p.idPeriodico=n.Periodico AND
                   p.idPeriodico=o.periodico AND
                   s.idSeccion=n.Seccion AND
                   c.idCategoria=n.Categoria AND
                   p.estado=e.idEstado AND
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND  (
                      Texto like '%Enrique peña nieto%' OR
                      Texto like '%Presidente Peña%' OR
                      Texto like '%Peña Nieto%' OR
                      Texto like '% EPN %' OR
                      Texto like '%Presidente Constitucional de los Estados Unidos Mexicanos%' OR
                      Texto like '%Senor Licenciado Enrique Peña Nieto%' OR
                      Texto like '%@EPN%' OR
                      Texto like '%Quique Peña%' OR

                      Titulo like '%Enrique peña nieto%' OR
                      Titulo like '%Presidente Peña%' OR
                      Titulo like '%Peña Nieto%' OR
                      Titulo like '% EPN %' OR
                      Titulo like '%Presidente Constitucional de los Estados Unidos Mexicanos%' OR
                      Titulo like '%Senor Licenciado Enrique Peña Nieto%' OR
                      Titulo like '%@EPN%' OR
                      Titulo like '%Quique Peña%' OR

                      Encabezado like '%Enrique peña nieto%' OR
                      Encabezado like '%Presidente Peña%' OR
                      Encabezado like '%Peña Nieto%' OR
                      Encabezado like '% EPN %' OR
                      Encabezado like '%Presidente Constitucional de los Estados Unidos Mexicanos%' OR
                      Encabezado like '%Senor Licenciado Enrique Peña Nieto%' OR
                      Encabezado like '%@EPN%' OR
                      Encabezado like '%Quique Peña%' OR

                      Autor like '%Enrique peña nieto%' OR
                      Autor like '%Presidente Peña%' OR
                      Autor like '%Peña Nieto%' OR
                      Autor like '% EPN %' OR
                      Autor like '%Presidente Constitucional de los Estados Unidos Mexicanos%' OR
                      Autor like '%Senor Licenciado Enrique Peña Nieto%' OR
                      Autor like '%@EPN%' OR
                      Autor like '%Quique Peña%' OR

                      PieFoto like '%Enrique peña nieto%' OR
                      PieFoto like '%Presidente Peña%' OR
                      PieFoto like '%Peña Nieto%' OR
                      PieFoto like '% EPN %' OR
                      PieFoto like '%Presidente Constitucional de los Estados Unidos Mexicanos%' OR
                      PieFoto like '%Senor Licenciado Enrique Peña Nieto%' OR
                      PieFoto like '%@EPN%' OR
                      PieFoto like '%Quique Peña%'
                  )
                GROUP BY n.Periodico,n.NumeroPagina
                ORDER BY o.posicion";
            return $query;
            break;

        /***************Querys de Tablero Oaxaca******************/

        /****************** Querys Estados ************************/

        case 16: //Presidencia
            $query = "SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   e.Nombre as 'Estado'
                   FROM $Tabla n, periodicos p, seccionesPeriodicos s,categoriasPeriodicos c, estados e
                   WHERE p.idPeriodico=n.Periodico AND
                   s.idSeccion=n.Seccion AND
                   n.Seccion NOT IN (22, 29) AND
                   c.idCategoria=n.Categoria AND
                   p.estado=e.idEstado AND
                   p.Estado = $estado AND
                   n.Categoria NOT IN (80,98) AND
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND (
                     Titulo like '%Manlio Fabio Beltrones%' OR 
                    Texto like '%Manlio Fabio Beltrones%' OR 
                    Encabezado like '%Manlio Fabio Beltrones%'
                           )
                GROUP BY n.Periodico,n.NumeroPagina";
            return $query;
            break;

            case 17: //Secretaria General
            $query = "SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   e.Nombre as 'Estado'
                   FROM $Tabla n, periodicos p, seccionesPeriodicos s,categoriasPeriodicos c, estados e
                   WHERE p.idPeriodico=n.Periodico AND
                   s.idSeccion=n.Seccion AND
                   n.Seccion NOT IN (22, 29) AND
                   c.idCategoria=n.Categoria AND
                   p.estado=e.idEstado AND
                   p.Estado = $estado AND
                   n.Categoria NOT IN (80,98) AND
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND (
                      Titulo like '%Carolina Monroy del Mazo%' OR Titulo like 'secretaria General' OR
                      Texto like '%Carolina Monroy%' OR Texto like 'secretaria General' OR
                      Encabezado like '%Carolina Monroy%' OR  Encabezado like '%secretaria General%'
                    )
                GROUP BY n.Periodico,n.NumeroPagina";
            return $query;
            break;

            case 18: //CEN
            $query = "SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   e.Nombre as 'Estado'
                   FROM $Tabla n, periodicos p, seccionesPeriodicos s,categoriasPeriodicos c, estados e
                   WHERE p.idPeriodico=n.Periodico AND
                   s.idSeccion=n.Seccion AND
                   n.Seccion NOT IN (22, 29) AND
                   c.idCategoria=n.Categoria AND
                   p.estado=e.idEstado AND
                   p.Estado = $estado AND
                   n.Categoria NOT IN (80,98) AND
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND (
                      Titulo like '%Comite Ejecutivo Nacional%' OR Titulo like 'Comite Ejecutivo Nacional' OR Titulo like 'CEN' AND (Titulo like 'PRI')  OR
                      Texto like '%Comite Ejecutivo Nacional%' OR Texto like 'Comite Ejecutivo Nacional' OR Texto like 'CEN' AND (Titulo like 'PRI') OR
                      Encabezado like '%Comite Ejecutivo Nacional%' OR  Encabezado like '%Comite Ejecutivo Nacional%' OR  Encabezado like '%CEN%' AND (Encabezado like 'PRI')
                    )
                GROUP BY n.Periodico,n.NumeroPagina";
            return $query;
            break;

            case 19: //Diputados PRI
            $query = "SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   e.Nombre as 'Estado'
                   FROM $Tabla n, periodicos p, seccionesPeriodicos s,categoriasPeriodicos c, estados e
                   WHERE p.idPeriodico=n.Periodico AND
                   s.idSeccion=n.Seccion AND
                   n.Seccion NOT IN (22, 29) AND
                   c.idCategoria=n.Categoria AND
                   p.estado=e.idEstado AND
                   p.Estado = $estado AND
                   n.Categoria NOT IN (80,98) AND
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND (
                      Titulo like '% Diputado del PRI %' OR 
                      Texto like '% Diputado del PRI %' OR 
                      Encabezado like '% Diputado del PRI %' OR
                      Texto LIKE '%Soralla  Bañuelos de la Torre %' OR
                      Texto LIKE '% Samuel Aguilar Solís %' OR
                      Texto LIKE '% Diego Aguilar %' OR
                      Texto LIKE '% José Rosas Aispuro Torres %' OR
                      Texto LIKE '% Jesús Sergio Alcántara Núñez %' OR
                      Texto LIKE '% Luis Ricardo Aldana Prieto %' OR
                      Texto LIKE '% Daniel Amador Gaxiola %' OR
                      Texto LIKE '% Alberto Amador Leal %' OR
                      Texto LIKE '% Joel Ayala Almeida %' OR
                      Texto LIKE '% Roberto Badillo Martínez %' OR
                      Texto LIKE '% Toro Salvador Barajas Del %' OR
                      Texto LIKE '% Ramón Barajas López %' OR
                      Texto LIKE '% Alfredo Barba Hernández %' OR
                      Texto LIKE '% Israel Beltrán Montes %' OR
                      Texto LIKE '%Dora Luz De León Villard Sasil%' OR
                      Texto LIKE '%Daniela De Los Santos Torres %' OR
                      Texto LIKE '% Carlos Armando Biebrich Torres %' OR
                      Texto LIKE '% José Luis  Blanco Pajón %' OR
                      Texto LIKE '% Gustavo Fernando Caballero Camargo %' OR
                      Texto LIKE '% César Octavio Camacho Quiroz %' OR
                      Texto LIKE '% Jesús Ricardo Canavati Tafich %' OR
                      Texto LIKE '% Andrés Carballo Bustamante %' OR
                      Texto LIKE '% Avellano Enrique Cárdenas Del %' OR
                      Texto LIKE '% Oscar Gustavo Cárdenas Monroy %' OR
                      Texto LIKE '% Roberto Efrén Cerezo Torres %' OR
                      Texto LIKE '% Carlos Chaurand Arzate %' OR
                      Texto LIKE '% María Mercedes Colín Guadarrama %' OR
                      Texto LIKE '% Arnulfo Elías Cordero Alfonzo %' OR
                      Texto LIKE '% Garza Treviño Jorge Luis De la %' OR
                      Texto LIKE '% Antonio de Jesús Díaz Athié %' OR
                      Texto LIKE '% Elmar Darinel Díaz Solorzano %' OR
                      Texto LIKE '% Nemesio Domínguez Domínguez %' OR
                      Texto LIKE '% César Duarte Jáquez %' OR
                      Texto LIKE '% José Rubén Escajeda Jiménez %' OR
                      Texto LIKE '% Eduardo Elías Espinosa Abuxapqui %' OR
                      Texto LIKE '% Charbel Jorge Estefan Chidiac %' OR
                      Texto LIKE '% Patricio Flores Sandoval %' OR
                      Texto LIKE '% Octavio Fuentes Téllez %' OR
                      Texto LIKE '% Emilio Gamboa Patrón %' OR
                      Texto LIKE '% Horacio Emigdio Garza Garza %' OR
                      Texto LIKE '% Yary del Carmen Gebhardt Garduza %' OR
                      Texto LIKE '% Tomás Gloria Requena %' OR
                      Texto LIKE '% Elda Gómez Lugo %' OR
                      Texto LIKE '% Martha Hilda González Calderón %' OR
                      Texto LIKE '% Miguel Ángel González Salum %' OR
                      Texto LIKE '% Mariano González Zarur %' OR
                      Texto LIKE '% Javier Guerrero García %' OR
                      Texto LIKE '% Joel Guerrero Juárez %' OR
                      Texto LIKE '% Daniel Gurrión Matías %' OR
                      Texto LIKE '% Juana Leticia Herrera Ale %' OR
                      Texto LIKE '% Wenceslao Herrera Coyac %' OR
                      Texto LIKE '% Alfonso Rolando Izquierdo Bustamante %' OR
                      Texto LIKE '% Gerardo Lagunes Gallina %' OR
                      Texto LIKE '% Jorge Mario Lescieur Talavera %' OR
                      Texto LIKE '% Guillermina López Balbuena %' OR
                      Texto LIKE '% Arely Madrid Tovilla %' OR
                      Texto LIKE '% Arturo Martínez Rocha %' OR
                      Texto LIKE '% Lorena Martínez Rodríguez %' OR
                      Texto LIKE '% Víctor Manuel Méndez Lanz %' OR
                      Texto LIKE '% Gustavo Ildefonso Mendívil Amparán %' OR
                      Texto LIKE '% Lilia Guadalupe Merodio Reza %' OR
                      Texto LIKE '% Elizabeth Morales García %' OR
                      Texto LIKE '% Adolfo Mota Hernández %' OR
                      Texto LIKE '% José Murat %' OR
                      Texto LIKE '% Rogelio Muñoz Serna %' OR
                      Texto LIKE '% Hilda Areli Narvaez Bravo %' OR
                      Texto LIKE '% Arnoldo Ochoa González %' OR
                      Texto LIKE '% Gilberto Ojeda Camacho %' OR
                      Texto LIKE '% Alejandro Olivares Monterrubio %' OR
                      Texto LIKE '% Héctor Hugo Olivares Ventura %' OR
                      Texto LIKE '% Ismael Ordaz Jiménez %' OR
                      Texto LIKE '% José Ascención Orihuela Bárcenas %' OR
                      Texto LIKE '% María Dolores Lucía Ortega Tzitzihua %' OR
                      Texto LIKE '% Carpio Víctor Ortiz Del %' OR
                      Texto LIKE '% Mauricio Ortiz Proal %' OR
                      Texto LIKE '% Héctor Padilla Gutiérrez %' OR
                      Texto LIKE '% Rebollar María Beatriz Pagés Llergo %' OR
                      Texto LIKE '% Víctor Samuel Palma César %' OR
                      Texto LIKE '% Juan Manuel Parás González %' OR
                      Texto LIKE '% Martha Rocío Partida Guzmán %' OR
                      Texto LIKE '% Jesús Manuel Patrón Montalvo %' OR
                      Texto LIKE '% Ismael Peraza Valdéz %' OR
                      Texto LIKE '% Daniel Pérez Valdés %' OR
                      Texto LIKE '% María del Carmen Pinete Vargas %' OR
                      Texto LIKE '% Lourdes Quiñones Canales %' OR
                      Texto LIKE '% José Edmundo Ramírez Martínez %' OR
                      Texto LIKE '% Carlos Ramírez Ruiz %' OR
                      Texto LIKE '% Jesús Ramírez Stabros %' OR
                      Texto LIKE '% José Jesús Reyna García %' OR
                      Texto LIKE '% Alfredo Adolfo Ríos Camarena %' OR
                      Texto LIKE '% Juan Francisco Rivera Bedoya %' OR
                      Texto LIKE '% Miguel Rivero Acosta %' OR
                      Texto LIKE '% Alicia Rodríguez Martínez %' OR
                      Texto LIKE '% Bertha Yolanda Rodríguez Ramírez %' OR
                      Texto LIKE '% Carlos Rojas Gutiérrez %' OR
                      Texto LIKE '% Sara Latife Ruiz Chávez %' OR
                      Texto LIKE '% Ramón Salas López %' OR
                      Texto LIKE '% Eduardo Sánchez Hernández %' OR
                      Texto LIKE '% Sergio Sandoval Paredes %' OR
                      Texto LIKE '% Enrique Serrano Escobar %' OR
                      Texto LIKE '% Gerardo Sosa Castelán %' OR
                      Texto LIKE '% Gerardo Octavio Vargas Landeros %' OR
                      Texto LIKE '% Juan Carlos Velasco Pérez %' OR
                      Texto LIKE '% Isael Villa Villa %' OR
                      Texto LIKE '% Víctor Manuel Virgen Carrera %' OR
                      Texto LIKE '% Carlos Ernesto Zatarain González %'
                   )
                GROUP BY n.Periodico,n.NumeroPagina";
            return $query;
            break;

            case 20: //Senadores PRI
            $query = "SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   e.Nombre as 'Estado'
                   FROM $Tabla n, periodicos p, seccionesPeriodicos s,categoriasPeriodicos c, estados e
                   WHERE p.idPeriodico=n.Periodico AND
                   s.idSeccion=n.Seccion AND
                   n.Seccion NOT IN (22, 29) AND
                   c.idCategoria=n.Categoria AND
                   p.estado=e.idEstado AND
                   p.Estado = $estado AND
                   n.Categoria NOT IN (80,98) AND
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND (
                      Titulo like '% Senador del PRI %' OR 
                      Texto like '% Senador del PRI %' OR 
                      Encabezado like '% Senador del PRI %' OR
                      Texto LIKE '%Anabel Acosta Islas%' OR
                      Texto LIKE '%Roberto Armando Albores Gleason%' OR
                      Texto LIKE '%Blanca María del Socorro Alcalá Ruiz%' OR
                      Texto LIKE '%Ivonne Liliana Álvarez García%' OR
                      Texto LIKE '%Daniel Amador Gaxiola%' OR
                      Texto LIKE '%Angélica del Rosario Araujo Lara%' OR
                      Texto LIKE '%Joel Ayala Almeida%' OR
                      Texto LIKE '%Ricardo Barroso Agramont%' OR
                      Texto LIKE '%Enrique Burgos García%' OR
                      Texto LIKE '%Jesús Casillas Romero%' OR
                      Texto LIKE '%Manuel Cavazos Lerma%' OR
                      Texto LIKE '%Raúl Cervantes Andrade%' OR
                      Texto LIKE '%Miguel Ángel Chico Herrera%' OR
                      Texto LIKE '%Manuel Humberto Cota Jiménez%' OR
                      Texto LIKE '%María Cristina Díaz Salazar%' OR
                      Texto LIKE '%María Hilaria Domínguez Arvizu%' OR
                      Texto LIKE '%Omar Fayad Meneses%' OR
                      Texto LIKE '%Braulio Manuel Fernández Aguirre%' OR
                      Texto LIKE '%Hilda Esthela Flores Escalera%' OR
                      Texto LIKE '%Margarita Flores Sánchez%' OR
                      Texto LIKE '%Emilio Gamboa Patrón%' OR
                      Texto LIKE '%Ernesto Gándara Camou%' OR
                      Texto LIKE '%Diva Hadamira Gastélum Bajo%' OR
                      Texto LIKE '%Félix Arturo González Canto%' OR
                      Texto LIKE '%Isaías González Cuevas%' OR
                      Texto LIKE '%Marcela Guerra Castillo%' OR
                      Texto LIKE '%Ismael Hernández Deras%' OR
                      Texto LIKE '%Lisbeth Hernández Lecona%' OR
                      Texto LIKE '%Ana Lilia Herrera Anzaldo%' OR
                      Texto LIKE '%Aarón Irízar López%' OR
                      Texto LIKE '%René Juárez Cisneros%' OR
                      Texto LIKE '%Patricio Martínez García%' OR
                      Texto LIKE '%Humberto Domingo Mayans Canabal%' OR
                      Texto LIKE '%Armando Neyra Chávez%' OR
                      Texto LIKE '%José Ascención Orihuela Bárcenas%' OR
                      Texto LIKE '%Graciela Ortiz González%' OR
                      Texto LIKE '%David Penchyna Grub%' OR
                      Texto LIKE '%Ma. del Rocío Pineda Gochi%' OR
                      Texto LIKE '%Raúl Aarón Pozos Lanz%' OR
                      Texto LIKE '%Itzel Sarahí Ríos de la Mora%' OR
                      Texto LIKE '%Mely Romero Celis%' OR
                      Texto LIKE '%Carlos Romero Deschamps%' OR
                      Texto LIKE '%Miguel Romo Medina%' OR
                      Texto LIKE '%Óscar Román Rosas González%' OR
                      Texto LIKE '%María Lucero Saldaña Pérez%' OR
                      Texto LIKE '%Gerardo Sánchez García%' OR
                      Texto LIKE '%Alejandro Tello Cristerna%' OR
                      Texto LIKE '%Adriana Terrazas Porras%' OR
                      Texto LIKE '%Jorge Toledo Luis%' OR
                      Texto LIKE '%Teófilo Torres Corzo%' OR
                      Texto LIKE '%Héctor Yunes Landa%' OR
                      Texto LIKE '%José Francisco Yunes Zorrilla%' OR
                      Texto LIKE '%Arturo Zamora Jiménez%'

                      )
                GROUP BY n.Periodico,n.NumeroPagina";
            return $query;
            break;

            case 21: //PRI
            $query = "SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   e.Nombre as 'Estado'
                   FROM $Tabla n, periodicos p, seccionesPeriodicos s,categoriasPeriodicos c, estados e
                   WHERE p.idPeriodico=n.Periodico AND
                   s.idSeccion=n.Seccion AND
                   n.Seccion NOT IN (22, 29) AND
                   c.idCategoria=n.Categoria AND
                   p.estado=e.idEstado AND
                   p.Estado = $estado AND
                   n.Categoria NOT IN (80,98) AND
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND (
                     Titulo like '% PRI %' OR 
                     Titulo like '% (PRI) %' OR 
                     Titulo like '%Partido Revolucionario Institucional%' OR 
                    Texto like '% PRI %' OR 
                    Texto like '% (PRI) %' OR 
                    Texto like '%Partido Revolucionario Institucional%' OR 
                    Encabezado like '% PRI %' OR
                    Encabezado like '% (PRI) %' OR
                    Encabezado like '%Partido Revolucionario Institucional%'
                   )
                GROUP BY n.Periodico,n.NumeroPagina";
            return $query;
            break;

            case 22: //Comites Estatales
            $query = "SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   e.Nombre as 'Estado'
                   FROM $Tabla n, periodicos p, seccionesPeriodicos s,categoriasPeriodicos c, estados e
                   WHERE p.idPeriodico=n.Periodico AND
                   s.idSeccion=n.Seccion AND
                   n.Seccion NOT IN (22, 29) AND
                   c.idCategoria=n.Categoria AND
                   p.estado=e.idEstado AND
                   p.Estado = $estado AND
                   n.Categoria NOT IN (80,98) AND
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND (
                      Titulo like '%Manlio Fabio Beltrones%' OR  Texto like '%Manlio Fabio Beltrones%' OR Encabezado like '%Manlio Fabio Beltrones%' OR
                      Titulo like '%Carolina Monroy del Mazo%' OR Titulo like 'secretaria General' OR Texto like '%Carolina Monroy del Mazo%' OR Texto like 'secretaria General' 
                      OR Encabezado like '%Carolina Monroy del Mazo%' OR  Encabezado like '%secretaria General%' OR 
                      Titulo like '%Comite Ejecutivo Nacional%' OR Titulo like 'CEN' OR Titulo like '%Comite Directivo Estatal%' AND Titulo like 'PRI' OR 
                      Texto like '%Comite Ejecutivo Nacional%' OR Texto like 'CEN' OR Texto like '%Comite Directivo Estatal%' AND Texto like 'PRI' OR Encabezado like '%Comite Ejecutivo Nacional%' 
                      OR  Encabezado like '%Comite Ejecutivo Nacional%' OR  Encabezado like 'CEN' OR Encabezado like '%Comite Directivo Estatal%'AND Encabezado like 'PRI' OR  Titulo like 'CDE' 
                      OR Texto like 'CDE' or Encabezado like 'CDE' AND Texto Like 'CDE' OR Titulo like '%Congreso del Estado%' OR Texto like '%Congreso del Estado%' 
                      or Encabezado like '%Congreso del Estado%' AND Texto Like 'PRI'
                    ) 
                GROUP BY n.Periodico,n.NumeroPagina";
            return $query;
            break;

            case 23: //Ricardo Anaya
            $query = "SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   e.Nombre as 'Estado'
                   FROM $Tabla n, periodicos p, seccionesPeriodicos s,categoriasPeriodicos c, estados e
                   WHERE p.idPeriodico=n.Periodico AND
                   s.idSeccion=n.Seccion AND
                   n.Seccion NOT IN (22, 29) AND
                   c.idCategoria=n.Categoria AND
                   p.estado=e.idEstado AND
                   p.Estado = $estado AND
                   n.Categoria NOT IN (80,98) AND
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND (
                     Titulo like '%Ricardo Anaya%' OR 
                    Texto like '%Ricardo Anaya%' OR 
                    Encabezado like '%Ricardo Anaya%'
                   )
                GROUP BY n.Periodico,n.NumeroPagina";
            return $query;
            break;

            case 24: //Carlos Navarrete
            $query = "SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   e.Nombre as 'Estado'
                   FROM $Tabla n, periodicos p, seccionesPeriodicos s,categoriasPeriodicos c, estados e
                   WHERE p.idPeriodico=n.Periodico AND
                   s.idSeccion=n.Seccion AND
                   n.Seccion NOT IN (22, 29) AND
                   c.idCategoria=n.Categoria AND
                   p.estado=e.idEstado AND
                   p.Estado = $estado AND
                   n.Categoria NOT IN (80,98) AND
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND (
                       Titulo like '%Carlos Navarrete%' OR 
                      Texto like '%Carlos Navarrete%' OR 
                      Encabezado like '%Carlos Navarrete%'
                    )
                GROUP BY n.Periodico,n.NumeroPagina";
            return $query;
            break;

            case 25: //INE
            $query = "SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   e.Nombre as 'Estado'
                   FROM $Tabla n, periodicos p, seccionesPeriodicos s,categoriasPeriodicos c, estados e
                   WHERE p.idPeriodico=n.Periodico AND
                   s.idSeccion=n.Seccion AND
                   n.Seccion NOT IN (22, 29) AND
                   c.idCategoria=n.Categoria AND
                   p.estado=e.idEstado AND
                   p.Estado = $estado AND
                   n.Categoria NOT IN (80,98) AND
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND (
                      Titulo like '% INE %' OR 
                      Titulo like '% Instituto Nacional Electoral %' OR 
                      Texto like '% INE %' OR 
                      Texto like '% Instituto Nacional Electoral %' OR 
                      Encabezado like '% Instituto Nacional Electoral %' OR 
                      Encabezado like '% INE %'
                    )
                GROUP BY n.Periodico,n.NumeroPagina";
            return $query;
            break;

            case 26: //Enrique Peña Nieto
            $query = "SELECT n.idEditorial,
                   n.Periodico as 'idPeriodico',
                   p.Nombre as 'periodico',n.Seccion,s.seccion,n.Categoria as 'Num.Categoria',c.Categoria as 'Categoria',n.NumeroPagina,n.Autor,n.Fecha,n.Hora,n.Titulo,n.Encabezado,n.Texto,n.PaginaPeriodico,n.Foto,n.PieFoto,
                   CONCAT('/var/www/Sistema-de-Captura/Periodicos/',p.Nombre,'/',n.Fecha,'/',NumeroPagina) AS 'pdf',
                   e.Nombre as 'Estado'
                   FROM $Tabla n, periodicos p, seccionesPeriodicos s,categoriasPeriodicos c, estados e
                   WHERE p.idPeriodico=n.Periodico AND
                   s.idSeccion=n.Seccion AND
                   n.Seccion NOT IN (22, 29) AND
                   c.idCategoria=n.Categoria AND
                   p.estado=e.idEstado AND
                   p.Estado = $estado AND
                   n.Categoria NOT IN (80,98) AND
                   n.Activo=1 AND
                   fecha =DATE('$fecha') AND (
                      Texto like '%Enrique peña nieto%' OR
                      Texto like '%Presidente Peña%' OR
                      Texto like '%Peña Nieto%' OR
                      Texto like '% EPN %' OR
                      Texto like '%Presidente Constitucional de los Estados Unidos Mexicanos%' OR
                      Texto like '%Senor Licenciado Enrique Peña Nieto%' OR
                      Texto like '%@EPN%' OR
                      Texto like '%Quique Peña%' OR

                      Titulo like '%Enrique peña nieto%' OR
                      Titulo like '%Presidente Peña%' OR
                      Titulo like '%Peña Nieto%' OR
                      Titulo like '% EPN %' OR
                      Titulo like '%Presidente Constitucional de los Estados Unidos Mexicanos%' OR
                      Titulo like '%Senor Licenciado Enrique Peña Nieto%' OR
                      Titulo like '%@EPN%' OR
                      Titulo like '%Quique Peña%' OR

                      Encabezado like '%Enrique peña nieto%' OR
                      Encabezado like '%Presidente Peña%' OR
                      Encabezado like '%Peña Nieto%' OR
                      Encabezado like '% EPN %' OR
                      Encabezado like '%Presidente Constitucional de los Estados Unidos Mexicanos%' OR
                      Encabezado like '%Senor Licenciado Enrique Peña Nieto%' OR
                      Encabezado like '%@EPN%' OR
                      Encabezado like '%Quique Peña%' OR

                      Autor like '%Enrique peña nieto%' OR
                      Autor like '%Presidente Peña%' OR
                      Autor like '%Peña Nieto%' OR
                      Autor like '% EPN %' OR
                      Autor like '%Presidente Constitucional de los Estados Unidos Mexicanos%' OR
                      Autor like '%Senor Licenciado Enrique Peña Nieto%' OR
                      Autor like '%@EPN%' OR
                      Autor like '%Quique Peña%' OR

                      PieFoto like '%Enrique peña nieto%' OR
                      PieFoto like '%Presidente Peña%' OR
                      PieFoto like '%Peña Nieto%' OR
                      PieFoto like '% EPN %' OR
                      PieFoto like '%Presidente Constitucional de los Estados Unidos Mexicanos%' OR
                      PieFoto like '%Senor Licenciado Enrique Peña Nieto%' OR
                      PieFoto like '%@EPN%' OR
                      PieFoto like '%Quique Peña%'
                  )
                GROUP BY n.Periodico,n.NumeroPagina";
            return $query;
            break;

            /******************Fin Querys Estados ************************/

    }
}
