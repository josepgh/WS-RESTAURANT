<?php
session_start();
require("../includes/header.php");
require("../functions/funcions.php");
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" 
		rel="stylesheet" crossorigin="anonymous"
		integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/estils.css">

    <title>Taula taules</title>

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
    
    //$conn = getConnexio();
    //$conn = getUserConnexio();
    $conn = getUserConnexio($_SESSION['username'], $_SESSION['password'], $_SESSION['host']);
    
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