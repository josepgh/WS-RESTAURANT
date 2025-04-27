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
    if (isset($_POST['estat_valor'])) {
        $_SESSION['estat_valor'] = $_POST['estat_valor'];
    }
    if (isset($_POST['estat_opcio'])) {
        $_SESSION['filtro_estat'] = $_POST['estat_opcio'];
    }
    //     echo "Categoría guardada en sesión.";
    
    if (isset($_POST['data_reserva'])) {
        $_SESSION['filtro_data'] = $_POST['data_reserva'];
    }
    
}
// Recuperar categoria seleccionada
//$id_cat_opcio = $_SESSION['id_cat_opcio'] ?? '';
// Recuperar categoria seleccionada (antic)
//$nom_cat_opcio = $_SESSION['nom_cat_opcio'] ?? '';
// $estat_opcio = $_SESSION['estat_opcio'] ?? '';
$filtro_estat = $_SESSION['filtro_estat'] ?? '';

// Recuperar categoria seleccionada (antic)
$estat_valor = $_SESSION['estat_valor'] ?? '';

$filtro_data = $_SESSION['filtro_data'] ?? '';

// ==================================================================

$conn = getConnexio();

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
    // Escapes special characters in a string for use in an SQL statement,
    // taking into account the current charset of the connection
    // https://www.php.net/manual/es/mysqli.real-escape-string.php
    // INSERTAR
//     if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'afegir') {

//         $nom =  $conn->real_escape_string($_POST['nom']);
//         //$id_plat = intval($_POST['id_plat']);
//         $descripcio = htmlspecialchars($_POST['descripcio'], ENT_QUOTES);
//         $preu = doubleval($_POST['preu']);
//         $id_categoria = intval($_POST['id_categoria']);
        
//         //$descripcio = $conn->real_escape_string($_POST['descripcio']);
//         //$conn = getConnexio();
//         $stmt = $conn->prepare("insert into plats(nom, descripcio, preu, id_categoria) values(?, ?, ?, ?)");
//         $stmt->bind_param("ssdi", $nom, $descripcio, $preu, $id_categoria);
    
//         echo $stmt->execute() ? "✔️ Plat afegit!" : "❌ Error: " . $conn->error;
//         $stmt->close();
//         exit;
//     }
    // EDITAR
    //if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'editar') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'reservar') {     
        $id_plat = intval($_POST['id_plat']);
        $nom =  $conn->real_escape_string($_POST['nom']);
        $descripcio = htmlspecialchars($_POST['descripcio'], ENT_QUOTES);
        $preu = doubleval($_POST['preu']);
        
        $stmt = $conn->prepare("UPDATE plats SET descripcio=?, preu=? WHERE id_plat=?");
        //== sdi string-double(float)-integer ===============
        $stmt->bind_param("sdi",$descripcio, $preu, $id_plat);
        echo $stmt->execute() ? "✔️ Plat actualitzat!" : "❌ Error: " . $conn->error;
        $stmt->close();
        exit;
    }

    
    // ELIMINAR: NO===>ELS PLATS NO S'ELIMINEN PQ LES COMANDES (HISTÒRIC) EN DEPENEN
//     if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'eliminar') {
//         $id = (int)$_POST['id'];
//         $sql = "DELETE FROM persones WHERE id=$id";
//         echo $conn->query($sql) ? "✔️ Persona eliminada!" : "❌ Error: " . $conn->error;
//         exit;
//     }    
    //**(1.2)=============================================================================
    exit; // ✋ Finalitza l'script per no carregar cap HTML
}

// Si no és AJAX, continua i carrega el HTML (incloent header si vols)
require('../includes/header.php');
//====================================================================================

$conn->close();
?>
<!-- <html lang="ca"> -->
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

<!-- div style= width: 50  display: flex; align-items: center -->
    <!-- Filtres -->
<!--     <div class="col-md-8"> -->
    		<!-- button class btn btn-primary mb-3" onclick "obreAfegir()">Reservar Taula</button -->
