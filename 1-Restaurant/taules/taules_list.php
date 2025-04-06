<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Taula taules</title>
    <link rel="stylesheet" type="text/css" href="../css/estils.css">
</head>
<table>
	<thead>
		<tr>
			<th>Id taula</th>
			<th>Numero taula</th>
			<th>Capacitat</th>
		</tr>
	</thead>
	<tbody>

    <?php
    
    
    
    require("../functions/funcions.php");
    
    $conn = getConnexio();
    
    $query = "select id_taula, numero, capacitat from taules";
    
    $registres = mysqli_query($conn, $query) or
    die("Problemes amb el select de comandes: " . mysqli_error($conn));
    
    
    if($registres){
        
        while ($row = mysqli_fetch_array($registres)){
            
 		        echo "<tr>
                            <td>" . $row['id_taula'] . "</td>
                            <td>" . $row['numero'] . "</td>
                            <td>" . $row['capacitat'] . "</td>
                        </tr>
                        ";
 		    }
 		        
 		    }else{
 		        
 		        echo "<tr><td colspan = '3'>No hi ha registres!</td></tr>";
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