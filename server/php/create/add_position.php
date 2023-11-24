<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/styleAdd.css">
    <title>Добавление должности</title>
</head>

<body>
    <?php
    require_once "../controllers/positionDB.php";
    if(isset($_POST['position'])){
        $position = $_POST['position'];
        $component = new PositionDB();
        $result = $component->ifAlreadyExists($position);
        if(!$result){
            $success = $component->addPosition($position);
            if($success){
                http_response_code(201);
                echo "Должность успешно добавлена. <a href='../tables/index_position.php'>Назад к таблице</a>";
            }else{
                http_response_code(503);
                echo "Невозможно добавить должность. <a href='../tables/index_position.php'>Назад к таблице</a>";
            }
        }
        else {
            http_response_code(503);
            echo "Такая должность уже существует. <a href='../tables/index_position.php'>Назад к таблице</a>";
        }
    }
    else{
        echo "<h1>Добавление должности</h1>";
        echo "<form action='add_position.php' method='POST'>";
        echo "<p>Название должности: <input type='text' name='position' /></p>";
        echo "<input type='submit' value='Добавить должность' />";
        echo "<a href='../tables/index_position.php'>Назад к таблице</a>";
        echo "</form>";
    }
    ?>
</body>

</html>