<!--     </div> -->
<!--         <div class="col-md-8"> -->
<!--         	<label for="ca">Selecciona una categoria</label> -->
<!--             <select id="ca" name="categoria" onchange="guardarCatEnSessio(this)"> -->
<!--                 <option value="">-- Selecciona categoria --</option> -->
<!--                 < php -->
<!--                     $conn = getConnexio(); -->
<!--                     $stmt = $conn->prepare("SELECT id_categoria, nom FROM categories ORDER BY id_categoria"); -->
<!--                     $stmt->execute(); -->
<!--                     $categs = $stmt->get_result(); -->
                    
<!--                    while ($cat_row = $categs->fetch_assoc()) { -->
<!--                             echo "<option value='" . $cat_row['id_categoria'] . "' " -->
<!--                                                     . ($cat_row['id_categoria'] == $id_cat_opcio ? 'selected' : '') -->
<!--                                                     . ">" . $cat_row['nom'] . "</option>"; -->
<!--                     } -->
<!--                     $stmt->close(); -->
<!--                     $conn->close(); -->
<!--                     //mysqli_close($conn); -->
<!--                 ?> -->
<!--             </select> -->
            <!--<h4>Categoria seleccionada: < = htmlspecialchars($nom_cat_opcio ?: 'Ninguna') ></h4> -->
            <!--<h4>id_cat_opcio == < = $id_cat_opcio  ></h4> -->
<!--         </div> -->
<!-- </div> -->

<div style="width: 50%; display: flex; align-items: center;">
    <!-- Filtres -->
    <div class="col-md-8">

        <label for="filtro_data" class="form-label">Selecciona data</label>
            <input 
                type="date" 
                id="filtro_data" 
                class="form-control" 
                name="filtro_data"
                onchange="guardarDataEnSessio(this)"
                min="<?= date('Y-m-d') ?>" 
                value="<?= htmlspecialchars($filtro_data) ?>"
            >
      </div>
      <!--             <select id="ca" name="categoria" onchange="guardarCatEnSessio(this)"> -->
        <div class="col-md-8">
            <label for="filtro_estat" class="form-label">Estat de la reserva</label>
            <select id="filtro_estat" name="filtro_estat" class="form-select" onchange="guardarEstatEnSessio(this)">
                <!--<option value="">-- Tots --</option> -->
                <option value="totes" <?= $filtro_estat == 'totes' ? 'selected' : '' ?>>Totes</option>
                <option value="lliure" <?= $filtro_estat == 'lliure' ? 'selected' : '' ?>>Lliure</option>
                <option value="ocupada" <?= $filtro_estat == 'ocupada' ? 'selected' : '' ?>>Ocupada</option>
            </select>
        </div>
</div>

<!--              <table class="table table-bordered table-striped mt-4">'; -->

    <table class="table table-bordered table-striped">
        <thead>
            <tr> 	
            		<th>ID</th><th>Estat</th><th>Taula</th><th>Client</th>
                    <th>Data</th><th>Hora</th><th>Persones</th><th>Reservar</th>
					<!-- th style= width: 150p >Reservar</th --> 
            </tr>
        </thead>
    <tbody id="taulaReserves">
        
        <?php 
//         if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ajax'])) {
//             $data = $_POST['filtro_data'] ?? '';
//             $estat = $_POST['filtro_estat'] ?? '';         
//             guardaFiltrosEnSession($data, $estat);

            $conn = getConnexio();
            
            $sql = "SELECT id_reserva, estat_reserva, id_taula, nom_client, data_reserva, hora_reserva, num_persones
                FROM reserves WHERE 1=1";
            
            if (!empty($filtro_data)) {
                $data = $conn->real_escape_string($filtro_data);
                $sql .= " AND data_reserva = '$data'";
            }
            
            if ((!empty($filtro_estat)) AND ($filtro_estat == "lliure" OR $filtro_estat == "ocupada")) {
                $estat = $conn->real_escape_string($filtro_estat);
                $sql .= " AND estat_reserva = '$estat'";
            }
            
            $result = $conn->query($sql);
            
            if ($result && $result->num_rows > 0) {
//                 echo '<table class="table table-bordered table-striped mt-4">';
//                 echo '<thead><tr><th>ID</th><th>Estat</th><th>Taula</th><th>Client</th>
//                     <th>Data</th><th>Hora</th><th>Persones</th></tr></thead><tbody>';
                while ($r = $result->fetch_assoc()) {
                    echo "<tr>
                    <td>{$r['id_reserva']}</td>
                    <td>{$r['estat_reserva']}</td>
                    <td>{$r['id_taula']}</td>
                    <td>{$r['nom_client']}</td>
                    <td>{$r['data_reserva']}</td>
                    <td>{$r['hora_reserva']}</td>
                    <td>{$r['num_persones']}</td>

                    <td class='text-end'>
                   
                    <button class='btn btn-sm btn-warning' onclick='obreReservar({$r['id_reserva']},
                                                                                \"{$r['estat_reserva']}\",
                                                                                \"{$r['id_taula']}\",
                                                                                \"{$r['nom_client']}\",
                                                                                \"{$r['data_reserva']}\",
                                                                                \"{$r['hora_reserva']}\",
                                                                                \"{$r['num_persones']}\")'>Reservar</button>

                    </td>
                  </tr>";
                }
                echo '</tbody></table>';
            } else {
                echo '<div class="alert alert-warning mt-4">No hi ha resultats.</div>';
            }
            
            
            
            $conn->close();
        
            
        ?>
    </tbody>
	</table>


