USE quevedodb;

CREATE TABLE usuarios (
            email VARCHAR(255) PRIMARY KEY,
            nombre VARCHAR(255) NOT NULL,
            apellido VARCHAR(255) NOT NULL,
            telefono NUMERIC(9) NOT NULL,
            passwd VARCHAR(255) NOT NULL,
            dinero NUMERIC (5) NOT NULL
);

CREATE TABLE contactos (
            telefono NUMERIC(9) PRIMARY KEY ,
            nombre VARCHAR(255) NOT NULL,
            apellido VARCHAR(255) NOT NULL,
            dinero NUMERIC (5) NOT NULL
);

INSERT INTO contactos VALUES (666666666,'Alonso','Rodriguez',100);
INSERT INTO contactos VALUES (666666667,'Beatriz','Rodriguez',150);
INSERT INTO contactos VALUES (666666668,'Cesar','Rodriguez',180);
INSERT INTO contactos VALUES (666666669,'Diego','Rodriguez',110);
INSERT INTO contactos VALUES (666666661,'Elena','Rodriguez',1200);
INSERT INTO contactos VALUES (666666662,'Fatima','Rodriguez',100);
INSERT INTO contactos VALUES (666666663,'George','Rodriguez',150);
INSERT INTO contactos VALUES (666666664,'Hugo','Rodriguez',180);
INSERT INTO contactos VALUES (666666665,'Ines','Rodriguez',110);
INSERT INTO contactos VALUES (666666611,'Javier','Rodriguez',1200);
INSERT INTO contactos VALUES (666666612,'Kevin','Rodriguez',100);
INSERT INTO contactos VALUES (666666613,'Lucia','Rodriguez',150);
INSERT INTO contactos VALUES (666666614,'Maria','Rodriguez',180);
INSERT INTO contactos VALUES (666666615,'Nerea','Rodriguez',110);
INSERT INTO contactos VALUES (666666616,'Olivia','Rodriguez',1200);
INSERT INTO contactos VALUES (666666617,'Pablo','Rodriguez',100);
INSERT INTO contactos VALUES (666666618,'Quique','Rodriguez',150);
INSERT INTO contactos VALUES (666666619,'Raul','Rodriguez',180);
INSERT INTO contactos VALUES (666666620,'Sara','Rodriguez',110);
INSERT INTO contactos VALUES (666666621,'Teodoro','Rodriguez',1200);
INSERT INTO contactos VALUES (666666622,'Unai','Rodriguez',100);
INSERT INTO contactos VALUES (666666623,'Violeta','Rodriguez',150);
INSERT INTO contactos VALUES (666666624,'Willy','Rodriguez',180);
INSERT INTO contactos VALUES (666666625,'Xisco','Rodriguez',110);
INSERT INTO contactos VALUES (666666626,'Yeray','Rodriguez',1200);
INSERT INTO contactos VALUES (666666627,'Zaira','Rodriguez',110);
