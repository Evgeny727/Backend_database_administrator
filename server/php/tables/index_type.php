<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Типы комплектующих</title>
    <link rel="stylesheet" href="../styles/styles.css">
    
</head>
<body>
    <div class="container">
        <div class="buttons">
            <a class='button' href="index.php">Заказы</a>
            <a class='button' href="index_stock.php">Склад</a>
            <a class='button' href="index_client.php">Клиенты</a>
            <a class='button' href="index_improve.php">Необходимые улучшения</a>
            <a class='button' href="index_position.php">Должности</a>
            <a class='button' href="index_employee.php">Работники</a>
            <a class='button' href="index_order_status.php">Статусы заказа</a>
            <a class='button' href="index_warranty.php">Гарантийные сертификаты</a>
        </div>
        <h1>Таблица типов комплектующих</h1>
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Тип комплектующей</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    include("../models/component_type.php");
                    include("../controllers/component_typeDB.php");
                    $typeDB = new Component_typeDB();
                    $types = $typeDB->getComponent_type();
                    foreach($types as $type){
                        $id_type = $type->getId();
                        $type1 = $type->getType();
                        echo "<tr>
                                <td>{$id_type}</td>
                                <td>{$type1}</td>
                                <td>
                                    <a class='button' href='../update/update_type.php?id={$id_type}'>Изменить</a>
                                    <a class='button' href='../delete/delete_type.php?id={$id_type}'>Удалить</a>
                                </td>
                            </tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
    <a class='button' href="../create/add_type.php">Добавить тип комплектующих</a>
</body>
</html>
