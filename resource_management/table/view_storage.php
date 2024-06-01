<?php
require '../../config.php'; // Załóżmy, że plik config.php zawiera połączenie do bazy danych

// Zapytanie SQL do pobrania danych z tabeli magazyn
$sql = "SELECT * FROM magazyn";

// Wykonanie zapytania
$stmt = $pdo->query($sql);

// Pobranie wszystkich wierszy wynikowych jako tablicy asocjacyjnej
$magazyn = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Przeglądaj Magazyn</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .content {
            width: 80%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap; /* Nowy styl umożliwia zawijanie elementów na małych ekranach */
        }
        h1 {
            color: #333;
            text-align: center;
            width: 100%; /* Ustawienie szerokości na 100% zapewnia, że tekst będzie miał pełną szerokość kontenera */
            margin-bottom: 20px; /* Dodanie odstępu od dolnej krawędzi */
        }
        .chart-container {
            width: 48%;
            margin-bottom: 20px;
        }
        .download-button {
            display: block;
            margin: 10px auto;
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1>Przeglądaj Magazyn</h1>
    <table>
        <tr>
            <th>Produkt</th>
            <th>Ilość</th>
            <th>Data Dodania</th>
        </tr>
        <?php
        // Wyświetlanie danych z tabeli magazyn w formie tabeli HTML
        foreach ($magazyn as $produkt) {
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
