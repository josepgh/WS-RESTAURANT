--SET GLOBAL general_log=1;
--SET GLOBAL general_log_file='D:\\PRJCTS\\WS-RESTAURANT\\SQL\\crea_burguer.log';--OK
--SET GLOBAL general_log_file='crea_restaurant_al_datadir.log'; --FUNCIONA

SET autocommit=TRUE;
--SELECT CURDATE();
--SELECT CURTIME();

SELECT NOW(), user(), current_user();

USE restaurantDB;

START TRANSACTION; -- PREVAL sobre el SET autocommit=TRUE del principi


--INSERT INTO personal VALUES(DEFAULT, nom, rol, username, password, PASSWORD(), host, es_actiu);

--VIA ed25519 USING PASSWORD ('cambrer1')
--INSERT INTO personal (nom, rol, username, password, host) VALUES('Antonia CUI', 'cuiner', 'cuiner1', 'cuiner1', 'localhost');
INSERT INTO personal (nom, rol, username, password, pwdhash, host) VALUES('Antonia CUI', 'cuiner', 'cuiner1', 'cuiner1', ed25519_password('cuiner1'), 'localhost');
INSERT INTO personal (nom, rol, username, password, pwdhash, host) VALUES('Kevin José CUI', 'cuiner', 'cuiner2', 'cuiner2', ed25519_password('cuiner2'), 'localhost');
INSERT INTO personal (nom, rol, username, password, pwdhash, host) VALUES('Natàlia CUI', 'cuiner', 'cuiner3', 'cuiner3', ed25519_password('cuiner3'), 'localhost');
INSERT INTO personal (nom, rol, username, password, pwdhash, host) VALUES('Vanessa CAM', 'cambrer', 'cambrer1', 'cambrer1', ed25519_password('cambrer1'), 'localhost');
INSERT INTO personal (nom, rol, username, password, pwdhash, host) VALUES('Carlos Enrique CAM', 'cambrer', 'cambrer2', 'cambrer2', ed25519_password('cambrer2'), 'localhost');
INSERT INTO personal (nom, rol, username, password, pwdhash, host) VALUES('Joan CAM', 'cambrer', 'cambrer3', 'cambrer3', ed25519_password('cambrer3'), 'localhost');
INSERT INTO personal (nom, rol, username, password, pwdhash, host) VALUES('Carla ADM', 'administrador', 'administrador1', 'administrador1', ed25519_password('administrador1'), 'localhost');
INSERT INTO personal (nom, rol, username, password, pwdhash, host) VALUES('Teresa ADM', 'administrador', 'administrador2', 'administrador2', ed25519_password('administrador2'), 'localhost');
INSERT INTO personal (nom, rol, username, password, pwdhash, host) VALUES('Anna ADM', 'administrador', 'administrador3', 'administrador3', ed25519_password('administrador3'), 'localhost');

--					,password 	VARCHAR(15) NOT NULL
--					,pwdhash 	CHAR(64) NOT NULL


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
INSERT INTO plats VALUES(DEFAULT, 'Amanida d''anxoves', 'Amanida d''anxoves', 6.90, 1);
INSERT INTO plats VALUES(DEFAULT, 'Sopa de galets', 'Sopa de galets', 5.30, 1);
INSERT INTO plats VALUES(DEFAULT, 'Bistec de vadella', 'Bistec de vadella', 15.20, 2);
INSERT INTO plats VALUES(DEFAULT, 'Rap al forn', 'Rap al forn', 18.40, 2);
INSERT INTO plats VALUES(DEFAULT, 'Anxoves farcides', 'Anxoves farcides d''ou', 18.40, 2);
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

INSERT INTO reserves VALUES(DEFAULT, DEFAULT, 1, 'Clint Eastwood', '2025-05-13', '13', 2, USER()); --maxim
INSERT INTO reserves VALUES(DEFAULT, DEFAULT, 2, 'Laura Palmer', '2025-05-13', '15', 2, USER());
INSERT INTO reserves VALUES(DEFAULT, DEFAULT, 3, 'Keith Richards', '2025-05-13', '13', 2, USER());
INSERT INTO reserves VALUES(DEFAULT, 'ocupada', 4, 'Ava Gardner', '2025-05-13', '13', 2, USER());


