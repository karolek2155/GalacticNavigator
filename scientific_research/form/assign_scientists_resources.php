<?php
require '../../config.php';

// Skrypt PHP do przypisywania naukowców i zasobów do projektów badawczych
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $projekt_id = $_POST['projekt_id'];
    $naukowiec_id = $_POST['naukowiec_id'];
    $zasob = $_POST['zasob'];
    $ilosc = $_POST['ilosc'];

    // Sprawdzenie dostępności zasobu
    $sql_check_quantity = "SELECT ilosc FROM zasoby WHERE nazwa = :zasob";
    $stmt_check_quantity = $pdo->prepare($sql_check_quantity);
    $stmt_check_quantity->execute(['zasob' => $zasob]);
    $row = $stmt_check_quantity->fetch();
    $ilosc_magazyn = $row['ilosc'];

    if ($ilosc_magazyn >= $ilosc) {
        // Tworzymy zapytanie SQL do dodania nowego przypisania
        $sql = "INSERT INTO przypisania (projekt_id, naukowiec_id, zasob, ilosc) VALUES (:projekt_id, :naukowiec_id, :zasob, :ilosc)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['projekt_id' => $projekt_id, 'naukowiec_id' => $naukowiec_id, 'zasob' => $zasob, 'ilosc' => $ilosc]);
        echo "<p>Naukowiec i zasób zostały pomyślnie przypisane do projektu!</p>";

        // Aktualizacja ilości zasobu w magazynie po przypisaniu
        $nowa_ilosc_magazyn = $ilosc_magazyn - $ilosc;
        $sql_update_quantity = "UPDATE zasoby SET ilosc = :nowa_ilosc WHERE nazwa = :zasob";
        $stmt_update_quantity = $pdo->prepare($sql_update_quantity);
        $stmt_update_quantity->execute(['nowa_ilosc' => $nowa_ilosc_magazyn, 'zasob' => $zasob]);
    } else {
        echo "<p>Brak wystarczającej ilości zasobu w magazynie!</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Przypisywanie Naukowców i Zasobów</title>
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
        select,
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
    <h1>Przypisywanie Naukowców i Zasobów do Projektów Badawczych</h1>
    <form action="assign_scientists_resources.php" method="post">
        <label for="projekt_id">Projekt:</label>
        <select id="projekt_id" name="projekt_id" required>
            <?php
            $sql_projects = "SELECT id, nazwa FROM projekty_badawcze";
            foreach ($pdo->query($sql_projects) as $row) {
                echo "<option value='{$row['id']}'>{$row['nazwa']}</option>";
            }
            ?>
        </select>

        <label for="naukowiec_id">Naukowiec:</label>
        <select id="naukowiec_id" name="naukowiec_id" required>
            <?php
            $sql_scientists = "SELECT id, CONCAT(imie, ' ', nazwisko) AS full_name FROM naukowcy";
            foreach ($pdo->query($sql_scientists) as $row) {
                echo "<option value='{$row['id']}'>{$row['full_name']}</option>";
            }
            ?>
        </select>

        <label for="zasob">Zasób:</label>
        <select id="zasob" name="zasob" required>
            <?php
            $sql_resources = "SELECT nazwa FROM zasoby";
            foreach ($pdo->query($sql_resources) as $row) {
                echo "<option value='{$row['nazwa']}'>{$row['nazwa']}</option>";
            }
            ?>
        </select>

        <label for="ilosc">Ilość:</label>
        <input type="number" id="ilosc" name="ilosc" required>

        <input type="submit" value="Przypisz">
    </form>
</body>
</html>
