<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ARIMA Model</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-moment"></script> <!-- Add this line -->

    <!-- Configure Chart.js to use Moment.js -->
    <script>
        Chart.register(ChartMoment); // Register the adapter
    </script>
</head>
@extends('adminlte::page')
@section('content')
<body>
    <h1>ARIMA Model</h1>

    <label for="startDate">Desde: </label>
    <input type="date" id="startDate" required>

    <label for="endDate">Hasta :</label>
    <input type="date" id="endDate" required>

    <button onclick="fetchData()">Proyeccion</button>

    <canvas id="arimaChart" width="800" height="400"></canvas>

    <script>
        var myChart;   
        function fetchData() {
            var startDate = document.getElementById('startDate').value;
            var endDate = document.getElementById('endDate').value;

            if (!startDate || !endDate) {
                alert("Porfavor seleccione un intervalo de tiempo");
                return;
            }
            console.log(startDate);
            console.log(endDate);
            fetch(`http://3.22.167.79/get_data?startDate=${startDate}&endDate=${endDate}`)
                .then(response => response.json())
                .then(arimaResult => {
                    var dates = arimaResult.dates.slice(1);;
                    var actualCounts = arimaResult.actual.slice(1);;
                    var fittedValues = arimaResult.fitted_values;
                    var lastDate = dates[dates.length - 1];

                    var extendedDates = dates.concat(getNextWeeksDates(lastDate, 6));
                    var extendedFittedValues = fittedValues.concat(new Array(6).fill(null));

                    // Create a chart using Chart.js
                    if (myChart) {
                        myChart.destroy();
                    }
                    var ctx = document.getElementById('arimaChart').getContext('2d');
                    myChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: extendedDates,
                            datasets: [
                                {
                                    label: 'Pacientes',
                                    data: actualCounts,
                                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                    borderColor: 'rgba(75, 192, 192, 1)',
                                    borderWidth: 1
                                },
                                {
                                    label: 'Proyeccion',
                                    data: extendedFittedValues,
                                    borderColor: 'rgba(255, 99, 132, 1)',
                                    borderWidth: 1,
                                    borderDash: [5, 5] 
                                }
                            ]
                        },
                        options: {
                            scales: {
                                x: {
                                    type: 'time', 
                                    time: {
                                        unit: 'week' 
                                    },
                                    title: {
                                        display: true,
                                        text: 'Semanas'
                                    }
                                },
                                y: {
                                    beginAtZero: true,
                                    title: {
                                        display: true,
                                        text: 'Pacientes'
                                    }
                                }
                            }
                        }
                    });
                })
                .catch(error => console.error('Error fetching ARIMA results:', error));
            }

            function getNextWeeksDates(lastDate, weeks) {
                var currentDate = new Date(lastDate);
                var nextWeeksDates = [];
            
                for (var i = 1; i <= weeks; i++) {
                    var nextDate = new Date(currentDate);
                    nextDate.setDate(nextDate.getDate() + 7 * i);
                    nextWeeksDates.push(nextDate.toISOString().split('T')[0]);
                }
            
                return nextWeeksDates;
            }    
    </script>

    
</body>
</html>
@endsection