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
  <title>logoucon | members</title>
  <link rel="icon" type="image/png" href="img/logo.png">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <script src="https://code.jquery.com/jquery-3.1.1.js" integrity="sha256-16cdPddA6VdVInumRGo6IbivbERE8p7CQR3HzTBuELA=" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

  <!--search inside table-->
  <script type="text/javascript">
    $(document).ready(function() {
      var activeSystemClass = $('.list-group-item.active');

      //something is entered in search form
      $('#system-search').keyup( function() {
         var that = this;
          // affect all table rows on in systems table
          var tableBody = $('.table-list-search tbody');
          var tableRowsClass = $('.table-list-search tbody tr');
          $('.search-sf').remove();
          tableRowsClass.each( function(i, val) {
          
              //Lower text for case insensitive
              var rowText = $(val).text().toLowerCase();
              var inputText = $(that).val().toLowerCase();
              if(inputText != '')
              {
                  $('.search-query-sf').remove();
                  tableBody.prepend('<tr class="search-query-sf"><td colspan="6"><strong>Searching for: "'
                      + $(that).val()
                      + '"</strong></td></tr>');
              }
              else
              {
                  $('.search-query-sf').remove();
              }

              if( rowText.indexOf( inputText ) == -1 )
              {
                  //hide rows
                  tableRowsClass.eq(i).hide();
                  
              }
              else
              {
                  $('.search-sf').remove();
                  tableRowsClass.eq(i).show();
              }
          });
          //all tr elements are hidden
          if(tableRowsClass.children(':visible').length == 0)
          {
              tableBody.append('<tr class="search-sf"><td class="text-muted" colspan="6">No entries found.</td></tr>');
          }
      });
  });
  </script>

  <style type="text/css">
      
  @media (max-width: 768px) {
    .btn-responsive {
      padding:2px 4px;
      font-size:80%;
      line-height: 1;
      border-radius:3px;
    }
  }

  @media (min-width: 769px) and (max-width: 992px) {
    .btn-responsive {
      padding:4px 9px;
      font-size:90%;
      line-height: 1.2;
    }
  }

  td{
      height: 70px;
      vertical-align: middle;   }


  .btn-clr1{
      background-color: #098680;
      color:white;
  }

  body{
    /*background-image: url("img/ww.jpg");'*/
    background-repeat:no-repeat;
    background-size:100% 100vh;
  }

  /*pagination*/
  .pagination>li>a, 
  .pagination>li>span { 
    border-radius: 50% !important;
    margin: 0 5px;
    color: black;}
  </style>
</head>

<body>
  <?php include_once('navbar.php');?>

