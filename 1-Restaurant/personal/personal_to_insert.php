<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/estils.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal form</title>
</head>
<body>

	<h1>Afegir persona</h1>
    <form action="personal_inserted.php" method="post">
        <label for="n">Nom:</label>
        <input id="n" type="text" name="nom" required>
        <br><br>

<!--         <label for="email">Email:</label> -->
<!--         <input id="email" type="email" name="email" required> -->
<!--         <br><br> -->

        <label for="r">Selecciona el rol:</label>
        <select id="r" name="rol" required>
            <option value="">-- Selecciona rol --</option>
            <option value="cuiner">Cuiner</option>
            <option value="cambrer">Cambrer</option>
            <option value="administrador">Administrador</option>
        </select>
        <br><br>

        <label for="u">Username:</label>
        <input id="u" type="text" name="username" required>
        <br><br>

        <label for="p">Password:</label>
        <input id="p" type="text" name="password" required>
        <br><br>

        <label for="h">Host:</label>
        <input id="h" type="text" name="host" required>
        <br><br>

        <label for="es_act">Estat: (BAIXA)</label>
        <input id="es_act" type="range" name="es_actiu" min="0" max="1" required> (ALTA)
        <br><br>

        <button type="submit">Afegir persona</button>
    </form>

	<form action="./gestio_personal.php">
    	<input type="submit" value="Tornar al llistat">
    	<input name="uname" value = "" type="hidden" >
	</form>

	<form action="../index.php">
		<input type="submit" value="Tornar a l'inici">
	</form>

</body>
</html>