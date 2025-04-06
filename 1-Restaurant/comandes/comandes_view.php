<html>
<head>
<!--     <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> -->
    <title>Taula comandes</title>
    <link rel="stylesheet" type="text/css" href="../css/estils.css">
</head>

<body>


<table>
		<thead>
			<tr>
				<th>Data comanda</th>
				<th>Id comanda</th>
				<th>Num taula</th>
				<th>Capacitat taula</th>
				<th>Estat comanda</th>
				<th>Categoria</th>
				<th>Plat</th>
				<th>Quantitat</th>
				<th>Preu plat</th>
				<th>EUR</th>
			</tr>
		</thead>

    <?php
        require("../functions/funcions.php");
        
        $conn = getConnexio();

        $query = "select data_comanda, id_comanda, num_taula, capacitat_taula, estat_comanda, categoria_plat, plat, quantitat, preu_plat, EUR from comandes_view";

 		$registres = mysqli_query($conn, $query) or 
 		                         die("Problemes amb el select de comandes: " . mysqli_error($conn));
 		
 		
	    if($registres){
 		        
 		    while ($row = mysqli_fetch_array($registres)){
 		        
 		        echo "<tr>
                        <td>" . $row['data_comanda'] . "</td>
                        <td>" . $row['id_comanda'] . "</td>
                        <td>" . $row['num_taula'] . "</td>
                        <td>" . $row['capacitat_taula'] . "</td>
                        <td>" . $row['estat_comanda'] . "</td>
                        <td>" . $row['categoria_plat'] . "</td>
                        <td>" . $row['plat'] . "</td>
                        <td>" . $row['quantitat'] . "</td>
                        <td>" . $row['preu_plat'] . "</td>
                        <td>" . $row['EUR'] . "</td>
                      </tr>
                      ";

  		    }
 		        
 		    }else{
 		        
 		        echo "<tr><td colspan = '10'>No hi ha registres!</td></tr>";
 		    }

 		    mysqli_close($conn);

	?>
	
	
   </table>
   
<br><br>
		<form method="post" action="../index.php">
    		<input type="submit" value="Tornar a l'inici">
		</form>
</body>


</html>
