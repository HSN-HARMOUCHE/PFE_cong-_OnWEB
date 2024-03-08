

<form action="{{url('emplyee/'.$emplyee_data->mat)}}" method="POST">
    @csrf
    @method('put')

  @can('Admin-user')
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="Mat"><b>● CIN</b></label>
        <input type="text" name="mat" class="form-control" id="mat" value="{{$emplyee_data->mat}}" required>
      </div>
    </div>              
  @endcan
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="prenom"><b>● Prénom</b></label>
              <input type="text" name="prenom" class="form-control" id="prenom" value="{{$emplyee_data->prenom}}" required>
            </div>
            <div class="form-group col-md-6 ">
              <label for="nom"><b>● Nom</b></label>
              <input type="text" name="nom" class="form-control" id="nom" value="{{$emplyee_data->nom}}" required>
            </div>
          </div>

          

          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="date_naiss"><b>● Date de Naissance</b></label>
              <input type="date" name="date_naiss" class="form-control inputs_not_required_v" id="date_naiss" value="{{$emplyee_data->date_naiss}}">
            </div>
@can('Admin-user')
            <div class="form-group col-md-6 ">
              <label for="date_recrutement"><b>● Date de Recrutement</b></label>
              <br><span id="msj_date">!Veuillez d'abord saisir la <b> date de naissance</b> avant de saisir la date de Recrutement.</span>
              <input type="date" name="date_recru" hidden class="form-control inputs_not_required_v" id="date_recrutement" value="{{$emplyee_data->date_recrutement}}" >
            </div>
@endcan
          </div>

          

          <div class="form-row">
            <div class="form-group col-md-6 ">
              <label for="situation_fam"><b>● Situation Familiale</b></label>
              <select class="form-control inputs_not_required_v" name="situation_fam" >
                <option value=""> Situation Familiale ~~vide </option>
                <option value="Célibataire" {{$emplyee_data->situation_fam == "Célibataire" ? 'selected' : ''}} > Célibataire </option>
                <option value="marie" {{$emplyee_data->situation_fam == "marie" ? 'selected' : ''}}>marie</option>
              </select>
            </div>
            <div class="form-group col-md-6">
              <label for="nbr_enfants"><b>● Nombre d'Enfants</b></label>
              <input type="number" name="nbr_enf" value="{{$emplyee_data->nbr_enfants}}" class="form-control inputs_not_required_v" id="nbr_enfants" placeholder="Enter Nombre d'Enfants" >
            </div>
          </div>


          
@can('Admin-user')
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="echelle"><b>● Fonction</b></label>
              <select class="form-control" name="fonction" required>
              <option value="" disabled> Fonction </option>
              <option value="Directeur" {{$emplyee_data->fonction == "Directeur" ? 'selected' : ''}} > Directeur </option>
              <option value="formateur" {{$emplyee_data->fonction == "formateur" ? 'selected' : ''}}>formateur</option>
              <option value="directeur complexe" {{$emplyee_data->fonction == "directeur complexe" ? 'selected' : ''}}>directeur complexe</option>
              <option value="magasinier" {{$emplyee_data->fonction == "magasinier" ? 'selected' : ''}}>magasinier</option>
              </select>
            </div>
            <div class="form-group col-md-6 ">
              <label for="secteur"><b>● Secteur</b></label>
              <select class="form-control" name="secteur" required>
                <option value="" disabled> Secteur </option>
                <option value="Administration" {{$emplyee_data->secteur == "Administration" ? 'selected' : ''}}> Administration </option>
                <option value="AGC" {{$emplyee_data->secteur == "AGC" ? 'selected' : ''}}>AGC</option>
                <option value="BTP" {{$emplyee_data->secteur == "BTP" ? 'selected' : ''}}>BTP</option>
                <option value="NTIC" {{$emplyee_data->secteur == "NTIC" ? 'selected' : ''}}>NTIC</option>
              </select>
            </div>
          </div>

          

          <div class="form-row">
      
            <div class="form-group col-md-6">
              <label for="grade"><b>● Grade</b></label>
              <input type="text" value="{{$emplyee_data->grade}}" name="grade" class="form-control inputs_not_required_v" id="grade" placeholder="Enter Grade" >
            </div>
            <div class="form-group col-md-6 ">
              <label for="echelle"><b>● Échelle</b></label>
              <input type="text" value="{{$emplyee_data->echelle}}" name="echelle" class="form-control inputs_not_required_v" id="echelle" placeholder="Enter Échelle" >
            </div>
          </div>

          


          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="statue"><b>● Statue</b></label>
              <select class="form-control" name="statue" idadd_emply_scriptdate_naiss="statue" id="statue" required>
                <option value="-" disabled selected> Statue </option>
                <option value="statutaire" {{$emplyee_data->statue == "statutaire" ? 'selected' : ''}}> statutaire </option>
                <option value="vacataire" {{$emplyee_data->statue == "vacataire" ? 'selected' : ''}}> vacataire </option>
                <option value="contractuel" {{$emplyee_data->statue == "contractuel" ? 'selected' : ''}}> contractuel </option>
                <option value="coopérant" {{$emplyee_data->statue == "coopérant" ? 'selected' : ''}}> coopérant </option>
              </select>
            </div>

            <div class="form-group col-md-6 ">
              <label for="email"><b>● email</b></label>
              <input type="email" name="email" value="{{$emplyee_data->email}}" class="form-control" id="email" required>
            </div>
          </div>
@endcan 

          <div class="form-row">
          @if(Auth::user()->mat == $emplyee_data->mat)
            <div class="form-group col-md-12 ">
              <label for="password"><span style="font-size: 13px">nouveau/ancien</span> <b>mot de passe</b></label>
              <input type="password" name="password" class="form-control" id="password" required>
            </div>
          @endif
          </div>

          <button type="submit" class="btn btn-warning">Modifier</button>
        </form>

        <script src="{{asset('js/add_emply_script.js')}}"></script>
        



