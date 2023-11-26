<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/styleAdd.css">
    <title>Добавление гарантийного сертификата</title>
</head>

<body>
    <?php
    require_once "../models/order.php";
    require_once "../controllers/orderDB.php";
    require_once "../controllers/warrantyDB.php";
    if(isset($_POST['id_order']) && isset($_POST['valid_until'])){
        $id_order = $_POST['id_order'];
        $valid_until = $_POST['valid_until'];
        $component = new WarrantyDB();
        $result = $component->ifAlreadyExists($id_order, $valid_until);
        if(!$result){
            $success = $component->addWarranty($id_order, $valid_until);
            if($success){
                http_response_code(201);
                echo "Гарантийный сертификат успешно добавлен. <a href='../tables/index_warranty.php'>Назад к таблице</a>";
            }else{
                http_response_code(503);
                echo "Невозможно добавить гарантийный сертификат. <a href='../tables/index_warranty.php'>Назад к таблице</a>";
            }
        }
        else {
            http_response_code(503);
            echo "Такой гарантийный сертификат уже существует. <a href='../tables/index_warranty.php'>Назад к таблице</a>";
        }
    }
    else{
        $orderDB = new OrderDB();
        $orders = $orderDB->getOrder();
        echo "<h1>Добавление гарантийного сертификата</h1>";
        echo "<form action='add_warranty.php' method='POST'>";
        echo "<p>Id заказов:</p>";
        foreach($orders as $order){
            $id = $order->getId();
            echo "<p><input type='radio' name='id_order' value='" . $id . "' />" . $id . "</p>";
        }
        echo "<p>Действителен до: <input type='date' name='valid_until' /></p>";
        echo "<input type='submit' value='Добавить гарантийный сертификат' />";
        echo "<a href='../tables/index_warranty.php'>Назад к таблице</a>";
        echo "</form>";
    }
    ?>
</body>

</html>
