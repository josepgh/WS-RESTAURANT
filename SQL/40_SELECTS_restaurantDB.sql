-- SET GLOBAL general_log=1;
--SET GLOBAL general_log_file='D:\\PRJCTS\\WS-RESTAURANT\\SQL\\crea_burguer.log';--OK
--SET GLOBAL general_log_file='crea_restaurant_al_datadir.log'; --FUNCIONA

SET autocommit=FALSE;
--SELECT CURDATE();
--SELECT CURTIME();

-- SELECT NOW(), user(), current_user();

USE restaurantDB;
--START TRANSACTION;

--SHOW DATABASES;


/*
SELECT * FROM recaptacio_view;

SELECT * FROM comandes;
SELECT * FROM detalls_comanda;
SELECT * FROM comandes_view;



SELECT * FROM reserves_view;


SELECT * FROM factures_view;
--SELECT * FROM factures_total;


SELECT * FROM plats_view;

SELECT * FROM reserves;

SELECT DISTINCT User FROM mysql.user;

SELECT * FROM plats;


SELECT * FROM INFORMATION_SCHEMA.TABLE_CONSTRAINTS 
WHERE CONSTRAINT_SCHEMA NOT LIKE 'mysql' AND CONSTRAINT_SCHEMA NOT LIKE 'sys';

SELECT * FROM INFORMATION_SCHEMA.TABLE_CONSTRAINTS
WHERE CONSTRAINT_SCHEMA = 'burguerdb' OR CONSTRAINT_SCHEMA = 'llibres';

SELECT * FROM INFORMATION_SCHEMA.TABLE_PRIVILEGES;
SELECT * FROM personal;


select * from grants_rol;

select * from personal;

SHOW GRANTS;
SELECT User, Db, Host from mysql.db;
*/

select * from personal_view;

-- 
SELECT 	User, host, authentication_string 
FROM 	mysql.user 
WHERE 	user <> 'mariadb.sys' AND user <> 'root'
ORDER BY user;

/*
SELECT username, host , COUNT(*)
FROM mysql.user 
WHERE User = 'cuiner1' AND Host = 'localhost'";
*/

CALL ShowAllUserGrants();

/*
SELECT
  (SELECT COUNT(*) FROM information_schema.user_privileges WHERE GRANTEE = "'cuiner3'@'localhost'") AS global_privs,
  (SELECT COUNT(*) FROM information_schema.schema_privileges WHERE GRANTEE = "'cuiner3'@'localhost'") AS schema_privs,
  (SELECT COUNT(*) FROM information_schema.table_privileges WHERE GRANTEE = "'cuiner3'@'localhost'") AS table_privs,
  (SELECT COUNT(*) FROM information_schema.column_privileges WHERE GRANTEE = "'cuiner3'@'localhost'") AS column_privs;



SELECT 
  GRANTEE,
--  PRIVILEGE_TYPE,
--  IS_GRANTABLE,
  COUNT(*)
FROM 
  information_schema.schema_privileges
WHERE 
  GRANTEE = "'cuiner3'@'localhost'"
  AND TABLE_SCHEMA = 'restaurantdb';
*/

SELECT 
  sp.GRANTEE,
  COUNT(DISTINCT sp.PRIVILEGE_TYPE) AS schema_privs,
  COUNT(DISTINCT tp.PRIVILEGE_TYPE) AS table_privs,
  COUNT(DISTINCT sp.PRIVILEGE_TYPE) + COUNT(DISTINCT tp.PRIVILEGE_TYPE) AS total_privs
FROM 
  (SELECT * FROM information_schema.schema_privileges WHERE TABLE_SCHEMA = 'restaurantdb') sp
LEFT JOIN 
  (SELECT * FROM information_schema.table_privileges WHERE TABLE_SCHEMA = 'restaurantdb') tp
ON 
  sp.GRANTEE = tp.GRANTEE
GROUP BY 
  sp.GRANTEE
ORDER BY 
  total_privs DESC;



SELECT 
  grantee,
  SUM(schema_privs) AS schema_privs,
  SUM(table_privs) AS table_privs,
  COUNT(DISTINCT table_name) AS tablas_con_privs,
  SUM(column_privs) AS column_privs,
  COUNT(DISTINCT column_name) AS columnas_con_privs,
  SUM(schema_privs + table_privs + column_privs) AS total_privs
FROM (
  -- Privilegios a nivel de esquema
  SELECT 
    GRANTEE,
    PRIVILEGE_TYPE,
    1 AS schema_privs,
    0 AS table_privs,
    0 AS column_privs,
    NULL AS table_name,
    NULL AS column_name
  FROM 
    information_schema.schema_privileges
  WHERE 
    TABLE_SCHEMA = 'restaurantdb'

  UNION ALL

  -- Privilegios a nivel de tabla
  SELECT 
    GRANTEE,
    PRIVILEGE_TYPE,
    0 AS schema_privs,
    1 AS table_privs,
    0 AS column_privs,
    TABLE_NAME,
    NULL AS column_name
  FROM 
    information_schema.table_privileges
  WHERE 
    TABLE_SCHEMA = 'restaurantdb'

  UNION ALL

  -- Privilegios a nivel de columna
  SELECT 
    GRANTEE,
    PRIVILEGE_TYPE,
    0 AS schema_privs,
    0 AS table_privs,
    1 AS column_privs,
    TABLE_NAME,
    COLUMN_NAME
  FROM 
    information_schema.column_privileges
  WHERE 
    TABLE_SCHEMA = 'restaurantdb'
) AS all_privs
GROUP BY 
  grantee
ORDER BY 
  total_privs DESC;
SELECT 'FI';
--COMMIT;

