<?php
require '../config.php';
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edytuj Projekt Badawczy</title>
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
        input[type="number"],
        textarea {
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
    <h1>Edytuj Projekt Badawczy</h1>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
        $id = $_POST['id'];
        $sql = "SELECT * FROM projekty_badawcze WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        $projekt = $stmt->fetch();
    ?>
    <form action="edit_project.php" method="post">
        <label for="project-name">Nazwa Projektu:</label>
        <input type="text" id="project-name" name="project-name" value="<?php echo $projekt['nazwa']; ?>" required>
        
        <label for="project-goal">Cel Projektu:</label>
        <textarea id="project-goal" name="project-goal" required><?php echo $projekt['cel']; ?></textarea>

        <label for="project-resources">Zasoby Potrzebne:</label>
        <textarea id="project-resources" name="project-resources" required><?php echo $projekt['zasoby_potrzebne']; ?></textarea>

        <label for="project-schedule">Harmonogram:</label>
        <textarea id="project-schedule" name="project-schedule" required><?php echo $projekt['harmonogram']; ?></textarea>

        <input type="hidden" name="id" value="<?php echo $projekt['id']; ?>">
        <input type="submit" name="update" value="Aktualizuj Projekt">
    </form>
    <?php
     if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
        $id = $_POST['id'];
        $nazwa = $_POST['project-name'];
        $cel = $_POST['project-goal'];
        $zasoby_potrzebne = $_POST['project-resources'];
        $harmonogram = $_POST['project-schedule'];
    
        // Aktualizuj projekt
        $sql_update = "UPDATE projekty_badawcze SET nazwa = :nazwa, cel = :cel, zasoby_potrzebne = :zasoby_potrzebne, harmonogram = :harmonogram WHERE id = :id";
        $stmt_update = $pdo->prepare($sql_update);
        $stmt_update->execute(['nazwa' => $nazwa, 'cel' => $cel, 'zasoby_potrzebne' => $zasoby_potrzebne, 'harmonogram' => $harmonogram, 'id' => $id]);
    
        // Przekieruj użytkownika na stronę projektów
        header("Location: view_project.php");
        exit;
    }
     
    }
    ?>
</body>
</html>
