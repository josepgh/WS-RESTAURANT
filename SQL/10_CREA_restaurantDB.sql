-- ESTUDIANT LES SORTIDES I LOGS:
-- https://mariadb.com/kb/es/general-query-log/ 
-- https://mariadb.com/docs/server/ref/es11.4/cli/mariadb/
--SET GLOBAL general_log=1;
--SET GLOBAL general_log_file='D:\\PRJCTS\\WS-RESTAURANT\\SQL\\crea_burguer.log';--OK
--SET GLOBAL general_log_file='crea_restaurant_al_datadir.log'; --FUNCIONA

INSTALL SONAME 'auth_ed25519';

SET autocommit=FALSE; --SELECT CURDATE(); --SELECT CURTIME(); --SELECT NOW();
SELECT NOW(), user(), current_user();

DROP DATABASE IF EXISTS restaurantDB;

START TRANSACTION;
-- -----------------------------------------------------------------------------------
--                                      CREA BASE DADES
-- -----------------------------------------------------------------------------------

CREATE DATABASE IF NOT EXISTS restaurantDB;

USE restaurantDB;

SET SESSION foreign_key_checks=OFF;

-- Crea la tabla (si aún no existe)
CREATE TABLE IF NOT EXISTS productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    categoria_id INT NOT NULL,
    categoria_nombre VARCHAR(100) NOT NULL
);

/* 
CREATE TABLE grants_rol( ELIMINADAAAAAAAAAAAA
id_grant	INTEGER PRIMARY KEY AUTO_INCREMENT
id_rol		VARCHAR(15) UNIQUE CHECK(id_rol IN ('cuiner',...))
grants	VARCHAR(50));
*/

CREATE TABLE personal(
					id_personal	INTEGER PRIMARY KEY AUTO_INCREMENT
					,nom 		VARCHAR(50) NOT NULL
					,rol		VARCHAR(15) NOT NULL CHECK(rol IN ('cuiner', 'cambrer', 'administrador'))				
					,username	VARCHAR(15) NOT NULL
					,password 	VARCHAR(15) NOT NULL
					,pwdhash 	VARCHAR(41) NOT NULL
					,host		VARCHAR(15) NOT NULL
					,es_actiu	BOOLEAN NOT NULL DEFAULT TRUE
					,UNIQUE (username, host)
					);

CREATE TABLE categories(
						id_categoria	INTEGER PRIMARY KEY AUTO_INCREMENT
						,nom			VARCHAR(10) CHECK(nom IN 
										('Entrants', 'Principal', 'Postres', 'Begudes'))
						);

CREATE TABLE plats(
					id_plat			INTEGER PRIMARY KEY AUTO_INCREMENT
					,nom			VARCHAR(30)
					,descripcio		VARCHAR(30)
					,preu 			FLOAT
					,id_categoria	INTEGER
					,FOREIGN KEY (id_categoria) REFERENCES categories(id_categoria)
					);

CREATE TABLE taules(
					id_taula 		INTEGER PRIMARY KEY AUTO_INCREMENT
					,numero			INTEGER
					,capacitat		INTEGER
					);

CREATE TABLE estats_reserva(
						id_estat_reserva	INTEGER PRIMARY KEY AUTO_INCREMENT
						,nom_estat			VARCHAR(10) CHECK(nom_estat IN
						('totes', 'lliure', 'ocupada'))
						);

CREATE TABLE reserves(
					id_reserva 				INTEGER PRIMARY KEY AUTO_INCREMENT
					,estat_reserva			VARCHAR(7) NOT NULL DEFAULT ('lliure')
					,id_taula				INTEGER NOT NULL
--					,nom_client				VARCHAR(30) NOT NULL
					,nom_client				VARCHAR(30)
					,data_reserva			DATE NOT NULL
					,hora_reserva			VARCHAR(2) NOT NULL
					,num_persones			INTEGER
					,FOREIGN KEY (id_taula) REFERENCES taules(id_taula)
					,CHECK(estat_reserva IN ('lliure', 'ocupada')) 
					,CHECK(hora_reserva IN ('13', '15')) 
					);

CREATE TABLE comandes(
					id_comanda 		INTEGER PRIMARY KEY AUTO_INCREMENT
					,id_taula		INTEGER NOT NULL
					,nom_client		VARCHAR(30) NOT NULL
					,data_comanda	DATE NOT NULL
					,hora_comanda	VARCHAR(2) NOT NULL
					,num_persones	INTEGER
					,estat_comanda	VARCHAR(20) NOT NULL DEFAULT ('en espera') 
									CHECK(estat_comanda IN ('en espera', 'en preparacio', 'preparat', 'servit'))
					,FOREIGN KEY (id_taula) REFERENCES taules(id_taula)
					);

