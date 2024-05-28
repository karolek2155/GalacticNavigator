<?php
require '../config.php';

// Skrypt PHP do obsługi handlu zasobami
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $zasob = $_POST['resource'];
    $akcja = $_POST['action'];
    $ilosc = $_POST['quantity'];

    // Sprawdzenie, czy akcja to kupno czy sprzedaż
    if ($akcja == 'kupno') {
        // Tworzymy zapytanie SQL do dodania nowej pozycji handlu
        $sql = "INSERT INTO handel (zasob, akcja, ilosc) VALUES (:zasob, :akcja, :ilosc)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['zasob' => $zasob, 'akcja' => $akcja, 'ilosc' => $ilosc]);
        echo "<p>Zasób został pomyślnie kupiony!</p>";
    } elseif ($akcja == 'sprzedaz') {
        // Sprawdzenie dostępności zasobu w magazynie przed sprzedażą
        $sql_check_quantity = "SELECT ilosc FROM magazyn WHERE produkt = :zasob";
        $stmt_check_quantity = $pdo->prepare($sql_check_quantity);
        $stmt_check_quantity->execute(['zasob' => $zasob]);
        $row = $stmt_check_quantity->fetch();
        $ilosc_magazyn = $row['ilosc'];

        if ($ilosc_magazyn >= $ilosc) {
            // Tworzymy zapytanie SQL do dodania nowej pozycji handlu
            $sql = "INSERT INTO handel (zasob, akcja, ilosc) VALUES (:zasob, :akcja, :ilosc)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['zasob' => $zasob, 'akcja' => $akcja, 'ilosc' => $ilosc]);
            echo "<p>Zasób został pomyślnie sprzedany!</p>";

            // Aktualizacja ilości zasobu w magazynie po sprzedaży
            $nowa_ilosc_magazyn = $ilosc_magazyn - $ilosc;
            $sql_update_quantity = "UPDATE magazyn SET ilosc = :nowa_ilosc WHERE produkt = :zasob";
            $stmt_update_quantity = $pdo->prepare($sql_update_quantity);
            $stmt_update_quantity->execute(['nowa_ilosc' => $nowa_ilosc_magazyn, 'zasob' => $zasob]);
        } else {
            echo "<p>Brak wystarczającej ilości zasobu w magazynie!</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zarządzanie Handlem</title>
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
    <h1>Zarządzanie Handlem</h1>
    <form action="manage_trade.php" method="post">
        <label for="resource">Zasób:</label>
        <input type="text" id="resource" name="resource" required>

        <label for="action">Akcja:</label>
        <select id="action" name="action" required>
            <option value="kupno">Kupno</option>
            <option value="sprzedaz">Sprzedaż</option>
        </select><br><br>

        <label for="quantity">Ilość:</label>
        <input type="number" id="quantity" name="quantity" required>

        <input type="submit" value="Zatwierdź">
    </form>
</body>
</html>
