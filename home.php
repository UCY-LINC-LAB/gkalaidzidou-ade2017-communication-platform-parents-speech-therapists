<?php
include 'core/init.php';
session_start(); 

//if ( $_SESSION['logged_in'] != true){
 // header('Location: e-login.php');
//}

$therapist_id='1';//$_SESSION["user_ID"];
$greekMonths = array('Ιανουαρίου','Φεβρουαρίου','Μαρτίου','Απριλίου','Μαΐου','Ιουνίου','Ιουλίου','Αυγούστου','Σεπτεμβρίου','Οκτωβρίου','Νοεμβρίου','Δεκεμβρίου');  

?>
<!DOCTYPE html>
<html>
<head>
  <title>logoucon | home</title>
  <link rel="icon" type="image/png" href="img/logo.png">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <script src="https://code.jquery.com/jquery-3.1.1.js" integrity="sha256-16cdPddA6VdVInumRGo6IbivbERE8p7CQR3HzTBuELA=" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js" ></script>

  <link rel='stylesheet' href='fullcalendar/fullcalendar.css' />
  <script src='fullcalendar/lib/jquery.min.js'></script>
  <script src='fullcalendar/lib/moment.min.js'></script>
  <script src='fullcalendar/fullcalendar.js'></script>
  <script src='fullcalendar/locale-all.js'></script>


  <!-- Bootstrap Date-Picker Plugin -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

  <!-- Bootstrap Time-Picker Plugin -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/css/bootstrap-timepicker.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/css/bootstrap-timepicker.min.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.min.js"></script>

  <!--Search and select option in modal-->
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
  <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>

  <style>
    /*split*/
    .left { 
    width: 60%; 
    margin:5px; 
    padding: 1em; 
    float:left;
    } 
    .right { 
    width: 35%; 
    padding: 1em; 
    float:right;
    } 

    .ScrollStyle
    {
      max-height: 200px;
      overflow-y:auto;
      overflow-x: hidden;
    }

    /*sticky note*/

.stickyNote {
  margin: auto;
  width: 350px; 
  height:350px;

  background: #F9FFBF; /* Fallback */
  /*background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#F9FFBF), to(#C5C500));*/

  padding: 20px 20px 20px 20px;
    -webkit-box-shadow: 0px 1px 3px #000;
    -moz-box-shadow: 0px 1px 3px #000;
}

.stickyNote h1{
  font-size: 100px;
  font-family: GoodDogRegular, Helvetica, sans-serif;
}

.stickyNote p {
  font-family: GoodDogRegular, Helvetica, sans-serif;
  font-size: 30px;
  line-height: 35px;
  margin: 10px 0 10px 0;
  width: 280px;
}

/*alert notice*/
.notice {
    padding: 15px;
    background-color: #fafafa;
    border-left: 6px solid #7f7f84;
    margin-bottom: 10px;
    -webkit-box-shadow: 0 5px 8px -6px rgba(0,0,0,.2);
       -moz-box-shadow: 0 5px 8px -6px rgba(0,0,0,.2);
            box-shadow: 0 5px 8px -6px rgba(0,0,0,.2);
}
.notice-sm {
    padding: 10px;
    font-size: 80%;
}
.notice-lg {
    padding: 35px;
    font-size: large;
}
.notice-success {
    border-color: #80D651;
}
.notice-success>strong {
    color: #80D651;
} 
.notice-uncompleted {
    border-color: #AA4643;
}
.notice-uncompleted>strong {
    color: #AA4643;
} 
.notice-warning {
    border-color: #FEAF20;
}
.notice-warning>strong {
    color: #FEAF20;
}

