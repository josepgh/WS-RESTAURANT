--SET GLOBAL general_log=1;
--SET GLOBAL general_log_file='D:\\PRJCTS\\WS-RESTAURANT\\SQL\\crea_burguer.log';--OK
--SET GLOBAL general_log_file='crea_restaurant_al_datadir.log'; --FUNCIONA

SET autocommit=TRUE;
--SELECT CURDATE();
--SELECT CURTIME();

SELECT NOW(), user(), current_user();

USE restaurantDB;

START TRANSACTION; -- PREVAL sobre el SET autocommit=TRUE del principi

--INSERT INTO grants_rol VALUES(DEFAULT, '', '');
--INSERT INTO grants_rol VALUES(DEFAULT, '', '');
--INSERT INTO grants_rol VALUES(DEFAULT, '', '');
INSERT INTO grants_rol VALUES(DEFAULT, 'cuiner', 'grants cuiner');
INSERT INTO grants_rol VALUES(DEFAULT, 'cambrer', 'grants cambrer');
INSERT INTO grants_rol VALUES(DEFAULT, 'maitre', 'grants maitre');
INSERT INTO grants_rol VALUES(DEFAULT, 'administrador', 'grants administrador');


--('maitre', 'cuiner', 'cambrer', 'administratiu')
--INSERT INTO personal VALUES(DEFAULT, nom, rol, email, username, password, host);

INSERT INTO personal VALUES(DEFAULT, 'Antonia', 'cuiner', 'cuiner1@restaurant.com', 'cuiner1', 'cuiner1', 'localhost');
INSERT INTO personal VALUES(DEFAULT, 'Vanessa', 'cambrer', 'cambrer1@restaurant.com', 'cambrer1', 'cambrer1', 'localhost');
INSERT INTO personal VALUES(DEFAULT, 'Kevin José', 'cuiner', 'cuiner2@restaurant.com', 'cuiner2', 'cuiner2', 'localhost');
INSERT INTO personal VALUES(DEFAULT, 'Carlos Enrique', 'cambrer', 'cambrer2@restaurant.com', 'cambrer2', 'cambrer2', 'localhost');
INSERT INTO personal VALUES(DEFAULT, 'Natàlia', 'maitre', 'maitre1@restaurant.com', 'maitre1', 'maitre1', 'localhost');
INSERT INTO personal VALUES(DEFAULT, 'Carla', 'administrador', 'administrador1@restaurant.com', 'administrador1', 'administrador1', 'localhost');
INSERT INTO personal VALUES(DEFAULT, 'Nicole', 'cambrer', 'cambrer3@restaurant.com', 'cambrer3', 'cambrer3', 'localhost');

--('maitre', 'cuiner', 'cambrer', 'administratiu')
--INSERT INTO personal VALUES(DEFAULT, 'Antonia', 'cuiner', 'cuiner1@email.com');
--INSERT INTO personal VALUES(DEFAULT, 'Vanessa', 'cambrer', 'cambrer1@email.com');
--INSERT INTO personal VALUES(DEFAULT, 'Kevin José', 'cuiner', 'cuiner2@email.com');
--INSERT INTO personal VALUES(DEFAULT, 'Carlos Enrique', 'cambrer', 'cambrer2@email.com');
--INSERT INTO personal VALUES(DEFAULT, 'Natàlia', 'administratiu', 'administrador1@email.com');
--INSERT INTO personal VALUES(DEFAULT, 'Carla', 'administratiu', 'administrador2@email.com');
--INSERT INTO personal VALUES(DEFAULT, 'Nicole', 'cuiner', 'cuiner3@email.com');




--INSERT INTO categories VALUES(DEFAULT, '');
INSERT INTO categories VALUES(DEFAULT, 'Entrants');
INSERT INTO categories VALUES(DEFAULT, 'Principal');
INSERT INTO categories VALUES(DEFAULT, 'Postres');
INSERT INTO categories VALUES(DEFAULT, 'Begudes');