<!-- <div class="modal fade" id="modalReservar" tabindex="-1" aria-labelledby="novaReservaModalLabel" aria-hidden="true"> -->
<!--   <div class="modal-dialog"> -->
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
          <input type="text" class="form-control" name="nom_client" id="edit_nom_client" required>
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

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
// const modalEditar = new bootstrap.Modal(document.getElementById('modalEditar'));
// const modalEliminar = new bootstrap.Modal(document.getElementById('modalEliminar'));
// const modalAfegir = new bootstrap.Modal(document.getElementById('modalAfegir'));

const modalReservar = new bootstrap.Modal(document.getElementById('modalReservar'));

function mostrarMissatgeModal(text) {
	  $('#cosModalMissatge').html(text);
	  const modal = new bootstrap.Modal(document.getElementById('modalMissatge'));
	  modal.show();
	}

function refrescaTaula() {
    $("#taulaReserves").load(location.href + " #taulaReserves>*", "");
}

//function obreEditar(id_plat, id_categoria, categoria, nom, descripcio, preu) {
function obreReservar(id_reserva, id_taula, estat_reserva, nom_client, data_reserva, hora_reserva) {
    $('#edit_id_reserva').val(id_reserva);
    $('#edit_id_taula').val(id_taula);
    $('#edit_estat_reserva').val(estat_reserva); //AAAAAAAAAAAAAAAAAAAAAAAAAArrrrrrrrrrrrrrrGGGGGGGGGG
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



function guardarDataEnSessio(filtro_data) {
    
    const data_reserva = filtro_data.value;
//    const estat_opcio = filtro_estat.options[filtro_estat.selectedIndex].text;

//	const data_reserva = 
	
    const dades = new URLSearchParams();
    dades.append('data_reserva', data_reserva);

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

function guardarEstatEnSessio(filtro_estat) {
    
    const estat_valor = filtro_estat.value;
    const estat_opcio = filtro_estat.options[filtro_estat.selectedIndex].text;

//	const data_reserva = 
	
    const dades = new URLSearchParams();
    dades.append('estat_valor', estat_valor);
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


//function guardarEstatEnSessio(estat) {

////const categ_valor = categoria.value;
//const estat_opcio = filtro_estat.options[filtro_estat.selectedIndex].text;

//const dades = new URLSearchParams();
////dades.append('categ_valor', categ_valor);
//dades.append('estat_opcio', estat_opcio);

//fetch('', {
//  method: 'POST',
//  headers: {
//      'Content-Type': 'application/x-www-form-urlencoded'
//  },
//	//body: 'id_categoria_selecc=' + encodeURIComponent(categ_valor)
//  body: dades.toString()
//})
//.then(response => response.text())
//.then(data => {
//	//document.getElementById("resultat").innerHTML = data; // es veu extrany unes dècimes de segon
//   location.reload(); // mostrar resultados filtrados
//   //refrescaTaula();
//})
//.catch(error => {
//  console.error("Error:", error);
//});
//}


</script>

</body>
</html>
