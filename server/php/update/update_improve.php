<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Изменение комплектующей/клиента</title>
    <link rel="stylesheet" href="../styles/styleUpdate.css">
    
</head>
<body>
    <div>
    <?php
        require_once "../models/component_type.php";
        require_once "../models/client.php";
        require_once "../models/improve.php";
        require_once "../controllers/improveDB.php";
        require_once "../controllers/component_typeDB.php";
        require_once "../controllers/clientDB.php";
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $db = new ImproveDB();
            $improve = $db->getImproveByID($id);
            if($improve){
                $component = new Component_typeDB();
                $types = $component->getComponent_type();
                $user = new ClientDB();
                $clients = $user->getClient();
                echo "<form action='update_improve.php' method='POST'>";
                $id_type = $improve->getType()->getId();
                $id_client = $improve->getClient()->getId();
                echo "<p>Типы комплектующих:</p>";
                foreach($types as $type){
                    $id1 = $type->getId();
                    $name = $type->getType();
                    if($id_type === $id1){
                        $isChecked = 'checked';
                    }
                    else {
                        $isChecked = '';
                    }
                    echo "<p><input type='radio' name='id_type' value='" . $id1 . "' $isChecked />" . $name . "</p>";
                }
                echo "<p>Клиенты:</p>";
                foreach($clients as $client){
                    $id2 = $client->getId();
                    $fio = $client->getFIO();
                    if($id_client === $id2){
                        $isChecked = 'checked';
                    }
                    else {
                        $isChecked = '';
                    }
                    echo "<p><input type='radio' name='id_client' value='" . $id2 . "' $isChecked />" . $fio . "</p>";
                }
                echo "<input type='hidden' name='id' value='$id' id='id'/>";
                echo "<input type='submit' value='Изменить данные' />";
                echo "<a href='../tables/index_improve.php'>Назад к таблице</a>";
                echo "</form>";
            }
        }
        elseif(isset($_POST['id']) && isset($_POST['id_type']) && isset($_POST['id_client'])){
            $id = $_POST['id'];
            $id_type = $_POST['id_type'];
            $id_client = $_POST['id_client'];
            $type = new Component_typeDB();
            $type1 = $type->getComponent_typeByID($id_type);
            $client = new ClientDB();
            $client1 = $client->getClientByID($id_client);
            $obj = new Improve($id, $type1, $client1);
            $db = new ImproveDB();
            $result = $db->updateImprove($obj);
            echo "Данные успешно изменёны. ";
            echo "<a href='../tables/index_improve.php'>Назад к таблице</a>";
        }
    ?>
    </div>
</body>
</html>