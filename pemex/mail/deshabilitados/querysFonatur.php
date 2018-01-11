<?php
function query($op,$fechaTabla,$cir)
{
    $query;
    $fecha=$fechaTabla;
    $FechaCliente = strtotime($fechaTabla);
    $fecha_actual1 = date('Y-m-d');
    $fecha_actual = strtotime($fecha_actual1);     
    if ($FechaCliente == $fecha_actual)
    {
        $fechaTabla="editorialdia";
    }
    else
    {
        $fechaTabla="editorialsemanal";
    }
    switch ($op)
    {   
        case 1:// PRIMERAS PLANAS
            $query="SELECT e.idEditorial, e.periodico,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as Fecha, e.Titulo,e.Seccion, e.NumeroPagina, e.Texto,
                        CONCAT('../../../',DATE_FORMAT(e.Fecha, '%Y'),'/Intranet/Periodicos/',e.periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS pdf,p.estado
                        FROM ".$fechaTabla." e, ordenpersonalizado o, periodicos p
                        WHERE  e.periodico=o.periodico AND e.periodico=p.nombre AND  e.categoria like 'Nota Principal' 
                        AND e.periodico IN (SELECT periodico FROM ordenpersonalizado op) AND e.fecha='$fecha'
                        group by  e.periodico order by o.posicion";
            return $query;
        break;
        case 2:// COLUMNAS POLITICAS
            $query="SELECT e.idEditorial, e.periodico,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as Fecha, e.Titulo,e.Seccion, e.NumeroPagina, e.Texto,
                        CONCAT('../../../',DATE_FORMAT(e.Fecha, '%Y'),'/Intranet/Periodicos/',e.periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS pdf
                        FROM ".$fechaTabla." e,ordenpersonalizado o
                        WHERE  e.periodico=o.periodico AND 
                        (categoria like '%Columnas Politicas%' ) AND 
                        e.periodico in(SELECT periodico FROM ordenpersonalizado op)  AND e.fecha='$fecha' order by o.posicion";
            return $query;
        break;
        case 3:// COLUMNAS FINANCIERAS
            $query="SELECT e.idEditorial, e.periodico,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as Fecha, e.Titulo,e.Seccion, e.NumeroPagina, e.Texto,
                        CONCAT('../../../',DATE_FORMAT(e.Fecha, '%Y'),'/Intranet/Periodicos/',e.periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS pdf
                        FROM ".$fechaTabla." e,ordenpersonalizado o
                        WHERE  e.periodico=o.periodico AND 
                        (categoria like '%Columnas Financieras%' ) AND 
                        e.periodico in(SELECT periodico FROM ordenpersonalizado op)  AND fecha='$fecha' order by o.posicion";
            return $query;
        break;
        case 4:// CARTONES
            $query="SELECT e.idEditorial, e.periodico,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as Fecha, e.Titulo,e.Seccion, e.NumeroPagina, e.Texto,
                        CONCAT('../../../',DATE_FORMAT(e.Fecha, '%Y'),'/Intranet/Periodicos/',e.periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS pdf
                        FROM ".$fechaTabla." e,ordenpersonalizado o
                        WHERE  e.periodico=o.periodico AND 
                        (categoria like '%cartones%' ) AND 
                        e.periodico in(SELECT periodico FROM ordenpersonalizado op)  AND e.fecha='$fecha' order by o.posicion";
            
            break;
        case 5:
           $query="SELECT e.idEditorial, e.periodico,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as Fecha, e.Titulo,e.Seccion, e.NumeroPagina, e.Texto,
                    CONCAT('../../../',DATE_FORMAT(e.Fecha, '%Y'),'/Intranet/Periodicos/',e.periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS pdf
                    FROM  ".$fechaTabla." e, periodicos p 
                    WHERE(
                        Texto like '%Claudia Ruiz Massieu%' OR
                        Texto like '%Ruiz Massieu%' OR
                        Texto like '%Secretaria de Turismo%' OR
                        Texto like '%SECTUR%' OR
                        Texto like '%titular de Turismo%' OR

                        Titulo like '%Claudia Ruiz Massieu%' OR
                        Titulo like '%Ruiz Massieu%' OR
                        Titulo like '%SECTUR%' OR
                        Titulo like '%Secretaria de Turismo%' OR
                        Titulo like '%titular de Turismo%' OR

                        Encabezado like'%Claudia Ruiz Massieu%' OR
                        Encabezado like'%Ruiz Massieu%' OR
                        Encabezado like '%SECTUR%' OR
                        Encabezado like'%Secretaria de Turismo%' OR
                        Encabezado like'%titular de Turismo%'
                       )
                   AND e.periodico=p.nombre AND p.circulacion='$cir' AND Tipo=0
                   group by e.periodico,e.NumeroPagina        
                   order by p.estado, p.nombre";
            
        break;//Héctor Martín Gómez Barrazal 
    
        case 6:
           $query="SELECT e.idEditorial, e.periodico,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as Fecha, e.Titulo,e.Seccion, e.NumeroPagina, e.Texto,
                    CONCAT('../../../',DATE_FORMAT(e.Fecha, '%Y'),'/Intranet/Periodicos/',e.periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS pdf
                    FROM  ".$fechaTabla." e, periodicos p 
                    WHERE(
                        Texto like'%fonatur%' OR
                        Texto like '%FONDO NACIONAL DE FOMENTO AL TURISMO%' OR

                        Titulo like'%fonatur%' OR
                        Titulo like '%FONDO NACIONAL DE FOMENTO AL TURISMO%' OR

                        Encabezado like'%fonatur%' OR
                        Encabezado like '%FONDO NACIONAL DE FOMENTO AL TURISMO%' OR 

                        Texto like'%Hector Martin Gomez Barraza%' OR
                        Texto like'%Martin Gomez Barraza%' OR
                        Texto like'%Hector Martin Gomez%' OR
                        Texto like'%Gomez Barraza%' OR
                        Texto like'%Titular del Fonatur%' OR

                        Titulo like'%Hector Martin Gomez Barraza%' OR
                        Titulo like'%Martin Gomez Barraza%' OR
                        Titulo like'%Hector Martin Gomez%' OR
                        Titulo like'%Gomez Barraza%' OR
                        Titulo like'%Titular del Fonatur%' OR

                        Encabezado like'%Hector Martin Gomez Barraza%' OR
                        Encabezado like'%Martin Gomez Barraza%' OR
                        Encabezado like'%Hector Martin Gomez%' OR
                        Encabezado like'%Gomez Barraza%' OR
                        Encabezado like'%Titular del Fonatur%'
                       )
                   AND e.periodico=p.nombre AND p.circulacion='$cir' AND Tipo=0
                   group by e.periodico,e.NumeroPagina            
                   order by p.estado, p.nombre";
            
        break;//FONATUR
    
        case 7:
           $query="SELECT e.idEditorial, e.periodico,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as Fecha, e.Titulo,e.Seccion, e.NumeroPagina, e.Texto,
                    CONCAT('../../../',DATE_FORMAT(e.Fecha, '%Y'),'/Intranet/Periodicos/',e.periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS pdf
                    FROM  ".$fechaTabla." e, periodicos p 
                    WHERE(
                        Texto like'%tianguis turistico%' OR
                        Texto like'%tianguis turistico mexico 2014%' OR
                        Texto like '%Tianguis turistico quintana roo 2014%' OR 
                        Texto like '%Tianguis turistico quintana roo%' OR 

                        Titulo like'%tianguis turistico%' OR
                        Titulo like'%tianguis turistico mexico 2014%' OR
                        Titulo like '%Tianguis turistico quintana roo 2014%' OR 
                        Titulo like '%Tianguis turistico quintana roo%' OR 

                        Encabezado like'%tianguis turistico%' OR
                        Encabezado like'%tianguis turistico mexico 2014%' OR
                        Encabezado like '%Tianguis turistico quintana roo 2014%' OR 
                        Encabezado like '%Tianguis turistico quintana roo%' 
                       )
                   AND e.periodico=p.nombre AND p.circulacion='$cir' AND Tipo=0
                   group by e.periodico,e.NumeroPagina            
                   order by p.estado, p.nombre";
            
        break;//Subsecretarias
    
        case 8:
           $query="SELECT e.idEditorial, e.periodico,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as Fecha, e.Titulo,e.Seccion, e.NumeroPagina, e.Texto,
                    CONCAT('../../../',DATE_FORMAT(e.Fecha, '%Y'),'/Intranet/Periodicos/',e.periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS pdf
                    FROM  ".$fechaTabla." e, periodicos p 
                    WHERE(
                            Texto like'%fonatur%' OR
                            Texto like '%Subsecretario de SECTUR%' OR
                            Texto like '%subsecretario de innovacion y desarrollo turistico%' OR
                            Texto like '%subsecretario de Planeacion y Politica turistica%' OR
                            Texto like '%subsecretario de calidad y regulacion%' OR
                            Texto like'%fonatur constructora%' OR
                            Texto like'%fonatur mantenimiento%' OR
                            Texto like'%fonatur operadora%' OR

                            Titulo like'%fonatur%' OR
                            Titulo like '%Subsecretario de SECTUR%' OR
                            Titulo like '%subsecretario de innovacion y desarrollo turistico%' OR
                            Titulo like '%subsecretario de Planeacion y Politica turistica%' OR
                            Titulo like '%subsecretario de calidad y regulacion%' OR
                            Titulo like'%fonatur constructora%' OR
                            Titulo like'%fonatur mantenimiento%' OR
                            Titulo like'%fonatur operadora%' OR


                            Encabezado like'%fonatur%' OR
                            Encabezado like '%Subsecretario de SECTUR%' OR
                            Encabezado like '%subsecretario de innovacion y desarrollo turistico%' OR
                            Encabezado like '%subsecretario de Planeacion y Politica turistica%' OR
                            Encabezado like '%subsecretario de calidad y regulacion%' OR
                            Encabezado like'%fonatur constructora%' OR
                            Encabezado like'%fonatur mantenimiento%' OR
                            Encabezado like'%fonatur operadora%' OR 
                                    (Texto like '%subsecretario%' AND Texto like '%SECTUR%') OR 
                                    (Titulo like '%subsecretario%' AND Titulo like '%SECTUR%') OR
                                    (Encabezado like '%subsecretario%' AND Encabezado like '%SECTUR%')
                           )
                   AND e.periodico=p.nombre AND p.circulacion='$cir' AND Tipo=0
                   group by e.periodico,e.NumeroPagina            
                   order by p.estado, p.nombre";
            
        break;//Funcionarios
    
        case 9:
           $query="SELECT e.idEditorial, e.periodico,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as Fecha, e.Titulo,e.Seccion, e.NumeroPagina, e.Texto,
                    CONCAT('../../../',DATE_FORMAT(e.Fecha, '%Y'),'/Intranet/Periodicos/',e.periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS pdf
                    FROM  ".$fechaTabla." e, periodicos p 
                    WHERE(
                            Texto like '%Sandra Barbara Avalos Felix%' OR
                            Texto like '%Sandra Avalos Felix%' OR
                            Texto like '%Sandra Barbara Avalos%' OR
                            Texto like '%Mauricio ruiz Falcon%' OR
                            Texto like '%ricardo Sanchez Salazar%' OR
                            Texto like '%Jesus Manuel Montoya valencia%' OR
                            Texto like '%Jesus Manuel Montoya%' OR
                            Texto like '%Jesus  Montoya valencia%' OR
                            Texto like '%Montoya valencia%' OR
                            Texto like '%Fernando Jacinto Serrano%' OR
                            Texto like '%Edgar Perez Castillo%' OR
                            Texto like '%Cristian Lopez Bonilla%' OR
                            Texto like '%Juan Marcel Arturo Garcia Santillan%' OR
                            Texto like '%Juan Marcel Arturo Garcia%' OR
                            Texto like '%Juan Marcel Garcia Santillan%' OR
                            Texto like '%Juan Garcia Santillan%' OR
                            Texto like '%Francisco Javier Rivera zaragoza%' OR
                            Texto like '%Jairo Rodriguez Correa%' OR
                            Texto like '%Juan Gerardo Quiroz Villanueva%' OR
                            Texto like '%Jose Orozco Deniz%' OR
                            Texto like '%Juan Carlos escobedo Jimenez%' OR
                            Texto like '%Maurilio David Manzanarez Ortuno%' OR
                            Texto like '%Maurilio Manzanarez Ortuno%' OR
                            Texto like '%Gonzalo Palacios Arreola%' OR
                            Texto like '%Jesus Horacio Garcia Fleys%' OR
                            Texto like '%Francisco Javier Rabago Rosales%' OR
                            Texto like '%Alejandro Alfaro Garcia%' OR
                            Texto like '%Artuo Mosconi Godinez%' OR
                            Texto like '%Esteban Arjona Talamantes%' OR
                            Texto like '%Jose Luis Rodriguez Cano%' OR
                            Texto like '%Yuliana Guendolay ruiz%' OR
                            Texto like '%Armando Garcia aldama%' OR
                            Texto like '%Eduardo Garcia valdelamar%' OR
                            Texto like '%jose Ricardo Picos Quintero%' OR
                            Texto like '%Luis Felipe de la rosa mendoza%' OR
                            Texto like '%Juan Jose Perez lopez%' OR
                            Texto like '%Juan antonio paredes nava%' OR
                            Texto like '%Irineo Jasso Arevalo%' OR
                            Texto like '%Tizoc Gonzalo del real ruedas%' OR
                            Texto like '%Lucia Macedo nunez%' OR
                            Texto like '%Monica de jesus Gonzalez%' OR
                            Texto like '%Francisco tomas velazquez resendiz%' OR
                            Texto like '%Raul Ramos alcantara%' OR
                            Texto like '%Adriana Martuscelli Mendez%' OR
                            Texto like '%Ruben Lopez Luna%' OR
                            Texto like '%Silvia Raquel Esparza alanis%' OR
                            Texto like '%Karla Ruth Orozco Toledano%' OR
                            Texto like '%Javier Manuel Torres Duran%' OR
                            Texto like '%Jose Miguel Bernal Vega%' OR
                            Texto like '%Juan Carlos Cardona Aldave%' OR
                            Texto like '%Esperanza Rosales Ojeda%' OR
                            Texto like '%Braulio Escobar Corona%' OR
                            Texto like '%Gabriela Ramirez Ortiz%' OR
                            Texto like '%Laura Erika Flores Monterrubio%' OR
                            Texto like '%Noe Martin Vazquez Perez%' OR
                            Texto like '%Antonio Tosqui Fuentes%' OR
                            Texto like '%Noemi Daniella Zepeda Medina%' OR
                            Texto like '%Jorge Antonio Alvarez Alcacio%' OR
                            Texto like '%Mariana Ramirez Osornio%' OR
                            Texto like '%Elizabeth Garcia Mendoza%' OR
                            Texto like '%Gabriel Hernandez Marquina%' OR
                            Texto like '%Agustin Garcia Villa Rio%' OR
                            Texto like '%Paulina Dominguez Aguilar%' OR
                            Texto like '%Reyna Argentina Andrade Parissi%' OR
                            Texto like '%Adriana Aguilar Gallardo%' OR
                            Texto like '%Joaquin Armenta Gomez%' OR
                            Texto like '%Oscar Navarro Cortes%' OR
                            Texto like '%Carlos Arturo Cruz Perez%' OR
                            Texto like '%Dora Maria Catillo Linares%' OR
                            Texto like '%Julio Montano resendiz%' OR
                            Texto like '%Monica Lopez Garcia%' OR
                            Texto like '%Jose Eric Arriaga Fernandez%' OR
                            Texto like '%Gil Hernandez Santoyo%' OR
                            Texto like '%Jorge Morales Alavez%' OR
                            Texto like '%Roberto Apolinar Lezama%' OR
                            Texto like '%Javier Alcantara Donnadieu%' OR
                            Texto like '%Juan Roel Isarael Medina Lopez%' OR
                            Texto like '%Serafin Montales Garcia%' OR
                            Texto like '%Iram Gustavo Medina Lopez%' OR
                            Texto like '%Itzel Zuyeli Pedroza Ibarra%' OR

                            Titulo like '%Sandra Barbara Avalos Felix%' OR
                            Titulo like '%Sandra Avalos Felix%' OR
                            Titulo like '%Sandra Barbara Avalos%' OR
                            Titulo like '%Mauricio ruiz Falcon%' OR
                            Titulo like '%ricardo Sanchez Salazar%' OR
                            Titulo like '%Jesus Manuel Montoya valencia%' OR
                            Titulo like '%Jesus Manuel Montoya%' OR
                            Titulo like '%Jesus  Montoya valencia%' OR
                            Titulo like '%Montoya valencia%' OR
                            Titulo like '%Fernando Jacinto Serrano%' OR
                            Titulo like '%Edgar Perez Castillo%' OR
                            Titulo like '%Cristian Lopez Bonilla%' OR
                            Titulo like '%Juan Marcel Arturo Garcia Santillan%' OR
                            Titulo like '%Juan Marcel Arturo Garcia%' OR
                            Titulo like '%Juan Marcel Garcia Santillan%' OR
                            Titulo like '%Juan Garcia Santillan%' OR
                            Titulo like '%Francisco Javier Rivera zaragoza%' OR
                            Titulo like '%Jairo Rodriguez Correa%' OR
                            Titulo like '%Juan Gerardo Quiroz Villanueva%' OR
                            Titulo like '%Jose Orozco Deniz%' OR
                            Titulo like '%Juan Carlos escobedo Jimenez%' OR
                            Titulo like '%Maurilio David Manzanarez Ortuno%' OR
                            Titulo like '%Maurilio Manzanarez Ortuno%' OR
                            Titulo like '%Gonzalo Palacios Arreola%' OR
                            Titulo like '%Jesus Horacio Garcia Fleys%' OR
                            Titulo like '%Francisco Javier Rabago Rosales%' OR
                            Titulo like '%Alejandro Alfaro Garcia%' OR
                            Titulo like '%Artuo Mosconi Godinez%' OR
                            Titulo like '%Esteban Arjona Talamantes%' OR
                            Titulo like '%Jose Luis Rodriguez Cano%' OR
                            Titulo like '%Yuliana Guendolay ruiz%' OR
                            Titulo like '%Armando Garcia aldama%' OR
                            Titulo like '%Eduardo Garcia valdelamar%' OR
                            Titulo like '%jose Ricardo Picos Quintero%' OR
                            Titulo like '%Luis Felipe de la rosa mendoza%' OR
                            Titulo like '%Juan Jose Perez lopez%' OR
                            Titulo like '%Juan antonio paredes nava%' OR
                            Titulo like '%Irineo Jasso Arevalo%' OR
                            Titulo like '%Tizoc Gonzalo del real ruedas%' OR
                            Titulo like '%Lucia Macedo nunez%' OR
                            Titulo like '%Monica de jesus Gonzalez%' OR
                            Titulo like '%Francisco tomas velazquez resendiz%' OR
                            Titulo like '%Raul Ramos alcantara%' OR
                            Titulo like '%Adriana Martuscelli Mendez%' OR
                            Titulo like '%Ruben Lopez Luna%' OR
                            Titulo like '%Silvia Raquel Esparza alanis%' OR
                            Titulo like '%Karla Ruth Orozco Toledano%' OR
                            Titulo like '%Javier Manuel Torres Duran%' OR
                            Titulo like '%Jose Miguel Bernal Vega%' OR
                            Titulo like '%Juan Carlos Cardona Aldave%' OR
                            Titulo like '%Esperanza Rosales Ojeda%' OR
                            Titulo like '%Braulio Escobar Corona%' OR
                            Titulo like '%Gabriela Ramirez Ortiz%' OR
                            Titulo like '%Laura Erika Flores Monterrubio%' OR
                            Titulo like '%Noe Martin Vazquez Perez%' OR
                            Titulo like '%Antonio Tosqui Fuentes%' OR
                            Titulo like '%Noemi Daniella Zepeda Medina%' OR
                            Titulo like '%Jorge Antonio Alvarez Alcacio%' OR
                            Titulo like '%Mariana Ramirez Osornio%' OR
                            Titulo like '%Elizabeth Garcia Mendoza%' OR
                            Titulo like '%Gabriel Hernandez Marquina%' OR
                            Titulo like '%Agustin Garcia Villa Rio%' OR
                            Titulo like '%Paulina Dominguez Aguilar%' OR
                            Titulo like '%Reyna Argentina Andrade Parissi%' OR
                            Titulo like '%Adriana Aguilar Gallardo%' OR
                            Titulo like '%Joaquin Armenta Gomez%' OR
                            Titulo like '%Oscar Navarro Cortes%' OR
                            Titulo like '%Carlos Arturo Cruz Perez%' OR
                            Titulo like '%Dora Maria Catillo Linares%' OR
                            Titulo like '%Julio Montano resendiz%' OR
                            Titulo like '%Monica Lopez Garcia%' OR
                            Titulo like '%Jose Eric Arriaga Fernandez%' OR
                            Titulo like '%Gil Hernandez Santoyo%' OR
                            Titulo like '%Jorge Morales Alavez%' OR
                            Titulo like '%Roberto Apolinar Lezama%' OR
                            Titulo like '%Javier Alcantara Donnadieu%' OR
                            Titulo like '%Juan Roel Isarael Medina Lopez%' OR
                            Titulo like '%Serafin Montales Garcia%' OR
                            Titulo like '%Iram Gustavo Medina Lopez%' OR
                            Titulo like '%Itzel Zuyeli Pedroza Ibarra%' OR

                            Encabezado like '%Sandra Barbara Avalos Felix%' OR
                            Encabezado like '%Sandra Avalos Felix%' OR
                            Encabezado like '%Sandra Barbara Avalos%' OR
                            Encabezado like '%Mauricio ruiz Falcon%' OR
                            Encabezado like '%ricardo Sanchez Salazar%' OR
                            Encabezado like '%Jesus Manuel Montoya valencia%' OR
                            Encabezado like '%Jesus Manuel Montoya%' OR
                            Encabezado like '%Jesus  Montoya valencia%' OR
                            Encabezado like '%Montoya valencia%' OR
                            Encabezado like '%Fernando Jacinto Serrano%' OR
                            Encabezado like '%Edgar Perez Castillo%' OR
                            Encabezado like '%Cristian Lopez Bonilla%' OR
                            Encabezado like '%Juan Marcel Arturo Garcia Santillan%' OR
                            Encabezado like '%Juan Marcel Arturo Garcia%' OR
                            Encabezado like '%Juan Marcel Garcia Santillan%' OR
                            Encabezado like '%Juan Garcia Santillan%' OR
                            Encabezado like '%Francisco Javier Rivera zaragoza%' OR
                            Encabezado like '%Jairo Rodriguez Correa%' OR
                            Encabezado like '%Juan Gerardo Quiroz Villanueva%' OR
                            Encabezado like '%Jose Orozco Deniz%' OR
                            Encabezado like '%Juan Carlos escobedo Jimenez%' OR
                            Encabezado like '%Maurilio David Manzanarez Ortuno%' OR
                            Encabezado like '%Maurilio Manzanarez Ortuno%' OR
                            Encabezado like '%Gonzalo Palacios Arreola%' OR
                            Encabezado like '%Jesus Horacio Garcia Fleys%' OR
                            Encabezado like '%Francisco Javier Rabago Rosales%' OR
                            Encabezado like '%Alejandro Alfaro Garcia%' OR
                            Encabezado like '%Artuo Mosconi Godinez%' OR
                            Encabezado like '%Esteban Arjona Talamantes%' OR
                            Encabezado like '%Jose Luis Rodriguez Cano%' OR
                            Encabezado like '%Yuliana Guendolay ruiz%' OR
                            Encabezado like '%Armando Garcia aldama%' OR
                            Encabezado like '%Eduardo Garcia valdelamar%' OR
                            Encabezado like '%jose Ricardo Picos Quintero%' OR
                            Encabezado like '%Luis Felipe de la rosa mendoza%' OR
                            Encabezado like '%Juan Jose Perez lopez%' OR
                            Encabezado like '%Juan antonio paredes nava%' OR
                            Encabezado like '%Irineo Jasso Arevalo%' OR
                            Encabezado like '%Tizoc Gonzalo del real ruedas%' OR
                            Encabezado like '%Lucia Macedo nunez%' OR
                            Encabezado like '%Monica de jesus Gonzalez%' OR
                            Encabezado like '%Francisco tomas velazquez resendiz%' OR
                            Encabezado like '%Raul Ramos alcantara%' OR
                            Encabezado like '%Adriana Martuscelli Mendez%' OR
                            Encabezado like '%Ruben Lopez Luna%' OR
                            Encabezado like '%Silvia Raquel Esparza alanis%' OR
                            Encabezado like '%Karla Ruth Orozco Toledano%' OR
                            Encabezado like '%Javier Manuel Torres Duran%' OR
                            Encabezado like '%Jose Miguel Bernal Vega%' OR
                            Encabezado like '%Juan Carlos Cardona Aldave%' OR
                            Encabezado like '%Esperanza Rosales Ojeda%' OR
                            Encabezado like '%Braulio Escobar Corona%' OR
                            Encabezado like '%Gabriela Ramirez Ortiz%' OR
                            Encabezado like '%Laura Erika Flores Monterrubio%' OR
                            Encabezado like '%Noe Martin Vazquez Perez%' OR
                            Encabezado like '%Antonio Tosqui Fuentes%' OR
                            Encabezado like '%Noemi Daniella Zepeda Medina%' OR
                            Encabezado like '%Jorge Antonio Alvarez Alcacio%' OR
                            Encabezado like '%Mariana Ramirez Osornio%' OR
                            Encabezado like '%Elizabeth Garcia Mendoza%' OR
                            Encabezado like '%Gabriel Hernandez Marquina%' OR
                            Encabezado like '%Agustin Garcia Villa Rio%' OR
                            Encabezado like '%Paulina Dominguez Aguilar%' OR
                            Encabezado like '%Reyna Argentina Andrade Parissi%' OR
                            Encabezado like '%Adriana Aguilar Gallardo%' OR
                            Encabezado like '%Joaquin Armenta Gomez%' OR
                            Encabezado like '%Oscar Navarro Cortes%' OR
                            Encabezado like '%Carlos Arturo Cruz Perez%' OR
                            Encabezado like '%Dora Maria Catillo Linares%' OR
                            Encabezado like '%Julio Montano resendiz%' OR
                            Encabezado like '%Monica Lopez Garcia%' OR
                            Encabezado like '%Jose Eric Arriaga Fernandez%' OR
                            Encabezado like '%Gil Hernandez Santoyo%' OR
                            Encabezado like '%Jorge Morales Alavez%' OR
                            Encabezado like '%Roberto Apolinar Lezama%' OR
                            Encabezado like '%Javier Alcantara Donnadieu%' OR
                            Encabezado like '%Juan Roel Isarael Medina Lopez%' OR
                            Encabezado like '%Serafin Montales Garcia%' OR
                            Encabezado like '%Iram Gustavo Medina Lopez%' OR
                            Encabezado like '%Itzel Zuyeli Pedroza Ibarra%'
                            )
                   AND e.periodico=p.nombre AND p.circulacion='$cir' AND Tipo=0
                   group by e.periodico,e.NumeroPagina            
                   order by p.estado, p.nombre";
            
        break;//Delegaciones
    
        case 10:
           $query="SELECT e.idEditorial, e.periodico,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as Fecha, e.Titulo,e.Seccion, e.NumeroPagina, e.Texto,
                    CONCAT('../../../',DATE_FORMAT(e.Fecha, '%Y'),'/Intranet/Periodicos/',e.periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS pdf
                    FROM  ".$fechaTabla." e, periodicos p 
                    WHERE(
                        Texto like'%delegacion Fonatur%' OR
                        Texto like'%delegaciones Fonatur%' OR
                        Texto like'%delegado Fonatur%' OR
                        (Texto like'%delegacion%'  AND Texto like '%Fonatur%')   OR

                        Texto like'%delegacion SECTUR%' OR
                        Texto like'%delegaciones SECTUR%' OR
                        Texto like'%delegado SECTUR%' OR
                        Texto like'%delegacion secretaria de turismo%' OR
                        Texto like'%delegaciones  secretaria de turismo%' OR
                        Texto like'%delegado  secretaria de turismo%' OR
                        (Texto like'%delegacion%'  AND Texto like '%SECTUR%')   OR

                        Titulo like'%delegacion Fonatur%' OR
                        Titulo like'%delegaciones Fonatur%' OR
                        Titulo like'%delegado Fonatur%' OR
                        (Titulo like'%delegacion%'  AND Titulo like '%Fonatur%')   OR

                        Titulo like'%delegacion SECTUR%' OR
                        Titulo like'%delegaciones SECTUR%' OR
                        Titulo like'%delegado SECTUR%' OR
                        Titulo like'%delegacion secretaria de turismo%' OR
                        Titulo like'%delegaciones  secretaria de turismo%' OR
                        Titulo like'%delegado  secretaria de turismo%' OR
                        (Titulo like'%delegacion%'  AND Titulo like '%SECTUR%')   OR

                        Encabezado like'%delegacion Fonatur%' OR
                        Encabezado like'%delegaciones Fonatur%' OR
                        Encabezado like'%delegado Fonatur%' OR
                        (Encabezado like'%delegacion%'  AND Encabezado like '%Fonatur%')   OR

                        Encabezado like'%delegacion SECTUR%' OR
                        Encabezado like'%delegaciones SECTUR%' OR
                        Encabezado like'%delegado SECTUR%' OR
                        Encabezado like'%delegacion secretaria de turismo%' OR
                        Encabezado like'%delegaciones  secretaria de turismo%' OR
                        Encabezado like'%delegado  secretaria de turismo%' OR
                        (Encabezado like'%delegacion%'  AND Encabezado like '%SECTUR%')  

                       )
                   AND e.periodico=p.nombre AND p.circulacion='$cir' AND Tipo=0
                   group by e.periodico,e.NumeroPagina 
                   order by p.estado, p.nombre";
            
        break;//Desarrollos Turisticos
    
        case 11:
           $query="SELECT e.idEditorial, e.periodico,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as Fecha, e.Titulo,e.Seccion, e.NumeroPagina, e.Texto,
                    CONCAT('../../../',DATE_FORMAT(e.Fecha, '%Y'),'/Intranet/Periodicos/',e.periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS pdf
                    FROM  ".$fechaTabla." e, periodicos p 
                    WHERE(
                        Texto like'%Desarrollos Turisticos%' OR
                        Texto like '%desarrollo turistico%' OR
                        Texto like '%centro turistico%' OR

                        Titulo like'%Desarrollos Turisticos%' OR
                        Titulo like '%desarrollo turistico%' OR
                        Titulo like '%centro turistico%' OR        

                        Encabezado like'%Desarrollos Turisticos%' OR
                        Encabezado like '%desarrollo turistico%' OR
                        Encabezado like '%centro turistico%'
                       )
                   AND e.periodico=p.nombre AND p.circulacion='$cir' AND Tipo=0
                   group by e.periodico,e.NumeroPagina            
                   order by p.estado, p.nombre";
        break;//Hoteles
    
        case 12:
           $query="SELECT e.idEditorial, e.periodico,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as Fecha, e.Titulo,e.Seccion, e.NumeroPagina, e.Texto,
                    CONCAT('../../../',DATE_FORMAT(e.Fecha, '%Y'),'/Intranet/Periodicos/',e.periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS pdf
                    FROM  ".$fechaTabla." e, periodicos p 
                    WHERE(
                        Texto like'%Hotel%' OR
                        Texto like'%Hoteleros%' OR
                        Texto like'%Hotelero%' OR
                        Texto like'%Hoteleria%' OR

                        Titulo like'%Hotel%' OR
                        Titulo like'%Hoteleros%' OR
                        Titulo like'%Hotelero%' OR
                        Titulo like'%Hoteleria%' OR

                        Encabezado like'%Hotel%' OR
                        Encabezado like'%Hoteleros%' OR
                        Encabezado like'%Hotelero%' OR
                        Encabezado like'%Hoteleria%'
                       )
                   AND e.periodico=p.nombre AND p.circulacion='$cir' AND Tipo=0
                   group by e.periodico,e.NumeroPagina       
                   order by p.estado, p.nombre limit 0,80";
            
        break;//Restaurantes
    
        case 13:
           $query="SELECT e.idEditorial, e.periodico,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as Fecha, e.Titulo,e.Seccion, e.NumeroPagina, e.Texto,
                    CONCAT('../../../',DATE_FORMAT(e.Fecha, '%Y'),'/Intranet/Periodicos/',e.periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS pdf
                    FROM  ".$fechaTabla." e, periodicos p 
                    WHERE(
                            Texto like'%restaurante%' OR
                            Texto like'%restauranteros%' OR

                            Titulo like'%restaurante%' OR
                            Titulo like'%restauranteros%' OR

                            Encabezado like'%restaurante%' OR
                            Encabezado like'%restauranteros%'  
                           )
                   AND e.periodico=p.nombre AND p.circulacion='$cir' AND Tipo=0
                   group by e.periodico,e.NumeroPagina            
                   order by p.estado, p.nombre";
            
        break;//Pro Mexico
        case 14:
           $query="SELECT e.idEditorial, e.periodico,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as Fecha, e.Titulo,e.Seccion, e.NumeroPagina, e.Texto,
                    CONCAT('../../../',DATE_FORMAT(e.Fecha, '%Y'),'/Intranet/Periodicos/',e.periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS pdf
                    FROM  ".$fechaTabla." e, periodicos p 
                    WHERE(
                        Texto like'%promexico%' OR
                        Texto like'%pro mexico%' OR
                        Texto like'%consejo de promocion turistica%' OR
                        Texto like'%promocion turistica%' OR

                        Titulo like'%promexico%' OR
                        Titulo like'%pro mexico%' OR
                        Titulo like'%consejo de promocion turistica%' OR
                        Titulo like'%promocion turistica%' OR

                        Encabezado like'%promexico%' OR
                        Encabezado like'%pro mexico%' OR
                        Encabezado like'%consejo de promocion turistica%' OR
                        Encabezado like'%promocion turistica%'
                       )
                   AND e.periodico=p.nombre AND p.circulacion='$cir' AND Tipo=0
                   group by e.periodico,e.NumeroPagina            
                   order by p.estado, p.nombre";
            
        break;//Pro Mexico
        case 15:
           $query="SELECT e.idEditorial, e.periodico,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as Fecha, e.Titulo,e.Seccion, e.NumeroPagina, e.Texto,
                    CONCAT('../../../',DATE_FORMAT(e.Fecha, '%Y'),'/Intranet/Periodicos/',e.periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS pdf
                    FROM  ".$fechaTabla." e, periodicos p 
                    WHERE(
                            Texto like'%turismo%' OR
                            Texto like '%fonatur%' OR
                            Texto like '%sectur%' OR
                            Texto like '%ruiz massieu%' OR

                            Titulo like'%turismo%' OR
                            Titulo like '%fonatur%' OR
                            Titulo like '%sectur%' OR
                            Titulo like '%ruiz massieu%' OR

                            Encabezado like'%turismo%' OR
                            Encabezado like '%fonatur%' OR
                            Encabezado like '%sectur%' OR
                            Encabezado like '%ruiz massieu%'

                           )
                   AND e.periodico=p.nombre AND p.circulacion='$cir' AND Tipo=0
                   group by e.periodico,e.NumeroPagina            
                   order by p.estado, p.nombre Limit 0,35";
            
        break;//Pro Mexico
        case 16:
           $query="SELECT e.idEditorial, e.periodico,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as Fecha, e.Titulo,e.Seccion, e.NumeroPagina, e.Texto,
                    CONCAT('../../../',DATE_FORMAT(e.Fecha, '%Y'),'/Intranet/Periodicos/',e.periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS pdf
                    FROM  ".$fechaTabla." e, periodicos p 
                    WHERE(
                        Texto like'%cptm%' OR
                        Texto like'%Consejo de promocion turistica en Mexico%' OR

                        Titulo like'%cptm%' OR
                        Titulo like'%Consejo de promocion turistica en Mexico%' OR

                        Encabezado like'%cptm%' OR
                        Encabezado like'%Consejo de promocion turistica en Mexico%' 

                       )
                   AND e.periodico=p.nombre AND p.circulacion='$cir' AND Tipo=0
                   group by e.periodico,e.NumeroPagina            
                   order by p.estado, p.nombre Limit 0,35";
            
        break;//Pro Mexico
    
        case 17:
           $query="SELECT e.idEditorial, e.periodico,DATE_FORMAT(e.Fecha, '%Y-%m-%d') as Fecha, e.Titulo,e.Seccion, e.NumeroPagina, e.Texto,
                    CONCAT('../../../',DATE_FORMAT(e.Fecha, '%Y'),'/Intranet/Periodicos/',e.periodico,'/',DATE_FORMAT(e.Fecha, '%Y-%m-%d'),'/',e.Seccion,'/',e.Seccion,'_',e.NumeroPagina,'.pdf') AS pdf
                    FROM  ".$fechaTabla." e, periodicos p 
                    WHERE(
                    Texto like'%Claudia Ruiz Massieu%' OR
                    Texto like'%Ruiz Massieu%' OR
                    Texto like'%Ruiz Massieu salinas%' OR
                    Texto like'%titular de Turismo%' OR

                    Titulo like '%Claudia Ruiz Massieu%' OR
                    Titulo like '%Ruiz Massieu%' OR
                    Titulo like'%Ruiz Massieu salinas%' OR
                    Titulo like '%titular de Turismo%' OR

                    Encabezado like'%Claudia Ruiz Massieu%' OR
                    Encabezado like'%Ruiz Massieu%' OR
                    Encabezado like'%Ruiz Massieu salinas%' OR
                    Encabezado like'%titular de Turismo%'
                   )
                   AND e.periodico=p.nombre AND p.circulacion='$cir' AND Tipo=0
                   group by e.periodico,e.NumeroPagina            
                   order by p.estado, p.nombre Limit 0,35";
            
        break;//Pro Mexico
    
        
          
        default:
            break;
    }
    return $query;  
}
?>
