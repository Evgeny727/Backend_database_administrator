<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Удаление заказа</title>
</head>
<body>
<?php
        require "../controllers/orderDB.php";
        $id = $_GET['id'];
        $order = new OrderDB();
        $result = $order->deleteOrder($id);
        if (!$result) {
            die('Invalid query');
        }
        echo "Заказ успешно удалён.";
        echo "<a href='../tables/index.php'>Назад к таблице</a>";


?>
</body>
</html>
