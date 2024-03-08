@extends('layouts.app')



@section('content')

@include('CDN_links') 

    <style>
table {
  width: 100%;
  border-collapse: collapse;
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
th, td {
  padding:7px;
  border: 1px solid #ddd;
}
.table_section{
  background-color: aliceblue ;
  margin-top: auto;
  padding: 2px 10px;
  border:inset #000000 4px ;

}




    </style>


  <div class="container">
    <div class="row mt-4">
      <div class="col">

      @can('Admin-user')
        <a href="emplyee/create" class="btn btn-primary" style="background-color: #4682B4; border" > ajouter un nouvel employé</a>
        
        <button class="btn btn-success import-employee-btn" style="background-color: #048243;"  ><i class="fas fa-regular fa-upload"></i> import fichier excel des employés </button>
      @endcan
      </div>
    </div>
    <br>

  <div class="table_section">


    <div class="row mt-4">
      <div class="col">

    
    @if (session('importErrors'))
    <div class="alert alert-danger">
        @foreach (session('importErrors') as $errorData)
            <li> <b> problème dans la ligne </b> :{{ $errorData['row'] }}</li>
            <ul>
                @foreach ($errorData['importErrors'] as $error)
                    <li>{{ $error }} ==> <b>{{$errorData['val']}}</b> </li>
                @endforeach
            </ul>
        @endforeach
    </div>
    @endif

  {{-- @if(session('error'))
        <div class="alert alert-danger">
            <h4>Import Errors:</h4>
            {{session('error')}}
        </div>
  @endif  --}}


{{-- @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif --}}


        <table class="table table-hover" style="text-align: center;" id="table_employee">
          <thead class="thead-dark">
            <tr>
              <th># mat</th>
              <th>nom et prenom Emplyée</th>
              <th>Date Naissance</th>
              <th>fonction</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            {{-- test on all data --}}
        @if(isset($emplys))
          @foreach ($emplys as $emply)
          <tr>
          <td>{{$emply->mat}}</td>
          <td>{{$emply->nom}} {{$emply->prenom}}</td>
          <td>{{$emply->date_naiss }}</td>
          <td>{{$emply->fonction }}</td>
          <td>   
          <div class="col"  style="display: flex; justify-content: space-between; align-items: center;">

              <button class="show-employee-btn btn btn-primary " data-employee-id="{{ $emply->mat }}"><i class="fas fa-info"></i></button>

              <button class="edit-employee-btn btn btn-warning" data-employee-id="{{ $emply->mat }}">Modifier</button>
            
              <form action={{url('emplyee/'.$emply->mat)}} method="post" style="display: inline-block">
                  @csrf
                  @method('DELETE')
                  <button type="submit" style="float: "  class="btn btn-danger" onclick="return confirm('Êtes-vous sûr ?')" >Supprimer</button>
                </form>
        
              </div> 
            </td>
          </tr>
          @endforeach

          {{-- if user was normal emplyee --}}
        {{-- @elseif(isset($emply))
        <tr>
          <td>{{$emply->mat}}</td>
          <td>{{$emply->nom}} {{$emply->prenom}}</td>
          <td>{{$emply->date_naiss }}</td>
          <td>{{$emply->fonction }}</td>
          <td>   
          <div class="col"  style="display: flex; justify-content: space-between; align-items: center;">

              <button class="show-employee-btn btn btn-primary " data-employee-id="{{ $emply->mat }}"><i class="fas fa-info"></i></button>

              <button class="edit-employee-btn btn btn-warning" data-employee-id="{{ $emply->mat }}">Modifier</button>
              </div> 
            </td>
          </tr> --}}
        @endif
         
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<br>
<!-- The modal edit  -->
<div id="editEmployeeModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
      <div class="modal-content"  >
          <div class="modal-header">
              <h5 class="modal-title">Modifier Employee</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body" style="background-color: #eff5ff"></div>
      </div>
  </div>
</div>

<!-- The modal show  -->
<div id="showEmployeeModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title">info d'Employee</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body"></div>
      </div>
  </div>
</div>


<!-- The modal import  -->
<div id="importEmployeeModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title">import Ficher Excel</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body"></div>
      </div>
  </div>
</div>


<x-input-error :messages="session('error')" class="mt-2" />

<x-input-error :messages="$errors->all()" class="mt-2" />

<x-auth-session-status :status="session('msj')" />


  




  <script>
    $(document).ready(function () {
    $('#table_employee').DataTable({
        ordering: false,
        language: {
            search: "<b> Rechercher </b>" ,
            emptyTable:"<b>Aucun Emplyée Trouvé</b>",
            infoEmpty:"<b>Aucun Donnée disponible</b>",
            zeroRecords: "<b>Aucun enregistrement trouvé correspondant aux critères de recherche !!.</b>" ,
            searchPlaceholder: 'Par nom ou Mat',
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



    /// 

  $(document).on('click', '.edit-employee-btn', function() {
    var employeeId = $(this).data('employee-id');
    var url = '/emplyee/'+ employeeId +'/edit';


    //  Ajax  edit form HTML
    $.ajax({
        url: url,
        method: 'GET',
        success: function(response) {
            // Display the form in a modal
            $('#editEmployeeModal .modal-body').html(response);
            $('#editEmployeeModal').modal('show');
        }
    });
});

////

$(document).on('click', '.show-employee-btn', function() {
    var employeeId = $(this).data('employee-id');
    var url = '/emplyee/'+ employeeId;
    //  Ajax info form HTML
    $.ajax({
        url: url,
        method: 'GET',
        success: function(response) {
            // Display the form in a modal
            $('#showEmployeeModal .modal-body').html(response);
            $('#showEmployeeModal').modal('show');
        }
    });
});

 // 
$(document).on('click', '.import-employee-btn', function() {
    var employeeId = $(this).data('employee-id');
    var url = '/importEmply';
    //  Ajax import form HTML
    $.ajax({
        url: url,
        method: 'GET',
        success: function(response) {
            // Display the form in a modal
            $('#importEmployeeModal .modal-body').html(response);
            $('#importEmployeeModal').modal('show');
        }
    });
});

  </script>






@endsection