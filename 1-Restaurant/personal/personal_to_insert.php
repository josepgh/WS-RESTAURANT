<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/estils.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal form</title>
</head>
<body>


	<h1>Afegir persona</h1>
    <form action="personal_inserted.php" method="post">
        <label for="nom">Nom:</label>
        <input id="nom" type="text" name="nom" required>
        <br><br>

        <label for="email">Email:</label>
        <input id="email" type="email" name="email" required>
        <br><br>

        <label for="r">Selecciona el rol:</label>
        <select id="r" name="rol" required>
            <option value="">-- Selecciona rol --</option>
            <option value="cuiner">Cuiner</option>
            <option value="cambrer">Cambrer</option>
            <option value="administrador">Administrador</option>
        </select>
        <br><br>


        <button type="submit">Afegir persona</button>
    </form>

	<form action="./personal_gestio.php">
    	<input type="submit" value="Tornar al llistat">
    	<input name="mail" value = "" type="hidden" >
	</form>

	<form action="../index.php">
		<input type="submit" value="Tornar a l'inici">
	</form>

</body>
</html>