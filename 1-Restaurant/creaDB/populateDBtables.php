<?php

require_once ('../functions/funcions.php');

$conn = getConnexio();

mysqli_query($conn, "START TRANSACTION") or die("Error en START TRANSACTION : ". mysqli_error($conn));

//======================================================================================================================
insertaEnPersonal('Carla ADM', 'administrador', 'administrador1', 'administrador1', 'localhost');
insertaEnPersonal('Teresa ADM', 'administrador', 'administrador2', 'administrador2', 'localhost');
insertaEnPersonal('Anna ADM', 'administrador', 'administrador3', 'administrador3', 'localhost');
//======================================================================================================================
insertaEnPersonal('Antonia CUI', 'cuiner', 'cuiner1', 'cuiner1', 'localhost');
insertaEnPersonal('Kevin José CUI', 'cuiner', 'cuiner2', 'cuiner2', 'localhost');
insertaEnPersonal('Natàlia CUI', 'cuiner', 'cuiner3', 'cuiner3', 'localhost');
//======================================================================================================================
insertaEnPersonal('Vanessa CAM', 'cambrer', 'cambrer1', 'cambrer1', 'localhost');
insertaEnPersonal('Carlos Jesús CAM', 'cambrer', 'cambrer2', 'cambrer2', 'localhost');
insertaEnPersonal('Joan CAM', 'cambrer', 'cambrer3', 'cambrer3', 'localhost');
//======================================================================================================================
// mysqli_query($conn, "INSERT INTO personal VALUES 
//     (DEFAULT, 'Antonia CUI', 'cuiner', 'cuiner1', 'cuiner1', ed25519_password('cuiner1'), 'localhost', DEFAULT),
//     (DEFAULT, 'Joan CAM', 'cambrer', 'cambrer3', 'cambrer3', ed25519_password('cambrer3'), 'localhost', DEFAULT);
//     ") or die("Error en l'insert de personal: ". mysqli_error($conn));
//======================================================================================================================

