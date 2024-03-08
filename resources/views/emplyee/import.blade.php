

<center>

<form method="POST" action="/upload" enctype="multipart/form-data">
        @csrf
    <input type="file" class="form-control" name="excel_f" id="file" required />
    <br>
    <input class="btn btn-primary" type="submit" value="Importer" >
</form>
<br>

    <a href="{{asset('Excel/Excel_file_import.xlsx')}}" class="btn btn-success" download="Exemple pour le  syntax de fichier d'importation.xlsx">
        <i class="fas fa-regular fa-download"></i>
        Exemple pour le  syntax de fichier d'importation
        <i class="fas fa-regular fa-download"></i>
    </a>
<hr>
</center>

<ul>
    <h2>Notes</h2>
    <li> date format : (2000-01-31)||(31/01/2000)  </li>
    <li> ficher type .xlsx</li>
    <li><span style="color:red"><b>*</b>obligatoire</span><br><span style="color:blue"><b>*</b>obligatoire si vous n’êtes pas un "vacataire"</span> </li>
    <li><ul>Veuillez suivre le format suivant dans votre fichier Excel : 
        <li>"mat"= Matricule ou CIN <span style="color:red"><b>*</b></span> <br></li>
        <li>"nom"= Nom <span style="color:red"><b>*</b></span> <br></li>
        <li>"prenom"= Prénom <span style="color:red"><b>*</b></span><br></li>
        <li>"date_naiss"= Date de naissance <span style="color:blue"><b>*</b></span><br></li>
        <li>"date_recrutement"= Date de recrutement<span style="color:blue"><b>*</b></span><br></li>
        <li>"fonction"= Fonction <span style="color:red"><b>*</b></span><br><b>(Directeur,formateur,directeur complexe,magasinier)</b></li>
        <li>"situation_fam"= Situation familiale <span style="color:blue"><b>*</b></span><br><b>(Célibataire,marie)</b></li>
        <li>"nbr_enfants"= Nombre d'enfants<span style="color:blue"><b>*</b></span><br></li>
        <li>"secteur"= Secteur  <span style="color:red"><b>*</b></span><br><b>(Administration,AGC,BTP,NTIC)</b></li>
        <li>"grade"= Grade<span style="color:blue"><b>*</b></span><br></li>
        <li>"echelle"= Échelle<span style="color:blue"><b>*</b></span></li>
        <li>"statue"= Statut <span style="color:red"><b>*</b></span><br><b>(statutaire,vacataire,contractuel,coopérant)</b><br></li>
        <li>"psw_cnx"= Mot de passe <span style="color:red"><b>*</b></span><br></li>
        <li>"email"= Email <span style="color:red"><b>*</b></span><br></li>
    </ul></li>
</ul>
</form>