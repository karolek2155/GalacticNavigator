<?php
require '../../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['update'])) {
        // Aktualizacja wpisu
        $id = $_POST['id'];
        $postep = $_POST['postep'];
        $postep_nowy = $_POST['postep_nowy'];
        $wyniki = $_POST['wyniki'];

        // Pobierz obecną ilość postępu przed aktualizacją
        $sql_old = "SELECT postep, postep_nowy, wyniki FROM monitorowanie WHERE id = :id";
        $stmt_old = $pdo->prepare($sql_old);
        $stmt_old->execute(['id' => $id]);
        $old_data = $stmt_old->fetch(PDO::FETCH_ASSOC);
        
        $stary_postep = $old_data['postep'];
        $stary_postep_nowy = $old_data['postep_nowy'];
        $stare_wyniki = $old_data['wyniki'];

        // Aktualizuj postęp
        $sql_update = "UPDATE monitorowanie SET postep = :postep, postep_nowy = :postep_nowy, wyniki = :wyniki WHERE id = :id";
        $stmt_update = $pdo->prepare($sql_update);
        $stmt_update->execute(['postep' => $postep, 'postep_nowy' => $postep_nowy, 'wyniki' => $wyniki, 'id' => $id]);

        // Dodaj wpis do tabeli zmiany_postepu
        $sql_insert_change = "INSERT INTO zmiany_postepu (id_monitorowania, stary_postep, nowy_postep, stare_wyniki, nowe_wyniki) VALUES (:id_monitorowania, :stary_postep, :nowy_postep, :stare_wyniki, :nowe_wyniki)";
        $stmt_insert_change = $pdo->prepare($sql_insert_change);
        $stmt_insert_change->execute([
            'id_monitorowania' => $id,
            'stary_postep' => $stary_postep,
            'nowy_postep' => $postep,
            'stare_wyniki' => $stare_wyniki,
            'nowe_wyniki' => $wyniki
        ]);

        // Przekieruj użytkownika na stronę przeglądania postępów
        header("Location: view_progress.php");
        exit;
    } elseif (isset($_POST['id'])) {
        // Pobierz dane do formularza edycji
        $id = $_POST['id'];
        $sql = "SELECT * FROM monitorowanie WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        $monitorowanie = $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edycja Postępu Badań</title>
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
    <h1>Edycja Postępu Badań</h1>
    <?php if (isset($monitorowanie)): ?>
    <form action="edit_progress.php" method="post">
        <label for="postep">Postęp:</label>
        <textarea id="postep" name="postep" rows="5" required><?php echo $monitorowanie['postep']; ?></textarea>

        <label for="postep_nowy">Aktualizacja postępu:</label>
        <input type="number" id="postep_nowy" name="postep_nowy" step="0.01" value="<?php echo $monitorowanie['postep_nowy']; ?>" required>

        <label for="wyniki">Wyniki:</label>
        <textarea id="wyniki" name="wyniki" rows="5" required><?php echo $monitorowanie['wyniki']; ?></textarea>

        <input type="hidden" name="id" value="<?php echo $monitorowanie['id']; ?>">
        <input type="submit" name="update" value="Zapisz zmiany">
    </form>
    <?php else: ?>
    <p>Nie znaleziono wpisu do edycji.</p>
    <?php endif; ?>
</body>
</html>
