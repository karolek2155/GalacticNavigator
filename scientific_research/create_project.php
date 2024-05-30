<?php
require '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nazwa = $_POST["nazwa"];
    $cel = $_POST["cel"];
    $zasoby_potrzebne = $_POST["zasoby_potrzebne"];
    $harmonogram = $_POST["harmonogram"];

    $sql = "INSERT INTO projekty_badawcze (nazwa, cel, zasoby_potrzebne, harmonogram) VALUES (:nazwa, :cel, :zasoby_potrzebne, :harmonogram)";
    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':nazwa', $nazwa);
    $stmt->bindParam(':cel', $cel);
    $stmt->bindParam(':zasoby_potrzebne', $zasoby_potrzebne);
    $stmt->bindParam(':harmonogram', $harmonogram);

    if ($stmt->execute()) {
        echo "Nowy projekt został dodany.";
    } else {
        echo "Błąd: Nie udało się dodać projektu.";
    }
    header("Location: form/add_project.html");
    exit;
}
?>
