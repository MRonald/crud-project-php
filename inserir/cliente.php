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
    <link rel="stylesheet" href="../styles/tabela-dados.css"/>
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
                        <a href="../pedidos.html">
                            Cliente
                        </a>
                    </li>
                    <li>
                        <a href="../pedidos.html">
                            Produto
                        </a>
                    </li>
                    <li>
                        <a href="../pedidos.html">
                            Pedido
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <h1>Crud Project</h1>
    </header>
    <main class="content-main" id="content-main">
        <?php
            function unformatCpf($cpf) {
                $pattern = '/\D/i';
                $replacement = '';
                return preg_replace($pattern, $replacement, $cpf);
            }

            $name = $_POST['nome'] ?? null;
            $cpf = $_POST['cpf'] ?? null;
            $email = $_POST['email'] ?? null;

            if ($name != null && $cpf != null && $email != null) {
                include_once('../connection.php');
                $connection->exec("INSERT INTO cliente VALUES (DEFAULT, $name, ". unformatCpf($cpf) .", $email)");
                unset($connection);
                echo "$name foi inserido com sucesso.";
            }
        ?>
        <!--
            Criar classe para formatar o formulário
        -->
        <section class="screen-register">
            <form method="POST" action="./cliente.php">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" required/>
                <label for="cpf">CPF:</label>
                <input type="text" id="cpf" name="cpf" required/>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required/>
                <input type="submit" value="Cadastrar"/>
            </form>
        </section>
    </main>
</body>
</html>
