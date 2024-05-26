<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejestracja Wyników Misji - Symulator Zarządzania Zasobami w Kosmosie</title>
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
        input[type="date"],
        input[type="number"],
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
    <h1>Rejestracja Wyników Misji</h1>
    <form action="register_results.php" method="POST">
        <label for="mission_name">Nazwa misji:</label>
        <input type="text" id="mission_name" name="mission_name" required>

        <label for="mission_end_date">Data zakończenia misji:</label>
        <input type="date" id="mission_end_date" name="mission_end_date" required>

        <label for="discoveries">Odkrycia:</label>
        <input type="text" id="discoveries" name="discoveries" required>

        <label for="resources_used">Zużyte zasoby:</label>
        <input type="text" id="resources_used" name="resources_used" required>

        <label for="resources_gained">Zdobyte zasoby:</label>
        <input type="text" id="resources_gained" name="resources_gained" required>

        <input type="submit" value="Zarejestruj wyniki" name="submit">
    </form>
    <?php
    $conn = new mysqli('localhost', 'root', '', 'galacticnavigator');
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['submit'])) {
            $mission_name = $_POST['mission_name']; // Poprawione
            $mission_end_date = $_POST['mission_end_date'];
            $discoveries = $_POST['discoveries'];
            $resources_used = $_POST['resources_used'];
            $resources_gained = $_POST['resources_gained'];

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "INSERT INTO wyniki_misji (nazwa, data_zakonczenia, odkrycia, zuzyte_zasoby, zdobyte_zasoby) VALUES ('$mission_name', '$mission_end_date', '$discoveries', '$resources_used', '$resources_gained')";

            if ($conn->query($sql) === TRUE) {
                echo "<p style='color:green; text-align:center;'>Wyniki misji zostały zarejestrowane pomyślnie!</p>";
            } else {
                echo "<p style='color:red; text-align:center;'>Błąd: " . $sql . "<br>" . $conn->error . "</p>";
            }

            $conn->close();
        } else {
            echo "<p style='color:red; text-align:center;'>Proszę wypełnić wszystkie pola formularza.</p>";
        }
    }
    ?>
</body>
</html>
