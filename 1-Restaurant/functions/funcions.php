
<?php
//session_start();
// require_once("../functions/funcions.php");
    
// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//     $username = ($_POST['username']);
//     $username = trim($_POST['username']);
//     $password = $_POST['password'];
//     $host = $_POST['host'];
   

//==============================================================================
    //funcio que retorna la connexio
function getConnexio(){
    
    $usuari="root";
    $password="mdb";
    $host="localhost";
    $database="restaurantDB";
    
    $connexio = mysqli_connect($host, $usuari, $password, $database);
        
    //if($connexio->connect_errno != 0){
    if($connexio->connect_errno){
            $connexio = NULL;
            die("Error al connectar amb la base de dades restaurant. Codi error: "
                    . $connexio->connect_errno . ". Error: "
                    . $connexio->connect_error);
        }
        
    return $connexio;
}
    
    
    

//=======================================================================================
//echo "funcions.php - PROPIETARI SESSIÓ : $username - PWD: $password - HOST: $host<br>";
// retorna l'usuari propietari de la sessió
function getUsuariActual() {
    
    if (!isset($_SESSION['username'])) {
        header("Location: ../error.html?error=funcions_php_cap_usuari_a_la_sessio");
        exit();
    }

    $username = $_SESSION['username'];
    $password = $_SESSION['password'];
    $host = $_SESSION['host'];
    
    $conn = getUserConnection($host, $username, $password);
    
    if(!$conn){
        header("Location: ../error.html?error=getUsuariActual_connexio_fallida");
        exit();
    }

    $query = "SELECT * FROM personal WHERE username = '$username';";
   
    $usuari = mysqli_query($conn, $query) 
            or die("Problemes amb el select del login: " . $conn->connect_error);
    
    mysqli_close($conn);
    
return $usuari;        
}
    
//===============================================================================
function getUserConnection($host, $username, $password){
    
    $database="restaurantdb";
       
   if($connexio = mysqli_connect($host, $username, $password, $database)){
       return $connexio;
    }
    else{
        header("Location: ../error.html?error=getUserConnection_connexio_fallida");
        exit();
    }
}

//======================================================================================


// funció que retorna l'string del query dels grants d'un usuari segons categoria,
// i segons si està de baixa (ELS REVOCA) o d'alta (ELS ATORGA)
function setGrants($iid_rol, $uusername, $hhost, $ees_actiu){
    
    $conn = getConnexio();
    
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
    
?>