CREATE TABLE plats_comanda(
					id_plat_comanda 	INTEGER PRIMARY KEY AUTO_INCREMENT
					,id_comanda			INTEGER NOT NULL
					,id_plat			INTEGER NOT NULL
					,quantitat			INTEGER NOT NULL
					,UNIQUE(id_comanda, id_plat)
					,FOREIGN KEY (id_comanda) REFERENCES comandes(id_comanda)
					,FOREIGN KEY (id_plat) REFERENCES plats(id_plat)
					);

--ALTER TABLE productes_comanda ADD CONSTRAINT FOREIGN KEY (idProducte) REFERENCES productes(idProducte);
--ALTER TABLE productes_comanda ADD CONSTRAINT FOREIGN KEY (idComanda) REFERENCES comandes(idComanda);

--https://mariadb.com/kb/en/server-system-variables/#foreign_key_checks
SET SESSION foreign_key_checks=ON;

CREATE OR REPLACE FUNCTION ed25519_password RETURNS STRING SONAME "auth_ed25519.dll";
-- ---------------------------------------------------------------------------------
--                                      CREA USUARIS
-- ---------------------------------------------------------------------------------
--https://www.geeksforgeeks.org/how-to-create-user-with-grant-privileges-in-mariadb/

DROP USER IF EXISTS administrador1@localhost;
DROP USER IF EXISTS administrador2@localhost;
DROP USER IF EXISTS administrador3@localhost;
DROP USER IF EXISTS administrador4@localhost;
DROP USER IF EXISTS administrador5@localhost;
DROP USER IF EXISTS administrador6@localhost;
DROP USER IF EXISTS administrador7@localhost;
DROP USER IF EXISTS administrador8@localhost;
DROP USER IF EXISTS administrador9@localhost;
DROP USER IF EXISTS administrador10@localhost;

DROP USER IF EXISTS cambrer1@localhost;
DROP USER IF EXISTS cambrer2@localhost;
DROP USER IF EXISTS cambrer3@localhost;
DROP USER IF EXISTS cambrer4@localhost;
DROP USER IF EXISTS cambrer5@localhost;
DROP USER IF EXISTS cambrer6@localhost;
DROP USER IF EXISTS cambrer7@localhost;
DROP USER IF EXISTS cambrer8@localhost;
DROP USER IF EXISTS cambrer9@localhost;
DROP USER IF EXISTS cambrer10@localhost;

DROP USER IF EXISTS cuiner1@localhost;
DROP USER IF EXISTS cuiner2@localhost;
DROP USER IF EXISTS cuiner3@localhost;
DROP USER IF EXISTS cuiner4@localhost;
DROP USER IF EXISTS cuiner5@localhost;
DROP USER IF EXISTS cuiner6@localhost;
DROP USER IF EXISTS cuiner7@localhost;
DROP USER IF EXISTS cuiner8@localhost;
DROP USER IF EXISTS cuiner9@localhost;
DROP USER IF EXISTS cuiner10@localhost;


-- INICIAR LA BASE DE DADES AMB AQUEST USUARIS I ELS SEUS ROLS

CREATE OR REPLACE USER administrador1@localhost IDENTIFIED BY 'administrador1' PASSWORD EXPIRE NEVER;
GRANT ALL PRIVILEGES ON restaurantDB.* TO 'administrador1'@'localhost' WITH GRANT OPTION;

CREATE OR REPLACE USER administrador2@localhost IDENTIFIED BY 'administrador2' PASSWORD EXPIRE NEVER;
GRANT ALL PRIVILEGES ON restaurantDB.* TO 'administrador2'@'localhost' WITH GRANT OPTION;

CREATE OR REPLACE USER administrador3@localhost IDENTIFIED BY 'administrador3' PASSWORD EXPIRE NEVER;
GRANT ALL PRIVILEGES ON restaurantDB.* TO 'administrador3'@'localhost' WITH GRANT OPTION;


CREATE OR REPLACE USER cambrer1@localhost IDENTIFIED BY 'cambrer1' PASSWORD EXPIRE NEVER;
GRANT SELECT, INSERT, UPDATE ON restaurantDB.comandes TO 'cambrer1'@'localhost';
GRANT SELECT, INSERT, UPDATE ON restaurantDB.reserves TO 'cambrer1'@'localhost';

CREATE OR REPLACE USER cambrer2@localhost IDENTIFIED BY 'cambrer2' PASSWORD EXPIRE NEVER;
GRANT SELECT, INSERT, UPDATE ON restaurantDB.comandes TO 'cambrer2'@'localhost';
GRANT SELECT, INSERT, UPDATE ON restaurantDB.reserves TO 'cambrer2'@'localhost';

