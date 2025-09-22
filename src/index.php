<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <link rel="stylesheet" href="./css/style.css">
    <link rel="shortcut icon" href="https://static.vecteezy.com/system/resources/previews/027/224/002/non_2x/spotify-3d-logo-free-png.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script>
    function limparParametrosURL() {
        if (window.location.search) {
            window.history.replaceState({}, document.title, window.location.pathname);
        }
    }
</script>
</head>
<body>
    <nav class="headerSite">
        <a href="?page=cadastrar">Cadastrar nova musica</a>
        <a href="?page=listar">Listar musicas</a>
    </nav>
    <div id="container" style="height: calc(98vh - 50px); overflow-y: auto; padding: 20px; box-sizing: border-box;">
        <?php
            if (isset($_GET['page']) && $_GET['page'] === 'cadastrar') {
                require_once __DIR__ . '/pages/musicas_cadastrar.php';
            } 
            elseif (isset($_GET['page']) && $_GET['page'] === 'editar') {
                require_once __DIR__ . '/pages/musicas_editar.php';
            }
            elseif (isset($_GET['page']) && $_GET['page'] === 'deletar') {
                require_once __DIR__ . '/pages/musicas_deletar.php';
            }
            else {
                require_once __DIR__ . '/pages/musicas_listar.php';
                if(isset($_GET['deleted']) && $_GET['deleted'] === 'true') {
                    echo '<script> alert("Musica deletada com sucesso."); limparParametrosURL();</script>';
                }
            }
        ?>
    </div>
<script src="./js/script.js"></script>
</body>
</html>

