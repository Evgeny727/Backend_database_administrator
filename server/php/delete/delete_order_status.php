<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Удаление статуса заказа</title>
</head>
<body>
<?php
        require "../controllers/order_statusDB.php";
        $id = $_GET['id'];
        $status = new StatusDB();
        $result = $status->deleteStatus($id);
        if (!$result) {
            die('Invalid query');
        }
        echo "Статус заказа успешно удалён.";
        echo "<a href='../tables/index_order_status.php'>Назад к таблице</a>";


?>
</body>
</html>
