

<?php
session_start();
//require ('../includes/header.php');
require("../functions/funcions.php");


// ===============================================================
// $data = $_POST['filtro_data'] ?? '';
// $estat = $_POST['filtro_estat'] ?? '';
// guardaFiltrosEnSession($data, $estat);

// de gestio_plats.php
// posa el valor i l'opcio del select de categories de plats
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['filtro_data'])) {
        $_SESSION['filtro_data'] = $_POST['filtro_data'];
    }
    if (isset($_POST['filtro_estat'])) {
        $_SESSION['filtro_estat'] = $_POST['filtro_estat'];
    }
    //     echo "Categoría guardada en sesión.";
}
// Recuperar categoria seleccionada
$filtro_data = $_SESSION['filtro_data'] ?? '';
// Recuperar categoria seleccionada (antic)
$filtro_estat = $_SESSION['filtro_estat'] ?? '';
// ==================================================================



// Funció per guardar filtres a la sessió
function guardaFiltrosEnSession($data, $estat) {
    $_SESSION['filtro_data'] = $data;
    $_SESSION['filtro_estat'] = $estat;
}

//Simplement **carrega el header.php només si NO és una petició AJAX:
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['ajax'])) {
    
    require('../includes/header.php');
    
    //exit;
}
//===========================
// Connexió mysqli
$conn = new mysqli("localhost", "root", "mdb", "restaurantdb");//========================================================
if ($conn->connect_error) {
    die("Error de connexió: " . $conn->connect_error);
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['ajax'] ?? '') === 'reservar') {
    
    
//     $conn = getConnexio();
    $idreserva = intval($_POST['id_reserva']);
    
    $nom = $conn->real_escape_string($_POST['nom_client']);
    //== sdi string-double(float)-integer ===============
    
    $stmt = $conn->prepare("UPDATE reserves SET nom_client=? WHERE id_reserva=?");
    //== sdi string-double(float)-integer ===============, estat_reserva='ocupada'
    $stmt->bind_param("si",$nom, $idreserva);
    
    echo $stmt->execute() ? "✔️ Reserva actualitzada!" : "❌ Error: " . $conn->error;
    $stmt->close();
//     $conn->close();
    
    exit;
    
}


// Si és petició AJAX
//if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ajax'])) {
    
//     $data = $_POST['filtro_data'] ?? '';
//     $estat = $_POST['filtro_estat'] ?? '';
    
//     guardaFiltrosEnSession($data, $estat);

/*    
//     $conn = getConnexio(); //===================================================================================
    
    $sql = "SELECT id_reserva, estat_reserva, id_taula, nom_client, data_reserva, hora_reserva, num_persones 
                FROM reserves WHERE 1=1";
    
    if (!empty($data)) {
        $data = $conn->real_escape_string($data);
        $sql .= " AND data_reserva = '$data'";
    }
//     if (!empty($estat)) {
//         $estat = $conn->real_escape_string($estat);
//         $sql .= " AND estat_reserva = '$estat'";
//     }

    if ((!empty($estat)) AND ($estat == "lliure" OR $estat == "ocupada")) {
        $estat = $conn->real_escape_string($estat);
        $sql .= " AND estat_reserva = '$estat'";
    }
    // si l'estat no es ni lliure ni ocupat:
    //     if ($estat == 'totes') {
    //         $estat = "";
    //         $sql .= " ";
    //     }
    $result = $conn->query($sql);
    

    if ($result && $result->num_rows > 0) {
        echo '<table class="table table-bordered table-striped mt-4">';
        echo '<thead><tr><th>ID</th><th>Estat</th><th>Taula</th><th>Client</th>
                    <th>Data</th><th>Hora</th><th>Persones</th><th>Reservar</th></tr></thead><tbody>';
        while ($r = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$r['id_reserva']}</td>
                    <td>{$r['estat_reserva']}</td>
                    <td>{$r['id_taula']}</td>
                    <td>{$r['nom_client']}</td>
                    <td>{$r['data_reserva']}</td>
                    <td>{$r['hora_reserva']}</td>
                    <td>{$r['num_persones']}</td>
                    <td>";

                    if ($r['estat_reserva'] == 'lliure'){

                    echo "<button class='btn btn-sm btn-warning' onclick='obreReservar({$r['id_reserva']},
                                                                                \"{$r['estat_reserva']}\",
                                                                                \"{$r['id_taula']}\",
                                                                                \"{$r['nom_client']}\",
                                                                                \"{$r['hora_reserva']}\",
                                                                                \"{$r['num_persones']}\")'>Reservar</button>";
                    }

                  echo"</td></tr>";
                    
        }
        echo '</tbody></table>';
    } else {
        echo '<div class="alert alert-warning mt-4">No hi ha resultats.</div>';
    }
    
//     $conn->close(); //==================================================================================

 */
