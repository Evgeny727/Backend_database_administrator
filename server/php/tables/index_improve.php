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
                    include("../models/component_type.php");
                    include("../models/client.php");
                    include("../models/improve.php");
                    include("../controllers/improveDB.php");
                    $improveDB = new ImproveDB();
                    $improves = $improveDB->getImprove();
                    foreach($improves as $improve){
                        $id_necessary_improvement = $improve->getId();
                        $type = $improve->getType()->getType();
                        $client_fio = $improve->getClient()->getFIO();
                        echo "<tr>
                                <td>{$id_necessary_improvement}</td>
                                <td>{$type}</td>
                                <td>{$client_fio}</td>
                                <td>
                                    <a class='button' href='../update/update_improve.php?id={$id_necessary_improvement}'>Изменить</a>
                                    <a class='button' href='../delete/delete_improve.php?id={$id_necessary_improvement}'>Удалить</a>
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
