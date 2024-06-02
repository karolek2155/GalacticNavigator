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
            background-image: url('img/tlo.jpg');
            color: #fff; /* Change the text color to white */
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
            color: #fff; /* Ensure section text is white */
            max-width: 800px; /* Limit the width of the section */
            margin: 0 auto; /* Center the section */
            background-color: rgba(0, 0, 0, 0.7); /* Add background color to the text block */
            border-radius: 20px; /* Add border radius for rounded corners */
            margin-top: 50px;
            
        }
        h2 {
            color: #fff; /* Ensure heading text is white */
        }
        p {
            color: #fff; /* Ensure paragraph text is white */
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
        table {
            width: 70%;
            margin: 20px 0;
            border-collapse: collapse;
            margin: 20px 15%;
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
            color: #000; /* Ensure table data text is readable */
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
    
    <section>
        <h2>Witamy w Galactic Navigator!</h2>
        <p>Galactic Navigator to zaawansowana aplikacja webowa umożliwiająca zarządzanie koloniami kosmicznymi. Nasza platforma oferuje szeroki wachlarz funkcjonalności, które pozwolą Ci na eksplorację nowych planet, zarządzanie zasobami, prowadzenie badań naukowych oraz utrzymywanie relacji międzygwiezdnych.</p>
        
        <p>Planuj i zarządzaj misjami eksploracyjnymi, odkrywaj nowe światy, rejestruj cenne surowce oraz dokumentuj kontakty z nowymi cywilizacjami. Monitoruj i optymalizuj stan zasobów, zarządzaj produkcją, magazynowaniem i handlem. Twórz i rozwijaj projekty badawcze, przypisuj naukowców i zasoby do badań oraz śledź postępy w różnych dziedzinach nauki. Zarządzaj dyplomacją, nawiązuj sojusze, zawieraj traktaty handlowe i podejmuj strategiczne decyzje wojenne.</p>
        
        <p>Skorzystaj z interaktywnych dashboardów, które wizualizują odkrycia, stany zasobów, postępy badań oraz relacje międzygwiezdne, aby skutecznie zarządzać swoim kosmicznym imperium.</p>
    </section>
    
    <footer>
        <p>&copy; 2024 Galactic Navigator</p>
    </footer>
</body>
</html>
