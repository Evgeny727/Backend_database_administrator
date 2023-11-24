<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Необходимые улучшения</title>
    <link rel="stylesheet" href="../styles/styles.css">
    
</head>
<body>
    <div class="container">
        <div class="buttons">
            <a class='button' href="index_type.php">Типы комплектующих</a>
            <a class='button' href="index_stock.php">Склад</a>
            <a class='button' href="index_client.php">Клиенты</a>
            <a class='button' href="index.php">Заказы</a>
            <a class='button' href="index_position.php">Должности</a>
            <a class='button' href="index_employee.php">Работники</a>
            <a class='button' href="index_order_status.php">Статусы заказа</a>
            <a class='button' href="index_warranty.php">Гарантийные сертификаты</a>
        </div>
        <h1>Таблица необходимых комплектующих</h1>
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Тип комплектующей</th>
                    <th>Имя клиента</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    include("../config.php");
                    $result = mysqli_query($conn, "SELECT * FROM necessary_improvement");
                    while($row = mysqli_fetch_array($result)){
                        $type = $conn->query("SELECT pc_part_type FROM component_type WHERE component_type.id_component_type = $row[id_component_type]");
                        $type_temp = mysqli_fetch_array($type);

                        $client = $conn->query("SELECT name, last_name FROM client WHERE client.id_client = $row[id_client]");
                        $client_temp = mysqli_fetch_array($client);
                        $space=' ';
                        $client_fio = $client_temp['last_name'].$space.$client_temp['name'];

                        echo "<tr>
                                <td>{$row['id_necessary_improvement']}</td>
                                <td>{$type_temp['pc_part_type']}</td>
                                <td>{$client_fio}</td>
                                <td>
                                    <a class='button' href='../update/update_improve.php?id={$row['id_necessary_improvement']}'>Изменить</a>
                                    <a class='button' href='../delete/delete_improve.php?id={$row['id_necessary_improvement']}'>Удалить</a>
                                </td>
                            </tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
    <a class='button' href="../create/add_improve.php">Добавить новую комплектующую для клиента</a>
</body>
</html>
