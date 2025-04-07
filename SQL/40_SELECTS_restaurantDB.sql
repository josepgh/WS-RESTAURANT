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

select * from personal_view;

SHOW GRANTS;
SELECT User, Db, Host from mysql.db;
*/

SELECT User, Host, authentication_string FROM mysql.user;

show Grants for cambrer33@localhost;
show Grants for guillem@localhost;
show Grants for cambrer1@localhost;
--show Grants for matre66@localhost;

SELECT 'FI';
--COMMIT;