CREATE OR REPLACE USER cambrer3@localhost IDENTIFIED BY 'cambrer3' PASSWORD EXPIRE NEVER;
GRANT SELECT, INSERT, UPDATE ON restaurantDB.comandes TO 'cambrer3'@'localhost';
GRANT SELECT, INSERT, UPDATE ON restaurantDB.reserves TO 'cambrer3'@'localhost';


CREATE OR REPLACE USER cuiner1@localhost IDENTIFIED BY 'cuiner1' PASSWORD EXPIRE NEVER;
GRANT SELECT, INSERT, UPDATE ON restaurantDB.comandes TO 'cuiner1'@'localhost';

CREATE OR REPLACE USER cuiner2@localhost IDENTIFIED BY 'cuiner2' PASSWORD EXPIRE NEVER;
GRANT SELECT, INSERT, UPDATE ON restaurantDB.comandes TO 'cuiner2'@'localhost';

CREATE OR REPLACE USER cuiner3@localhost IDENTIFIED BY 'cuiner3' PASSWORD EXPIRE NEVER;
GRANT SELECT, INSERT, UPDATE ON restaurantDB.comandes TO 'cuiner3'@'localhost';


/*
CREATE OR REPLACE USER cambrer1@localhost IDENTIFIED VIA ed25519 USING PASSWORD ('cambrer1') PASSWORD EXPIRE NEVER;
GRANT SELECT, INSERT, UPDATE ON restaurantDB.comandes TO 'cambrer1'@'localhost';
GRANT SELECT, INSERT, UPDATE ON restaurantDB.reserves TO 'cambrer1'@'localhost';

CREATE OR REPLACE USER cambrer2@localhost IDENTIFIED VIA ed25519 USING PASSWORD ('cambrer2') PASSWORD EXPIRE NEVER;
GRANT SELECT, INSERT, UPDATE ON restaurantDB.comandes TO 'cambrer2'@'localhost';
GRANT SELECT, INSERT, UPDATE ON restaurantDB.reserves TO 'cambrer2'@'localhost';

CREATE OR REPLACE USER cambrer3@localhost IDENTIFIED VIA ed25519 USING PASSWORD ('cambrer3') PASSWORD EXPIRE NEVER;
GRANT SELECT, INSERT, UPDATE ON restaurantDB.comandes TO 'cambrer3'@'localhost';
GRANT SELECT, INSERT, UPDATE ON restaurantDB.reserves TO 'cambrer3'@'localhost';

CREATE OR REPLACE USER cuiner1@localhost IDENTIFIED VIA ed25519 USING PASSWORD ('cuiner1') PASSWORD EXPIRE NEVER;
GRANT SELECT, INSERT, UPDATE ON restaurantDB.comandes TO 'cuiner1'@'localhost';

CREATE OR REPLACE USER cuiner2@localhost IDENTIFIED VIA ed25519 USING PASSWORD ('cuiner2') PASSWORD EXPIRE NEVER;
GRANT SELECT, INSERT, UPDATE ON restaurantDB.comandes TO 'cuiner2'@'localhost';

CREATE OR REPLACE USER cuiner3@localhost IDENTIFIED VIA ed25519 USING PASSWORD ('cuiner3') PASSWORD EXPIRE NEVER;
GRANT SELECT, INSERT, UPDATE ON restaurantDB.comandes TO 'cuiner3'@'localhost';




--CREATE OR REPLACE USER administrador1@localhost IDENTIFIED BY 'administrador1' PASSWORD EXPIRE NEVER;
CREATE OR REPLACE USER administrador1@localhost IDENTIFIED VIA ed25519 USING PASSWORD ('administrador1');
GRANT ALL PRIVILEGES ON restaurantDB.* TO 'administrador1'@'localhost' WITH GRANT OPTION;

--GRANT SELECT, INSERT, UPDATE ON restaurantDB.personal TO 'administrador1'@'localhost';
--GRANT SELECT, INSERT, UPDATE ON restaurantDB.reserves TO 'administrador1'@'localhost';

--CREATE OR REPLACE USER administrador2@localhost IDENTIFIED BY 'administrador2' PASSWORD EXPIRE NEVER;
CREATE OR REPLACE USER administrador2@localhost IDENTIFIED VIA ed25519 USING PASSWORD ('administrador2');
GRANT ALL PRIVILEGES ON restaurantDB.* TO 'administrador2'@'localhost' WITH GRANT OPTION;
--GRANT SELECT, INSERT, UPDATE ON restaurantDB.personal TO 'administrador2'@'localhost';
--GRANT SELECT, INSERT, UPDATE ON restaurantDB.reserves TO 'administrador2'@'localhost';

--CREATE OR REPLACE USER administrador3@localhost IDENTIFIED BY 'administrador3' PASSWORD EXPIRE NEVER;
CREATE OR REPLACE USER administrador3@localhost IDENTIFIED VIA ed25519 USING PASSWORD ('administrador3');
GRANT ALL PRIVILEGES ON restaurantDB.* TO 'administrador3'@'localhost' WITH GRANT OPTION;

--GRANT SELECT, INSERT, UPDATE ON restaurantDB.personal TO 'administrador3'@'localhost';
--GRANT SELECT, INSERT, UPDATE ON restaurantDB.reserves TO 'administrador3'@'localhost';

-- IMPORTANT: https://stackoverflow.com/questions/36463966/mysql-when-is-flush-privileges-in-mysql-really-needed
FLUSH PRIVILEGES; --?????????????????????????????????????????????????????????????

*/
-- ---------------------------------------------------------------------------------
--                                     PROCEDURES
-- ---------------------------------------------------------------------------------

