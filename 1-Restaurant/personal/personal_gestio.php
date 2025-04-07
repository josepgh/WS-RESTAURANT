<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/estils.css">
<!--     <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> -->
    <title>Taula productes</title>
    
</head>
<!-- <body> -->

<body>

    <table>
    	<tr><td>
        <h1>GESTIO DE PERSONAL</h1>
    	
		<form action="personal_gestio.php" method="post">
			INTRODUEIX L'EMAIL DE LA PERSONA: 
			<input type="email" name="mail">
			<input type="submit" value="Cercar">		
		</form>
    	</td></tr>    	
	</table>

	<table>
    	<thead>
    		<tr>
    			<th>Id</th>
    			<th>Nom</th>
    			<th>Rol</th>
    			<th>Email</th>
    			<th>Username</th>
    			<th>Password</th>
    			<th>Host</th>
    			<th>Edita</th>
    			<th>Esborra</th>
    		</tr>
    	</thead>
	<tbody>
    
    <?php
        require '../includes/header.php';
    
        require("../functions/funcions.php");
        $conn = getConnexio();


        if (($_REQUEST['mail'] == "")){
                
            $query = "select id_personal, nom, rol, email, username, password, host from personal";
            
//             echo "<tr><td colspan = '6'> 1 l'email: $_REQUEST[mail] i la query: $query</td></tr>";
            
            
            
        }else{
            
            $query = "select id_personal, nom, rol, email, username, password, host from personal where email = '$_REQUEST[mail]'";
            
                   
//              echo "<tr><td colspan = '6'> 2 l'email:  $_REQUEST[mail] i la query: $query</td></tr>";
            
            
            
        }
        
        
        $registres = mysqli_query($conn, $query) or die("Problemes amb el select de personal: " . mysqli_error($conn));
        
//         echo "<tr><td colspan = '6'> 3 l'email:  $_REQUEST[mail] i la query: $query</td></tr>";

        
    
         if($registres->num_rows > 0){

//             echo "<tr><td colspan = '6'> 4 l'email:  $_REQUEST[mail] i la query: $query</td></tr>";
            
            while ($row = mysqli_fetch_array($registres)){
                
//                 echo "<tr><td colspan = '6'> 5 l'email:  $_REQUEST[mail] i la query: $query</td></tr>";
                // vist a Code PH -> https://www.youtube.com/watch?v=Lafx7yrWHfw&ab_channel=CodePH
                echo "<tr>
                            <td>" . $row['id_personal'] . "</td>
                            <td>" . $row['nom'] . "</td>
                            <td>" . $row['rol'] . "</td>
                            <td>" . $row['email'] . "</td>
                            <td>" . $row['username'] . "</td>
                            <td>" . $row['password'] . "</td>
                            <td>" . $row['host'] . "</td>
                            <td><a href = 'personal_to_update.php?email=" . $row['email'] . "'>edita<a></td>
                            <td><a href = 'personal_to_delete.php?email=" . $row['email'] . "'>esborra<a></td>
                        </tr>
                        ";
                
            }

        }else{

            // Recibimos el valor desde formulario1.php
            // $eemail = "";
            // aquestes dos okkkkkkkk
            // $eemail = $_POST['mail'] ?? ''; 
            // echo "<h1> $eemail </h1>";

            // echo "<h1>" . $ _P OS T['m  ail'] . "</h1>";
            
            echo "<tr>
                    <td colspan = '9'><br><h1>No existeix la persona amb email: " . $_POST['mail'] . "  <br>
                    <a href = 'personal_to_insert.php?email=" . $_POST['mail'] . "  '> inserir </a></h1><br>
                    </td>
                </tr>
                ";

            
            
//             <form action="./personal_gestio.php">
//             <input type="submit" value="Tornar al llistat">
//             <input name="mail" value = "" type="hidden" >
//             </form>
            
            
            
            
            
//             echo "<tr><td colspan = '6'> No existeix la persona amb email: $_REQUEST[mail]</td></tr>";

//             echo "<tr>
//                              <td><a href = 'tmp2.php?email=" . $_REQUEST[mail] . "'>afegeix<a></td>
//                     </tr>
//                      ";

        }
        
        

        
        

        
        
// <?php
        mysqli_close($conn); 
        
?>
     	
    	
	</tbody>
</table>

	<br><br>
	<form action="./personal_gestio.php">
    	<input type="submit" value="Tornar al llistat">
    	<input name="mail" value = "" type="hidden" >
	</form>
	
	<form action="../index.php">
		<input type="submit" value="Tornar a l'inici">
	</form>

	
</body>

<?php
    require '../includes/footer.php';
?>
</html>

