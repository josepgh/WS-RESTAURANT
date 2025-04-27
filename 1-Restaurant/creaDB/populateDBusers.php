<?php

require_once ('../functions/funcions.php');

$conn = getConnexio();

mysqli_query($conn, "START TRANSACTION") or die("Error en START TRANSACTION : ". mysqli_error($conn));

// ===== administradors ========================================================================================================================================================
//mysqli_query($conn, "") or die("Error en l'insert de personal: ". mysqli_error($conn));
mysqli_query($conn, "CREATE OR REPLACE USER administrador1@localhost IDENTIFIED BY 'administrador1' PASSWORD EXPIRE NEVER;") or die("Error CREATE USER : ". mysqli_error($conn));
mysqli_query($conn, "GRANT ALL PRIVILEGES ON restaurantDB.* TO administrador1@localhost WITH GRANT OPTION") or die("Error en GRANT : ". mysqli_error($conn));
//mysqli_query($conn, "FLUSH PRIVILEGES") or die("Error en FLUSH PRIVILEGES : ". mysqli_error($conn));

mysqli_query($conn, "CREATE OR REPLACE USER administrador2@localhost IDENTIFIED BY 'administrador2' PASSWORD EXPIRE NEVER;") or die("Error CREATE USER : ". mysqli_error($conn));
mysqli_query($conn, "GRANT ALL PRIVILEGES ON restaurantDB.* TO 'administrador2'@'localhost' WITH GRANT OPTION") or die("Error en GRANT : ". mysqli_error($conn));
//mysqli_query($conn, "FLUSH PRIVILEGES") or die("Error en FLUSH PRIVILEGES : ". mysqli_error($conn));

mysqli_query($conn, "CREATE OR REPLACE USER administrador3@localhost IDENTIFIED BY 'administrador3' PASSWORD EXPIRE NEVER;") or die("Error CREATE USER : ". mysqli_error($conn));
mysqli_query($conn, "GRANT ALL PRIVILEGES ON restaurantDB.* TO 'administrador3'@'localhost' WITH GRANT OPTION") or die("Error en GRANT : ". mysqli_error($conn));

// ===== cuiners ========================================================================================================================================================

// mysqli_query($conn, "CREATE OR REPLACE USER cuiner@localhost IDENTIFIED BY 'cuiner' PASSWORD EXPIRE NEVER;") or die("Error CREATE USER : ". mysqli_error($conn));
// mysqli_query($conn, "GRANT ALL PRIVILEGES ON restaurantDB.comandes TO 'cuiner'@'localhost'") or die("Error en GRANT : ". mysqli_error($conn));

mysqli_query($conn, "CREATE OR REPLACE USER cuiner1@localhost IDENTIFIED BY 'cuiner1' PASSWORD EXPIRE NEVER;") or die("Error CREATE USER : ". mysqli_error($conn));
mysqli_query($conn, "GRANT ALL PRIVILEGES ON restaurantDB.comandes TO 'cuiner1'@'localhost'") or die("Error en GRANT : ". mysqli_error($conn));

mysqli_query($conn, "CREATE OR REPLACE USER cuiner2@localhost IDENTIFIED BY 'cuiner2' PASSWORD EXPIRE NEVER;") or die("Error CREATE USER : ". mysqli_error($conn));
mysqli_query($conn, "GRANT ALL PRIVILEGES ON restaurantDB.comandes TO 'cuiner2'@'localhost'") or die("Error en GRANT : ". mysqli_error($conn));

mysqli_query($conn, "CREATE OR REPLACE USER cuiner3@localhost IDENTIFIED BY 'cuiner3' PASSWORD EXPIRE NEVER;") or die("Error CREATE USER : ". mysqli_error($conn));
mysqli_query($conn, "GRANT ALL PRIVILEGES ON restaurantDB.comandes TO 'cuiner3'@'localhost'") or die("Error en GRANT : ". mysqli_error($conn));


// ===== cambrers ========================================================================================================================================================

// mysqli_query($conn, "CREATE OR REPLACE USER cambrer@localhost IDENTIFIED BY 'cambrer' PASSWORD EXPIRE NEVER;") or die("Error CREATE USER : ". mysqli_error($conn));
// mysqli_query($conn, "GRANT ALL PRIVILEGES ON restaurantDB.comandes TO 'cambrer'@'localhost'") or die("Error en GRANT : ". mysqli_error($conn));
// mysqli_query($conn, "GRANT ALL PRIVILEGES ON restaurantDB.reserves TO 'cambrer'@'localhost'") or die("Error en GRANT : ". mysqli_error($conn));

mysqli_query($conn, "CREATE OR REPLACE USER cambrer1@localhost IDENTIFIED BY 'cambrer1' PASSWORD EXPIRE NEVER;") or die("Error CREATE USER : ". mysqli_error($conn));
mysqli_query($conn, "GRANT ALL PRIVILEGES ON restaurantDB.comandes TO 'cambrer1'@'localhost'") or die("Error en GRANT : ". mysqli_error($conn));
mysqli_query($conn, "GRANT ALL PRIVILEGES ON restaurantDB.reserves TO 'cambrer1'@'localhost'") or die("Error en GRANT : ". mysqli_error($conn));

mysqli_query($conn, "CREATE OR REPLACE USER cambrer2@localhost IDENTIFIED BY 'cambrer2' PASSWORD EXPIRE NEVER;") or die("Error CREATE USER : ". mysqli_error($conn));
mysqli_query($conn, "GRANT ALL PRIVILEGES ON restaurantDB.comandes TO 'cambrer2'@'localhost'") or die("Error en GRANT : ". mysqli_error($conn));
mysqli_query($conn, "GRANT ALL PRIVILEGES ON restaurantDB.reserves TO 'cambrer2'@'localhost'") or die("Error en GRANT : ". mysqli_error($conn));

mysqli_query($conn, "CREATE OR REPLACE USER cambrer3@localhost IDENTIFIED BY 'cambrer3' PASSWORD EXPIRE NEVER;") or die("Error CREATE USER : ". mysqli_error($conn));
mysqli_query($conn, "GRANT ALL PRIVILEGES ON restaurantDB.comandes TO 'cambrer3'@'localhost'") or die("Error en GRANT : ". mysqli_error($conn));
mysqli_query($conn, "GRANT ALL PRIVILEGES ON restaurantDB.reserves TO 'cambrer3'@'localhost'") or die("Error en GRANT : ". mysqli_error($conn));



mysqli_query($conn, "COMMIT") or die("Error en COMMIT : ". mysqli_error($conn));
// =====================================================================================================================================================================

// mysqli_query($conn, "GRANT ALL PRIVILEGES ON restaurantDB.* TO 'administrador2'@'localhost' WITH GRANT OPTION") or die("Error en GRANT : ". mysqli_error($conn));
//mysqli_query($conn, "GRANT ALL PRIVILEGES ON restaurantDB.* TO ''@'localhost' WITH GRANT OPTION") or die("Error en GRANT : ". mysqli_error($conn));


$conn->close();

?>


