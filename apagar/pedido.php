<?php
    include_once('../php/connection.php');

    $id = $_GET['id'] ?? -1;

    if ($id != -1) {
        $connection->exec('DELETE FROM pedido WHERE numero_pedido=' . $id);
        unset($connection);
    }
?>
<script>
    window.open(document.referrer, '_self');
</script>
