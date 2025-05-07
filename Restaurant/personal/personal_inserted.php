<?php 
require('../includes/header.php');
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/estils.css">
    <title>Inserir personal</title>
</head>
<body>

    <?php
   
    require("../functions/funcions.php");
    //$conn = getConnexio();
    $conn = getUserConnexio($_SESSION['username'], $_SESSION['password'], $_SESSION['host']);

    // ---- primer mira si esta a la BD -------------------------------------------------------------------
    
    $query = "select id_personal, nom, rol, username, password, host, es_actiu from personal where username = '$_REQUEST[username]'";
    
    $registres = mysqli_query($conn, $query) or die("Problemes amb el select de personal: " . mysqli_error($conn));

    if(mysqli_fetch_array($registres)){
            
        // si JA EXISTEIX USERNAME A LA BD => ERRROR -------------------------------

        echo "<h1>ERROR: JA EXISTEIX L'USERNAME: $_REQUEST[username]</h1>";
        echo "<h2>Nom:  " . "$_REQUEST[nom]" . "</h2>";
        echo "<h2>Rol:  " . "$_REQUEST[rol]" . "</h2>";
        echo "<h2>Username:  " . "$_REQUEST[username]" . "</h2>";
        echo "<h2>Host:  " . "$_REQUEST[host]" . "</h2>";
        echo "<h2>Estat: " . ($_REQUEST['es_actiu'] == 1 ? "ACTIU" : "BAIXA") . "</h2>";
        
    }
    else{ // si NO EXISTEIX A LA BD => L'INSERTA + CREA USER A LA BD + LI ATORGA GRANTS (SI CAL !!!!!)

        // ========================================================================================
        // ============================== IMPORTANT CREAR USUARI ==================================
        // ========================================================================================
        creaNouUsuariDB($_REQUEST['username'], $_REQUEST['password'], $_REQUEST['host']);
        setGrants($_REQUEST['rol'], $_REQUEST['username'], $_REQUEST['host'], $_REQUEST['es_actiu']);
        insertaEnPersonal($_REQUEST['nom'], $_REQUEST['rol'], $_REQUEST['username']
                            , $_REQUEST['password'], $_REQUEST['host'], $_REQUEST['es_actiu']);
         // ========================================================================================
        
        echo "<h1>Persona HA ESTAT AFEGIDA AMB EXIT:</h1>";
        echo "<h2>Nom:  " . "$_REQUEST[nom]" . "</h2>";
        echo "<h2>Rol:  " . "$_REQUEST[rol]" . "</h2>";
        // echo "<h2>Email:  " . "$_REQUEST[email]" . "</h2>";
        echo "<h2>Usename:  " . "$_REQUEST[username]" . "</h2>";
        echo "<h2>Password:  " . "$_REQUEST[password]" . "</h2>";
        echo "<h2>Host:  " . "$_REQUEST[host]" . "</h2>";
        echo "<h2>Estat: " . ($_REQUEST['es_actiu'] == 1 ? "ACTIU" : "BAIXA") . "</h2>";
        if ($_REQUEST['es_actiu'] == 1){
            echo "<h2>Estat: ACTIU</h2>";
        }else{
            echo "<h2>Estat: BAIXA</h2>";
        }
    }
    $conn->close();
?>

	<form action="./gestio_personal.php">
    	<input type="submit" value="Tornar al llistat">
    	<input name="uname" value = "" type="hidden" >
	</form>

	<form action="./personal_to_insert.php">
		<input type="submit" value="Insertar altra persona">
	</form>

	<form action="../index.php">
		<input type="submit" value="Tornar a l'inici">
	</form>
	
</body>

</html>