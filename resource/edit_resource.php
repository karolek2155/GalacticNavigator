<?php
require 'config.php';
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edytuj Zasób</title>
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
        input[type="number"] {
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
    <h1>Edytuj Zasób</h1>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
        $id = $_POST['id'];
        $sql = "SELECT * FROM zasoby WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        $zasob = $stmt->fetch();
    ?>
    <form action="edit_resource.php" method="post">
        <label for="resource-name">Nazwa Zasobu:</label>
        <input type="text" id="resource-name" name="resource-name" value="<?php echo $zasob['nazwa']; ?>" required>
        
        <label for="resource-quantity">Ilość:</label>
        <input type="number" id="resource-quantity" name="resource-quantity" value="<?php echo $zasob['ilosc']; ?>" required>

        <input type="hidden" name="id" value="<?php echo $zasob['id']; ?>">
        <input type="submit" name="update" value="Aktualizuj Zasób">
    </form>
    <?php
    } elseif (isset($_POST['update'])) {
        $id = $_POST['id'];
        $nazwa = $_POST['resource-name'];
        $ilosc = $_POST['resource-quantity'];

        $sql = "UPDATE zasoby SET nazwa = :nazwa, ilosc = :ilosc WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['nazwa' => $nazwa, 'ilosc' => $ilosc, 'id' => $id]);

        echo "<p>Zasób został zaktualizowany pomyślnie!</p>";
    }
    ?>
</body>
</html>
