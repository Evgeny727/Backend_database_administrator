<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Изменение товара</title>
    <link rel="stylesheet" href="../styles/styleUpdate.css">
    
</head>
<body>
    <div>
    <?php
        require_once "../models/position.php";
        require_once "../models/employee.php";
        require_once "../controllers/employeeDB.php";
        require_once "../controllers/positionDB.php";
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $db = new EmployeeDB();
            $employee = $db->getEmployeeByID($id);
            if($employee){
                $component = new PositionDB();
                $positions = $component->getPosition();
                echo "<form action='update_employee.php' method='POST'>";
                $last_name = $employee->getLastName();
                $name = $employee->getName();
                $id_position = $employee->getPosition()->getId();
                echo "<p>Фамилия работника: <input type='text' name='last_name' value='$last_name' /></p>";
                echo "<p>Имя работника: <input type='text' name='name' value='$name' /></p>";
                echo "<p>Должности:</p>";
                foreach($positions as $position){
                    $id1 = $position->getId();
                    $name = $position->getPosition();
                    if($id_position === $id1){
                        $isChecked = 'checked';
                    }
                    else {
                        $isChecked = '';
                    }
                    echo "<p><input type='radio' name='id_position' value='" . $id1 . "' $isChecked />" . $name . "</p>";
                }
                echo "<input type='hidden' name='id' value='$id' id='id'/>";
                echo "<input type='submit' value='Изменить данные' />";
                echo "<a href='../tables/index_employee.php'>Назад к таблице</a>";
                echo "</form>";
            }
        }
        elseif(isset($_POST['id'])&& isset($_POST['last_name']) && isset($_POST['name']) && isset($_POST['id_position'])){
            $id = $_POST['id'];
            $last_name = $_POST['last_name'];
            $name = $_POST['name'];
            $id_position = $_POST['id_position'];
            $position = new PositionDB();
            $position1 = $position->getPositionByID($id_position);
            $obj = new Employee($id, $last_name, $name, $position1);
            $db = new EmployeeDB();
            $result = $db->updateEmployee($obj);
            echo "Данные успешно изменены. ";
            echo "<a href='../tables/index_employee.php'>Назад к таблице</a>";
        }
    ?>
    </div>
</body>
</html>