-- ===================================================================================================================
--CREATE USER 'username'@'host' IDENTIFIED BY 'password' PASSWORD EXPIRE NEVER;
-- ChatGPT ========================================================================================================

DELIMITER //
DROP PROCEDURE IF EXISTS ShowAllUserGrants //
CREATE PROCEDURE ShowAllUserGrants()
BEGIN
    DECLARE done INT DEFAULT FALSE;
    DECLARE user_host VARCHAR(512);
    DECLARE cur CURSOR FOR
        SELECT CONCAT("'", user, "'@'", host, "'") 
					FROM mysql.user 
					WHERE user <> 'mariadb.sys' AND user <> 'root';
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

    OPEN cur;

    read_loop: LOOP
        FETCH cur INTO user_host;
        IF done THEN
            LEAVE read_loop;
        END IF;

        SET @sql = CONCAT('SHOW GRANTS FOR ', user_host);
        PREPARE stmt FROM @sql;
        EXECUTE stmt;
        DEALLOCATE PREPARE stmt;
    END LOOP;

    CLOSE cur;
END
//
DELIMITER ;

-- ===================================================================================================================
-- ==========================================================================================================================
--                                      TRIGGERS
-- ==========================================================================================================================

--SELECT 	User, host, authentication_string 
--FROM 	mysql.user 
--WHERE 	user <> 'mariadb.sys' AND user <> 'root'
--ORDER BY user;
--SET OLD.pwdhash = a_str;
--CREATE PROCEDURE set_grants_on_insert(IN username VARCHAR(15), IN host VARCHAR(15), actiu BOOLEAN)

-- ==========================================================================================================================

DELIMITER //
CREATE OR REPLACE TRIGGER check_capacitat_taula
BEFORE INSERT ON reserves
FOR EACH ROW
BEGIN

DECLARE _id_taula INTEGER UNSIGNED;
DECLARE _capacitat INTEGER;

SELECT id_taula, capacitat INTO _id_taula, _capacitat FROM taules WHERE id_taula = NEW.id_taula;
SET @errorMsg = CONCAT('ERROR: taula ', _id_taula, ' de capacitat ', _capacitat, '. NO HI CABEN ', NEW.num_persones); 

IF NEW.num_persones > _capacitat THEN
	SIGNAL SQLSTATE '40000' SET MESSAGE_TEXT = @errorMsg;
END IF;
END; //
DELIMITER ;

-- ==========================================================================================================================
--                                      VIEWS             https://mariadb.com/kb/en/create-view/
-- ==========================================================================================================================


--CREATE OR REPLACE VIEW personal_view AS
--SELECT		p.id_personal, p.nom, p.rol, p.username, p.password, p.pwdhash, p.host, p.es_actiu, g.id_grant, g.id_rol, g.grants
--FROM 		personal p, grants_rol g
--WHERE 		p.rol = g.id_rol
--ORDER BY	p.username;


CREATE OR REPLACE VIEW plats_view(id_plat, id_categoria, categoria, nom, descripcio, preu) AS
SELECT p.id_plat, c.id_categoria, c.nom, p.nom, p.descripcio, p.preu
FROM plats p, categories c
WHERE p.id_categoria = c.id_categoria
ORDER BY c.nom DESC, p.nom ASC;


CREATE OR REPLACE VIEW reserves_view(id_reserva, estat_reserva, data_reserva, hora_reserva, num_taula, capacitat_taula, persones_reserva, nom_client) AS 
SELECT r.id_reserva, r.estat_reserva, r.data_reserva, r.hora_reserva, t.numero, t.capacitat, r.num_persones, r.nom_client
FROM reserves r, taules t
WHERE r.id_taula = t.id_taula
ORDER BY r.data_reserva, t.numero, r.hora_reserva;


