<?php
    session_start();
//     $_SESSION['username'] = "chusep";
    require ('../includes/header.php');
?>



<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
    <!-- 	Bootstrap CSS (des de CDN) -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" 
			integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
	
    <!-- <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/estils.css">
    <title>INDEX</title>
</head>

<body>
<table>
		<tr>
			<td colspan="2"><h4>INDEX DE LES PROVES</h4></td>
		</tr>
</table>

<table>


	<thead>
		<tr>
			<th>Accio</th>
			<th>Executar</th>
		</tr>
	</thead>


         <tr>
            <td> ANAR AL LOGIN </td>
            <td> 
        		<form action="login.html">
<!--                     <input type="text" name="username" placeholder="Usuario" ><br> -->
<!-- <!--                     <input type="password" name="password" placeholder="Contraseña" required><br>  -->
<!--                     <input type="text" name="password" placeholder="Contraseña" ><br> -->
<!--                     https://www.php.net/manual/es/function.gethostname.php -->
<!-- <!--         			<input name="host" value = "< ? php echo gethostbyname(gethostname()) ? >" type="hidden" >  -->
<!--         			<input name="host" value = "localhost" type="hidden" > -->
                    <input type="submit" value="LOGIN">
				</form>
            </td>
          </tr>
         <tr>
            <td> ANAR AL WELCOME</td>
            <td> 
<!--         		<form action="login-app/welcome.php" method="POST"> -->
        		<form action="welcome.php">
<!--                     <input type="text" name="username" placeholder="Usename" required><br> -->
<!--                     <input type="text" name="password" placeholder="Password" required><br> -->
<!--                     <input type="text" name="password" placeholder="Contraseña" required><br> -->
                    <input type="submit" value="welcome">
				</form>
            </td>
          </tr>

 </table> 
 

	<form action="../index.php">
		<input type="submit" value="Tornar a INDEX INICI">
	</form>
 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" 
	integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" 
	crossorigin="anonymous"></script>  
</body>
</html>
<?php
    require '../includes/footer.php';
?>

