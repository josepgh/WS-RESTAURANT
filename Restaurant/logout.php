<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    session_unset();
    session_destroy(); // Tanca la sessió
    //unset($_SESSION['username']);
    //unset($_SESSION['password']);
    //unset($_SESSION['host']);
    //unset($_SESSION['nom']);
    //unset($_SESSION['rol']);
    header("Location: tancat.html"); // Redirecció a pagina tancat.html
    exit();
}
?>
