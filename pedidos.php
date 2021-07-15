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
            <div class="date">Data e Hora</div>
            <div class="client">Nome Cliente</div>
            <div class="product">Nome Produto</div>
            <div class="unitary-value">Valor Unitário</div>
            <div class="amount">Quantidade</div>
            <div class="total">Valor Total</div>
            <div class="actions-order">Ações</div>
        </div>
        <?php
            include_once('./php/handleData.php');
            include_once('./php/connection.php');

            $resultsSelect = $connection->query('
                SELECT p.numero_pedido, p.data_pedido, c.nome_cliente, pr.nome_produto, p.quantidade, pr.valor_unitario
                FROM pedido p
                JOIN cliente c ON p.id_cliente = c.id
                JOIN produto pr ON p.id_produto = pr.id;
            ');
            $orders = $resultsSelect->fetchAll();

            if (empty($orders)) {
                echo "<p class='messageUser'>Nenhum pedido cadastrado.</p>";
            } else {
                foreach ($orders as $order) {
                echo '
                        <div class="result-data">
                            <div class="date">'. formatDate($order['data_pedido']) .'</div>
                            <div class="client">'. $order['nome_cliente'] .'</div>
                            <div class="product">'. $order['nome_produto'] .'</div>
                            <div class="unitary-value">'. formatMoneyValue($order['valor_unitario']) .'</div>
                            <div class="amount">'. $order['quantidade'] .'</div>
                            <div class="total">'. calcTotal($order['valor_unitario'], $order['quantidade']) .'</div>
                            <div class="actions-order">
                                <a href="./editar/pedido.php?id='. $order['numero_pedido'] .'">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="./apagar/pedido.php?id='. $order['numero_pedido'] .'">
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
