<?php
session_start();
//require ('../includes/header.php');
require("../functions/funcions.php");

// Funció per guardar filtres a la sessió
function guardaFiltrosEnSession($data, $estat) {
    $_SESSION['filtro_data'] = $data;
    $_SESSION['filtro_estat'] = $estat;
}

//Simplement **carrega el header.php només si NO és una petició AJAX:
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['ajax'])) {
    require('../includes/header.php');
}
//===========================
// Connexió mysqli
$conn = new mysqli("localhost", "root", "mdb", "restaurantdb");
if ($conn->connect_error) {
    die("Error de connexió: " . $conn->connect_error);
}
// Si és petició AJAX
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ajax'])) {
    $data = $_POST['filtro_data'] ?? '';
    $estat = $_POST['filtro_estat'] ?? '';
    
    guardaFiltrosEnSession($data, $estat);
    
    $sql = "SELECT id_reserva, estat_reserva, id_taula, nom_client, data_reserva, hora_reserva, num_persones 
                FROM reserves WHERE 1=1";
    
    if (!empty($data)) {
        $data = $conn->real_escape_string($data);
        $sql .= " AND data_reserva = '$data'";
    }

    if ((!empty($estat)) AND ($estat == "lliure" OR $estat == "ocupada")) {
        $estat = $conn->real_escape_string($estat);
        $sql .= " AND estat_reserva = '$estat'";
    }

    $result = $conn->query($sql);
    
    if ($result && $result->num_rows > 0) {
        echo '<table class="table table-bordered table-striped mt-4">';
        echo '<thead><tr><th>ID</th><th>Estat</th><th>Taula</th><th>Client</th>
                    <th>Data</th><th>Hora</th><th>Persones</th></tr></thead><tbody>';
        while ($r = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$r['id_reserva']}</td>
                    <td>{$r['estat_reserva']}</td>
                    <td>{$r['id_taula']}</td>
                    <td>{$r['nom_client']}</td>
                    <td>{$r['data_reserva']}</td>
                    <td>{$r['hora_reserva']}</td>
                    <td>{$r['num_persones']}</td>
                  </tr>";
        }
        echo '</tbody></table>';
    } else {
        echo '<div class="alert alert-warning mt-4">No hi ha resultats.</div>';
    }
    
    
    
    $conn->close();
    exit;
}

// Valors per defecte des de sessió
$filtro_data = $_SESSION['filtro_data'] ?? '';
$filtro_estat = $_SESSION['filtro_estat'] ?? '';
?>



<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Datepicker Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" 
    		rel="stylesheet">
    <!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css"> -->
    <title>Reserves</title>
</head>
<body class="container py-4">
    <h2 class="mb-4">Llistat de Reserves</h2>

<div style="width: 50%; display: flex; align-items: center;">
    <!-- Filtres -->
    <div class="col-md-8">

        <label for="filtro_data" class="form-label">Selecciona data</label>
            <input 
                type="date" 
                id="filtro_data" 
                class="form-control" 
                name="filtro_data"
                min="<?= date('Y-m-d') ?>" 
                value="<?= htmlspecialchars($filtro_data) ?>"
            >
      </div>
        <div class="col-md-8">
            <label for="filtro_estat" class="form-label">Estat de la reserva</label>
            <select id="filtro_estat" name="filtro_estat" class="form-select">
                <!--<option value="">-- Tots --</option> -->
                <option value="totes" <?= $filtro_estat == 'totes' ? 'selected' : '' ?>>Totes</option>
                <option value="lliure" <?= $filtro_estat == 'lliure' ? 'selected' : '' ?>>Lliure</option>
                <option value="ocupada" <?= $filtro_estat == 'ocupada' ? 'selected' : '' ?>>Ocupada</option>
            </select>
        </div>
</div>
    <!-- Resultats -->
    <div id="resultats" class="mt-4">
        <div class="alert alert-info">Aplica un filtre per veure les reserves.</div>
    </div>

<!-- JS -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.ca.min.js"></script>

    <script>
    $(document).ready(function () {
        // Inicialitzar datepicker
        $('#datepicker').datepicker({
//        $('#filtro_data').datepicker({
            format: 'yyyy-mm-dd',
            language: 'ca',
            autoclose: true,
            todayHighlight: true
        });

        function carregarReserves() {
            const data = $('#filtro_data').val();
            const estat = $('#filtro_estat').val();

            const formData = new FormData();
            formData.append('ajax', '1');
            formData.append('filtro_data', data);
            formData.append('filtro_estat', estat);

            fetch('', {
                method: 'POST',
                body: formData
            })
            .then(res => res.text())
            .then(html => $('#resultats').html(html))
            .catch(() => $('#resultats').html('<div class="alert alert-danger">Error al carregar les reserves.</div>'));
        }

        $('#filtro_data').on('change', carregarReserves);
        $('#filtro_estat').on('change', carregarReserves);

        // Carregar si ja hi havia filtres a sessió
        if ($('#filtro_data').val() || $('#filtro_estat').val()) {
            carregarReserves();
        }
    });
    </script>
</body>
<?php
    require '../includes/footer.php';
?>
</html>
