
SET autocommit=FALSE;

SELECT NOW(), user(), current_user();

USE restaurantDB;

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

SHOW GRANTS;
SELECT User, Db, Host from mysql.db;
*/

select * from personal_view;

--SELECT User, Host, authentication_string FROM mysql.user WHERE user <> 'mariadb.sys' AND user <> 'root';

SELECT 'FI';
--COMMIT;

