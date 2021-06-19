create database if not exists webook
default char set utf8 collate utf8_general_ci;

use webook;

CREATE TABLE IF NOT EXISTS usuario (
    id_usuario INT NOT NULL AUTO_INCREMENT,
    email VARCHAR(50) NOT NULL UNIQUE,
    nome VARCHAR(50) NOT NULL,
    telefone CHAR(11) NOT NULL,
    senha CHAR(32) NOT NULL,
    rua VARCHAR(50) NOT NULL,
    bairro VARCHAR(50) NOT NULL,
    cidade VARCHAR(50) NOT NULL,
    estado CHAR(2) NOT NULL,
    numero_casa INT NOT NULL,
    cep CHAR(8) NOT NULL,
    PRIMARY KEY (id_usuario, email)
)  ENGINE=INNODB DEFAULT CHARSET=UTF8;

truncate table usuario;

CREATE TABLE IF NOT EXISTS livro (
    id_livro INT NOT NULL AUTO_INCREMENT,
    ISBN CHAR(13) NOT NULL,
    GENERO VARCHAR(30) NOT NULL,
    TITULO VARCHAR(100) NOT NULL,
    EDICAO INT NOT NULL,
    NUMERO_PAGINAS INT NOT NULL,
    IDIOMA VARCHAR(30) NOT NULL,
    ANO YEAR NOT NULL,
    EDITORA VARCHAR(30) NOT NULL,
    AUTOR VARCHAR(30) NOT NULL,
    TIPO ENUM('Doacao', 'Emprestimo') NOT NULL,
    STATUS_LIVRO ENUM('Disponivel', 'Em processo', 'Indisponivel') NOT NULL DEFAULT 'disponivel',
    id_usuario INT NOT NULL,
    PRIMARY KEY (id_livro),
    CONSTRAINT fk_usuario FOREIGN KEY (id_usuario)
        REFERENCES usuario (id_usuario)
)  ENGINE=INNODB DEFAULT CHARSET=UTF8;

truncate table livro;

CREATE TABLE IF NOT EXISTS operacao (
    id_op INT NOT NULL AUTO_INCREMENT,
    TIPO ENUM('Doacao', 'Emprestimo') NOT NULL,
    DATA_OP DATE NOT NULL,
    STATUS_OP ENUM('Aberta', 'Fechada') NOT NULL,
    DATA_FINAL_OP DATE DEFAULT NULL,
    LIVRO_1 INT NOT NULL UNIQUE,
    USUARIO_1 INT NOT NULL,
    USUARIO_2 INT NOT NULL,
    PRIMARY KEY (id_op),
    CONSTRAINT fk_livro_1 FOREIGN KEY (livro_1)
        REFERENCES livro (id_livro),
    CONSTRAINT fk_user_1 FOREIGN KEY (usuario_1)
        REFERENCES usuario (id_usuario),
    CONSTRAINT fk_user_2 FOREIGN KEY (usuario_2)
        REFERENCES usuario (id_usuario)
)  ENGINE=INNODB DEFAULT CHARSET=UTF8;

truncate table operacao;
