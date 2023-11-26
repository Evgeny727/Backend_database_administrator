<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Изменение статуса заказа</title>
    <link rel="stylesheet" href="../styles/styleUpdate.css">
    
</head>
<body>
    <div>
    <?php
        require_once "../models/order_status.php";
        require_once "../controllers/order_statusDB.php";
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $component = new StatusDB();
            $status = $component->getStatusByID($id);
            if($status){
                echo "<form action='update_order_status.php' method='POST'>";
                $status = $status->getStatus();
                echo "<p>Статус заказа: <input type='text' name='status' value='$status' /></p>";
                echo "<input type='hidden' name='id' value='$id' id='id'/>";
                echo "<input type='submit' value='Изменить статус заказа' />";
                echo "<a href='../tables/index_order_status.php'>Назад к таблице</a>";
                echo "</form>";
            }
        }
        elseif(isset($_POST['id']) && isset($_POST['status'])){
            $id = $_POST['id'];
            $status = $_POST['status'];
            $obj = new Status($id, $status);
            $component = new StatusDB();
            $result = $component->ifAlreadyExists($status);
            if(!$result){
                $success = $component->updateStatus($obj);
                if($success){
                    http_response_code(201);
                    echo "Статус заказа успешно изменён. <a href='../tables/index_order_status.php'>Назад к таблице</a>";
                }else{
                    http_response_code(503);
                    echo "Невозможно изменить статус заказа. <a href='../tables/index_order_status.php'>Назад к таблице</a>";
                }
            }
            else {
                http_response_code(503);
                echo "Такой статус заказа уже существует. <a href='../tables/index_order_status.php'>Назад к таблице</a>";
            }
        }
    ?>
    </div>
</body>
</html>