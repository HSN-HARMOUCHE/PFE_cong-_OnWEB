@extends('layouts.app')

@section('content')
@include('CDN_links') 
<style>
table {
  width: 100%;
  border-collapse: collapse; 
}
th, td {
  padding: 7px;
  border: 1px solid #ddd;
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
.table_section{
    background-color: aliceblue ;
    margin-top: auto;
    padding: 2px 10px;
    border:inset #015482 4px ;
}


</style>
    <div class="container">
        <div class="row mt-4">
            <div class="col">
            <button style="background-color: #4682B4; border"  type="button" class="add_ads-btn btn btn-primary" data-toggle="modal" data-target="#absenceModal" id="absenceModalButton">
                Declaré Nouveaux Absence
            </button>
            </div>
        </div>
        <br>

    <div class="table_section">
        <div class="row mt-4">
        <div class="col">

        <table id="table_absence" class="table table-hover" style="text-align: center;">
            <thead class="thead-dark">
                <tr>
                    <th>matricule </th>
                    <th>Employee</th>
                    <th>Raison</th>
                    <th>Data debut  </th>
                    <th>Date Fin</th>
                    <th>Durée (jours)</th>
                    <th>Justification</th>
               
                </tr>
            </thead>
            <tbody>
                @if(isset($absences))
                    @foreach ($absences as $absence)
                        <tr>
                            <td>{{ $absence->employee->mat }}</td>
                            <td>{{ $absence->employee->nom }} {{$absence->employee->prenom}} </td>
                            <td>{{ $absence->raisons }}</td>
                            <td>{{ $absence->dateDebeut }}</td>
                            <td>{{ $absence->dateFin }}</td>
                            <td>{{ $absence->dureeJours }} jours</td>
                            <td>
                                @if ($absence->Jusifications)
                                <a href="justifications/{{basename($absence->Jusifications)}}" class="btn btn-primary" download="{{ $absence->employee->nom }} _ {{ $absence->employee->mat }}">Justification PDF

                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                                        <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                                        <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                                    </svg>
                                </a>
                            @else
                            il n'y a aucune justification pour cette absence
                            @endif
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>            
        </table>
        </div>
    </div>
    </div>

{{-- model declare Abs --}}
<div id="Add_abs_Modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nouvelle absence</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body"></div>
        </div>
    </div>
</div>
    
</div>

    {{-- alerts --}}
    <x-input-error :messages="session('ERR')" class="mt-2" />
    {{-- end alerts --}}

    <style>
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

    <script>
        $(document).ready(function() {
            $('#table_absence').DataTable({
                dom: 'lBfrtip',
                buttons: [
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: [0, 1, 2, 3,4 ]
                        }
                    },
                    {
                        extend: 'pdf',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4]
                        }
                    },
                ],
                language: {
                    search: "<b> Rechercher </b>",
                    emptyTable: "<b>Aucun Absence Trouvé</b>",
                    infoEmpty: "<b>Aucun Donnée disponible</b>",
                    zeroRecords: "<b>Aucun enregistrement trouvé correspondant aux critères de recherche !!.</b>",
                    searchPlaceholder: 'nom, Mat, date ...',
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

        
            // Show the modal when the button is clicked
    $(document).on('click', '.add_ads-btn', function() {
    var url = '/Abs/create';
    $.ajax({
        url: url,
        method: 'GET',
        success: function(response) {
            // Display the form in a modal
            $('#Add_abs_Modal .modal-body').html(response);
            $('#Add_abs_Modal').modal('show');
        }
    });
});



            
        });
    </script>
@endsection
