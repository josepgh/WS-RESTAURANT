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

    $query = "delete from personal where email='$_REQUEST[email]'";
    
    mysqli_query($conn, $query) or die("Problemes amb el DELETE personal: " . mysqli_error($conn));
    
//     echo "<tr>
//                     <td>" . "$_REQUEST[nom]" . "</td>
//                     <td>" . "$_REQUEST[rol]" . "</td>
//                     <td>" . "$_REQUEST[email]" . "</td>
//                 </tr>
//                 ";
//    echo "<tr><td colspan = '3'>PERSONAL ELIMINADA AMB EXIT</td></tr>";

    

    echo "<h1>Persona HA ESTAT ESBORRADA:</h1>";
    echo "<h2>Nom:  " . "$_REQUEST[nom]" . "</h2>";
    echo "<h2>Rol:  " . "$_REQUEST[rol]" . "</h2>";
    echo "<h2>Email:  " . "$_REQUEST[email]" . "</h2>";
    

    
    mysqli_close($conn);
?>    
    
	

	<br><br>
	
	<form action="./personal_gestio.php">
	<input type="submit" value="Tornar al llistat de personal">
	<input name="mail" value = "" type="hidden" >
	</form>
	
	<form action="../index.php">
		<input type="submit" value="Tornar a l'inici">
	</form>

</body>
</html>