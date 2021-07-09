<?php

    $hostname = 'localhost';
    $databaseName = 'projeto_php_estruturado';
    $user = 'root';
    $password = '';

    $databaseConection;

    try {
        $databaseConection = new PDO("mysql:host=$hostname;dbname=$databaseName;", $user, $password);
        $databaseConection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Seu pc vai explodir" . $e->getMessage();
    }