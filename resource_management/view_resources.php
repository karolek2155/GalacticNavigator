<?php
require '../config.php';
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Przeglądaj Zasoby</title>
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
    <h1>Przeglądaj Zasoby</h1>
    <table>
        <tr>
            <th>Nazwa Zasobu</th>
            <th>Ilość</th>
            <th>Akcje</th>
        </tr>
        <?php
        $sql = "SELECT * FROM zasoby";
        $stmt = $pdo->query($sql);
        $zasoby = $stmt->fetchAll();

        foreach ($zasoby as $zasob) {
            echo "<tr>";
            echo "<td>{$zasob['nazwa']}</td>";
            echo "<td>{$zasob['ilosc']}</td>";
            echo "<td>
                <form action='edit_resource.php' method='post' style='display:inline;'>
                    <input type='hidden' name='id' value='{$zasob['id']}'>
                    <input type='submit' value='Edytuj'>
                </form>
                <form action='delete_resource.php' method='post' style='display:inline;'>
                    <input type='hidden' name='id' value='{$zasob['id']}'>
                    <input type='submit' value='Usuń'>
                </form>
            </td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
