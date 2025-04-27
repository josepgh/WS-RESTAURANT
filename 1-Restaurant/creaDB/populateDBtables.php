<?php

require_once ('../functions/funcions.php');

$conn = getConnexio();

mysqli_query($conn, "START TRANSACTION") or die("Error en START TRANSACTION : ". mysqli_error($conn));

mysqli_query($conn, "INSERT INTO personal VALUES 

    (DEFAULT, 'Carla ADM', 'administrador', 'administrador1', 'administrador1', ed25519_password('administrador1'), 'localhost', DEFAULT),
    (DEFAULT, 'Teresa ADM', 'administrador', 'administrador2', 'administrador2', ed25519_password('administrador2'), 'localhost', DEFAULT),
    (DEFAULT, 'Anna ADM', 'administrador', 'administrador3', 'administrador3', ed25519_password('administrador3'), 'localhost', DEFAULT),
    
    (DEFAULT, 'Antonia CUI', 'cuiner', 'cuiner1', 'cuiner1', ed25519_password('cuiner1'), 'localhost', DEFAULT),
    (DEFAULT, 'Kevin José CUI', 'cuiner', 'cuiner2', 'cuiner2', ed25519_password('cuiner2'), 'localhost', DEFAULT),
    (DEFAULT, 'Natàlia CUI', 'cuiner', 'cuiner3', 'cuiner3', ed25519_password('cuiner3'), 'localhost', DEFAULT),
    
    (DEFAULT, 'Vanessa CAM', 'cambrer', 'cambrer1', 'cambrer1', ed25519_password('cambrer1'), 'localhost', DEFAULT),
    (DEFAULT, 'Carlos Enrique CAM', 'cambrer', 'cambrer2', 'cambrer2', ed25519_password('cambrer2'), 'localhost', DEFAULT),
    (DEFAULT, 'Joan CAM', 'cambrer', 'cambrer3', 'cambrer3', ed25519_password('cambrer3'), 'localhost', DEFAULT);
    
    ") or die("Error en l'insert de personal: ". mysqli_error($conn));

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

mysqli_query($conn, "INSERT INTO taules VALUES
                        (DEFAULT, 1, 4),
                        (DEFAULT, 2, 4),
                        (DEFAULT, 3, 8),
                        (DEFAULT, 4, 8),
                        (DEFAULT, 5, 6),
                        (DEFAULT, 6, 6),
                        (DEFAULT, 7, 6),
                        (DEFAULT, 8, 10),
                        (DEFAULT, 9, 12);
                        ") or die("Error en l'insert de taules: ". mysqli_error($conn));

mysqli_query($conn, "INSERT INTO reserves VALUES
                        (DEFAULT, DEFAULT, 1, '', '2025-05-13', '13', 2, USER()),
                        (DEFAULT, DEFAULT, 2, '', '2025-05-13', '15', 2, USER()),
                        (DEFAULT, DEFAULT, 3, '', '2025-05-13', '13', 2, USER()),
                        (DEFAULT, 'ocupada', 4, 'Ava Gardner', '2025-05-13', '13', 2, USER()),
                        
                        (DEFAULT, DEFAULT, 1, '', '2025-05-14', '15', 2, USER()),
                        (DEFAULT, DEFAULT, 4, '', '2025-05-14', '13', 2, USER()),
                        (DEFAULT, DEFAULT, 5, '', '2025-05-14', '15', 2, USER()),
                        (DEFAULT, 'ocupada', 4, 'Marisa', '2025-05-14', '13', 2, USER()),
                        
                        (DEFAULT, DEFAULT, 2, '', '2025-05-15', '15', 2, USER()),
                        (DEFAULT, DEFAULT, 4, '', '2025-05-15', '13', 2, USER()),
                        (DEFAULT, DEFAULT, 6, '', '2025-05-15', '15', 2, USER()),
                        (DEFAULT, DEFAULT, 8, '', '2025-05-15', '13', 2, USER()),
                        (DEFAULT, 'ocupada', 4, 'Patt Highsimith', '2025-05-15', '13', 2, USER());
                        ") or die("Error en l'insert de reserves: ". mysqli_error($conn));

mysqli_query($conn, "INSERT INTO comandes VALUES
                        (DEFAULT, 1, NOW(), 'Lliurat', USER()),
                        (DEFAULT, 2, '2025-04-22', 'Lliurat', USER()),
                        (DEFAULT, 3, '2025-04-24', 'Lliurat', USER()),
                        (DEFAULT, 4, NOW(), 'Entregat', USER()),
                        (DEFAULT, 3, '2025-04-24', 'Lliurat', USER()),
                        (DEFAULT, 4, NOW(), 'En preparacio', USER());
                        ") or die("Error en l'insert de comandes: ". mysqli_error($conn));

mysqli_query($conn, "INSERT INTO detalls_comanda VALUES
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


