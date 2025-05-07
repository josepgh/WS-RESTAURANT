<?php
    session_start();
    unset($_SESSION['username']);
    unset($_SESSION['password']);
    unset($_SESSION['host']);
    unset($_SESSION['nom']);
    unset($_SESSION['rol']);
    session_destroy(); // Tanca la sessió
    require ('./includes/header.php');
?>

<!DOCTYPE html>
<html>
<head>
    <!-- 	Bootstrap CSS (des de CDN) -->
<!-- 	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"  -->
<!-- 			integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous"> -->
	
    <!-- <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./css/estils.css">
    <title>RESTRANT</title>
</head>

<body>
    <div class="centrat">
        <form action="/Restaurant/login-app/login.php" method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username"required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="text" name="password" required>
            </div>
            <div class="form-group">
                <label for="host">Host</label>
                <input type="text" name="host" required>
            </div>
            <div class="form-group">
                <label for="boto"></label>
                <input name="boto" type="submit" value="Entrar">
            </div>
        </form>
    </div>

	<table  class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>Accio</th>
			<th>Estat</th>
			<th>Executar</th>	
		</tr>
	</thead>
         <tr>
            <td> ANAR AL LOGIN </td>
            <td></td>
            <td> 
        		<form action="./login-app/login.php">
             		<input type="submit" value="ANAR AL LOGIN">
				</form>
            </td>
          </tr>
         <tr>
            <td> INDEX ANTIC </td>
            <td><h4></h4></td>
            <td> 
            	<form action="./index_ANTIC.php">
            		<input type="submit" value="Index ANTIC">
            	</form>
            </td>
          </tr>
 		</table> 
	</body>
</html>
<?php
    require './includes/footer.php';
?>