//     exit;
  
// }


// Valors per defecte des de sessió
// $filtro_data = $_SESSION['filtro_data'] ?? '';
// $filtro_estat = $_SESSION['filtro_estat'] ?? '';
$conn->close();
?>



<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Datepicker Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" 
    		rel="stylesheet">
    <!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css"> -->
    <title>Reserves</title>
</head>
<body class="container py-4">
    <h2 class="mb-4">Llistat de Reserves</h2>

<div style="width: 50%; display: flex; align-items: center;">
    <!-- Filtres -->
    <div class="col-md-8">

        <label for="filtro_data" class="form-label">Selecciona data</label>
            <input 
                type="date" 
                id="filtro_data" 
                class="form-control" 
                name="filtro_data"
                min="<?= date('Y-m-d') ?>" 
                value="<?= htmlspecialchars($filtro_data) ?>"
            >
      </div>
        <div class="col-md-8">
            <label for="filtro_estat" class="form-label">Estat de la reserva</label>
            <select id="filtro_estat" name="filtro_estat" class="form-select" onchange="carregarReserves()">
                <!--<option value="">-- Tots --</option> -->
                <option value="totes" <?= $filtro_estat == 'totes' ? 'selected' : '' ?>>Totes</option>
                <option value="lliure" <?= $filtro_estat == 'lliure' ? 'selected' : '' ?>>Lliure</option>
                <option value="ocupada" <?= $filtro_estat == 'ocupada' ? 'selected' : '' ?>>Ocupada</option>
            </select>
        </div>
</div>

<!--         echo '<table class="table table-bordered table-striped mt-4">'; -->
<!--         echo '<thead><tr><th>ID</th><th>Estat</th><th>Taula</th><th>Client</th> -->
<!--                     <th>Data</th><th>Hora</th><th>Persones</th><th>Reservar</th></tr></thead><tbody>'; -->

	<table>
	
		<thead>
                <tr><th>ID</th><th>Estat</th><th>Taula</th><th>Client</th>
                <th>Data</th><th>Hora</th><th>Persones</th><th>Reservar</th></tr>		
		</thead>
	<tbody id="tReserves">


<?php 


if($filtro_data !=="" and $filtro_estat !==""){


    $conn = getConnexio(); //===================================================================================
    
    $sql = "SELECT id_reserva, estat_reserva, id_taula, nom_client, data_reserva, hora_reserva, num_persones 
                FROM reserves WHERE 1=1";
    
        if (!empty($data)) {
            $data = $conn->real_escape_string($data);
            $sql .= " AND data_reserva = '$data'";
        }
    //     if (!empty($estat)) {
    //         $estat = $conn->real_escape_string($estat);
    //         $sql .= " AND estat_reserva = '$estat'";
    //     }
    
        if ((!empty($estat)) AND ($estat == "lliure" OR $estat == "ocupada")) {
            $estat = $conn->real_escape_string($estat);
            $sql .= " AND estat_reserva = '$estat'";
        }
        // si l'estat no es ni lliure ni ocupat:
        //     if ($estat == 'totes') {
        //         $estat = "";
        //         $sql .= " ";
        //     }
        $result = $conn->query($sql);
    

        if ($result && $result->num_rows > 0) {
    //         echo '<table class="table table-bordered table-striped mt-4">';
    //         echo '<thead><tr><th>ID</th><th>Estat</th><th>Taula</th><th>Client</th>
    //                     <th>Data</th><th>Hora</th><th>Persones</th><th>Reservar</th></tr></thead><tbody>';
            while ($r = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$r['id_reserva']}</td>
                        <td>{$r['estat_reserva']}</td>
                        <td>{$r['id_taula']}</td>
                        <td>{$r['nom_client']}</td>
                        <td>{$r['data_reserva']}</td>
                        <td>{$r['hora_reserva']}</td>
                        <td>{$r['num_persones']}</td>
                        <td>";
    
                        if ($r['estat_reserva'] == 'lliure'){
    
                        echo "<button class='btn btn-sm btn-warning' onclick='obreReservar({$r['id_reserva']},
                                                                                    \"{$r['estat_reserva']}\",
                                                                                    \"{$r['id_taula']}\",
                                                                                    \"{$r['nom_client']}\",
                                                                                    \"{$r['hora_reserva']}\",
                                                                                    \"{$r['num_persones']}\")'>Reservar</button>";
                        }
    
                      echo"</td></tr>";
                        
            }
            
            //echo '</tbody></table>';
        } else {
            echo '<div class="alert alert-warning mt-4">No hi ha resultats.</div>';
        }

    $conn->close(); //==================================================================================
        
}
    
    
//     $conn->close(); //==================================================================================

