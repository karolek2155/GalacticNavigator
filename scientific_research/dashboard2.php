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

    // Zapytanie SQL dla przypisania zasobów
    $sql_przypisanie = "
        SELECT p.nazwa, prz.ilosc
        FROM projekty_badawcze p
        JOIN przypisania prz ON p.id = prz.projekt_id
    ";
    $stmt_przypisanie = $pdo->prepare($sql_przypisanie);
    $stmt_przypisanie->execute();
    $przypisania = $stmt_przypisanie->fetchAll(PDO::FETCH_ASSOC);
    $przypisania_json = json_encode($przypisania);

    // Zapytanie SQL dla wyników badań
    $sql_wyniki = "
        SELECT p.nazwa, m.wyniki
        FROM projekty_badawcze p
        JOIN monitorowanie m ON p.id = m.projekt_id
    ";
    $stmt_wyniki = $pdo->prepare($sql_wyniki);
    $stmt_wyniki->execute();
    $wyniki = $stmt_wyniki->fetchAll(PDO::FETCH_ASSOC);
    $wyniki_json = json_encode($wyniki);
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.27.0/apexcharts.min.css">
  <style>
    .container {
      max-width: 800px;
      margin: 0 auto;
      text-align: center;
    }
    h1 {
      margin-bottom: 30px;
    }
    .chart-container {
      margin-top: 50px;
    }
    .chart {
      max-width: 800px;
      margin: 0 auto;
    }
  </style>
</head>
<body>
    <div class="container">
        <h1>Dashboard</h1>
        <div class="chart-container">
            <h2>Postęp w Projektach Badawczych</h2>
            <div id="postepy-chart" class="chart"></div>
        </div>
        <div class="chart-container">
            <h2>Przypisanie Zasobów</h2>
            <div id="przypisanie-chart" class="chart"></div>
        </div>
        <div class="chart-container">
            <h2>Wyniki Badań</h2>
            <div id="wyniki-chart" class="chart"></div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            <?php if (isset($postepy_json) && isset($przypisania_json) && isset($wyniki_json)): ?>
                const postepyData = <?php echo $postepy_json; ?>;
                const przypisaniaData = <?php echo $przypisania_json; ?>;
                const wynikiData = <?php echo $wyniki_json; ?>;

                // Grupowanie danych według projektów dla wykresu postępu
                const groupedPostepyData = postepyData.reduce((acc, item) => {
                    if (!acc[item.nazwa]) {
                        acc[item.nazwa] = [];
                    }
                    acc[item.nazwa].push({ x: item.data, y: item.postep_nowy });
                    return acc;
                }, {});

                const postepySeries = Object.keys(groupedPostepyData).map(projectName => ({
                    name: projectName,
                    data: groupedPostepyData[projectName]
                }));

                var postepyChart = new ApexCharts(document.querySelector("#postepy-chart"), {
                    series: postepySeries,
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

                // Grupowanie danych dla przypisania zasobów
                const przypisaniaSeries = przypisaniaData.reduce((acc, item) => {
                    const found = acc.find(a => a.name === item.nazwa);
                    if (found) {
                        found.data.push(item.ilosc);
                    } else {
                        acc.push({
                            name: item.nazwa,
                            data: [item.ilosc]
                        });
                    }
                    return acc;
                }, []);

                var przypisanieChart = new ApexCharts(document.querySelector("#przypisanie-chart"), {
                    series: przypisaniaSeries,
                    chart: {
                        type: 'bar',
                        height: 350
                    },
                    plotOptions: {
                        bar: {
                            horizontal: false
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    xaxis: {
                        categories: przypisaniaData.map(item => item.nazwa),
                        title: {
                            text: 'Projekt Badawczy'
                        }
                    },
                    yaxis: {
                        title: {
                            text: 'Przypisanie Zasobów'
                        }
                    }
                });

                przypisanieChart.render();

                // Grupowanie danych dla wyników badań
                const wynikiSeries = wynikiData.reduce((acc, item) => {
                    const found = acc.find(a => a.name === item.nazwa);
                    if (found) {
                        found.data.push(item.wyniki);
                    } else {
                        acc.push({
                            name: item.nazwa,
                            data: [item.wyniki]
                        });
                    }
                    return acc;
                }, []);

                var wynikiChart = new ApexCharts(document.querySelector("#wyniki-chart"), {
                    series: wynikiSeries,
                    chart: {
                        type: 'bar',
                        height: 350
                    },
                    plotOptions: {
                        bar: {
                            horizontal: false
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    xaxis: {
                        categories: wynikiData.map(item => item.nazwa),
                        title: {
                            text: 'Projekt Badawczy'
                        }
                    },
                    yaxis: {
                        title: {
                            text: 'Wynik Badania'
                        }
                    }
                });

                wynikiChart.render();
            <?php else: ?>
                console.error('Błąd połączenia z bazą danych');
            <?php endif; ?>
        });
    </script>
</body>
</html>
