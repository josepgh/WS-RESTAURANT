<?php
session_start();

// $_SESSION['username'] = "chusep";
require '../includes/header.php';

// Conexión a la base de datos
$conn = new mysqli("localhost", "root", "mdb", "restaurantdb");
if ($conn->connect_error) {
    die("❌ Error de conexión: " . $conn->connect_error);
}

// Si es una petición AJAX para guardar
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['opcion'])) {
    $_SESSION['opcion_seleccionada'] = $_POST['opcion'];
    echo "✅ Opción guardada en sesión: " . htmlspecialchars($_POST['opcion']);
    exit;
}

// Valor actual guardado
$opcionGuardada = $_SESSION['opcion_seleccionada'] ?? '';

// Obtener categorias únicas desde la base de datos
$categorias = [];
$result = $conn->query("SELECT DISTINCT categoria_id, categoria_nombre FROM productos ORDER BY categoria_nombre ASC");
if ($result) {
    while ($fila = $result->fetch_assoc()) {
        $categorias[] = $fila;
    }
}

// Obtener productos si hay selección
$productos = [];
if ($opcionGuardada !== '') {
    $stmt = $conn->prepare("SELECT id, nombre FROM productos WHERE categoria_id = ?");
    $stmt->bind_param("i", $opcionGuardada);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $productos = $resultado->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
}

// Obtener el nombre de la categoria seleccionada
$nombreSeleccionado = '';
foreach ($categorias as $cat) {
    if ($cat['categoria_id'] == $opcionGuardada) {
        $nombreSeleccionado = $cat['categoria_nombre'];
        break;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Filtro dinámico por categorias</title>
</head>
<body>
    <h2>Selecciona una categoria desde productos:</h2>

    <select onchange="guardarEnSesion(this)">
        <option value="">-- Selecciona --</option>
        <?php foreach ($categorias as $categoria): ?>
            <option value="<?= $categoria['categoria_id'] ?>" <?= $categoria['categoria_id'] == $opcionGuardada ? 'selected' : '' ?>>
                <?= htmlspecialchars($categoria['categoria_nombre']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <div id="resultado" style="margin-top: 20px; font-weight: bold;"></div>

    <hr>

    <h3>categoria seleccionada: <span id="opcionActual"><?= htmlspecialchars($nombreSeleccionado ?: 'Ninguna') ?></span></h3>

    <?php if ($productos): ?>
        <h4>🛍️ Productos encontrados:</h4>
        <ul>
            <?php foreach ($productos as $producto): ?>
                <li><?= htmlspecialchars($producto['nombre']) ?> (ID: <?= $producto['id'] ?>)</li>
            <?php endforeach; ?>
        </ul>
    <?php elseif ($opcionGuardada): ?>
        <p>🔎 No hay productos en esta categoria.</p>
    <?php else: ?>
        <p>💡 Selecciona una categoria para ver productos.</p>
    <?php endif; ?>
    
</body>

	<br>
	<form action="./index_proves.php">
    	<input type="submit" value="Tornar A INDEX PROVES">
	</form>

	<form action="../index.php">
		<input type="submit" value="Tornar a INDEX INICI">
	</form>

</html>

    
    <script>
        function guardarEnSesion(select) {
            const valor = select.value;

            fetch('', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'opcion=' + encodeURIComponent(valor)
            })
            .then(response => response.text())
            .then(data => {
                document.getElementById("resultado").innerHTML = data;
                document.getElementById("opcionActual").innerText = select.options[select.selectedIndex].text;
                location.reload(); // Recargar para mostrar los datos filtrados
            })
            .catch(error => {
                console.error("Error:", error);
            });
        }
    </script>
    
    
</body>
</html>
