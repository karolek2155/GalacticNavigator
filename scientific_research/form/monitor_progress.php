<?php
require '../../config.php';

// Skrypt PHP do monitorowania postępów badań i dokumentowania wyników
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $projekt_id = $_POST['projekt_id'];
    $postep = $_POST['postep'];
    $wyniki = $_POST['wyniki'];

    // Tworzymy zapytanie SQL do dodania nowego wpisu monitorowania
    $sql = "INSERT INTO monitorowanie (projekt_id, postep, wyniki) VALUES (:projekt_id, :postep, :wyniki)";
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute(['projekt_id' => $projekt_id, 'postep' => $postep, 'wyniki' => $wyniki])) {
        echo "<p>Postęp został pomyślnie zaktualizowany!</p>";
    } else {
        echo "<p>Wystąpił błąd podczas aktualizowania postępu.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitorowanie Postępów Badań</title>
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
        textarea,
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
    <h1>Monitorowanie Postępów Badań i Dokumentowanie Wyników</h1>
    <form action="monitor_progress.php" method="post">
        <label for="projekt_id">Projekt:</label>
        <select id="projekt_id" name="projekt_id" required>
            <!-- Poniżej znajdą się opcje dla projektów badawczych pobrane z bazy danych -->
            <?php
            $sql = "SELECT id, nazwa FROM projekty_badawcze";
            foreach ($pdo->query($sql) as $row) {
                echo '<option value="'.$row['id'].'">'.$row['nazwa'].'</option>';
            }
            ?>
        </select>

        <label for="postep">Postęp:</label>
        <textarea id="postep" name="postep" rows="5" required></textarea>

        <label for="wyniki">Wyniki:</label>
        <textarea id="wyniki" name="wyniki" rows="5" required></textarea>

        <input type="submit" value="Zatwierdź">
    </form>
</body>
</html>
