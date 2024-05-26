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
    </style>
</head>
<body>
    <div class="content">
        <h1>Wykresy Zasobów</h1>
        <div class="charts-container">
            <div class="chart-container">
                <canvas id="resourceChart"></canvas>
            </div>
            <div class="chart-container">
                <canvas id="resourceChartChanges"></canvas>
            </div>
        </div>
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
        // Wykres ilości zasobów
        const ctx_quantity = document.getElementById('resourceChart').getContext('2d');
        const resourceChart = new Chart(ctx_quantity, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($nazwy); ?>,
                datasets: [{
                    data: <?php echo json_encode($ilosci); ?>,
                    backgroundColor: 'rgba(<?php echo rand(0, 255); ?>, <?php echo rand(0, 255); ?>, <?php echo rand(0, 255); ?>, 0.2)',
                    borderColor: 'rgba(<?php echo rand(0, 255); ?>, <?php echo rand(0, 255); ?>, <?php echo rand(0, 255); ?>, 1)',
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
                        backgroundColor: 'rgba(<?php echo rand(0, 255); ?>, <?php echo rand(0, 255); ?>, <?php echo rand(0, 255); ?>, 0.2)',
                        borderColor: 'rgba(<?php echo rand(0, 255); ?>, <?php echo rand(0, 255); ?>, <?php echo rand(0, 255); ?>, 1)',
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
                        labels: {
                            generateLabels: function(chart) {
                                const datasets = chart.data.datasets;
                                return datasets.map(function(dataset, i) {
                                    return {
                                        text: dataset.label,
                                        fillStyle: dataset.backgroundColor,
                                        strokeStyle: dataset.borderColor,
                                        lineWidth: dataset.borderWidth,
                                        hidden: chart.isDatasetVisible(i),
                                        lineCap: dataset.borderCapStyle,
                                        lineDash: dataset.borderDash,
                                        lineDashOffset: dataset.borderDashOffset,
                                        lineJoin: dataset.borderJoinStyle,
                                        lineWidth: dataset.borderWidth,
                                        pointStyle: dataset.pointStyle,
                                        rotation: dataset.labelRotation,
                                        fontColor: dataset.fontColor,
                                        fontFamily: dataset.fontFamily,
                                        fontSize: dataset.fontSize,
                                        fontStyle: dataset.fontStyle,
                                        padding: dataset.padding,
                                        sampleSize: 100
                                    };
                                });
                            }
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>
