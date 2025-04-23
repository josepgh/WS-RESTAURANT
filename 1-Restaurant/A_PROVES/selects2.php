<?php
// carrega_plats.php NO, DES DEL MATEIX FITXER
if (isset($_POST['id_categoria'])) {
    $conn = new mysqli("localhost", "root", "mdb", "restaurantdb");
    $id_categoria = intval($_POST['id_categoria']);
    
    $query = $conn->prepare("SELECT id_plat, nom FROM plats WHERE id_categoria = ?");
    $query->bind_param("i", $id_categoria);
    $query->execute();
    $result = $query->get_result();

    echo "<option value=''>-- Selecciona un plat --</option>";
    while ($row = $result->fetch_assoc()) {
        echo "<option value='{$row['id_plat']}'>{$row['nom']}</option>";
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Desplegables DEPENDENTS</title>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!--     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> -->
    
</head>
<body>

    <h2>Selecciona una categoria:</h2>

    <select id="categoria">
        <option value="">-- Selecciona categoria --</option>
        <?php
        // Conexión a la BD
        $conn = new mysqli("localhost", "root", "mdb", "restaurantdb");
        $sql = "SELECT id_categoria, nom FROM categories";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            echo "<option value='".$row['id_categoria']."'>".$row['nom']."</option>";
        }
        $conn->close();
        ?>
    </select>

    <h2>Plats:</h2>
    <select id="plats">
        <option value="">-- Selecciona un plat --</option>
    </select>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#categoria').change(function () {
                var id_categoria = $(this).val();
    
                $.ajax({
    				//url: 'carrega_plats.php',
    				url: '',
                    type: 'POST',
                    data: { id_categoria: id_categoria },
                    success: function (data) {
                        $('#plats').html(data);
                    }
                });
            });
        });
    </script>


</body>
	<br><br>
	<form action="../index.php">
		<input type="submit" value="Tornar a l'inici">
	</form>
	
	</body>

<?php
    require '../includes/footer.php';
?>
</html>


	
