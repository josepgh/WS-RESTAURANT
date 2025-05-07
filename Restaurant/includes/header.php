<?php
//session_start();
//if (!($usuari = $_SESSION['username'] ?? '')) $usuari = "";
if (!($username = $_SESSION['username'] ?? '')) $username = "";
if (!($password = $_SESSION['password'] ?? '')) $password = "";
if (!($host = $_SESSION['host'] ?? '')) $host = "";
if (!($nom = $_SESSION['nom'] ?? '')) $nom = "";
if (!($rol = $_SESSION['rol'] ?? '')) $rol = "";


if (!($estat_id = $_SESSION['estat_id'] ?? '')) $estat_id = "";
if (!($estat_opcio = $_SESSION['estat_opcio'] ?? '')) $estat_opcio = "";
if (!($data_reserva = $_SESSION['filtre_data'] ?? '')) $data_reserva = "";
if (!($nom_cat = $_SESSION['nom_cat_opcio'] ?? '')) $nom_cat = "";
if (!($id_cat = $_SESSION['id_cat_opcio'] ?? '')) $id_cat = "";
?>
<html>
	<head>
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Bootstrap JS (per si fas servir desplegables) -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
	</head>

	<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom px-4">

<div style="width: 15%; margin-right: 10px;">
  <a class="navbar-brand d-flex align-items-center" href="/Restaurant/index.php">
    <img src="/Restaurant/img/restaurant_logo.png" alt="Logo" width="100" class="me-2">
    <span>Restaurant</span>
  </a>
  
<!--   <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"> -->
<!--     <span class="navbar-toggler-icon"></span> -->
<!--   </button> -->
</div>

  <div class="collapse navbar-collapse justify-content-between" id="navbarContent" style="width: 50%; margin-right: 10px;">
        <!-- Menú de navegació -->
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
    <?php if ($rol != ''): ?>    
          <li class="nav-item"><a class="nav-link" href="/Restaurant/login-app/welcome.php">Inici</a></li>
	<?php endif; ?>            


	<?php if ($rol === 'administrador'): ?>    
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Administrador</a>
                  <ul class="dropdown-menu">
                        <li>
                        	<!-- <a class="dropdown-item" href="/Restaurant/personal/gestio_personal.php">Gestio de personal</a> -->
                        	<!-- formulari ocult amb uname = "" inicia TOT el llistat de personal -->
                        	<a class="dropdown-item" href="#" onclick="enviarFormGestio()">Gestio de personal</a>
                        	<form id="formGestio" action="/Restaurant/personal/gestio_personal.php" method="post" style="display: none;">
  								<input type="hidden" name="uname" value="">
							</form>
                    	</li>
                        <li>
                        	<a class="dropdown-item" href="/Restaurant/personal/personal_to_insert.php">Afegir persona</a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="/Restaurant/reserves/gestio_reserves.php">Gestió de reserves</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="/Restaurant/plats/gestio_plats.php">Gestió de plats</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="/Restaurant/comandes/gestio_comandes_de_plats.php">Gestió comandes prova</a></li>
                        <li><a class="dropdown-item" href="/Restaurant/comandes/comandes_view.php">Comandes view</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Ja veurem què més</a></li>
                  </ul>
            </li>
	<?php endif; ?>            
 
            
                <!--<li class="nav-item"><a class="nav-link" href="/Restaurant/reserves.php">Reserves</a></li> -->
	<?php if (($rol === 'administrador') || ($rol === 'cambrer')): ?>    
              <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Reserves</a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="/Restaurant/reserves/gestio_reserves.php">Gestio reserves</a></li>
                    <li><a class="dropdown-item" href="/Restaurant/reserves/gestio_reserves_OKOKOK.php">Gestio reserves OKOKOK</a></li>
                  	<li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="/Restaurant/reserves/llistat_2_reserves.php">Llistat 2 reserves</a></li>
                  </ul>
              </li>
	<?php endif; ?>            


	<?php if (($rol === 'administrador') || ($rol === 'cambrer')): ?>    
              <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Comandes</a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="/Restaurant/comandes/gestio_comandes_de_plats.php">Gestio comandes DE PLATS</a></li>
                    <li><a class="dropdown-item" href="/Restaurant/comandes/comandes_view.php">Comandes view</a></li>
                    <li><a class="dropdown-item" href="/Restaurant/comandes/prova_gestio_comandes.php">Prova gestio comandes</a></li>
                  	<li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="/Restaurant/comandes/comandes_chatgpt_1_response1.php">ChatGPT response 1</a></li>
                    <li><a class="dropdown-item" href="/Restaurant/comandes/comandes_chatgpt_2_response1.php">ChatGPT response 2</a></li>
                  </ul>
              </li>
	<?php endif; ?>            


	<?php if (($rol === 'administrador') || ($rol === 'cambrer') || ($rol === 'cuiner')): ?>    
              <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Plats</a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="/Restaurant/plats/gestio_plats.php">Gestio plats</a></li>
                  	<li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="/Restaurant/plats/plats_view.php">Plats view</a></li>
                  </ul>
              </li>
	<?php endif; ?>            
              
                <!--<li class="nav-item"><a class="btn btn-info btn-sm ms-2" href="https://getbootstrap.com/">GET Bootstrap</a></li> -->


	<?php if ($rol === 'administrador'): ?>    
              <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Taules</a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="/Restaurant/taules/taules_list.php">Llistat taules</a></li>
                  </ul>
              </li>
	<?php endif; ?>            
                
	<?php if ($rol === 'administrador'): ?>    
            <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">ALTRES</a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="/Restaurant/A_PROVES/selects.php">prova selects</a></li>
                    <li><a class="dropdown-item" href="/Restaurant/A_PROVES/selects2.php">prova selects 2</a></li>
                    <li><a class="dropdown-item" href="/Restaurant/A_PROVES/prova_productos.php">prova PRODUCTOS</a></li>
                  	<li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                  </ul>
            	</li>
	<?php endif; ?>            
    
    
	<?php if ($rol === 'root'): ?>    
              <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Crea DB</a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="/Restaurant/creaDB/populatedbtables.php">POPULATE TABLES</a></li>
                  	<li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item disabled" href="/Restaurant/CreaDB/populatedbusers.php">Populate DB USERS</a></li>
                  </ul>
              </li>
	<?php endif; ?>            

    
