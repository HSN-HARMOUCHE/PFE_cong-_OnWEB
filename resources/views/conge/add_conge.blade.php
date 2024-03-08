 <style>

    .form-group label {
      font-weight: bold;
    }

    #Duree {
      background-color: #f8f9fa;
      font-weight: bold;
    }

  </style>

<body>
<hr>



        
  <form action="/conge" method="post">
    @csrf
    <div class="form-group">
      <label for="conge-type">Type de Congé :</label>
      <select class="form-control" id="conge-type" name="conge-type" required>
        <option value="" selected disabled >selectioner type</option>
        @foreach($types as $type)

        <option class="types" name="{{$type->nomConge}}" value="{{$type->id_type}}">{{$type->nomConge}}  </option>

        @endforeach
      </select>
    </div>
      
              <div class="row">
                <div class="col-md-6 mb-4 d-flex "> 
                  <div class="form-outline datepicker w-10">
                    <label for="name_F" class="form-label">Date debut:</label>
                      <input type="date" class="form-control form-control-lg"  id="start-date" name="start-date" max="" required >
                </div>
              </div>
              
              
                <div class="col-md-6 mb-4 d-flex align-items-center">
                    <div class="form-outline">
                      <label class="form-label" for="end-date">Date fin :</label>
                      <input type="date" class="form-control form-control-lg" id="end-date" name="end-date"  disabled>
                    </div>

                </div>
              </div>
              <div class="row">
                <div class="col-md-12 mb-6 d-flex align-items-center">
                  <div class="form-outline">
                    <p><b>Durée: </b><i id="Duree">--</i> jours</p>
                  </div>
                </div>
              </div>

              <input class="w-100 btn btn-lg btn-primary" type="submit" value="Valider"/>
            
            </form>


    

<script>
  
var today = new Date();

// Form "YYYY-MM-DD"
var formattedDate = today.toISOString().split('T')[0];





// max year for start-date
  var currentYear = today.getFullYear();
  // Calculate the last day of the current year
  var firstDayOfNextYear = new Date(currentYear + 1, 0, 1);

  var formattedDate4max = firstDayOfNextYear.toISOString().split('T')[0];
  document.getElementById("start-date").setAttribute ("max", formattedDate4max) ;


// min date is today

document.getElementById("start-date").setAttribute("min", formattedDate);
document.getElementById("end-date").setAttribute("min", formattedDate);



var select =  document.getElementById("conge-type");
var startDateInput = document.getElementById("start-date");
var endDateInput = document.getElementById("end-date");
var DureeElement = document.getElementById("Duree");



select.addEventListener("input", date_fin);
//

startDateInput.addEventListener("input", calculateDuration);
endDateInput.addEventListener("input", calculateDuration);


// Function pour calculate duree
function calculateDuration() {
  var startDate = new Date(startDateInput.value);
  var endDate = new Date(endDateInput.value);

  if (selectedName  , selectedName  == "Annual" || selectedName  == "maladie"){
      if (startDate && endDate && startDate <= endDate) {
      var timeDiff = Math.abs(endDate.getTime() - startDate.getTime());
      var daysDiff = Math.ceil(timeDiff / (1000 * 3600 * 24));
      DureeElement.textContent = daysDiff ;
    } else {
      DureeElement.textContent = '-' ;
    }
    }else {
        endDateInput.setAttribute("disabled", "true");
    }

} ;

// disable and enable date fin
function date_fin() {
  selectedOption = select.options[select.selectedIndex];
  selectedName = selectedOption.getAttribute('name');

  if (selectedName === "Annual" || selectedName === "maladie") {
    endDateInput.removeAttribute("disabled");
    endDateInput.setAttribute("required", "true");
  } else {
    endDateInput.setAttribute("disabled", "true");
    endDateInput.removeAttribute("required");
  }
}

// Duree congé excep
$(document).ready(function() {
        $('#conge-type').change(function() {
            var OptionValue = $(this).val();
            $.ajax({
                url: '/conge_Duree/' + OptionValue,
                type: 'GET',
                success: function(response) {
                    $('#Duree').html(response.Durée);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });




</script>
</body>
