<?php
session_start();
require_once("../functions/funcions.php");
require_once("../includes/header.php");

if (!isset($_SESSION['username'])) {
    //header("Location: ../index.php?error=cap_username_a_welcomephp");
    header("Location: ../error.html?error=welcome_php_cap_username_a_la_sessio");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="./css/estils.css">
    <title>Inici</title>
</head>
<body>
    <div class="centrat">
    	<div class="container">
    	
	<pre>
	    <h3><?php echo "Pàgina d'inici de $_SESSION[nom]"?></h3>
	    <br><?php echo "El teu username: $_SESSION[username]"?>
        <br><?php echo "El teu rol:      $_SESSION[rol]"?>
	    <br><?php echo "El teu host:     $_SESSION[host]"?>	    

	</pre>    	
<!--     	<form action="/Restaurant/index.php"> -->
<!--     		<input type="submit" value="TORNAR A L'INICI"> -->
<!--     	</form> -->
    	</div>
    </div>
</body>
</html>