CREATE OR REPLACE VIEW comandes_view(data_comanda, id_comanda, num_taula, capacitat_taula, estat_comanda, categoria_plat, plat, quantitat, preu_plat, EUR) AS
SELECT c.data_comanda, c.id_comanda, t.numero, t.capacitat, c.estat_comanda, cat.nom, p.nom, d.quantitat, p.preu, ROUND((p.preu * d.quantitat), 2)  
FROM comandes c, plats_comanda d, plats p, categories cat, taules t
WHERE 	c.id_comanda = d.id_comanda AND
		d.id_plat = p.id_plat AND
		p.id_categoria = cat.id_categoria AND
		c.id_taula = t.id_taula
ORDER BY c.data_comanda, c.id_comanda;

--https://mariadb.com/kb/en/select-with-rollup/
--https://mariadb.com/kb/en/coalesce/
CREATE OR REPLACE VIEW recaptacio_view(Dia, Recaptacio_euros) AS 
SELECT COALESCE(c.data_comanda, 'TOTAL PERIODE ->'), ROUND( SUM( (d.quantitat * p.preu)), 2) 
FROM plats p, comandes c, plats_comanda d
WHERE d.id_plat = p.id_plat AND
		d.id_comanda = c.id_comanda
GROUP BY c.data_comanda ASC WITH ROLLUP;


CREATE OR REPLACE VIEW factures_view(Data_comanda, Id_comanda, Num_taula, Capacitat_taula, Quantitat_plats, EUR) AS
SELECT c.data_comanda, c.id_comanda, t.numero, t.capacitat, SUM(d.quantitat), ROUND(   SUM(p.preu * d.quantitat) , 2)  
FROM comandes c, plats_comanda d, plats p, taules t
WHERE 	c.id_comanda = d.id_comanda AND
		d.id_plat = p.id_plat AND
		c.id_taula = t.id_taula
GROUP BY c.id_comanda
ORDER BY c.data_comanda, c.id_comanda;


-- ===================== ChatGPT ==========================================================================================
CREATE OR REPLACE VIEW vista_resumen_privilegios_consolidada AS
SELECT 
  base_de_datos,
  grantee,
  SUM(schema_privs) AS schema_privs,
  SUM(table_privs) AS table_privs,
  COUNT(DISTINCT table_name) AS tablas_con_privs,
  SUM(column_privs) AS column_privs,
  COUNT(DISTINCT column_name) AS columnas_con_privs,
  SUM(schema_privs + table_privs + column_privs) AS total_privs
FROM (
  -- Repetimos bloques por cada base de datos
  -- === BLOQUE PARA mi_base ===
  -- Privilegios a nivel de esquema
  SELECT 
    'restaurantdb' AS base_de_datos,
    GRANTEE,
    PRIVILEGE_TYPE,
    1 AS schema_privs,
    0 AS table_privs,
    0 AS column_privs,
    NULL AS table_name,
    NULL AS column_name
  FROM information_schema.schema_privileges WHERE TABLE_SCHEMA = 'restaurantdb'
  UNION ALL
  -- Privilegios a nivel de tabla
  SELECT 
    'restaurantdb', GRANTEE, PRIVILEGE_TYPE,
    0, 1, 0,
    TABLE_NAME, NULL
  FROM information_schema.table_privileges WHERE TABLE_SCHEMA = 'restaurantdb'
  UNION ALL
  -- Privilegios a nivel de columna
  SELECT 
    'restaurantdb', GRANTEE, PRIVILEGE_TYPE,
    0, 0, 1,
    TABLE_NAME, COLUMN_NAME
  FROM information_schema.column_privileges WHERE TABLE_SCHEMA = 'restaurantdb'

  -- === BLOQUE PARA otra_base ===
  UNION ALL
  SELECT 
    'llibresmdb', GRANTEE, PRIVILEGE_TYPE,
    1, 0, 0,
    NULL, NULL
  FROM information_schema.schema_privileges WHERE TABLE_SCHEMA = 'llibresmdb'
  UNION ALL
  SELECT 
    'llibresmdb', GRANTEE, PRIVILEGE_TYPE,
    0, 1, 0,
    TABLE_NAME, NULL
  FROM information_schema.table_privileges WHERE TABLE_SCHEMA = 'llibresmdb'
  UNION ALL
  SELECT 
    'llibresmdb', GRANTEE, PRIVILEGE_TYPE,
    0, 0, 1,
    TABLE_NAME, COLUMN_NAME
  FROM information_schema.column_privileges WHERE TABLE_SCHEMA = 'llibresmdb'

  -- === BLOQUE PARA super_base ===
  UNION ALL
  SELECT 
    'llibres', GRANTEE, PRIVILEGE_TYPE,
    1, 0, 0,
    NULL, NULL
  FROM information_schema.schema_privileges WHERE TABLE_SCHEMA = 'llibres'
  UNION ALL
  SELECT 
    'llibres', GRANTEE, PRIVILEGE_TYPE,
    0, 1, 0,
    TABLE_NAME, NULL
  FROM information_schema.table_privileges WHERE TABLE_SCHEMA = 'llibres'
  UNION ALL
  SELECT 
    'llibres', GRANTEE, PRIVILEGE_TYPE,
    0, 0, 1,
    TABLE_NAME, COLUMN_NAME
  FROM information_schema.column_privileges WHERE TABLE_SCHEMA = 'llibres'

) AS all_privs
GROUP BY 
  base_de_datos, grantee;