INSERT INTO reserves VALUES(DEFAULT, DEFAULT, 1, 'Sam Spade', '2025-05-14', '15', 2, USER());
INSERT INTO reserves VALUES(DEFAULT, DEFAULT, 4, 'Pau Cubarsí', '2025-05-14', '13', 2, USER());
INSERT INTO reserves VALUES(DEFAULT, DEFAULT, 5, 'Mrs Philomena Cunk', '2025-05-14', '15', 2, USER());
INSERT INTO reserves VALUES(DEFAULT, 'ocupada', 4, 'Marisa', '2025-05-14', '13', 2, USER());


INSERT INTO reserves VALUES(DEFAULT, DEFAULT, 2, 'Ed Wood', '2025-05-15', '15', 2, USER());
INSERT INTO reserves VALUES(DEFAULT, DEFAULT, 4, 'Magneto Smith', '2025-05-15', '13', 2, USER());
INSERT INTO reserves VALUES(DEFAULT, DEFAULT, 6, 'Van Morrison', '2025-05-15', '15', 2, USER());
INSERT INTO reserves VALUES(DEFAULT, DEFAULT, 8, 'Patti Smith', '2025-05-15', '13', 2, USER());
INSERT INTO reserves VALUES(DEFAULT, 'ocupada', 4, 'Patt Highsimith', '2025-05-15', '13', 2, USER());

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



-- ¡Listo! Eso te da un total de 29 productos (9 anteriores + 20 nuevos).

-- Insertar productos de ejemplo

INSERT INTO productos (nombre, categoria_id, categoria_nombre) VALUES
('Televisor 50"', 1, 'Electrónica'),
('Auriculares Bluetooth', 1, 'Electrónica'),
('Smartphone Android', 1, 'Electrónica'),

('El Principito', 2, 'Libros'),
('Cien años de soledad', 2, 'Libros'),
('Harry Potter y la piedra filosofal', 2, 'Libros'),

('Camiseta algodón', 3, 'Ropa'),
('Pantalón vaquero', 3, 'Ropa'),
('Zapatillas deportivas', 3, 'Ropa');

-- Nuevos productos (más variedad y categorías)
INSERT INTO productos (nombre, categoria_id, categoria_nombre) VALUES
('Lavadora A++', 4, 'Hogar'),
('Aspiradora ciclónica', 4, 'Hogar'),
('Cafetera exprés', 4, 'Hogar'),

('Lego Star Wars', 5, 'Juguetes'),
('Puzzle 1000 piezas', 5, 'Juguetes'),
('Muñeca articulada', 5, 'Juguetes'),

('Balón de fútbol', 6, 'Deportes'),
('Raqueta de tenis', 6, 'Deportes'),
('Bicicleta montaña', 6, 'Deportes'),

('Tableta gráfica', 1, 'Electrónica'),
('Altavoz portátil', 1, 'Electrónica'),

('Kindle Paperwhite', 2, 'Libros'),
('Don Quijote de la Mancha', 2, 'Libros'),

('Sudadera con capucha', 3, 'Ropa'),
('Zapatos formales', 3, 'Ropa');



COMMIT;

--SET GLOBAL general_log=0;


/*
--INSERT INTO grants_rol VALUES(DEFAULT, '', '');
--INSERT INTO grants_rol VALUES(DEFAULT, '', '');
--INSERT INTO grants_rol VALUES(DEFAULT, '', '');
INSERT INTO grants_rol VALUES(DEFAULT, 'cuiner', 'grants cuiner');
INSERT INTO grants_rol VALUES(DEFAULT, 'cambrer', 'grants cambrer');
INSERT INTO grants_rol VALUES(DEFAULT, 'administrador', 'grants administrador');
*/
/*
--('cuiner', 'cambrer', 'administratiu')
--INSERT INTO personal VALUES(DEFAULT, nom, rol, email, username, password, host);
INSERT INTO personal VALUES(DEFAULT, 'Antonia', 'cuiner', 'cuiner1@restaurant.com', 'cuiner1', 'cuiner1', 'localhost', DEFAULT);
INSERT INTO personal VALUES(DEFAULT, 'Vanessa', 'cambrer', 'cambrer1@restaurant.com', 'cambrer1', 'cambrer1', 'localhost', DEFAULT);
INSERT INTO personal VALUES(DEFAULT, 'Kevin José', 'cuiner', 'cuiner2@restaurant.com', 'cuiner2', 'cuiner2', 'localhost', FALSE);
INSERT INTO personal VALUES(DEFAULT, 'Carlos Enrique', 'cambrer', 'cambrer2@restaurant.com', 'cambrer2', 'cambrer2', 'localhost', DEFAULT);
INSERT INTO personal VALUES(DEFAULT, 'Carla', 'administrador', 'administrador1@restaurant.com', 'administrador1', 'administrador1', 'localhost', DEFAULT);
INSERT INTO personal VALUES(DEFAULT, 'Teresa', 'administrador', 'administrador2@restaurant.com', 'administrador2', 'administrador2', 'localhost', DEFAULT);
INSERT INTO personal VALUES(DEFAULT, 'Joan', 'cambrer', 'cambrer3@restaurant.com', 'cambrer3', 'cambrer3', 'localhost', FALSE);
INSERT INTO personal VALUES(DEFAULT, 'Natàlia', 'cambrer', 'cambrer4@restaurant.com', 'cambrer4', 'cambrer4', 'localhost', FALSE);
*/