<!-- 	< php if ($rol === 'administrador'): ?>     -->
<!--               <li class="nav-item dropdown"> -->
<!--                   <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Proves LOGIN</a> -->
<!--                   <ul class="dropdown-menu"> -->
                    <!--<li><a class="dropdown-item" href="/Restaurant/login-app/login.php">Anar al LOGIN</a></li> -->
                    <!--<li><a class="dropdown-item" href="/Restaurant/login-app/login.HTML">Anar al LOGIN</a></li> -->
<!--                    <li><a class="dropdown-item" href="/Restaurant/index.php">Anar al LOGIN</a></li> -->
<!--                   	<li><hr class="dropdown-divider"></li> -->
<!--                     <li><a class="dropdown-item disabled" href="/Restaurant/CreaDB/populatedbusers.php">WELCOME</a></li> -->
<!--                   </ul> -->
<!--               </li> -->
<!-- 	< php endif; ?>             -->
    
    
            <!--<li class="nav-"><a class="nav-link disabled" aria-disabled="true">Disabled</a></li>                 -->
                
                
                
        </ul>
	</div>
	
    <!-- Info usuari i filtres -->
    <!-- <div class="text-end me-3 small"> -->
    <div style="width: 27%; margin-right: 10px; font-size: x-small;">
        <!--<div><strong>Usuari:</strong> < php echo $usuari ?></div> -->
      <div><strong>Username:</strong> <?php echo $username ?> - PWD: <?php echo $password ?> - host: <?php echo $host ?></div>
      <div><strong>Nom:</strong> <?php echo $nom ?> - rol: <?php echo $rol ?></div>
      <div><strong>Plat:</strong> (<?php echo $id_cat ?>) Id: (<?php echo $nom_cat ?>)</div>
      <div><strong>Reserva:</strong> (<?php echo $data_reserva ?>) - (<?php echo $estat_id ?>) - (<?php echo $estat_opcio ?>)</div>
    </div>

    <?php if ($rol != ''): ?>    
    	<div style="width: 4%; margin-right: 10px;">
            <!-- Botons INICI i Logout -->
            <form action="/Restaurant/login-app/welcome.php" method="post" class="d-inline me-2">
              <button type="submit" class="btn btn-outline-primary btn-sm">INICI</button>
            </form>
       </div>
	<?php endif; ?>            
   
   <div style="width: 4%; margin-right: 10px;">
        <form action="/Restaurant/logout.php" method="post" class="d-inline">
          <button type="submit" class="btn btn-outline-danger btn-sm">Logout</button>
        </form>
    </div>

</nav>

<script>
  function enviarFormGestio() {
    document.getElementById('formGestio').submit();
  }

//   function enviarFormAfegir() {
// 	    document.getElementById('formAfegir').submit();
//   }
  
</script>

</body>
</html>


