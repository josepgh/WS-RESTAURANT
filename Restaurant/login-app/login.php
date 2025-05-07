<?php
session_start();

require_once("../functions/funcions.php");
//require_once("../includes/header.php");


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $username = (isset($_POST['username'])) ? trim($_POST['username']) : '';
    $password = (isset($_POST['password'])) ? trim($_POST['password']) : '';
    $host = (isset($_POST['host'])) ? trim($_POST['host']) : '';
    //if (empty($username) || empty($password)){... // NO CAL: ELS CAMPS SON REQUERITS

    //=============================================================================
    // si es ROOT permet entrada a la pagina per INICIAR LES TAULES
    if(($username == 'root') && ($password == 'mdb') && ($host == 'localhost')){
        $_SESSION['username'] = $username;
        $_SESSION['nom'] = $username;
        $_SESSION['rol'] = $username;
        $_SESSION['host'] = $host;
        //$_SESSION['password'] = $password;
        //header("Location: welcome_ROOT.php");
        header("Location: welcome.php");
        exit(); 
    }
    //=============================================================================

    //$conn = getRootConnexio($host); 
    $conn = getRootConnexio();
    $query = "SELECT nom, username, rol, host, password, pwdhash FROM personal WHERE username = ? AND host = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ss", $username, $host);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $stmt->close();
    $conn->close();
    
    if ($row = mysqli_fetch_assoc($result)) { // SI EXISTEIX L'USERNAME AL HOST
        
        $autheticPWDhash = obteAuthenticString($username, $host); // OBTÉ authentic string de la BD

        $calculatedNativePWD = calcula_mysql_native_password($password); //calcula mysql_native_password(pwd entrat)
        
        //echo "<br>rowUsername = $row[username] - rowHost = $row[host]";
        //echo "<br>PWD entrat = $password      (calculat = $calculatedNativePWD)";
        //echo "<br>PWD en BD  = $row[password] (obtingut = $row[pwdhash])";
        
        if ($autheticPWDhash == $calculatedNativePWD) { // SI EL PASWORD ES CORRECTE posa variables a la SESSIO
            $_SESSION['username'] = $row['username'];
            $_SESSION['nom'] = $row['nom'];
            $_SESSION['rol'] = $row['rol'];
            $_SESSION['host'] = $row['host'];
            $_SESSION['password'] = $row['password'];
            $_SESSION['calculatedNativePWD'] = $calculatedNativePWD; //del $password
            $_SESSION['autheticPWDhash'] = $autheticPWDhash;
            
            header("Location: welcome.php"); exit();
            
            
//             if($row['rol'] == "administrador"){ header("Location: welcome_ADMIN.php"); exit(); }
//             elseif($row['rol'] == "cambrer"){ header("Location: welcome_CAMBRER.php"); exit(); }
//             elseif($row['rol'] == "cuiner"){ header("Location: welcome_CUINER.php"); exit(); }
//             else{ header("Location: welcome.php"); exit(); } //rol no existent   
        } else {

            //header("Location: welcome_ERROR.php"); exit();
            throw new Exception("Connexio fallida a login.php: CONTRASSENYA ERRONIA = " . strval($password)
                                                                    . " = " . strval($calculatedNativePWD) );
            //echo "<br>Contrasenya incorrecta!!";
            //echo "<br>AuthenticString = $autheticPWDhash";
            //echo "<br><< DIFERENT >>";
            //echo "<br>calcula_mysql_native_password($calculatedNativePWD)";
        }
    } else { // SI NO EXITEIX
        ///echo "login.php -> usuari: $username al host: $host NO EXISTEIX"; 
        ///header("Location: /Restaurant/error.html?lloc=login.php&error=no_existeix_usuari_al_host");
        
        //exit();
        //throw new Exception("Connexio fallida a login.php: NO EXISTEIX USUARI = strval($username)" 
        //                  . $username ." AL HOST = " . $host . " (Errorno: " . $conn->connect_errno) . ")";
        throw new Exception("Connexio fallida a login.php: NO EXISTEIX USUARI = " . strval($username) .
                                                                        " AL HOST = " . strval($host) );
    }
    //$stmt->close();
    //$conn->close();
    
}else{
    header("Location: /Restaurant/index.html");
    exit();
    
}
require_once("../includes/header.php");
?>
<!DOCTYPE html>
<html>
<head> <title>LOGIN</title> </head>
<body>
	<br><br>
	<form action="../index.php">
		<input type="submit" value="Tornar a l'inici">
	</form>
</body>
</html>

