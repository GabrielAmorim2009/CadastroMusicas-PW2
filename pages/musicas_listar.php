<title>Listar Musicas</title>
    <div class="container">
        <form action="" method="post" class="search-form">
            <h1 class="titulo" style="color: white;">Listar Musicas</h1>
            <input type="search" name="buscar" id="buscar" value="<?php echo htmlspecialchars($_POST['buscar'] ?? ''); ?>" placeholder="Buscar musicas..." class="iptBuscar">
        </form>
        <table>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Artista</th>
                <th>Ano de Lançamento</th>
                <th>Album</th>
                <th>Genero</th>
                <th>Criação</th>
                <th>Alteração</th>
                <th>Ação</th>
            </tr>
            <?php
            require_once __DIR__ . '/../data/connection.php';
            require_once __DIR__ . '/../model/Musicas.php';
            // *** Se queiser saber mais, descomente as linhas abaixo para depuração (debugging)
            // var_dump($conn);
            // var_dump(__DIR__ . '/../data/connection.php');
            // var_dump(__DIR__ . '/../model/Musicas.php');

            $musica = new Musicas($conn);
            $lista = $musica->consultarTodos(htmlspecialchars($_POST['buscar'] ?? ''));

            foreach ($lista as $item) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($item['id']) . "</td>";
                echo "<td>" . htmlspecialchars($item['nome']) . "</td>";
                echo "<td>" . htmlspecialchars($item['artista']) . "</td>";
                echo "<td>" . htmlspecialchars($item['ano_lancamento']) . "</td>";
                echo "<td>" . htmlspecialchars($item['album']) . "</td>";
                echo "<td>" . htmlspecialchars($item['genero']) . "</td>";
                echo "<td>" . htmlspecialchars($item['createAt']) . "</td>";
                echo "<td>" . htmlspecialchars($item['updateAt']) . "</td>";
                echo "<td class='tdIcons'><a href='?page=editar&id=" . $item['id'] . "'><i class='fa-solid fa-pen-to-square iconEdit'></i></a> <a href='?page=deletar&id=" . $item['id'] . "' onclick=\"return confirm('Tem certeza que deseja deletar esta musica?');\"><i class='fa-solid fa-trash iconDelete'></i></a></td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>