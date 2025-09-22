CREATE DATABASE IF NOT EXISTS musicas;

USE musicas;

CREATE TABLE musicas (
  id int UNSIGNED PRIMARY KEY AUTO_INCREMENT NOT NULL,
  nome varchar(100) NOT NULL,
  artista varchar(100) NOT NULL,
  ano_lancamento date NOT NULL,
  album varchar(100) NOT NULL,
  genero varchar(100) NOT NULL,
  createAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updateAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO musicas (nome, artista, ano_lancamento, album, genero) VALUES
('Agudo Mágico 3', 'MC K.K.', '2022-10-10', 'Agudo Mágico 3', 'Funk');