-- ========================================================================================================================

SELECT * FROM INFORMATION_SCHEMA.TABLE_CONSTRAINTS 
WHERE CONSTRAINT_SCHEMA NOT LIKE 'mysql' AND CONSTRAINT_SCHEMA NOT LIKE 'sys';

SELECT * FROM INFORMATION_SCHEMA.TABLE_CONSTRAINTS 
WHERE CONSTRAINT_SCHEMA = 'burguerdb' OR CONSTRAINT_SCHEMA = 'llibres';



COMMIT;


--SET GLOBAL general_log=0;

--SELECT constraint_schema, TABLE_NAME, CONSTRAINT_NAME, CHECK_CLAUSE 
--FROM INFORMATION_SCHEMA.CHECK_CONSTRAINTS \G;


--IF NEW.comensals > (SELECT maxComensals FROM taules WHERE idTaula = NEW.idTaula;) THEN
--ELSE
--****************************************************************************************************************
--****************************************************************************************************************
--****************************************************************************************************************
--****************************************************************************************************************

/*
CREATE OR REPLACE VIEW factures_total(Id_comanda, Data_comanda, Num_taula, Capacitat_taula, Quantitat_plats, EUR) AS
SELECT COALESCE(c.id_comanda, c.data_comanda, 'TOTAL PERIODE ->'), c.data_comanda, t.numero, t.capacitat, SUM(d.quantitat), ROUND(   SUM(p.preu * d.quantitat) , 2)  
FROM comandes c, plats_comanda d, plats p, taules t
WHERE 	c.id_comanda = d.id_comanda AND
		d.id_plat = p.id_plat AND
		c.id_taula = t.id_taula
GROUP BY d.id_comanda ASC WITH ROLLUP;
--ORDER BY c.id_comanda, c.data_comanda;
*/

/*
CREATE OR REPLACE VIEW factures_total(Id_comanda, Data_comanda, Num_taula, Capacitat_taula, EUR) AS
SELECT COALESCE(c.id_comanda, 'TOTAL FACTURES ->'), c.data_comanda, t.numero, t.capacitat, ROUND(   SUM(p.preu * d.quantitat) , 2)  
FROM comandes c, plats_comanda d, plats p, taules t
WHERE 	c.id_comanda = d.id_comanda AND
		c.id_taula = t.id_taula AND
		d.id_plat = p.id_plat
GROUP BY c.id_comanda, c.data_comanda ASC WITH ROLLUP;
--ORDER BY c.data_comanda, c.id_comanda; Incorrect usage of CUBE/ROLLUP and ORDER BY


CREATE OR REPLACE VIEW factures_total AS
SELECT COALESCE(d.id_comanda, 'TOTAL FACTURES ->'), ROUND(   SUM(p.preu * d.quantitat) , 2)  
FROM comandes c, plats_comanda d, plats p
WHERE 	c.id_comanda = d.id_comanda AND
		d.id_plat = p.id_plat
GROUP BY d.id_comanda ASC WITH ROLLUP;
*/

