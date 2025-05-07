<?php 
require('../includes/header.php');
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/estils.css">
    <title>Personal actualitzat</title>
</head>
<body>
    
<?php
    
    require("../functions/funcions.php");
    //$conn = getConnexio();
    //$conn = getUserConnexio();
    $conn = getUserConnexio($_SESSION['username'], $_SESSION['password'], $_SESSION['host']);
    
    $query_update = "update personal 
            set nom='$_REQUEST[nom]', rol='$_REQUEST[rol]', password='$_REQUEST[password]', es_actiu='$_REQUEST[es_actiu]' 
            where username = '$_REQUEST[username]'";
     
    mysqli_query($conn, $query_update) or die("Problemes amb l'UPDATE de personal: " . mysqli_error($conn));
    //$row = mysqli_fetch_array($registres);
    
    echo "<h1>Persona HA ESTAT ACTUALITZADA:</h1>";
    echo "<h2>Nom:  " . "$_REQUEST[nom]" . "</h2>";
    echo "<h2>Rol:  " . "$_REQUEST[rol]" . "</h2>";
    // echo "<h2>Email:  " . "$_REQUEST[new_email]" . "</h2>";
    echo "<h2>Username:  " . "$_REQUEST[username]" . "</h2>";
    echo "<h2>Password:  " . "$_REQUEST[password]" . "</h2>";
    echo "<h2>Host:  " . "$_REQUEST[host]" . "</h2>";
    echo "<h2>Estat: " . ($_REQUEST['es_actiu'] == 1 ? "ACTIU" : "BAIXA") . "</h2>";
    if ($_REQUEST['es_actiu'] == 1){
        echo "<h2>Estat: ACTIU</h2>";
    }else{
        echo "<h2>Estat: BAIXA</h2>";
    }
    
    // CONSULTA LA BD PER SI L'USUARI TE GRANTS: -------------------------------------------------------------------------------------------------
//     $query_te_grants = "SELECT COUNT(*) as count FROM mysql.user WHERE User = '$_REQUEST[username]' AND Host = '$_REQUEST[host]'";
//     $reg = mysqli_query($conn, $query_te_grants) or die("Problemes en consultar els GRANTS d'un user a la taula mysql.user: " . mysqli_error($conn));
//     $row_grants = mysqli_fetch_array($reg);
    // -------------------------------------------------------------------------------------------------------------------------------------------
    
    //echo "1 l'username:  $_REQUEST[username] <br> i la query_te_grants: $query_te_grants <br>";
    
    //TODO perque entre comentes funciona i sense no???????
    // només li atorga els GRANTS si MODIFICA l'estat a ALTA i no tenia GRANTS
    // si esta de baixa li revoca els grants NOMÉS SI EN TÉ
    
    if ($_REQUEST['es_actiu'] == 1){  
            echo "<h2>Estat: ACTIU</h2>";
    }else{  
        echo "<h2>Estat: BAIXA</h2>";
    }
    
    // ========================================================================================
    // ============================== IMPORTANT ===============================================
    setGrants($_REQUEST['rol'], $_REQUEST['username'], $_REQUEST['host'], $_REQUEST['es_actiu']);
    // ========================================================================================
   
    mysqli_close($conn);
?>    
    
	<form action="./gestio_personal.php">
    	<input type="submit" value="Tornar al llistat">
    	<input name="uname" value = "" type="hidden" >
	</form>
	
	<form action="../index.php">
		<input type="submit" value="Tornar a l'inici">
	</form>

</body>
</html>