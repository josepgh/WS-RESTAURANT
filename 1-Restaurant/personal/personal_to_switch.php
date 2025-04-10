<!-- <html> -->
<!-- <head> -->
<!--     <link rel="stylesheet" type="text/css" href="../css/estils.css"> -->
<!--     <title>Personal to switch</title> -->
<!-- </head> -->
<!-- <body> -->

<?php
   
    require("../functions/funcions.php");
    $conn = getConnexio();

    // obté l'username per canviar l'estat i el host (NECESSARI PER DONAR O REVOCAR ELS GRANTS)
    $query = "select host, es_actiu from personal where username = '$_REQUEST[username]'";


    $registres = mysqli_query($conn, $query) or die("Problemes amb el select per canviar es_actiu? a la taula personal: " . mysqli_error($conn));
    $row = mysqli_fetch_array($registres);
    
    if ($row['es_actiu'] == 1){ // si esta ACTIU el dona de BAIXA i li REVOCA ELS GRANTS
                                // pero cal mirar primer si te algun GRANT, sinó dona ERROR
        
        $query_update = "update personal set es_actiu = 0 where username = '$_REQUEST[username]'";

        // mira si l'usuari té algun GRANT:
        $query_te_grants = "SELECT COUNT(*) as count FROM mysql.user WHERE User = '$_REQUEST[username]' AND Host = '$row[host]'";
        $reg = mysqli_query($conn, $query_te_grants) or die("Problemes en consultar els GRANTS d'un user a la taula mysql.user: " . mysqli_error($conn));
        $row_grants = mysqli_fetch_array($reg);

        if($row_grants['count'] > 0){ //si te algun GRANT, fa un REVOKE:
            $query_revoke_grants = "REVOKE ALL PRIVILEGES, GRANT OPTION FROM '$_REQUEST[username]'@'$row[host]'";
            mysqli_query($conn, $query_revoke_grants) or die("Error en REVOCAR GRANTS al switch: ". mysqli_error($conn));
        }

    }else{ // si esta de BAIXA el dona d'ALTA i li ATORGA ELS GRANTS
        
        $query_update = "update personal set es_actiu = 1 where username = '$_REQUEST[username]'";

        $query_atorga_grants = "GRANT SELECT, INSERT, UPDATE ON restaurantDB.* TO '$_REQUEST[username]'@'$row[host]';";
        mysqli_query($conn, $query_atorga_grants) or die("Error en TORNAR a atorgar GRANTS al switch: ". mysqli_error($conn));
        
    }

    mysqli_query($conn, $query_update) or die("Problemes al canviar L'ESTAT a personal amb el switch: " . mysqli_error($conn));
    
 		    
 	mysqli_close($conn);
 	
 	
 	
    // ChatGPT ================================================== explicació al final del fitxer
 	if (isset($_SERVER['HTTP_REFERER'])) {
 	    $volver = $_SERVER['HTTP_REFERER'];
 	    header("Location: $volver");
 	    exit();
 	} else {
 	    // Si no hay referer, redirige a una página por defecto
 	    header("Location: index.php");
 	    exit();
 	}
 	// ===========================================================
 	
?>
	
<!-- </body> -->

<!-- </html> -->

<!--     $query_drop_user = "REVOQUE ALL PRIVILEGES , GRANT OPTION FROM '$_REQUEST[username]'@'$_REQUEST[host]'"; -->


<!-- Consulta a CHATGPT -> como hacer en php que se ejecute codigo de una pagina y volver a la pagina que la ha llamado automaticamente? -->

<!-- Para hacer que una página PHP ejecute código y luego redirija automáticamente de vuelta a la página que la llamó, puedes hacer lo siguiente: -->

<!-- 1. Obtener la URL de la página que llamó (referer) -->
<!-- Puedes usar $_SERVER['HTTP_REFERER'] para saber qué página hizo la solicitud. -->

<!-- 2. Ejecutar el código que necesites. -->
<!-- 3. Redirigir a la página anterior usando header("Location: ..."). -->


//  ? php
// // archivo: procesar.php

// // Aquí va el código que deseas ejecutar
// // Por ejemplo:
// echo "Ejecutando algo...";
// // Puede ser insertar datos, enviar un correo, etc.

// // Esperamos un momento si quieres que el código tenga efecto visual
// // sleep(1); // opcional

// // Redirigir a la página que llamó (si existe)
// if (isset($_SERVER['HTTP_REFERER'])) {
//     $volver = $_SERVER['HTTP_REFERER'];
//     header("Location: $volver");
//     exit();
// } else {
//     // Si no hay referer, redirige a una página por defecto
//     header("Location: index.php");
//     exit();
// }
// ? 

<!-- Consideraciones -->
<!-- $_SERVER['HTTP_REFERER'] no siempre está presente (depende del navegador). -->

<!-- Asegúrate de no enviar nada al navegador antes del header(), ni espacios ni HTML. -->

<!-- Si la acción debe ser segura, considera validar de dónde viene la petición (por ejemplo, con un token o session). -->


