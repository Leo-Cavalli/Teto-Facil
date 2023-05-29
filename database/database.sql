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
    valor VARCHAR(32) NOT NULL,
    complemento VARCHAR(100),
    descricao VARCHAR(256) NOT NULL,
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
('Julia Engels', 'julia@gmail', '$2y$10$cSu/xL7zo3dZEbWqblstUu5dPKBhIoD73s5UmW80Mkt.WIkIymACK', '00.0000.00', '010.000.000-00' ,'47999659346'),
('Guilherme', 'guilherme@gmail', '$2y$10$cSu/xL7zo3dZEbWqblstUu5dPKBhIoD73s5UmW80Mkt.WIkIymACK', '00.0000.01','011.000.000-00' ,'47989065296'),
('Jonas', 'jonas@gmail', '$2y$10$cSu/xL7zo3dZEbWqblstUu5dPKBhIoD73s5UmW80Mkt.WIkIymACK', '00.0000.10', '011.000.000.75','4136336670'),
('Angelo', 'angelo@gmail', '$2y$10$cSu/xL7zo3dZEbWqblstUu5dPKBhIoD73s5UmW80Mkt.WIkIymACK', '00.0000.11', '012.000.000-00','47999999999'),
('Pericles', 'pericles@gmail', '$2y$10$cSu/xL7zo3dZEbWqblstUu5dPKBhIoD73s5UmW80Mkt.WIkIymACK', '000.0001.00', '013.000.000-75','41981965528');

INSERT INTO usuarios(id_usuario, nome, email, senha, cpf) VALUES
(1, 'César Willian Pacheco', 'cesar@gmail', '$2y$10$cSu/xL7zo3dZEbWqblstUu5dPKBhIoD73s5UmW80Mkt.WIkIymACK', '075.775.379-50'),
(2, 'Leonardo Cavalli', 'leo@gmail', '$2y$10$cSu/xL7zo3dZEbWqblstUu5dPKBhIoD73s5UmW80Mkt.WIkIymACK', '004.503.189-40'),
(3, 'Rodrigo Munch', 'rodrigo@gmail', '$2y$10$cSu/xL7zo3dZEbWqblstUu5dPKBhIoD73s5UmW80Mkt.WIkIymACK', '303.189.149-50'),
(4, 'Eduardo Mussi', 'eduardo@gmail', '$2y$10$cSu/xL7zo3dZEbWqblstUu5dPKBhIoD73s5UmW80Mkt.WIkIymACK', '000.000.000-50'),
(5, 'Otávio Carneiro', 'otavio@gmail', '$2y$10$cSu/xL7zo3dZEbWqblstUu5dPKBhIoD73s5UmW80Mkt.WIkIymACK', '000.000.000-50');

INSERT INTO imoveisDefinitivos(id_anunciante, tipo_imovel, cep, rua, numero, bairro, cidade, estado, valor, complemento, descricao, situacao) VALUES
(1, 'Casa', '89281-042', 'Lino Zschoerper', '675', 'Progresso', 'São Bento do Sul', 'SC', '4.400.000', 'Casa com Madeira', 'Casa com 1500 metros quadrados', 0),
(1, 'Sobrado', 'Arlindo Araujo Sobrinho', '34', 'Guabirotuba', 'Curitiba', 'PR', '500.000', 'Sobrado F', 'Sobrado de 2 andares', 0),
(2, 'Apartamento', 'Presidente Vinceslau', '404', 'Centro', 'Curitiba', 'PR', '1.200.000', 'Apartamento 502', 'Apartamento no 5 andar', 0),
(3, 'Casa', 'São Pedro', '202', 'Portão', 'Curitiba', 'PR', '1.500.000', 'Casa com piscina', 'Casa com piscina e churrasqueira', 0),
(4, 'Casa', 'São João', '102', 'Parolin', 'Curitiba', 'PR', '1.500.000', 'Casa com piscina', 'Casa com piscina e churrasqueira', 0),
(5, 'Casa', 'Paulo José', '1202', 'Uberaba', 'Curitiba', 'PR', '1.500.000', 'Casa com piscina', 'Casa com piscina e churrasqueira', 0);

INSERT INTO imagens(id_imovel, dir) VALUES
(1, 'fotos/foto_arquivo_64725def48b305.63128735.jpeg'),
(2, 'fotos/foto_arquivo_64725def48b305.63128735.jpeg'),
(3, 'fotos/foto_arquivo_64725def48b305.63128735.jpeg'),
(4, 'fotos/foto_arquivo_64725def48b305.63128735.jpeg'),
(5, 'fotos/foto_arquivo_64725def48b305.63128735.jpeg'),
(6, 'fotos/foto_arquivo_64725def48b305.63128735.jpeg');
