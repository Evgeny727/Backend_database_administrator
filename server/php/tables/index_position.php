<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Должности</title>
    <link rel="stylesheet" href="../styles/styles.css">
    
</head>
<body>
    <div class="container">
        <div class="buttons">
            <a class='button' href="index_type.php">Типы комплектующих</a>
            <a class='button' href="index_stock.php">Склад</a>
            <a class='button' href="index_client.php">Клиенты</a>
            <a class='button' href="index_improve.php">Необходимые улучшения</a>
            <a class='button' href="index.php">Заказы</a>
            <a class='button' href="index_employee.php">Работники</a>
            <a class='button' href="index_order_status.php">Статусы заказа</a>
            <a class='button' href="index_warranty.php">Гарантийные сертификаты</a>
        </div>
        <h1>Таблица должностей</h1>
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Должность</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    include("../models/position.php");
                    include("../controllers/positionDB.php");
                    $positionDB = new PositionDB();
                    $positions = $positionDB->getPosition();
                    foreach($positions as $position){
                        $id_position = $position->getId();
                        $position1 = $position->getPosition();
                        echo "<tr>
                                <td>{$id_position}</td>
                                <td>{$position1}</td>
                                <td>
                                    <a class='button' href='../update/update_position.php?id={$id_position}'>Изменить</a>
                                    <a class='button' href='../delete/delete_position.php?id={$id_position}'>Удалить</a>
                                </td>
                            </tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
    <a class='button' href="../create/add_position.php">Добавить должность</a>
</body>
</html>
