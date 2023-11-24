<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Удаление работников</title>
</head>
<body>
<?php
        require "../controllers/employeeDB.php";
        $id = $_GET['id'];
        $employee = new EmployeeDB();
        $result = $employee->deleteEmployee($id);
        if (!$result) {
            die('Invalid query');
        }
        echo "Работник успешно удалён.";
        echo "<a href='../tables/index_employee.php'>Назад к таблице</a>";


?>
</body>
</html>
