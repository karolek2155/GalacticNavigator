<?php
require 'config.php';
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edytuj Zasób</title>
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
    <h1>Edytuj Zasób</h1>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
        $id = $_POST['id'];
        $sql = "SELECT * FROM zasoby WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        $zasob = $stmt->fetch();
    ?>
    <form action="edit_resource.php" method="post">
        <label for="resource-name">Nazwa Zasobu:</label>
        <input type="text" id="resource-name" name="resource-name" value="<?php echo $zasob['nazwa']; ?>" required>
        
        <label for="resource-quantity">Ilość:</label>
        <input type="number" id="resource-quantity" name="resource-quantity" value="<?php echo $zasob['ilosc']; ?>" required>

        <input type="hidden" name="id" value="<?php echo $zasob['id']; ?>">
        <input type="submit" name="update" value="Aktualizuj Zasób">
    </form>
    <?php
     if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
        $id = $_POST['id'];
        $nazwa = $_POST['resource-name'];
        $ilosc = $_POST['resource-quantity'];
    
        // Pobierz obecną ilość zasobu przed aktualizacją
        $sql_old_quantity = "SELECT ilosc FROM zasoby WHERE id = :id";
        $stmt_old_quantity = $pdo->prepare($sql_old_quantity);
        $stmt_old_quantity->execute(['id' => $id]);
        $old_quantity = $stmt_old_quantity->fetchColumn();
    
        // Aktualizuj zasób
        $sql_update = "UPDATE zasoby SET nazwa = :nazwa, ilosc = :ilosc WHERE id = :id";
        $stmt_update = $pdo->prepare($sql_update);
        $stmt_update->execute(['nazwa' => $nazwa, 'ilosc' => $ilosc, 'id' => $id]);
    
        // Dodaj wpis do tabeli zmiany_zasobow
        $sql_insert_change = "INSERT INTO zmiany_zasobow (id_zasobu, stara_ilosc, nowa_ilosc) VALUES (:id_zasobu, :stara_ilosc, :nowa_ilosc)";
        $stmt_insert_change = $pdo->prepare($sql_insert_change);
        $stmt_insert_change->execute(['id_zasobu' => $id, 'stara_ilosc' => $old_quantity, 'nowa_ilosc' => $ilosc]);
    
        // Przekieruj użytkownika na stronę zasobów
        header("Location: view_resources.php");
        exit;
    }
     
    }
    ?>
</body>
</html>
