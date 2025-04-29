<?php
//session_start();


if (!($usuari = $_SESSION['username'] ?? '')){
    $usuari = "";
}


// if (!($filt_estat_reserva = $_SESSION['filtre_estat'] ?? '')){
//     $filt_estat_reserva = "";
// }

if (!($estat_id = $_SESSION['estat_id'] ?? '')){
    $estat_id = "";
}

if (!($estat_opcio = $_SESSION['estat_opcio'] ?? '')){
    $estat_opcio = "";
}

//$filtre_data = $_SESSION['filtre_data'] ?? date('Y-m-d');

if (!($data_reserva = $_SESSION['filtre_data'] ?? '')){
    $data_reserva = "";
}


//antic
if (!($nom_cat = $_SESSION['nom_cat_opcio'] ?? '')){
    $nom_cat="";
}

if (!($id_cat = $_SESSION['id_cat_opcio'] ?? '')){
    $id_cat="";
}

?>

<header style="display: flex; justify-content: space-between; align-items: center; padding: 10px; background-color: LightCyan; border: 1px solid;">
    <!-- Contenedor izquierda: logo + título -->
    <div style="width: 50%; display: flex; align-items: center;">
        <div style="margin-right: 20px;">
            <img src="/1-Restaurant/img/restaurant_logo.png" alt="Logo" width="90">
        </div>
        <div>
            <h2 style="margin: 0;">Restaurant Ouspassatsperaigua</h2>
            <a href='https://getbootstrap.com/' class='btn btn-info' role='button'>GET Bootstrap</a>
        </div>
    </div>


    <!-- Contenedor derecha: botón logout -->  
    
    <div style="width: 40%; margin-right: 20px;">
            Username: <?php echo $usuari?><br>
        	Plat: (<?php echo $id_cat?>) Id: (<?php echo $nom_cat?>)<br>
            Reserva: (<?php echo $data_reserva?>) - (<?php echo $estat_id?>) - (<?php echo $estat_opcio?>)<br>
            <!--Data res: (< php echo $filt_data?>)<br> -->

    </div>
    
    <div style="width: 5%; margin-right: 20px;">
        <form action="/1-Restaurant/index.php" method="post">
            <button type="submit" style="padding: 5px 10px;">INICI</button>
        </form>
    </div>
    
    <div style="width: 5%; margin-right: 20px;">
        <form action="/1-Restaurant/tancar.php" method="post">
            <button type="submit" style="padding: 5px 10px;">Logout</button>
        </form>
    </div>
</header>
