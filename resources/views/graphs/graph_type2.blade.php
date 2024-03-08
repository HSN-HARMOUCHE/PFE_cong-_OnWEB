
<body style="background-color:#020e19 ">
    <style>
        #chart-container {
            margin: 20px auto;
            display: flex;
            justify-content: center; /* Center horizontally */
            align-items: center; /* Center vertically */
        }
        </style>
    <div id="chart-container" style="max-width: 800px; height: 400px;">
        <canvas id="myChart"></canvas>
    </div>
    
    <script>
        //#3 Vertical bar chart
        const chart2 = document.getElementById("myChart");

        var formateurs = @json(array_column($chartData, 'formateur'));
        var Count = @json(array_column($chartData, 'Nbr_Abs_Cong_days'));
        
        new Chart(chart2, {
            type: "bar",
            
            data: {
                labels:formateurs ,
            
                datasets: [
                {
                    label: "Number {{$typeData}}",
                    data: Count ,
                    backgroundColor: "#188FFF",
                    borderWidth: 1,
                    borderRadius: 4 //corresponds to border radius in pixels
                }
                ]
            },
            options: {
                indexAxis: "x", //makes it vertical bar
                plugins: {
                legend: { display: true },
                title: {
                    display: true,
                    text: "Répartition des jours {{$typeData}} par formateur dans l'année {{$year}}"
                }
                },
                scales: {
                y: {
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
