<?php

//TODO mirar aquests enllaços per entendre la connexió a BD
#https://www.youtube.com/watch?v=IcQdeghJHis&ab_channel=CodePH
#https://www.youtube.com/watch?v=QfSX6-my164&ab_channel=DigitalFox

//class funcions{

// $username="root";
// $password="mdb";
// $host="localhost";
// $database="restaurantDB";

// TODO POSAR COM A VARIABLES??????


function getConnexio(){

    $usuari="root";
    $password="mdb";
    $host="localhost";
    $database="restaurantDB";
    
    $connexio = new mysqli($host, $usuari, $password, $database);
    
    if($connexio->connect_errno != 0){
        
        die("Error al connectar amb la base de dades restaurant ".$connexio->connect_errno);
    }
    
    return $connexio;
}

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
            
            $query_grants = "GRANT SELECT, INSERT, UPDATE ON restaurantDB.reserves TO '$uusername'@'$hhost'";
            mysqli_query($conn, $query_grants) or die("Error en atorgar GRANTS en la funcio setGrants : ". mysqli_error($conn));
            
        }else{
            
            die("Error en atorgar GRANTS en la funcio setGrants -> CATEGORIA NO RECONEGUDA : ". mysqli_error($conn));
        }
        
        //$query_grants = "GRANT SELECT, INSERT, UPDATE ON restaurantDB.* TO '$_REQUEST[username]'@'$_REQUEST[host]';";
//         if(mysqli_query($conn, $query_grants)){
            
            
//         }else{
            
            
//         }
        
        
    }else{
        
        $query_revoke = "REVOKE ALL PRIVILEGES, GRANT OPTION FROM '$uusername'@'$hhost'";
        
        mysqli_query($conn, $query_revoke) or die("Error en REVOCAR GRANTS en la funcio setGrants : ". mysqli_error($conn));
        
        
//         if(mysqli_query($conn, $query_revoke)){
            
            
//         }else{
            
//             die("Error en REVOCAR GRANTS en la funcio setGrants : ". mysqli_error($conn));
//         }
        
    }

        
        
        
    if($ees_actiu == 1){
        
        return ($query_grants);
        
    }else{
        
        return ($query_revoke);
        
    }
        
        
    }
    
                           
?>