/*
--INSERT INTO personal VALUES(DEFAULT, nom, rol, username, password, pwdhash, host, es_actiu);
INSERT INTO personal VALUES(DEFAULT, 'Antonia', 'cuiner', 'cuiner1', 'cuiner1', SHA2('cuiner1', 256), 'localhost', DEFAULT);
INSERT INTO personal VALUES(DEFAULT, 'Kevin José', 'cuiner', 'cuiner2', 'cuiner2', SHA2('cuiner2', 256), 'localhost', DEFAULT);
INSERT INTO personal VALUES(DEFAULT, 'Natàlia', 'cuiner', 'cuiner3', 'cuiner3', SHA2('cuiner3', 256), 'localhost', DEFAULT);
INSERT INTO personal VALUES(DEFAULT, 'Vanessa', 'cambrer', 'cambrer1', 'cambrer1', SHA2('cambrer1', 256), 'localhost', DEFAULT);
INSERT INTO personal VALUES(DEFAULT, 'Carlos Enrique', 'cambrer', 'cambrer2', 'cambrer2', SHA2('cambrer2', 256), 'localhost', DEFAULT);
INSERT INTO personal VALUES(DEFAULT, 'Joan', 'cambrer', 'cambrer3', 'cambrer3', SHA2('cambrer3', 256), 'localhost', DEFAULT);
INSERT INTO personal VALUES(DEFAULT, 'Carla', 'administrador', 'administrador1', 'administrador1', SHA2('administrador1', 256), 'localhost', DEFAULT);
INSERT INTO personal VALUES(DEFAULT, 'Teresa', 'administrador', 'administrador2', 'administrador2', SHA2('administrador2', 256), 'localhost', DEFAULT);
INSERT INTO personal VALUES(DEFAULT, 'Silvia', 'administrador', 'administrador3', 'administrador3', SHA2('administrador3', 256), 'localhost', DEFAULT);
*/

/*
--INSERT INTO personal VALUES(DEFAULT, nom, rol, username, password, PASSWORD(), host, es_actiu);
INSERT INTO personal VALUES(DEFAULT, 'Antonia', 'cuiner', 'cuiner1', 'cuiner1', 'localhost', DEFAULT);
INSERT INTO personal VALUES(DEFAULT, 'Kevin José', 'cuiner', 'cuiner2', 'cuiner2', 'localhost', DEFAULT);
INSERT INTO personal VALUES(DEFAULT, 'Natàlia', 'cuiner', 'cuiner3', 'cuiner3', 'localhost', DEFAULT);
INSERT INTO personal VALUES(DEFAULT, 'Vanessa', 'cambrer', 'cambrer1', 'cambrer1', 'localhost', DEFAULT);
INSERT INTO personal VALUES(DEFAULT, 'Carlos Enrique', 'cambrer', 'cambrer2', 'cambrer2', 'localhost', DEFAULT);
INSERT INTO personal VALUES(DEFAULT, 'Joan', 'cambrer', 'cambrer3', 'cambrer3', 'localhost', DEFAULT);
INSERT INTO personal VALUES(DEFAULT, 'Carla', 'administrador', 'administrador1', 'administrador1', 'localhost', DEFAULT);
INSERT INTO personal VALUES(DEFAULT, 'Teresa', 'administrador', 'administrador2', 'administrador2', 'localhost', DEFAULT);
IN*/

