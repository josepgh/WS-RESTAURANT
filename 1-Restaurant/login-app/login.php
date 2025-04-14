<!DOCTYPE html>
<html>
<head>
    <title>LOGIN</title>
</head>
<body>

<?php
session_start();

// function manejador_excepciones($excepción) {
//     echo "<h3>Error: " , $excepción->getMessage(), "<h3>";
//     echo "<h3><a href='../index.php'>Anar a l'index</a><h3>\n";    
// }

// set_exception_handler('manejador_excepciones');


require_once("../functions/funcions.php");
//function getConnexio($uusuari, $ppasswordhash, $hhost, $ddatabase){
    
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //$username = trim($_POST['username']);
    $username = $_POST['username'];
    $password = $_POST['password'];
    $host =     $_POST['host'];

    if (empty($username) || empty($password)){
        header("location : /index.php?error=camps_buits");
        exit();
    }

    $_SESSION['username'] = $_POST['username'];
    $_SESSION['password'] = $_POST['password'];
    $_SESSION['host'] =     $_POST['host'];
    
    $query = "SELECT nom, rol, host, password FROM personal WHERE username = '$username'";
    
    echo "login.php - PROPIETARI SESSIÓ : $username - PWD: $password - HOST: $host<br>";
    echo "login.php - QUERY: $query<br>";

    
    
//     $registres = mysqli_query($conn, $query) or die("Problemes amb el select de personal: " . mysqli_error($conn));

    try{
        $conn = getUserConnection($host, $username, $password);
    }
    catch (Throwable $e) {
        throw new Exception("login.php: getUserConnection(Host: $host, Username: $username, Password: $password)");
        //echo "NO CONNECTAT: " ;
        //header("Location : ../error.html?error=password_incorrecte_password_verify");
        exit();
        
    }
//     if(!($conn = getUserConnection($host, $username, $password))){
        
//         echo "NO CONNECTAT: " . $conn->connect_error;
        
//         header("Location: ../error.html");
//         exit();
        
//     }else{
        
//         echo "Connectat a: " . $conn->get_server_info() . "<br>";
//     }
    
    
    $registres = mysqli_query($conn, $query) or die("Problemes amb el select del login: " . $conn->connect_error);
    
    
//     if(!$conn){
        
//         echo "NO CONNECTAT: " . $conn->connect_error;

//         header("Location: ../error.html");
//         exit();
        
//     }else{
        
//         echo "Connectat a: " . $conn->get_server_info() . "<br>";
//     }
    
    echo "Query : $query <br>";
    echo "Files trobades: " . $registres->num_rows . "<br>" ;

   $registres = mysqli_query($conn, $query) 
                or die("Problemes amb el select de personal: " . mysqli_error($conn));
   
   $row = mysqli_fetch_array($registres);
   
   $_SESSION['rol'] = $row['rol'];
   $_SESSION['nom'] = $row['nom'];
   
   if($registres->num_rows > 0){
        
        //echo "Contrassenya de l'usuari $username es 
        //$password traduida: var_dump($hashed_password) <br>";
        echo "Contrassenya de l'usuari $username es $password <br>";
        
        echo "Contrassenya de l'usuari  $_SESSION[username] 
                                        es $_SESSION[password]
                                        i el seu rol es $_SESSION[rol]<br>";

        //================================================================================
        //================================================================================
        if ($password == $row['password']) {
            
            header("Location: welcome.php");
            exit();
            
        } else {

            header("location : ../error.html?error=password_incorrecte_password_verify()");
            exit();
        }
        //================================================================================
        //================================================================================

    } else {
        
//             header("location : ../403.html?error=usuari_no_existeix");
            header("location : ../error.html?error=usuari_no_existeix");
            exit();
    }

    mysqli_close($conn);
    
} else {

    header("Location : ../index.php?error=no_entra_loginphp");
    exit();
}
?>

	<form action="../index.php">
		<input type="submit" value="Tornar a l'inici">
	</form>

</body>
</html>

