<?php
require '../../config.php';

// Skrypt PHP do obsługi dodawania do magazynu
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $produkt = $_POST['storage-item'];
    $ilosc = $_POST['storage-quantity'];

    // Tworzymy zapytanie SQL do dodania nowej pozycji w magazynie
    $sql = "INSERT INTO magazyn (produkt, ilosc) VALUES (:produkt, :ilosc)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['produkt' => $produkt, 'ilosc' => $ilosc]);

    // Wyświetlamy komunikat po dodaniu pozycji w magazynie
    echo "<p>Pozycja została dodana do magazynu pomyślnie!</p>";
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zarządzanie Magazynem</title>
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
    <h1>Zarządzanie Magazynem</h1>
    <form action="manage_storage.php" method="post">
        <label for="storage-item">Produkt:</label>
        <input type="text" id="storage-item" name="storage-item" required>

        <label for="storage-quantity">Ilość:</label>
        <input type="number" id="storage-quantity" name="storage-quantity" required>

        <input type="submit" value="Dodaj do Magazynu">
    </form>
</body>
</html>