/*
CREATE OR REPLACE VIEW factures_total(Id_comanda, Data_comanda, Num_taula, Capacitat_taula, Quantitat_plats, EUR) AS
SELECT COALESCE(c.id_comanda, 'TOTAL FACTURES ->'), c.data_comanda, t.numero, t.capacitat, SUM(d.quantitat), ROUND(   SUM(p.preu * d.quantitat) , 2)  
FROM comandes c, plaats_comanda d, plats p, taules t
WHERE 	c.id_comanda = d.id_comanda AND
		d.id_plat = p.id_plat AND
		c.id_taula = t.id_taula
GROUP BY d.id_comanda ASC WITH ROLLUP;
--ORDER BY c.data_comanda, c.id_comanda;

CREATE OR REPLACE VIEW factures_total(Id_comanda, dia, taula, capacitat, EUR) AS
SELECT COALESCE(d.id_comanda, 'TOTAL FACTURES ->'), c.data_comanda, t.numero, t.capacitat, ROUND(   SUM(p.preu * d.quantitat) , 2)  
FROM 	comandes c, plats_comanda d, plats p, taules t
WHERE 	t.id_taula = c.id_taula AND
		d.id_plat = p.id_plat AND
		d.id_comanda = c.id_comanda
GROUP BY d.id_comanda ASC WITH ROLLUP;
--ORDER BY c.data_comanda, c.id_comanda;
-- c.data_comanda, c.id_comanda, t.numero, t.capacitat,

*/
--****************************************************************************************************************
-- In MariaDB you can use JSON_ARRAYAGG and JSON_OBJECT functions to create a JSON array returned by a function:
--****************************************************************************************************************
/*					
DELIMITER //
 
  -- Emulate table-valued function by returning JSON array
  CREATE FUNCTION getColors()
  RETURNS LONGTEXT
  DETERMINISTIC
  BEGIN
    DECLARE data LONGTEXT;
    SELECT JSON_ARRAYAGG(JSON_OBJECT('name', name, 'category', category))  INTO data 
    FROM
     (
       SELECT 'Red' AS name, 'R' AS category
       UNION ALL
       SELECT 'Blue' AS name, 'B' AS category
       UNION ALL
       SELECT 'Green' AS name, 'G' AS category
    ) data;
    RETURN data;
  END
  //
   DELIMITER ;
-- Now you can invoke this function using JSON_TABLE function as follows:

-- Using JSON_TABLE function to convert JSON array back to rows
--  SELECT * FROM JSON_TABLE(getColors(), '$[*]'
--             COLUMNS(name VARCHAR(30) PATH '$.name', category VARCHAR(30) PATH '$.category')) t;

--****************************************************************************************************************
-- DEMANAT A CHATGPT:
-- i would an example of one mariadb procedure that returns a table and contains a for clause within

*/

/*					
DELIMITER //

CREATE PROCEDURE GenerateNumbers(IN max_value INT)
BEGIN
    DECLARE i INT DEFAULT 1;  -- Initialize counter
    
    -- Create a temporary table to store results
    CREATE TEMPORARY TABLE IF NOT EXISTS TempNumbers (
        num INT
    );

    -- Clear table in case it was already created
    DELETE FROM TempNumbers;

    -- Loop from 1 to max_value and insert into the table
    FOR i IN 1..max_value DO
        INSERT INTO TempNumbers (num) VALUES (i);
    END FOR;

    -- Return the table
    SELECT * FROM TempNumbers;
END //

   DELIMITER ;

*/   
--****************************************************************************************************************

-- i would an example of one mariadb procedure that returns a table and contains a loop over a select clause

