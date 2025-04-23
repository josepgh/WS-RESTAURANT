<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    session_destroy(); // Cierra la sesión
    header("Location: tancat.html"); // Redirige a otra página
    exit();
}
?>
