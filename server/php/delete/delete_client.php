<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Удаление клиента</title>
</head>
<body>
<?php
        require "../controllers/clientDB.php";
        $id = $_GET['id'];
        $client = new ClientDB();
        $result = $client->deleteClient($id);
        if (!$result) {
            die('Invalid query');
        }
        echo "Клиент успешно удалён.";
        echo "<a href='../tables/index_client.php'>Назад к таблице</a>";


?>
</body>
</html>
