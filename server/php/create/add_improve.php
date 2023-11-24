<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/styleAdd.css">
    <title>Добавление новой комплектующей для клиента</title>
</head>

<body>
    <?php
    require_once "../models/component_type.php";
    require_once "../models/client.php";
    require_once "../controllers/improveDB.php";
    require_once "../controllers/component_typeDB.php";
    require_once "../controllers/clientDB.php";
    if(isset($_POST['id_type']) && isset($_POST['id_client'])){
        $id_type = $_POST['id_type'];
        $id_client = $_POST['id_client'];
        $improve = new ImproveDB();
        $success = $improve->addImprove($id_type, $id_client);
        if($success){
            http_response_code(201);
            echo "Новая комплектующая для клиента успешно добавлена. <a href='../tables/index_improve.php'>Назад к таблице</a>";
        }else{
            http_response_code(503);
            echo "Невозможно добавить новую комплектующую для клиента. <a href='../tables/index_improve.php'>Назад к таблице</a>";
        }
    }
    else{
        $component = new Component_typeDB();
        $types = $component->getComponent_type();
        $user = new ClientDB();
        $clients = $user->getClient();
        echo "<h1>Добавление новой комплектующей для клиента</h1>";
        echo "<form action='add_improve.php' method='POST'>";
        echo "<p>Типы комплектующих:</p>";
        foreach($types as $type){
            $id = $type->getId();
            $name = $type->getType();
            echo "<p><input type='radio' name='id_type' value='" . $id . "' />" . $name . "</p>";
        }
        echo "<p>Клиенты:</p>";
        foreach($clients as $client){
            $id = $client->getId();
            $fio = $client->getFIO();
            echo "<p><input type='radio' name='id_client' value='" . $id . "' />" . $fio . "</p>";
        }
        echo "<input type='submit' value='Добавить новую комплектующую' />";
        echo "<a href='../tables/index_improve.php'>Назад к таблице</a>";
        echo "</form>";
    }
    ?>
</body>

</html>
