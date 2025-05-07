<?php
session_start();
require("../functions/funcions.php");

// Recollir dades de la reserva
$nom_client = $_GET['nom_client'] ?? '';
$id_reserva = $_GET['id_reserva'] ?? '';

// Si guardem la comanda
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['guardar_comanda'])) {
    //$conn = getConnexio();
    $conn = getUserConnexio();
    $nom_client = $_POST['nom_client'];
    $id_reserva = $_POST['id_reserva'];

    $tipus_plat = $_POST['tipus_plat'] ?? [];
    $nom_plat = $_POST['nom_plat'] ?? [];
    $quantitat = $_POST['quantitat'] ?? [];

    if (count($tipus_plat) > 0) {
        // Guardar comanda principal
        $stmt = $conn->prepare("INSERT INTO comandes (id_reserva, nom_client, data_comanda) VALUES (?, ?, NOW())");
        $stmt->bind_param("is", $id_reserva, $nom_client);
        $stmt->execute();
        $id_comanda = $stmt->insert_id;
        $stmt->close();

        // Guardar plats
        $stmtPlat = $conn->prepare("INSERT INTO comanda_plats (id_comanda, tipus_plat, nom_plat, quantitat) VALUES (?, ?, ?, ?)");
        for ($i = 0; $i < count($tipus_plat); $i++) {
            $stmtPlat->bind_param("issi", $id_comanda, $tipus_plat[$i], $nom_plat[$i], $quantitat[$i]);
            $stmtPlat->execute();
        }
        $stmtPlat->close();

        $conn->close();

        // Redirigir després de guardar
        header("Location: ../reserves/gestio_reserves.php");
        exit;
    } else {
        $error = "No s'ha afegit cap plat a la comanda.";
    }
}
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Comanda de <?= htmlspecialchars($nom_client) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="p-4">
<div class="container">
    <h2 class="mb-4">Comanda de <?= htmlspecialchars($nom_client) ?> (Reserva <?= htmlspecialchars($id_reserva) ?>)</h2>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <!-- Formulari principal -->
    <form method="POST" id="formulariComanda">
        <input type="hidden" name="nom_client" value="<?= htmlspecialchars($nom_client) ?>">
        <input type="hidden" name="id_reserva" value="<?= htmlspecialchars($id_reserva) ?>">

        <!-- Selecció de plats -->
        <div class="row mb-3">
            <div class="col-md-3">
                <label for="tipus_plat" class="form-label">Tipus de plat</label>
                <select id="tipus_plat" class="form-select">
                    <option value="">-- Selecciona --</option>
                    <option value="Entrant">Entrant</option>
                    <option value="Principal">Principal</option>
                    <option value="Postres">Postres</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="nom_plat" class="form-label">Plat</label>
                <select id="nom_plat" class="form-select" disabled>
                    <option value="">-- Selecciona tipus primer --</option>
                </select>
            </div>
            <div class="col-md-2">
                <label for="quantitat" class="form-label">Quantitat</label>
                <input type="number" id="quantitat" class="form-control" min="1" value="1">
            </div>
            <div class="col-md-2 align-self-end">
                <button type="button" class="btn btn-success" onclick="afegirPlat()">Afegir</button>
            </div>
        </div>

        <!-- Taula de comanda -->
        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tipus</th>
                    <th>Plat</th>
                    <th>Quantitat</th>
                    <th>Accions</th>
                </tr>
            </thead>
            <tbody id="taulaComanda"></tbody>
        </table>

        <!-- Botó guardar -->
        <div class="text-end mt-3">
            <button type="submit" name="guardar_comanda" class="btn btn-primary">Guardar Comanda</button>
        </div>
    </form>
</div>

<!-- Modal editar -->
<div class="modal fade" id="modalEditar" tabindex="-1">
    <div class="modal-dialog">
        <form id="formEditar" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Quantitat</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tancar"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="editIndex">
                <div class="mb-3">
                    <label for="editQuantitat" class="form-label">Quantitat</label>
                    <input type="number" id="editQuantitat" class="form-control" min="1">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Guardar Canvis</button>
            </div>
        </form>
    </div>
</div>

<script>
// Llistat de plats segons tipus
const plats = {
    'Entrant': ['Amanida', 'Braves', 'Sopa'],
    'Principal': ['Bistec', 'Paella', 'Pizza'],
    'Postres': ['Gelat', 'Pastís', 'Fruita']
};

$('#tipus_plat').on('change', function() {
    const tipus = $(this).val();
    const platsDisponibles = plats[tipus] || [];
    const selectPlat = $('#nom_plat');

    selectPlat.prop('disabled', platsDisponibles.length === 0);
    selectPlat.empty().append('<option value="">-- Selecciona --</option>');
    platsDisponibles.forEach(plat => {
        selectPlat.append(`<option value="${plat}">${plat}</option>`);
    });
});

function afegirPlat() {
    const tipus = $('#tipus_plat').val();
    const plat = $('#nom_plat').val();
    const quantitat = $('#quantitat').val();

    if (!tipus || !plat || quantitat <= 0) {
        alert('Completa tots els camps!');
        return;
    }

    const index = $('#taulaComanda tr').length;

    const fila = `
        <tr data-index="${index}">
            <td>${index + 1}</td>
            <td>${tipus}
                <input type="hidden" name="tipus_plat[]" value="${tipus}">
            </td>
            <td>${plat}
                <input type="hidden" name="nom_plat[]" value="${plat}">
            </td>
            <td>${quantitat}
                <input type="hidden" name="quantitat[]" value="${quantitat}">
            </td>
            <td>
                <button type="button" class="btn btn-warning btn-sm" onclick="editarPlat(${index}, ${quantitat})">Editar</button>
                <button type="button" class="btn btn-danger btn-sm" onclick="eliminarPlat(${index})">Eliminar</button>
            </td>
        </tr>
    `;

    $('#taulaComanda').append(fila);
    resetForm();
}

function resetForm() {
    $('#tipus_plat').val('');
    $('#nom_plat').prop('disabled', true).empty().append('<option value="">-- Selecciona tipus primer --</option>');
    $('#quantitat').val(1);
}

function eliminarPlat(index) {
    $(`tr[data-index="${index}"]`).remove();
    actualitzarIndex();
}

function editarPlat(index, quantitat) {
    $('#editIndex').val(index);
    $('#editQuantitat').val(quantitat);
    const modal = new bootstrap.Modal(document.getElementById('modalEditar'));
    modal.show();
}

$('#formEditar').on('submit', function(e) {
    e.preventDefault();
    const index = $('#editIndex').val();
    const novaQuantitat = $('#editQuantitat').val();

    const fila = $(`tr[data-index="${index}"]`);
    fila.find('td:nth-child(4)').html(`${novaQuantitat}<input type="hidden" name="quantitat[]" value="${novaQuantitat}">`);

    const modal = bootstrap.Modal.getInstance(document.getElementById('modalEditar'));
    modal.hide();
});

function actualitzarIndex() {
    $('#taulaComanda tr').each(function(i) {
        $(this).attr('data-index', i);
        $(this).find('td:first').text(i + 1);
    });
}
</script>
</body>
</html>
