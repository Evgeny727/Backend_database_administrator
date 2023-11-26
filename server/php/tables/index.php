<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Заказы</title>
    <link rel="stylesheet" href="../styles/styles.css">
    
</head>
<body>
    <div class="container">
        <div class="buttons">
            <a class='button' href="index_type.php">Типы комплектующих</a>
            <a class='button' href="index_stock.php">Склад</a>
            <a class='button' href="index_client.php">Клиенты</a>
            <a class='button' href="index_improve.php">Необходимые улучшения</a>
            <a class='button' href="index_position.php">Должности</a>
            <a class='button' href="index_employee.php">Работники</a>
            <a class='button' href="index_order_status.php">Статусы заказа</a>
            <a class='button' href="index_warranty.php">Гарантийные сертификаты</a>
        </div>
        <h1>Таблица заказов</h1>
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Имя клиента</th>
                    <th>Имя работника</th>
                    <th>Статус заказа</th>
                    <th>Сумма заказа</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    include("../models/client.php");
                    include("../models/employee.php");
                    include("../models/order_status.php");
                    include("../models/order.php");
                    include("../controllers/orderDB.php");
                    $orderDB = new OrderDB();
                    $orders = $orderDB->getOrder();
                    foreach($orders as $order){
                        $id_order = $order->getId();
                        $client_fio = $order->getClient()->getFIO();
                        $employee_fio = $order->getEmployee()->getFIO();
                        $order_status = $order->getStatus()->getStatus();
                        $total_price = $order->getPrice();
                        echo "<tr>
                                <td>{$id_order}</td>
                                <td>{$client_fio}</td>
                                <td>{$employee_fio}</td>
                                <td>{$order_status}</td>
                                <td>{$total_price}</td>
                                <td>
                                    <a class='button' href='../update/update_order.php?id={$id_order}'>Изменить</a>
                                    <a class='button' href='../delete/delete_order.php?id={$id_order}'>Удалить</a>
                                </td>
                            </tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
    <a class='button' href="../create/add_order.php">Добавить заказ</a>
</body>
</html>
