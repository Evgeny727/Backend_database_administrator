<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/styleAdd.css">
    <title>Добавление нового заказа</title>
</head>

<body>
    <?php
    require_once "../models/client.php";
    require_once "../models/employee.php";
    require_once "../models/order_status.php";
    require_once "../controllers/orderDB.php";
    require_once "../controllers/clientDB.php";
    require_once "../controllers/employeeDB.php";
    require_once "../controllers/order_statusDB.php";
    if(isset($_POST['id_client']) && isset($_POST['id_employee']) && isset($_POST['id_status']) && isset($_POST['price'])){
        $id_client = $_POST['id_client'];
        $id_employee = $_POST['id_employee'];
        $id_status = $_POST['id_status'];
        $price = $_POST['price'];
        $order = new OrderDB();
        $success = $order->addOrder($id_client, $id_employee, $id_status, $price);
        if($success){
            http_response_code(201);
            echo "Новый заказ успешно добавлен. <a href='../tables/index.php'>Назад к таблице</a>";
        }else{
            http_response_code(503);
            echo "Невозможно добавить новый заказ. <a href='../tables/index.php'>Назад к таблице</a>";
        }
    }
    else{
        $user = new ClientDB();
        $clients = $user->getClient();
        $job = new EmployeeDB();
        $employees = $job->getEmployee();
        $order_status = new StatusDB();
        $statuses = $order_status->getStatus();
        echo "<h1>Добавление нового заказа</h1>";
        echo "<form action='add_order.php' method='POST'>";
        echo "<p>Клиенты:</p>";
        foreach($clients as $client){
            $id = $client->getId();
            $fio = $client->getFIO();
            echo "<p><input type='radio' name='id_client' value='" . $id . "' />" . $fio . "</p>";
        }
        echo "<p>Работники:</p>";
        foreach($employees as $employee){
            $id = $employee->getId();
            $fio = $employee->getFIO();
            echo "<p><input type='radio' name='id_employee' value='" . $id . "' />" . $fio . "</p>";
        }
        echo "<p>Статусы заказа:</p>";
        foreach($statuses as $status){
            $id = $status->getId();
            $name = $status->getStatus();
            echo "<p><input type='radio' name='id_status' value='" . $id . "' />" . $name . "</p>";
        }
        echo "<p>Сумма заказа: <input type='number' name='price' /></p>";
        echo "<input type='submit' value='Добавить новый заказ' />";
        echo "<a href='../tables/index.php'>Назад к таблице</a>";
        echo "</form>";
    }
    ?>
</body>

</html>
