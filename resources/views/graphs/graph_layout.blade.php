@extends('layouts.app')

@section('content')



<head>
  <title>Graphs</title>

  <meta charset="utf-8">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> 
  <link rel="stylesheet" href="{{asset('b-select/dist/css/bootstrap-select.css')}}">
  <style>
    label{
      color: white ;
    }
    .container {
      display: flex;
      align-items: center;
      justify-content: space-around;
    }
    .text{
      font-size: 14px !important;
      color: var(--text-color) !important;
      padding: 0px 0px !important;
    }
    
    .loading-div {
    display: flex;
    justify-content: center; /* Center horizontally */
    align-items: center; /* Center vertically */
    display: none; 
    }


  </style>
</head>
<body>

    <div class="container">
      <form id="searchForm" class="form-horizontal form" role="form" method="POST" action="{{url('graph')}}">
        @csrf
        <div class="form-group">
          
          <div class="col-lg-3" style="width: 200px;">
            <label>Type de donnée</label>
            <select name="typedata" class="selectpicker form-control" id="data" data-container="body" title="Select Type" data-hide-disabled="true" required>
              <option value="C">Congé Graph</option>
              <option value="A">Absence Graph</option>
            </select>
          </div>
    
          <div class="col-lg-3" style="width: 200px;" >
            <label>Type de Graph</label>
            <select name="typegraph" class="selectpicker form-control" id="t_graph"  data-container="body" title="Select Type de Graph" data-hide-disabled="true" required>
              <option value="G1">📊 Évolution annuelle des jours de non-disponibilité par f͟o͟r͟m͟a͟t͟e͟u͟r͟</option>
              <option value="G2">📊 Répartition annuelle des événements par f͟o͟r͟m͟a͟t͟e͟u͟r͟ </option>
              <option value="G3">📉 Fréquence mensuelle des événements pour un e͟m͟p͟l͟o͟y͟é donné au cours de l'année</option>
            </select>
          </div>
    
          <div class="col-lg-3" style="width:150px;">
            <label>Année donnée</label>
            <select name="year" class="selectpicker form-control" id="years" data-container="body" title="Select Année" data-hide-disabled="true" required>
            </select>
          </div>
    
          <div class="col-lg-3" id="emply" style="display: none; width: 200px;">
            <label>Employée</label>
            <select name="emply" id="emplySelect" class="selectpicker form-control"  data-container="body" data-live-search="true" title="Select Employée" data-hide-disabled="true"  >
              @foreach($emplydata as $emply)
              <option value="{{$emply->mat}}">{{$emply->mat}} - {{$emply->nom}} {{$emply->prenom}}</option>
              @endforeach
            </select>
          </div>
    
          <div class="col-lg-1" style="width: 50px;"> <!-- Adjusted width to fit the button -->
            <button id="searchbtn" type="submit" class="btn btn-primary" style="margin-top:24px"><i class="fas fa-search"></i></button>
          </div>
    
        </div>
      </form>
    </div>
    <hr/>
    
    <div class="loading-div">
      <img src="{{asset('imgs/loadingChart.gif')}}" alt="Loading..."/>
    </div>

    <div id="Charts">
    </div>
    



<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="{{asset('b-select/dist/js/bootstrap-select.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
   
      // years generate
        document.addEventListener("DOMContentLoaded", function() {
            // Get the current year
            const currentYear = new Date().getFullYear();

            // Populate the select with the current year, next year, and 3 years before the current year
            for (let i = currentYear - 4; i <= currentYear + 1; i++) {
                const option = document.createElement("option");
                option.value = i;
                option.text = i;
                document.getElementById("years").appendChild(option);
            }

            // Refresh the Bootstrap-Select picker after dynamically adding options
            $('#years').selectpicker('refresh');
        });

        // show and hide emplyée select Jquery
        $("#t_graph").on("change", function () {
        var emplyDiv = $("#emply");

        if ($(this).val() == "G3") {
            emplyDiv.show(500);
            $("#emplySelect").prop("required", true);
        } else {
            emplyDiv.hide(500);
            $("#emplySelect").prop("required", false);
        }
        });

        $(document).ready(function () {
        // Submit form via AJAX
        $('#searchForm').submit(function (e) {
            e.preventDefault();
            $(".loading-div").css("display","flex");
            $("#Charts").hide();

            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: $(this).serialize(),
                success: function (response) {
                  //  set time for the response
                    $(".loading-div").hide();
                    $("#Charts").show();
                    $('#Charts').html(response);
                
                }
            });
        });


    });

    </script>

</body>

@endsection
