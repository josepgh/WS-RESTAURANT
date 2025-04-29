
<?php
 require_once '../functions/funcions.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_taula = $_POST['id_taula'];
    $nom_client = $_POST['nom_client'];
    $data_comanda = $_POST['data_comanda'];
    $hora_comanda = $_POST['hora_comanda'];
    $num_persones = $_POST['num_persones'];

    $conn = getConnexio();
    //$stmt = $conn->prepare("INSERT INTO comandes (id_taula, nom_client, data_comanda, hora_comanda, num_persones) VALUES (DEFAULT, ?, ?, ?, ?, ?, DEFAULT)");
    $stmt = $conn->prepare("INSERT INTO comandes VALUES (DEFAULT, ?, ?, ?, ?, ?, DEFAULT)");
    $stmt->bind_param("isssi", $id_taula, $nom_client, $data_comanda, $hora_comanda, $num_persones);
    $stmt->execute();
    $stmt->close();

    echo "<br>$id_taula -- $nom_client --$data_comanda -- $hora_comanda -- $num_persones <br>";
    
//     -- $_POST[id_taula] -- $_POST[nom_client]
    
    // Obtenir l'últim ID o passar dades pel redirect
//     $last_id = $conn->insert_id;
//     $conn->close();

//     header("Location: comandes_view.php?id_comanda=" . $last_id);
//     exit;
}
?>
