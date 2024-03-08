
var statue = document.getElementById('statue') ;
if(statue){
  statue.addEventListener('change', function() {
    var selectedOption = this.value;
    var inputs = document.querySelectorAll('.inputs_not_required_v');
  
    if (selectedOption !="vacataire") {
      for (var i = 0; i < inputs.length; i++) {
        inputs[i].required = true;
      }
    } else {
      for (var i = 0; i < inputs.length; i++) {
        inputs[i].required = false;
      }
    }
  });
}


  // set max to date_niass 
var date_naissIn = document.getElementById('date_naiss');

var currentDate = new Date();
var minDate = new Date(currentDate.getFullYear() - 18, currentDate.getMonth(), currentDate.getDate());

var formattedMinDate = minDate.toISOString().split('T')[0];

date_naissIn.setAttribute('max', formattedMinDate);

////////// 



// disable/anabel date recur and add max and min

function diable_date_ruc(){

  var startDateInput = document.getElementById('date_recrutement');

  if(startDateInput){
  
  var msj_date=document.getElementById('msj_date');

  var date_naiss = date_naissIn.value;
  startDateInput.hidden = date_naiss === ''; // Disable date recur if date_naiss is empty
  
  if (date_naiss !== '') {
    msj_date.setAttribute('hidden',true)
    startDateInput.setAttribute('min', date_naiss);
    startDateInput.setAttribute('max', getCurrentDate());
  } else {
    startDateInput.removeAttribute('min');
    startDateInput.removeAttribute('max');
  }
}
};

date_naissIn.addEventListener('change', diable_date_ruc);

diable_date_ruc();

function getCurrentDate() {
  var today = new Date();
  var year = today.getFullYear();
  let month = today.getMonth() + 1;
  let day = today.getDate();

  // Add leading zero for single-digit month and day
  month = month < 10 ? '0' + month : month;
  day = day < 10 ? '0' + day : day;

  return `${year}-${month}-${day}`;
}



