<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    // Fetch the current data
    $sql = "SELECT cywilizacja, planeta, nastawienie, technologia, grafika FROM kontakty_cywilizacyjne WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $cywilizacja = $stmt->fetch();

    if ($cywilizacja) {
        $cywilizacja_name = $cywilizacja['cywilizacja'];
        $planeta = $cywilizacja['planeta'];
        $nastawienie = $cywilizacja['nastawienie'];
        $technologia = $cywilizacja['technologia'];
        $grafika = $cywilizacja['grafika'];
    } else {
        echo "Cywilizacja nie została znaleziona.";
        exit;
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['update'])) {
    $id = $_GET['id'];
    $cywilizacja_name = $_GET['cywilizacja'];
    $planeta = $_GET['planeta'];
    $nastawienie = $_GET['nastawienie'];
    $technologia = $_GET['technologia'];
    $grafika = $_GET['grafika'];

    // Update the data
    $sql = "UPDATE kontakty_cywilizacyjne SET cywilizacja = ?, planeta = ?, nastawienie = ?, technologia = ?, grafika = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$cywilizacja_name, $planeta, $nastawienie, $technologia, $grafika, $id]);

    // Redirect back to the main page
    header('Location: manage_relations.php');
    exit;
} else {
    echo "Niepoprawne żądanie.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edytuj Cywilizację</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }
        header {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
        }
        section {
            padding: 20px;
            text-align: center;
        }
        form {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }
        input[type="text"],
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
            width: 80%;
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
    <header>
        <h1>Edytuj Cywilizację</h1>
    </header>
    <section>
        <form action="edit_relations.php" method="get">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
            <label for="cywilizacja">Nazwa cywilizacji:</label>
            <input type="text" id="cywilizacja" name="cywilizacja" value="<?php echo htmlspecialchars($cywilizacja_name); ?>" required>
            
            <label for="planeta">Planeta:</label>
            <input type="text" id="planeta" name="planeta" value="<?php echo htmlspecialchars($planeta); ?>" required>
            
            <label for="nastawienie">Nastawienie:</label>
            <input type="number" max="10" id="nastawienie" name="nastawienie" value="<?php echo htmlspecialchars($nastawienie); ?>" required>
            
            <label for="technologia">Technologia:</label>
            <input type="text" id="technologia" name="technologia" value="<?php echo htmlspecialchars($technologia); ?>" required>
            
            <label for="grafika">Grafika:</label>
            <input type="text" id="grafika" name="grafika" value="<?php echo htmlspecialchars($grafika); ?>" required>
            
            <input type="hidden" name="update" value="1">
            <input type="submit" value="Aktualizuj">
        </form>
    </section>
</body>
</html>
