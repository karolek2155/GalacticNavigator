<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wyświetlanie zdjęć</title>
    <style>
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            margin: 5px auto;
        }
        .image {
            width: 300px;
            height: 420px;
            margin: 10px;
            border: 1px solid #ddd; /* Dodaj ramkę do zdjęcia */
            border-radius: 5px; /* Zaokrągl brzegi */
            overflow: hidden; /* Ukryj ewentualne obcięte elementy */
        }
        .image img {
            width: 100%;
            height: 100%;
            object-fit: cover; /* Zapewnia, że obraz będzie wypełniał kontener */
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="image">
            <img src="../img/fotor-ai-1.jpg" alt="foto-ai 1">
        </div>
        <div class="image">
            <img src="../img/fotor-ai-2.jpg" alt="foto-ai 2">
        </div>
        <div class="image">
            <img src="../img/fotor-ai-3.jpg" alt="foto-ai 3">
        </div>
        <div class="image">
            <img src="../img/fotor-ai-4.jpg" alt="foto-ai 4">
        </div>
        <div class="image">
            <img src="../img/fotor-ai-5.jpg" alt="foto-ai 5">
        </div>
        <div class="image">
            <img src="../img/fotor-ai-6.jpg" alt="foto-ai 6">
        </div>
        
    </div>
</body>
</html>
