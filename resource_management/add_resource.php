<?php
require '../config.php';
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zarządzanie Zasobami</title>
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
    <h1>Zarządzanie Zasobami</h1>
    <form action="add_resource.php" method="post">
        <label for="resource-name">Nazwa Zasobu:</label>
        <input type="text" id="resource-name" name="resource-name" required>
        
        <label for="resource-quantity">Ilość:</label>
        <input type="number" id="resource-quantity" name="resource-quantity" required>

        <input type="submit" value="Dodaj Zasób">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nazwa = $_POST['resource-name'];
        $ilosc = $_POST['resource-quantity'];

        $sql = "INSERT INTO zasoby (nazwa, ilosc) VALUES (:nazwa, :ilosc)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['nazwa' => $nazwa, 'ilosc' => $ilosc]);

        echo "<p>Zasób został dodany pomyślnie!</p>";
    }
    ?>
</body>
</html>
