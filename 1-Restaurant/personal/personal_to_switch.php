<?php

// Notificar todos los errores de PHP ????
error_reporting(-1);

    require("../functions/funcions.php");
    $conn = getConnexio();

    // obté l'username per canviar l'estat i el host (NECESSARI PER DONAR O REVOCAR ELS GRANTS)
    $query = "select username, host, rol, es_actiu from personal where username = '$_REQUEST[username]'";

    $registres = mysqli_query($conn, $query) or die("Problemes en el select a personal_to_switch.php: " . mysqli_error($conn));
    $row = mysqli_fetch_array($registres);
    
    if ($row['es_actiu'] == 1){ // si esta ACTIU el dona de BAIXA
        
        $query_update = "update personal set es_actiu = 0 where username = '$_REQUEST[username]'";

    }else{ // si esta de BAIXA el dona d'ALTA
        
        $query_update = "update personal set es_actiu = 1 where username = '$_REQUEST[username]'";
                
    }
    
    mysqli_query($conn, $query_update) or die("Problemes en el switch a personal_to_switch.php: " . mysqli_error($conn));

    // torna a fer el select pq dades actualitzades per tal de fer el setGrants correcte
    $registres = mysqli_query($conn, $query) or die("Problemes en el select a personal_to_switch.php: " . mysqli_error($conn));
    $row = mysqli_fetch_array($registres);
    
    
    // =======================================================================
    // ============================== IMPORTANT ==============================
    setGrants($row['rol'], $row['username'], $row['host'], $row['es_actiu']);
    // =======================================================================
    // =======================================================================
    
    //echo "3 l'username: $_REQUEST[username] baixa el dona d'alta <br> i la row_grants_count : $row_grants[count] <br>";
 		    
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

<!-- $query_drop_user = "REVOQUE ALL PRIVILEGES , GRANT OPTION FROM '$_REQUEST[username]'@'$_REQUEST[host]'"; -->

<!-- Consulta a CHATGPT -> como hacer en php que se ejecute codigo de una pagina y volver a la pagina que la ha llamado automaticamente? -->

<!-- Para hacer que una página PHP ejecute código y luego redirija automáticamente de vuelta a la página que la llamó, puedes hacer lo siguiente: -->

<!-- 1. Obtener la URL de la página que llamó (referer) -->
<!-- Puedes usar $_SERVER['HTTP_REFERER'] para saber qué página hizo la solicitud. -->

<!-- 2. Ejecutar el código que necesites. -->
<!-- 3. Redirigir a la página anterior usando header("Location: ..."). -->


<!-- Consideraciones -->
<!-- $_SERVER['HTTP_REFERER'] no siempre está presente (depende del navegador). -->

<!-- Asegúrate de no enviar nada al navegador antes del header(), ni espacios ni HTML. -->

<!-- Si la acción debe ser segura, considera validar de dónde viene la petición (por ejemplo, con un token o session). -->


