<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<!--     <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> -->
    <title>Taula reserves</title>
    <link rel="stylesheet" type="text/css" href="../css/estils.css">
</head>

<!-- =============LA TAULA reserves ======================================== -->
	<h1>Diferencia entre la TAULA reserves....</h1>
    <table>
	    <thead>
 		    <tr>
 		    <th>Id reserva</th>
 		    <th>Id taula</th>
 		    <th>Client</th>
 		    <th>Data reserva</th> 		    
 		    <th>Num persones</th>
 		    <th>Username</th>
 		    </tr>
 		  </thead>
    <tbody>
 		    
	<?php
	       require("../functions/funcions.php");

	       $conn = getConnexio();

	       
	       $query = "select id_reserva, id_taula, nom_client, data_reserva, num_persones, username from reserves";
	       
	       $registres = mysqli_query($conn, $query) or
	                   die("Problemes amb el select de comandes: " . mysqli_error($conn));
	       

	       if($registres){
	           
	           while ($row = mysqli_fetch_array($registres)){

 		            echo "<tr>
                        <td>" . $row['id_reserva'] . "</td>
                        <td>" . $row['id_taula'] . "</td>
                        <td>" . $row['nom_client'] . "</td>
                        <td>" . $row['data_reserva'] . "</td>
                        <td>" . $row['num_persones'] . "</td>
                        <td>" . $row['username'] . "</td>
                      </tr>
                      ";

 		        }
 		        
 		    }else{
 		        
 		        echo "<tr><td colspan = '6'>No hi ha registres!</td></tr>";
 		    }
 

	?>
		</tbody>
   </table>


<!-- =============LA VIEW reserves_view ============================================= -->

	<h1>.... i la VIEW reserves_view</h1>

<table>
		<thead>
			<tr>
				<th>Id reserva</th>
				<th>Data reserva</th>
				<th>Num taula</th>
				<th>Capacitat taula</th>
				<th>Persones reserva</th>
				<th>Nom client</th>
				<th>Username</th>
			</tr>
		</thead>
	<tbody>

    <?php
        

    
    
    $query = "select id_reserva, data_reserva, num_taula, capacitat_taula, persones_reserva, nom_client, username from reserves_view";
    
    $registres = mysqli_query($conn, $query) or
    die("Problemes amb el select de comandes: " . mysqli_error($conn));
    
    
    if($registres){
        
        while ($row = mysqli_fetch_array($registres)){
		        
 		        echo "<tr>
                        <td>" . $row['id_reserva'] . "</td>
                        <td>" . $row['data_reserva'] . "</td>
                        <td>" . $row['num_taula'] . "</td>
                        <td>" . $row['capacitat_taula'] . "</td>
                        <td>" . $row['persones_reserva'] . "</td>
                        <td>" . $row['nom_client'] . "</td>
                        <td>" . $row['username'] . "</td>
                      </tr>
                      ";

 		    }
 		        
 		    }else{
 		        
 		        echo "<tr><td colspan = '7'>No hi ha registres!</td></tr>";
 		    }

 		    
 		    mysqli_close($conn);
 		    
        ?>
    </tbody>

</table>

<!-- ============================================================================== -->
<!-- ============================================================================== -->
<br><br>   
	<form method="post" action="../index.php">
		<input type="submit" value="Tornar a l'inici">
	</form>

 
</html>