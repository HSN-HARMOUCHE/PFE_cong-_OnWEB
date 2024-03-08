
<style>
/* #notif {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    display:none;
    z-index: 708780349;
    background-color: rgba(205, 226, 243, 0.8)   
} */

/* .loading-text {
    margin-top: 10px;
}

.cssload-container {
	width: 100%;
	height: 49px;
	text-align: center;
}

.cssload-speeding-wheel {
	width: 49px;
	height: 49px;
	margin: 0 auto;
	border: 3px solid rgb(0,0,0);
	border-radius: 50%;
	border-left-color: transparent;
	border-right-color: transparent;
	animation: cssload-spin 1250ms infinite linear;
		-o-animation: cssload-spin 1250ms infinite linear;
		-ms-animation: cssload-spin 1250ms infinite linear;
		-webkit-animation: cssload-spin 1250ms infinite linear;
		-moz-animation: cssload-spin 1250ms infinite linear;
}



@keyframes cssload-spin {
	100%{ transform: rotate(360deg); transform: rotate(360deg); }
}

@-o-keyframes cssload-spin {
	100%{ -o-transform: rotate(360deg); transform: rotate(360deg); }
}

@-ms-keyframes cssload-spin {
	100%{ -ms-transform: rotate(360deg); transform: rotate(360deg); }
}

@-webkit-keyframes cssload-spin {
	100%{ -webkit-transform: rotate(360deg); transform: rotate(360deg); }
}

@-moz-keyframes cssload-spin {
	100%{ -moz-transform: rotate(360deg); transform: rotate(360deg); }
} */

</style>

{{-- <div id="notif">

    <div class="cssload-container">
        <div class="cssload-speeding-wheel"></div>
    </div>

    <div class="loading-text">
        l'Envoi en <b>cours...</b> Veuillez patienter.
    </div>
</div> --}}



<form id="absenceForm" method="POST" action="/absences"  enctype="multipart/form-data" class="form">
    @csrf
    <div class="form-group">
        <label for="raisons">Raison<span style="color: red">*</span> :</label>
        <input type="text" class="form-control form-control-lg" name="raisons" required><br>
    </div>
    <div class="form-group">
        <label for="datedebut">Date debut<span style="color: red">*</span>:</label>
        <input id="start-date" type="date" class="form-control form-control-lg" name="dateDebeut" required><br>
        <label for="dateFin"> Date Fin<span style="color: red">*</span>:</label>
        <input id="end-date" type="date" class="form-control form-control-lg"  name="dateFin" required><br>
    </div>
    <label title="choisir un fichier " for="avatar">Choisir un fichier comme justification :(<span style="color:red">.pdf / taille maximale : 3 Mo </span>):
    <br><b>Par example:</b> Lettre d'excuses pour une absence, certificat de maladie etc... </label>
    <br><br>
    <input name="justification" type="file">
    <br><br>
    <button type="button" onclick="submitForm()" class="w-100 btn btn-lg btn-primary">Enregistre</button>


</form>


<script>
    var today = new Date();
    // Form "YYYY-MM-DD"
    var formattedDate = today.toISOString().split('T')[0];
    document.getElementById("start-date").setAttribute("min", formattedDate);
    document.getElementById("end-date").setAttribute("min", formattedDate);


    // Function to show the loading animation
    // function showLoading() {
    //     document.getElementById("notif").style.display = "flex";
    // }

    // Function to submit the form and display the loading animation
    function submitForm() {
        // showLoading(); // Show the loading animation
        document.getElementById("absenceForm").submit(); // Submit the form
    }


</script>
