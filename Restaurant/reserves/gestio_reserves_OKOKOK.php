
<?php
session_start();
//Simplement **carrega el header.php només si NO és una petició AJAX:
// if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['ajax'])) {
//     require('../includes/header.php');
// }
//===========================
//require("../includes/header.php"); dona problemes amb els modals
require("../functions/funcions.php");
//per evitar warnings
//PHP Warning:  Undefined array key "action"

// ===============================================================
// de gestio_plats.php
// posa el valor i l'opcio del select de categories de plats
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['estat_id'])) {
        $_SESSION['estat_id'] = $_POST['estat_id'];
    }
    if (isset($_POST['estat_opcio'])) {
        $_SESSION['estat_opcio'] = $_POST['estat_opcio'];
    }
    if (isset($_POST['data_reserva'])) {
        $_SESSION['filtre_data'] = $_POST['data_reserva'];
    }   
}

$estat_id = $_SESSION['estat_id'] ?? 1;
$estat_opcio = $_SESSION['estat_opcio'] ?? 'totes';

// Explicació ràpida:
// Amb aquest ?? (operador de coalescència de null), si no hi ha cap $_SESSION['filtre_data'],
// posa directament la data d'avui (date('Y-m-d')).
// Així sempre al carregar la pàgina el camp sortirà amb la data d'avui seleccionada si l'usuari no ha triat res abans.

$filtre_data = $_SESSION['filtre_data'] ?? date('Y-m-d');
// ==================================================================

//$conn = getConnexio();
$conn = getUserConnexio($_SESSION['username'], $_SESSION['password'], $_SESSION['host']);
// **(1.1)============================================================================
// els modals van bé, però el navegador respon amb un modal amb el codi del header:
// <header style="display: flex; justify-content: space-between; ......
// Això passa perquè les peticions AJAX que fas amb jQuery ($.post) estan rebent com a
// resposta tot el codi HTML de la pàgina, inclòs el <header>, en comptes només
// del missatge que vols mostrar al alert().
// 🔁 Si és una petició AJAX, només retornem resposta de text (NO HTML):
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: text/plain');
//====================================================================================
    // $conn->real_escape_string($ POST[]);
    // Escapes special characters in a string for use in an SQL statement, taking into account the 
    // current charset of the connection https://www.php.net/manual/es/mysqli.real-escape-string.php
    // RESERVAR

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'reservar') {     

        $idreserva = intval($_POST['id_reserva']);      
        $nom = $conn->real_escape_string($_POST['nom_client']);
        $n_persones = intval($_POST['num_persones']);
        
        if ($nom == ""){
            $update_estat = "lliure";
            $n_persones = 0;
        }else{
            $update_estat = "ocupada";
        }

        $stmt = $conn->prepare("UPDATE reserves SET nom_client=?, estat_reserva=?, num_persones=? WHERE id_reserva=?");
        //== sdi string-double(float)-integer ===============, estat_reserva='ocupada'
        $stmt->bind_param("ssii",$nom, $update_estat, $n_persones, $idreserva);
        echo $stmt->execute() ? "✔️ Reserva actualitzada!" : "❌ Error: " . $conn->error;
        $stmt->close();
        
        exit;
    }
    //**(1.2)=============================================================================
    exit; // ✋ Finalitza l'script per no carregar cap HTML
}
// Si no és AJAX, continua i carrega el HTML (incloent header si vols)
require('../includes/header.php');
//====================================================================================

$conn->close();
?>

<html>
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Datepicker Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" 
    			rel="stylesheet">
    <title>Gestió de RESERVES</title>
</head>
<body class="p-4">
    <h2 class="mb-4">Gestió de RESERVES</h2>


