<?php
    session_start();
    $_SESSION['username'] = "Pep";
    require ('./includes/header.php');
//     require_once ('./functions/populateDBusers.php');
//     require_once ('./functions/populateDBtables.php');
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
    <link rel="stylesheet" type="text/css" href="./css/estils.css">
    <title>RESTRANT</title>
</head>



<body>

<table>
		<tr>
			<td colspan="3"><h4>INDEX</h4></td>
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
            <td> INDEX PERSONAL </td>
            <td><h4></h4></td>
            <td> 
        		<form action="personal/index_personal.php">
             		<input type="submit" value="INDEX PERSONAL">
				</form>
            </td>
          </tr>


         <tr> 
            <td> INDEX RESERVES </td>
            <td><h4></h4></td>
            <td> 
        		<form action="reserves/index_reserves.php">
        		<input type="submit" value="INDEX RESERVES">
        		
				</form>
            </td>
		</tr>


		<tr>
            <td> INDEX PLATS </td>
             <td><h4>OK</h4></td>
            <td> 
        		<form action="plats/index_plats.php">
             		<input type="submit" value="INDEX PLATS">
				</form>
            </td>
          </tr>
		<tr>
            <td> INDEX COMANDES </td>
             <td><h4>OK</h4></td>
            <td> 
        		<form action="comandes/index_comandes.php">
             		<input type="submit" value="INDEX COMANDES">
				</form>
            </td>
          </tr>
		<tr>
            <td> INDEX TAULES </td>
             <td><h4>OK</h4></td>
            <td> 
        		<form action="taules/index_taules.php">
             		<input type="submit" value="INDEX TAULES">
				</form>
            </td>
          </tr>

         <tr>
            <td></td>
            <td></td>
          </tr>


         <tr>
            <td> ANAR A LES PROVES </td>
            <td></td>
            <td> 
        		<form action="A_PROVES/index_proves.php">
             		<input type="submit" value="ANAR A LES PROVES">
				</form>
            </td>
          </tr>



         <tr>
            <td></td>
            <td></td>
          </tr>


         <tr>
            <td> ANAR AL LOGIN </td>
            <td></td>
            <td> 
        		<form action="login-app/index_login.php">
             		<input type="submit" value="ANAR AL LOGIN">
				</form>
            </td>
          </tr>

		<tr>
            <td> CREA BADE DE DADES</td>
             <td><h4>OK</h4></td>
            <td> 
        		<form action="creaDB/creaDB.php">
             		<input type="submit" value="CREA DB">
				</form>
            </td>
          </tr>


         <tr> 
            <td> TAULA RESERVES <br>
            provoca ERR_CACHE_MISS
            
            </td>
            <td><h4></h4></td>
            <td> 
            
 <?php echo "Data " . date("d-m-Y h:i:sa")?>;<br>           		
<?php echo "Dia " . date('d-m-Y')?>;
            
        		<form action="reserves/reserves.php">
            		<input type="submit" value="Reserves">
				</form>
            </td>
		</tr>


         <tr>
            <td> TANCAR SESSIO </td>
            <td><h4></h4></td>
            <td> 
        		<form action="tancar.php" method="post">
            		<input  type="submit" value="Tancar sessio">
				</form>
            </td>
          </tr>



            <td> TODO?? </td>
            <td><h4></h4></td>
            <td> 
        		<form action="">
        		<br>els grants posar-los a la BD i obtenir-los amb un trigger a l'insertar o modificar persona????
        		<br> MariaDB NO PERMET DDL NI EN TRIGGERS NI EN PROCEDIMENTS
        		<br>O directament per programa??? -> ES LA UNICA MANERA
				</form>
            </td>
          </tr>


 </table> 
 
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"  -->
<!-- 	integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq"  -->
<!-- 	crossorigin="anonymous"></script>   -->
</body>
</html>
<?php
    require './includes/footer.php';
?>

