<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/styleAdd.css">
    <title>Добавление клиента</title>
</head>

<body>
    <?php
    require_once "../models/client.php";
    require_once "../controllers/clientDB.php";
    if(isset($_POST['email']) && isset($_POST['last_name']) && isset($_POST['name']) && isset($_POST['password']) && isset($_POST['birth_date']) && isset($_POST['account_number'])){
        $email = $_POST['email'];
        $last_name = $_POST['last_name'];
        $name = $_POST['name'];
        $password = $_POST['password'];
        $birth_date = $_POST['birth_date'];
        $account_number = $_POST['account_number'];
        $client = new ClientDB();
        $result = $client->ifAlreadyExists($email);
        if(!$result){
            $success = $client->addClient($email, $last_name, $name, $password, $birth_date, $account_number);
            if($success){
                http_response_code(201);
                echo "Клиент был добавлен. <a href='../tables/index_client.php'>Назад к таблице</a>";
            }else{
                http_response_code(503);
                echo "Невозможно добавить клиента. <a href='../tables/index_client.php'>Назад к таблице</a>";
            }
        }
        else {
            http_response_code(503);
            echo "Клиент с такой почтой уже существует. <a href='../tables/index_client.php'>Назад к таблице</a>";
        }
    }
    else{
        echo "<h1>Добавление клиента</h1>";
        echo "<form action='add_client.php' method='POST'>";
        echo "<p>Email: <input type='email' name='email' /></p>";
        echo "<p>Фамилия: <input type='text' name='last_name' /></p>";
        echo "<p>Имя: <input type='text' name='name' /></p>";
        echo "<p>Пароль: <input type='password' name='password' /></p>";
        echo "<p>Дата рождения: <input type='date' name='birth_date' /></p>";
        echo "<p>Номер счёта: <input type='text' name='account_number' /></p>";
        echo "<input type='submit' value='Добавить товар' />";
        echo "<a href='../tables/index_client.php'>Назад к таблице</a>";
        echo "</form>";
    }
    ?>
</body>

</html>
