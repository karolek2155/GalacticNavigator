<?php
require '../../config.php';
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Przeglądaj Projekty Badawcze</title>
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
    <h1>Przeglądaj Projekty Badawcze</h1>
    <table>
        <tr>
            <th>Nazwa Projektu</th>
            <th>Cel</th>
            <th>Zasoby Potrzebne</th>
            <th>Harmonogram</th>
            <th>Akcje</th>
        </tr>
        <?php
        $sql = "SELECT * FROM projekty_badawcze";
        $stmt = $pdo->query($sql);
        $projekty = $stmt->fetchAll();

        foreach ($projekty as $projekt) {
            echo "<tr>";
            echo "<td>{$projekt['nazwa']}</td>";
            echo "<td>{$projekt['cel']}</td>";
            echo "<td>{$projekt['zasoby_potrzebne']}</td>";
            echo "<td>{$projekt['harmonogram']}</td>";
            echo "<td>
                <p><form action='edit_project.php' method='post' style='display:inline;'>
                    <input type='hidden' name='id' value='{$projekt['id']}'>
                    <input type='submit' value='Edytuj'>
                </form></p>
                <p><form action='delete_project.php' method='post' style='display:inline;'>
                    <input type='hidden' name='id' value='{$projekt['id']}'>
                    <input type='submit' value='Usuń'>
                </form></p>
            </td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
