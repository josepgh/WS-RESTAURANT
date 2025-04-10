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
    $conn = getConnexio();
    
    $query = "update personal set nom='$_REQUEST[nom]', rol='$_REQUEST[rol]', password='$_REQUEST[password]', es_actiu='$_REQUEST[es_actiu]' where username = '$_REQUEST[username]'";
     
    mysqli_query($conn, $query) or die("Problemes amb l'UPDATE de personal: " . mysqli_error($conn));
    
    echo "<h1>Persona HA ESTAT ACTUALITZADA:</h1>";
    echo "<h2>Nom:  " . "$_REQUEST[nom]" . "</h2>";
    echo "<h2>Rol:  " . "$_REQUEST[rol]" . "</h2>";
    // echo "<h2>Email:  " . "$_REQUEST[new_email]" . "</h2>";
    echo "<h2>Username:  " . "$_REQUEST[username]" . "</h2>";
    echo "<h2>Password:  " . "$_REQUEST[password]" . "</h2>";
    echo "<h2>Host:  " . "$_REQUEST[host]" . "</h2>";
    echo "<h2>Actiu? (Sí=1 No=0):  " . "$_REQUEST[es_actiu]" . "</h2>";
    
    //TODO perque entre comentes funciona i sense no???????
    if ($_REQUEST['es_actiu'] == 1){
        echo "<h2>Estat: ACTIU</h2>";
    }else{
        echo "<h2>Estat: BAIXA</h2>";
    }
    
    mysqli_close($conn);
?>    
    
	<form action="./personal_gestio.php">
    	<input type="submit" value="Tornar al llistat">
    	<input name="uname" value = "" type="hidden" >
	</form>
	
	<form action="../index.php">
		<input type="submit" value="Tornar a l'inici">
	</form>

</body>
</html>