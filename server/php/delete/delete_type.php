<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Удаление типа комплектующих</title>
</head>
<body>
<?php
        require "../controllers/component_typeDB.php";
        $id = $_GET['id'];
        $component = new Component_typeDB();
        $result = $component->deleteType($id);
        if (!$result) {
            die('Invalid query');
        }
        echo "Тип комплектующих успешно удалён.";
        echo "<a href='../tables/index_type.php'>Назад к таблице</a>";


?>
</body>
</html>
