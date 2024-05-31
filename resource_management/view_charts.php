<?php
require '../config.php';
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wyświetl Wykresy</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/adapters/moment.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .content {
            width: 80%;
        }
        h1 {
            color: #333;
            text-align: center;
        }
        .charts-container {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
        }
        .chart-container {
            width: 45%;
        }
        .download-button {
            display: block;
            margin: 10px auto;
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
         
    </style>
</head>
<body>
    <div class="content">
        <h1>Wykresy Zasobów</h1>
        <div class="charts-container">
            <div class="chart-container">
                <canvas id="resourceChart"></canvas>
                <button class="download-button" onclick="downloadChart('resourceChart', 'zasoby.png')">Pobierz Wykres Zasobów</button>
            </div>
            <div class="chart-container">
                <canvas id="resourceChartChanges"></canvas>
                <button class="download-button" onclick="downloadChart('resourceChartChanges', 'zmiany_zasobow.png')">Pobierz Wykres Zmian Zasobów</button>
            </div>
    

    <?php
    // Pobierz dane zasobów
    $sql_quantity = "SELECT nazwa, ilosc FROM zasoby";
    $stmt_quantity = $pdo->query($sql_quantity);
    $zasoby = $stmt_quantity->fetchAll(PDO::FETCH_ASSOC);

    // Pobierz dane zmian zasobów
    $sql_changes = "SELECT z.nazwa AS nazwa_zasobu, zc.data, zc.nowa_ilosc FROM zasoby z JOIN zmiany_zasobow zc ON z.id = zc.id_zasobu ORDER BY zc.data";
    $stmt_changes = $pdo->query($sql_changes);
    $changes = $stmt_changes->fetchAll(PDO::FETCH_ASSOC);

    // Przygotuj dane dla wykresu ilości zasobów
    $nazwy = array_column($zasoby, 'nazwa');
    $ilosci = array_column($zasoby, 'ilosc');

    // Generuj kolory dla każdej nazwy zasobu
    $colors = [];
    foreach ($nazwy as $nazwa) {
        $colors[$nazwa] = sprintf('rgba(%d, %d, %d, 0.2)', rand(0, 255), rand(0, 255), rand(0, 255));
    }

    // Przygotuj dane dla wykresu zmian zasobów
    $data_changes = [];

    foreach ($changes as $change) {
        if (!isset($data_changes[$change['nazwa_zasobu']])) {
            $data_changes[$change['nazwa_zasobu']] = [];
        }
        $data_changes[$change['nazwa_zasobu']][] = ['x' => $change['data'], 'y' => $change['nowa_ilosc']];
    }

    // Przygotuj dane dla osi X wykresu zmian zasobów (daty zmian)
    $dates = array_column($changes, 'data');
    ?>

    <script>
        const colors = <?php echo json_encode($colors); ?>;

        // Wykres ilości zasobów
        const ctx_quantity = document.getElementById('resourceChart').getContext('2d');
        const resourceChart = new Chart(ctx_quantity, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($nazwy); ?>,
                datasets: [{
                    data: <?php echo json_encode($ilosci); ?>,
                    backgroundColor: Object.values(colors),
                    borderColor: Object.values(colors).map(color => color.replace('0.2', '1')),
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });

        // Wykres zmian zasobów
        const ctx_changes = document.getElementById('resourceChartChanges').getContext('2d');
        const resourceChartChanges = new Chart(ctx_changes, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($dates); ?>,
                datasets: [
                    <?php foreach ($data_changes as $nazwa_zasobu => $data): ?>
                    {
                        label: '<?php echo $nazwa_zasobu; ?>',
                        data: <?php echo json_encode($data); ?>,
                        backgroundColor: colors['<?php echo $nazwa_zasobu; ?>'],
                        borderColor: colors['<?php echo $nazwa_zasobu; ?>'].replace('0.2', '1'),
                        borderWidth: 1
                    },
                    <?php endforeach; ?>
                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    },
                    x: {
                        title: {
                            display: false // Usuń tytuł osi X
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: true
                    }
                }
            }
        });

        // Funkcja do pobierania wykresu jako obrazu
function downloadChart(chartId, filename) {
    const canvas = document.getElementById(chartId);
    
    // Utwórz obiekt Blob
    canvas.toBlob(function(blob) {
        const url = window.URL.createObjectURL(blob);

        // Utwórz link i kliknij go
        const link = document.createElement('a');
        link.download = filename;
        link.href = url;
        link.click();

        // Zwolnij zasoby
        window.URL.revokeObjectURL(url);
    });
}
    </script>
</body>
</html>
