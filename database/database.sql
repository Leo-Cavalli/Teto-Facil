CREATE SCHEMA IF NOT EXISTS `tetofacil` ;

USE tetofacil;

CREATE TABLE IF NOT EXISTS usuarios(
    id_usuario INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    senha CHAR(255) NOT NULL,
    cpf VARCHAR(100) NOT NULL,
    telefone VARCHAR(100)
    );
    
CREATE TABLE IF NOT EXISTS corretores(
	id_corretor INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    senha CHAR(255) NOT NULL,
    creci VARCHAR(100) NOT NULL,
    cpf VARCHAR(100) NOT NULL,
    telefone VARCHAR(100) NOT NULL
);

CREATE TABLE IF NOT EXISTS imoveisDefinitivos(
	id_imovel INT PRIMARY KEY AUTO_INCREMENT,
    id_anunciante INT NOT NULL,
    id_corretor INT,
    tipo_imovel VARCHAR(100) NOT NULL,
    cep VARCHAR(100) NOT NULL,
    rua VARCHAR(100) NOT NULL,
    numero VARCHAR(100) NOT NULL,
    bairro VARCHAR(100) NOT NULL,
    cidade VARCHAR(100) NOT NULL,
    estado VARCHAR(100) NOT NULL,
    valor VARCHAR(32),
    complemento VARCHAR(100),
    descricao VARCHAR(256),
    situacao BOOLEAN NOT NULL
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

CREATE TABLE IF NOT EXISTS imagens(
    id_imagem INT PRIMARY KEY AUTO_INCREMENT,
    id_imovel INT NOT NULL,
    dir VARCHAR(100) NOT NULL
);
    
ALTER TABLE imagens ADD CONSTRAINT
    FOREIGN KEY (id_imovel)
    REFERENCES imoveisDefinitivos(id_imovel)
    ON DELETE CASCADE
    ON UPDATE CASCADE;

INSERT INTO corretores(nome, email, senha, creci, cpf, telefone) VALUES
('ADMINISTRADOR', 'admin@tfadmin', '$2y$10$.UnGwtF0zG/I6YxPT6eoyunkpE13/ZbzYw52RWF.Y7rGr2CukjG8q', '000', '000', '000');