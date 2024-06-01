<?php
require '../../config.php';

// Skrypt PHP do obsługi dodawania produkcji
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $produkt = $_POST['production-item'];
    $ilosc = $_POST['production-quantity'];

    // Tworzymy zapytanie SQL do dodania nowej produkcji
    $sql = "INSERT INTO produkcja (produkt, ilosc) VALUES (:produkt, :ilosc)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['produkt' => $produkt, 'ilosc' => $ilosc]);

    // Wyświetlamy komunikat po dodaniu produkcji
    echo "<p>Produkcja została dodana pomyślnie!</p>";
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zarządzanie Produkcją</title>
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
    <h1>Zarządzanie Produkcją</h1>
    <form action="manage_production.php" method="post">
        <label for="production-item">Produkt:</label>
        <input type="text" id="production-item" name="production-item" required>

        <label for="production-quantity">Ilość:</label>
        <input type="number" id="production-quantity" name="production-quantity" required>

        <input type="submit" value="Dodaj Produkcję">
    </form>
</body>
</html>
