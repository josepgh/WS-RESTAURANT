<?php
session_start();

require ('../includes/header.php');
//require_once ('./creaRestaurantDB.php');
require_once ('./populateDBusers.php');
require_once ('./populateDBtables.php');

// require_once ('../creaDB/populateDBusers.php');
// require_once ('../populate/populateDBusers.php');
// require_once ('../populate/populateDBtables.php');

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
    <!-- 	Bootstrap CSS (des de CDN) -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" 
			integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
	
    <!-- <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/estils.css">
    <title>POPULATE</title>
</head>

<body>
	<br><br>
	<form action="../index.php">
		<input type="submit" value="Tornar a INDEX INICI">
	</form>
</body>
</html>
<?php
    require '../includes/footer.php';
?>

