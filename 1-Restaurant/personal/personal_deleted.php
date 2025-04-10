<html>
<head>
<!--     <meta charset="UTF-8"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/estils.css">
    <title>Personal esborrat</title>
</head>
<body>

    <?php
   
    require("../functions/funcions.php");
    $conn = getConnexio();

    $query = "delete from personal where username='$_REQUEST[username]'";

    mysqli_query($conn, $query) or die("Problemes amb el DELETE personal: " . mysqli_error($conn));

    
// ELIMINAR L'USUARI DE LA BD =========================================================

    $query_elimina_usuari = "DROP USER IF EXISTS '$_REQUEST[username]'@'$_REQUEST[host]'";
    
    echo "<tr><td> QUERY eliminar USUARI:  $query_elimina_usuari</td></tr><br><br>";
    
    // Ejecutar la consulta para crear el usuario
    if (mysqli_query($conn, $query_elimina_usuari)) {
        echo "Usuari $_REQUEST[username]@$_REQUEST[host] eliminat amb exit.<br>";
    } else {
        echo "Error a l'eliminar l'usuari $_REQUEST[username] . $conn->error . <br>";
    }
    
// ======================================================================================    
    echo "<h1>Persona HA ESTAT ESBORRADA:</h1>";
    echo "<h2>Nom:  " . "$_REQUEST[nom]" . "</h2>";
    echo "<h2>Rol:  " . "$_REQUEST[rol]" . "</h2>";
    // echo "<h2>Email:  " . "$_REQUEST[email]" . "</h2>";
    echo "<h2>Username:  " . "$_REQUEST[username]" . "</h2>";
    echo "<h2>Password:  " . "$_REQUEST[password]" . "</h2>";
    echo "<h2>Host:  " . "$_REQUEST[host]" . "</h2>";
    echo "<h2>Actiu?:  " . "$_REQUEST[es_actiu]" . "</h2>";

    if ($_REQUEST['es_actiu'] == 1){
        echo "<h2>Estat: ACTIU</h2>";
    }else{
        echo "<h2>Estat: BAIXA</h2>";
    }
    
    
    mysqli_close($conn);
?>    
    
	<br><br>
	
	<form action="./personal_gestio.php">
	<input type="submit" value="Tornar al llistat de personal">
	<input name="uname" value = "" type="hidden" >
	</form>
	
	<form action="../index.php">
		<input type="submit" value="Tornar a l'inici">
	</form>

</body>
</html>