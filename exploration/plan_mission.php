

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planowanie Misji - Symulator Zarządzania Zasobami w Kosmosie</title>
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
    <h1>Planowanie Misji</h1>
    <form method="post" action="plan_mission.php">

    <label for="mission_name">Nazwa misji:</label>
        <input type="text" id="mission_name" name="mission_name" required>

        <label for="mission_goal">Cel misji:</label>
        <input type="text" id="mission_goal" name="mission_goal" required>

        <label for="mission_crew">Załoga:</label>
        <input type="text" id="mission_crew" name="mission_crew" required>

        <label for="mission_resources">Zasoby:</label>
        <input type="text" id="mission_resources" name="mission_resources" required>

        <label for="mission_start_date">Data rozpoczęcia:</label>
        <input type="date" id="mission_start_date" name="mission_start_date" required>

        <label for="mission_end_date">Data zakończenia:</label>
        <input type="date" id="mission_end_date" name="mission_end_date" required>

        <label for="image">Dodaj grafikę (opcjonalne):</label>
        <input type="text" id="image" name="image">

        <input type="submit" value="Zaplanuj misję" name="submit">
    </form>
    <?php
    $conn = new mysqli('localhost', 'root', '', 'galacticnavigator');

     if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['submit'])) {
        $mission_name = $_POST['mission_name'];
        $mission_goal = $_POST['mission_goal'];
        $mission_crew = $_POST['mission_crew'];
        $mission_resources = $_POST['mission_resources'];
        $mission_start_date = $_POST['mission_start_date'];
        $mission_end_date = $_POST['mission_end_date'];
        $image = $_POST['image'];
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
    
        $sql = "INSERT INTO misje (nazwa, cel, zaloga, zasoby, data_startu, data_zakonczenia, grafika) VALUES ('$mission_name', '$mission_goal', '$mission_crew', '$mission_resources', '$mission_start_date', '$mission_end_date', '$image')";
    
        if ($conn->query($sql) === TRUE) {
            echo "<p style='color:green; text-align:center;'>Nowa misja została zaplanowana pomyślnie!</p>";
        } else {
            echo "<p style='color:red; text-align:center;'>Błąd: " . $sql . "<br>" . $conn->error . "</p>";
        }
    
        $conn->close();
    }
}
    ?>
</body>
</html>
