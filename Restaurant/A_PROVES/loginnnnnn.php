<?php
// preguntat a ChatGPT:
// como hago un login en una aplicacion mariadb, php y html sin objetos y manteniendo
// una sesion? sólo usando funciones por ejemplo para conectarse a la base de datos 
// explicame, por favor, mas detalladamente la parte 4: login.php (verifica usuario y crea sesión)

// Inicia la sesión o continúa una existente
session_start();

// Incluye el archivo que contiene la función de conexión a la base de datos
require_once 'db.php';

// Verifica que el formulario se haya enviado con el método POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Se capturan los datos del formulario (nombre de usuario y contraseña)
    $username = trim($_POST['username']); // Elimina espacios al inicio y al final
    $password = $_POST['password']; // Contraseña tal como la escribió el usuario

    // Conexión a la base de datos usando la función definida en db.php
    $conn = conectar();

    // Consulta SQL para buscar un usuario por su nombre
    $query = "SELECT * FROM usuarios WHERE username = ?";

    // Prepara la consulta (evita inyecciones SQL)
    $stmt = mysqli_prepare($conn, $query);

    // Asocia el parámetro (el nombre de usuario) a la consulta
    mysqli_stmt_bind_param($stmt, "s", $username); // "s" indica que es un string

    // Ejecuta la consulta preparada
    mysqli_stmt_execute($stmt);

    // Obtiene el resultado de la consulta
    $result = mysqli_stmt_get_result($stmt);

    // Verifica si encontró algún usuario con ese nombre
    if ($row = mysqli_fetch_assoc($result)) {

        // Verifica que la contraseña ingresada coincida con el hash almacenado
        if (password_verify($password, $row['password'])) {

            // Si la contraseña es correcta, se guarda el nombre en la sesión
            $_SESSION['username'] = $row['username'];

            // Redirige a la página protegida (welcome.php)
            header("Location: welcome.php");
            exit(); // Finaliza el script para que no siga ejecutando

        } else {
            // Contraseña incorrecta
            echo "Contraseña incorrecta.";
        }

    } else {
        // Usuario no encontrado en la base de datos
        echo "Usuario no encontrado.";
    }

    // Cierra la conexión a la base de datos
    mysqli_close($conn);

} else {
    // Si se intenta acceder directamente (sin usar el formulario), se redirige
    echo "Si se intenta acceder directamente (sin usar el formulario), se redirige a index.html";
    header("Location: ../index.html");
    exit();
}
?>

