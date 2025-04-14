<?php
session_start();
//require_once("../functions/funcions.php");

//$usuariActual = getUsuariActual();

//https://www.youtube.com/watch?v=GX_qu0gMHHc&ab_channel=fabianbarbon

//header("Refresh:0");

if (!isset($_SESSION['username'])) {
    //header("Location: ../index.php?error=cap_username_a_welcomephp");
//     header("Location: ../error.html?error=header_error_cap_username_a_la_sessio");
//     exit();
// $nom = "";
// $username = "";
// $rol = "";
}else{
    
//     $nom = $_SESSION[nom];
//     $username = $_SESSION['username'];
//     $rol = $_SESSION['rol'];

}

?>




<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Mi Proyecto PHP</title>
    <link rel="stylesheet" href="../css/estils.css">
</head>
<body>
<nav>
    <a href="index.php">Inicio</a>
    <a href="contacto.php">Contacto</a>
</nav>
</body>
</html>
<header>
    <p>&copy; <?php echo date('Y'); ?> Restaurant Ouspassatsperaigua</p>
    
    <table>
	<tbody>

<!--          <tr> -->
<!-- 			<h2>capçalera</h2> -->
<!-- 			<p>< php echo "nom:  $_SESSION[nom];"? ><p> -->
<!-- 			<p>username: $username<p> -->
<!-- 			<p>rol: $rol</p> -->
<!--           </tr> -->
<!--          <tr> -->
<!--             <td> ANAR AL WELCOME</td> -->
<!--             <td>  -->
<!--         		<form action="login-app/welcome.php" method="POST"> -->
<!--         		<form action="login-app/welcome.php"> -->
<!--                     <input type="text" name="username" placeholder="Usename" required><br> -->
<!--                     <input type="text" name="password" placeholder="Password" required><br> -->
<!--                     <input type="text" name="password" placeholder="Contraseña" required><br> -->
<!--                     <input type="submit" value="Anar al welcome"> -->
<!-- 				</form> -->
<!--             </td> -->
<!--           </tr> -->


<!--          <tr> -->
<!--             <td> prova REGISTAR USUARIS</td> -->
<!--             <td>  -->
<!--         		<form action="login-app/registre_usuari.php" method="POST"> -->
<!--                     <input type="text" name="username" placeholder="Usename" required><br> -->
<!--                     <input type="password" name="password" placeholder="Password" required><br> -->
<!--                     <input type="text" name="password" placeholder="Contraseña" required><br> -->
<!--                     <input type="submit" value="Registrar"> -->
<!-- 				</form> -->
<!--             </td> -->
<!--           </tr> -->
</tbody>

</table>
    
</header>