/*timeline single column*/
.message-item {
margin-bottom: 25px;
margin-left: 40px;
position: relative;
}
.message-item .message-inner {
background: #fff;
border: 1px solid #ddd;
border-radius: 3px;
padding: 10px;
position: relative;
}
.message-item .message-inner:before {
border-right: 10px solid #ddd;
border-style: solid;
border-width: 10px;
color: rgba(0,0,0,0);
content: "";
display: block;
height: 0;
position: absolute;
left: -20px;
top: 6px;
width: 0;
}
.message-item .message-inner:after {
border-right: 10px solid #fff;
border-style: solid;
border-width: 10px;
color: rgba(0,0,0,0);
content: "";
display: block;
height: 0;
position: absolute;
left: -18px;
top: 6px;
width: 0;
}
.message-item:before {
background: #fff;
border-radius: 2px;
bottom: -30px;
box-shadow: 0 0 3px rgba(0,0,0,0.2);
content: "";
height: 100%;
left: -30px;
position: absolute;
width: 3px;
}
.message-item:after {
background: #fff;
border: 2px solid #ccc;
border-radius: 50%;
box-shadow: 0 0 5px rgba(0,0,0,0.1);
content: "";
height: 15px;
left: -36px;
position: absolute;
top: 10px;
width: 15px;
}
.clearfix:before, .clearfix:after {
content: " ";
display: table;
}
.message-item .message-head {
border-bottom: 1px solid #eee;
margin-bottom: 8px;
padding-bottom: 8px;
}
.message-item .message-head .avatar {
margin-right: 20px;
}
.message-item .message-head .user-detail {
overflow: hidden;
}
.message-item .message-head .user-detail h5 {
font-size: 16px;
font-weight: bold;
margin: 0;
}
.message-item .message-head .post-meta {
float: left;
padding: 0 15px 0 0;
}
.message-item .message-head .post-meta >div {
color: #333;
font-weight: bold;
text-align: right;
}
.post-meta > div {
color: #777;
font-size: 12px;
line-height: 22px;
}
.message-item .message-head .post-meta >div {
color: #333;
font-weight: bold;
text-align: right;
}
.post-meta > div {
color: #777;
font-size: 12px;
line-height: 22px;
}
.lineImg {
 min-height: 40px;
 max-height: 40px;
}



/* for radio*/
.checkboxgroup {
  display: inline-block;
  text-align: center;
}
.checkboxgroup label {
  display: block;
}


/*label styling*/
label {
    font-weight: normal !important;
}
  </style>
</head>