<div class="container" style="max-width: 800px;">
    <div class="row g-3 align-items-end">

        <!-- Data -->
        <div class="col-md-6">
    
            <label for="filtre_data" class="form-label">Selecciona data</label>
       
            <div class="input-group">
                	<button class="btn btn-outline-secondary" type="button" onclick="canviarDia(-1)">◀️</button>
        
                    <input 
                        type="date" 
                        id="filtre_data" 
                        class="form-control" 
                        name="filtre_data"
                        onchange="guardarDataEnSessio(this)"
                        min="<?= date('Y-m-d') ?>" 
                        value="<?= htmlspecialchars($filtre_data) ?>"
                    >
                <button class="btn btn-outline-secondary" type="button" onclick="canviarDia(1)">▶️</button>
          	</div>
    	</div>
    
     <!-- Estat -->
        <div class="col-md-6">
        	<label for="est">Selecciona un estat</label>
            <select id="est" name="filtre_estat" class="form-select" onchange="guardarEstatEnSessio(this)">
                <?php
                    //$conn = getConnexio();
                $conn = getUserConnexio($_SESSION['username'], $_SESSION['password'], $_SESSION['host']);
                    $stmt = $conn->prepare("SELECT id_estat_reserva, nom_estat FROM estats_reserva ORDER BY id_estat_reserva");
                    $stmt->execute();
                    $est = $stmt->get_result();
                    
                    while ($est_row = $est->fetch_assoc()) {
                            echo "<option value='" . $est_row['id_estat_reserva'] . "' "
                                                    . ($est_row['id_estat_reserva'] == $estat_id ? 'selected' : '')
                                                    . ">" . $est_row['nom_estat'] . "</option>";
                    }
                    $stmt->close();
                    $conn->close();
                    //mysqli_close($conn);
                ?>
            </select>
        </div>
	</div>

</div>
<br>
    <!--<table class="table table-bordered table-striped mt-4">'; -->
    <table class="table table-bordered table-striped">
        <thead>
            <tr> 	
            		<th>ID</th><th>Data</th><th>Hora</th><th>Taula</th>
                    <th>Estat</th><th>Client</th><th>Persones</th>  
                   <th>Reservar</th><th>Iniciar Comanda</th><th>Comandes View</th>
            </tr>
        </thead>
    <tbody id="taulaReserves">
        
    <?php 

        //$conn = getConnexio();
        $conn = getUserConnexio($_SESSION['username'], $_SESSION['password'], $_SESSION['host']);
        $sql = "SELECT id_reserva, estat_reserva, id_taula, nom_client, data_reserva, hora_reserva, num_persones
                FROM reserves WHERE 1=1";
        
        if (!empty($filtre_data)) {
            $data = $conn->real_escape_string($filtre_data);
            $sql .= " AND data_reserva = '$data'";
        }
        
        if ((!empty($estat_opcio)) AND ($estat_opcio == "lliure" OR $estat_opcio == "ocupada")) {
            $estat = $conn->real_escape_string($estat_opcio);
            $sql .= " AND estat_reserva = '$estat'";
        }
        
        
        $sql .= " ORDER BY data_reserva, hora_reserva, id_taula";
        
        $result = $conn->query($sql);
        
        if ($result && $result->num_rows > 0) {

            while ($r = $result->fetch_assoc()) {
                echo "<tr>
                <td>{$r['id_reserva']}</td>
                <td>{$r['data_reserva']}</td>
                <td>{$r['hora_reserva']}</td>
                <td>{$r['id_taula']}</td>
                <td>{$r['estat_reserva']}</td>
                <td>{$r['nom_client']}</td>
                <td>{$r['num_persones']}</td>

                <td>

                <button class='btn btn-sm btn-primary' onclick='obreReservar({$r['id_reserva']}, \"{$r['id_taula']}\",
                                                                            \"{$r['estat_reserva']}\",
                                                                            \"{$r['nom_client']}\",
                                                                            \"{$r['data_reserva']}\",
                                                                            \"{$r['hora_reserva']}\",
                                                                            \"{$r['num_persones']}\")'>Reservar/Editar</button>
                </td><td>";

                echo "<form action='../comandes/crear_comanda_from_reserves.php' method='post' style='display:inline;'>";
                echo "<input type='hidden' name='id_taula' value=" . $r['id_taula'] . ">";
                echo "<input type='hidden' name='nom_client' value=" . $r['nom_client'] . ">";
                echo "<button type='submit' class='btn btn-success'>Iniciar COMANDA</button>";
                echo "</form>";
                echo "</td><td>";
                
                echo "<a href='../comandes/comandes_view.php?nom_client=" . $r['nom_client']
                . "' class='btn btn-success' role='button'>Com VIEW</a>";
                echo "</td></tr>";
            }
            echo '</tbody></table>';
        } else {
            echo '<div class="alert alert-warning mt-4">No hi ha resultats.</div>';
        }

        $conn->close();
        
    ?>

    </tbody>
	</table>

    <!-- Modal Reservar -->
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
            <!--<input type="text" class="form-control" name="nom_client" id="edit_nom_client" required> -->
          <input type="text" class="form-control" name="nom_client" id="edit_nom_client">
        </div>
        <div class="mb-3">
          <label for="data_reserva" class="form-label">Data</label>
          <input type="date" class="form-control" name="data_reserva" id="edit_data_reserva" readonly>
        </div>
        <div class="mb-3">
          <label for="hora_reserva" class="form-label">Hora</label>
          <input type="text" class="form-control" name="hora_reserva" id="edit_hora_reserva" readonly>
        </div>
        <div class="mb-3">
          <label for="num_persones" class="form-label">Núm. persones</label>
          <input type="number" class="form-control" name="num_persones" id="edit_num_persones" required min="0">
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

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>

