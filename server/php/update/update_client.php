<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Изменение данных клиента</title>
    <link rel="stylesheet" href="../styles/styleUpdate.css">
    
</head>
<body>
    <div>
    <?php
        require_once "../models/client.php";
        require_once "../controllers/clientDB.php";
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $db = new ClientDB();
            $client = $db->getClientByID($id);
            if($client){
                echo "<form action='update_client.php' method='POST'>";
                $id = $client->getId();
                $email = $client->getEmail();
                $last_name = $client->getLastName();
                $name = $client->getName();
                $password = $client->getPassword();
                $birth_date = $client->getBirthDate();
                $account_number = $client->getAccountNumber();
                echo "<p>Email: <input type='email' name='email' value='$email' /></p>";
                echo "<p>Фамилия: <input type='text' name='last_name' value='$last_name' /></p>";
                echo "<p>Имя: <input type='text' name='name' value='$name' /></p>";
                echo "<p>Пароль: <input type='password' name='password' value='$password' /></p>";
                echo "<p>Дата рождения: <input type='date' name='birth_date' value='$birth_date' /></p>";
                echo "<p>Номер счёта: <input type='text' name='account_number' value='$account_number' /></p>";
                echo "<input type='hidden' name='id' value='$id' id='id'/>";
                echo "<input type='submit' value='Изменить данные клиента' />";
                echo "<a href='../tables/index_client.php'>Назад к таблице</a>";
                echo "</form>";
            }
        }
        elseif(isset($_POST['id']) && isset($_POST['email']) && isset($_POST['last_name']) && isset($_POST['name']) && isset($_POST['password']) && isset($_POST['birth_date']) && isset($_POST['account_number'])){
            $id = $_POST['id'];
            $email = $_POST['email'];
            $last_name = $_POST['last_name'];
            $name = $_POST['name'];
            $password = $_POST['password'];
            $birth_date = $_POST['birth_date'];
            $account_number = $_POST['account_number'];
            $obj = new Client($id, $email, $last_name, $name, $password, $birth_date, $account_number);
            $db = new ClientDB();
            $result = $db->ifAlreadyExists($email);
            if(!$result){
                $success = $db->updateClient($obj);
                if($success){
                    http_response_code(201);
                    echo "Данные клиента успешно изменёны. <a href='../tables/index_client.php'>Назад к таблице</a>";
                }else{
                    http_response_code(503);
                    echo "Невозможно изменить данные клиента. <a href='../tables/index_client.php'>Назад к таблице</a>";
                }
            }
            else {
                http_response_code(503);
                echo "Клиент с такой почтой уже существует. <a href='../tables/index_client.php'>Назад к таблице</a>";
            }
        }
    ?>
    </div>
</body>
</html>