<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            background-color: #666;
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
            $password = 'loginRoot';

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
                    // $clientInsert = $newDatabaseConn->prepare("INSERT INTO cliente (nome_cliente, cpf, email) VALUES (:nome, :cpf, :email)");
                    // $clientInsert->execute(array(
                    //     ":nome" => $register["nome_cliente"],
                    //     ":cpf" => $register["cpf"],
                    //     ":email" => $register["email"]
                    // ));
                    // echo "<p>Cliente inserido...</p>";
                    
                    // Inserindo dado do produto
                    // $productInsert = $newDatabaseConn->prepare(
                    //     "INSERT INTO produto (cod_barras, nome_produto, valor_unitario) VALUES (:codBarras, :nomeProduto, :valorUnitario)"
                    // );
                    // $productInsert->execute(array(
                    //     ":codBarras" => $register["cod_barras"],
                    //     ":nomeProduto" => $register["nome_produto"],
                    //     ":valorUnitario" => $register["valor_unitario"]
                    // ));
                    // echo "<p>Produto inserido...</p>";
                    
                    // Inserindo dado do pedido
                    // $orderInsert = $newDatabaseConn->prepare(
                    //     "INSERT INTO pedido (data_pedido, id_cliente, id_produto, quantidade) VALUES (:dataPedido, :idCliente, :idProduto, :quantidade)"
                    // );
                    $idCliente = $newDatabaseConn->prepare("select id from cliente where cpf = " . $register["cpf"]);
                    print_r($idCliente);
                    // $orderInsert->execute(array(
                    //     ":dataPedido" => $register["data_pedido"],
                    //     ":idCliente" => "",
                    //     ":idProduto" => "",
                    //     ":quantidade" => $register["quantidade"]
                    // ));
                    echo "<p>Pedido inserido...</p>";
                }

                echo "<hr />";

                // Testando conexão com o novo banco
                $newTable = $newDatabaseConn->query("select * from produto");

                foreach ($newTable as $result) {
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
