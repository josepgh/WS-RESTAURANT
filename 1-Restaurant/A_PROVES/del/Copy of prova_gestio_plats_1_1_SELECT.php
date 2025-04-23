<?php

session_start();

// $_SESSION['username'] = "chusep";
require '../includes/header.php';
require("../functions/funcions.php");

// Conexió a la base de datos
$conn = new mysqli("localhost", "root", "mdb", "restaurantdb");
if ($conn->connect_error) {
    die("❌ Error de connexió: " . $conn->connect_error);
}

// Guardar selecció en sesión
// if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_categoria'])) {
//     $_SESSION['id_categoria_seleccionada'] = $_POST['id_categoria'];
//     //     echo "✅ Categoria guardada en sessió: " . htmlspecialchars($_POST['id_categoria']);
//     exit;
// }
// Recuperar categoria seleccionada
// $id_categoria = $_SESSION['id_categoria_seleccionada'] ?? '';


// Guardar selecció en sesión (antic) =======================================================
// if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_categoria_selecc'])) {
//     $_SESSION['id_cat_opcio'] = $_POST['id_categoria_selecc'];
//     //     echo "✅ Categoria guardada en sessió: " . htmlspecialchars($_POST['id_categoria']);
//     exit;
// }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id_c'])) {
        $_SESSION['id_cat_opcio'] = $_POST['id_c'];
    }
    if (isset($_POST['nom_c'])) {
        $_SESSION['nom_cat_opcio'] = $_POST['nom_c'];
    }
//     echo "Categoría guardada en sesión.";
}
// Recuperar categoria seleccionada (antic)
$id_cat_opcio = $_SESSION['id_cat_opcio'] ?? '';
// Recuperar categoria seleccionada (antic)
$nom_cat_opcio = $_SESSION['nom_cat_opcio'] ?? '';
// =============================================================================================




// Obtener lista de categorias
// $categories = [];
// $result = $conn->query("SELECT id_categoria, nom FROM categories ORDER BY id_categoria ASC");
// if ($result) {
//     while ($fila = $result->fetch_assoc()) {
//         $categories[] = $fila;
//     }
// }

// Obtener nom de categoria seleccionada
// $categoria_nom = '';
// foreach ($categories as $cat) {
//     if ($cat['id_categoria'] == $id_categoria) {
//         $categoria_nom = $cat['nom'];
//         break;
//     }
// }

// Obtener plats de la categoria seleccionada
// $plats = [];
// if ($id_categoria !== '') {
//     $stmt = $conn->prepare("SELECT nom, descripcio, preu FROM plats WHERE id_categoria = ?");
//     $stmt->bind_param("i", $id_categoria);
//     $stmt->execute();
//     $resultado = $stmt->get_result();
//     $plats = $resultado->fetch_all(MYSQLI_ASSOC);
//     $stmt->close();
// }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <!-- a l'afegir aquest link canvia moltíssim -->
    <link rel="stylesheet" type="text/css" href="../css/estils.css">
    
    <title>Menú por categoria</title>
</head>
<body>

	<p>
	<laber for="ca">Selecciona una categoria</laber>
    <select id="ca" name="categoria" onchange="guardarCatEnSessio(this)">
        <option value="">-- Selecciona categoria --</option>
        <?php
        $con = getConnexio();
        $sql = "SELECT id_categoria, nom FROM categories ORDER BY id_categoria";
        $result = $con->query($sql);

        while ($row = $result->fetch_assoc()) {

                echo "<option value='" . $row['id_categoria'] . "' " .
                    ($row['id_categoria'] == $id_cat_opcio ? 'selected' : '') .
                    ">" . $row['nom'] . "</option>";
                    
        }
        mysqli_close($con);
        ?>
    </select>
    </p>

    <h4>Categoria seleccionada: <?= htmlspecialchars($nom_cat_opcio ?: 'Ninguna') ?></h4>





<?php     
    //if ($result->num_rows > 0) {
    if ($id_cat_opcio !== '') { // si no es buit
            
        //         $_SESSION['id_categ'] = $_REQUEST['id_categoria'];
        $conn = getConnexio();
        
        //     $categoria_id = intval($_POST["id_categoria"]);
        
        $sql = "SELECT id_plat, nom, descripcio, preu, id_categoria FROM plats WHERE id_categoria = $id_cat_opcio ORDER BY nom";
        $result = $conn->query($sql);
        
        
        echo "<table> <thead> <tr>";
        echo "<th>Id</th> <th>Nom</th> <th>Descripcio</th> <th>Preu</th> <th>ID categoria</th><th>Edita</th><th>Esborra</th>";
        
        echo "</tr> </thead> <tbody>";
        
        while ($row = $result->fetch_assoc()) {
            //             echo "<table>";
            echo "<tr><td>" . $row['id_plat'] . "</td>";
            echo "<td>" . $row['nom'] . "</td>";
            echo "<td>" . $row['descripcio'] . "</td>";
            echo "<td>" . $row['preu'] . "</td>";
            echo "<td>" . $row['id_categoria'] . "</td>";

            echo "<td><div><a href='plat_update.php?id_plat=" . $row['id_plat'] . "' class='btn btn-info' role='button'>Edita</a></div></td>";
            echo "<td><div><a href='plat_to_delete.php?id_plat=" . $row['id_plat'] . "' class='btn btn-danger disabled' role='button' aria-disabled='true'>Esborra</a></div></td>";
            
            echo "</td>";
        }
        
        echo "</tbody>";
        
        echo "</table>";
        
    } elseif ($id_cat_opcio) {
        echo "<p>No hi plats d'aquesta categoria.</p>";
    } else {
        echo "<p>Selecciona una categoria per veure els plats disponibles.</p>";
    }


    ?>

    <div id="resultat" style="margin-top: 15px; font-weight: bold;"></div>




    
    
        <script>
        function guardarCatEnSessio(categoria) {
            
            const id_c = categoria.value;
            const nom_c = categoria.options[categoria.selectedIndex].text;

            const dades = new URLSearchParams();
            dades.append('id_c', id_c);
            dades.append('nom_c', nom_c);

//         	const id_c = select.value;
// 			const nom_c = 
	
            fetch('', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
//                 body: 'id_categoria_selecc=' + encodeURIComponent(id_c)
                body: dades.toString()
            })
            .then(response => response.text())
             .then(data => {
//                 document.getElementById("resultat").innerHTML = data; // es veu extrany unes dècimes de segon
                 location.reload(); // mostrar resultados filtrados
            })
            .catch(error => {
                console.error("Error:", error);
            });
        }
    </script>
    
    
</body>



    
	<br>
	<form action="./index_proves.php">
    	<input type="submit" value="Tornar A INDEX PROVES">
	</form>
	<br>
	<form action="../index.php">
		<input type="submit" value="Tornar a INDEX INICI">
	</form>


</html>
