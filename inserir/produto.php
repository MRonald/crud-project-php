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
                    if ($_POST) {
                        $name = $_POST['name'] ?? null;
                        $code = $_POST['code'] ?? null;
                        $value = $_POST['value'] ?? null;

                        include_once('../php/handleData.php');
                        include_once('../php/connection.php');
                        // echo "INSERT INTO produto VALUES (DEFAULT, '$code', '$name', " . unformatMoneyValue($value) . ")";
                        $connection->exec("INSERT INTO produto VALUES (DEFAULT, '$code', '$name', " . unformatMoneyValue($value) . ")");
                        unset($connection);
                        echo "<div class='message-wrapper'><p class='success'>$name foi inserido com sucesso.</p></div>";
                    }
                ?>

                <label for="nome">Nome:</label>
                <input type="text" id="name" name="name" maxlength="255"/>
                <label for="code">Código de barras:</label>
                <input type="text" id="code" name="code" maxlength="40"/>
                <label for="value">Valor Unitário:</label>
                <input type="text" id="valueMoney" name="value" maxlength="13"/>
                <input type="submit" value="Cadastrar"/>
            </form>
        </section>
    </main>
</body>
</html>
