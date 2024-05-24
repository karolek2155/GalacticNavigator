<?php
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    $sql = "DELETE FROM zasoby WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);

    echo "<p>Zasób został usunięty pomyślnie!</p>";
    echo "<a href='view_resources.php'>Powrót do zasobów</a>";
}
?>
