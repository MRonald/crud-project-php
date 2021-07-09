<?php
    include_once('../connection.php');

    $id = $_GET['id'] ?? -1;

    if ($id == -1) {
        echo "<p>Erro! Não é possível apagar o cliente informado.</p>";
    } else {
        $databaseConection->exec("DELETE FROM pedido WHERE id_cliente=".$id);
        $databaseConection->exec("DELETE FROM cliente WHERE id=" . $id);
        unset($databaseConection);
        echo "<p>Cliente apagado.</p>";
    }
?>
<script>
    // window.location.href = "https://google.com";
    // history.back();
    window.open(document.referrer,'_self');
</script>