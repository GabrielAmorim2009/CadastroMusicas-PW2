<?php
require_once __DIR__ .'/../data/db_config.php';

$deleteDB = 'DROP DATABASE IF EXISTS '.DB_NAME.';';
$criarDB = 'CREATE DATABASE IF NOT EXISTS '.DB_NAME.';';
$usarDB = 'USE '.DB_NAME.';';

$crearTabela = "
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
";

$insertDados = "
    INSERT INTO musicas (nome, artista, ano_lancamento, album, genero) VALUES
    ('Agudo Mágico 3', 'MC K.K.', '2022-10-10', 'Agudo Mágico 3', 'Funk');
";

try {
    // Conexão inicial sem banco de dados
    $pdo = new PDO(
        dsn: 'mysql:host='.DB_HOST, 
        username: DB_USER, 
        password: DB_PASS
    );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Deletar banco de dados se existir
    $pdo->exec(statement: $deleteDB);

    // Criar banco de dados
    $pdo->exec(statement: $criarDB);
    // Selecionar banco de dados
    $pdo->exec(statement: $usarDB);

    // Criar tabela
    $pdo->exec($crearTabela);

    // Inserir dados   
    $pdo->exec(statement: $insertDados);

    echo "Banco de dados, tabela e dados criados com sucesso!";
} catch (PDOException $e) {
    die("Erro: " . $e->getMessage());
}
