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
    $conn = getConnexio();

    // ---- primer mira si esta a la BD -------------------------------------------------------------------
    
    $query = "select id_personal, nom, rol, email from personal where email = '$_REQUEST[email]'";
    
    $registres = mysqli_query($conn, $query) or die("Problemes amb el select de personal: " . mysqli_error($conn));
    
    if($row = mysqli_fetch_array($registres)){ 
        // si JA EXISTEIX A LA BD => ERRROR -------------------------------

        echo "<h1>ERROR: JA EXISTEIX LA PERSONA amb email:</h1>";
//         echo "<h2>Nom:  " . "$_REQUEST[nom]" . "</h2>";
//         echo "<h2>Rol:  " . "$_REQUEST[rol]" . "</h2>";
        echo "<h2>Email:  " . "$_REQUEST[email]" . "</h2>";
    }
    else{ // si NO EXISTEIX A LA BD => L'INSERTA

        $query = "insert into personal(nom, rol, email) values('$_REQUEST[nom]', '$_REQUEST[rol]', '$_REQUEST[email]')";
        
        mysqli_query($conn, $query) or die("Error en l'insert de personal: ". mysqli_error($conn));

        echo "<h1>Persona HA ESTAT AFEGIDA AMB EXIT:</h1>";
        echo "<h2>Nom:  " . "$_REQUEST[nom]" . "</h2>";
        echo "<h2>Rol:  " . "$_REQUEST[rol]" . "</h2>";
        echo "<h2>Email:  " . "$_REQUEST[email]" . "</h2>";
    }
    
 		    mysqli_close($conn);
	?>
<!-- 		</tbody> -->
<!-- </table> -->
<!-- 	<br><br> -->

	<form action="./personal_gestio.php">
    	<input type="submit" value="Tornar al llistat">
    	<input name="mail" value = "" type="hidden" >
	</form>

	<form action="./personal_to_insert.php">
		<input type="submit" value="Insertar altra persona">
	</form>

	<form action="../index.php">
		<input type="submit" value="Tornar a l'inici">
	</form>
	
</body>

</html>