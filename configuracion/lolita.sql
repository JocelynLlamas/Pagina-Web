CREATE DATABASE lolita;

USE lolita;

CREATE TABLE usuarios
(
    id       VARCHAR(255),
    nombre   VARCHAR(255),
    email    VARCHAR(255) UNIQUE,
    password VARCHAR(255),
    PRIMARY KEY (id)
);

ALTER TABLE usuarios
    ADD COLUMN rol varchar(50);
ALTER TABLE usuarios
    MODIFY COLUMN nombre varchar(255) UNIQUE;

CREATE TABLE productos
(
    id_producto     VARCHAR(255),
    id_vendedor     VARCHAR(255),
    nombre_producto VARCHAR(255),
    precio          VARCHAR(255),
    stock           VARCHAR(255),
    descripcion     VARCHAR(2000),
    categoria       VARCHAR(255),
    subcategoria    VARCHAR(255),
    valoracion      INT,
    talla           INT,
    fecha           DATETIME,
    PRIMARY KEY (id_producto),
    FOREIGN KEY (id_vendedor) REFERENCES usuarios (id)
    ON DELETE CASCADE
);

CREATE TABLE archivos
(
    id_archivo  VARCHAR(255),
    id_producto VARCHAR(255),
    archivo     VARCHAR(255),
    PRIMARY KEY (id_archivo)
);

CREATE TABLE categoria
(
    id_categoria VARCHAR(255),
    nombre       VARCHAR(255),
    PRIMARY KEY (id_categoria)
);

CREATE TABLE subcategoria
(
    id_subcategoria VARCHAR(255),
    nombre          VARCHAR(255),
    id_categoria    VARCHAR(255),
    PRIMARY KEY (id_subcategoria),
    FOREIGN KEY (id_categoria) REFERENCES categoria (id_categoria)
    ON DELETE CASCADE
);

CREATE TABLE tallas
(
  id_talla VARCHAR(255),
  numero INT,
  PRIMARY KEY (id_talla)
);

CREATE TABLE carrito
(
    id_producto VARCHAR(255),
    id_usuario  VARCHAR(255),
    id_talla VARCHAR(255),
    id          VARCHAR(255),
    PRIMARY KEY (id),
    FOREIGN KEY (id_producto) REFERENCES productos (id_producto)
    ON DELETE CASCADE,
    FOREIGN KEY (id_usuario) REFERENCES usuarios (id)
    ON DELETE CASCADE
);

CREATE TABLE sale
(
    id_producto VARCHAR(255),
    id          VARCHAR(255),
    PRIMARY KEY (id),
    FOREIGN KEY (id_producto) REFERENCES productos (id_producto)
        ON DELETE CASCADE
);

CREATE TABLE favoritos
(
    id_producto VARCHAR(255),
    id_usuario  VARCHAR(255),
    id_fav          VARCHAR(255),
    PRIMARY KEY (id_fav),
    FOREIGN KEY (id_producto) REFERENCES productos (id_producto)
    ON DELETE CASCADE,
    FOREIGN KEY (id_usuario) REFERENCES usuarios (id)
    ON DELETE CASCADE
);

CREATE TABLE comentarios
(
    id_comentario   VARCHAR(255),
    id_producto     VARCHAR(255),
    id_usuario     VARCHAR(255),
    comentario     VARCHAR(2000),
    PRIMARY KEY (id_comentario),
    FOREIGN KEY (id_usuario) REFERENCES usuarios (id)
    ON DELETE CASCADE,
    FOREIGN KEY (id_producto) REFERENCES productos (id_producto)
    ON DELETE CASCADE
);

INSERT INTO categoria
VALUES ('30850e3f-4ca8-11ec-90fe-fcaa147f5b22', 'Botas');
INSERT INTO categoria
VALUES ('30899be8-4ca8-11ec-90fe-fcaa147f5b22', 'Chunky');
INSERT INTO categoria
VALUES ('309188c5-4ca8-11ec-90fe-fcaa147f5b22', 'Zapatos');
INSERT INTO categoria
VALUES ('3099f5a2-4ca8-11ec-90fe-fcaa147f5b22', 'Tacones');
INSERT INTO categoria
VALUES (uuid(), 'Sale');