?>
		</tbody>	
	</table>

<!-- ============================================================================================================== -->
    <!-- Resultats -->
<!--     <div id="resultats" class="mt-4"> -->
<!--         <div class="alert alert-info">Aplica un filtre per veure les reserves.</div> -->
<!--     </div> -->
<!-- ============================================================================================================== -->


<!-- Modal Nova Reserva -->
<!-- <div class="modal fade" id="modalReservar" tabindex="-1" aria-labelledby="novaReservaModalLabel" aria-hidden="true"> -->
<!--   <div class="modal-dialog"> -->

<!--     <div class="modal fade" id="modalAfegir" tabindex="-1"> -->
    <div class="modal fade" id="modalReservar" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">

    <form id="formReservar" class="modal-content">
    	<input type="hidden" name="action" value="reservar">
      <div class="modal-header">
        <h5 class="modal-title" id="novaReservaModalLabel">Reservar</h5>
      </div>

      <div class="modal-body">
        <div class="mb-3">
          <label for="id_reserva" class="form-label">Id reserva</label>
          <input type="number" class="form-control" name="id_reserva" id="edit_id_reserva" readonly>
        </div>
        <div class="mb-3">
          <label for="id_taula" class="form-label">Id taula</label>
          <input type="number" class="form-control" name="id_taula" id="edit_id_taula" readonly>
        </div>
        <div class="mb-3">
          <label for="estat_reserva" class="form-label">Estat reserva</label>
          <input type="text" class="form-control" name="estat_reserva" id="edit_estat_reserva" readonly>
        </div>
        <div class="mb-3">
          <label for="nom_client" class="form-label">Nom client</label>
          <input type="text" class="form-control" name="nom_client" id="edit_nom_client" required>
        </div>
<!--         <div class="mb-3"> -->
<!--           <label for="data_reserva" class="form-label">Data</label> -->
<!--           <input type="date" class="form-control" name="data_reserva" id="edit_data_reserva" readonly> -->
<!--         </div> -->
        <div class="mb-3">
          <label for="hora_reserva" class="form-label">Hora</label>
          <input type="text" class="form-control" name="hora_reserva" id="edit_hora_reserva" readonly>
        </div>
        <div class="mb-3">
          <label for="num_persones" class="form-label">Núm. persones</label>
          <input type="number" class="form-control" name="num_persones" id="edit_num_persones" required min="1">
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success">Guardar reserva</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel·la</button>
      </div>
    </form>
   
  </div>
</div>


    <!-- Modal per a missatges -->
    <div class="modal fade" id="modalMissatge" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center">
          <div class="modal-header">
            <h5 class="modal-title">Resposta</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tancar"></button>
          </div>
          <div class="modal-body" id="cosModalMissatge">
            <!-- Aquí es mostra el missatge -->
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Acceptar</button>
          </div>
        </div>
      </div>
    </div>


<!-- JS -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.ca.min.js"></script>

    <script>

    function refrescaTaulaReserves(){
		$("#taulaReserves").load(location.href + " #taulaReserves>*", "");
    }

    const modalReservar = new bootstrap.Modal(document.getElementById('modalReservar'));


    function mostrarMissatgeModal(text) {//===========================================================
  	  $('#cosModalMissatge').html(text);
  	  const modal = new bootstrap.Modal(document.getElementById('modalMissatge'));
  	  modal.show();
  	}//================================================================================================

    
