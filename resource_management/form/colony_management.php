<?php
require '../../config.php';

// Funkcja do pobierania opcji z bazy danych
function getOptionsFromDatabase($pdo, $tableName, $valueColumn) {
    $sql = "SELECT $valueColumn FROM $tableName";
    $stmt = $pdo->query($sql);
    $options = $stmt->fetchAll(PDO::FETCH_COLUMN);
    return $options;
}

// Skrypt PHP do obsługi zarządzania sektorami
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nazwa_sektora = $_POST['sector-name'];
    $nazwa_koloni = $_POST['colony-name'];
    $zasoby_id = $_POST['resources'];
    $akcja = $_POST['action'];

    if ($akcja == 'dodanie') {
        // Dodanie nowego sektora
        $sql = "INSERT INTO kolonie (nazwa, sektor, zasoby_id) VALUES (:nazwa, :sektor, :zasoby_id)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['nazwa' => $nazwa_koloni, 'sektor' => $nazwa_sektora, 'zasoby_id' => $zasoby_id]);
        echo "<p>Kolonia została pomyślnie dodana!</p>";
    } elseif ($akcja == 'usuniecie') {
        // Usunięcie istniejącego sektora
        // Tutaj umieść kod usuwania kolonii, jeśli jest wymagane
        echo "<p>Usuwanie kolonii nie jest jeszcze obsługiwane.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zarządzanie Koloniami</title>
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
        select {
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
    <h1>Zarządzanie Koloniami</h1>
    <form action="colony_management.php" method="post">
        <label for="colony-name">Nazwa Kolonii:</label>
        <select id="colony-name" name="colony-name" required>
            <?php
            // Pobierz opcje kolonii z bazy danych
            $colonyOptions = getOptionsFromDatabase($pdo, 'kolonie', 'nazwa');
            foreach ($colonyOptions as $option) {
                echo "<option value='$option'>$option</option>";
            }
            ?>
        </select>

        <label for="sector-name">Nazwa Sektoru:</label>
        <select id="sector-name" name="sector-name" required>
            <?php
            // Pobierz opcje sektorów z bazy danych
            $sektorOptions = getOptionsFromDatabase($pdo, 'kolonie', 'sektor');
            foreach ($sektorOptions as $option) {
                echo "<option value='$option'>$option</option>";
            }
            ?>
        </select>

        <label for="resources">Zasoby:</label>
        <select id="resources" name="resources" required>
            <?php
            // Pobierz opcje zasobów z bazy danych
            $resourceOptions = getOptionsFromDatabase($pdo, 'zasoby', 'nazwa');
            foreach ($resourceOptions as $option) {
                echo "<option value='$option'>$option</option>";
            }
            ?>
        </select>

        <label for="action">Akcja:</label>
        <select id="action" name="action" required>
            <option value="dodanie">Dodanie</option>
            <!-- <option value="usuniecie">Usunięcie</option> -->
        </select><br><br>

        <input type="submit" value="Zatwierdź">
    </form>
</body>
</html>
