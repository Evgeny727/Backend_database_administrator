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
                    include("../models/warranty.php");
                    include("../controllers/warrantyDB.php");
                    $warrantyDB = new WarrantyDB();
                    $warrantys = $warrantyDB->getWarranty();
                    foreach($warrantys as $warranty){
                        $id_warranty = $warranty->getId();
                        $id_order = $warranty->getIdOrder();
                        $valid_until = $warranty->getValidUntil();
                        echo "<tr>
                                <td>{$id_warranty}</td>
                                <td>{$id_order}</td>
                                <td>{$valid_until}</td>
                                <td>
                                    <a class='button' href='../update/update_warranty.php?id={$id_warranty}'>Изменить</a>
                                    <a class='button' href='../delete/delete_warranty.php?id={$id_warranty}'>Удалить</a>
                                </td>
                            </tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
    <a class='button' href="../create/add_warranty.php">Добавить сертификат</a>
</body>
</html>
