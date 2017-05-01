<?php
include 'core/init.php';

$greekMonths = array('Ιανουαρίου','Φεβρουαρίου','Μαρτίου','Απριλίου','Μαΐου','Ιουνίου','Ιουλίου','Αυγούστου','Σεπτεμβρίου','Οκτωβρίου','Νοεμβρίου','Δεκεμβρίου');  
$new_notifications = mysqli_query($conn,"SELECT  distinct * FROM notification_box as nb where nb.notif_to='".$_SESSION["email"]."' and nb.state='0' ");


if (!$new_notifications) { // add this check.
  die('Invalid query: ' . mysql_error());
}

$count_new_notif = mysqli_num_rows($new_notifications);

echo $_SESSION['ff'];
?>

<!DOCTYPE html>
<html>
<head>

<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<style>
.navbar {
  background-color: #ebebeb !important; 
  border-color: transparent; 
  border-radius: 0%;
  box-shadow: 0 0 6px 3px rgba(0,0,0,.35);
   
}
/** Default navbar **/
.navbar-default .navbar-nav>li>a { 
  padding-top: 25px; 
  padding-bottom: 25px; 
  min-height: 69px; 
  color: black;
}
.navbar-default .navbar-nav > li > a:hover {color: #DDBE42;}
.navbar-default .navbar-nav > .active > a,
.navbar-default .navbar-nav > .active > a:hover,
.navbar-default .navbar-nav > .active > a:focus {
  background-color: transparent;
  color: #DDBE42;
}
.navbar-default .navbar-nav > .open > a,
.navbar-default .navbar-nav > .open > a:hover,
.navbar-default .navbar-nav > .open > a:focus {
 /* background-color: transparent;*/
  color: #DDBE42;
}
.navbar-default .navbar-nav .open .dropdown-menu {
  background-color: #ebebeb !important;
}
.navbar-default .navbar-nav .open .dropdown-menu > li > a{
  color: #1e1e15 !important;
  padding: 12px 12px 12px 12px !important;
}
.navbar-default .navbar-nav .open .dropdown-menu > li > a:hover,
.navbar-default .navbar-nav .open .dropdown-menu > li > a:focus {
  color: #DDBE42 !important;
  /*background-color: transparent !important;*/
}
.navbar-default .navbar-nav .open .dropdown-menu > .active > a,
  .navbar-default .navbar-nav .open .dropdown-menu > .active > a:hover,
  .navbar-default .navbar-nav .open .dropdown-menu > .active > a:focus {
    color: #DDBE42 !important;
    background-color: transparent !important;
  }

.navbar-default .navbar-toggle:hover,
.navbar-default .navbar-toggle:focus {
 /* border-color: transparent;
  background-color: transparent;*/
}
.navbar-form { padding-top: 10px !important;}
.navbar-text { margin-top: 25px; }
.navbar-default .navbar-text { color: #CBAF3B;}
.navbar-default .navbar-brand {
  font-size: 21px;
  color: #CBAF3B;
  margin-top: 10px;
}
.navbar-default .navbar-brand:hover,
.navbar-default .navbar-brand:focus {
  color: #DDBE42;
}
.img-circle {
    border-radius: 50%;
  }
@media (min-width: 979px) {
  ul.nav li.dropdown:hover > ul.dropdown-menu {
    display: block;
    background-color: #ebebeb !important;
    border: none;
    box-shadow: 0 6px 3px rgba(0,0,0,.35);
  }
}

/* CSS used here will be applied after bootstrap.css */
.notifications {
   min-width:620px; 
  }
  
  .notifications-wrapper {
     overflow:auto;
      max-height:250px;
    }
    
 .menu-title {
     color:black;
     font-size:1.5rem;
     display:inline-block;
      }
 
.glyphicon-circle-arrow-right {
      margin-left:10px;     
   }
  
   
 .notification-heading, .notification-footer  {
  padding:2px 10px;
       }
      
        
.dropdown-menu.divider {
  margin:5px 0;          
  }

.item-title {
  
 font-size:1.3rem;
 color:#000;
    
}
.item-info {
  
 font-size:1.3rem;
    
}

.notifications a.content {
 text-decoration:none;
 background: white;

 }
    
.notification-item {
 padding:10px;
 margin:5px;
 background: white;
 border-radius:4px;
 }

.notif{
  position: absolute; 
  background-color: #DDBE42 !important;
  border: none;
  box-shadow: 0 6px 3px rgba(0,0,0,.35);
  z-index: 10; 
  width: 350px;
  left: 730px;
  top:85px;
}

.num {
  position: absolute;
  right: -13px;
  top: -15px;
  color: #fff;
  background-color: #dd0000;
  padding-right: 7px;
  padding-left: 7px;
  padding-bottom: 5px;
  border-radius: 25px;
  font-size:1.3rem;
}

.triangle-1
{
  position: absolute;
    right: 291px;
  top: 64px;
    height: 0px;
    width: 0px;
    border-left: 15px solid transparent;
    border-right: 15px solid transparent;
    border-bottom: 15px solid #DDBE42;
    /*#70c282;*/
}

input[type="file"] {
    display: none;
}
.custom-file-upload {
    border: 1px solid #ccc;
    display: inline-block;
    padding: 6px 12px;
    cursor: pointer;
}
</style>


</head>

<body>
<div class="navbar navbar-default" role="navigation">
      <div class="container">
        <div class="navbar-header" style="margin-right: -20px;">
          <a href=""><img style="height:70px; width: 200px;" src="img/logoT4.png" style=""></a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Menu</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div id="navbar" class="navbar-collapse collapse" >
          <ul class="nav navbar-nav">
            <li class="active" ><a href="home.php"><b>ΗΜΕΡΟΛΟΓΙΟ</b></a></li>
            <li ><a href="members.php"><b>ΕΓΓΕΓΡΑΜΜΕΝΟΙ</b></a>
            </li>
            <li> <a href="history_details.php"><b>ΙΣΤΟΡΙΚΑ</b></a>
            </li>
            <li class="dropdown"><a href="exercises.php"><b>ΑΣΚΗΣΕΙΣ</b></a></li>
          </ul>

          <ul class="nav navbar-nav navbar-right">
          <li class="dropdown" id="notification" ><a> <span class="glyphicon glyphicon-bell" style="font-size: 15px; border-radius: 50%; border: 1px solid rgb(205, 209, 215); padding: 5px;"><span class="num"><b><?php echo $count_new_notif?></b></span> </span> </a>
          </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
              <img style='height: 20px; width: 20px;' class="img-circle" src="<?php echo $_SESSION["photo"]?>">
              <b><?php echo $_SESSION["first_name"].' '.$_SESSION["last_name"]?></b><span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#myModalNorm" role="button" data-toggle="modal"> <span class="glyphicon glyphicon-log-out"></span> Ρυθμίσεις</a></li>
                <li><a href="core/logout.php"><span class="glyphicon glyphicon-cog"></span> Έξοδος</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </div>

<div id="show_notification_tri" class="triangle-1" style="display: none"></div>
<div  id="show_notification"  class="notif" style="display: none">


<div class="notification-heading"><h4 class="menu-title"><b>Ειδοποιήσεις</b></h4></h4></div>

   <div class="notifications-wrapper">

    <?php 
    $notification = mysqli_query($conn,"SELECT  distinct * FROM notification_box as nb,user as u where nb.notif_to='".$_SESSION["email"]."' and u.email=nb.notif_from ORDER BY nb.date DESC ");

    if (!$notification) { // add this check.
      die('Invalid query: ' . mysql_error());
    }
    while ($notification_list = mysqli_fetch_array($notification)) { 

      if($notification_list["notif_type"]=="comment"){?>

     <div class="content">
       <div class="notification-item">
        <a  href="#"><h4 class="item-title"><img style='height: 20px; width: 20px;' class="img-circle" src="img/profile.jpg"><b><?php echo " ".$notification_list['first_name']." ".$notification_list['last_name']; ?></b> σχολιάσε την άσκηση.</h4></a>
        <p class="item-info" style="color: grey; margin-left: 17px;"><i class="fa fa-comment" aria-hidden="true" style="margin-right:7px; "></i><?php echo date('j',strtotime($notification_list['date'])) . ' ' .$greekMonths[intval(date('m',strtotime($notification_list['date'])))-1]; ?></p>
      </div>
    </div>
    
    <?php }else{?>

    <div class="content" href="#">
       <div class="notification-item">
        <a  href="#"><h4 class="item-title"><img style='height: 20px; width: 20px;' class="img-circle" src="img/profile.jpg"><b><?php echo " ".$notification_list['first_name']." ".$notification_list['last_name']; ?></b> έχει συνδεθεί μαζί σας.</h4></a>
        <p class="item-info" style="color: grey; margin-left: 17px;"><i class="fa fa-user" aria-hidden="true" style="margin-right:7px; "></i><?php echo date('j',strtotime($notification_list['date'])) . ' ' .$greekMonths[intval(date('m',strtotime($notification_list['date'])))-1]; ?></p>
      </div>
    </div>

     <?php }}?>
   </div>

    <div class="notification-footer" style="float: right;"><a href="see_all_notifications.php" style="color:black;">Προβολή όλων</a></div>
</div>
    </div>

    <!--script for active item in navbar-->
    <script >
      $(document).ready(function() {
          // -----------------------------------------------------------------------
          $.each($('#navbar').find('li'), function() {
              $(this).toggleClass('active', 
                  window.location.pathname.indexOf($(this).find('a').attr('href')) > -1);
          }); 
          // -----------------------------------------------------------------------
      });
    </script>

<script>
$(document).ready(function(){
    $("#notification").click(function(){
        $("#show_notification").toggle();
        $("#show_notification_tri").toggle();

        var x = new XMLHttpRequest();
        x.open("GET","core/read_notifications.php",true);
        x.send();
        return false;
    });
});
</script>
</body>
</html>



    <!-- Modal for general account settings-->
<div class="modal fade" id="myModalNorm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header"  style="background-color: #F5F5F5;">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel" style="font-family: Sans-serif;font-weight: bold; color:#2F4F4F">
                    Ρυθμίσεις Λογαριασμού
                </h4>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <form role="form"  action="core/update_personal_settings.php" method="POST" class="form-horizontal">
                <div class="row">
                        <label class="col-sm-3"  style="margin-top: 10px;"for="Password" >Όνομα</label>
                        <div class="col-sm-8">  
                            <input type="text"  style="margin-bottom: 10px;" class="form-control" id="Fname" name="fname" />
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-3"  style="margin-top: 10px;"for="Password" >Επίθετο</label>
                        <div class="col-sm-8">  
                            <input type="text"  style="margin-bottom: 10px;" class="form-control" id="Lname" name="lname" />
                        </div>
                    </div>
                <div class="row" style="background-color: #F5F5F5; margin-bottom:10px; margin-top:10px;">
                    <input type="submit" class="btn btn-primary pull-right" value="Αποθήκευση" name="changeName" style="margin-right:64px;"/>
                </div>
                 </form>
                  <form role="form"  action="core/update_personal_settings.php" method="POST" class="form-horizontal">
                    <div class="row">
                        <label class="col-sm-3"  style="margin-top: 10px;"for="Password" >Κωδικός πρόσβασης</label>
                        <div class="col-sm-8">  
                            <input type="password"  style="margin-bottom: 10px;" class="form-control"
                            id="current_password" name="current_password" required onkeyup="CheckPasswordStrength(this.value)"/>
                        </div>
                         <div  style="margin-top:10px;"> <span id="password_strength"></span></div>
                    </div>
                     <div class="row">
                        <label class="col-sm-3"  style="margin-top: 10px;" for="Password" >Νέος κωδικός</label>
                        <div class="col-sm-8">  
                            <input type="password"  style="margin-bottom: 10px;" class="form-control"
                            id="password" name="password" required onkeyup="CheckPasswordStrength(this.value)"/>
                          
                        </div>
                         <div  style="margin-top:10px;"> <span id="password_strength"></span></div>
                    </div>
                    <div class="row">
                        <label class="col-sm-3" style="margin-top: 10px;" for="ConfirmPassword">Επανάληψη νέου κωδικού</label>
                        <div class="col-sm-8"> 
                            <input type="password"   class="form-control"
                            id="ConfirmPassword" name="ConfirmPassword" />
                        </div>
                       <script> validatePassword();</script>
                    </div>
                     <div class="row" style="background-color: #F5F5F5; margin-bottom:10px; margin-top:10px;">
                    <input type="submit" class="btn btn-primary pull-right" value="Αποθήκευση" name="changePassword" style="margin-right:64px;"/>
                </div>
                <!-- Modal Footer -->
                <div class="modal-footer"></div>
            </form>
            <form role="form"  action="core/update_personal_settings.php" method="POST" enctype="multipart/form-data" class="form-horizontal">
                <div class="row">
                        <label class="col-sm-3"  style="margin-top: 10px;" for="Password" >Φωτογραφία</label>
                        <div class="col-sm-8">  
                            <input type="file" name="fileToUpload" id="fileToUpload" style="margin-bottom: 10px;">
                        </div>

                        <label for="file-upload" class="custom-file-upload"><i class="fa fa-cloud-upload"></i> Επιλογή</label>
                        <input id="file-upload" name="file-upload" type="file"/>
                        <label id="selected_file"></label>
                  </div>
                <div class="row" style="background-color: #F5F5F5; margin-bottom:10px; margin-top:10px;">
                    <input type="submit" class="btn btn-primary pull-right" value="Αποθήκευση" name="upload_photo" style="margin-right:64px;"/>
                </div>
          </form>
        </div>
    </div>
</div>
</div>

<script type="text/javascript">
    document.getElementById("Fname").value="<?php echo $_SESSION['first_name'];?>";
    document.getElementById("Lname").value="<?php echo$_SESSION['last_name'];?>";
    document.getElementById("current_password").value="<?php echo  $_SESSION['passowrd'];?>";
</script>
<script type="text/javascript">
  document.getElementById('file-upload').onchange = function () {
    var file = $('#file-upload')[0].files[0]

  document.getElementById("selected_file").innerHTML =file.name;
};
</script>