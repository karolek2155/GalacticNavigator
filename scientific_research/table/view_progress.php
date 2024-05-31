<?php
require '../../config.php';
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Przeglądaj Postępy Badań</title>
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
    <h1>Przeglądaj Postępy Badań</h1>
    <table>
        <tr>
            <th>Projekt</th>
            <th>Postęp</th>
            <th>Wyniki</th>
            <th>Akcje</th>
        </tr>
        <?php
        $sql = "SELECT m.id, p.nazwa AS projekt, m.postep, m.wyniki 
                FROM monitorowanie m
                JOIN projekty_badawcze p ON m.projekt_id = p.id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['projekt']) . "</td>";
            echo "<td>" . htmlspecialchars($row['postep']) . "</td>";
            echo "<td>" . htmlspecialchars($row['wyniki']) . "</td>";
            echo "<td>
                    <form action='edit_progress.php' method='post' style='display:inline;'>
                        <input type='hidden' name='id' value='" . $row['id'] . "'>
                        <input type='submit' value='Edytuj'>
                    </form>
                  </td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
