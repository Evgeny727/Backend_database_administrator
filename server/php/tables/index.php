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
                    include("../config.php");
                    $result = mysqli_query($conn, "SELECT * FROM orders");
                    while($row = mysqli_fetch_array($result)){
                        $client = $conn->query("SELECT name, last_name FROM client WHERE client.id_client = $row[id_client]");
                        $client_temp = mysqli_fetch_array($client);
                        $space=' ';
                        $client_fio = $client_temp['last_name'].$space.$client_temp['name'];

                        $employee = $conn->query("SELECT name, last_name FROM employee WHERE employee.id_employee = $row[id_employee]");
                        $employee_temp = mysqli_fetch_array($employee);
                        $employee_fio = $employee_temp['last_name'].$space.$employee_temp['name'];

                        $order_status = $conn->query("SELECT status FROM order_status WHERE order_status.id_order_status = $row[id_order_status]");
                        $order_status_temp = mysqli_fetch_array($order_status);

                        echo "<tr>
                                <td>{$row['id_order']}</td>
                                <td>{$client_fio}</td>
                                <td>{$employee_fio}</td>
                                <td>{$order_status_temp['status']}</td>
                                <td>{$row['total_price']}</td>
                                <td>
                                    <a class='button' href='../update/update_order.php?id={$row['id_order']}'>Изменить</a>
                                    <a class='button' href='../delete/delete_order.php?id={$row['id_order']}'>Удалить</a>
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
