<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/estils.css">
<!--     <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> -->
    <title>LLISTAT DE PLATS DE LA CATEGORIA</title>
</head>

    <body>
    
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
	
        $query = "select categoria_plat, nom_plat, descripcio_plat, preu_plat from plats_view WHERE  categoria_plat = '$_REQUEST[categoria]'";
        
        $connexio =  mysqli_connect("localhost", "root", "mdb", "restaurantDB");

        if($connexio){
            echo "Connexio OK"."<br>";
        }else{
            die(mysqli_error("Error "+ $connexio));
        }										
						
		$registres = mysqli_query($connexio, $query)
		              or die("Problemes amb el select: ".mysqli_errno($connexio));
		
        if($row = mysqli_fetch_array($registres)){

            echo "<h1>LLISTAT DE PLATS DE LA CATEGORIA $_REQUEST[categoria]</h1>";
            
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
						
        mysqli_close($connexio);      
        
	?>
</table>

	<br><br>
	<form action="./plats_per_categoria_select.php">
		<input type="submit" value="Tornar enrere">
	</form>
	<form action="../index.php">
		<input type="submit" value="Tornar a l'inici">
	</form>

		
    </body>
</html>