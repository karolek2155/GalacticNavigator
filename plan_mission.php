<?php
include 'connect.php';
?>

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
    <form method="post" action="">
        <label for="mission-goal">Cel misji:</label>
        <input type="text" id="mission-goal" name="mission-goal" required>

        <label for="mission-crew">Załoga:</label>
        <input type="text" id="mission-crew" name="mission-crew" required>

        <label for="mission-resources">Zasoby:</label>
        <input type="text" id="mission-resources" name="mission-resources" required>

        <label for="mission-start-date">Data rozpoczęcia:</label>
        <input type="date" id="mission-start-date" name="mission-start-date" required>

        <label for="mission-end-date">Data zakończenia:</label>
        <input type="date" id="mission-end-date" name="mission-end-date" required>

        <input type="submit" value="Zaplanuj misję">
    </form>
</body>
</html>