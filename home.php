<!DOCTYPE html>
<html>
<head>
  <title>logoucon | home</title>
  <link rel="icon" type="image/png" href="img/logo.png">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">


  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

  <script type="text/javascript" src="//code.jquery.com/jquery-1.11.3.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>



  <link rel='stylesheet' href='fullcalendar/fullcalendar.css' />
  <script src='fullcalendar/lib/jquery.min.js'></script>
  <script src='fullcalendar/lib/moment.min.js'></script>
  <script src='fullcalendar/fullcalendar.js'></script>
  <script src='fullcalendar/locale-all.js'></script>



  <script type="text/javascript">






    $(document).ready(function() {

    // page is now ready, initialize the calendar...
    $('#calendar').fullCalendar({
        // put your options and callbacks here
        weekends: true, // will hide Saturdays and Sundays
        fixedWeekCount: false,
        dayClick: function(date, jsEvent, view) {
            $('#myModal').modal('show');
          },eventClick:  function(event, jsEvent, view) {
            $('#modalTitle').html(event.title);
            $('#modalBody').html(event.description);
            $('#eventUrl').attr('href',event.url);
            $('#calendarModal').modal();
        },
     header: {
      left: 'prev,next today',
      center: 'title',
      right: 'month,agendaWeek,agendaDay'
    },
    windowResize: function(view) {
    },
     locale: 'el',
    
    events: [
        {
            title: 'My Event',
            start: '2017-02-19'
           // url: 'http://google.com/'
        }
        // other events here
    ]
   })



});

    var myevent = {title: 'All Day Event',start: new Date(2017, 02, 12)};
$('.calendar').fullCalendar( 'renderEvent', myevent, true);


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
 <!-- <?php //include_once('navbar.php');?>-->

  <div class="container">

    <div id="calendar" class="left">
    </div>
    <button id="ok" type="button" class="btn btn-warning btn-circle" data-toggle="modal" data-target="#myModal" style="margin-top: 70px;"><i class="glyphicon glyphicon-plus"></i>Δημιουργία</button>


<div id="fullCalModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
                <h4 id="modalTitle" class="modal-title"></h4>
            </div>
            <div id="modalBody" class="modal-body"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button class="btn btn-primary"><a id="eventUrl" target="_blank">Event Page</a></button>
            </div>
        </div>
    </div>
</div>




    <!-- Modal -->
    <div class="modal fade" id="myModal2" role="dialog">
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
