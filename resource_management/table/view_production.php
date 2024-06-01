<?php
require '../../config.php'; // Załóżmy, że plik config.php zawiera połączenie do bazy danych

// Zapytanie SQL do pobrania danych z tabeli produkcja
$sql = "SELECT * FROM produkcja";

// Wykonanie zapytania
$stmt = $pdo->query($sql);

// Pobranie wszystkich wierszy wynikowych jako tablicy asocjacyjnej
$produkcja = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Przeglądaj Produkcję</title>
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
        table {
            width: 100%;
            margin: 20px 0;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #333;
            color: #fff;
        }
        td {
            background-color: #fff;
        }
    </style>
</head>
<body>
    <h1>Przeglądaj Produkcję</h1>
    <table>
        <tr>
            <th>Produkt</th>
            <th>Ilość</th>
            <th>Data Dodania</th>
        </tr>
        <?php
        // Wyświetlanie danych z tabeli produkcja w formie tabeli HTML
        foreach ($produkcja as $produkt) {
            echo "<tr>";
            echo "<td>{$produkt['produkt']}</td>";
            echo "<td>{$produkt['ilosc']}</td>";
            echo "<td>{$produkt['data_dodania']}</td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
