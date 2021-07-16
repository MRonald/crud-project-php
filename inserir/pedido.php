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
        <section class="screen-register">
        <form method="POST" action="./pedido.php" class="form-standard">
                <?php
                    ini_set('display_errors',1);
                    ini_set('display_startup_erros',1);
                    error_reporting(E_ALL);
                    include_once('../php/handleData.php');
                    include_once('../php/connection.php');

                    if ($_POST) {
                        $client = $_POST['client'] ?? null;
                        $product = $_POST['product'] ?? null;
                        $amount = $_POST['amount'] ?? null;

                        $connection->exec("INSERT INTO pedido VALUES (DEFAULT, now(), $client, $product, $amount)");
                        unset($connection);
                        echo "<div class='message-wrapper'><p class='success'>O pedido foi registrado com sucesso.</p></div>";
                    } else {
                        // Pegando todos os clientes
                        $resultQuery = $connection->query('SELECT id, nome_cliente FROM cliente');
                        $clients = $resultQuery->fetchAll();

                        // Pegando todos os produtos
                        $resultQuery = $connection->query('SELECT id, nome_produto FROM produto');
                        $products = $resultQuery->fetchAll();
                    }
                ?>

                <label for="client">Cliente:</label>
                <select name="client" id="client">
                    <?php
                        foreach ($clients as $client) {
                            if ($data[0]['id_cliente'] != $client['id']) {
                                echo "<option value=". $client['id'] .">". $client['nome_cliente'] ."</option>";
                            } else {
                                echo "<option value=". $client['id'] ." selected>". $client['nome_cliente'] ."</option>";
                            }
                        }
                    ?>
                </select>

                <label for="product">Produto:</label>
                <select name="product" id="product">
                    <?php
                        foreach ($products as $product) {
                            if ($data[0]['id_produto'] != $product['id']) {
                                echo "<option value=". $product['id'] .">". $product['nome_produto'] ."</option>";
                            } else {
                                echo "<option value=". $product['id'] ." selected>". $product['nome_produto'] ."</option>";
                            }
                        }
                    ?>
                </select>

                <label for="amount">Quantidade:</label>
                <input type="number" id="amount" name="amount" min="1"/>

                <input type="submit" value="Cadastrar"/>
            </form>
        </section>
    </main>
</body>
</html>
