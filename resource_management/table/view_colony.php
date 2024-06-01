<?php
require '../../config.php';
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Przeglądaj Kolonie</title>
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
        form {
            display: inline;
        }
        input[type="submit"] {
            padding: 5px 10px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <h1>Przeglądaj Kolonie</h1>
    <table>
        <tr>
            <th>Nazwa Kolonii</th>
            <th>Nazwa Sektoru</th>
            <th>Zasoby</th>
            <th>Akcje</th>
        </tr>
        <?php
        $sql = "SELECT kolonie.id, kolonie.nazwa AS nazwa_kolonii, kolonie.sektor AS nazwa_sektora, zasoby.nazwa AS nazwa_zasobu
                FROM kolonie
                JOIN zasoby ON kolonie.zasoby_id = zasoby.id";
        $stmt = $pdo->query($sql);
        $kolonie = $stmt->fetchAll();

        foreach ($kolonie as $kolonia) {
            echo "<tr>";
            echo "<td>{$kolonia['nazwa_kolonii']}</td>";
            echo "<td>{$kolonia['nazwa_sektora']}</td>";
            echo "<td>{$kolonia['nazwa_zasobu']}</td>";
            echo "<td>
                <form action='edit_colony.php' method='post' style='display:inline;'>
                    <input type='hidden' name='id' value='{$kolonia['id']}'>
                    <input type='submit' value='Edytuj'>
                </form>
                <form action='delete_colony.php' method='post' style='display:inline;'>
                    <input type='hidden' name='id' value='{$kolonia['id']}'>
                    <input type='submit' value='Usuń'>
                </form>
            </td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
