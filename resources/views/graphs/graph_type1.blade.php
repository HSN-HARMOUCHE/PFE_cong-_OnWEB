
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
        //get ID of chart and assign to variable to use later
        const chart1 = document.getElementById("myChart");
        
        const chartBorderRadious = 12;

                // Extracted data from PHP to JavaScript
        var formateurs = @json(array_column($chartData, 'formateur'));
        var Days = @json(array_column($chartData, 'Abs_Cong_days'));
        
        //sets gradient, can learn more here https://www.w3schools.com/tags/canvas_createlineargradient.asp
        const ctx = chart1.getContext("2d");
        const backgroundGradient = ctx.createLinearGradient(0, 0, 270, 0);
        backgroundGradient.addColorStop(0, "rgba(0, 0, 0, 0)");
        backgroundGradient.addColorStop(0.2, "rgba(44, 99, 99, 50)");
        backgroundGradient.addColorStop(0.4, "rgba(44, 99, 99, 50)");
        backgroundGradient.addColorStop(1, "#188FFF");
        
        //#2 Horizontal bar chart
        new Chart(chart1, {
          type: "bar",
          data: {
            labels:formateurs,
            datasets: [
              {
                label: "jours {{$typeData}}",
                data: Days,
                backgroundColor: backgroundGradient,
                borderWidth: 1,
                borderColor: "rgba(255, 61, 131, 0)",
                borderRadius: chartBorderRadious,
                // barThickness: 16,
                barPercentage: 0.4,
                hoverBackgroundColor: "#188FFF"
              }
            ]
          },
          options: {
            indexAxis: "y", //makes it horizontal bar
            plugins: {
              legend: { display: true },
              title: {
                display: true ,
                text:"Évolution des jours {{$typeData}} par formateur pour l'année {{$year}}"
              }
            },
            scales: {
              y: {
                grid: {
                  display: false //no horizontal grid lines
                }
              },
              x: {
                grid: {
                  //sets color and makes stroke lines dashed
                  color: "#2A3E56"
                },
                border: {
                  dash: [4, 4] //sets dotted lines on grid
                }
              }
            }
          }
        });
        </script> 
</body>
