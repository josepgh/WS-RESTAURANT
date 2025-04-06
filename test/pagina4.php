<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Dades del producte</title>
</head>
    <body>

    <?php
	
//		$nomt = "T10";
//		$query = "select idTaula, nom, situacio, ocupada, maxComensals from taules where nom = '$_REQUEST[nomt]'";

		$query = "select idTaula, nom, situacio, ocupada, maxComensals from taules where nom = '$_REQUEST[nomtaula]'";

		
        $connexio =  mysqli_connect("localhost", "root", "mdb", "burguerDB");
        if($connexio){
            echo "Connexio OK"."<br>";
        }else{
            die(mysqli_error("Error"+$connexio));
        }
		
//		$registres = mysqli_query($connexio, "select idTaula, nom, situacio, ocupada, maxComensals from taules where nom = '$_REQUEST[nomtaula]'")
		$registres = mysqli_query($connexio, $query)
						or die("Problemes amb el select: ".mysqli_errno($connexio));
						if ($reg = mysqli_fetch_array($registres)){
							echo "Id taula".$reg['idTaula']."<br>";
							echo "Nom taula".$reg['nom']."<br>";
							echo "Situacio".$reg['situacio']."<br>";
							echo "Ocupada".$reg['ocupada']."<br>";
							echo "Maxim comensals".$reg['maxComensals']."<br>";
							echo "<hr>";
						}else{
							"No existeix el producte";
						}
        mysqli_close($connexio);                               

	?>
    </body>
</html>