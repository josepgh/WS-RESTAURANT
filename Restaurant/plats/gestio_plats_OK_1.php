<?php
session_start();

//Simplement **carrega el header.php només si NO és una petició AJAX:
// if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['ajax'])) {
//     require('../includes/header.php');
// }
// $today = date("j, n, Y");
//===========================

//require("../includes/header.php"); dona problemes amb els modals
require("../functions/funcions.php");

//per evitar warnings
//PHP Warning:  Undefined array key "action"

// ===============================================================
// de gestio_plats.php
// posa el valor i l'opcio del select de categories de plats
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['categ_valor'])) {
        $_SESSION['id_cat_opcio'] = $_POST['categ_valor'];
    }
    if (isset($_POST['categ_opcio'])) {
        $_SESSION['nom_cat_opcio'] = $_POST['categ_opcio'];
    }
    //     echo "Categoría guardada en sesión.";
}
// Recuperar categoria seleccionada
$id_cat_opcio = $_SESSION['id_cat_opcio'] ?? '';
// Recuperar categoria seleccionada (antic)
$nom_cat_opcio = $_SESSION['nom_cat_opcio'] ?? '';
// ==================================================================


///$conn = new mysqli("localhost", "usuari", "contrasenya", "base_de_dades");
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
    // Escapes special characters in a string for use in an SQL statement,
    // taking into account the current charset of the connection
    // https://www.php.net/manual/es/mysqli.real-escape-string.php
    // INSERTAR
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'afegir') {

        $nom =  $conn->real_escape_string($_POST['nom']);
        //$id_plat = intval($_POST['id_plat']);
        $descripcio = htmlspecialchars($_POST['descripcio'], ENT_QUOTES);
        $preu = doubleval($_POST['preu']);
        $id_categoria = intval($_POST['id_categoria']);
        
        //$descripcio = $conn->real_escape_string($_POST['descripcio']);
        //$conn = getConnexio();
        $stmt = $conn->prepare("insert into plats(nom, descripcio, preu, id_categoria) values(?, ?, ?, ?)");
        $stmt->bind_param("ssdi", $nom, $descripcio, $preu, $id_categoria);
    
        echo $stmt->execute() ? "✔️ Plat afegit!" : "❌ Error: " . $conn->error;
        $stmt->close();
        exit;
    }
    
    // EDITAR
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'editar') {
        //     $id_plat =  (int)$_POST['id_plat'];
        //     $nom =  $conn->real_escape_string($_POST['nom']);
        //     $descripcio =  $conn->real_escape_string($_POST['descripcio']);
        //     $preu =  (float)$_POST['preu'];
        //     $id_categoria =  (int)$_POST['id_categoria'];
        
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
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'eliminar') {
        $id = (int)$_POST['id'];
        $sql = "DELETE FROM persones WHERE id=$id";
        echo $conn->query($sql) ? "✔️ Persona eliminada!" : "❌ Error: " . $conn->error;
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
<!-- <html lang="ca"> -->
<html>
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Datepicker Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <!--Option 1: Include in HTML -->
    <!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css"> -->
    <title>Gestió de PLATS</title>
</head>
<body class="p-4">

    <h2 class="mb-4">Gestió de PLATS</h2>




<div style="width: 50%; display: flex; align-items: center;">
    <!-- Filtres -->


    <div class="col-md-8">


    		<button class="btn btn-primary mb-3" onclick="obreAfegir()">Afegir plat/beguda</button>


      </div>



        <div class="col-md-8">
        
        
        	<label for="ca">Selecciona una categoria</label>
            <select id="ca" name="categoria" onchange="guardarCatEnSessio(this)">
                <option value="">-- Selecciona categoria --</option>
                <?php
                    //$conn = getConnexio();
                $conn = getUserConnexio($_SESSION['username'], $_SESSION['password'], $_SESSION['host']);
                    $stmt = $conn->prepare("SELECT id_categoria, nom FROM categories ORDER BY id_categoria");
                    $stmt->execute();
                    $categs = $stmt->get_result();
                    
                   while ($cat_row = $categs->fetch_assoc()) {
                            echo "<option value='" . $cat_row['id_categoria'] . "' "
                                                    . ($cat_row['id_categoria'] == $id_cat_opcio ? 'selected' : '')
                                                    . ">" . $cat_row['nom'] . "</option>";
                    }
                    $stmt->close();
                    $conn->close();
                    //mysqli_close($conn);
                ?>
            </select>
            <!--<h4>Categoria seleccionada: < = htmlspecialchars($nom_cat_opcio ?: 'Ninguna') ></h4> -->
            <!--<h4>id_cat_opcio == < = $id_cat_opcio  ></h4> -->
        
        </div>
</div>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Id plat</th>
                <th>Id categoria</th>
                <th>Categoria</th>
                <th>Nom</th>
                <th>Descripcio</th>
                <th>Preu</th>
                <th style="width: 150px">Accions</th>
            </tr>
        </thead>
    <tbody id="taulaPlats">
        
        <?php
        
        if ($id_cat_opcio !== '') { // si no es buit
            
            //$conn = getConnexio();
            $conn = getUserConnexio($_SESSION['username'], $_SESSION['password'], $_SESSION['host']);
            $stmt = $conn->prepare("SELECT id_plat, id_categoria, categoria, nom, descripcio, preu FROM plats_view WHERE id_categoria = ? ORDER BY categoria, nom");
            $stmt->bind_param("i", $id_cat_opcio);
            $stmt->execute();
            $plats = $stmt->get_result();
            
            while ($plats_row = $plats->fetch_assoc()) {

                echo "<tr>
                    <td>{$plats_row['id_plat']}</td>
                    <td>{$plats_row['id_categoria']}</td>
                    <td>{$plats_row['categoria']}</td>
                    <td>{$plats_row['nom']}</td>
     
                    <td>{$plats_row['descripcio']}</td>
                    
					<td>{$plats_row['preu']}</td>
                    <td class='text-end'>
                    
                        <button class='btn btn-sm btn-warning' onclick='obreEditar({$plats_row['id_plat']},
                                                                                    \"{$plats_row['id_categoria']}\",
                                                                                    \"{$plats_row['categoria']}\",
                                                                                    \"{$plats_row['nom']}\",
                                                                                    \"{$plats_row['descripcio']}\",
                                                                                    \"{$plats_row['preu']}\")'>Editar</button>
                        <button class='btn btn-sm btn-danger disabled' onclick='obreEliminar({$plats_row['id_plat']})'>Eliminar</button>
                    </td>
                </tr>";
            }
            
            $stmt->close();
            $conn->close();

        } elseif ($id_cat_opcio) {
            echo "<table><tr><td colspan='7'>No hi plats d'aquesta categoria.</td></tr></table>";
        } else {
            echo "<table><tr><td colspan='7'><h3>Selecciona una categoria per veure els plats disponibles.</h3></td></tr></table>";
        }
            
        ?>
    </tbody>
	</table>

    <!-- Modal Afegir -->
    <div class="modal fade" id="modalAfegir" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <form class="modal-content" id="formAfegir">
                <input type="hidden" name="action" value="afegir">
                <div class="modal-header">
                    <h5 class="modal-title">Afegir PLAT</h5>
                </div>
                <div class="modal-body">
<!--                     <div class="mb-3"> -->
<!--                         <label class="form-label">Id plat</label> -->
<!--                         <input type="number" name="id_plat" id="edit_id_plat" class="form-control" readonly> -->
<!--                     </div> -->
                    <div class="mb-3">
                        <label class="form-label">Id categoria</label>
                        <input type="number" name="id_categoria" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Categoria</label>
                        <input type="text" name="categoria" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nom</label>
                        <input type="text" name="nom" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Descripcio</label>
                        <input type="text" name="descripcio" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Preu</label>
                        <input type="number" name="preu" class="form-control" required>
                    </div>
<!--                     <div class="mb-3"> -->
<!--                         <label class="form-label">Data de naixement</label> -->
<!--                         <input type="date" name="data_naixement" id="edit_data" class="form-control" required> -->
<!--                     </div> -->
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Afegir</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tancar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Editar -->
    <div class="modal fade" id="modalEditar" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <form class="modal-content" id="formEditar">
                <input type="hidden" name="id" id="edit_id">
                <input type="hidden" name="action" value="editar">
                <div class="modal-header">
                    <h5 class="modal-title">Editar PLAT</h5>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Id plat</label>
                        <input type="number" name="id_plat" id="edit_id_plat" class="form-control" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Id categoria</label>
                        <input type="number" name="id_categoria" id="edit_id_categoria" class="form-control" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Categoria</label>
                        <input type="text" name="categoria" id="edit_categoria" class="form-control" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nom</label>
                        <input type="text" name="nom" id="edit_nom" class="form-control" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Descripcio</label>
                        <input type="text" name="descripcio" id="edit_descripcio" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Preu</label>
                        <input type="number" name="preu" id="edit_preu" class="form-control" required>
                    </div>
                    <!--<div class="mb-3"> -->
                        <!--<label class="form-label">Data de naixement</label> -->
                        <!--<input type="date" name="data_naixement" id="edit_data" class="form-control" required> -->
                    <!--</div> -->
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Desar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel·lar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Eliminar NOOOOOOOOOOOOOO es fa servir -->
    <div class="modal fade" id="modalEliminar" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <form class="modal-content" id="formEliminar">
                <input type="hidden" name="id" id="delete_id">
                <input type="hidden" name="action" value="eliminar">
                <div class="modal-header">
                    <h5 class="modal-title">Eliminar persona</h5>
                </div>
                <div class="modal-body">
                    Segur que vols eliminar aquesta persona?
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel·lar</button>
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
const modalEditar = new bootstrap.Modal(document.getElementById('modalEditar'));
const modalEliminar = new bootstrap.Modal(document.getElementById('modalEliminar'));
const modalAfegir = new bootstrap.Modal(document.getElementById('modalAfegir'));

function mostrarMissatgeModal(text) {
	  $('#cosModalMissatge').html(text);
	  const modal = new bootstrap.Modal(document.getElementById('modalMissatge'));
	  modal.show();
	}

function refrescaTaula() {
    $("#taulaPlats").load(location.href + " #taulaPlats>*", "");
}

function obreEditar(id_plat, id_categoria, categoria, nom, descripcio, preu) {
    $('#edit_id_plat').val(id_plat);
    $('#edit_id_categoria').val(id_categoria);
    $('#edit_categoria').val(categoria); //AAAAAAAAAAAAAAAAAAAAAAAAAArrrrrrrrrrrrrrrGGGGGGGGGG
    $('#edit_nom').val(nom);
    $('#edit_descripcio').val(descripcio);
    $('#edit_preu').val(preu);
    modalEditar.show();
}

$('#formEditar').on('submit', function(e) {
    e.preventDefault();
    $.post('', $(this).serialize(), function(res) {
          mostrarMissatgeModal(res);
        modalEditar.hide();
        refrescaTaula();
        //location.reload();
    });
});


//======================================================================================

//function obreAfegir(id_plat, id_categoria, categoria, nom, descripcio, preu) {
function obreAfegir() {

    modalAfegir.show();
}

$('#formAfegir').on('submit', function(e) {
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

//======================================================================================

function obreEliminar(id) {
    $('#delete_id').val(id);
    modalEliminar.show();
}

$('#formEliminar').on('submit', function(e) {
    e.preventDefault();
    $.post('', $(this).serialize(), function(res) {
        alert(res);
        modalEliminar.hide();
        refrescaTaula();
        //location.reload();
    });
});
<!-- </script> <script> -->
function guardarCatEnSessio(categoria) {
    
    const categ_valor = categoria.value;
    const categ_opcio = categoria.options[categoria.selectedIndex].text;

    const dades = new URLSearchParams();
    dades.append('categ_valor', categ_valor);
    dades.append('categ_opcio', categ_opcio);

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
</html>
