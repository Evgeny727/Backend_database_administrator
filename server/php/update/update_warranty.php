<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Изменение гарантийного сертификата</title>
    <link rel="stylesheet" href="../styles/styleUpdate.css">
    
</head>
<body>
    <div>
    <?php
        require_once "../models/order.php";
        require_once "../controllers/orderDB.php";
        require_once "../models/warranty.php";
        require_once "../controllers/warrantyDB.php";
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $component = new WarrantyDB();
            $warranty = $component->getWarrantyByID($id);
            if($warranty){
                $orderDB = new OrderDB();
                $orders = $orderDB->getOrder();
                echo "<form action='update_warranty.php' method='POST'>";
                $id_order = $warranty->getIdOrder();
                $valid_until = $warranty->getValidUntil();
                echo "<p>Id заказов:</p>";
                foreach($orders as $order){
                    $id1 = $order->getId();
                    if($id_order === $id1){
                        $isChecked = 'checked';
                    }
                    else{
                        $isChecked = '';
                    }
                    echo "<p><input type='radio' name='id_order' value='" . $id1 . "' $isChecked />" . $id1 . "</p>";
                }
                echo "<p>Действителен до: <input type='date' name='valid_until' value='$valid_until' /></p>";
                echo "<input type='hidden' name='id' value='$id' id='id'/>";
                echo "<input type='submit' value='Изменить гарантийный сертификат' />";
                echo "<a href='../tables/index_warranty.php'>Назад к таблице</a>";
                echo "</form>";
            }
        }
        elseif(isset($_POST['id']) && isset($_POST['id_order']) && isset($_POST['valid_until'])){
            $id = $_POST['id'];
            $id_order = $_POST['id_order'];
            $valid_until = $_POST['valid_until'];
            $obj = new Warranty($id, $id_order, $valid_until);
            $component = new WarrantyDB();
            $result = $component->ifAlreadyExists($id_order, $valid_until);
            if(!$result){
                $success = $component->updateWarranty($obj);
                if($success){
                    http_response_code(201);
                    echo "Гарантийный сертификат успешно изменён. <a href='../tables/index_warranty.php'>Назад к таблице</a>";
                }else{
                    http_response_code(503);
                    echo "Невозможно изменить гарантийный сертификат. <a href='../tables/index_warranty.php'>Назад к таблице</a>";
                }
            }
            else {
                http_response_code(503);
                echo "Такой гарантийный сертификат уже существует. <a href='../tables/index_warranty.php'>Назад к таблице</a>";
            }
        }
    ?>
    </div>
</body>
</html>