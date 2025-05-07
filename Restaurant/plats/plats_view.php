<?php
    session_start();
    require '../includes/header.php';
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<!--     <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> -->
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Datepicker Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" 
    			rel="stylesheet">
<!--     <link rel="stylesheet" type="text/css" href="../css/estils.css"> -->

    <title>Plats view</title>
    
</head>

<h1> PLATS VIEW (CARTA) </h1>
<table class="table table-bordered table-striped">
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
        //$conn = getConnexio();
        $conn = getUserConnexio($_SESSION['username'], $_SESSION['password'], $_SESSION['host']);

 		$query = "select categoria, nom, descripcio, preu from plats_view";

 		
 		$registres = mysqli_query($conn, $query) or die("Problemes amb el select de plats: " . mysqli_error($conn));
 		
 		
 		if($registres){
 		    
 		    while ($row = mysqli_fetch_array($registres)){
 		        
      
 		        echo "<tr>
                        <td>" . $row['categoria'] . "</td>
                        <td>" . $row['nom'] . "</td>
                        <td>" . $row['descripcio'] . "</td>
                        <td>" . $row['preu'] . "</td>
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