//    function obreReservar(id_reserva, estat_reserva, id_taula, nom_client, data_reserva, hora_reserva, num_persones) {    
    function obreReservar(id_reserva, estat_reserva, id_taula, nom_client, hora_reserva, num_persones) { //===============
        $('#edit_id_reserva').val(id_reserva);
        $('#edit_estat_reserva').val(estat_reserva);
        $('#edit_id_taula').val(id_taula);
        $('#edit_nom_client').val(nom_client);
        //$('#edit_data_reserva').val(data_reserva);
        $('#edit_hora_reserva').val(hora_reserva);
        $('#edit_num_persones').val(num_persones);
        modalReservar.show();
    }//==================================================================================================================


$('#formReservar').on('submit', function(e) {
    e.preventDefault();
    $.post('', $(this).serialize(), function(res) {

		//alert(res);
		//3. Crida mostrarMissatgeModal(resposta) 
		//en comptes d’alert() al final de l’AJAX:
		//Exemple amb $.post:
        //$.post('aquest_fitxer.php', formData, function(resposta) {
          mostrarMissatgeModal(res);
          //carregarLlista(); // si vols refrescar la llista
        //});			
        modalAfegir.hide();
        refrescaTaula();
        //location.reload();
    });
});


	
// $('#formReservar').on('submit', function (e) { //===================================
//     e.preventDefault();

//     const formData = new FormData(this);
//     formData.append('ajax', 'reservar');

//     fetch('', {
//         method: 'POST',
//         body: formData
//     })
//     .then(res => res.text())
//     .then(html => $('#resultats').html(html))
// // 1    .then(html => $('#tReserves').html(html))
//     .then(missatge => {
//         modalReservar.hide();

//         mostrarMissatgeModal(missatge);
//          refrescaTaulaReserves();
//        //carregarReserves();
//         $('#formReservar')[0].reset();

//     })
    
    
//       .catch(() => $('#resultats').html('<div class="alert alert-danger">Error al carregar les reserves.</div>'));
// //  2    	.catch(() => $('#tReserves').html('<div class="alert alert-danger">Error al carregar les reserves.</div>'));
    

// }); //==================================================================================


    $(document).ready(function () {
        // Inicialitzar datepicker
        $('#datepicker').datepicker({
            format: 'yyyy-mm-dd',
            language: 'ca',
            autoclose: true,
            todayHighlight: true
        });
    }); // ** ===================================================================================================
    

        function carregarReserves() { //=====================================================================
            const data = $('#filtro_data').val();
            const estat = $('#filtro_estat').val();

            const formData = new FormData();
            formData.append('ajax', '1');
            formData.append('filtro_data', data);
            formData.append('filtro_estat', estat);

            fetch('', {
                method: 'POST',
                body: formData
            })
            .then(res => res.text())
            .then(html => $('#resultats').html(html))
            .catch(() => $('#resultats').html('<div class="alert alert-danger">Error al carregar les reserves.</div>'));

//             .then(html => $('#tReserves').html(html))
//             .catch(() => $('#tReserves').html('<div class="alert alert-danger">Error al carregar les reserves.</div>'));

        } //===============================================================================================

        $('#filtro_data').on('change', carregarReserves);
        $('#filtro_estat').on('change', carregarReserves);

        // Carregar si ja hi havia filtres a sessió
        if ($('#filtro_data').val() || $('#filtro_estat').val()) {
            carregarReserves();
        }
// ( ** =================================== estava aqui maaaaaaaaaaaaaaaaaaal?????)    });


function guardarEstatEnSessio(estat) {
    
    //const categ_valor = categoria.value;
    const estat_opcio = filtro_estat.options[filtro_estat.selectedIndex].text;

    const dades = new URLSearchParams();
    //dades.append('categ_valor', categ_valor);
    dades.append('estat_opcio', estat_opcio);

    fetch('', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
		//body: 'id_categoria_selecc=' + encodeURIComponent(categ_valor)
        body: dades.toString()
    })
    .then(response => response.text())
     .then(data => {
		//document.getElementById("resultat").innerHTML = data; // es veu extrany unes dècimes de segon
         location.reload(); // mostrar resultados filtrados
         //refrescaTaula();
     })
    .catch(error => {
        console.error("Error:", error);
    });
}
    </script>
</body>
<?php
    require '../includes/footer.php';
?>
</html>
