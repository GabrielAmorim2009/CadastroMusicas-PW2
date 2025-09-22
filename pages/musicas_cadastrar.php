<?php

    require_once __DIR__ . '/../data/connection.php';
    require_once __DIR__ . '/../model/Musicas.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nome = $_POST['nome'] ?? '';
        $artista = $_POST['artista'] ?? '';
        $ano_lancamento = $_POST['ano_lancamento'] ?? '';
        $album = $_POST['album'] ?? '';
        $genero = $_POST['genero'] ?? '';

        $musica = new Musicas($conn);
        $musica->nome = $nome;
        $musica->artista = $artista;
        $musica->ano_lancamento= $ano_lancamento;
        $musica->album = $album;
        $musica->genero = $genero;
        $resultado = $musica->cadastrar();
    }
?>
    <div class="form-container">
        <h1>Cadastrar Nova Musica</h1>
        <form action="" method="post">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" required>
            </div>
            <div class="form-group">
                <label for="artista">Artista:</label>
                <input type="text" id="artista" name="artista" required>
            </div>
            <div class="form-group">
                <label for="ano_lancamento">Ano de Lançamento:</label>
                <input type="date" id="ano_lancamento" name="ano_lancamento" required>
            </div>
            <div class="form-group">
                <label for="genero">Genero:</label>
                <input type="text" id="genero" name="genero" required>
            </div>
            <div class="form-group">
                <label for="album">Album:</label>
                <input type="text" id="album" name="album" required>
            </div>
            <div class="form-group">
                <button type="submit">Cadastrar Musica</button>
            </div>
            <?php
            if (isset($resultado)) {
                if ($resultado) {
                    echo '<p style="color: green; text-align: center;">Musica cadastrada com sucesso!</p>';
                } else {
                    echo '<p style="color: red; text-align: center;">Erro ao cadastrar musica. Tente novamente.</p>';
                }
            }  
            ?>
        </form>
    </div>
