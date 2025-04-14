<?php

session_start();
session_unset();
session_destroy();
header("Location: ../index.html");
exit();

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $username = trim($_POST['username']);
//     $password = $_POST['password'];
//     $host = $_POST['host'];

//     echo "logout.php - PROPIETARI SESSIÓ : $username - PWD: $password - HOST: $host<br>";
//     $segons = 5;
//     sleep($segons);
    
// } else {
//     $segons = 5;
//     sleep($segons);
    
//     echo "logout.php - SORTIDA DIRECTA - SENSE PROPIETARI SESSIÓ : $username - PWD: $password <br>";
//     header("Location: ../index.html");
//     exit();
// }



?>
