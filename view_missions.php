<?php
require 'config.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Symulator Zarządzania Zasobami w Kosmosie</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
            background-image: url('img/tlo.jpg')
        }
        header {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
            position: relative;
        }
        header img {
            position: absolute;
            top: 10px;
            left: 10px;
            
            height: auto;
            cursor: pointer;
            width: 140px; 
            margin-left: 20px;
        }
        nav {
            background-color: #666;
            color: #fff;
            padding: 10px;
            text-align: center;
        }
        nav a {
            text-decoration: none;
            color: #fff;
            margin: 0 10px;
        }
        nav a:hover {
            text-decoration: underline;
        }
        section {
            padding: 20px;
            text-align: center;
        }
        h2 {
            color: #333;
        }
        p {
            color: #666;
        }
        footer {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
        h2 {
            color: white;
            text-align: center;
        }
        table {
            width: 70%;
            margin: 20px 0;
            border-collapse: collapse;
            margin: 20px 15%
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #333;
            color: #fff;
        }
        td {
            background-color: #fff;
        }
       
    </style>
</head>
<body>
    <header>
        <a href="index.php">
            <img src="img/logo.png" alt="Logo">
        </a>
        <h1>Galactic Navigator</h1>
        <p>Aplikacja do zarządzania zasobami w kosmosie</p>
    </header>

    <nav>
        <a href="exploration.html">Eksploracja</a>
        <a href="resource-management.html">Zarządzanie zasobami</a>
        <a href="scientific-research.html">Badania naukowe</a>
        <a href="report_contact.php">Relacje międzygwiezdne</a>
    </nav>
    
       
    <h2>Nadchodzące misje</h2>
    <table>
        <tr>
            <th>Tytuł misji</th>
            <th>Cel</th>
            <th>Data startu</th>
            <th>Załoga</th>
            <th>Grafika</th>
        </tr>
        <?php
        $sql = "SELECT * FROM misje WHERE grafika IS NOT NULL";
        $stmt = $pdo->query($sql);
        $misje = $stmt->fetchAll();

        foreach ($misje as $misja) {
            $grafika = $misja['grafika'];
            echo "<tr>";
            echo "<td>{$misja['nazwa']}</td>";
            echo "<td>{$misja['cel']}</td>";
            echo "<td>{$misja['data_startu']}</td>";
            echo "<td>{$misja['zaloga']}</td>";
            echo "<td><img src='img/$grafika' width = 200px></td>";
           
                
            echo "</tr>";
        }
        ?>
    </table>
   
    
    <footer>
        <p>&copy; 2024 Galactic Navigator</p>
    </footer>
</body>
</html>
