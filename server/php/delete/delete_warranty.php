<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Удаление гарантийного сертификата</title>
</head>
<body>
<?php
        require "../controllers/warrantyDB.php";
        $id = $_GET['id'];
        $warranty = new WarrantyDB();
        $result = $warranty->deleteWarranty($id);
        if (!$result) {
            die('Invalid query');
        }
        echo "Гарантийный сертификат успешно удалён.";
        echo "<a href='../tables/index_warranty.php'>Назад к таблице</a>";


?>
</body>
</html>
