<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<!--     <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> -->
    <title>Plats view</title>
    <link rel="stylesheet" type="text/css" href="../css/estils.css">
    
</head>

<h1> PLATS VIEW (CARTA) </h1>
<table>
		<thead>
			<tr>
				<th>Categoria plat</th>
				<th>Nom plat</th>
				<th>Descripcio</th>
				<th>Preu plat</th>
			</tr>
		</thead>
		<tbody>

    <?php
        require("../functions/funcions.php");
        $conn = getConnexio();

 		$query = "select categoria_plat, nom_plat, descripcio_plat, preu_plat from plats_view";

 		
 		$registres = mysqli_query($conn, $query) or
 		die("Problemes amb el select de plats: " . mysqli_error($conn));
 		
 		
 		if($registres){
 		    
 		    while ($row = mysqli_fetch_array($registres)){
 		        
      
 		        echo "<tr>
                        <td>" . $row['categoria_plat'] . "</td>
                        <td>" . $row['nom_plat'] . "</td>
                        <td>" . $row['descripcio_plat'] . "</td>
                        <td>" . $row['preu_plat'] . "</td>
                      </tr>
                      ";
 		    }
 		        
 		    }else{
 		        
 		        echo "<tr><td colspan = '4'>No hi ha registres!</td></tr>";
 		    }

 		    mysqli_close($conn);

	?>
	
	
		</tbody>
   </table>
<br><br>   
	<form method="post" action="../index.php">
		<input type="submit" value="Tornar a l'inici">
	</form>

</html>