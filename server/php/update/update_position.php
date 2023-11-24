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
        require_once "../models/position.php";
        require_once "../controllers/positionDB.php";
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $component = new PositionDB();
            $position = $component->getPositionByID($id);
            if($position){
                echo "<form action='update_position.php' method='POST'>";
                $position = $position->getPosition();
                echo "<p>Название должности: <input type='text' name='position' value='$position' /></p>";
                echo "<input type='hidden' name='id' value='$id' id='id'/>";
                echo "<input type='submit' value='Изменить должность' />";
                echo "<a href='../tables/index_position.php'>Назад к таблице</a>";
                echo "</form>";
            }
        }
        elseif(isset($_POST['id']) && isset($_POST['position'])){
            $id = $_POST['id'];
            $position = $_POST['position'];
            $obj = new Position($id, $position);
            $component = new PositionDB();
            $result = $component->ifAlreadyExists($position);
            if(!$result){
                $success = $component->updatePosition($obj);
                if($success){
                    http_response_code(201);
                    echo "Должность успешно изменена. <a href='../tables/index_position.php'>Назад к таблице</a>";
                }else{
                    http_response_code(503);
                    echo "Невозможно изменить должность. <a href='../tables/index_position.php'>Назад к таблице</a>";
                }
            }
            else {
                http_response_code(503);
                echo "Такая должность уже существует. <a href='../tables/index_position.php'>Назад к таблице</a>";
            }
        }
    ?>
    </div>
</body>
</html>