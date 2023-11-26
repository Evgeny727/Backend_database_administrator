<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Статусы заказа</title>
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
            <a class='button' href="index.php">Заказы</a>
            <a class='button' href="index_warranty.php">Гарантийные сертификаты</a>
        </div>
        <h1>Таблица статусов заказа</h1>
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Статус</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    include("../models/order_status.php");
                    include("../controllers/order_statusDB.php");
                    $statusDB = new StatusDB();
                    $statuses = $statusDB->getStatus();
                    foreach($statuses as $status){
                        $id_order_status = $status->getId();
                        $status1 = $status->getStatus();
                        echo "<tr>
                                <td>{$id_order_status}</td>
                                <td>{$status1}</td>
                                <td>
                                    <a class='button' href='../update/update_order_status.php?id={$id_order_status}'>Изменить</a>
                                    <a class='button' href='../delete/delete_order_status.php?id={$id_order_status}'>Удалить</a>
                                </td>
                            </tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
    <a class='button' href="../create/add_order_status.php">Добавить статус</a>
</body>
</html>
