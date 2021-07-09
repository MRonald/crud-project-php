<?php

    $id = $_GET['id'] ?? -1;

    if ($id == -1) {
        echo "<p>Erro! Não é possível editar o cliente informado.</p>";
    }
