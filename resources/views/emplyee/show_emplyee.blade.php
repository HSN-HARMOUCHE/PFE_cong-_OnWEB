

  <div class="container mt-4">
    <div class="card">
      <div class="card-body">
        <h3 class="card-title">Employee Information</h3>
        <table class="table table-striped">
          <tbody>
            <tr>
              <th>Matricule // CIN</th>
              <td>{{$emplyee_data->mat}}</td>
            </tr>
            <tr>
              <th>Nom et Prénom</th>
              <td>{{$emplyee_data->nom}} {{$emplyee_data->prenom}}</td>
            </tr>
            <tr>
              <th>Date de Naissance</th>
              <td>{{$emplyee_data->date_naiss}}</td>
            </tr>
            <tr>
              <th>Date recrutement </th>
              <td>{{$emplyee_data->date_recrutement}}</td>
            </tr>
            <tr>
              <th>Situation familiale </th>
              <td>{{$emplyee_data->situation_fam}} </td>
            </tr>
            <tr>
              <th>Nbr d'enfants </th>
              <td>{{$emplyee_data->nbr_enfants}}</td>
            </tr>
            <tr>
              <th>Secteur </th>
              <td>{{$emplyee_data->secteur}}</td>
            </tr>
            <tr>
              <th>Grade </th>
              <td>{{$emplyee_data->grade}}</td>
            </tr>
            <tr>
              <th>Echelle </th>
              <td>{{$emplyee_data->echelle}}</td>
            </tr>
            <tr>
              <th>Statue </th>
              <td> {{$emplyee_data->statue}}</td>
            </tr>
            <tr>
              <th>Annee raport</th>
              <td>{{$emplyee_data->annee_report}}</td>
            </tr>
            <tr>
              <th>Solde raport</th>
              <td>{{$emplyee_data->solde_report}} Jours</td>
            </tr>
            <tr>
              <th>Solde Congé</th>
              <td>{{$emplyee_data->solde_conge}} Jours</td>
            </tr>
            <tr>
              <th>Email</th>
              <td>{{$emplyee_data->email}}</td>
            </tr>
            
          </tbody>
        </table>
      </div>
    </div>
  </div>



