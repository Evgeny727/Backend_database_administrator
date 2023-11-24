<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Изменение типа комплектующих</title>
    <link rel="stylesheet" href="../styles/styleUpdate.css">
    
</head>
<body>
    <div>
    <?php
        require_once "../models/component_type.php";
        require_once "../controllers/component_typeDB.php";
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $component = new Component_typeDB();
            $type = $component->getComponent_typeByID($id);
            if($type){
                echo "<form action='update_type.php' method='POST'>";
                $type = $type->getType();
                echo "<p>Название типа комплектующей: <input type='text' name='pc_part_type' value='$type' /></p>";
                echo "<input type='hidden' name='id' value='$id' id='id'/>";
                echo "<input type='submit' value='Изменить тип комплектующих' />";
                echo "<a href='../tables/index_type.php'>Назад к таблице</a>";
                echo "</form>";
            }
        }
        elseif(isset($_POST['id']) && isset($_POST['pc_part_type'])){
            $id = $_POST['id'];
            $type = $_POST['pc_part_type'];
            $obj = new Component_type($id, $type);
            $component = new Component_typeDB();
            $result = $component->ifAlreadyExists($type);
            if(!$result){
                $success = $component->updateType($obj);
                if($success){
                    http_response_code(201);
                    echo "Тип комплектующих успешно изменён. <a href='../tables/index_type.php'>Назад к таблице</a>";
                }else{
                    http_response_code(503);
                    echo "Невозможно изменить тип комплектующих. <a href='../tables/index_type.php'>Назад к таблице</a>";
                }
            }
            else {
                http_response_code(503);
                echo "Такой тип комплектующих уже существует. <a href='../tables/index_type.php'>Назад к таблице</a>";
            }
        }
    ?>
    </div>
</body>
</html>