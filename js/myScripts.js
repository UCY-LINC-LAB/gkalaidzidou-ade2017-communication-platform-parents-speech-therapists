



/**Function to check if password match with inserted confirmation password*/
function validatePassword(){

  var password = document.getElementById("password")
  , ConfirmPassword = document.getElementById("ConfirmPassword");

  if(password.value != ConfirmPassword.value) {
    ConfirmPassword.setCustomValidity("Passwords Don't Match");
  } else {
    ConfirmPassword.setCustomValidity('');
  }
  password.onchange = validatePassword;
  ConfirmPassword.onkeyup = validatePassword;
}

function validateEmail(){

  var Email = document.getElementById("Email")
  , ConfirmEmail = document.getElementById("ConfirmEmail");

  if(Email.value != ConfirmEmail.value) {
    ConfirmEmail.setCustomValidity("Emails Don't Match");
  } else {
    ConfirmEmail.setCustomValidity('');
  }
  Email.onchange = validateEmail;
  ConfirmEmail.onkeyup = validateEmail;
}

function CheckPasswordStrength(password) {
  var password_strength = document.getElementById("password_strength");

//TextBox left blank.
if (password.length == 0) {
  password_strength.innerHTML = "";
  return;
}

//Regular Expressions.
var regex = new Array();
regex.push("[A-Z]"); //Uppercase Alphabet.
regex.push("[a-z]"); //Lowercase Alphabet.
regex.push("[0-9]"); //Digit.
regex.push("[$@$!%*#?&]"); //Special Character.

var passed = 0;

//Validate for each Regular Expression.
for (var i = 0; i < regex.length; i++) {
  if (new RegExp(regex[i]).test(password)) {
    passed++;                     
  }
}

//Validate for length of Password.
if (passed > 2 && password.length > 7) {
  passed++;
}

if ( password.length > 5 ) {

//Display status.
var color = "";
var strength = "";
switch (passed) {
  case 0:
  case 1:                                             
  strength = "Weak";
  color = "red";
  break;
  case 2:
  strength = "Good";
  color = "darkorange";
  break;
  case 3:    
  case 4:
  strength = "Strong";
  color = "green";
  break;
  default :
  strength = "Very Strong";
  color = "darkgreen";
  break;
}
}
else{
  strength = "Weak";
  color = "red";
}           
if (strength=="Weak") {
  document.getElementById("password").setCustomValidity("Password must inlude 6 and more character in length and at least 2 of (a-z), (A-Z), (0-9), (!@#$%^&*) types");
}
else {
  document.getElementById("password").setCustomValidity('');
}         
password_strength.innerHTML = strength;
password_strength.style.color = color;
}

function selectMovementKind(){
  if( document.getElementById('movementKind').value==="Πρακτική"){
       document.getElementById('featuredCourses').style.display='none';//to show
     }
    else
       document.getElementById('featuredCourses').style.display='block'; //to hide
}

function successMsg(id) {
    document.getElementById(id).style.display='block';
}

//stay in same tab after page refresh
$(function() { 
    // for bootstrap 3 use 'shown.bs.tab', for bootstrap 2 use 'shown' in the next line
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        // save the latest tab; use cookies if you like 'em better:
        localStorage.setItem('lastTab', $(this).attr('href'));
    });

    // go to the latest tab, if it exists:
    var lastTab = localStorage.getItem('lastTab');
    if (lastTab) {
        $('[href="' + lastTab + '"]').tab('show');
    }
});

function statusColour(status){

  var st = document.getElementById(status).value;
  var temp="st";
  var val = temp.concat(document.getElementById(status).id); 

  if(st=='approved')
    document.getElementById(val).style.backgroundColor ='#ccff99';
  else if(st=='rejected')
   document.getElementById(val).style.backgroundColor ='#ffc2b3';
 else
  document.getElementById(val).style.backgroundColor ='#f5f5f0';


}
function callphpfunction(id){
        $.ajax({
          type: "GET",
          url: "core/update_status.php",
          data: ({num:id, status: document.getElementById(id).value }),
          success: function(data) {
          }
        });
      }

function lostPass(){
  var email = prompt("Please enter your email:","");
  if (email != null && email!="") {
      alert("Check your email for password reset link!");
  }
  else{
     alert("Please rewrite your email");
 }
  }