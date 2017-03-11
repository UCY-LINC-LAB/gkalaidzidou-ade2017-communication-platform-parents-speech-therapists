<?php
include 'core/init.php';
session_start(); 

//if ( $_SESSION['logged_in'] != true){
 // header('Location: e-login.php');
//}

$therapist_id='1';//$_SESSION["user_ID"];

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



  </style>
</head>

<body>
  <?php include_once('navbar.php');?>

  <div class="container">
    <div id="calendar" class="left"></div>
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
                         '<input id="date" name="date" type="text" value="' + date.format('DD/MM/YYYY')+' " class="form-control input-md datepicker"> ' +
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
                die('Invalid query: ' . mysql_error());
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
          ]
       })


    });

  </script>



   