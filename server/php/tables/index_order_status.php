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
                    include("../config.php");
                    $result = mysqli_query($conn, "SELECT * FROM order_status");
                    while($row = mysqli_fetch_array($result)){
                        echo "<tr>
                                <td>{$row['id_order_status']}</td>
                                <td>{$row['status']}</td>
                                <td>
                                    <a class='button' href='../update/update_order_status.php?id={$row['id_order_status']}'>Изменить</a>
                                    <a class='button' href='../delete/delete_order_status.php?id={$row['id_order_status']}'>Удалить</a>
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
