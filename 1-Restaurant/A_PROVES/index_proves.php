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
            <td> SELECTS </td>
            <td> 
        		<form action="./selects.php">
                    <input type="submit" value="SELECTS">
				</form>
            </td>
          </tr>

         <tr>
            <td> SELECTS 2 </td>
            <td> 
        		<form action="./selects2.php">
                    <input type="submit" value="SELECTS 2">
				</form>
            </td>
          </tr>

		<tr>
            <td> prova PRODUCTOS </td>
            <td> 
        		<form action="prova_productos.php">
             		<input type="submit" value="PROVA PRODUCTOS">
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

