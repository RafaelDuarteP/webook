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
    complemento VARCHAR(50),
    cep CHAR(8) NOT NULL,
    PRIMARY KEY (id_usuario)
)  ENGINE=INNODB DEFAULT CHARSET=UTF8;

truncate table usuario;

CREATE TABLE IF NOT EXISTS livro (
    id_livro INT NOT NULL AUTO_INCREMENT,
    ISBN CHAR(13) NOT NULL,
    GENERO VARCHAR(30) NOT NULL,
    TITULO VARCHAR(100) NOT NULL,
    EDICAO INT NOT NULL,
    NUMERO_PAGINAS TINYINT NOT NULL,
    IDIOMA VARCHAR(30) NOT NULL,
    ANO YEAR NOT NULL,
    EDITORA VARCHAR(30) NOT NULL,
    AUTOR VARCHAR(30) NOT NULL,
    TIPO ENUM('Doação', 'Empréstimo', 'Troca') NOT NULL,
    STATUS_LIVRO ENUM('Disponivel', 'Em processo', 'Indisponivel') NOT NULL,
    id_usuario INT NOT NULL,
    PRIMARY KEY (id_livro),
    FOREIGN KEY (id_usuario)
        REFERENCES usuario (id_usuario)
)  ENGINE=INNODB DEFAULT CHARSET=UTF8;

truncate table livro;

CREATE TABLE IF NOT EXISTS doacao (
    id_doacao INT NOT NULL AUTO_INCREMENT,
    destino INT NOT NULL,
    id_livro INT NOT NULL,
    data_doacao DATE NOT NULL,
    PRIMARY KEY (id_doacao),
    FOREIGN KEY (destino)
        REFERENCES usuario (id_usuario),
    FOREIGN KEY (id_livro)
        REFERENCES livro (id_livro)
)  ENGINE=INNODB DEFAULT CHARSET=UTF8;

truncate table doacao;

CREATE TABLE IF NOT EXISTS emprestimo (
    id_emprestimo INT NOT NULL AUTO_INCREMENT,
    destino INT NOT NULL,
    id_livro INT NOT NULL,
    data_emprestimo DATE NOT NULL,
    prazo INT NOT NULL,
    PRIMARY KEY (id_emprestimo),
    FOREIGN KEY (destino)
        REFERENCES usuario (id_usuario),
    FOREIGN KEY (id_livro)
        REFERENCES livro (id_livro)
)  ENGINE=INNODB DEFAULT CHARSET=UTF8;

truncate table emprestimo;

CREATE TABLE IF NOT EXISTS troca (
    id_troca INT NOT NULL AUTO_INCREMENT,
    data_troca DATE NOT NULL,
    id_livro_1 INT NOT NULL,
    id_livro_2 INT NOT NULL,
    cod_usuario_1 INT NOT NULL,
    cod_usuario_2 INT NOT NULL,
    PRIMARY KEY (id_troca),
    FOREIGN KEY (id_livro_1)
        REFERENCES livro (id_livro),
    FOREIGN KEY (id_livro_2)
        REFERENCES livro (id_livro),
    FOREIGN KEY (cod_usuario_1)
        REFERENCES usuario (id_usuario),
    FOREIGN KEY (cod_usuario_2)
        REFERENCES usuario (id_usuario)
)  ENGINE=INNODB DEFAULT CHARSET=UTF8;
