<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Crud Project</title>
    <script src="https://kit.fontawesome.com/407f74df21.js" crossorigin="anonymous"></script>
    <script src="scripts/menu.js" defer></script>
    <link rel="stylesheet" href="styles/global.css"/>
    <link rel="stylesheet" href="styles/tabela-dados.css"/>
</head>
<body>
    <header class="header-main">
        <nav class="menu">
            <i class="fas fa-bars" onclick="showMenu()"></i>
            <div class="menu-side" id="menu-side">
                <i class="fas fa-times" onclick="hideMenu()"></i>
                <ul>
                    <li>
                        <a href="./index.html">
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="./clientes.php">
                            Cliente
                        </a>
                    </li>
                    <li>
                        <a href="./produtos.php">
                            Produto
                        </a>
                    </li>
                    <li>
                        <a href="./pedidos.php">
                            Pedido
                        </a>
                    </li>
                    <li>
                        <a href="./migration-data">
                            Migrar dados
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <h1>Crud Project</h1>
    </header>
    <main class="content-main" id="content-main">
        <div class="titles-data">
            <div class="name">Nome</div>
            <div class="cpf">CPF</div>
            <div class="email">Email</div>
            <div class="actions">Ações</div>
        </div>
        <?php
            include_once('./php/handleData.php');
            include_once('./php/connection.php');

            $resultsSelect = $connection->query('SELECT * FROM cliente');
            $clients = $resultsSelect->fetchAll();

            if (empty($clients)) {
                echo "<p class='messageUser'>Nenhum cliente cadastrado.</p>";
            } else {
                foreach ($clients as $client) {
                echo '
                        <div class="result-data">
                            <div class="name">'. $client['nome_cliente'] .'</div>
                            <div class="cpf">'. formatCpf($client['cpf']) .'</div>
                            <div class="email">'. $client['email'] .'</div>
                            <div class="actions">
                                <a href="./editar/cliente.php?id='. $client['id'] .'">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="./apagar/cliente.php?id='. $client['id'] .'">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </div>
                        </div>
                    ';
                }
            }

            unset($connection);
        ?>
    </main>
</body>
</html>
