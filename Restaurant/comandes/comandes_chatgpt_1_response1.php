<?php
session_start();
require("../functions/funcions.php");

// PROCESSEM FORMULARI
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['guardar_comanda'])) {
    //$conn = getConnexio();
    $conn = getUserConnexio();
    $tipus_plats = $_POST['tipus_plat'] ?? [];
    $noms_plats = $_POST['nom_plat'] ?? [];
    $quantitats = $_POST['quantitat'] ?? [];

    $username = $_GET['username'] ?? 'Anonim';

    if (count($tipus_plats) > 0) {
        // Inserir comanda
        $stmt = $conn->prepare("INSERT INTO comandes (nom_client, data_comanda) VALUES (?, NOW())");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $idComanda = $stmt->insert_id;
        $stmt->close();

        // Inserir plats
        $stmtPlat = $conn->prepare("INSERT INTO comanda_plats (id_comanda, tipus_plat, nom_plat, quantitat) VALUES (?, ?, ?, ?)");

        for ($i = 0; $i < count($tipus_plats); $i++) {
            $stmtPlat->bind_param("issi", $idComanda, $tipus_plats[$i], $noms_plats[$i], $quantitats[$i]);
            $stmtPlat->execute();
        }

        $stmtPlat->close();
        $conn->close();

        header("Location: ../reserves/gestio_reserves.php");
        exit;
    }
}

// Carreguem opcions per selects
//$conn = getConnexio();
$conn = getUserConnexio();
$plats = [];
$result = $conn->query("SELECT tipus, nom FROM plats ORDER BY tipus, nom");
while ($row = $result->fetch_assoc()) {
    $plats[$row['tipus']][] = $row['nom'];
}
$conn->close();
?>

<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Comanda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body class="p-4">
    <h2>Comanda per <?= htmlspecialchars($_GET['username']) ?></h2>

    <!-- FORMULARI -->
    <form method="post">
        <div class="row g-3">
            <div class="col">
                <label>Tipus de plat</label>
                <select id="tipusPlat" class="form-select">
                    <option value="">-- Selecciona --</option>
                    <?php foreach (array_keys($plats) as $tipus): ?>
                        <option value="<?= $tipus ?>"><?= $tipus ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col">
                <label>Plat</label>
                <select id="nomPlat" class="form-select" disabled>
                    <option>-- Selecciona tipus --</option>
                </select>
            </div>
            <div class="col">
                <label>Quantitat</label>
                <input type="number" id="quantitat" class="form-control" min="1" value="1">
            </div>
            <div class="col align-self-end">
                <button type="button" class="btn btn-success" onclick="afegirPlat()">Afegir</button>
            </div>
        </div>

        <!-- TAULA -->
        <table class="table table-bordered mt-4" id="taulaComanda">
            <thead>
                <tr><th>#</th><th>Tipus</th><th>Plat</th><th>Quantitat</th><th></th></tr>
            </thead>
            <tbody></tbody>
        </table>

        <!-- Botó de guardar -->
        <div class="text-end">
            <button type="submit" name="guardar_comanda" class="btn btn-primary">Guardar Comanda</button>
        </div>
    </form>

<script>
const plats = <?= json_encode($plats) ?>;

// Carregar plats segons tipus
$('#tipusPlat').on('change', function() {
    const tipus = $(this).val();
    const opcions = plats[tipus] || [];
    let html = '<option value="">-- Selecciona --</option>';
    opcions.forEach(p => html += `<option value="${p}">${p}</option>`);
    $('#nomPlat').html(html).prop('disabled', opcions.length === 0);
});

// Afegir plat
function afegirPlat() {
    const tipus = $('#tipusPlat').val();
    const plat = $('#nomPlat').val();
    const quant = $('#quantitat').val();

    if (!tipus || !plat) return alert('Selecciona un plat!');

    const fila = `
        <tr>
            <td></td>
            <td>${tipus}<input type="hidden" name="tipus_plat[]" value="${tipus}"></td>
            <td>${plat}<input type="hidden" name="nom_plat[]" value="${plat}"></td>
            <td>${quant}<input type="hidden" name="quantitat[]" value="${quant}"></td>
            <td><button type="button" class="btn btn-danger btn-sm" onclick="eliminaFila(this)">X</button></td>
        </tr>`;
    $('#taulaComanda tbody').append(fila);
    actualitzaIndex();
}

// Eliminar fila
function eliminaFila(btn) {
    $(btn).closest('tr').remove();
    actualitzaIndex();
}

// Actualitzar numeració
function actualitzaIndex() {
    $('#taulaComanda tbody tr').each(function(index) {
        $(this).find('td:first').text(index + 1);
    });
}
</script>

</body>
</html>
