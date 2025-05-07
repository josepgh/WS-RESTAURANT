<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Taula productes</title>
</head>
    <body>

    <?php
		$query = "select idProducte, descripcio, preu from productes";
		
        $connexio =  mysqli_connect("localhost", "root", "mdb", "burguerDB") 
                        or die("Problema amb la connexió a la BD");
        $registres = mysqli_query($connexio, $query)
                                or die("Problemes amb el select: ". mysqli_errno($connexio));
                                while ($reg = mysqli_fetch_array($registres)){
                                    echo "IdProducte: ".$reg['idProducte']."<br>";
                                    echo "Descripcio: ".$reg['descripcio']."<br>";
                                    echo "Preu: ".$reg['preu']."<br>";
                                    
                                    echo "<hr>";
                                }
        mysqli_close($connexio);                               
	?>
    </body>
</html>