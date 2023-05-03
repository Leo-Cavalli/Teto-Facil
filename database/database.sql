CREATE SCHEMA IF NOT EXISTS `tetofacil` ;

USE tetofacil;

CREATE TABLE IF NOT EXISTS usuarios(
    id_usuario INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    senha CHAR(255) NOT NULL
    );
    
CREATE TABLE IF NOT EXISTS corretores(
	id_corretor INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    senha CHAR(255) NOT NULL,
    creci VARCHAR(100) NOT NULL
);

CREATE TABLE IF NOT EXISTS imoveisDefinitivos(
	id_imovel INT PRIMARY KEY AUTO_INCREMENT,
    id_anunciante INT NOT NULL,
    id_corretor INT
);

ALTER TABLE imoveisDefinitivos ADD CONSTRAINT
	FOREIGN KEY (id_corretor)
    REFERENCES corretores(id_corretor)
    ON DELETE CASCADE
    ON UPDATE CASCADE;

ALTER TABLE imoveisDefinitivos ADD CONSTRAINT
	FOREIGN KEY (id_anunciante)
	REFERENCES usuarios(id_usuario)
    ON DELETE CASCADE
    ON UPDATE CASCADE;

CREATE TABLE favoritos(
	id_fav INT PRIMARY KEY AUTO_INCREMENT,
    id_usuario INT,
    id_imovel INT
);

ALTER TABLE favoritos ADD CONSTRAINT
	FOREIGN KEY (id_usuario)
	REFERENCES usuarios(id_usuario)
    ON DELETE CASCADE
    ON UPDATE CASCADE;
    
ALTER TABLE favoritos ADD CONSTRAINT
	FOREIGN KEY (id_imovel)
	REFERENCES imoveisDefinitivos(id_imovel)
    ON DELETE CASCADE
    ON UPDATE CASCADE;





	




