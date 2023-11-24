<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Гарантийные сертификаты</title>
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
            <a class='button' href="index.php">Заказы</a>
        </div>
        <h1>Таблица гарантийных сертификатов</h1>
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Id заказа</th>
                    <th>Действителен до</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    include("../config.php");
                    $result = mysqli_query($conn, "SELECT * FROM warranty_certificate");
                    while($row = mysqli_fetch_array($result)){
                        echo "<tr>
                                <td>{$row['id_warranty_certificate']}</td>
                                <td>{$row['id_order']}</td>
                                <td>{$row['valid_until']}</td>
                                <td>
                                    <a class='button' href='../update/update_order.php?id={$row['id_warranty_certificate']}'>Изменить</a>
                                    <a class='button' href='../delete/delete_order.php?id={$row['id_warranty_certificate']}'>Удалить</a>
                                </td>
                            </tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
    <a class='button' href="../create/add_order.php">Добавить сертификат</a>
</body>
</html>
