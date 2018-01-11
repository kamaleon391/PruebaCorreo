<?php 
$monitoreoGa = new mysqli("localhost", "root", "Gaddp552014", "monitoreoGa");
$poli = new mysqli("localhost", "root", "Gaddp552014", "poli");

$getNotas = "SELECT 
			    a.note_id,
			    p.actor_id,
			    IF(p.status = 'n',
			        2,
			        IF(p.status = 'p', 1, 0)) AS 'Calificacion'
			FROM
			    audits a,
			    pieces p,
			    audit_piece ap
			WHERE
			    ap.audit_id = a.id
			        AND ap.piece_id = p.id
			        AND a.audited = 1
			        AND DATE_FORMAT(a.created_at, '%Y-%m-%d') = CURDATE()
			GROUP BY a.note_id";

// Open First Stored Procedure using MYSQLI_STORE_RESULT to retain for looping
$resultPicks = $poli->query($getNotas, MYSQLI_STORE_RESULT);

// process one row at a time from first SP
while($row = $resultPicks->fetch_assoc()) 
{
	echo $row['actor_id']."\n";
	echo $row['note_id']."\n";;
	echo $row['Calificacion']."\n";;
	$inserta = "UPDATE noticiasDia SET calificacionLexica = " . $row['actor_id'] . " calificacionSemantica = ". $row['Calificacion'] ." WHERE idEditorial = ".$row['note_id'];

    // Execute second SP using value from first as a parameter (MYSQLI_USE_RESULT and free result right away)
    $monitoreoGa->query($inserta);
}

$monitoreoGa->close();
$poli->close();

echo "Actualizadas";

?>