/*
DELIMITER //
CREATE OR REPLACE PROCEDURE LlistatPersonal()
BEGIN
    -- Declare variables to store row data
    DECLARE _id_personal INT;
    DECLARE _nom VARCHAR(50);
    DECLARE _rol VARCHAR(15);
    DECLARE _email VARCHAR(40);
	
    DECLARE done INT DEFAULT FALSE;

    -- Declare a cursor for selecting data
    DECLARE cur CURSOR FOR SELECT id_personal, nom, rol, email FROM personal;

    -- Declare a handler for the end of the cursor
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

    -- Create a temporary table to store results
    CREATE TEMPORARY TABLE IF NOT EXISTS tmp_personal(
	
		tmp_id_personal INT;
		tmp_nom VARCHAR(50);
		tmp_rol VARCHAR(15);
		tmp_email VARCHAR(40);
		tmp_host VARCHAR(20);

        id INT,
        name VARCHAR(100)
    );

    -- Open the cursor
    OPEN cur;

    -- Loop through the result set
    read_loop: LOOP
        -- Fetch data into variables
        FETCH cur INTO user_id, user_name;
        
        -- Exit loop when no more rows
        IF done THEN 
            LEAVE read_loop;
        END IF;
		
		SELECT into 
		
        -- Insert the fetched row into the temporary table
        INSERT INTO TempUsers (id, name) VALUES (user_id, user_name);
    END LOOP;

    -- Close the cursor
    CLOSE cur;

    -- Return the table
    SELECT * FROM TempUsers;

    -- Drop the temporary table after use
    DROP TEMPORARY TABLE TempUsers;
END //

DELIMITER ;
*/
/*
--CREATE OR REPLACE USER administrador1@localhost IDENTIFIED BY 'administrador1' PASSWORD EXPIRE NEVER;
CREATE OR REPLACE USER administrador1@localhost IDENTIFIED BY 'administrador1';
GRANT ALL PRIVILEGES ON restaurantDB.* TO 'administrador1'@'localhost' WITH GRANT OPTION;

--GRANT SELECT, INSERT, UPDATE ON restaurantDB.personal TO 'administrador1'@'localhost';
--GRANT SELECT, INSERT, UPDATE ON restaurantDB.reserves TO 'administrador1'@'localhost';

--CREATE OR REPLACE USER administrador2@localhost IDENTIFIED BY 'administrador2' PASSWORD EXPIRE NEVER;
CREATE OR REPLACE USER administrador2@localhost IDENTIFIED BY 'administrador2';
GRANT ALL PRIVILEGES ON restaurantDB.* TO 'administrador2'@'localhost' WITH GRANT OPTION;
--GRANT SELECT, INSERT, UPDATE ON restaurantDB.personal TO 'administrador2'@'localhost';
--GRANT SELECT, INSERT, UPDATE ON restaurantDB.reserves TO 'administrador2'@'localhost';

--CREATE OR REPLACE USER administrador3@localhost IDENTIFIED BY 'administrador3' PASSWORD EXPIRE NEVER;
CREATE OR REPLACE USER administrador3@localhost IDENTIFIED BY 'administrador3';
GRANT ALL PRIVILEGES ON restaurantDB.* TO 'administrador3'@'localhost' WITH GRANT OPTION;

--GRANT SELECT, INSERT, UPDATE ON restaurantDB.personal TO 'administrador3'@'localhost';
--GRANT SELECT, INSERT, UPDATE ON restaurantDB.reserves TO 'administrador3'@'localhost';
*/
/*
-- INICIAR LA BASE DE DADES AMB AQUEST USUARIS I ELS SEUS ROLS
CREATE OR REPLACE USER cambrer1@localhost IDENTIFIED BY 'cambrer1' PASSWORD EXPIRE NEVER;
GRANT SELECT, INSERT, UPDATE ON restaurantDB.comandes TO 'cambrer1'@'localhost';
GRANT SELECT, INSERT, UPDATE ON restaurantDB.reserves TO 'cambrer1'@'localhost';
CREATE OR REPLACE USER cambrer2@localhost IDENTIFIED BY 'cambrer2' PASSWORD EXPIRE NEVER;
GRANT SELECT, INSERT, UPDATE ON restaurantDB.comandes TO 'cambrer2'@'localhost';
GRANT SELECT, INSERT, UPDATE ON restaurantDB.reserves TO 'cambrer2'@'localhost';
CREATE OR REPLACE USER cambrer3@localhost IDENTIFIED BY 'cambrer3' PASSWORD EXPIRE NEVER;
GRANT SELECT, INSERT, UPDATE ON restaurantDB.comandes TO 'cambrer3'@'localhost';
GRANT SELECT, INSERT, UPDATE ON restaurantDB.reserves TO 'cambrer3'@'localhost';

CREATE OR REPLACE USER cuiner1@localhost IDENTIFIED BY 'cuiner1' PASSWORD EXPIRE NEVER;
GRANT SELECT, INSERT, UPDATE ON restaurantDB.comandes TO 'cuiner1'@'localhost';
CREATE OR REPLACE USER cuiner2@localhost IDENTIFIED BY 'cuiner2' PASSWORD EXPIRE NEVER;
GRANT SELECT, INSERT, UPDATE ON restaurantDB.comandes TO 'cuiner2'@'localhost';
CREATE OR REPLACE USER cuiner3@localhost IDENTIFIED BY 'cuiner3' PASSWORD EXPIRE NEVER;
GRANT SELECT, INSERT, UPDATE ON restaurantDB.comandes TO 'cuiner3'@'localhost';

CREATE OR REPLACE USER administrador1@localhost IDENTIFIED BY 'administrador1' PASSWORD EXPIRE NEVER;
GRANT SELECT, INSERT, UPDATE ON restaurantDB.personal TO 'administrador1'@'localhost';
GRANT SELECT, INSERT, UPDATE ON restaurantDB.reserves TO 'administrador1'@'localhost';
CREATE OR REPLACE USER administrador2@localhost IDENTIFIED BY 'administrador2' PASSWORD EXPIRE NEVER;
GRANT SELECT, INSERT, UPDATE ON restaurantDB.personal TO 'administrador2'@'localhost';
GRANT SELECT, INSERT, UPDATE ON restaurantDB.reserves TO 'administrador2'@'localhost';
CREATE OR REPLACE USER administrador3@localhost IDENTIFIED BY 'administrador3' PASSWORD EXPIRE NEVER;
GRANT SELECT, INSERT, UPDATE ON restaurantDB.personal TO 'administrador3'@'localhost';
GRANT SELECT, INSERT, UPDATE ON restaurantDB.reserves TO 'administrador3'@'localhost';
*/