--INSERT INTO plats VALUES(DEFAULT, '', '', , );
INSERT INTO plats VALUES(DEFAULT, 'Amanida verda', 'Amanida verda', 5.80, 1);
INSERT INTO plats VALUES(DEFAULT, 'Amanida catalana', 'Amanida Catalana', 6.90, 1);
INSERT INTO plats VALUES(DEFAULT, 'Sopa de galets', 'Sopa de galets', 5.30, 1);
INSERT INTO plats VALUES(DEFAULT, 'Bistec de vadella', 'Bistec de vadella', 15.20, 2);
INSERT INTO plats VALUES(DEFAULT, 'Rap al forn', 'Rap al forn', 18.40, 2);
INSERT INTO plats VALUES(DEFAULT, 'Tiramisú', 'Tiramisú', 6.90, 3);
INSERT INTO plats VALUES(DEFAULT, 'Crema catalana', 'Crema catalana', 5.90, 3);
INSERT INTO plats VALUES(DEFAULT, 'Gelat', 'Gelat', 5.0, 3);
INSERT INTO plats VALUES(DEFAULT, 'Cava de la casa', 'Cava de la casa', 12.20, 4);
INSERT INTO plats VALUES(DEFAULT, 'Vi de la bodega', 'Vi de la bodega', 11.90, 4);
INSERT INTO plats VALUES(DEFAULT, 'Vi Don Simon', 'Destrossa l''estòmac', 0.60, 4);

INSERT INTO taules VALUES(DEFAULT, 1, 4);
INSERT INTO taules VALUES(DEFAULT, 2, 4);
INSERT INTO taules VALUES(DEFAULT, 3, 8);
INSERT INTO taules VALUES(DEFAULT, 4, 8);
INSERT INTO taules VALUES(DEFAULT, 5, 6);
INSERT INTO taules VALUES(DEFAULT, 6, 6);
INSERT INTO taules VALUES(DEFAULT, 7, 6);
INSERT INTO taules VALUES(DEFAULT, 8, 10);
INSERT INTO taules VALUES(DEFAULT, 9, 12);

INSERT INTO reserves VALUES(DEFAULT, 1, 'Clint Eastwood', '2025-05-13', 2, USER()); --maxim
INSERT INTO reserves VALUES(DEFAULT, 2, 'Laura Palmer', '2025-05-13', 2, USER());
INSERT INTO reserves VALUES(DEFAULT, 3, 'Keith Richards', '2025-05-13', 2, USER());
INSERT INTO reserves VALUES(DEFAULT, 1, 'Sam Spade', '2025-05-14', 2, USER());
INSERT INTO reserves VALUES(DEFAULT, 4, 'Pau Cubarsí', '2025-05-14', 2, USER());
INSERT INTO reserves VALUES(DEFAULT, 5, 'Mrs Philomena Cunk', '2025-05-14', 2, USER());
INSERT INTO reserves VALUES(DEFAULT, 2, 'Ed Wood', '2025-05-15', 2, USER());
INSERT INTO reserves VALUES(DEFAULT, 4, 'Magneto Smith', '2025-05-15', 2, USER());
INSERT INTO reserves VALUES(DEFAULT, 6, 'Van Morrison', '2025-05-15',2, USER());
INSERT INTO reserves VALUES(DEFAULT, 8, 'Patti Smith', '2025-05-15', 2, USER());
-- Orson convida a massa gent -> ERRORRRRRRRR
--INSERT INTO reserves VALUES(DEFAULT, 1, 'Orson Welles', '2025-05-15', 22, USER());


INSERT INTO comandes(id_taula, data_comanda, estat, username) VALUES(1, NOW(), 'Lliurat', USER());
INSERT INTO comandes(id_taula, data_comanda, estat, username) VALUES(2, '2025-04-22', 'Lliurat', USER());
INSERT INTO comandes(id_taula, data_comanda, estat, username) VALUES(3, '2025-04-24', 'Lliurat', USER());
INSERT INTO comandes VALUES(DEFAULT, 4, NOW(), 'Entregat', USER());
INSERT INTO comandes(id_taula, data_comanda, estat, username) VALUES(3, '2025-04-24', 'Lliurat', USER());
INSERT INTO comandes VALUES(DEFAULT, 4, NOW(), 'En preparacio', USER());

INSERT INTO detalls_comanda VALUES(DEFAULT, 1, 1, 2);
INSERT INTO detalls_comanda VALUES(DEFAULT, 1, 2, 3);
INSERT INTO detalls_comanda VALUES(DEFAULT, 1, 3, 2);
INSERT INTO detalls_comanda VALUES(DEFAULT, 2, 1, 2);
INSERT INTO detalls_comanda VALUES(DEFAULT, 2, 2, 2);
INSERT INTO detalls_comanda VALUES(DEFAULT, 2, 3, 4);
INSERT INTO detalls_comanda VALUES(DEFAULT, 3, 1, 2);




COMMIT;

--SET GLOBAL general_log=0;