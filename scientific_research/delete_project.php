<?php
require '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];

    $sql = "DELETE FROM projekty_badawcze WHERE id = :id";
    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        echo "Projekt został usunięty.";
    } else {
        echo "Błąd: Nie udało się usunąć projektu.";
    }
    header("Location: view_project.php");
    exit;
}
?>
