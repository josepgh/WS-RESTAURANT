<?php
session_start();

require_once("../functions/funcions.php");

//$usuariActual = getUsuariActual();
  
if (!isset($_SESSION['username'])) {
    //header("Location: ../index.php?error=cap_username_a_welcomephp");
    header("Location: ../error.html?error=welcome_php_cap_username_a_la_sessio");
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Benvingut</title>
</head>
<body>


	<table>
	<tr>
	
	</tr>
	
	<tr>
	    <h2><?php echo "¡Benvingut, $_SESSION[nom]!"?></h2>
        <p><?php echo "El teu rol: $_SESSION[rol]"?></p>
        <p><?php echo "El teu password: $_SESSION[password]!"?></p>
    
        <p><a href="logout.php">Tancar sessió</a></p>
        <p><a href="../index.php">Anar a l'index</a></p>
	
	</tr>

	<tr>
	
	</tr>
	
    
<!--     	<br><br> -->
<!-- 	<form action="./personal_gestio.php"> -->
<!--     	<input type="submit" value="Tornar al llistat"> -->
<!--     	<input name="uname" value = "" type="hidden" > -->
<!-- 	</form> -->
	
<!-- 	<form action="../index.php"> -->
<!-- 		<input type="submit" value="Tornar a l'inici"> -->
<!-- 	</form> -->


</table> 
   
</body>
</html>

