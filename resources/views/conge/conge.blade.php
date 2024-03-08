@extends('layouts.app')

@section('content')

<head>

<title>Conge</title>
@include('CDN_links') 
</head>
<body>
    <style>
.buttons {
  margin-bottom: 10px;
}

.button {
  padding: 10px 20px;
  margin-right: 10px;
}

.table-container {
  margin-bottom: 20px;

}

.search-input {
  padding: 5px;
  margin-right: 10px;
}

.pagination-menu {
  margin-top: 10px;
}

.pagination-button {
  padding: 5px 10px;
  margin-right: 5px;
}

.download-button {
  padding: 5px 10px;
}

.download-icon::before {
  content: "⬇";
  margin-right: 5px;
}

table {
  
  width: 100%;
  border-collapse: collapse;
  
}

th, td {
  padding: 7px;
  border: 1px solid #ddd;
}

.pagination-menu {
  margin-top: 10px;
}

.pagination-button {
  padding: 5px 10px;
  margin-right: 5px;
}
.table_section{
  background-color: aliceblue ;
  margin-top: auto;
  padding: 0px 10px 2px 10px;
  border:inset #015482 4px ;

}
#table_conge_filter input:focus  {
  border: 1px solid #007bff;
  box-shadow: 0 0 10px #015482;
  border-radius: 4px;

}
.dt-button {
        background-color: #007bff !important; 
        color: #fff !important;
        margin-left: 13px !important; 
        position: relative !important;
        padding-left: 2rem !important;
    }
    .dt-button::before {
        position: absolute;
        top: 50%;
        left: 0.75rem; /* Adjust the left position to align the icon */
        transform: translateY(-50%);
        font-family: "Font Awesome 5 Free"; /* Assuming you have included the Font Awesome CSS */
        content: "\f019"; /* Replace with the desired Font Awesome icon class */
        font-weight: 900;
    }




    </style>

  <div class="container">
    <div class="row mt-4">
      <div class="col">
        <button class="new_conge btn btn-primary" style="background-color: #015482;">Déclarer un nouveau congé</button>
      </div>
    </div>
    <br>
 <div class="table_section">
  

    <div class="row mt-4">
      <div class="col">

        <table class="table table-hover" style="text-align: center;" id="table_conge">
          <thead class="thead-dark">
            <tr>
                <th>#mat</th>
                <th>nom Emplyée</th>
                <th>Nom Congé</th>
                <th>Date debut</th>
                <th>Date fin</th>
                <th>Durée</th>
                <th>jours pris cette année</th>
                <th>statut</th>
                <th>Action</th>
            </tr>
          </thead>
          <tbody>
   
          @if(isset($conges))
            @foreach ($conges as $conge)
            <tr data-conge-id="{{ $conge->id }}">
                <td>{{ $conge->employee->mat }}</td>
                <td>{{ $conge->employee->nom}} {{ $conge->employee->prenom}}</td>
                <td>{{ $conge->typeConge->nomConge }}</td>
                <td>{{ $conge->dateDebut }}</td>
                <td>{{ $conge->dateFin }}</td>
                <td id="duree">
                  @php
                  $startDate = new \DateTime($conge->dateDebut);
                  $endDate = new \DateTime($conge->dateFin);
                  $duration = $endDate->diff($startDate)->format('%a');
                  echo $duration." jours";
                  @endphp
                  
                </td>

              <td class="conge_taken" data-mat="{{ $conge->employee->mat }}">
                <img src="{{asset("imgs/load.gif")}}" width="20px" height="20px">
              </td>

                <td class="statue" style="background-color:{{ $conge->statue == 'accepte' ? '#18A558' : ($conge->statue == 'refuse' ? '#E32227' : '#D1D100') }}"><b>{{ $conge->statue }}</b></td>
          
            <td> 
          
            @if($conge->statue == 'en attendant')
            <div class="AR_btns-container"  data-conge-id="{{ $conge->id }}" style="padding:2px 2px; display:flex; justify-content:space-between; align-items: center;">
                <button  class="Accepter-btn btn btn-success" data-conge-id="{{ $conge->id }}">Accepter</button>
                <button class="Refuser-btn btn btn-danger" data-conge-id="{{ $conge->id }}">Refuser</button>
            </div>
            @endif 
            </td>
        </tr>
            @endforeach

            {{-- if user was normal emplyee --}}
        @elseif(isset($conges_emply))

        @foreach ($conges_emply as $conge)
        <tr data-conge-id="{{ $conge->id }}">
            <td>{{ $conge->employee->mat }}</td>
            <td>{{ $conge->employee->nom}} {{ $conge->employee->prenom}}</td>
            <td>{{ $conge->typeConge->nomConge }}</td>
            <td>{{ $conge->dateDebut }}</td>
            <td>{{ $conge->dateFin }}</td>
            <td id="duree">
              @php
              $startDate = new \DateTime($conge->dateDebut);
              $endDate = new \DateTime($conge->dateFin);
              $duration = $endDate->diff($startDate)->format('%a');
              echo $duration;
              @endphp
            </td>

            <td class="conge_taken" data-mat="{{ $conge->employee->mat }}">
              <img src="{{asset("imgs/load.gif")}}" width="20px" height="20px">
            </td>

            <td class="statue" style="background-color:{{ $conge->statue == 'accepte' ? '#18A558' : ($conge->statue == 'refuse' ? '#E32227' : '#D1D100') }}"><b>{{ $conge->statue }}</b></td>
      
        <td> 
      <p>Aucune Action pour cette utilisateur</p>
        </td>
    </tr>
        @endforeach

        @endif
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>


