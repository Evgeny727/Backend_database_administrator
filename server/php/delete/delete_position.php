<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Удаление должности</title>
</head>
<body>
<?php
        require "../controllers/positionDB.php";
        $id = $_GET['id'];
        $position = new PositionDB();
        $result = $position->deletePosition($id);
        if (!$result) {
            die('Invalid query');
        }
        echo "Должность успешно удалена.";
        echo "<a href='../tables/index_position.php'>Назад к таблице</a>";


?>
</body>
</html>