<div class="container">
    <div class="row" style="margin-bottom: 50px; margin-top: 30px;" >
        <div class="col-md-6">
            <form action="#" method="get">
                <div class="input-group">
                    <!-- USE TWITTER TYPEAHEAD JSON WITH API TO SEARCH -->
                    <input class="form-control" id="system-search" name="q" placeholder="Αναζήτηση" required>
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
                    </span>
                </div>
            </form>
        </div>
        <div class="col-md-2">
          <button type="button" class="btn btn-default btn-responsive" data-toggle="modal" data-target="#add" style=""><span class="glyphicon glyphicon-plus"></span> Προσθήκη</button>
        </div>  
    </div>

    <div class="row">    
      <div class="col-md-12 table-responsive">
       <table class="table table-list-search table-hover">
          <thead>
              <tr>
                  <th></th>
                  <th>Εγγεγραμμένος</th>
                  <th>Τηλέφωνο</th>
                  <th>Όνομα Κηδεμόνα</th>
                  <th>Email</th>
                  <th>Ημερομηνία Εγγραφής</th>
                  <th>Αριθμός Επισκέψεων</th>
                  <th></th>
                  <th></th>
                  <th></th>
              </tr>
          </thead>
            <tbody>
              <?php 
              $patient_list = mysqli_query($conn,"SELECT  distinct * FROM patient patList where patList.therapist_id='".$therapist_id."' ");

              if (!$patient_list) { // add this check.
                die('Invalid query: ' . mysql_error());
              }

              while ($list = mysqli_fetch_array($patient_list)) { 

                  $conn_req = mysqli_query($conn,"SELECT  distinct * FROM connection_state conn where conn.therapist_id='".$therapist_id."' and 
                  conn.patient_id='".$list['patient_id']."'");


                  if (!$conn_req) { // add this check.
                    die('Invalid query: ' . mysql_error());
                  }else{
                    $conn_det = mysqli_fetch_array($conn_req);
                  }
                ?>
              <tr>
                <td><img style='height: 20px; width: 20px;' class="img-circle" src="img/profile.jpg"></td>
                <td><?php echo $list['first_name']." ".$list['last_name']?></td>
                <td><?php echo $list['telephone']?></td>
                <td><?php echo $list['parent_fname']." ".$list['parent_lname']?></td>
                <td><?php echo $list['email']?></td>
                <td><?php echo $list['registration_date']?></td>
                <td>12</td>

                <td><p data-placement="top" data-toggle="tooltip" title="Edit">
                <button class="btn btn-clr1 btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" 
                  data-id="<?php echo $list['patient_id']; ?>" 
                  data-fpn="<?php echo $list['first_name']; ?>" 
                  data-lpn="<?php echo $list['last_name']; ?>"
                  data-fkn="<?php echo $list['parent_fname']; ?>"
                  data-lkn="<?php echo $list['parent_lname']; ?>"
                  data-email="<?php echo $list['email']; ?>"
                  data-telephone="<?php echo $list['telephone']; ?>"><span class="glyphicon glyphicon-pencil"></span></button></p></td>

                <td><p data-placement="top" data-toggle="tooltip" title="Delete">
                <button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete"
                  data-id="<?php echo $list['patient_id']; ?>" 
                  data-fpn="<?php echo $list['first_name']; ?>" 
                  data-lpn="<?php echo $list['last_name']; ?>"><span class="glyphicon glyphicon-trash"></span></button></p></td>
                <td>


                  <?php 
                    
                  if($conn_det['request_state']==0){ ?>

                  <!--<a id="invite" onclick="invited()">Προσκάλεσε</a>
                  <p hidden id="invited" style="color:grey;">  <span class="glyphicon glyphicon-ok"> </span> Προσκλήθηκε</p>-->
                  <form id="myForm" action="core/connect_request.php" method="post">
                    <input type="hidden" name="conn_email" value="<?php echo $list['email']; ?>" />
                    <input type="hidden" name="patID" value="<?php echo $list['patient_id']; ?>" />
                    <a href="#" onclick="document.getElementById('myForm').submit();">Προσκάλεσε</a>
                  </form>
                  <?php }else if($conn_det['connection_state']==1){?>
                    <p style="color:green;"><span class="glyphicon glyphicon-ok"></span> Συνδεδεμένοι</p>
                  <?php }else{?> 
                     <p style="font-size: 13px; color:grey;"><span class="glyphicon glyphicon-ok"></span> Προσκλήθηκε,<br>
                      <?php echo date('j',strtotime($conn_det['request_date'])) . ' ' .$greekMonths[intval(date('m',strtotime($conn_det['request_date'])))-1]?></p>         
                  <?php }?>
                </td>
              </tr>
              <?php } ?>
            </tbody>     
      </table>  
  <script src="//raw.github.com/botmonster/jquery-bootpag/master/lib/jquery.bootpag.min.js"></script>
      <!--Pagination-->
      <div class="col-md-4">
        <ul class="pagination">
          <li class="disabled"><a href="#">«</a></li>
          <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
          <li><a href="#">2</a></li>
          <li><a href="#">3</a></li>
          <li><a href="#">4</a></li>
          <li><a href="#">5</a></li>
          <li><a href="#">»</a></li>
        </ul>
      </div>

<script type="text/javascript" src="http://botmonster.com/jquery-bootpag/jquery.bootpag.js"></script>

    <script>
$('#show_paginator').bootpag({
      total: 23,
      page: 3,
      maxVisible: 10
}).on('page', function(event, num)
{
     $("#dynamic_content").html("Page " + num); // or some ajax content loading...
});
    </script>
<div id="dynamic_content">Pagination goes here</div>
<div id="show_paginator"></div>
    
    </div>
   </div>
</div>
</body>
</html>


<script>
function invited() {
    document.getElementById("invite").style.display='none'
    document.getElementById("invited").style.display='block';
}
</script>

<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="add" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove "  style="font-size: 0.6em;" aria-hidden="true"></span></button>
        <h4 class="modal-title custom_align" id="Heading">Προσθήκη νέου ατόμου</h4>
      </div>
      <div class="modal-body">
        <form role="form"  action="core/add_patient.php" method="POST" class="form-horizontal">
            <div class="row">
                <label  class="col-sm-4"  style="margin-bottom: 10px;  text-align: right;" for="Fname">Όνομα Ασθενή</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" style="margin-bottom: 10px;"
                    id="Fname" placeholder="" name="fpname" required/> 
                </div>
            </div>
            <div class="row">
              <label  class="col-sm-4"  style="margin-bottom: 10px;  text-align: right;" for="lname">Επίθετο Ασθενή</label>
              <div class="col-sm-6">
                  <input type="text" class="form-control" style="margin-bottom: 10px;"
                  id="Fname" placeholder="" name="lpname" required/> 
              </div>
            </div>
            <div class="row">
              <label class="col-sm-4" style="margin-bottom: 10px; text-align: right;" for="LName">Όνομα Κειδεμόνα</label>
              <div class="col-sm-6"> 
                  <input type="text"  style="margin-bottom: 10px;" class="form-control"
                  id="Lname" placeholder="" name="fkname" required/>  
              </div>
            </div>
            <div class="row">
                <label class="col-sm-4" style="margin-bottom: 10px; text-align: right;" for="LName">Επίθετο Κειδεμόνα</label>
                <div class="col-sm-6"> 
                    <input type="text"  style="margin-bottom: 10px;" class="form-control"
                    id="Lname" placeholder="" name="lkname" required/>  
                </div>
            </div>
            <div class="row">
                <label class="col-sm-4" style="margin-bottom: 10px;  text-align: right;" for="LName">Τηλέφωνο</label>
                <div class="col-sm-6"> 
                    <input type="text"  style="margin-bottom: 10px; " class="form-control"
                    id="Lname" placeholder="" name="telephone" required/>  
                </div>
            </div>
            <div class="row">
                <label class="col-sm-4" style="margin-bottom: 10px; text-align: right;" for="LName">Email</label>
                <div class="col-sm-6"> 
                    <input type="text"  style="margin-bottom: 10px;" class="form-control"
                    id="Lname" placeholder="" name="email" required/>  
                </div>
            </div>
            <div class="row"> 
              <div class="col-sm-10" style="text-align: right;"> 
                <!--<button type="button" class="btn btn-warning btn-s">Προσθήκη</button>-->
                <input class="btn btn-warning btn-s"  type="submit" value='Προσθήκη'>
              </div>
            </div>
         </form>   
      </div>
    </div><!-- /.modal-content --> 
  </div><!-- /.modal-dialog --> 
</div><!-- /.modal- --> 

<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove "  style="font-size: 0.6em;" aria-hidden="true"></span></button>
        <h4 class="modal-title custom_align" id="Heading">Τροποποίηση στοιχείων ατόμου</h4>
      </div>
      <div class="modal-body">
        <div id="modal-loader" style="display: none; text-align: center;"></div>
        <div id="dynamic-content">
        <form role="form"  action="core/update_patient.php" method="POST" class="form-horizontal">
            <div class="row">
                <label  class="col-sm-4"  style="margin-bottom: 10px;  text-align: right;" for="Fname">Όνομα Ασθενή</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" style="margin-bottom: 10px;"
                    id="fpname" placeholder="" name="fpname" required/> 
                </div>
            </div>
            <div class="row">
              <label  class="col-sm-4"  style="margin-bottom: 10px;  text-align: right;" for="lname">Επίθετο Ασθενή</label>
              <div class="col-sm-6">
                  <input type="text" class="form-control" style="margin-bottom: 10px;"
                  id="lpname" placeholder="" name="lpname" required/> 
              </div>
            </div>
            <div class="row">
              <label class="col-sm-4" style="margin-bottom: 10px; text-align: right;" for="LName">Όνομα Κειδεμόνα</label>
              <div class="col-sm-6"> 
                  <input type="text"  style="margin-bottom: 10px;" class="form-control"
                  id="fkname" placeholder="" name="fkname" required/>  
              </div>
            </div>
            <div class="row">
                <label class="col-sm-4" style="margin-bottom: 10px; text-align: right;" for="LName">Επίθετο Κειδεμόνα</label>
                <div class="col-sm-6"> 
                    <input type="text"  style="margin-bottom: 10px;" class="form-control"
                    id="lkname" placeholder="" name="lkname" required/>  
                </div>
            </div>
            <div class="row">
                <label class="col-sm-4" style="margin-bottom: 10px;  text-align: right;" for="LName">Τηλέφωνο</label>
                <div class="col-sm-6"> 
                    <input type="text"  style="margin-bottom: 10px; " class="form-control"
                    id="telephone" placeholder="" name="telephone" required/>  
                </div>
            </div>
            <div class="row">
                <label class="col-sm-4" style="margin-bottom: 10px; text-align: right;" for="LName">Email</label>
                <div class="col-sm-6"> 
                    <input type="text"  style="margin-bottom: 10px;" class="form-control"
                    id="email" placeholder="" name="email" required/>  
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
 
<!--Modal for delete patient-->
<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        <h4 class="modal-title custom_align" id="Heading">Διαγραφή εγγραφής</h4>
      </div>
      <form role="form"  action="core/delete_patient.php" method="POST" class="form-horizontal">
      <div class="modal-body">
       <div class="alert alert-danger" ><span class="glyphicon glyphicon-warning-sign"></span> Είστε σίγουροι για ην διαγραφή του/της <label id="name"></label></div>
       <input type="hidden" name="id" id="pid"  value="">
      </div>
      <div class="modal-footer ">
        <input class="btn btn-success"  type="submit" value='Ναι'>
        <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>Όχι</button>
      </div>
      </form>
    </div><!-- /.modal-content --> 
  </div><!-- /.modal-dialog --> 
</div>

<!--Script for dynamic data for bootstrap modal edit, delete patient -->
<script type="text/javascript">
  $('#edit').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var modal = $(this)

    modal.find('.modal-body #fpname').val(button.data('fpn'))
    modal.find('.modal-body #lpname').val(button.data('lpn'))
    modal.find('.modal-body #fkname').val(button.data('fkn'))
    modal.find('.modal-body #lkname').val(button.data('lkn'))
    modal.find('.modal-body #email').val(button.data('email'))
    modal.find('.modal-body #telephone').val(button.data('telephone'))
    modal.find('.modal-body #pid').val(button.data('id'))
  })

   $('#delete').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var modal = $(this)

    modal.find('.modal-body #pid').val(button.data('id'))
    modal.find('.modal-body #name').text(button.data('fpn') + " " +button.data('lpn'))
  })

</script>