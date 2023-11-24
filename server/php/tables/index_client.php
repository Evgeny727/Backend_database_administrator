<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Клиенты</title>
    <link rel="stylesheet" href="../styles/styles.css">
    
</head>
<body>
    <div class="container">
        <div class="buttons">
            <a class='button' href="index_type.php">Типы комплектующих</a>
            <a class='button' href="index_stock.php">Склад</a>
            <a class='button' href="index.php">Заказы</a>
            <a class='button' href="index_improve.php">Необходимые улучшения</a>
            <a class='button' href="index_position.php">Должности</a>
            <a class='button' href="index_employee.php">Работники</a>
            <a class='button' href="index_order_status.php">Статусы заказа</a>
            <a class='button' href="index_warranty.php">Гарантийные сертификаты</a>
        </div>
        <h1>Таблица клиентов</h1>
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Email</th>
                    <th>Фамилия клиента</th>
                    <th>Имя клиента</th>
                    <th>Пароль</th>
                    <th>Дата рождения</th>
                    <th>Номер счёта</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    include("../config.php");
                    $result = mysqli_query($conn, "SELECT * FROM client");
                    while($row = mysqli_fetch_array($result)){
                        echo "<tr>
                                <td>{$row['id_client']}</td>
                                <td>{$row['email']}</td>
                                <td>{$row['last_name']}</td>
                                <td>{$row['name']}</td>
                                <td>{$row['password']}</td>
                                <td>{$row['birth_date']}</td>
                                <td>{$row['account_number']}</td>
                                <td>
                                    <a class='button' href='../update/update_client.php?id={$row['id_client']}'>Изменить</a>
                                    <a class='button' href='../delete/delete_client.php?id={$row['id_client']}'>Удалить</a>
                                </td>
                            </tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
    <a class='button' href="../create/add_client.php">Добавить клиента</a>
</body>
</html>