mysqli_query($conn, "INSERT INTO categories VALUES
                        (DEFAULT, 'Entrants'),
                        (DEFAULT, 'Principal'),
                        (DEFAULT, 'Postres'),
                        (DEFAULT, 'Begudes');
                        ") or die("Error en l'insert de categories: ". mysqli_error($conn));


mysqli_query($conn, "INSERT INTO plats VALUES      
                        (DEFAULT, 'Amanida verda', 'Amanida verda', 5.80, 1),
                        (DEFAULT, 'Amanida catalana', 'Amanida Catalana', 6.90, 1),
                        (DEFAULT, 'Amanida d''anxoves', 'Amanida d''anxoves', 6.90, 1),
                        (DEFAULT, 'Sopa de galets', 'Sopa de galets', 5.30, 1),
                        (DEFAULT, 'Bistec de vadella', 'Bistec de vadella', 15.20, 2),
                        (DEFAULT, 'Rap al forn', 'Rap al forn', 18.40, 2),
                        (DEFAULT, 'Anxoves farcides', 'Anxoves farcides d''ou', 18.40, 2),
                        (DEFAULT, 'Tiramisú', 'Tiramisú', 6.90, 3),
                        (DEFAULT, 'Crema catalana', 'Crema catalana', 5.90, 3),
                        (DEFAULT, 'Gelat', 'Gelat', 5.0, 3),
                        (DEFAULT, 'Cava de la casa', 'Cava de la casa', 12.20, 4),
                        (DEFAULT, 'Vi de la bodega', 'Vi de la bodega', 11.90, 4),
                        (DEFAULT, 'Vi Don Simon', 'Destrossa l''estòmac', 0.60, 4);
                        ") or die("Error en l'insert de plats: ". mysqli_error($conn));

// restaurant amb 10 taules
mysqli_query($conn, "INSERT INTO taules VALUES
                        (DEFAULT, 1, 4),
                        (DEFAULT, 2, 4),
                        (DEFAULT, 3, 8),
                        (DEFAULT, 4, 8),
                        (DEFAULT, 5, 6),
                        (DEFAULT, 6, 6),
                        (DEFAULT, 7, 6),
                        (DEFAULT, 8, 10),
                        (DEFAULT, 9, 12),
                        (DEFAULT, 10, 12);
                        ") or die("Error en l'insert de taules: ". mysqli_error($conn));

mysqli_query($conn, "INSERT INTO estats_reserva VALUES
                        (DEFAULT, 'totes'),
                        (DEFAULT, 'lliure'),
                        (DEFAULT, 'ocupada');
                        ") or die("Error en l'insert de estats reserva: ". mysqli_error($conn));

$avui = date('Y-m-d');

// CREA LES RESERVES LLIURES DE TOTES LES TAULES DISPONIBLES PER A 10 DIES
//$stmt = $conn->prepare("INSERT INTO reserves VALUES (DEFAULT, DEFAULT, ?, '', ?, '13', 0)");
$stmt = $conn->prepare("INSERT INTO reserves VALUES (DEFAULT, DEFAULT, ?, '', ?, ?, 0)");

for ($i = 0; $i <= 10; $i++) {
    $data = date('Y-m-d', strtotime("+$i days"));
    $horari = '13';
    for ($taula = 1; $taula <= 10; $taula++) {
        //echo "taula: $taula - data: $data";
        $stmt->bind_param("iss", $taula, $data, $horari);
        $stmt->execute();
    }
    $horari = '15';
    for ($taula = 1; $taula <= 10; $taula++) {
        //echo "taula: $taula - data: $data";
        $stmt->bind_param("iss", $taula, $data, $horari);
        $stmt->execute();
    }
}
$stmt->close();

// mysqli_query($conn, "INSERT INTO reserves VALUES
//                         (DEFAULT, DEFAULT, 1, '', '2025-05-13', '13', 2),
//                         (DEFAULT, 'ocupada', 4, 'Ava Gardner', '2025-05-13', '13', 2),
//                         (DEFAULT, 'ocupada', 4, 'Marisa', '2025-05-14', '13', 2),
//                         ") or die("Error en l'insert de reserves: ". mysqli_error($conn));

mysqli_query($conn, "INSERT INTO comandes VALUES
                        (DEFAULT, 1, 'nom client1', NOW(), '13', 4, DEFAULT),
                        (DEFAULT, 2, 'nom client2', '2025-04-22', '15', 3, DEFAULT),
                        (DEFAULT, 3, 'nom client3', '2025-04-24', '15', 2, DEFAULT),
                        (DEFAULT, 4, 'nom client4', NOW(), '13', 3, DEFAULT),
                        (DEFAULT, 3, 'nom client5', '2025-04-24', '15', 4, DEFAULT),
                        (DEFAULT, 4, 'nom client6', NOW(), '13', 2, DEFAULT);
                        ") or die("Error en l'insert de comandes: ". mysqli_error($conn));

mysqli_query($conn, "INSERT INTO plats_comanda VALUES
                        (DEFAULT, 1, 1, 2),
                        (DEFAULT, 1, 2, 3),
                        (DEFAULT, 1, 3, 2),
                        (DEFAULT, 2, 1, 2),
                        (DEFAULT, 2, 2, 2),
                        (DEFAULT, 2, 3, 4),
                        (DEFAULT, 3, 1, 2);
                        ") or die("Error en l'insert de detalls comanda: ". mysqli_error($conn));

mysqli_query($conn, "COMMIT") or die("Error en COMMIT : ". mysqli_error($conn));
$conn->close();
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
    <!-- 	Bootstrap CSS (des de CDN) -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" 
			integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
	
    <!-- <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/estils.css">
    <title>POPULATE db TABLES</title>
</head>

<body>
	<br><br>
	<form action="../index.php">
		<input type="submit" value="Tornar a INDEX INICI">
	</form>
</body>
</html>
<?php
    require '../includes/footer.php';
?>




