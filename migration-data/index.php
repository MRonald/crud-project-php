<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            background-color: #fff;
        }
        * {
            font-size: 20px;
            font-weight: bolder;
            font-family: Arial, Helvetica, sans-serif;
        }
    </style>
</head>
<body>
    <pre>
        <?php
            ini_set('display_errors',1);
            ini_set('display_startup_erros',1);
            error_reporting(E_ALL);

            $hostname = 'localhost';
            $oldDatabaseName = 'projeto_php';
            $newDatabaseName = 'projeto_php_estruturado';
            $user = 'root';
            $password = '';

            try {
                // Conexão com o banco antigo
                $oldDatabaseConn = new PDO("mysql:host=$hostname;dbname=$oldDatabaseName", $user, $password);
                $oldDatabaseConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                // Conexão com o novo banco
                $newDatabaseConn = new PDO("mysql:host=$hostname;dbname=$newDatabaseName", $user, $password);
                $newDatabaseConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // Pegando os registros do banco antigo
                $oldRegisters = $oldDatabaseConn->query("select * from pedido");

                foreach ($oldRegisters as $register) {
                    // Inserindo dado do cliente
                    $clientInsert = $newDatabaseConn->prepare("INSERT INTO cliente (nome_cliente, cpf, email) VALUES (:nome, :cpf, :email)");
                    $clientInsert->execute(array(
                        ":nome" => $register["nome_cliente"],
                        ":cpf" => $register["cpf"],
                        ":email" => $register["email"]
                    ));
                    echo "<p>Cliente inserido...</p>";
                    
                    // Inserindo dado do produto
                    $productInsert = $newDatabaseConn->prepare(
                        "INSERT INTO produto (cod_barras, nome_produto, valor_unitario) VALUES (:codBarras, :nomeProduto, :valorUnitario)"
                    );
                    $productInsert->execute(array(
                        ":codBarras" => $register["cod_barras"],
                        ":nomeProduto" => $register["nome_produto"],
                        ":valorUnitario" => $register["valor_unitario"]
                    ));
                    echo "<p>Produto inserido...</p>";
                }

                echo "<hr />";
            } catch (PDOException $e) {
                echo "Falha no erro :C - " . $e->getMessage(); 
            } finally {
                $oldDatabaseConn = null;
                $newDatabaseConn = null;
            }

            // Inserindo dados do pedido
            try {
                // Conexão com o banco antigo
                $oldDatabaseConn = new PDO("mysql:host=$hostname;dbname=$oldDatabaseName", $user, $password);
                $oldDatabaseConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                // Conexão com o novo banco
                $newDatabaseConn = new PDO("mysql:host=$hostname;dbname=$newDatabaseName", $user, $password);
                $newDatabaseConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // Pegando os registros do banco antigo
                $oldRegisters = $oldDatabaseConn->query("select * from pedido");

                
                foreach ($oldRegisters as $register) {
                    // Inserindo dado do pedido
                    $orderInsert = $newDatabaseConn->prepare(
                        "INSERT INTO pedido (data_pedido, id_cliente, id_produto, quantidade) VALUES (:dataPedido, :idCliente, :idProduto, :quantidade)"
                    );

                    // Recuperando id do cliente através do cpf
                    $resultQuery = $newDatabaseConn->query("select id from cliente where cpf = " . $register["cpf"]);
                    $idCliente;
                    foreach ($resultQuery as $result) {
                        $idCliente = $result["id"];
                    }

                    // Recuperando id do produto através do código de barras
                    $resultQuery = $newDatabaseConn->query("select id from produto where cod_barras = " . $register["cod_barras"]);
                    $idProduto;
                    foreach ($resultQuery as $result) {
                        $idProduto = $result["id"];
                    }

                    $orderInsert->execute(array(
                        ":dataPedido" => $register["dt_pedido"],
                        ":idCliente" => $idCliente,
                        ":idProduto" => $idProduto,
                        ":quantidade" => $register["quantidade"]
                    ));
                    echo "<p>Pedido inserido...</p>";
                }

                echo "<hr /> <p>Select de todos os dados no novo banco</p>";
                
                // Testando conexão com o novo banco
                $newData = $newDatabaseConn->query("
                    select p.numero_pedido, p.data_pedido, c.nome_cliente, pr.nome_produto, pr.valor_unitario, p.quantidade
                    from pedido p 
                    join cliente c on p.id_cliente = c.id 
                    join produto pr on p.id_produto = pr.id;
                ");

                foreach ($newData as $result) {
                    print_r($result);
                }
            } catch (PDOException $e) {
                echo "Falha no erro :C - " . $e->getMessage(); 
            } finally {
                $oldDatabaseConn = null;
                $newDatabaseConn = null;
            }
        ?>
    </pre>
</body>
</html>
