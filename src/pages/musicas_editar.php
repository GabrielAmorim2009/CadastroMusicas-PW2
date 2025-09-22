<?php
    require_once __DIR__ . '/../data/connection.php';
    require_once __DIR__ . '/../model/Musicas.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $nome = $_POST['nome'] ?? '';
        $artista = $_POST['artista'] ?? '';
        $ano_lancamento = $_POST['ano_lancamento'] ?? '';
        $album = $_POST['album'] ?? '';
        $genero = $_POST['genero'] ?? '';

        $musica = new Musicas($conn);
        $musica->id = $id;
        $musica->nome = $nome;
        $musica->artista = $artista;
        $musica->ano_lancamento= $ano_lancamento;
        $musica->album = $album;
        $musica->genero = $genero;
        $resultado = $musica->editar();
            
    }

    if(!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        echo '<p style="color: red; text-align: center;">ID de musica inválido.</p>';
        echo '<p style="text-align: center;"><a href="/">Voltar para a lista de musicas</a></p>';
        exit;
    } 


    $id = $_GET['id'];

    $musica = new Musicas($conn);
    $musica_atual = $musica->consultarPorId( $id);

    if (!$musica_atual) {
        echo '<p style="color: red; text-align: center;">Musica não encontrada.</p>';
        echo '<p style="text-align: center;"><a href="/">Voltar para a lista de musicas</a></p>';
        exit;
    }
    
?>
    
    <div class="form-container">
        <form action="" method="post" class="formContainer">
            <h1>Editar Musica</h1>
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($musica_atual['id']); ?>">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" class="iptEdit" id="nome" name="nome" value="<?php echo htmlspecialchars($musica_atual['nome']) ?>" required>
            </div>
            <div class="form-group">
                <label for="artista">Artista:</label>
                <input type="text" class="iptEdit" id="artista" name="artista" value="<?php echo htmlspecialchars($musica_atual['artista']) ?>" required>
            </div>
            <div class="form-group">
                <label for="ano_lancamento">Ano de Lançamento:</label>
                <input type="date" class="iptEdit" id="ano_lancamento" name="ano_lancamento" value="<?php echo htmlspecialchars($musica_atual['ano_lancamento']) ?>" required>
            </div>
            <div class="form-group">
                <label for="album">Album:</label>
                <input type="text" class="iptEdit" id="album" name="album" value="<?php echo htmlspecialchars($musica_atual['album']) ?>" required>
            </div>
            <div class="form-group">
                <label for="genero">Genero:</label>
                <input type="text" class="iptEdit" id="genero" name="genero" value="<?php echo htmlspecialchars($musica_atual['genero']) ?>" required>
            </div>
            <div class="form-group" style="background: transparent;">
                <button type="submit">Editar Musica</button>
            </div>
            <?php
            if (isset($resultado)) {
                if ($resultado) {
                    echo '<p style="color: green; text-align: center;">Musica alterada com sucesso!</p>';
                } else {
                    echo '<p class="cardErro" id="cardErro">Erro ao alterar musica. Tente novamente <i class="fa-solid fa-xmark iconX" id="iconX" onclick="fechar()"></i></p>';
                }
            }  
            ?>
        </form>
    </div>
