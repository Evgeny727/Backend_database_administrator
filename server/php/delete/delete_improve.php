<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Удаление комплектующей у клиента</title>
</head>
<body>
<?php
        require "../controllers/improveDB.php";
        $id = $_GET['id'];
        $improve = new ImproveDB();
        $result = $improve->deleteImprove($id);
        if (!$result) {
            die('Invalid query');
        }
        echo "Комплектующая у клиента успешно удалёна.";
        echo "<a href='../tables/index_improve.php'>Назад к таблице</a>";


?>
</body>
</html>
