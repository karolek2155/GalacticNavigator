<?php
require '../../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['update'])) {
        // Aktualizacja projektu
        $id = $_POST['id'];
        $nazwa = $_POST['nazwa'];
        $cel = $_POST['cel'];
        $zasoby_potrzebne = $_POST['zasoby_potrzebne'];
        $harmonogram = $_POST['harmonogram'];

        $sql_update = "UPDATE projekty_badawcze SET nazwa = :nazwa, cel = :cel, zasoby_potrzebne = :zasoby_potrzebne, harmonogram = :harmonogram WHERE id = :id";
        $stmt_update = $pdo->prepare($sql_update);
        $stmt_update->execute([
            'nazwa' => $nazwa,
            'cel' => $cel,
            'zasoby_potrzebne' => $zasoby_potrzebne,
            'harmonogram' => $harmonogram,
            'id' => $id
        ]);

        header("Location: view_project.php"); 
        exit;
    } elseif (isset($_POST['id'])) {
        // Pobierz dane do formularza edycji
        $id = $_POST['id'];
        $sql = "SELECT * FROM projekty_badawcze WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        $projekt = $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edycja Projektu Badawczego</title>
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
        textarea, input[type="text"] {
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
    <h1>Edycja Projektu Badawczego</h1>
    <?php if (isset($projekt)): ?>
    <form action="edit_project.php" method="post">
        <label for="nazwa">Nazwa Projektu:</label>
        <input type="text" id="nazwa" name="nazwa" value="<?php echo $projekt['nazwa']; ?>" required>

        <label for="cel">Cel:</label>
        <textarea id="cel" name="cel" rows="5" required><?php echo $projekt['cel']; ?></textarea>

        <label for="zasoby_potrzebne">Zasoby Potrzebne:</label>
        <textarea id="zasoby_potrzebne" name="zasoby_potrzebne" rows="5" required><?php echo $projekt['zasoby_potrzebne']; ?></textarea>

        <label for="harmonogram">Harmonogram:</label>
        <textarea id="harmonogram" name="harmonogram" rows="5" required><?php echo $projekt['harmonogram']; ?></textarea>

        <input type="hidden" name="id" value="<?php echo $projekt['id']; ?>">
        <input type="submit" name="update" value="Zapisz zmiany">
    </form>
    <?php else: ?>
    <p>Nie znaleziono projektu do edycji.</p>
    <?php endif; ?>
</body>
</html>
