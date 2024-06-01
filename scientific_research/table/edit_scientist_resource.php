<?php
require '../../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['update'])) {
        // Aktualizacja zasobu naukowca
        $id = $_POST['id'];
        $imie = $_POST['imie'];
        $nazwisko = $_POST['nazwisko'];
        $specjalizacja = $_POST['specjalizacja'];
        $zasob = $_POST['zasob'];
        $ilosc = $_POST['ilosc'];

        $sql_update = "UPDATE naukowcy SET imie = :imie, nazwisko = :nazwisko, specjalizacja = :specjalizacja WHERE id = :id";
        $stmt_update = $pdo->prepare($sql_update);
        $stmt_update->execute([
            'imie' => $imie,
            'nazwisko' => $nazwisko,
            'specjalizacja' => $specjalizacja,
            'id' => $id
        ]);

        $sql_update_zasob = "UPDATE przypisania SET zasob = :zasob, ilosc = :ilosc WHERE naukowiec_id = :id";
        $stmt_update_zasob = $pdo->prepare($sql_update_zasob);
        $stmt_update_zasob->execute([
            'zasob' => $zasob,
            'ilosc' => $ilosc,
            'id' => $id
        ]);

        header("Location: view_scientists_resources.php");
        exit;
    } elseif (isset($_POST['id'])) {
        // Pobierz dane do formularza edycji
        $id = $_POST['id'];
        $sql = "SELECT naukowcy.id, naukowcy.imie, naukowcy.nazwisko, naukowcy.specjalizacja, przypisania.zasob, przypisania.ilosc 
                FROM przypisania 
                JOIN naukowcy ON przypisania.naukowiec_id = naukowcy.id 
                WHERE naukowcy.id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        $dane = $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edycja Zasobu Naukowca</title>
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
        textarea, input[type="text"], input[type="number"] {
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
    <h1>Edycja Zasobu Naukowca</h1>
    <?php if (isset($dane)): ?>
    <form action="edit_scientist_resource.php" method="post">
        <label for="imie">Imię:</label>
        <input type="text" id="imie" name="imie" value="<?php echo $dane['imie']; ?>" required>

        <label for="nazwisko">Nazwisko:</label>
        <input type="text" id="nazwisko" name="nazwisko" value="<?php echo $dane['nazwisko']; ?>" required>

        <label for="specjalizacja">Specjalizacja:</label>
        <input type="text" id="specjalizacja" name="specjalizacja" value="<?php echo $dane['specjalizacja']; ?>" required>

        <label for="zasob">Zasób:</label>
        <input type="text" id="zasob" name="zasob" value="<?php echo $dane['zasob']; ?>" required>

        <label for="ilosc">Ilość:</label>
        <input type="number" id="ilosc" name="ilosc" value="<?php echo $dane['ilosc']; ?>" required>

        <input type="hidden" name="id" value="<?php echo $dane['id']; ?>">
        <input type="submit" name="update" value="Zapisz zmiany">
    </form>
    <?php else: ?>
    <p>Nie znaleziono zasobu do edycji.</p>
    <?php endif; ?>
</body>
</html>
