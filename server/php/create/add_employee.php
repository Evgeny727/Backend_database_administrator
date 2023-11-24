<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/styleAdd.css">
    <title>Добавление работника</title>
</head>

<body>
    <?php
    require_once "../models/position.php";
    require_once "../controllers/employeeDB.php";
    require_once "../controllers/positionDB.php";
    if(isset($_POST['last_name']) && isset($_POST['name']) && isset($_POST['id_position'])){
        $last_name = $_POST['last_name'];
        $name = $_POST['name'];
        $id_position = $_POST['id_position'];
        $employee = new EmployeeDB();
        $success = $employee->addEmployee($last_name, $name, $id_position);
        if($success){
            http_response_code(201);
            echo "Работник успешно добавлен. <a href='../tables/index_employee.php'>Назад к таблице</a>";
        }else{
            http_response_code(503);
            echo "Невозможно добавить работника. <a href='../tables/index_employee.php'>Назад к таблице</a>";
        }
    }
    else{
        $component = new PositionDB();
        $positions = $component->getPosition();
        echo "<h1>Добавление работника</h1>";
        echo "<form action='add_employee.php' method='POST'>";
        echo "<p>Фамилия работника: <input type='text' name='last_name' /></p>";
        echo "<p>Имя работника: <input type='text' name='name' /></p>";
        echo "<p>Должности:</p>";
        foreach($positions as $position){
            $id = $position->getId();
            $name = $position->getPosition();
            echo "<p><input type='radio' name='id_position' value='" . $id . "' />" . $name . "</p>";
        }
        echo "<input type='submit' value='Добавить работника' />";
        echo "<a href='../tables/index_employee.php'>Назад к таблице</a>";
        echo "</form>";
    }
    ?>
</body>

</html>
