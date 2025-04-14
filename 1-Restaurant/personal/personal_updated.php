<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/estils.css">
    <title>Personal actualitzat</title>
</head>
<body>
    
<?php
    
    require("../functions/funcions.php");
    $conn = getConnexio();
    
    $query_update = "update personal 
            set nom='$_REQUEST[nom]', rol='$_REQUEST[rol]', password='$_REQUEST[password]', es_actiu='$_REQUEST[es_actiu]' 
            where username = '$_REQUEST[username]'";
     
    mysqli_query($conn, $query_update) or die("Problemes amb l'UPDATE de personal: " . mysqli_error($conn));
    //$row = mysqli_fetch_array($registres);
    
    echo "<h1>Persona HA ESTAT ACTUALITZADA:</h1>";
    echo "<h2>Nom:  " . "$_REQUEST[nom]" . "</h2>";
    echo "<h2>Rol:  " . "$_REQUEST[rol]" . "</h2>";
    // echo "<h2>Email:  " . "$_REQUEST[new_email]" . "</h2>";
    echo "<h2>Username:  " . "$_REQUEST[username]" . "</h2>";
    echo "<h2>Password:  " . "$_REQUEST[password]" . "</h2>";
    echo "<h2>Host:  " . "$_REQUEST[host]" . "</h2>";
    echo "<h2>Actiu? (Sí=1 No=0):  " . "$_REQUEST[es_actiu]" . "</h2>";
    
    
    // CONSULTA LA BD PER SI L'USUARI TE GRANTS: -------------------------------------------------------------------------------------------------
//     $query_te_grants = "SELECT COUNT(*) as count FROM mysql.user WHERE User = '$_REQUEST[username]' AND Host = '$_REQUEST[host]'";
//     $reg = mysqli_query($conn, $query_te_grants) or die("Problemes en consultar els GRANTS d'un user a la taula mysql.user: " . mysqli_error($conn));
//     $row_grants = mysqli_fetch_array($reg);
    // -------------------------------------------------------------------------------------------------------------------------------------------
    
    //echo "1 l'username:  $_REQUEST[username] <br> i la query_te_grants: $query_te_grants <br>";
    
    //TODO perque entre comentes funciona i sense no???????
    if ($_REQUEST['es_actiu'] == 1){  // només li atorga els GRANTS si MODIFICA l'estat a ALTA i no tenia GRANTS
        
    //if ($_REQUEST['es_actiu'] == 1){  // només li atorga els GRANTS si MODIFICA l'estat a ALTA i no tenia GRANTS
//    if ($row['es_actiu'] == 1){  // només li atorga els GRANTS si MODIFICA l'estat a ALTA i no tenia GRANTS
            echo "<h2>Estat: ACTIU</h2>";

            
//             // CONSULTA LA BD PER SI L'USUARI TE GRANTS: -------------------------------------------------------------------------------------------------
//                 $query_te_grants = "SELECT COUNT(*) as count FROM mysql.user WHERE User = '$_REQUEST[username]' AND Host = '$_REQUEST[host]'";
//                 $reg = mysqli_query($conn, $query_te_grants) or die("Problemes en consultar els GRANTS d'un user a la taula mysql.user: " . mysqli_error($conn));
//                 $row_grants = mysqli_fetch_array($reg);
            
            
            
           // echo "2 l'username:  $_REQUEST[username] ESTA ACTIU <br> i el valor de es_actiu = $_REQUEST[es_actiu] <br> i la row_grants count : $row_grants[count] <br>";
//         //sleep(30);            
// //         if($row_grants['count'] == 0){ // ESTA ACTIU I NO TE GRANTS -> LI ELS ATORGA
// //             //$query_atorga_grants = "GRANT SELECT, INSERT, UPDATE ON restaurantDB.* TO '$_REQUEST[username]'@'$row_grants[host]';";
//             $query_atorga_grants = "GRANT SELECT, INSERT, UPDATE ON restaurantDB.* TO '$_REQUEST[username]'@'$_REQUEST[host]';";
//             mysqli_query($conn, $query_atorga_grants) or die("Error en TORNAR a atorgar GRANTS al switch: ". mysqli_error($conn));
// //         }else{
            
            
// //         }
        
    }else{  // si esta de baixa li revoca els grants NOMÉS SI EN TÉ
        echo "<h2>Estat: BAIXA</h2>";

        
        
//         // CONSULTA LA BD PER SI L'USUARI TE GRANTS: -------------------------------------------------------------------------------------------------
//         $query_te_grants = "SELECT COUNT(*) as count FROM mysql.user WHERE User = '$_REQUEST[username]' AND Host = '$_REQUEST[host]'";
//         $reg = mysqli_query($conn, $query_te_grants) or die("Problemes en consultar els GRANTS d'un user a la taula mysql.user: " . mysqli_error($conn));
//         $row_grants = mysqli_fetch_array($reg);
        
        
        
        //echo "3 l'username:  $_REQUEST[username] ESTA DE BAIXA <br> i el valor de es_actiu = $_REQUEST[es_actiu] <br> i la row_grants count : $row_grants[count] <br>";
        
// //         if($row_grants['count'] > 0){ //si te algun GRANT, fa un REVOKE:
// //             //$query_revoke_grants = "REVOKE ALL PRIVILEGES, GRANT OPTION FROM '$_REQUEST[username]'@'$row_grants[host]'";
//             $query_revoke_grants = "REVOKE ALL PRIVILEGES, GRANT OPTION FROM '$_REQUEST[username]'@'$_REQUEST[host]'";
//             mysqli_query($conn, $query_revoke_grants) or die("Error en REVOCAR GRANTS al switch: ". mysqli_error($conn));
        
// //         }else{ // SI NO TE GRANTS ELS ATORGA
            
// //             //$query_atorga_grants = "GRANT SELECT, INSERT, UPDATE ON restaurantDB.* TO '$_REQUEST[username]'@'$_REQUEST[host]';";
// //             //mysqli_query($conn, $query_atorga_grants) or die("Error en TORNAR a atorgar GRANTS al switch: ". mysqli_error($conn));
            
// //         }
        
        
    }
    
    // ========================================================================================
    // ============================== IMPORTANT ===============================================
    setGrants($_REQUEST['rol'], $_REQUEST['username'], $_REQUEST['host'], $_REQUEST['es_actiu']);
    // ========================================================================================
   
    mysqli_close($conn);
?>    
    
	<form action="./personal_gestio.php">
    	<input type="submit" value="Tornar al llistat">
    	<input name="uname" value = "" type="hidden" >
	</form>
	
	<form action="../index.php">
		<input type="submit" value="Tornar a l'inici">
	</form>

</body>
</html>