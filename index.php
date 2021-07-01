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
            $database = 'projeto_php';
            $user = 'root';
            $password = 'loginRoot';

            try {
                $conn = new PDO("mysql:host=$hostname;dbname=$database", $user, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = 'select * from pedido';
                $results = $conn->query($sql);
                // print_r($req);
                foreach ($results as $result) {
                    print_r($result);
                }
            } catch (PDOException $e) {
                echo 'Falha no erro :C - ' . $e->getMessage(); 
            }
        ?>
    </pre>
</body>
</html>
