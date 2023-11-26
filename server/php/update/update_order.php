<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Изменение заказа</title>
    <link rel="stylesheet" href="../styles/styleUpdate.css">
    
</head>
<body>
    <div>
    <?php
        require_once "../models/client.php";
        require_once "../models/employee.php";
        require_once "../models/order_status.php";
        require_once "../models/order.php";
        require_once "../controllers/orderDB.php";
        require_once "../controllers/clientDB.php";
        require_once "../controllers/employeeDB.php";
        require_once "../controllers/order_statusDB.php";
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $db = new OrderDB();
            $order = $db->getOrderByID($id);
            $price = $order->getPrice();
            if($order){
                $user = new ClientDB();
                $clients = $user->getClient();
                $job = new EmployeeDB();
                $employees = $job->getEmployee();
                $order_status = new StatusDB();
                $statuses = $order_status->getStatus();
                echo "<form action='update_order.php' method='POST'>";
                $id_client = $order->getClient()->getId();
                $id_employee = $order->getEmployee()->getId();
                $id_status = $order->getStatus()->getId();
                echo "<p>Клиенты:</p>";
                foreach($clients as $client){
                    $id1 = $client->getId();
                    $fio = $client->getFIO();
                    if($id_client === $id1){
                        $isChecked = 'checked';
                    }
                    else {
                        $isChecked = '';
                    }
                    echo "<p><input type='radio' name='id_client' value='" . $id1 . "' $isChecked />" . $fio . "</p>";
                }
                echo "<p>Работники:</p>";
                foreach($employees as $employee){
                    $id2 = $employee->getId();
                    $fio = $employee->getFIO();
                    if($id_employee === $id2){
                        $isChecked = 'checked';
                    }
                    else {
                        $isChecked = '';
                    }
                    echo "<p><input type='radio' name='id_employee' value='" . $id2 . "' $isChecked />" . $fio . "</p>";
                }
                echo "<p>Статусы заказа:</p>";
                foreach($statuses as $status){
                    $id3 = $status->getId();
                    $name = $status->getStatus();
                    if($id_status === $id3){
                        $isChecked = 'checked';
                    }
                    else {
                        $isChecked = '';
                    }
                    echo "<p><input type='radio' name='id_status' value='" . $id3 . "' $isChecked />" . $name . "</p>";
                }
                echo "<p>Сумма заказа: <input type='number' name='price' value='$price' /></p>";
                echo "<input type='hidden' name='id' value='$id' id='id'/>";
                echo "<input type='submit' value='Изменить заказ' />";
                echo "<a href='../tables/index.php'>Назад к таблице</a>";
                echo "</form>";
            }
        }
        elseif(isset($_POST['id']) && isset($_POST['id_client']) && isset($_POST['id_employee']) && isset($_POST['id_status']) && isset($_POST['price'])){
            $id = $_POST['id'];
            $id_client = $_POST['id_client'];
            $id_employee = $_POST['id_employee'];
            $id_status = $_POST['id_status'];
            $price = $_POST['price'];
            $client = new ClientDB();
            $client1 = $client->getClientByID($id_client);
            $employee = new EmployeeDB();
            $employee1 = $employee->getEmployeeByID($id_employee);
            $status = new StatusDB();
            $status1 = $status->getStatusByID($id_status);
            $obj = new Order($id, $client1, $employee1, $status1, $price);
            $db = new OrderDB();
            $result = $db->updateOrder($obj);
            echo "Заказ успешно изменён. ";
            echo "<a href='../tables/index.php'>Назад к таблице</a>";
        }
    ?>
    </div>
</body>
</html>