INSERT INTO subcategoria
VALUES (UUID(), 'Plataforma', '30850e3f-4ca8-11ec-90fe-fcaa147f5b22');
INSERT INTO subcategoria
VALUES (UUID(), 'Tobillo', '30850e3f-4ca8-11ec-90fe-fcaa147f5b22');
INSERT INTO subcategoria
VALUES (UUID(), 'Rodilla Alta', '30850e3f-4ca8-11ec-90fe-fcaa147f5b22');
INSERT INTO subcategoria
VALUES (UUID(), 'Muslo Alto', '30850e3f-4ca8-11ec-90fe-fcaa147f5b22');
INSERT INTO subcategoria
VALUES (UUID(), 'Chunky', '30850e3f-4ca8-11ec-90fe-fcaa147f5b22');

INSERT INTO subcategoria
VALUES (UUID(), 'Zapatos', '30899be8-4ca8-11ec-90fe-fcaa147f5b22');
INSERT INTO subcategoria
VALUES (UUID(), 'Botas', '30899be8-4ca8-11ec-90fe-fcaa147f5b22');

INSERT INTO subcategoria
VALUES (UUID(), 'Chunky', '309188c5-4ca8-11ec-90fe-fcaa147f5b22');
INSERT INTO subcategoria
VALUES (UUID(), 'Sandalias', '309188c5-4ca8-11ec-90fe-fcaa147f5b22');
INSERT INTO subcategoria
VALUES (UUID(), 'Sneakers', '309188c5-4ca8-11ec-90fe-fcaa147f5b22');
INSERT INTO subcategoria
VALUES (UUID(), 'Plataformas', '309188c5-4ca8-11ec-90fe-fcaa147f5b22');
INSERT INTO subcategoria
VALUES (UUID(), 'Planos', '309188c5-4ca8-11ec-90fe-fcaa147f5b22');

INSERT INTO subcategoria
VALUES (UUID(), 'Aguja', '3099f5a2-4ca8-11ec-90fe-fcaa147f5b22');
INSERT INTO subcategoria
VALUES (UUID(), 'Plataforma', '3099f5a2-4ca8-11ec-90fe-fcaa147f5b22');

INSERT INTO tallas
VALUES (UUID(), '35');
INSERT INTO tallas
VALUES (UUID(), '36');
INSERT INTO tallas
VALUES (UUID(), '37');
INSERT INTO tallas
VALUES (UUID(), '38');
INSERT INTO tallas
VALUES (UUID(), '39');
INSERT INTO tallas
VALUES (UUID(), '40');


SELECT *
FROM subcategoria S
         INNER JOIN categoria C
                    ON S.id_categoria = C.id_categoria AND C.id_categoria = '30850e3f-4ca8-11ec-90fe-fcaa147f5b22';

SELECT *
FROM productos
WHERE subcategoria = 'Mulso Alto'
ORDER BY precio ASC;

SELECT *
FROM productos
WHERE precio BETWEEN '1000' AND '300000';

DELETE FROM productos WHERE id_producto = '61a137f3f2297';

SELECT P.id_producto, P.categoria, P.precio, P.nombre_producto, C.id_producto AS comentarioIdP FROM comentarios C INNER JOIN productos P ON P.id_producto = C.id_producto AND C.id_usuario = '61a137d8b3b8c';

SELECT * FROM productos P INNER JOIN comentarios C ON P.id_producto = C.id_producto AND C.id_usuario = '61a137d8b3b8c' GROUP BY P.nombre_producto;

ALTER TABLE productos DROP COLUMN valoracion;

ALTER TABLE comentarios ADD fecha DATETIME;

SELECT * FROM productos WHERE descripcion LIKE '%dfgg%' OR subcategoria LIKE '%dgdr%' OR nombre_producto LIKE '%dkjf%';

ALTER TABLE productos MODIFY COLUMN precio INT;

SELECT nombre_producto, precio FROM productos WHERE descripcion LIKE '%botas%' ORDER BY precio;

SELECT * FROM productos WHERE (descripcion LIKE LOWER('%botas%') OR subcategoria LIKE LOWER('%botas%') OR nombre_producto LIKE LOWER('%botas%')) AND precio BETWEEN 600 AND 900;
