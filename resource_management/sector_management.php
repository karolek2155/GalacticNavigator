<?php
require '../config.php';

// Skrypt PHP do obsługi zarządzania sektorami
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nazwa_sektora = $_POST['sector-name'];
    $akcja = $_POST['action'];

    if ($akcja == 'dodanie') {
        // Dodanie nowego sektora
        $sql = "INSERT INTO sektory (nazwa) VALUES (:nazwa)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['nazwa' => $nazwa_sektora]);
        echo "<p>Sektor został pomyślnie dodany!</p>";
    } elseif ($akcja == 'usuniecie') {
        // Usunięcie istniejącego sektora
        $sql = "DELETE FROM sektory WHERE nazwa = :nazwa";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['nazwa' => $nazwa_sektora]);
        echo "<p>Sektor został pomyślnie usunięty!</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zarządzanie Sektorami</title>
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
    <h1>Zarządzanie Sektorami</h1>
    <form action="sector_management.php" method="post">
        <label for="sector-name">Nazwa Sektoru:</label>
        <input type="text" id="sector-name" name="sector-name" required>

        <label for="action">Akcja:</label>
        <select id="action" name="action" required>
            <option value="dodanie">Dodanie</option>
            <option value="usuniecie">Usunięcie</option>
        </select><br><br>

        <input type="submit" value="Zatwierdź">
    </form>
</body>
</html>
