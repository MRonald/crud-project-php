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
            <form method="POST" action="./produto.php" class="form-standard">
                <?php
                    include_once('../php/handleData.php');
                    include_once('../php/connection.php');
                    if ($_GET) {
                        /*
                         * O GET vem da listagem de clientes indicando qual
                         * produto o usuário quer editar.
                         */
                        $resultQuery = $connection->query('SELECT id, nome_produto FROM produto WHERE id=' . $_GET['id']);
                        $data = $resultQuery->fetchAll();
                        echo "<div class='message-wrapper'><p class='generic'>Atualizando dados do produto " . $data[0]['id'] . " (" . $data[0]['nome_produto'] . ")</p></div>";
                        // $id = $_GET['id']; @APAGAR@
                    } elseif ($_POST) {
                        /*
                         * O POST vem do formulário da própria página
                         * com os dados que serão atualizados.
                         * Aqui eu faço uma busca no banco de dados para que
                         * todos os dados que não forem informados permaneçam iguais.
                         */
                        $id = $_POST['id'] ?? null;
                        $resultQuery = $connection->query('SELECT * FROM produto WHERE id=' . $id);
                        $dataProduct = $resultQuery->fetchAll();

                        $code = $_POST['code'] != null ? $_POST['code'] : $dataProduct[0]['cod_barras'];
                        $value = unformatMoneyValue($_POST['valueMoney']) != null ? unformatMoneyValue($_POST['valueMoney']) : $dataProduct[0]['valor_unitario'];
                        $name = $_POST['name'] != null ? $_POST['name'] : $dataProduct[0]['nome_produto'];

                        $connection->exec("UPDATE produto SET nome_produto='$name', cod_barras='$code', valor_unitario='$value' WHERE id=$id ");
                        unset($connection);
                        echo "<div class='message-wrapper'><p class='success'>Produto $id atualizado com sucesso.</p></div>";
                    }
                ?>

                <input type="hidden" value="<?php echo $_GET['id'] ?? null; ?>" name="id" required/>
                <label for="nome">Nome:</label>
                <input type="text" id="name" name="name"/>
                <label for="code">Código de barras:</label>
                <input type="text" id="code" name="code"/>
                <label for="value">Valor Unitário:</label>
                <input type="text" id="valueMoney" name="value" maxlength="13"/>
                <input type="submit" value="Atualizar"/>
            </form>
        </section>
    </main>
</body>
</html>
