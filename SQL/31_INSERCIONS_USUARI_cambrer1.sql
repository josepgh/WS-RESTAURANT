SET autocommit=FALSE;


START TRANSACTION;

INSERT INTO reserves VALUES(DEFAULT, 1, 'Capitan Trueno', '2025-05-15',2, USER());
INSERT INTO reserves VALUES(DEFAULT, 2, 'Paul Newman', '2025-05-15', 1, USER());

 
COMMIT;

