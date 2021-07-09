<?php

    $hostname = 'localhost';
    $databaseName = 'projeto_php_estruturado';
    $user = 'root';
    $password = 'loginRoot';

    $connection;

    try {
        $connection = new PDO("mysql:host=$hostname;dbname=$databaseName", $user, $password);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "<p class='messageUser'>Erro ao acessar o banco de dados. Por favor atualize a página. Caso o erro persista tente novamente mais tarde.</p>";
    }
