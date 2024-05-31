<?php
require '../../config.php';
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Przeglądaj Handel</title>
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
    <h1>Przeglądaj Handel</h1>
    <table>
        <tr>
            <th>Zasób</th>
            <th>Akcja</th>
            <th>Ilość</th>
            <th>Data Transakcji</th>
        </tr>
        <?php
        $sql = "SELECT handel.id, zasoby.nazwa AS zasob, handel.akcja, handel.ilosc, handel.data_transakcji FROM handel JOIN zasoby ON handel.zasoby_id = zasoby.id";
        $stmt = $pdo->query($sql);
        $transakcje = $stmt->fetchAll();

        foreach ($transakcje as $transakcja) {
            echo "<tr>";
            echo "<td>{$transakcja['zasob']}</td>";
            echo "<td>{$transakcja['akcja']}</td>";
            echo "<td>{$transakcja['ilosc']}</td>";
            echo "<td>{$transakcja['data_transakcji']}</td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
