<?php
  $uusername = $_POST['uusername'] ?? ''; // Recibimos el valor desde formulario1.php
?>



<form action="passaParam3.php" method="post">
  <label for="u">Username recibido:</label>
  <input id="u" type="text" name="uusername" value="<?php echo htmlspecialchars($uusername); ?>">
  <input type="submit" value="Enviar al formulario final">
</form>