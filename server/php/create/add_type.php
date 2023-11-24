<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/styleAdd.css">
    <title>Добавление типа комплектующих</title>
</head>

<body>
    <?php
    require_once "../controllers/component_typeDB.php";
    if(isset($_POST['type_name'])){
        $typeName = $_POST['type_name'];
        $component = new Component_typeDB();
        $result = $component->ifAlreadyExists($typeName);
        if(!$result){
            $success = $component->addType($typeName);
            if($success){
                http_response_code(201);
                echo "Тип комплектующих был добавлен. <a href='../tables/index_type.php'>Назад к таблице</a>";
            }else{
                http_response_code(503);
                echo "Невозможно добавить тип комплектующих. <a href='../tables/index_type.php'>Назад к таблице</a>";
            }
        }
        else {
            http_response_code(503);
            echo "Такой тип комплектующих уже существует. <a href='../tables/index_type.php'>Назад к таблице</a>";
        }
    }
    else{
        echo "<h1>Добавление типа комплектующих</h1>";
        echo "<form action='add_type.php' method='POST'>";
        echo "<p>Название типа комплектующей: <input type='text' name='type_name' /></p>";
        echo "<input type='submit' value='Добавить тип комплектующих' />";
        echo "<a href='../tables/index_type.php'>Назад к таблице</a>";
        echo "</form>";
    }
    ?>
</body>

</html>
