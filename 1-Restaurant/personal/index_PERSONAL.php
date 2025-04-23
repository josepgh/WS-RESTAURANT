<?php
    session_start();
    $_SESSION['username'] = "Pep";
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
    <title>RESTRANT</title>
</head>



<body>

<table>
		<tr>
			<td colspan="3"><h4>INDEX PERSONAL</h4></td>
		</tr>
</table>



<table>
	<thead>
		<tr>
			<th>Accio</th>
			<th>Estat</th>
			<th>Executar</th>
			
		</tr>
	</thead>

        <tr>
            <td> GESTIO DE PERSONAL </td>
            <td><h4></h4></td>
            <td> 
        		<form action="./gestio_personal.php">
        			<input name="uname" value = "" type="hidden" >
             		<input type="submit" value="Gestio de personal">
				</form>
            </td>
          </tr>


         <tr>
            <td>AFEGIR PERSONA</td>
            <td><h4></h4></td>
            <td> 
        		<form action="./personal_to_insert.php">
            		<input type="submit" value="AFEGIR persona">
				</form>
            </td>
          </tr>
          


 </table> 
 
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"  -->
<!-- 	integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq"  -->
<!-- 	crossorigin="anonymous"></script>   -->
</body>
	<form action="../index.php">
		<input type="submit" value="Tornar a INDEX INICI">
	</form>

</html>
<?php
    require '../includes/footer.php';
?>

