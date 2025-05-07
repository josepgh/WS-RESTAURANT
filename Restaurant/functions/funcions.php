<?php

// ChatGPT: 📌 Gestor d'excepcions global
function manegador_excepcions($ex) {
    echo "<h3>Error global: " . $ex->getMessage() . "</h3>";
    echo "<a href='/Restaurant/index.php'>Tornar a l'inici</a>";
}
set_exception_handler('manegador_excepcions');

//==============================================================================
//funcio que retorna la connexio
//function getRootConnexio($host){
function getRootConnexio(){
    
    $username = "root";
    $password = "mdb";
    $host="localhost";
    $database = "restaurantDB";

    if($conn = mysqli_connect($host, $username, $password, $database)){
        return $conn;
    }else{
        throw new Exception("Connexio fallida a funcions.php->getRootConnexio(" . strval($host) . ")");
        //header("Location: /Restaurant/error.html?error=getUserConnection_connexio_fallida");
        //exit();
        
    }  
}
//===============================================================================
//Retorna la connexió d'un USUARI recollit de la $_SESSION[]
function getUserConnexio($username, $password, $host){
//function getUserConnexio(){
    
//             $username = $_SESSION['username'];
//             //$autheticPWDhash = $_SESSION['autheticPWDhash'];
//             $password = $_SESSION['password'];
//             $host = $_SESSION['host'];
            $database="restaurantdb";
                
            try{
                //$connexio = mysqli_connect($host, $username, $autheticPWDhash, $database);
                $connexio = mysqli_connect($host, $username, $password, $database);
            } catch (Exception $e){
                echo "<pre>";
                
                echo "Missatge: :" . $e->getMessage() . "\n";
                echo "Stack trace : \n" . $e->getTraceAsString();
                
                echo "<pre>";
            }
            
            //     if(!$connexio){
            //         die ("Error de connexio a getUserConnexio: username =  " . $username . " host = " // host . " pwd = " . $autheticPWDhash . " ");
            //
            
            
            //     else{
            //         throw new Exception("Connexio fallida a funcions.php->getUserConnexio(" . strval($host) . ")");
            //         //header("Location: /Restaurant/error.html?error=getUserConnection_connexio_fallida"); //exit();
            //     }
            
            return $connexio;
        
}
    

//==================================================================
// //funcio que retorna la connexio
// function getConnexio(){
    
//     $usuari="root";
//     $password="mdb";
//     $host="localhost";
//     $database="restaurantDB";
    
//     $connexio = mysqli_connect($host, $usuari, $password, $database);
    
    
//     //if($connexio->connect_errno != 0){
// //     if($connexio->connect_errno != 0){
// //             $connexio = NULL;
// //             die("Error al connectar amb la base de dades restaurant. Codi error: "
// //                     . $connexio->connect_errno . ". Error: "
// //                     . $connexio->connect_error);
// //         }
        
//     return $connexio;
// }
        
//======================================================================================
//function creaNouUsuariDB($nom, $rol, $username, $password, $host){    
function creaNouUsuariDB($username, $password, $host){
    
    //$conn = getConnexio();
    $conn = getRootConnexio();
    
    //$query_nou_usuari_db = "CREATE USER '$_REQUEST[username]'@'$_REQUEST[host]' IDENTIFIED VIA ed25519 USING PASSWORD ('$_REQUEST[password]') PASSWORD EXPIRE NEVER";
    $query_nou_usuari_db = "CREATE USER '$username'@'$host' IDENTIFIED BY '$password' PASSWORD EXPIRE NEVER";
    
    // ========================================================================================
    
    mysqli_query($conn, $query_nou_usuari_db) or die("Error en CREATE USER: ". mysqli_error($conn));
    
    $conn->close();
}


//======================================================================================

function obteAuthenticString($username, $host){
    
    $auth_hash = "";
    //$conn = getConnexio();
    $conn = getRootConnexio();
    
    $sql_hash = "SELECT authentication_string FROM mysql.user WHERE user = ? AND host = ?";
    $stmt = $conn->prepare($sql_hash);
    $stmt->bind_param("ss", $username, $host);
    $stmt->execute();
    
    $stmt->bind_result($auth_hash);
    $stmt->fetch();
    $stmt->close();
    
    if ($auth_hash) {
        //echo "<br>Hash MySQL: <code>$auth_hash</code>";
    } 
    else {
        //echo "<br>No s'ha pogut obtenir el hash.";
        die("Error a obteAuthenticString($username, $host). Codi error: "
            . $conn->connect_errno . ". Error: "
            . $conn->connect_error);
    }
    $conn->close();
    return $auth_hash;    
}

//======================================================================================
function calcula_mysql_native_password($password) {
    $stage1 = sha1($password, true);             // binari
    $stage2 = sha1($stage1);                     // hexadecimal
    return '*' . strtoupper($stage2);
}
//======================================================================================

