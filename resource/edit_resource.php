<?php
require 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Resource</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f2f2f2;
        }
        h1 {
            color: #333;
            text-align: center;
        }
        form {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 10px;
            color: #333;
        }
        input[type="text"],
        input[type="number"],
        select {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <h1>Edit Resource</h1>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
        $id = $_POST['id'];
        $sql = "SELECT * FROM resources WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        $resource = $stmt->fetch();
    ?>
    <form action="edit_resource.php" method="post">
        <label for="resource-name">Resource Name:</label>
        <input type="text" id="resource-name" name="resource-name" value="<?php echo $resource['name']; ?>" required>
        
        <label for="resource-quantity">Quantity:</label>
        <input type="number" id="resource-quantity" name="resource-quantity" value="<?php echo $resource['quantity']; ?>" required>

        <input type="hidden" name="id" value="<?php echo $resource['id']; ?>">
        <input type="submit" name="update" value="Update Resource">
    </form>
    <?php
    } elseif (isset($_POST['update'])) {
        $id = $_POST['id'];
        $name = $_POST['resource-name'];
        $quantity = $_POST['resource-quantity'];

        $sql = "UPDATE zasoby SET nazwa = :name, ilosc = :quantity WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['nazwa' => $name, 'ilosc' => $quantity, 'id' => $id]);

        echo "<p>Resource updated successfully!</p>";
    }
    ?>
</body>
</html>