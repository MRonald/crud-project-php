<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Crud Project</title>
    <script src="https://kit.fontawesome.com/407f74df21.js" crossorigin="anonymous"></script>
    <script src="../scripts/menu.js" defer></script>
    <script src="../scripts/masks.js" defer></script>
    <link rel="stylesheet" href="../styles/global.css"/>
</head>
<body>
    <header class="header-main">
        <nav class="menu">
            <i class="fas fa-bars" onclick="showMenu()"></i>
            <div class="menu-side" id="menu-side">
                <i class="fas fa-times" onclick="hideMenu()"></i>
                <ul>
                    <li>
                        <a href="../index.html">
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="../clientes.php">
                            Cliente
                        </a>
                    </li>
                    <li>
                        <a href="../produtos.php">
                            Produto
                        </a>
                    </li>
                    <li>
                        <a href="../pedidos.php">
                            Pedido
                        </a>
                    </li>
                    <li>
                        <a href="../migration-data">
                            Migrar dados
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <h1>Crud Project</h1>
    </header>
    <main class="content-main" id="content-main">
        <?php
            include_once('../php/handleData.php');
            include_once('../php/connection.php');
            if ($_GET) {
                /*
                 * O GET vem da listagem de clientes indicando qual
                 * cliente o usuário quer editar.
                 */
                $resultQuery = $connection->query('SELECT nome_cliente FROM cliente WHERE id=' . $_GET['id']);
                $data = $resultQuery->fetchAll();
                echo "Atualizando dados de " . $data[0][0];
                $id = $_GET['id'];
            } elseif ($_POST) {
                /*
                 * O POST vem do formulário da própria página
                 * com os dados que serão atualizados.
                 * Aqui eu faço uma busca no banco de dados para que
                 * todos os dados que não forem informados permaneçam iguais.
                 */
                $id = $_POST['id'] ?? null;
                $resultQuery = $connection->query('SELECT * FROM cliente WHERE id=' . $id);
                $dataClient = $resultQuery->fetchAll();

                $name = $_POST['nome'] != null ? $_POST['nome'] : $dataClient[0]['nome_cliente'];
                $cpf = unformatCpf($_POST['cpf']) != null ? unformatCpf($_POST['cpf']) : $dataClient[0]['cpf'];
                $email = $_POST['email'] != null ? $_POST['email'] : $dataClient[0]['email'];

                $connection->exec("UPDATE cliente SET nome_cliente='$name', cpf='$cpf', email='$email' WHERE id=$id ");
                unset($connection);
                echo "$name foi atualizado com sucesso.";
            }
        ?>
        <!--
            Criar classe para formatar o formulário
        -->
        <section class="screen-register">
            <form method="POST" action="./cliente.php">
                <input type="hidden" value="<?php echo $_GET['id'] ?? null; ?>" name="id" required/>
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome"/>
                <label for="cpf">CPF:</label>
                <input type="text" id="cpf" name="cpf"/>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email"/>
                <input type="submit" value="Atualizar"/>
            </form>
        </section>
    </main>
</body>
</html>
