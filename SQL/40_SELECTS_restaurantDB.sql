-- SET GLOBAL general_log=1;
--SET GLOBAL general_log_file='D:\\PRJCTS\\WS-RESTAURANT\\SQL\\crea_burguer.log';--OK
--SET GLOBAL general_log_file='crea_restaurant_al_datadir.log'; --FUNCIONA

SET autocommit=FALSE;
--SELECT CURDATE();
--SELECT CURTIME();

SELECT NOW(), user(), current_user();

USE restaurantDB;
--START TRANSACTION;

SHOW DATABASES;


/*
SELECT * FROM recaptacio_view;

SELECT * FROM comandes;
SELECT * FROM detalls_comanda;
SELECT * FROM comandes_view;



SELECT * FROM reserves_view;


SELECT * FROM factures_view;
--SELECT * FROM factures_total;

*/
SELECT * FROM plats_view;

SELECT * FROM reserves;

SELECT DISTINCT User FROM mysql.user;

SELECT * FROM plats;

SHOW GRANTS;

/*
 SELECT * FROM JSON_TABLE(getColors(), '$[*]'
             COLUMNS(name VARCHAR(30) PATH '$.name', category VARCHAR(30) PATH '$.category')) t;

CALL GenerateNumbers(10);
*/
--select * from  TABLE_PRIVILEGES;
--CALL LlistatPersonal();
--SELECT * FROM INFORMATION_SCHEMA.CATALOGS;

SELECT User, Db, Host from mysql.db;
show Grants for guillem@localhost;
show Grants for cambrer1@localhost;

SELECT * FROM INFORMATION_SCHEMA.TABLE_CONSTRAINTS 
WHERE CONSTRAINT_SCHEMA NOT LIKE 'mysql' AND CONSTRAINT_SCHEMA NOT LIKE 'sys';

SELECT * FROM INFORMATION_SCHEMA.TABLE_CONSTRAINTS
WHERE CONSTRAINT_SCHEMA = 'burguerdb' OR CONSTRAINT_SCHEMA = 'llibres';

SELECT * FROM INFORMATION_SCHEMA.TABLE_PRIVILEGES;
SELECT * FROM personal;

--COMMIT;

