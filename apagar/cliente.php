<?php
    include_once('../connection.php');

    $id = $_GET['id'] ?? -1;

    if ($id != -1) {
        $connection->exec('DELETE FROM pedido WHERE id_cliente=' . $id);
        $connection->exec('DELETE FROM cliente WHERE id=' . $id);
        unset($connection);
    }
?>
<script>
    window.open(document.referrer, '_self');
</script>
