
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
            color: #fff;
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
            color: white;
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
    <h2>Zgłoś kontakt</h2>
    <form method="post" action="">

    <label for="name">Nazwa cywilizacji:</label>
        <input type="text" id="name" name="name" required>

        <label for="interakcje">Interakcje:</label>
        <input type="text" id="interakcje" name="interakcje" required>

        <label for="kultura">Kultura:</label>
        <input type="text" id="kultura" name="kultura" required>

        <label for="planeta">Planeta:</label>
        <input type="text" id="planeta" name="planeta" required>

        <label for="nastawienie">Nastawienie (1-10):</label>
        <input type="number" max="10" id="nastawienie" name="nastawienie" required>

        <label for="technologia">Technologia:</label>
        <input type="text" id="technologia" name="technologia" required>

        <label for="image">Dodaj grafikę (opcjonalne):</label>
        <input type="text" id="image" name="image">

        <input type="submit" value="Zgłoś kontakt" name="submit">
    </form>
    <?php
    $conn = new mysqli('localhost', 'root', '', 'galacticnavigator');

     if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['submit'])) {
        $name = $_POST['name'];   
        $interakcje = $_POST['interakcje'];
        $kultura = $_POST['kultura'];
        $planeta = $_POST['planeta'];
        $nastawienie = $_POST['nastawienie'];
        $technologia = $_POST['technologia'];
        $image = $_POST['image'];
        
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
    
        $sql = "INSERT INTO kontakty_cywilizacyjne (cywilizacja, interakcje, kultura, planeta, nastawienie, technologia, grafika) VALUES ('$name', '$interakcje', '$kultura', '$planeta', '$nastawienie', '$technologia', '$image')";
    
        if ($conn->query($sql) === TRUE) {
            echo "<p style='color:green; text-align:center;'>Nowa misja została zaplanowana pomyślnie!</p>";
        } else {
            echo "<p style='color:red; text-align:center;'>Błąd: " . $sql . "<br>" . $conn->error . "</p>";
        }
    
        $conn->close();
    }
}
    ?>
        
    
   

    <footer>
        <p>&copy; 2024 Galactic Navigator</p>
    </footer>
</body>
</html>

