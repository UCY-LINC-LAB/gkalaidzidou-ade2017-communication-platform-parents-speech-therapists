<?php
include 'core/init.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="author" content="Giouliana Kalaitzidou">

    <title>logoucon | καλώς ορίσατε</title>
    <link rel="icon" type="image/png" href="img/logo.png">

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

    <!-- Custom CSS -->
    <link href="css/scrolling-nav.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <!--For Modal-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <!--  jQuery -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

    <!-- Bootstrap Date-Picker Plugin -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

    <script>
    $(document).ready(function(){
      var date_input=$('input[name="date"]'); //our date input has the name "date"
      var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
      var options={
        format: 'yyyy/mm/dd',
        container: container,
        todayHighlight: true,
        autoclose: true,
    };
    date_input.datepicker(options);
    })
    </script>

    <script src="js/myScripts.js"></script>

    <style type="text/css">
        .btn-clr1{
            background-color: #098680;
            color:white;
        }
        .btn-clr2{
            background-color: #E2CB35;
            color:white;
        }
        body {
         background-image: url("img/2.jpg");
         background-repeat:no-repeat;
         background-size:100% 100vh;
            }

        .modal-body {
            position: relative;
            overflow-y: auto;
            max-height: 500px;
            width: auto;
}

    </style>
</head>

<!-- The #page-top ID is part of the scrolling feature - the data-spy and data-target are part of the built-in Bootstrap scrollspy function -->
<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top" >
    <div class="container">
        <div class="content">
            <div class="row" align="center">
                <img src="img/logo.png" alt="logo" style="width:50%;" >
                <div class="login-form" style="margin-top: 20px;">
                    <form action="core\login.php" method="post">
                        <fieldset>
                            <div class="inner-addon left-addon" style="margin-bottom: 10px;">
                                <i class="glyphicon glyphicon-user"></i>
                                <input type="text" class="form-control" style="width: 100% font-size: 14px;" placeholder="Email" name="email" required>
                            </div>
                            <div class="inner-addon left-addon">
                                <i class="glyphicon glyphicon-lock"></i>
                                <input type="password" class="form-control" style="width: 100%;  font-size: 14px;" placeholder="Κωδικός πρόσβασης" name="password" required>
                                 <script> validateEmail();</script>
                            </div>
                            <div style="padding-top: 10px;">
                                <input class="btn btn-s pull-right btn-clr1"  type="submit" style="font-weight: bold; " value='Είσοδος'>
                            </div>
                        </fieldset>
                        <div style="margin-top: 20px;" align="center">
                            <a href="" style="font-size: x-small;color: inherit;" onclick="lostPass()">Ξεχάσατε τον κωδικό σας;</a>
                        </div>
                        <div style="width: 100%; height: 20px; border-bottom: 1px solid #5e5e5e; " class="pull-left"></div>
                        <div style="margin-top: 40px">
                            <button type="button" class="btn btn-clr2 btn-xs left-block" data-toggle="modal" data-target="#myModalNorm"> Εγγραφή</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> <!-- /container -->

<!--<div id="screenshot_div">
  <button type="button" onclick="take_screenshot()">Take Screenshot</button>
</div>-->

<script>
function take_screenshot()
{
 html2canvas(document.body, {  
  onrendered: function(canvas)  
  {
    var img = canvas.toDataURL()
    $.post("save_screenshot.php", {data: img}, function (file){
    window.location.href =  "save_screenshot.php?file="+ file
    });
  }
 });
}
</script>
<!--
    <script type="text/javascript" src="html2canvas-0.5.0-alpha1/dist/html2canvas.js"></script>
    <script type="text/javascript">
        html2canvas(document.body).then(function(canvas) {
            document.body.appendChild(canvas);
        });
    </script>-->
</body>


<?php
if(isset($_GET['wrong_login'])){?>
<script type="text/javascript">
alert("Please check your email/password");
window.location.href='login.php';
</script>

<?php ;}
?>

</html>

<!-- Modal -->
<div class="modal fade" id="myModalNorm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel" style="font-family: Sans-serif;font-weight: bold; color:#2F4F4F">
                   Εγγραφή
                </h4>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <form role="form"  action="core/register.php" method="POST" class="form-horizontal">
                 <div class="row">
                    <label  class="col-sm-6"  style="margin-bottom: 10px;" for="Fname">Όνομα</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" style="margin-bottom: 10px;"
                        id="Fname" placeholder="" name="fname" required/> 
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-6" style="margin-bottom: 10px;" for="LName">Επίθετο</label>
                    <div class="col-sm-6"> 
                        <input type="text"  style="margin-bottom: 10px;" class="form-control"
                        id="Lname" placeholder="" name="lname" required/>  
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-6" style="margin-bottom: 10px;" for="telephone">Τηλέφωνο</label>
                    <div class="col-sm-6"> 
                        <input type="text"  style="margin-bottom: 10px;" class="form-control"
                        id="telephone" placeholder="" name="telephone" required/>  
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-6" style="margin-bottom: 10px;" for="Email">Ηλεκτρονικό Ταχυδρομείο</label>
                    <div class="col-sm-6"> 
                        <input type="email"  style="margin-bottom: 10px;" class="form-control"
                        id="Email" placeholder="" name="email" required/>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-6" style="margin-bottom: 10px;" for="Email">Επιβεβαίωση Ηλεκ. Ταχυδρομείου</label>
                    <div class="col-sm-6"> 
                        <input type="email"  style="margin-bottom: 10px;" class="form-control"
                        id="ConfirmEmail" placeholder="" name="email2" required/>
                    </div>
                     <script> validateEmail();</script>
                </div>
                <div class="row">
                    <label class="col-sm-4" style="margin-bottom: 10px;" for="Password" >Κωδικός Πρόσβασης </label>
                    <p class="col-sm-2"><b><span id="password_strength"></span></b></p>
                    <div class="col-sm-6">  
                     
                        <input type="password"  style="margin-bottom: 10px;" class="form-control"
                        id="password" placeholder="" name="password1" required onkeyup="CheckPasswordStrength(this.value)"/>
                    </div>
                    
                </div>
                <div class="row">
                    <label class="col-sm-6" style="margin-bottom: 10px;" for="ConfirmPassword">Επιβεβαίωση Κωδικού Πρόσβασης</label>
                    <div class="col-sm-6"> 
                        <input type="password" style="margin-bottom: 10px;" class="form-control"
                        id="ConfirmPassword" placeholder="" name="ConfirmPassword" required/>
                    </div>
                   <script> validatePassword();</script>
                </div>
                <div class="row">
                    <label class="col-sm-6" style="margin-bottom: 10px;" for="date">Ημερομηνία Γέννησης</label>
                    <div class="col-sm-6"> 
                        <input class="form-control" style="margin-bottom: 10px;" id="date" name="date" placeholder="MM/DD/YYYY" type="text" required/>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-6" style="margin-bottom: 10px;" for="sel1">Τύπος χρήστη</label>
                    <div class="col-sm-6" > 
                        <select class="form-control" id="sel1" style="margin-bottom: 10px;" name="type" required>
                            <option value="therapist">Λογοθεραπευτής</option>
                            <option value="parent">Γονέας</option>
                        </select>
                    </div>
                </div>
            </div>     
            <!-- Modal Footer -->
            <div class="modal-footer" style="background-color: #F5F5F5;">
                <input type="submit" class="btn btn-primary" value="Εγγραφή">
            </div>
            </form>
        </div>
    </div>
</div>
</div>
