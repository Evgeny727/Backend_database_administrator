<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Склад</title>
    <link rel="stylesheet" href="../styles/styles.css">
    
</head>
<body>
    <div class="container">
        <div class="buttons">
            <a class='button' href="index_type.php">Типы комплектующих</a>
            <a class='button' href="index.php">Заказы</a>
            <a class='button' href="index_client.php">Клиенты</a>
            <a class='button' href="index_improve.php">Необходимые улучшения</a>
            <a class='button' href="index_position.php">Должности</a>
            <a class='button' href="index_employee.php">Работники</a>
            <a class='button' href="index_order_status.php">Статусы заказа</a>
            <a class='button' href="index_warranty.php">Гарантийные сертификаты</a>
        </div>
        <h1>Таблица склада</h1>
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Наименование</th>
                    <th>Количство в наличии</th>
                    <th>Цена</th>
                    <th>Тип комплектующей</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    include("../config.php");
                    $result = mysqli_query($conn, "SELECT * FROM stock");
                    while($row = mysqli_fetch_array($result)){
                        $type = $conn->query("SELECT pc_part_type FROM component_type WHERE component_type.id_component_type = $row[id_component_type]");
                        $type_temp = mysqli_fetch_array($type);

                        echo "<tr>
                                <td>{$row['id_stock']}</td>
                                <td>{$row['name']}</td>
                                <td>{$row['quantity_avaible']}</td>
                                <td>{$row['price']}</td>
                                <td>{$type_temp['pc_part_type']}</td>
                                <td>
                                    <a class='button' href='../update/update_stock.php?id={$row['id_stock']}'>Изменить</a>
                                    <a class='button' href='../delete/delete_stock.php?id={$row['id_stock']}'>Удалить</a>
                                </td>
                            </tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
    <a class='button' href="../create/add_stock.php">Добавить товар</a>
</body>
</html>
