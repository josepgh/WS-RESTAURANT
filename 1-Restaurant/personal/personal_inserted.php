<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/estils.css">
    <title>Inserir personal</title>
</head>
<body>

    <?php
   
    require("../functions/funcions.php");
    $conn = getConnexio();

    // ---- primer mira si esta a la BD -------------------------------------------------------------------
    
    $query = "select id_personal, nom, rol, username, password, host, es_actiu from personal where username = '$_REQUEST[username]'";
    
    $registres = mysqli_query($conn, $query) or die("Problemes amb el select de personal: " . mysqli_error($conn));
    //$row = mysqli_fetch_array($registres);
    
    //if($row = mysqli_fetch_array($registres)){ 
    // cal mirar els tres tipu d'error: existeix emaaail, existeix username
    
    //$row = mysqli_fetch_array($registres);
    
    //if($row = mysqli_fetch_array($registres)){
    if(mysqli_fetch_array($registres)){
            
        // si JA EXISTEIX USERNAME A LA BD => ERRROR -------------------------------

        echo "<h1>ERROR: JA EXISTEIX L'USERNAME: $_REQUEST[username]</h1>";
        echo "<h2>Nom:  " . "$_REQUEST[nom]" . "</h2>";
        echo "<h2>Rol:  " . "$_REQUEST[rol]" . "</h2>";
        echo "<h2>Username:  " . "$_REQUEST[username]" . "</h2>";
        echo "<h2>Host:  " . "$_REQUEST[host]" . "</h2>";
    }
    else{ // si NO EXISTEIX A LA BD => L'INSERTA + CREA USER A LA BD + LI ATORGA GRANTS (SI CAL !!!!!)

        
//          $hash = hash('sha256', $_REQUEST['password']);
         
         $query_insert = "insert into personal(nom, rol, username, password, pwdhash, host, es_actiu)
                        values('$_REQUEST[nom]', '$_REQUEST[rol]', '$_REQUEST[username]', '$_REQUEST[password]', 'PWDHASH', '$_REQUEST[host]', '$_REQUEST[es_actiu]')";
         
         mysqli_query($conn, $query_insert) or die("Error en l'insert de personal: ". mysqli_error($conn));

         // ========================================================================================
         // ============================== IMPORTANT ===============================================
         // ========================================================================================
         
         $query_nou_usuari_db = "CREATE USER '$_REQUEST[username]'@'$_REQUEST[host]' IDENTIFIED BY '$_REQUEST[password]'";
         //$query_nou_usuari_db = "CREATE USER '$_REQUEST[username]'@'$_REQUEST[host]' IDENTIFIED BY 'SHA2('$_REQUEST[password]', 256)'";
         //$query_nou_usuari_db = "CREATE USER '$_REQUEST[username]'@'$_REQUEST[host]' IDENTIFIED BY hash('sha256', $_REQUEST[password])";
         
         // ========================================================================================
         
         mysqli_query($conn, $query_nou_usuari_db) or die("Error en CREATE USER: ". mysqli_error($conn));

         // ========================================================================================
         // ============================== IMPORTANT ===============================================
         // ========================================================================================
         setGrants($_REQUEST['rol'], $_REQUEST['username'], $_REQUEST['host'], $_REQUEST['es_actiu']);
         // ========================================================================================
         
//          if($_REQUEST['es_actiu'] == 1){ // li atorga els GRANTS NOMÉS si s'insereix amb estat ALTA
             
//              $query_grants_nou_usuari_db = "GRANT SELECT, INSERT, UPDATE ON restaurantDB.* TO '$_REQUEST[username]'@'$_REQUEST[host]';";
//              mysqli_query($conn, $query_grants_nou_usuari_db) or die("Error en atorgar GRANTS: ". mysqli_error($conn));
             
//          }else{ // NO FA RES -> ES QUEDA SENSE GRANTS
             
             
//          }
         
//          $query_grants_nou_usuari_db = "GRANT SELECT, INSERT, UPDATE ON restaurantDB.* TO '$_REQUEST[username]'@'$_REQUEST[host]';";
//          mysqli_query($conn, $query_grants_nou_usuari_db) or die("Error en atorgar GRANTS: ". mysqli_error($conn));
         


        // flush privilegis per sinó el sistema de privilegis de mariadb no reconeix aquest usuari (CHATGPT)
        //mysqli_query($conn, "FLUSH PRIVILEGES") or die("Problemes al fer el FLUSH PRIVILEGES: " . mysqli_error($conn));
        
        echo "<h1>Persona HA ESTAT AFEGIDA AMB EXIT:</h1>";
        echo "<h2>Nom:  " . "$_REQUEST[nom]" . "</h2>";
        echo "<h2>Rol:  " . "$_REQUEST[rol]" . "</h2>";
        // echo "<h2>Email:  " . "$_REQUEST[email]" . "</h2>";
        echo "<h2>Usename:  " . "$_REQUEST[username]" . "</h2>";
        echo "<h2>Password:  " . "$_REQUEST[password]" . "</h2>";
        echo "<h2>Host:  " . "$_REQUEST[host]" . "</h2>";
        echo "<h2>Actiu?:  " . "$_REQUEST[es_actiu]" . "</h2>";

        if ($_REQUEST['es_actiu'] == 1){
            echo "<h2>Estat: ACTIU</h2>";
        }else{
            echo "<h2>Estat: BAIXA</h2>";
        }
//         echo "<h2>" . setGrants($row['rol'], $row['username'], $row['host'], $row['es_actiu']) . "<h2>";
        
        
        
//         $query_nou_usuari = "CREATE USER '$_REQUEST[username]'@'$_REQUEST[host]' IDENTIFIED BY '$_REQUEST[password]'";
//         $query_grants_nou_usuari = "GRANT SELECT ON restaurantdb.* TO $_REQUEST[username]@$_REQUEST[host]";

//         echo "<tr><td> QUERY ALTA USUARI:  $query_nou_usuari_db</td></tr><br><br>";
//         echo "<tr><td> QUERY GRANTS USUARI:  $query_grants_nou_usuari_db</td></tr><br><br>";

        
    }
    
    mysqli_close($conn);
?>


	<form action="./personal_gestio.php">
    	<input type="submit" value="Tornar al llistat">
    	<input name="uname" value = "" type="hidden" >
	</form>

	<form action="./personal_to_insert.php">
		<input type="submit" value="Insertar altra persona">
	</form>

	<form action="../index.php">
		<input type="submit" value="Tornar a l'inici">
	</form>
	
</body>

</html>