const modalReservar = new bootstrap.Modal(document.getElementById('modalReservar'));

//Funció per avançar o retrocedir dies
function canviarDia(diferencia) {
    const input = document.getElementById('filtre_data');
    const dataActual = new Date(input.value);

    // Sumar o restar el dia
    dataActual.setDate(dataActual.getDate() + diferencia);

    // Format YYYY-MM-DD
    const any = dataActual.getFullYear();
    const mes = ('0' + (dataActual.getMonth() + 1)).slice(-2);
    const dia = ('0' + dataActual.getDate()).slice(-2);
    const dataNova = `${any}-${mes}-${dia}`;

    // Comprovar que no és anterior al min (opcional)
    if (input.min && dataNova < input.min) {
        return;
    }
    input.value = dataNova;
    // Simular el canvi per guardar a sessió
    guardarDataEnSessio(input);
}


function mostrarMissatgeModal(text) {
	  $('#cosModalMissatge').html(text);
	  const modal = new bootstrap.Modal(document.getElementById('modalMissatge'));
	  modal.show();
	}

function refrescaTaula() {
    $("#taulaReserves").load(location.href + " #taulaReserves>*", "");
}

function obreReservar(id_reserva, id_taula, estat_reserva, nom_client, data_reserva, hora_reserva, num_persones) {
    $('#edit_id_reserva').val(id_reserva);
    $('#edit_id_taula').val(id_taula);
    $('#edit_estat_reserva').val(estat_reserva); 
    $('#edit_nom_client').val(nom_client);
    $('#edit_data_reserva').val(data_reserva);
    $('#edit_hora_reserva').val(hora_reserva);
    $('#edit_num_persones').val(num_persones);
    modalReservar.show();
}

//$('#formEditar').on('submit', function(e) {
$('#formReservar').on('submit', function(e) {
    e.preventDefault();
    $.post('', $(this).serialize(), function(res) {
      	mostrarMissatgeModal(res);
        modalReservar.hide();
        
        refrescaTaula();
        //location.reload();
    });
});


function guardarDataEnSessio(filtre_data) {
    const data_reserva = filtre_data.value;
    const dades = new URLSearchParams();

    dades.append('data_reserva', data_reserva);

    fetch('', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: dades.toString()
    })
    .then(response => response.text())
 	.then(data => {

	location.reload(); // mostrar resultats filtrats
     })
    .catch(error => {
        console.error("Error:", error);
    });
}

function guardarEstatEnSessio(filtre_estat) {    

    const estat_id = filtre_estat.value;
    const estat_opcio = filtre_estat.options[filtre_estat.selectedIndex].text;

    const dadess = new URLSearchParams();
    dadess.append('estat_id', estat_id);
    dadess.append('estat_opcio', estat_opcio);

    fetch('', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
		//body: 'id_categoria_selecc=' + encodeURIComponent(categ_valor)
        body: dadess.toString()
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
</html>
