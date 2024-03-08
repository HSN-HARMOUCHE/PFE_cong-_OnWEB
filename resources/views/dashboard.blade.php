@extends('layouts.app')

@section('content')
            
    @include('CDN_links')

    <link href={{asset('css/Home.css')}} rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://pixinvent.com/stack-responsive-bootstrap-4-admin-template/app-assets/css/bootstrap-extended.min.css">
    <link rel="stylesheet" type="text/css" href="https://pixinvent.com/stack-responsive-bootstrap-4-admin-template/app-assets/fonts/simple-line-icons/style.min.css">
    <link rel="stylesheet" type="text/css" href="https://pixinvent.com/stack-responsive-bootstrap-4-admin-template/app-assets/css/colors.min.css">
    <link rel="stylesheet" type="text/css" href="https://pixinvent.com/stack-responsive-bootstrap-4-admin-template/app-assets/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
    
    <div class="container">
        <h3 >Bienvenu  <span class="infoUser">{{Auth::user()->nom}} {{Auth::user()->prenom}} </span></h3>

        <ul style="white-space: nowrap;">
            # <span class="infoUser">{{Auth::user()->mat}}</span>
            <li>Date de Naissance :<span class="infoUser">{{Auth::user()->date_naiss}}</span></li>
            <li>Date recrutement : <span class="infoUser">{{Auth::user()->date_recrutement}}</span></li>
            <li>Situation familiale : <span class="infoUser">{{Auth::user()->situation_fam}}</span></li>
            <li>Nbr d'enfants : <span class="infoUser">{{Auth::user()->nbr_enfants}}</span></li>
            <li>Fonction : <span class="infoUser">{{Auth::user()->fonction}}</span></li>
            <li>Secteur : <span class="infoUser">{{Auth::user()->secteur}}</span></li>
            <li>Grade : <span class="infoUser">{{Auth::user()->grade}}</span></li>
            <li>Echelle : <span class="infoUser">{{Auth::user()->echelle}}</span></li>
            <li>Statue : <span class="infoUser">{{Auth::user()->statue}}</span></li>
            <li>Solde raport : <span class="infoUser">{{Auth::user()->solde_report}}Jours / {{Auth::user()->annee_report}} </span></li>
            <li>Solde Congé : <span class="infoUser">{{Auth::user()->solde_conge}}Jours </span></li>
            <li>Email : <span class="infoUser">{{Auth::user()->email}}</span></li>
            <button class="edit-employee-btn btn btn-outline-warning " data-employee-id="{{Auth::user()->mat}}">! Modifier mes informations !</button>
        </ul>

@if($errors->any())
    <div class="alert alert-danger" style="width:150%; margin-left:10px ">
        <span>ERROR</span>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
        
{{-- //START Cards --}}
        <div class="grey-bg container-fluid">
            <section id="statistics1">
            <div>
                <div class="card">
                <div class="card-content">
                    <div class="card-body">
                    <div class="media d-flex">
                        <div class="media-body text-left">
                        <h3 id="countCong" class="danger"> 
                            <img src="{{asset("imgs/load.gif")}}" width="20px" height="20px">
                        </h3>
                        <span>Employés sont en congé</span>
                        </div>
                        <div class="align-self-center">
                        <img src="imgs/calendar-off.png" alt="">
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            <div>
                <div class="card">
                <div class="card-content">
                    <div class="card-body">
                    <div class="media d-flex">
                        <div class="media-body text-left">
                        <h3 id="countAbs" class="danger">
                            <img src="{{asset("imgs/load.gif")}}" width="20px" height="20px">
                        </h3>
                        <span>Employés sont absents</span>
                        </div>
                        <div class="align-self-center">
                        <img src="imgs/customer-conversion.png" alt="">
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>
    
            <div>
                <div class="card">
                <div class="card-content">
                    <div class="card-body">
                    <div class="media d-flex">
                        <div class="media-body text-left">
                        <h3 id="countF_emp" class="primary">
                            <img src="{{asset("imgs/load.gif")}}" width="20px" height="20px">
                        </h3>
                        <span>Formateurs sont présent</span>
                        </div>
                        <div class="align-self-center">
                            <img src="imgs/teacher.svg" alt="" width="55px" height="55px">
                        </div>
                    </div>
                    <div class="progress mt-1 mb-0" style="height:15px; background-color:#d3d3d3">     
                        <div id="Form_per100" class="progress-bar bg-primary" role="progressbar" style="width: 80% " aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                            <i id="FormP_per100" style="color: black">...%</i>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            <div>
                <div class="card">
                <div class="card-content">
                    <div class="card-body">
                    <div class="media d-flex">
                        <div class="media-body text-left">
                        <h3 id="count_emp" class="warning"> 
                            <img src="{{asset("imgs/load.gif")}}" width="20px" height="20px">
                        </h3>
                        <span>Employés sont présent</span>
                        </div>
                        <div class="align-self-center">
                            <img src="imgs/user.png" />
                        </div>
                    </div>
                    <div class="progress mt-1 mb-0" style="height: 15px; background-color:#d3d3d3">
                        <div id="Emp_per100" class="progress-bar bg-warning" role="progressbar" style="width: 200%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100">
                            <i id="EmpP_per100" style="color: black">...%</i>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>
        </section>
        <!-- statistics user -->
        <section id="statistics2">
            <div class="d-flex">
                <div class="card" style="margin-right:5px;">
                <div class="card-content">
                    <div class="card-body">
                    <div class="media d-flex">
                        <div class="media-body text-left">
                        <h3 id="Abs_cong" class="warning"> 
                            <img src="{{asset("imgs/load.gif")}}" width="20px" height="20px">
                        </h3>
                        <span>Congés + Absences</span>
                        </div>
                        <div class="align-self-center">
                        <img src="imgs/off2.png"/>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>
        </section>
        </div>
{{-- // END cards --}}
    </div>

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

<script>
    
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

//data
$.ajax({
        url:'dashboard_data',
        method: 'GET',
        success: function(response) {
            $('#countCong').text(response.employeesConge)
            $('#countAbs').text(response.employeesAbs) 
            $('#countF_emp').text(response.countF_emp)
            $('#Form_per100').css('width',response.countForm_per100+"%")
            $('#FormP_per100').text(response.countForm_per100+"%")
            $('#count_emp').text(response.count_emp)
            $('#Emp_per100').css('width',response.countEmply_per100+"%")
            $('#EmpP_per100').text(response.countEmply_per100+"%")
            $('#Abs_cong').text(response.Abs_Cong+" Jours")    
    }
    });

</script>

@endsection
