<?php
session_start();
require '../includes/header.php';

$host = "localhost";
$user = "root";
$pass = "mdb";
$db = "restaurantdb";

$conn = new mysqli($host, $user, $pass, $db);
	
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$sql = "SELECT id_categoria, nom FROM categories";
$result = $conn->query($sql);

echo "<select name='categoria'>";
while ($row = $result->fetch_assoc()) {
    echo "<option value='" . $row['id_categoria'] . "'>" . $row['nom'] . "</option>";
}
echo "</select>";

$conn->close();


?>

<html>
<head>
<!-- 	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"  -->
<!-- 			integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous"> -->

<!--       <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->
<!--       <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> -->
<!--       <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->
	
    <link rel="stylesheet" type="text/css" href="../css/estils.css">
    <title>Gestio personal</title>
    
</head>

<body>

	<br><br>
<!-- 	<form action="../gestio_personal.php"> -->
<!--     	<input type="submit" value="Tornar al llistat"> -->
<!--     	<input name="uname" value = "" type="hidden" > -->
<!-- 	</form> -->
	
	<form action="../index.php">
		<input type="submit" value="Tornar a l'inici">
	</form>
	
	</body>

<?php
    require '../includes/footer.php';
?>
</html>
	