function insertaEnPersonal($nom, $rol, $username, $password, $host, $es_actiu){

    //$conn = getConnexio();
    $conn = getRootConnexio();
    
    $sql_hash = "SELECT authentication_string FROM mysql.user WHERE user = ? AND host = ?";
    $stmt = $conn->prepare($sql_hash);
    $stmt->bind_param("ss", $username, $host);
    $stmt->execute();

    $stmt->bind_result($auth_hash);
    $stmt->fetch();
    $stmt->close();

    if ($auth_hash) {echo "<br>Hash MySQL: <code>$auth_hash</code>";} else {echo "<br>No s'ha pogut obtenir el hash.";}
    $sql = "INSERT INTO personal VALUES(DEFAULT, ?, ?, ?, ?, ?, ?, ?);";
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("ssssssi", $nom, $rol, $username, $password, $auth_hash, $host, $es_actiu);

    $stmt->execute();
    $stmt->close();
    
    $conn->close();
}

// funció que retorna l'string del query dels grants d'un usuari segons categoria,
// i segons si està de baixa (ELS REVOCA) o d'alta (ELS ATORGA)
function setGrants($iid_rol, $uusername, $hhost, $ees_actiu){
    
//$conn = getConnexio();
$conn = getRootConnexio();

if($ees_actiu == 1){
    
    
    if($iid_rol == 'cambrer'){
        
        $query_grants = "GRANT SELECT, INSERT, UPDATE ON restaurantDB.comandes TO '$uusername'@'$hhost'";
        mysqli_query($conn, $query_grants) or die("Error en atorgar GRANTS en la funcio setGrants : ". mysqli_error($conn));
        
        $query_grants = "GRANT SELECT, INSERT, UPDATE ON restaurantDB.reserves TO '$uusername'@'$hhost'";
        mysqli_query($conn, $query_grants) or die("Error en atorgar GRANTS en la funcio setGrants : ". mysqli_error($conn));
        
    }elseif($iid_rol == 'cuiner'){
        
        $query_grants = "GRANT SELECT, INSERT, UPDATE ON restaurantDB.comandes TO '$uusername'@'$hhost'";
        mysqli_query($conn, $query_grants) or die("Error en atorgar GRANTS en la funcio setGrants : ". mysqli_error($conn));
        
    }elseif($iid_rol == 'administrador'){

        $query_grants = "GRANT ALL PRIVILEGES ON restaurantDB.* TO '$uusername'@'$hhost' WITH GRANT OPTION";
        mysqli_query($conn, $query_grants) or die("Error en atorgar GRANTS en la funcio setGrants : ". mysqli_error($conn));
        
    }else{
        
        die("Error en atorgar GRANTS en la funcio setGrants -> CATEGORIA NO RECONEGUDA : ". mysqli_error($conn));
    }
               
}else{
    
    $query_revoke = "REVOKE ALL PRIVILEGES, GRANT OPTION FROM '$uusername'@'$hhost'";
    
    mysqli_query($conn, $query_revoke) or die("Error en REVOCAR GRANTS en la funcio setGrants : ". mysqli_error($conn));
    
}

//         if($ees_actiu == 1){
//             return ($query_grants);
//         }else{
//             return ($query_revoke);
//         }
}

//========================================================================================================== 
    /**
     * @return bool
     */
//     function is_session_started() {
//         if ( php_sapi_name() !== 'cli' ) {
//             //         if ( version_compare(phpversion(), '5.4.0', '>=') ) {
//             return session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE;
//             //         } else {
//             //             return session_id() === '' ? FALSE : TRUE;
//             //         }
//         }
//         return FALSE;
//     }

//=======================================================================================
//================== NO SERVEIS PER A RES, DE MOMENT ====================================
//=======================================================================================
//echo "funcions.php - PROPIETARI SESSIÓ : $username - PWD: $password - HOST: $host<br>";
// retorna l'usuari propietari de la sessió
// function getUsuariActual()
// {
//     if (! isset($_SESSION['username'])) {
//         header("Location: ../error.html?error=funcions_php_cap_usuari_a_la_sessio");
//         exit();
//     }
//     $username = $_SESSION['username'];
//     $password = $_SESSION['password'];
//     $host = $_SESSION['host'];
//     $conn = getUserConnection($host, $username, $password);
//     if (! $conn) {
//         header("Location: ../error.html?error=getUsuariActual_connexio_fallida");
//         exit();
//     }
//     $query = "SELECT * FROM personal WHERE username = '$username';";
//     $usuari = mysqli_query($conn, $query) or die("Problemes amb el select del login: " . $conn->connect_error);
//     mysqli_close($conn);
//     return $usuari;
// }


?>
