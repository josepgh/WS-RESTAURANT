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

--SELECT User, Db, Host from mysql.db;

--select * from personal_view;

-- 
--SELECT 	User, host, authentication_string 
SELECT 	User, host, password, authentication_string, plugin 
FROM 	mysql.user 
WHERE 	user <> 'mariadb.sys' AND user <> 'root'
ORDER BY user;


CALL ShowAllUserGrants();

  
SELECT * FROM vista_resumen_privilegios_consolidada ORDER BY base_de_datos, total_privs DESC;
  
select * from personal_view;

select * from personal;


SELECT 'FI';
--COMMIT;

