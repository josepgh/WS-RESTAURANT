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

    $query = "select id_personal, nom, rol, username, password, host, es_actiu from personal where username = '$_REQUEST[username]'";
    
    $registres = mysqli_query($conn, $query) or die("Problemes amb el select de personal: " . mysqli_error($conn));
    
    if($row = mysqli_fetch_array($registres)){

    }
    else{
        echo "<h1>No existeix l'USERNAME:  $_REQUEST[username]<h1>";
    }
 		    
 	mysqli_close($conn);
?>
	
	<h1>Esborrar persona</h1>
	
    <form action="personal_deleted.php" method="post">

        <label for="n">Nom:</label>
        <input id="n" name="nom" type="text" value = "<?php echo $row['nom']?>" readonly>
        <br><br>
        
        <!-- com el select esta DISABLED pasem el rol amagat EN EL REQUEST -->
        <input name="rol" type="hidden" value = "<?php echo $row['rol']?>">

        <label for="r">Rol:</label>
        <select id="r" name="rol" disabled> <!-- si es posa disabled NO S'ENVIA EN EL REQUEST -->
        
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
        <input id="u" name="username" type="text" value = "<?php echo $row['username']?>" readonly>
        <br><br>
        
        <label for="p">Password:</label>
        <input id="p" name="password" type="text" value = "<?php echo $row['password']?>" readonly>
        <br><br>
        
        <label for="h">Host:</label>
        <input id="h" name="host" type="text" value = "<?php echo $row['host']?>" readonly>
        <br><br>

        <label for="a">Actiu?:</label>
        <input id="a" name="es_actiu" type="text" value = "<?php echo $row['es_actiu']?>" readonly>
        <br><br>

        <label for="actiu">Actiu?: (no)</label>
        <input id="actiu" type="range" name="es_actiu" min="0" max="1" value = "<?php echo $row['es_actiu']?>" disabled> (sí)
        <br><br>


        <button type="submit">ESBORRAR DEFINITIVAMENT????</button>
    </form>
	
	<form action="./personal_gestio.php">
    	<input type="submit" value="Tornar al llistat">
    	<input name="uname" value = "" type="hidden" >
	</form>

	<form action="../index.php">
		<input type="submit" value="Anar a l'inici">
	</form>
</body>

</html>