<body>
  <?php include_once('navbar.php');?>

  <div class="container">
    <div id="calendar" class="left"></div>
    <div class="right">

    <h3> Ολοκλήρωση</h3>
    <hr>

    <?php 
    $notif = mysqli_query($conn,"SELECT  distinct * FROM conference as conf,patient as pat where conf.therapist_id='".$therapist_id."' and 
      DATE(conf.conference_date) < CURRENT_DATE and conf.patient_id=pat.patient_id");

    if (!$notif) { // add this check.
      die('Invalid query: ' . mysql_error());
    }

    while ($notifications = mysqli_fetch_array($notif)) { ?>
    <!--
      <div class="notice notice-success">
        <div class="row">
          <div class="col-md-2"> 
              <a href="#">
              <img style='height: 40px; width: 40px;'  src="img/profile.jpg"></a>
             </div>
          <div class="col-md-10"> Η σύνδεση με <b>Μαρία Γεωργίου </b> έχει ολοκληρωθεί <br>
           <p style="color: grey; font-size: 10px;"><span class="glyphicon glyphicon-globe"></span> 12 Μαρτίου </p>
          </div>
        </div>
      </div>-->
      <div class="notice notice-uncompleted">
        <div class="row">
          <div class="col-md-2"> 
          <a href="#">
              <img style='height: 40px; width: 40px;'  src="img/profile.jpg"></a></div>
          <div class="col-md-10"> Ασυμπλήρωτη συνεδρία με <b><?php echo $notifications['first_name']." ".$notifications['last_name']?></b>
          <br>
          <p style="color: grey; font-size: 10px;"><span class="glyphicon glyphicon-pencil"></span> 
          <?php echo date('j',strtotime($notifications['conference_date'])) . ' ' .$greekMonths[intval(date('m',strtotime($notifications['conference_date'])))-1]  ?> </p>          
          <p data-placement="top" data-toggle="tooltip" title="complete">
                <button class="btn btn-clr1 btn-xs" data-title="complete" data-toggle="modal" data-target="#complete" 
                  data-id="<?php echo $notifications['patient_id']; ?>" 
                  data-name="<?php echo $notifications['first_name'].' '.$notifications['last_name']; ?>">
                  <span class="glyphicon glyphicon-option-horizontal"></span></button>
                  </p>

          </div>
        </div>
      </div>
      <?php }?>
      <!--<div class="notice notice-warning">
        <div class="row">
          <div class="col-md-2"> <a href="#">
              <img style='height: 40px; width: 40px;'  src="img/profile.jpg"></a></div>
          <div class="col-md-10">Νέο σχόλιο από <b>Μαρία Γεωργίου </b><br>
           <p style="color: grey; font-size: 10px;"><span class="glyphicon glyphicon-comment"></span> 12 Μαρτίου </p></div></div>
        </div>
      </div>-->

  <!--  <div class="row">
    <h2>Time Line</h2>
  </div>
    <div class="qa-message-list" id="wallmessages">
            <div class="message-item" id="m16">
            <div class="message-inner">
              <div class="message-head clearfix">
                <div class="avatar pull-left"><a href="./index.php?qa=user&qa_1=Oleg+Kolesnichenko"><img class="lineImg" src="https://ssl.gstatic.com/accounts/ui/avatar_2x.png"></a></div>
                <div class="user-detail">
                  <h5 class="handle">Στέλιος Βαισλείου</h5>
                  <div class="post-meta">
                    <div class="asker-meta">
                      <span class="qa-message-what"></span>
                      <span class="qa-message-when">
                        <span class="qa-message-when-data">14 Μαρτίου</span>
                      </span>
                     
                      <span class="qa-message-who">
                        <span class="qa-message-who-pad">by </span>
                        <span class="qa-message-who-data"><a href="./index.php?qa=user&qa_1=Oleg+Kolesnichenko">Στέλιος Βαισλείου</a></span>
                      </span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="qa-message-content">
              <div class="row">
                <div class="col-md-4">
                  <p style="color: #50B432; font-weight: bold;">Προσοχή</p>
                  <div id="checkboxes">
                    <div class="checkboxgroup">
                      <input type="radio" name="radioP" id="radioP1" />
                      <label for="my_radio_button_id1">1</label>
                    </div>
                    <div class="checkboxgroup">
                      <input type="radio" name="radioP" id="radioP2" />
                      <label for="my_radio_button_id2">2</label>
                    </div>
                    <div class="checkboxgroup">
                      <input type="radio" name="radioP" id="radioP3" checked="" />
                      <label for="my_radio_button_id3">3</label>
                    </div>
                    <div class="checkboxgroup">
                      <input type="radio" name="radioP" id="radioP4" />
                      <label for="my_radio_button_id2">4</label>
                    </div>
                    <div class="checkboxgroup">
                      <input type="radio" name="radioP" id="radioP5" />
                      <label for="my_radio_button_id3">5</label>
                    </div>
                  </div>
                </div>
                 <div class="col-md-4">
                  <p style="color: #058DC7; font-weight: bold;">Συμπεριφορά</p>
                  <div id="checkboxes">
                    <div class="checkboxgroup">
                      <input type="radio" name="radioS" id="radioS1" />
                      <label for="my_radio_button_id1">1</label>
                    </div>
                    <div class="checkboxgroup">
                      <input type="radio" name="radioS" id="radioS2" />
                      <label for="my_radio_button_id2">2</label>
                    </div>
                    <div class="checkboxgroup">
                      <input type="radio" name="radioS" id="radioS3"  checked="" />
                      <label for="my_radio_button_id3">3</label>
                    </div>
                    <div class="checkboxgroup">
                      <input type="radio" name="radioS" id="radioS4" />
                      <label for="my_radio_button_id2">4</label>
                    </div>
                    <div class="checkboxgroup">
                      <input type="radio" name="radioS" id="radioS5" />
                      <label for="my_radio_button_id3">5</label>
                    </div>
                  </div>
                </div>
                 <div class="col-md-4">
                  <p style="color: #AA4643; font-weight: bold;">Απόδοση</p>
                  <div id="checkboxes">
                    <div class="checkboxgroup">
                      <input type="radio" name="radioA" id="radioA1" />
                      <label for="my_radio_button_id1">1</label>
                    </div>
                    <div class="checkboxgroup">
                      <input type="radio" name="radioA" id="radioA2" />
                      <label for="my_radio_button_id2">2</label>
                    </div>
                    <div class="checkboxgroup">
                      <input type="radio" name="radioA" id="radioA3" checked="" />
                      <label for="my_radio_button_id3">3</label>
                    </div>
                    <div class="checkboxgroup">
                      <input type="radio" name="radioA" id="radioA4" />
                      <label for="my_radio_button_id2">4</label>
                    </div>
                    <div class="checkboxgroup">
                      <input type="radio" name="radioA" id="radioA5" />
                      <label for="my_radio_button_id3">5</label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
              <div class="col-md-12">
                <p style="font-weight: bold;">Σχόλια</p>
                <textarea  class="form-control" name="notes" placeholder=""></textarea>
              </div>
              </div>


              </div>
          </div></div>
        
          <div class="message-item" id="m9">
            <div class="message-inner">
             
          </div></div>


        
        </div>-->
</div>


<!--
    <div class="right">


    <h4 id="notifTitle" style="margin-bottom: 60px"></h4>
    
    <div class="stickyNote">
        <textarea  class="form-control" name="notes" style="margin-bottom: 10px;  background: transparent;   height: 250px;
    border: none;" form="usrform" placeholder="Γράψε κάτι να θυμάσε.."></textarea>

      <button type="button" class="btn" style=" float: left; background: transparent; float: right;"><span class="glyphicon glyphicon-ok"> </span> Αποθήκευση</button>

    </div>
  </div>
-->
  </div><!--container end-->
</body>
</html>

 <script type="text/javascript">

    $(document).ready(function() {

    // page is now ready, initialize the calendar...
    $('#calendar').fullCalendar({
        weekends: true, // will hide Saturdays and Sundays
        fixedWeekCount: false,
        dayClick: function(date, allDay, jsEvent, view) {
            var modal =  bootbox.dialog(
            {
                title: "Προσθήκη συνεδρίας",
                message: '<div class="row"> ' +
                         '<div class="col-md-12"> ' +
                         '<form id="addConf" action="core/add_conference.php" method="POST"  class="form-horizontal"> ' +

                         '<div class="form-group"> ' +
                         '<label class="col-md-4 control-label">Ημερομηνία</label> ' +
                         '<div class="col-md-6 "> ' +
                         '<input id="date" name="date" type="text" value="' + date.format('MM/DD/YYYY')+' " class="form-control input-md datepicker"> ' +
                         '</div> ' +
                         '</div> ' +

                         '<div class="form-group"> ' +
                         '<label class="col-md-4 control-label" for="name" >Ώρα</label> ' +

                         '<div class="col-md-2 input-group bootstrap-timepicker timepicker" style="width=100%; float:left; margin-left: 16px;"> ' +
                         '<input id="timepicker1" name="startTime" type="text" class="form-control input-small" >' +
                         '<span class="input-group-addon" ><i class="glyphicon glyphicon-time"></i></span>' +
                         '</div> ' +
                         '<label class="col-md-1 control-label"> εώς </label> ' +

                         '<div class=" col-md-2 input-group bootstrap-timepicker timepicker"  style="width=100%; float:left" >' +
                         '<input id="timepicker2" name="endTime" type="text" class="form-control input-small" >' +
                         '<span class="input-group-addon" ><i class="glyphicon glyphicon-time"></i></span>' +
                         '</div> ' +
                         '</div> ' +

                         '<div class="form-group"> ' +
                         '<label class="col-md-4 control-label">Περιγραφή στόχου</label> ' +
                         '<div class="col-md-6"> ' +
                         '<textarea rows="4" cols="50" placeholder="Γράψε κάτι" class="form-control" name="targetDescription"></textarea> ' +
                         '</div> ' +
                         '</div> ' +

                         '<div class="form-group"> ' +
                         '<label class="col-md-4 control-label" for="">Όνομα ασθενή</label> ' +

                         '<div class="col-md-6">' +
                         ' <select name="patient" class="selectpicker" data-show-subtext="true" data-live-search="true"> ' +

                          <?php 
                           $patient_list = mysqli_query($conn,"SELECT  distinct * FROM patient patList where patList.therapist_id='".$therapist_id."' ");

                          if (!$patient_list) { // add this check.
                              die('Invalid query: ' . mysql_error());
                          }
                          while ($list = mysqli_fetch_array($patient_list)) { ?>
                         '<option data-subtext="<?php echo $list['parent_fname']." ".$list['parent_lname']?>" value="<?php echo $list['patient_id']?>" ><?php echo $list['first_name']." ".$list['last_name']?></option>' +
                         <?php } ?>
                         '</select>' +
                         '</div> ' +
                         
                         '</form> </div> </div>',
                buttons: {
                    success: {
                        label: "Αποθήκευση",
                        className: "btn-success",
                        callback: function () {
                          $("#addConf").submit();
                            this.close();
                        }
                    }
                }
            });

            $(".datepicker").datepicker();
            $('#timepicker1').timepicker(); 
            $('#timepicker2').timepicker(); 
            $('.selectpicker').selectpicker();
         
        modal.modal("show");
        },
        eventClick: function(calEvent, jsEvent, view) {
             var viewConfe =  bootbox.dialog({
                title: calEvent.title,
                message: '<div class="row"> ' +
                         '<div class="col-md-12"> ' +
                         '<form id="deleteConf" action="core/delete_conference.php" method="POST" class="form-horizontal"> ' +

                        
                         '<div class="form-group"> ' +
                         '<label class="col-md-4 control-label">Πότε</label> ' +
                         '<label class="col-md-6 control-label" style=" font-weight: normal">'+ moment(calEvent.start).format('dddd, DD MMM,h:mm') + ' - '+ moment(calEvent.end).format('h:mm')+
                         '</div> ' +

                         '<div class="form-group"> ' +
                         '<label class="col-md-4 control-label">Περιγραφή στόχου</label> ' +
                         '<label class="col-md-6 control-label" style=" font-weight: normal">'+ calEvent.msg +'</label> ' +  
                         '</div> ' +

                         '<input name="eventID" hidden value="'+calEvent.id +'">'+
                         '</form> </div> </div>',
                buttons: {
                    success: {
                        label: "Τροποποίηση",
                        className: "btn-success",
                        callback: function () {
                           var editModal =  bootbox.dialog({
                title: "Προσθήκη συνεδρίας",
                message: '<div class="row"> ' +
                         '<div class="col-md-12"> ' +
                         '<form id="updateConf" action="core/update_conference.php" method="POST"  class="form-horizontal"> ' +

                         '<div class="form-group"> ' +
                         '<label class="col-md-4 control-label">Ημερομηνία</label> ' +
                         '<div class="col-md-6 "> ' +
                         '<input id="date" name="date" type="text" value="' + moment(calEvent.start).format('MM/DD/YYYY') +' " class="form-control input-md datepicker"> ' +
                         '</div> ' +
                         '</div> ' +

                         '<div class="form-group"> ' +
                         '<label class="col-md-4 control-label" for="name" >Ώρα</label> ' +

                         '<div class="col-md-2 input-group bootstrap-timepicker timepicker" style="width=100%; float:left; margin-left: 16px;"> ' +
                         '<input id="timepicker1" name="startTime" type="text" class="form-control input-small" value="' +  moment(calEvent.start).format('h:mm') +'">'+
                         '<span class="input-group-addon" ><i class="glyphicon glyphicon-time"></i></span>' +
                         '</div> ' +
                         '<label class="col-md-1 control-label"> εώς </label> ' +

                         '<div class=" col-md-2 input-group bootstrap-timepicker timepicker"  style="width=100%; float:left" >' +
                         '<input id="timepicker2" name="endTime" type="text" class="form-control input-small" value="' +  moment(calEvent.end).format('h:mm') +'">'+
                         '<span class="input-group-addon" ><i class="glyphicon glyphicon-time"></i></span>' +
                         '</div> ' +
                         '</div> ' +

                         '<div class="form-group"> ' +
                         '<label class="col-md-4 control-label">Περιγραφή στόχου</label> ' +
                         '<div class="col-md-6"> ' +
                         '<textarea rows="4" cols="50" placeholder="Γράψε κάτι" class="form-control" name="targetDescription">'+ calEvent.msg+'</textarea> ' +
                         '</div> ' +
                         '</div> ' +

                         '<div class="form-group"> ' +
                         '<label class="col-md-4 control-label" for="">Όνομα ασθενή</label> ' +

                         '<div class="col-md-6">' +
                         ' <select name="patient" class="selectpicker" data-show-subtext="true" data-live-search="true"> ' +

                          <?php 
                           $patient_list = mysqli_query($conn,"SELECT  distinct * FROM patient patList where patList.therapist_id='".$therapist_id."' ");

                          if (!$patient_list) { // add this check.
                              die('Invalid query: ' . mysql_error());
                          }
                          while ($list = mysqli_fetch_array($patient_list)) { ?>
                         '<option data-subtext="<?php echo $list['parent_fname']." ".$list['parent_lname']?>" value="<?php echo $list['patient_id']?>" ><?php echo $list['first_name']." ".$list['last_name']?></option>' +
                         <?php } ?>
                         '</select>' +
                         '</div> ' +

                         '<input name="eventID" hidden value="'+calEvent.id +'">'+

                         '</form> </div> </div>',
                buttons: {
                    success: {
                        label: "Αποθήκευση",
                        className: "btn-success",
                        callback: function () {
                          $("#updateConf").submit();
                            this.close();
                        }
                    }
                }
            });

            $(".datepicker").datepicker();
            $('#timepicker1').timepicker(); 
            $('#timepicker2').timepicker(); 
            $('.selectpicker').selectpicker();
         
        editModal.modal("show");
                        }
                    },
                    cancel: {
                        label: '<i class="fa fa-check"></i> Διαγραφή',
                        className: "btn-danger",
                        callback: function () {
                          $("#deleteConf").submit();
                            this.close();
                        }
                    }
                }
            });
        viewConfe.modal("show");
        },

        header: {
              left: 'prev,next today',
              center: 'title',
              right: 'month,agendaWeek,agendaDay'
        },
        windowResize: function(view) {},
        locale: 'el',
        
        events: [
            <?php 
             $conferences_list = mysqli_query($conn,"SELECT  distinct * FROM conference confList where confList.therapist_id='".$therapist_id."' ");

            if (!$conferences_list) { // add this check.
                die('Invalid query: ' . mysqli_error($conn));
            }
            while ($list = mysqli_fetch_array($conferences_list)) {  
                 $patient_info = mysqli_query($conn,"SELECT  distinct * FROM patient patInfo where patInfo.patient_id='".$list['patient_id']."' ");
                 if (!$patient_info) { // add this check.
                    die('Invalid query: ' . mysql_error());
                  }else{
                    $patInfo = mysqli_fetch_array($patient_info);
                  }

                 ?>            
           {
            title: '<?php echo $patInfo['first_name']." ".$patInfo['last_name'] ?>',
            start:'<?php echo $list['conference_date']." ".$list['start_time']?>',
            end:'<?php echo $list['conference_date']." ".$list['end_time']?>',
            msg :'<?php echo $list['target_description']?>',
            id: '<?php echo $list['conference_id']?>'
             // url: 'http://google.com/'
          },
          <?php } ?>
          // other events here
          ],
          eventColor: '#378006',

       })


    });

  </script>


<div class="modal fade" id="complete" tabindex="-1" role="dialog" aria-labelledby="complete" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove "  style="font-size: 0.6em;" aria-hidden="true"></span></button>
        <h4 class="modal-title custom_align"></h4>
      </div>
      <div class="modal-body">
        <div id="modal-loader" style="display: none; text-align: center;">
          
         
        </div>
        <div id="dynamic-content">
        <form role="form"  action="core/update_patient.php" method="POST" class="form-horizontal">
           <div class="row">

            <input type="" name="pname" id="pname" value="">




                <div class="col-md-4">
                  <p style="color: #50B432; font-weight: bold;">Προσοχή</p>
                  <div id="checkboxes">
                    <div class="checkboxgroup">
                      <input type="radio" name="radioP" id="radioP1" />
                      <label for="my_radio_button_id1">1</label>
                    </div>
                    <div class="checkboxgroup">
                      <input type="radio" name="radioP" id="radioP2" />
                      <label for="my_radio_button_id2">2</label>
                    </div>
                    <div class="checkboxgroup">
                      <input type="radio" name="radioP" id="radioP3" checked="" />
                      <label for="my_radio_button_id3">3</label>
                    </div>
                    <div class="checkboxgroup">
                      <input type="radio" name="radioP" id="radioP4" />
                      <label for="my_radio_button_id2">4</label>
                    </div>
                    <div class="checkboxgroup">
                      <input type="radio" name="radioP" id="radioP5" />
                      <label for="my_radio_button_id3">5</label>
                    </div>
                  </div>
                </div>
                 <div class="col-md-4">
                  <p style="color: #058DC7; font-weight: bold;">Συμπεριφορά</p>
                  <div id="checkboxes">
                    <div class="checkboxgroup">
                      <input type="radio" name="radioS" id="radioS1" />
                      <label for="my_radio_button_id1">1</label>
                    </div>
                    <div class="checkboxgroup">
                      <input type="radio" name="radioS" id="radioS2" />
                      <label for="my_radio_button_id2">2</label>
                    </div>
                    <div class="checkboxgroup">
                      <input type="radio" name="radioS" id="radioS3"  checked="" />
                      <label for="my_radio_button_id3">3</label>
                    </div>
                    <div class="checkboxgroup">
                      <input type="radio" name="radioS" id="radioS4" />
                      <label for="my_radio_button_id2">4</label>
                    </div>
                    <div class="checkboxgroup">
                      <input type="radio" name="radioS" id="radioS5" />
                      <label for="my_radio_button_id3">5</label>
                    </div>
                  </div>
                </div>
                 <div class="col-md-4">
                  <p style="color: #AA4643; font-weight: bold;">Απόδοση</p>
                  <div id="checkboxes">
                    <div class="checkboxgroup">
                      <input type="radio" name="radioA" id="radioA1" />
                      <label for="my_radio_button_id1">1</label>
                    </div>
                    <div class="checkboxgroup">
                      <input type="radio" name="radioA" id="radioA2" />
                      <label for="my_radio_button_id2">2</label>
                    </div>
                    <div class="checkboxgroup">
                      <input type="radio" name="radioA" id="radioA3" checked="" />
                      <label for="my_radio_button_id3">3</label>
                    </div>
                    <div class="checkboxgroup">
                      <input type="radio" name="radioA" id="radioA4" />
                      <label for="my_radio_button_id2">4</label>
                    </div>
                    <div class="checkboxgroup">
                      <input type="radio" name="radioA" id="radioA5" />
                      <label for="my_radio_button_id3">5</label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row"  style="margin-bottom: 10px;" >
              <div class="col-md-12">
                <p style="font-weight: bold;">Σχόλια</p>
                <textarea  class="form-control" name="notes" placeholder=""></textarea>
              </div>
              </div>
            <input type="hidden" name="id" id="pid"  value="">

            <div class="row"> 
              <div class="col-sm-10" style="text-align: right;"> 
                <!--<button type="button" class="btn btn-warning btn-s">Προσθήκη</button>-->
                <input class="btn btn-warning btn-s"  type="submit" value='Αποθήκευση'>
              </div>
            </div>
         </form>
         </div>   
      </div>
    </div><!-- /.modal-content --> 
  </div><!-- /.modal-dialog --> 
</div><!-- /.modal- --> 

<!--Script for dynamic data for bootstrap modal edit, delete patient -->
<script type="text/javascript">
  $('#complete').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var modal = $(this)

    modal.find('.modal-body #pname').val(button.data('name'))
    modal.find('.modal-body #pid').val(button.data('id'))
  })
</script>


   