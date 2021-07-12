<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Crud Project</title>
    <script src="https://kit.fontawesome.com/407f74df21.js" crossorigin="anonymous"></script>
    <script src="scripts/menu.js" defer></script>
    <link rel="stylesheet" href="styles/global.css" />
    <link rel="stylesheet" href="styles/tabela-dados.css" />
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
        <!-- <div class="result-data">
            <div class="name">Michael Ronald</div>
            <div class="cpf">654.915.632-65</div>
            <div class="email">meuemail@gmail.com</div>
            <div class="actions">
                <a href="editar-usuario.php?id=3">
                    <i class="fas fa-edit"></i>
                </a>
                <a href="excluir-usuario.php?id=3">
                    <i class="fas fa-trash-alt"></i>
                </a>
            </div>
        </div> -->
        <?php
            include_once('./connection.php');

            function formatCpf($cpf){
                $cpf = preg_replace("/[^0-9]/", "", $cpf);
            
                $firstBlock = substr($cpf,0,3);
                $secondBlock = substr($cpf,3,3);
                $thirdBlock = substr($cpf,6,3);
                $lastBlock = substr($cpf,-2);
                $cpfFormated = $firstBlock.".".$secondBlock.".".$thirdBlock."-".$lastBlock;
            
                return $cpfFormated;
            }

            $resultSel = $databaseConection->query("SELECT * FROM CLIENTE");

            foreach ($resultSel as $item){
                echo '
                <div class="result-data">
                    <div class="name">' . $item['nome_cliente'] .'</div>
                    <div class="cpf">' . formatCpf($item['cpf']) . '</div>
                    <div class="email">' . $item['email'] . '</div>
                    <div class="actions">
                        <a href="update/editar-cliente.php?id='.$item["id"].'">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="delete/excluir-cliente.php?id= '.$item["id"].'">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                    </div>
                </div>
            ';
            }

        ?>
    </main>
</body>
<<<<<<< HEAD:clientes.php

</html>
=======
</html>
>>>>>>> 560187c38e65655cc332e95e4d858c525b14035b:pedidos.php
