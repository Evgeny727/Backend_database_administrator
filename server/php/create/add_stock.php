<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/styleAdd.css">
    <title>Добавление товара</title>
</head>

<body>
    <?php
    require_once "../models/component_type.php";
    require_once "../controllers/stockDB.php";
    require_once "../controllers/component_typeDB.php";
    if(isset($_POST['name']) && isset($_POST['quantity']) && isset($_POST['price']) && isset($_POST['id_type'])){
        $name = $_POST['name'];
        $quantity_avaible = $_POST['quantity'];
        $price = $_POST['price'];
        $id_type = $_POST['id_type'];
        $stock = new StockDB();
        $success = $stock->addStock($name, $quantity_avaible, $price, $id_type);
        if($success){
            http_response_code(201);
            echo "Товар был добавлен. <a href='../tables/index_stock.php'>Назад к таблице</a>";
        }else{
            http_response_code(503);
            echo "Невозможно добавить товар. <a href='../tables/index_stock.php'>Назад к таблице</a>";
        }
    }
    else{
        $component = new Component_typeDB();
        $types = $component->getComponent_type();
        echo "<h1>Добавление товара</h1>";
        echo "<form action='add_stock.php' method='POST'>";
        echo "<p>Название товара: <input type='text' name='name' /></p>";
        echo "<p>Количество в наличии: <input type='number' name='quantity' /></p>";
        echo "<p>Цена: <input type='number' name='price' /></p>";
        echo "<p>Типы комплектующих:</p>";
        foreach($types as $type){
            $id = $type->getId();
            $name = $type->getType();
            echo "<p><input type='radio' name='id_type' value='" . $id . "' />" . $name . "</p>";
        }
        echo "<input type='submit' value='Добавить товар' />";
        echo "<a href='../tables/index_stock.php'>Назад к таблице</a>";
        echo "</form>";
    }
    ?>
</body>

</html>
