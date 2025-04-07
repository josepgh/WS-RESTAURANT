<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/estils.css">
    <title>Personal actualitzat</title>
</head>
<body>
    
    <?php
    
    require("../functions/funcions.php");
    $conn = getConnexio();
    
    $query = "update personal set nom='$_REQUEST[nom]', rol='$_REQUEST[rol]', email='$_REQUEST[new_email]', username='$_REQUEST[username]', password='$_REQUEST[password]', host='$_REQUEST[host]' where email = '$_REQUEST[old_email]'";
     
    mysqli_query($conn, $query) or die("Problemes amb l'UPDATE de personal: " . mysqli_error($conn));
    
    echo "<h1>Persona HA ESTAT ACTUALITZADA:</h1>";
    echo "<h2>Nom:  " . "$_REQUEST[nom]" . "</h2>";
    echo "<h2>Rol:  " . "$_REQUEST[rol]" . "</h2>";
    echo "<h2>Email:  " . "$_REQUEST[new_email]" . "</h2>";
    echo "<h2>Username:  " . "$_REQUEST[username]" . "</h2>";
    echo "<h2>Password:  " . "$_REQUEST[password]" . "</h2>";
    echo "<h2>Host:  " . "$_REQUEST[host]" . "</h2>";
    
    
    mysqli_close($conn);
?>    
    
	<form action="./personal_gestio.php">
    	<input type="submit" value="Tornar al llistat">
    	<input name="mail" value = "" type="hidden" >
	</form>
	
	<form action="../index.php">
		<input type="submit" value="Tornar a l'inici">
	</form>

</body>
</html>