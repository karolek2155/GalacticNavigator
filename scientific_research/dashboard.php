<?php
$db_host = 'localhost';
$db_user = 'root'; // Zmień na swoje dane logowania
$db_password = '';
$db_name = 'galacticnavigator';

try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Zapytanie SQL dla postępu w projektach badawczych w czasie
    $sql_postep = "
        SELECT p.nazwa, m.postep_nowy, m.data
        FROM projekty_badawcze p
        JOIN monitorowanie m ON p.id = m.projekt_id
        ORDER BY p.nazwa, m.data
    ";
    $stmt_postep = $pdo->prepare($sql_postep);
    $stmt_postep->execute();
    $postepy = $stmt_postep->fetchAll(PDO::FETCH_ASSOC);
    $postepy_json = json_encode($postepy);
} catch(PDOException $e) {
    $error_message = "Błąd połączenia z bazą danych: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Badań Naukowych</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.css">
  <style>
    .container {
      max-width: 800px;
      margin: 0 auto;
      text-align: center;
    }
    h1 {
      margin-bottom: 30px;
    }
    #postepy-chart {
      max-width: 800px;
      margin: 0 auto;
    }
  </style>
</head>
<body>
    <div class="container">
        <h1>Postęp w Projektach Badawczych</h1>
        <div id="postepy-chart"></div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            <?php if (isset($postepy_json)): ?>
                const postepyData = <?php echo $postepy_json; ?>;

                // Grupowanie danych według projektów
                const groupedData = postepyData.reduce((acc, item) => {
                    if (!acc[item.nazwa]) {
                        acc[item.nazwa] = [];
                    }
                    acc[item.nazwa].push({ x: item.data, y: item.postep_nowy });
                    return acc;
                }, {});

                // Przygotowanie danych do wykresu
                const seriesData = Object.keys(groupedData).map(projectName => {
                    return {
                        name: projectName,
                        data: groupedData[projectName]
                    };
                });

                var postepyChart = new ApexCharts(document.querySelector("#postepy-chart"), {
                    series: seriesData,
                    chart: {
                        type: 'line',
                        height: 350
                    },
                    dataLabels: {
                        enabled: false
                    },
                    xaxis: {
                        type: 'datetime',
                        title: {
                            text: 'Data'
                        }
                    },
                    yaxis: {
                        title: {
                            text: 'Postęp'
                        }
                    }
                });

                postepyChart.render();
            <?php else: ?>
                console.error('Błąd połączenia z bazą danych');
            <?php endif; ?>
        });
    </script>
</body>
</html>
