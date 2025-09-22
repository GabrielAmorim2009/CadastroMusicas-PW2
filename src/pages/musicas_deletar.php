<?php
    require_once __DIR__ . '/../data/connection.php';
    require_once __DIR__ . '/../model/Musicas.php';

    
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

    $resultado = $musica->deletar($id);

    if ($resultado) {               
        header('Location: /?deleted=true');
    } else {
        echo '<p style="color: red; text-align: center;">Erro ao deletar musica. Tente novamente.</p>';
        echo '<p style="text-align: center;"><a href="/">Voltar para a lista de musicas</a></p>';
    }