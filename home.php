<!DOCTYPE html>
<html>
<head>
  <title>logoucon | home</title>
  <link rel="icon" type="image/png" href="img/logo.png">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <link rel='stylesheet' href='fullcalendar/fullcalendar.css' />
  <script src='fullcalendar/lib/jquery.min.js'></script>
  <script src='fullcalendar/lib/moment.min.js'></script>
  <script src='fullcalendar/fullcalendar.js'></script>

  <script type="text/javascript">
    $(document).ready(function() {

    // page is now ready, initialize the calendar...
    $('#calendar').fullCalendar({
        // put your options and callbacks here
        weekends: true, // will hide Saturdays and Sundays
        fixedWeekCount: false,
        dayClick: function() {
        alert('a day has been clicked!');
    },
     header: {
      left: 'prev,next today',
      center: 'title',
      right: 'month,agendaWeek,agendaDay'
    },
    windowResize: function(view) {
    }
   })
});
  </script>

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

    #notifTitle{
    float: center;
    color: black;
    font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
    font-size: 25px;
    color: #333;
    }
    .ScrollStyle
    {
      max-height: 200px;
      overflow-y:auto;
      overflow-x: hidden;
    }
  </style>
</head>

<body>
  <?php include_once('navbar.php');?>

  <div class="container">

    <div id="calendar" class="left">
    </div>
    <!--<button type="button" class="btn btn-warning btn-circle" data-toggle="modal" data-target="#myModal" style="margin-top: 70px;"><i class="glyphicon glyphicon-plus"></i>Δημιουργία</button>-->

    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Προσθήκη Συνεδρίας</h4>
          </div>
          <div class="modal-body">
            <form>
              <div class="row">
                  <div class="col-sm-4">  <label style="margin-top: 10px;" for="date">Ημερομηνία: </label></div>
                  <div class="col-sm-8"> 
                      <input class="form-control" style="margin-bottom: 10px;" id="date" name="date" placeholder="" type="text" required/>
                  </div>
              </div>
              <div class="row">
                  <div class="col-sm-4">  <label style="margin-top: 10px;" for="date">Ώρα: </label></div>
                  <div class="col-sm-8"> 
                      <input class="form-control" style="margin-bottom: 10px;" id="time" name="date" placeholder="" type="text" required/>
                  </div>
              </div>
              <div class="row">
                  <div class="col-sm-4">  <label style="margin-top: 10px;" for="date">Περιγραφή: </label></div>
                  <div class="col-sm-8"> 
                      <input class="form-control" style="margin-bottom: 10px;" id="comment" name="date" placeholder="" type="text" required/>
                  </div>
              </div>
          </form>
        </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <input type="submit" class="btn btn-primary" value="Προσθήκη" style="float: right;">
          </div>
        </div>
      </div>
    </div> <!--Modal end-->

    <div class="right">
    <div id="notifTitle" style="margin-bottom: 20px;">
      Notifications
    </div>
    <div class="ScrollStyle" >
      <div class="row" style=" padding: 10px 0px; background-color: #fbfbfb;">
        <div class="col-sm-2">
          <img style='height: 40px; width: 40px;' class="img-circle" src="img/profile.jpg">
        </div>
        <div class="col-sm-10">
          <label for="fullName">Χρίστος Παύλου</label>
          <label for="time" style="color:grey; font-weight: normal; float: right;"> 34 min</label>
          <br> <p>Hellooooo</p>
        </div>
      </div>
      <hr style="margin-top: 1px; margin-bottom: 0px;">
      <div class="row" style=" padding: 10px 0px; background-color: #fbfbfb;">
        <div class="col-sm-2">
          <img style='height: 40px; width: 40px;' class="img-circle" src="img/profile.jpg">
        </div>
        <div class="col-sm-10">
          <label for="fullName">Χρίστος Παύλου</label>
          <label for="time" style="color:grey; font-weight: normal; float: right;"> 34 min</label>
          <br> <p>Hellooooo</p>
        </div>
      </div>
    </div><!--notifi div end-->
    </div>
  </div><!--container end-->
</body>
</html>
