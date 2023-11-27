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
        require_once "../models/component_type.php";
        require_once "../models/stock.php";
        require_once "../controllers/stockDB.php";
        require_once "../controllers/component_typeDB.php";
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $db = new StockDB();
            $stock = $db->getStockByID($id);
            if($stock){
                $component = new Component_typeDB();
                $types = $component->getComponent_type();
                echo "<form action='update_stock.php' method='POST'>";
                $name = $stock->getName();
                $quantity = $stock->getQuantity();
                $price = $stock->getPrice();
                $id_type = $stock->getType()->getId();
                echo "<p>Название товара: <input type='text' name='name' value='$name' /></p>";
                echo "<p>Количество в наличии: <input type='number' name='quantity' value='$quantity' /></p>";
                echo "<p>Цена: <input type='number' name='price' value='$price' /></p>";
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
                echo "<input type='hidden' name='id' value='$id' id='id'/>";
                echo "<input type='submit' value='Изменить товар' />";
                echo "<a href='../tables/index_stock.php'>Назад к таблице</a>";
                echo "</form>";
            }
        }
        elseif(isset($_POST['id']) && isset($_POST['name']) && isset($_POST['quantity']) && isset($_POST['price']) && isset($_POST['id_type'])){
            $id = $_POST['id'];
            $name = $_POST['name'];
            $quantity_avaible = $_POST['quantity'];
            $price = $_POST['price'];
            $id_type = $_POST['id_type'];
            $type = new Component_typeDB();
            $type1 = $type->getComponent_typeByID($id_type);
            $obj = new Stock($id, $name, $quantity_avaible, $price, $type1);
            $db = new StockDB();
            $result = $db->updateStock($obj);
            echo "Товар успешно изменён. ";
            echo "<a href='../tables/index_stock.php'>Назад к таблице</a>";
        }
    ?>
    </div>
</body>
</html>