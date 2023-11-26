<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/styleAdd.css">
    <title>Добавление статуса заказа</title>
</head>

<body>
    <?php
    require_once "../controllers/order_statusDB.php";
    if(isset($_POST['status'])){
        $status = $_POST['status'];
        $component = new StatusDB();
        $result = $component->ifAlreadyExists($status);
        if(!$result){
            $success = $component->addStatus($status);
            if($success){
                http_response_code(201);
                echo "Статус заказа успешно добавлен. <a href='../tables/index_order_status.php'>Назад к таблице</a>";
            }else{
                http_response_code(503);
                echo "Невозможно добавить статус заказа. <a href='../tables/index_order_status.php'>Назад к таблице</a>";
            }
        }
        else {
            http_response_code(503);
            echo "Такой статус заказа уже существует. <a href='../tables/index_order_status.php'>Назад к таблице</a>";
        }
    }
    else{
        echo "<h1>Добавление статуса заказа</h1>";
        echo "<form action='add_order_status.php' method='POST'>";
        echo "<p>Статус заказа: <input type='text' name='status' /></p>";
        echo "<input type='submit' value='Добавить статус заказа' />";
        echo "<a href='../tables/index_order_status.php'>Назад к таблице</a>";
        echo "</form>";
    }
    ?>
</body>

</html>
