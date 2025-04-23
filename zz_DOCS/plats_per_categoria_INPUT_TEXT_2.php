<html>
<head>
    <link rel="stylesheet" type="text/css" href="estils.css">
    <title>LLISTAT DE PLATS DE LA CATEGORIA $_REQUEST[$nom_cat]</title>
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
	
        $query = "select categoria_plat, nom_plat, descripcio_plat, preu_plat from plats_view WHERE  categoria_plat = '$_REQUEST[nom_cat]'";
        
        $connexio =  mysqli_connect("localhost", "root", "mdb", "restaurantDB");

        if($connexio){
            echo "Connexio OK"."<br>";
        }else{
            die(mysqli_error("Error "+ $connexio));
        }										
						
		$registres = mysqli_query($connexio, $query)
		              or die("Problemes amb el select: ".mysqli_errno($connexio));
		
        if($row = mysqli_fetch_array($registres)){
		    
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

<br>

<a href="index.php" class="btn btn-primary">TORNA A L'INICI</a>

    </body>
</html>