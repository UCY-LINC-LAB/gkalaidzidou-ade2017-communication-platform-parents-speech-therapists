<?php
include 'core/init.php';
session_start(); 

if ( $_SESSION['logged_in'] != true){
  header('Location: login.php');
}

$patient_id=$_SESSION["patient_id"];
$therapist_id=$_SESSION["therapist_id"];
?>
<!DOCTYPE html>
<html>

<head>
  <title>logoucon | ασκήσεις</title>
  <link rel="icon" type="image/png" href="img/logo.png">
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <script src="https://code.jquery.com/jquery-3.1.1.js" integrity="sha256-16cdPddA6VdVInumRGo6IbivbERE8p7CQR3HzTBuELA=" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
</head>

  <body>
  <?php include_once('pnavbar.php');?>
  <div class="container">
    <div table-responsive">
     <table class="table table-list-search table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Τίτλος Άσκησης</th>
                <th>Ημερομηνία Καταχώρησης</th>
                <th>Οδηγίες</th>
                <th>Αριθμός Επαναλήψεων</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>

          <?php  
          $ex_list = mysqli_query($conn,"SELECT * FROM patient_exercises WHERE patient_id='".$patient_id."'");
          $count=0;

          while($list = mysqli_fetch_assoc($ex_list)) {
            $count++;
            $ex_details = mysqli_query($conn,"SELECT  distinct * FROM exercise where exercise_id='".$list['exercise_id']."'");

            if (!$ex_details) { // add this check.
              die('Invalid query: ' . mysql_error());
            }else{
              $details = mysqli_fetch_array($ex_details);
            }
        ?>
      <tr>
        <td><?php echo $count?></td>
        <td><a href="#" class="pop" style="color:black;"><u><?php echo $details['ex_name']?></u>
           <div hidden="">  <img src="<?php echo $list['exercise_path']?>"  class="img-responsive"></div>
        </a></td>
        <td><?php echo $list['listing_date']?></td>
        <td><?php echo $list['guide']?></td>
        <td><?php echo $list['repetition']?></td>
        <td><button type="button" class="btn btn-xs btn-default left-block" style="" data-toggle="modal" data-target="#addcomment"  data-com="<?php echo $list['parent_comment']; ?>"
          data-ex="<?php echo $list['exercise_id']; ?>"><i class="fa fa-comment" aria-hidden="true"></i> Προσθήκη σχολίου</button></td>

        <td><i class="fa fa-download" aria-hidden="true"></i> <a href="<?php echo $list['exercise_path']?>" download="<?php echo $details['ex_name'].".png"?>"> Λήψη</a></td>
      </tr>
      <?php } ?>

        </tbody>
    </table>   
  </div>
  </div>
  </body>
  </html>


    <!-- Modal for add comment -->
  <div class="modal fade" id="addcomment" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content" tabindex="-1">
       <form role="form"  action="core/parent_comment.php" method="POST" class="form-horizontal">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h5 class="modal-title"><b>Προσθήκη σχολιου</b></h5>
        </div>
        <div class="modal-body">
          <div class="row" style="margin-bottom: 10px;">
              <label  class="col-sm-4"  style="margin-bottom: 10px;" for="title">Σχόλιο </label>
              <div class="col-sm-8">
              <textarea class="form-control" rows="5" id="patient_com" placeholder="Γράψε κάτι.." name="patient_com" ></textarea>
              <input type="text" value="" name="ex_id" id="ex_id" hidden="">
              </div>
          </div>
        </div>
        <div class="modal-footer">
          <div>
              <input type="submit" class="btn btn-success btn-sm" value="Προσθήκη">
          </div>
        </div>
        </form>
      </div>
      
    </div>
  </div>


<!--modal for open exercise as image-->
<div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" data-dismiss="modal">
    <div class="modal-content"  >              
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <img src="" class="imagepreview" style="width: 100%;" >
      </div> 
      <div class="modal-footer">
          <div class="col-xs-12">
               <p class="text-left"></p>
          </div>
      </div>   
    </div>
  </div>
</div>

  <script type="text/javascript">
  $('#addcomment').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var modal = $(this)

    modal.find('.modal-body #patient_com').val(button.data('com'))
    modal.find('.modal-body #ex_id').val(button.data('ex'))
  })
</script>

<script type="text/javascript">
$(function() {
    $('.pop').on('click', function() {
      $('.imagepreview').attr('src', $(this).find('img').attr('src'));
      $('#imagemodal').modal('show');   
    });   
});
</script>