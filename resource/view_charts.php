<?php
require 'config.php';
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wyświetl Wykresy</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
        .chart-container {
            width: 80%;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <h1>Wykresy Zasobów</h1>
    <div class="chart-container">
        <canvas id="resourceChart"></canvas>
    </div>

    <?php
    $sql = "SELECT nazwa, ilosc FROM zasoby";
    $stmt = $pdo->query($sql);
    $zasoby = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $nazwy = array_column($zasoby, 'nazwa');
    $ilosci = array_column($zasoby, 'ilosc');
    ?>

    <script>
        const ctx = document.getElementById('resourceChart').getContext('2d');
        const resourceChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($nazwy); ?>,
                datasets: [{
                    label: 'Ilość Zasobów',
                    data: <?php echo json_encode($ilosci); ?>,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
