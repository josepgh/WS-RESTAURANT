<?php 
require('../includes/header.php');
?>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/estils.css">
<!--     <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> -->
    <title>Taula productes</title>
</head>
<body>

<?php
   
    require("../functions/funcions.php");
    //$conn = getConnexio();
    $conn = getUserConnexio($_SESSION['username'], $_SESSION['password'], $_SESSION['host']);

    $query = "select id_personal, nom, rol, username, password, host, es_actiu from personal where username = '$_REQUEST[username]'";
    
    $registres = mysqli_query($conn, $query) or
                            die("Problemes amb el select de personal: " . mysqli_error($conn));
    
    if($row = mysqli_fetch_array($registres)){
	
    }
    else{
        echo "<h1>No existeix l'USERNAME:  $_REQUEST[username]<h1>";
    }
 		    
    mysqli_close($conn);
?>
	
	<h1>Actualitzar persona</h1>
	
    <form action="personal_updated.php" method="post">
        <label for="n">Nom:</label>
        <input id="n" name="nom" type="text" value = "<?php echo $row['nom']?>" required>
        <br><br>

        <label for="r">Selecciona el rol:</label>        
        <select id="r" name="rol">
    
            <!--  ============================================================================================ -->
            <!--  ============================================================================================ -->
            <!--  vist a PART 3 - CREATING A CRUD APPLICATION USING MariaDB AND PHP DATA OBJECTS (PDO) -->
            <!--  minut 15 -->
            <!--  https://www.youtube.com/watch?v=Lafx7yrWHfw&ab_channel=CodePH -->
 
            <option value="">-- Selecciona rol --</option>
            <option value="cuiner" <?php echo ($row['rol'] == "cuiner" ? "selected" : "")?>>Cuiner</option>
            <option value="cambrer" <?php echo ($row['rol'] == "cambrer" ? "selected" : "")?>>Cambrer</option>
            <option value="administrador" <?php echo ($row['rol'] == "administrador" ? "selected" : "")?>>Administrador</option>

            <!--  ============================================================================================ -->
            <!--  ============================================================================================ -->

        </select>  
       <br><br>

        <label for="u">Username:</label>
        <input id="u" name="username" type="text" value = "<?php echo $row['username']?>" readonly> NO MODIFICABLE

        <br><br>

        <label for="p">Password:</label>
        <input id="p" name="password" type="text" value = "<?php echo $row['password']?>" required>
        <br><br>

        <label for="h">Host:</label>
        <input id="h" name="host" type="text" value = "<?php echo $row['host']?>" readonly> NO MODIFICABLE 
		<br><br>


        <label for="actiu">Estat: (BAIXA)</label>
        <input id="actiu" type="range" name="es_actiu" min="0" max="1" value = "<?php echo $row['es_actiu']?>"> (ALTA)
        <br><br>
        
        <button type="submit">UPDATE</button>

    </form>

	<form action="./gestio_personal.php">
    	<input type="submit" value="Tornar al llistat">
    	<input name="uname" value = "" type="hidden" >
	</form>

	<form action="../index.php">
		<input type="submit" value="Anar a l'inici">
	</form>
</body>

</html>
