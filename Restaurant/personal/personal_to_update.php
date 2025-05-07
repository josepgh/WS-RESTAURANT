
<?php 
require('../includes/header.php');
?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Taula productes</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/estils.css">
</head>
<body class="bg-light">

<div class="container mt-5">
    <?php
        require("../functions/funcions.php");
        //$conn = getConnexio();
        //$conn = getUserConnexio();
        $conn = getUserConnexio($_SESSION['username'], $_SESSION['password'], $_SESSION['host']);

        $query = "SELECT id_personal, nom, rol, username, password, host, es_actiu FROM personal WHERE username = '$_REQUEST[username]'";

        $registres = mysqli_query($conn, $query) or
                    die("Problemes amb el select de personal: " . mysqli_error($conn));

        if ($row = mysqli_fetch_array($registres)) {
            // dades carregades correctament
        } else {
            echo "<div class='alert alert-danger'><h4>No existeix l'USERNAME: {$_REQUEST['username']}</h4></div>";
            exit;
        }

        mysqli_close($conn);
    ?>

    <h1 class="mb-4">Actualitzar persona</h1>

    <form action="personal_updated.php" method="post" class="mb-4">

        <div class="mb-3">
            <label for="u" class="form-label">Username <small class="form-text text-muted">No editable</small></label>
            <input id="u" name="username" type="text" class="form-control" value="<?php echo $row['username'] ?>" readonly>
            <!--<small class="form-text text-muted">No modificable</small> -->
        </div>
        <div class="mb-3">
            <label for="p" class="form-label">Password <small class="form-text text-muted">No editable</small></label>
            <input id="p" name="password" type="text" class="form-control" value="<?php echo $row['password'] ?>" readonly>
        </div>
        <div class="mb-3">
            <label for="h" class="form-label">Host <small class="form-text text-muted">No editable</small></label>
            <input id="h" name="host" type="text" class="form-control" value="<?php echo $row['host'] ?>" readonly>
        </div>
        <div class="mb-3">
            <label for="ro" class="form-label">Rol <small class="form-text text-muted">No editable</small></label>
            <input id="ro" name="rol" type="text" class="form-control" value="<?php echo $row['rol'] ?>" readonly>
        </div>
        <div class="mb-3">
            <label for="n" class="form-label">Nom</label>
            <input id="n" name="nom" type="text" class="form-control" value="<?php echo $row['nom'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="actiu" class="form-label">Estat</label>
            <input id="actiu" type="range" class="form-range" name="es_actiu" min="0" max="1" value="<?php echo $row['es_actiu'] ?>">
            <div class="d-flex justify-content-between">
                <span>BAIXA</span>
                <span>ALTA</span>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Actualitzar</button>
    </form>

    <div class="mb-3">
        <form action="./gestio_personal.php" method="get" class="d-inline">
            <input type="submit" class="btn btn-secondary" value="Tornar al llistat">
        </form>
        <form action="../index.php" method="get" class="d-inline ms-2">
            <input type="submit" class="btn btn-outline-secondary" value="Anar a l'inici">
        </form>
    </div>
</div>

</body>
</html>
