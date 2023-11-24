<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Удаление товара</title>
</head>
<body>
<?php
        require "../controllers/stockDB.php";
        $id = $_GET['id'];
        $stock = new StockDB();
        $result = $stock->deleteStock($id);
        if (!$result) {
            die('Invalid query');
        }
        echo "Товар успешно удалён.";
        echo "<a href='../tables/index_stock.php'>Назад к таблице</a>";


?>
</body>
</html>
