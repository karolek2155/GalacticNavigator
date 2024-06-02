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
            background-image: url('img/tlo.jpg')
        }
        header {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
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
            color: white;
            
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
            color: #333;
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
            text-align: left;
        }
        th {
            background-color: #333;
            color: #fff;
        }
        td {
            background-color: #fff;
        }
        h1 {
            color: #fff;
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
        header img {
            position: absolute;
            top: 10px;
            left: 10px;
            height: auto;
            cursor: pointer;
            width: 140px;
            margin-left: 20px;
        }
       
    </style>
</head>
<body>
        
    <header>
        <a href="index.php">
            <img src="img/logo.png" alt="Logo" style="width: 140px">
        </a>
        <h1>Galactic Navigator</h1>
        <p>Relacje międzygwiezdne</p>
    </header>

    <nav>
        <a href="report_contact.php">Zarejestruj kontakt z cywilizacją</a>
        <a href="manage_relations.php">Zarządzanie relacjami cywilizacyjnymi</a>
        <a href="diplomation.php">Dyplomacja</a>
        
    </nav>
    <h1>Zarządzanie relacjami międzygwiezdnymi</h1>
    <table>
        <tr>
            <th>Nazwa cywilizacji</th>
            <th>Planeta</th>
            <th>Nastawienie(0-10)</th>
            <th>technologia</th>
            <th>Grafika</th>
            <th>Edytuj</th>
            
        </tr>
        <?php
        $sql = "SELECT id, cywilizacja, planeta, nastawienie, technologia, grafika FROM kontakty_cywilizacyjne";
        $stmt = $pdo->query($sql);
        $cywilizacje = $stmt->fetchAll();

        foreach ($cywilizacje as $a) {
            echo "<tr>";
            echo "<td>{$a['cywilizacja']}</td>";
            echo "<td>{$a['planeta']}</td>";
            //echo "<td>{$a['nastawienie']}</td>";
            $nastawienie = $a['nastawienie'];
            if($nastawienie < 3){
                echo "<td style='color: red'><h3>$nastawienie</h3>(zagrożenie konfliktem!)</td>";
            }
            elseif($nastawienie < 5){
                echo "<td style='color: orange'><h3>$nastawienie</h3></td>";
            }
            elseif($nastawienie < 8){
                echo "<td style='color: yellow'><h3>$nastawienie</h3></td>";
            }
            else{
                echo "<td style='color: green'><h3>$nastawienie</h3></td>";
            }
            echo "<td>{$a['technologia']}</td>";
            
            $grafika = $a['grafika'];
            echo "<td><img src='img/$grafika' alt='brak grafiki'></td>";
            echo "<td>
                <p><form action='edit_relations.php' method='post' style='display:inline;'>
                    <input type='hidden' name='id' value='{$a['id']}'>
                    <input type='submit' value='Edytuj'>
                </form></p>
                
            </td>";
            echo "</tr>";
        }
        ?>

    
   

    <footer>
        <p>&copy; 2024 Galactic Navigator</p>
    </footer>
</body>
</html>

