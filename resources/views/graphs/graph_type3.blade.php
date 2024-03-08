
<body style="background-color:#020e19 ">
    <style>
        #chart-container {
            margin: 20px auto;
        }
        </style>
    <div id="chart-container" style="max-width: 800px; height: 400px;">
        <canvas id="myChart"></canvas>
    </div>
    
    <script> 
            //#5 Horizontal bar chart
            const chart3 = document.getElementById("myChart");
            var monthlyData = @json($monthlyData);

            new Chart(chart3, {
            type: "line",
            
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            
                datasets: [
                {
                    label: "jours {{$typeData}}",
                    data: monthlyData,
                    backgroundColor: "#188FFF",
                    borderWidth: 2,
                    borderColor: "#188FFF",
                    borderRadius: 4, //corresponds to border radius in pixels
                    hoverBackgroundColor: "#188FFF",
                    tension: 0.1 //0-1 on how tight the lines between the coordinates are. The more tension, the more fluid
                }
                ]
            },
            options: {
                indexAxis: "x", //makes it horizontal bar
                plugins: {
                legend: { display: true },
                title: {
                    display: true,
                    text: "jours {{$typeData}} mensuelles de employé :'{{$emply->nom}} {{$emply->prenom}}' dans l'année : {{$year}}"
                }
                },
                scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                    display: true,
                    color: "#fff"
                    }
                },
                x: {
                    grid: {
                    display: true,
                    color: "#fff"
                    }
                }
                }
            }
            });
        </script> 
</body>