{{-- Add conge  --}}
<div id="newCongeModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title">Conge</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body"></div>
      </div>
  </div>
</div>


<x-input-error :messages="session('ERR')" class="mt-2" />



  <script>
    // data table 
    $(document).ready(function () {
    updatedCongetaken() ;

    $('#table_conge').DataTable({
      dom: 'lBfrtip',
      buttons: [
        {
      extend: 'excel',
      exportOptions: {
        columns: [0, 1, 2, 3,4,5,6,7] 
      }
    },
    {
      extend: 'pdf',
      exportOptions: {
        columns: [0, 1, 2, 3,4,5,6,7] 
      }
    },
    ],
    ordering: false,
        language: {
            search: "<b> Rechercher </b>" ,
            emptyTable:"<b>Aucun Congé Trouvé</b>",
            infoEmpty:"<b>Aucun Donnée disponible</b>",
            zeroRecords: "<b>Aucun enregistrement trouvé correspondant aux critères de recherche !!.</b>" ,
            searchPlaceholder: 'nom,Mat,date-debut.. ',
            lengthMenu: 'Afficher _MENU_ entrées',
            paginate: {
                first: 'Premier', // Label for the "First" page button
                previous: 'Précédent', // Label for the "Previous" page button
                next: 'Suivant', // Label for the "Next" page button
                last: 'Dernier' // Label for the "Last" page button
            },
            info: 'Affichage de _START_ à _END_ sur _TOTAL_ entrées' 
         }
        });
    });



    // acceter et Refuser 
  $('.Accepter-btn').click(function() {
    var congeId = $(this).data('conge-id');
    if (confirm('Une fois que vous avez accepté ou refusé ce congé, cela ne peut pas être annulé ou modifié !')) {
        updateStatue(congeId, 'accepte');

      }
    });

  $('.Refuser-btn').click(function() {
        var congeId = $(this).data('conge-id');
        if (confirm('Une fois que vous avez accepté ou refusé ce congé, cela ne peut pas être annulé ou modifié !')) {
        updateStatue(congeId, 'refuse');
      }
    });


   //hide A / R btns 
  function hidebtns(congeId) {
    $('.AR_btns-container[data-conge-id="' + congeId + '"] button').remove();
}
  //
  
  function updateStatue(congeId, statue) {
    $.ajax({
    url: 'conge/statue/' + congeId,
    type: 'PUT',
    data: {
        _token: '{{ csrf_token() }}',
        statue: statue
    },
    success: function(response) {
      if (response.error) {
        $('#error-message').show(200);
        $('#error-message').html('<p>Erreur: ' + response.message + '</p>');
        } else {

    var updatedConge = response.conge;
    var congeId = updatedConge.id;
    var updatedStatue = updatedConge.statue;
    // Update the 'statue'
    $('tr[data-conge-id="' + congeId + '"] td.statue').text(updatedStatue).css('background-color', updatedStatue == 'accepte' ? '#18A558' : (updatedStatue == 'refuse' ? '#E32227' : '#D1D100'));;
    
    $('#error-message').hide();
    sendNotification(congeId);
    hidebtns(congeId);
    updatedCongetaken() ;
        }

    
},
    error: function(xhr, status, error) {
        console.error(xhr.responseText);
    }
    });
    }

//SEND notification 

async function sendNotification(congeId) {

    $.ajax({
        url: 'conge/send_notification/' + congeId,
        type: 'GET',
        success: function(response) {
            alert("Notif was send success")
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}








// new conge form
  $(document).on('click', '.new_conge', function() {
    var url = 'conge/create';

    $.ajax({
        url: url,
        method: 'GET',
        success: function(response) {
            // Display the form in a modal
            $('#newCongeModal .modal-body').html(response);
            $('#newCongeModal').modal('show');
        }
    });
});


// conge taken 
function updatedCongetaken(){
  $('.conge_taken').each(function() {
  var mat = $(this).data('mat');
  var $element = $(this);

  $.ajax({
    url: "congetaken/" + mat,
    method: 'GET',
    success: function(response) {
      $element.text(response.congetaken+" jours");
    }
  });
});
}

  </script>


</body>

@endsection