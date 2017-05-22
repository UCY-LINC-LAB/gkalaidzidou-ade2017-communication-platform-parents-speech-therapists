<?php
include 'core/init.php';

if ( $_SESSION['logged_in'] != true || $_SESSION['user_type']!='therapist'){
  header('Location: login.php');
}

$therapist_id=$_SESSION["therapist_id"];
$greekMonths = array('Ιανουαρίου','Φεβρουαρίου','Μαρτίου','Απριλίου','Μαΐου','Ιουνίου','Ιουλίου','Αυγούστου','Σεπτεμβρίου','Οκτωβρίου','Νοεμβρίου','Δεκεμβρίου');  

mysqli_query( $conn,"SET NAMES 'utf8'");
?>
<!DOCTYPE html>
<html>
<head>
  <title>logoucon | αρχική</title>
  <link rel="icon" type="image/png" href="img/icon.png">

  <meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
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


/*alert notice*/
.notice {
    padding: 15px;
    background-color: transparent;
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
  </style>

</head>

<body>
  <?php include_once('navbar.php');?>

  <div class="container">
    <div id="calendar" class="left"></div>
    <div class="right">

    <h3> Ολοκλήρωση</h3>
    <hr>
    <div style="overflow-y: auto; height:400px;">
    <?php 
    $notif = mysqli_query($conn,"SELECT  distinct * FROM conference as conf,patient as pat where conf.therapist_id='".$therapist_id."' and 
      DATE(conf.conference_date) < CURRENT_DATE and conf.patient_id=pat.patient_id and conf.comment IS NULL");

    if (!$notif) { // add this check.
      die('Invalid query: ' . mysql_error());
    }

    while ($notifications = mysqli_fetch_array($notif)) { ?>
      <div class="notice notice-uncompleted">
        <div class="row">
          <div class="col-md-2"> 
          <a href="#">
              <img style='height: 40px; width: 40px;' src="<?php echo $notifications['profile']?>"></a></div>
          <div class="col-md-10"> Ασυμπλήρωτη συνεδρία με <b><?php echo $notifications['first_name']." ".$notifications['last_name']?></b>
                    <a href="#;" 
            data-cid="<?php echo $notifications['conference_id']; ?>" 
            data-id="<?php echo $notifications['patient_id']; ?>" 
            data-name="<?php echo $notifications['first_name'].' '.$notifications['last_name']; ?>"
            class="btn btn-clr1 btn-xs showme"><span class="glyphicon glyphicon-option-horizontal"></span></a>
          <br>
          <p style="color: grey; font-size: 10px;"><span class="glyphicon glyphicon-pencil"></span> 
          <?php echo date('j',strtotime($notifications['conference_date'])) . ' ' .$greekMonths[intval(date('m',strtotime($notifications['conference_date'])))-1]  ?> </p>          
          </div>
        </div>
      </div>
      <?php }?>
      </div>
      
    </div>
  </div><!--container end-->
</body>
</html>

<script type="text/javascript">
    jQuery(function($){
         $('a.showme').click(function(ev){
             ev.preventDefault();
             var uid = $(this).data('id');
             var uname = $(this).data('name');
             var confeid = $(this).data('cid');

             var dialog = bootbox.dialog({
              title: '' + uname,
                message: '<div id="dynamic-content">'+
                          '<form role="form" id="completeConf" action="core/complete_conference.php" method="POST" class="form-horizontal">' +
                            '<input name="conference_id" value="'+confeid+'" type="text" hidden>'+
                             '<div class="row">'+
                              '<div class="col-md-4">'+
                              '<label for="attention" class="control-label input-group">Προσοχή</label>'+
                              '<div class="btn-group" data-toggle="buttons">'+
                                '<label class="btn btn-default">'+
                                 ' <input name="attention" value="1" type="radio" >1'+
                                '</label>'+
                                '<label class="btn btn-default">'+
                                  '<input name="attention" value="2" type="radio">2'+
                                '</label>'+
                                '<label class="btn btn-default active">'+
                                  '<input name="attention" value="3" class="active" type="radio">3'+
                                '</label>'+
                                '<label class="btn btn-default">'+
                                  '<input name="attention" value="4" class="active" type="radio">4'+
                                '</label>'+
                               '<label class="btn btn-default">'+
                                  '<input name="attention" value="5" class="active" type="radio">5'+
                                '</label>'+
                              '</div>'+
                             '</div>'+
                              '<div class="col-md-4">'+
                              '<label for="production" class="control-label input-group">Απόδοση</label>'+
                              '<div class="btn-group" data-toggle="buttons">'+
                                '<label class="btn btn-default">'+
                                  '<input name="production" value="1" type="radio" checked>1'+
                                '</label>'+
                                '<label class="btn btn-default">'+
                                 ' <input name="production" value="2" type="radio">2'+
                               ' </label>'+
                                '<label class="btn btn-default active">'+
                                  '<input name="production" value="3" type="radio">3'+
                                                '</label>'+
                                '<label class="btn btn-default">'+
                                  '<input name="production" value="4" type="radio">4'+
                                '</label>'+
                                '<label class="btn btn-default">'+
                                  '<input name="production" value="5" type="radio">5'+
                                '</label>'+
                              '</div>'+
                             ' </div>'+
                              '<div class="col-md-4">'+
                              '<label for="behavior" class="control-label input-group">Συμπεριφορά</label>'+
                              '<div class="btn-group" data-toggle="buttons">'+
                                '<label class="btn btn-default">'+
                                  '<input name="behavior" value="1" type="radio" >1'+
                                '</label>'+
                                '<label class="btn btn-default">'+
                                  '<input name="behavior" value="2" type="radio">2'+
                                '</label>'+
                                '<label class="btn btn-default active" >'+
                                  '<input name="behavior" value="3"  type="radio">3'+
                                '</label>'+
                                '<label class="btn btn-default">'+
                                  '<input name="behavior" value="4"  type="radio">4'+
                               ' </label>'+
                               ' <label class="btn btn-default">'+
                                  '<input name="behavior" value="5"  type="radio">5'+
                                '</label>'+
                              '</div>'+
                              '</div>'+
                              '</div>'+

                              '<div class="row"  style="margin-top: 10px;" >'+
                                '<div class="col-md-12">'+
                                 ' <p style="font-weight: bold;">Σχόλια</p>'+
                                  '<textarea  class="form-control" name="comments" placeholder=""></textarea>'+
                                '</div>'+
                              '</div>'+
                           '</form>'+
                         '  </div>',
                  buttons: {
                    success: {
                        label: "Ολοκλήρωση",
                        className: "btn-success",
                        callback: function () {
                          $("#completeConf").submit();
                            this.close();
                        }
                    }
                }
          }); 
         });
    });
</script>

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
                         '<label style="margin-right: 15px;" class="col-md-1 control-label">  εώς   </label> ' +

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
                         '<label class="col-md-4 control-label" for="">Όνομα περιστατικού</label> ' +

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
                         '<form > ' +

                        
                         '<div class="form-group"> ' +
                         '<label class="col-md-4 control-label">Πότε</label> ' +
                         '<label class="col-md-6 control-label" style=" font-weight: normal">'+ moment(calEvent.start).format('dddd, DD MMM,h:mm') + ' - '+ moment(calEvent.end).format('h:mm')+
                         '</div> ' +

                         '<div class="form-group"> ' +
                         '<label class="col-md-4 control-label">Περιγραφή στόχου</label> ' +
                         '<label class="col-md-6 control-label" style=" font-weight: normal">'+ calEvent.msg +'</label> ' +  
                         '</div> ' +

                         '<div class="form-group"> ' +
                         '<label class="col-md-4 control-label">Σχόλια</label> ' +
                         '<label class="col-md-6 control-label" style=" font-weight: normal">'+ calEvent.comment +'</label> ' +  
                         '</div> ' +

                         '<div class="form-group"> ' +
                         '<label class="col-md-4 control-label">Βαθμολογία</label> ' +
              

                         '<label class="col-md-6 control-label" style=" font-weight: normal">'+ "Απόδοση (" +calEvent.s1 + "/5), Συμπεριφορά ("  +calEvent.s2 + "/5), Προσοχή ("  + calEvent.s3 +'/5)</label> ' +  

                         '</div> ' +

                         '<input name="eventID" hidden value="'+calEvent.id +'">'+
                         '</form> </div> </div>',
                buttons: {
                    cancel: {
                        label: '<i class="fa fa-times "></i> Διαγραφή',
                        className: "btn-danger",
                        callback: function () {
                           var deleteModal =  bootbox.dialog({
                title: "Διαγραφή συνεδρίας",
                message: '<div class="row"> ' +
                         '<div class="col-md-12"> ' +
                         '<form id="deleteConf" action="core/delete_conference.php" method="POST" class="form-horizontal"> ' +

                         '<div class="form-group"> ' +
                         '<div style="margin: 10px;" class="alert alert-danger" ><span class="glyphicon glyphicon-warning-sign"></span> Είστε σίγουροι για την διαγραφή του/της <b>'+

                        calEvent.title+ '</b> <label id="name"></label></div>'+
                         '</div>'+
                          '<input name="eventID" hidden value="'+calEvent.id +'">'+
                         '</form> </div> </div>',
                buttons: {
                    success: {
                        label: "Ναι",
                        className: "btn-success",
                        callback: function () {
                          $("#deleteConf").submit();
                            this.close();
                        }
                    },
                    cancel: {
                        label: 'Όχι',
                        className: "btn-danger",
                        callback: function () {
                          $(document).on('click', '.modal-backdrop', function (event) {
    bootbox.hideAll()
});
                        }
                }
              }
            });
         
        deleteModal.modal("show");
                        }
                    },
                    success: {
                        label: '<i class="fa fa-pencil"></i> Τροποποίηση',
                        className: "btn-success",
                        callback: function () {
                           var editModal =  bootbox.dialog({
                title: "Τροποποίηση συνεδρίας",
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
                         '<label style="margin-right: 15px;" class="col-md-1 control-label"> εώς </label> ' +

                         '<div class=" col-md-2 input-group bootstrap-timepicker timepicker"  style="width=100%; float:left" >' +
                         '<input id="timepicker2" name="endTime" type="text" class="form-control input-small" value="' +  moment(calEvent.end).format('h:mm') +'">'+
                         '<span class="input-group-addon" ><i class="glyphicon glyphicon-time"></i></span>' +
                         '</div> ' +
                         '</div> ' +

                         '<div class="form-group"> ' +
                         '<label class="col-md-4 control-label">Περιγραφή στόχου</label> ' +
                         '<div class="col-md-6"> ' +
                         '<textarea rows="2" cols="50" placeholder="Γράψε κάτι" class="form-control" name="targetDescription">'+ calEvent.msg+'</textarea> ' +
                         '</div> ' +
                         '</div> ' +

                         '<div class="form-group"> ' +
                         '<label class="col-md-4 control-label" for="">Όνομα περιστατικού</label> ' +

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
                         '</div>'+


                         '<div class="form-group"> ' +
                         '<label class="col-md-4 control-label">Σχόλια</label> ' +
                         '<div class="col-md-6"> ' +
                         '<textarea rows="2" cols="50" class="form-control" name="comments">'+ calEvent.comment+'</textarea> ' +
                         '</div> ' +
                         '</div> ' +


                         '<div class="form-group">'+
                          '<div class="col-md-4">'+
                          '<label for="attention" class="control-label input-group">Προσοχή</label>'+
                          '<div class="btn-group" data-toggle="buttons">'+
                            '<label class="btn btn-default">'+
                             ' <input name="attention" value="1" type="radio" checked="checked">1'+
                            '</label>'+
                            '<label class="btn btn-default">'+
                              '<input name="attention" value="2" type="radio">2'+
                            '</label>'+
                            '<label class="btn btn-default">'+
                              '<input name="attention" value="3"  type="radio">3'+
                            '</label>'+
                            '<label class="btn btn-default">'+
                              '<input name="attention" value="4" type="radio">4'+
                            '</label>'+
                           '<label class="btn btn-default">'+
                              '<input name="attention" value="5" type="radio">5'+
                            '</label>'+
                          '</div>'+
                         '</div>'+
                          '<div class="col-md-4">'+
                          '<label for="production" class="control-label input-group">Απόδοση</label>'+
                          '<div class="btn-group" data-toggle="buttons">'+
                            '<label class="btn btn-default">'+
                              '<input name="production" value="1" type="radio">1'+
                            '</label>'+
                            '<label class="btn btn-default">'+
                             ' <input name="production" value="2" type="radio">2'+
                           ' </label>'+
                            '<label class="btn btn-default">'+
                              '<input name="production" value="3" class="active" type="radio">3'+
                                            '</label>'+
                            '<label class="btn btn-default">'+
                              '<input name="production" value="4" class="active" type="radio">4'+
                            '</label>'+
                            '<label class="btn btn-default">'+
                              '<input name="production" value="5" class="active" type="radio">5'+
                            '</label>'+
                          '</div>'+
                         ' </div>'+
                          '<div class="col-md-4">'+
                          '<label for="behavior" class="control-label input-group">Συμπεριφορά</label>'+
                          '<div class="btn-group" data-toggle="buttons">'+
                            '<label class="btn btn-default">'+
                              '<input name="behavior" value="1" type="radio" >1'+
                            '</label>'+
                            '<label class="btn btn-default">'+
                              '<input name="behavior" value="2" type="radio">2'+
                            '</label>'+
                            '<label class="btn btn-default">'+
                              '<input name="behavior" value="3" class="active" type="radio">3'+
                            '</label>'+
                            '<label class="btn btn-default">'+
                              '<input name="behavior" value="4" class="active" type="radio">4'+
                           ' </label>'+
                           ' <label class="btn btn-default">'+
                              '<input name="behavior" value="5" class="active" type="radio">5'+
                            '</label>'+
                          '</div>'+
                          '</div>'+
                          '</div>'+

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
                 $scores = mysqli_query($conn,"SELECT  distinct * FROM conference_score_bar csb where csb.conference_id='".$list['conference_id']."' ");
                 
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
            msg :'<?php if (is_null($list['target_description'])) echo '-'; else echo $list['target_description'];?>',
            id: '<?php echo $list['conference_id']?>',
            comment: '<?php if (is_null($list['comment'])) echo '-'; else echo $list['comment']?>',
            s1: '-',
            s2: '-',
            s3: '-',
          <?php  if (!$scores) { // add this check.
                    //die('Invalid query: ' . mysql_error());
                  }else{
                    while ($scorelist = mysqli_fetch_array($scores)) {  
                        if($scorelist['title']=='Apodosh'){?>
                          s1: '<?php echo $scorelist['score'];?>',
                        <?php }else if($scorelist['title']=='Simperifora'){?>
                          s2: '<?php echo $scorelist['score'];?>',
                        <?php }else if($scorelist['title']=='Prosoxh'){?> 
                          s3: '<?php echo $scorelist['score'];?>',

                        <?php }}}?>
          },
          <?php } ?>
          // other events here
          ],
          eventColor: '#378006',

       })


    });

  </script>