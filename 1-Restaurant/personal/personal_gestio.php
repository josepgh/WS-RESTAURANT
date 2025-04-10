<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/estils.css">
    <title>Gestio personal</title>
    
</head>

<body>

    <table>
    	<tr><td>
        <h1>GESTIO DE PERSONAL</h1>
    	
		<form action="personal_gestio.php" method="post">
			<label for="e">Introdueix l'USERNAME: </label>
			<input id="e" type="text" name="uname">
			<input type="submit" value="Cercar">		
		</form>
    	</td></tr>    	
	</table>

	<table>
    	<thead><tr>
    			<th>Id</th>
    			<th>Nom</th>
    			<th>Rol</th>
<!--     			<th>Emmaaiill</th> -->
    			<th>Username</th>
    			<th>Password</th>
    			<th>Host</th>
    			<th>Edita</th>
    			<th>Estat</th>
    			<th>Switch</th>    			
    			<th>Esborra</th>
		</tr></thead>
	<tbody>
    
    <?php
        require '../includes/header.php';
    
        require("../functions/funcions.php");
        $conn = getConnexio();


        if (($_REQUEST['uname'] == "")){ //si l'username a cercar esta buit -> llista tots el personal
                
            $query = "select id_personal, nom, rol, username, password, host, es_actiu from personal";
            
            //echo "<tr><td colspan = '10'> 1 l'username: $_REQUEST[uname] i la query: $query</td></tr>";
            
        }else{ // si no és buit -> cerca l'username demanat
            
            $query = "select id_personal, nom, rol, username, password, host, es_actiu from personal where username = '$_REQUEST[uname]'";
                              
            //echo "<tr><td colspan = '10'> 2 l'username:  $_REQUEST[uname] i la query: $query</td></tr>";
        }
        
        $registres = mysqli_query($conn, $query) or die("Problemes amb el select de personal: " . mysqli_error($conn));
        
        //echo "<tr><td colspan = '10'> 3 l'username:  $_REQUEST[uname] i la query: $query</td></tr>";

         if($registres->num_rows > 0){ // si la cerca dona resultats els mostra tots en un while

            //echo "<tr><td colspan = '10'> 4 l'username:  $_REQUEST[uname] i la query: $query</td></tr>";
            
            while ($row = mysqli_fetch_array($registres)){
                
                // echo "<tr><td colspan = '10'> 5 l'ESTAT:  $row[actiu] i la query: $query</td></tr>";
                // echo "<tr><td colspan = '10'> 5 l'username:  $_REQUEST[uname] i la query: $query</td></tr>";
                // vist a Code PH -> https://www.youtube.com/watch?v=Lafx7yrWHfw&ab_channel=CodePH
                echo "<tr><td>" . $row['id_personal'] . "</td>";
                            echo "<td>" . $row['nom'] . "</td>";
                            echo "<td>" . $row['rol'] . "</td>";
                            // echo "<td>" . $row['emmmmmaaiil'] . "</td>";
                            echo "<td>" . $row['username'] . "</td>";
                            echo "<td>" . $row['password'] . "</td>";
                            echo "<td>" . $row['host'] . "</td>";
                            echo "<td><a href = 'personal_to_update.php?username=" . $row['username'] . "'>edita<a></td>";

                            if ($row['es_actiu'] == 1){
                                echo "<td>ALTA</td>";
                            }else{
                                echo "<td>BAIXA</td>";
                            }
                            
                            if ($row['es_actiu'] == 1){
                                echo "<td>  ( <a href = 'personal_to_switch.php?username=" . $row['username'] . "'>donar de BAIXA )<a></td>";
                            }else{
                                echo "<td>  ( <a href = 'personal_to_switch.php?username=" . $row['username'] . "'>donar d'ALTA )<a></td>";
                            }
                            echo "<td><a href = 'personal_to_delete.php?username=" . $row['username'] . "'>esborra<a></td>";
                echo "</tr>";
                //<option value="cuiner" <?php echo ($row['rol'] == "cuiner" ? "selected" : "")? > >Cuiner</option>
                
            }

        }else{ // si la cerca no dona resultat -> dona opció d'insertar la persona

            // Recibimos el valor desde formulario1.php // $uname = $_POST['username'] ?? ''; 

            echo "<tr>
                    <td colspan = '10'><br><h1>No existeix l'USERNAME: " . $_POST['uname'] . "  <br>
                    <a href = 'personal_to_insert.php?username=" . $_POST['uname'] . "  '> inserir </a></h1><br>
                    </td>
                </tr>
                ";
        }

        mysqli_close($conn); 
?>
     	
    	
	</tbody>
</table>

	<br><br>
	<form action="./personal_gestio.php">
    	<input type="submit" value="Tornar al llistat">
    	<input name="uname" value = "" type="hidden" >
	</form>
	
	<form action="../index.php">
		<input type="submit" value="Tornar a l'inici">
	</form>
	
</body>

<?php
    require '../includes/footer.php';
?>
</html>

