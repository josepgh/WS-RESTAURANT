<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/estils.css">
<!--     <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> -->
    <title>Personal delete</title>
</head>
<body>

<?php
   
    require("../functions/funcions.php");
    $conn = getConnexio();

    $query = "select id_personal, nom, rol, email, username, password, host from personal where email = '$_REQUEST[email]'";
    
    $registres = mysqli_query($conn, $query) or die("Problemes amb el select de personal: " . mysqli_error($conn));
    
    if($row = mysqli_fetch_array($registres)){

    }
    else{
        echo "<h1>No existeix personal amb l'email:  $_REQUEST[email]<h1>";
    }
 		    
 	mysqli_close($conn);
?>
	
	<h1>Esborrar persona</h1>
	
    <form action="personal_deleted.php" method="post">

        <label for="n">Nom:</label>
        <input id="n" name="nom" type="text" value = "<?php echo $row['nom']?>" readonly>
        <br><br>
        
        <label for="e">Email:</label>
        <input id="e" name="email" type="email" value = "<?php echo $row['email']?>" readonly>
        <br><br>

        <!-- com el select esta DISABLED pasem el rol amagat EN EL REQUEST -->
        <input name="rol" type="hidden" value = "<?php echo $row['rol']?>">

        <label for="r">Rolllllll Selecciona el rol:</label>

        <select id="r" name="rol" disabled> <!-- si es posa disabled NO S'ENVIA EN EL REQUEST -->
        
<!--  ============================================================================================ -->
<!--  ============================================================================================ -->
<!--  vist a PART 3 - CREATING A CRUD APPLICATION USING MariaDB AND PHP DATA OBJECTS (PDO) -->
<!--  minut 15 -->
<!--  https://www.youtube.com/watch?v=Lafx7yrWHfw&ab_channel=CodePH -->
 
            <option value="">-- Selecciona rol --</option>
            <option value="maitre" <?php echo ($row['rol'] == "maitre" ? "selected" : "")?>>Maitre</option>
            <option value="cuiner" <?php echo ($row['rol'] == "cuiner" ? "selected" : "")?>>Cuiner</option>
            <option value="cambrer" <?php echo ($row['rol'] == "cambrer" ? "selected" : "")?>>Cambrer</option>
            <option value="administrador" <?php echo ($row['rol'] == "administrador" ? "selected" : "")?>>Administrador</option>

<!--  ============================================================================================ -->
<!--  ============================================================================================ -->

        </select>
       <br><br>
               
        <label for="u">Username:</label>
        <input id="u" name="username" type="text" value = "<?php echo $row['username']?>" readonly>
        <br><br>
        
        <label for="p">Password:</label>
        <input id="p" name="password" type="text" value = "<?php echo $row['password']?>" readonly>
        <br><br>
        
        <label for="h">Host:</label>
        <input id="h" name="host" type="text" value = "<?php echo $row['host']?>" readonly>
        <br><br>
        


        <button type="submit">ESBORRAR DEFINITIVAMENT????</button>
    </form>
	
	
<!-- 		</tbody> -->
<!-- </table> -->

	<form action="./personal_gestio.php">
    	<input type="submit" value="Tornar al llistat">
    	<input name="mail" value = "" type="hidden" >
	</form>

	<form action="../index.php">
		<input type="submit" value="Anar a l'inici">
	</form>
</body>

</html>

