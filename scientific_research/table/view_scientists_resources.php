<?php
require '../../config.php';
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Przeglądaj Zasoby Naukowców</title>
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
            text-align: center;
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
    <h1>Przeglądaj Zasoby Naukowców</h1>
    <table>
        <tr>
            <th>Imię</th>
            <th>Nazwisko</th>
            <th>Specjalizacja</th>
            <th>Zasób</th>
            <th>Ilość</th>
            <th>Akcje</th>
        </tr>
        <?php
        $sql = "SELECT naukowcy.id, naukowcy.imie, naukowcy.nazwisko, naukowcy.specjalizacja, przypisania.zasob, przypisania.ilosc 
                FROM przypisania 
                JOIN naukowcy ON przypisania.naukowiec_id = naukowcy.id 
                JOIN projekty_badawcze ON przypisania.projekt_id = projekty_badawcze.id";
        $stmt = $pdo->query($sql);
        $dane = $stmt->fetchAll();

        foreach ($dane as $wiersz) {
            echo "<tr>";
            echo "<td>{$wiersz['imie']}</td>";
            echo "<td>{$wiersz['nazwisko']}</td>";
            echo "<td>{$wiersz['specjalizacja']}</td>";
            echo "<td>{$wiersz['zasob']}</td>";
            echo "<td>{$wiersz['ilosc']}</td>";
            echo "<td>
                <p><form action='edit_scientist_resource.php' method='post' style='display:inline;'>
                    <input type='hidden' name='id' value='{$wiersz['id']}'>
                    <input type='submit' value='Edytuj'>
                </form></p>
                <p><form action='delete_scientist_resource.php' method='post' style='display:inline;'>
                    <input type='hidden' name='id' value='{$wiersz['id']}'>
                    <input type='submit' value='Usuń'>
                </form></p>
            </td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
