<?php
  $eemail = $_POST['eemail'] ?? ''; // Recibimos el valor desde formulario1.php
?>



<form action="passaParam3.php" method="post">
  <label for="nombre">Nombre recibido:</label>
  <input id="nombre" type="text" name="eemail" value="<?php echo htmlspecialchars($eemail); ?>">
  <input type="submit" value="Enviar formulario final">
</form>