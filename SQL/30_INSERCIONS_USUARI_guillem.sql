SET autocommit=FALSE;


SELECT NOW(), user(), current_user();

START TRANSACTION;

/*
INSERT INTO autors VALUES(13, 'Thomas Mann', USER());
INSERT INTO autors VALUES(18, 'Dylan Thomas', USER());
INSERT INTO llibres(isbn, autorId, titol, descripcio, usuari) VALUES ('11-1979',13 ,'Mort a Venècia' , 'Premi Nòbel', USER());
INSERT INTO llibres(isbn, autorId, titol, descripcio, usuari) VALUES ('13-2022',18 ,'Collected Stories' , 'Escriptor gal·les', USER());
SELECT * FROM autors;
SELECT * FROM llibres;
 */
 
INSERT INTO reserves VALUES(DEFAULT, 4, 'Pulgarsito', '2025-05-15',1, USER());
INSERT INTO reserves VALUES(DEFAULT, 6, 'Humphery', '2025-05-15', 2, USER());

 
COMMIT;

