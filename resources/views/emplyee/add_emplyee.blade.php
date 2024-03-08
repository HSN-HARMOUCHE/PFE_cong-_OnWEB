@extends('layouts.app')

@section('content')


<head>
  <title>Add Employee</title>
    @include('CDN_links') 
</head>

<body>


  {{-- @if (session('msj'))
  <div class="alert alert-success text-center">
      <b>{{ session('msj') }}</b>
  </div>
  @endif --}}
  
  {{-- @if (session('err'))
  <div class="alert alert-danger text-center">
      <b>{{ session('err') }}</b>
  </div>
  @endif --}}


{{-- @if ($errors->any())
  <div class="alert alert-danger text-center">
      <ul>
          @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
          @endforeach
      </ul>
  </div>
@endif --}}

  <div class="container mt-4" style="z-index: -102">
    <div class="card">
      <div class="card-body">
            
        <h3 class="card-title">Ajouter Employee</h3>
        
<hr>
        <form action="{{url('emplyee')}}" method="POST">
          @csrf
          <div class="form-row">
            <div class="form-group col-md-6">
             <label for="mat"><b>Matricule ou CIN</b></label>
             <input type="text" name="mat" class="form-control" id="mat" placeholder="identifiant" required>
           </div>
           
           <div class="form-group col-md-6">
            <label for="email"><b>E-mail</b></label>
            <input type="text" name="email" class="form-control" id="email" placeholder="Email" required>
          </div>
         </div>

         

          <div class="form-row">
             <div class="form-group col-md-6">
              <label for="prenom"><b>Prénom</b></label>
              <input type="text" name="prenom" class="form-control" id="prenom" placeholder="Enter Prénom" required>
            </div>
            <div class="form-group col-md-6 ">
              <label for="nom"><b>Nom</b></label>
              <input type="text" name="nom" class="form-control" id="nom" placeholder="Enter Nom" required>
            </div>
          </div>

          

          <div class="form-row">
           
            <div class="form-group col-md-6">
              <label for="date_naiss"><b>Date de Naissance</b></label>
              <input type="date" name="date_naiss" class="form-control inputs_not_required_v" id="date_naiss" >
            </div>
             <div class="form-group col-md-6 ">
              <label for="date_recrutement"><b>Date de Recrutement</b></label>
              <br><span id="msj_date">!Veuillez d'abord saisir la <b> date de naissance</b> avant de saisir la date de Recrutement.</span>
              <input type="date" name="date_recru" hidden class="form-control inputs_not_required_v" id="date_recrutement" >
            </div>
          </div>

          

          <div class="form-row">
            <div class="form-group col-md-6 ">
              <label for="situation_fam"><b>Situation Familiale</b></label>
              <select class="form-control inputs_not_required_v" name="situation_fam" >
                <option value="" selected > Situation Familiale ~~vide </option>
                <option value="Célibataire"> Célibataire </option>
                <option value="marie">marie</option>
              </select>
            </div>
            <div class="form-group col-md-6">
              <label for="nbr_enfants"><b>Nombre d'Enfants</b></label>
              <input type="number" name="nbr_enf" class="form-control inputs_not_required_v" id="nbr_enfants" placeholder="Enter Nombre d'Enfants" min="0" max="50">
            </div>
          </div>


          

          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="echelle"><b>Fonction</b></label>
              <select class="form-control" name="fonction" required>
              <option value="" selected disabled> Fonction </option>
              <option value="Directeur"> Directeur </option>
              <option value="formateur">formateur</option>
              <option value="directeur complexe">directeur complexe</option>
              <option value="magasinier">magasinier</option>
              </select>
            </div>
            <div class="form-group col-md-6 ">
              <label for="secteur"><b>Secteur</b></label>
              <select class="form-control" name="secteur" required>
                <option value="" disabled selected> Secteur </option>
                <option value="Administration"> Administration </option>
                <option value="AGC">AGC</option>
                <option value="BTP">BTP</option>
                <option value="NTIC">NTIC</option>
              </select>
            </div>
          </div>

          

          <div class="form-row">
      
            <div class="form-group col-md-6">
              <label for="grade"><b>Grade</b></label>
              <input type="text" name="grade" class="form-control inputs_not_required_v" id="grade" placeholder="Enter Grade" >
            </div>
            <div class="form-group col-md-6 ">
              <label for="echelle"><b>Échelle</b></label>
              <input type="text" name="echelle" class="form-control inputs_not_required_v" id="echelle" placeholder="Enter Échelle" >
            </div>
          </div>

          

          <div class="form-row">
    
            <div class="form-group col-md-6">
              <label for="statue"><b>Statue</b></label>
              <select class="form-control" name="statue" id="statue" required>
                <option value="-" disabled selected> Statue </option>
                <option value="statutaire"> statutaire </option>
                <option value="vacataire"> vacataire </option>
                <option value="contractuel"> contractuel </option>
                <option value="coopérant"> coopérant </option>
                
              </select>
            </div>
            <div class="form-group col-md-6 ">
              <label for="password"><b>mot de pass</b></label>
              <input type="password" name="psw" class="form-control" id="password" placeholder="Enter le Mot de pass" required>
            </div>
          </div>
          <a href="/emplyee" class="btn btn-danger">Annuler </a>
          <button type="submit" class="btn btn-success">Ajouter</button>
        </form>
      </div>
    </div>
  </div>

{{-- msj and error alerts --}}
    <x-input-error :messages="session('err')" class="mt-2" />
  
    <x-input-error :messages="$errors->all()" class="mt-2" />
  
    <x-auth-session-status  class="alert alert-success" :status="session('msj')" />

</body>
<script src="{{asset('js/add_emply_script.js')}}"></script>

@endsection