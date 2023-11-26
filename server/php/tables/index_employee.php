<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Работники</title>
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
            <a class='button' href="index.php">Заказы</a>
            <a class='button' href="index_order_status.php">Статусы заказа</a>
            <a class='button' href="index_warranty.php">Гарантийные сертификаты</a>
        </div>
        <h1>Таблица работников</h1>
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Фамилия работника</th>
                    <th>Имя работника</th>
                    <th>Должность</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    include("../models/position.php");
                    include("../models/employee.php");
                    include("../controllers/employeeDB.php");
                    $employeeDB = new EmployeeDB();
                    $employees = $employeeDB->getEmployee();
                    foreach($employees as $employee){
                        $id_employee = $employee->getId();
                        $last_name = $employee->getLastName();
                        $name = $employee->getName();
                        $position = $employee->getPosition()->getPosition();
                        echo "<tr>
                                <td>{$id_employee}</td>
                                <td>{$last_name}</td>
                                <td>{$name}</td>
                                <td>{$position}</td>
                                <td>
                                    <a class='button' href='../update/update_employee.php?id={$id_employee}'>Изменить</a>
                                    <a class='button' href='../delete/delete_employee.php?id={$id_employee}'>Удалить</a>
                                </td>
                            </tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
    <a class='button' href="../create/add_employee.php">Добавить работника</a>
</body>
</html>
