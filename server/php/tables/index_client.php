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
                    include("../controllers/clientDB.php");
                    $clientDB = new ClientDB();
                    $clients = $clientDB->getClient();
                    foreach($clients as $client){
                        $id_client = $client->getId();
                        $email = $client->getEmail();
                        $last_name = $client->getLastName();
                        $name = $client->getName();
                        $password = $client->getPassword();
                        $birth_date = $client->getBirthDate();
                        $account_number = $client->getAccountNumber();
                        echo "<tr>
                                <td>{$id_client}</td>
                                <td>{$email}</td>
                                <td>{$last_name}</td>
                                <td>{$name}</td>
                                <td>{$password}</td>
                                <td>{$birth_date}</td>
                                <td>{$account_number}</td>
                                <td>
                                    <a class='button' href='../update/update_client.php?id={$id_client}'>Изменить</a>
                                    <a class='button' href='../delete/delete_client.php?id={$id_client}'>Удалить</a>
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
