<?php
include 'core/init.php';
session_start(); 

if ( $_SESSION['logged_in'] != true){
  header('Location: login.php');
}

if(!isset($_GET['page']))
  $_GET['page']=1;

$therapist_id=$_SESSION["therapist_id"];
$greekMonths = array('Ιανουαρίου','Φεβρουαρίου','Μαρτίου','Απριλίου','Μαΐου','Ιουνίου','Ιουλίου','Αυγούστου','Σεπτεμβρίου','Οκτωβρίου','Νοεμβρίου','Δεκεμβρίου');  

// Requested page
$requested_page = isset($_GET['page']) ? intval($_GET['page']) : 1;

$col_name=$_POST['col_name'];
$date=$_POST['date'];
$date2=$_POST['date2'];
$num_from=$_POST['num_from'];
$num_to=$_POST['num_to'];
$col_state=$_POST['col_state'];

$str="SELECT COUNT(*) FROM patient as p WHERE p.therapist_id='".$therapist_id."'";
$str_final="SELECT * FROM patient WHERE therapist_id='".$therapist_id."'";

if($date!= null && $date2!= null ){
  $str=$str." and registration_date between '$date' and '$date2' ";
  $str_final=$str_final." and registration_date between '$date' and '$date2' ";
}else if($date!= null){
  $str=$str." and registration_date between '$date' and CURRENT_DATE";
  $str_final=$str_final." and registration_date between '$date' and CURRENT_DATE";
}else if($date2!= null){
  $str=$str." and registration_date between '2010/01/01' and '$date2'";
  $str_final=$str_final." and registration_date between '$date' and CURRENT_DATE";
}

//if($num_from!=null && $num_to!=null){
  //$str=$str." and registration_date between '$date' and '$date2' ";  
//}

if($col_name!=null){
  $str_final=$str_final." ORDER BY '$col_name' DESC";
}
//echo $str;
$r = mysqli_query($conn,$str);

$list = mysqli_fetch_row($r);
$product_count = $list[0];

//echo $list[0];

$products_per_page = 2;

$page_count = ceil($product_count / $products_per_page);

// You can check if $requested_page is > to $page_count OR < 1,
// and redirect to the page one.
$first_product_shown = ($requested_page - 1) * $products_per_page;

$str_final=$str_final." LIMIT $first_product_shown, $products_per_page";
//echo "=> ".$str_final;
$r = mysqli_query($conn,$str_final);
?>

<!DOCTYPE html>
<html>

<head>
  <title>logoucon | εγγεγραμμένοι</title>
  <link rel="icon" type="image/png" href="img/logo.png">
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <script src="https://code.jquery.com/jquery-3.1.1.js" integrity="sha256-16cdPddA6VdVInumRGo6IbivbERE8p7CQR3HzTBuELA=" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

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

    $(document).ready(function(){
      var date_input=$('input[name="date2"]'); //our date input has the name "date"
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
                  tableBody.prepend('<tr class="search-query-sf"><td colspan="6"><strong>Αναζήτηση: "'
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
              tableBody.append('<tr class="search-sf"><td class="text-muted" colspan="6">Δεν βρέθηκαν αποτελέσματα.</td></tr>');
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
    <div class="row" style="margin-top: 30px;" >
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

    <div class="row" style="margin-bottom: 10px; margin-top: 10px;">        
      <div class="col-sm-2">
        <button type="button" class="btn btn-xs" style="background-color: transparent;" onclick="advanceSearch();">
        <b style="color:#930000;"> Σύνθετη Αναζήτηση</b></button>   
      </div>
    </div>

    <div id="advanceDiv" hidden="">
      <form style="margin-top: 15px; margin-bottom: 30px;"  method="POST" action="members.php">
        <div  class="row" >
            <div class="col-xs-2"><label for="sel1" >ταξινόμηση</label></div>
            <div class="col-xs-4"><label for="sel1" >ημερομηνία εγγραφής</label></div>
            <div class="col-xs-2"><label for="sel1" >αριθμός επισκέψεων</label></div>
            <div class="col-xs-2"><label for="sel1" >κατάσταση σύνδεσης</label></div>
        </div>
        <div  class="row" >
            <div class="col-xs-2">         
              <select  class="form-control" name="col_name" >
                <option value=""></option>
                <option value="last_name">Εγγεγραμμένος</option>
                <option value="parent_lname">Όνομα Κηδεμόνα</option>
                <option value="email">Email</option>
                <option value="date">Ημερομηνία Εγγραφής</option>
                <option value="conf_num">Αριθμός Επισκέψεων</option>
              </select>
            </div>

            <div class="col-xs-2"> <input id="date" name="date" placeholder="MM/DD/YYYY"  type="text" class="form-control"> </div>
            <div class="col-xs-2"> <input id="date2" name="date2" placeholder="MM/DD/YYYY"  type="text" class="form-control"> </div>

            <div class="col-xs-1"> <input id="" name="num_from" placeholder="από"  type="text" class="form-control"> </div>
            <div class="col-xs-1"> <input id="" name="num_to" placeholder="μέχρι"  type="text" class="form-control"> </div>

            <div class="col-xs-2">
              <select  class="form-control" name="col_state" >
                <option value=""></option>
                <option value="connected">Συνδεδεμένοι</option>
                <option value="invitated">Προσκλήθηκε</option>
                <option value="not_invitated">Δεν προσκλήθηκε</option>
              </select>
            </div>
            <div class="col-xs-2">
              <input class="btn btn-warning btn-s"  type="submit" value='Αναζήτηση'>
            </div>
        </div>
      </form>
      <hr>
</div>

   <script type="text/javascript">
     function advanceSearch(){

      var div = document.getElementById('advanceDiv');

      if(div.style.display == 'block'){
        div.style.display = 'none';
      }else if(div.style.visibility == false){
        div.style.display = 'block';
      }
     }
   </script>


    <div class="row" style="margin-top: 35px;">    
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
                  <th><th></th>
              </tr>
          </thead>
            <tbody>
              <?php 
              while($list = mysqli_fetch_assoc($r)) {

                  $conn_req = mysqli_query($conn,"SELECT  distinct * FROM connection_state conn where conn.therapist_id='".$therapist_id."' and 
                  conn.patient_id='".$list['patient_id']."'");

                  if (!$conn_req) { // add this check.
                    die('Invalid query: ' . mysql_error());
                  }else{
                    $conn_det = mysqli_fetch_array($conn_req);
                  }

                  $total_conferences = mysqli_query($conn,"SELECT COUNT(conference_id) as total_conf FROM conference where therapist_id='".$therapist_id."' and 
                  patient_id='".$list['patient_id']."' and  DATE(conference_date) < CURRENT_DATE ");

                  if (!$total_conferences) { // add this check.
                    die('Invalid query: ' . mysql_error());
                  }else{
                    $completed_conferences = mysqli_fetch_array($total_conferences);
                  }
                ?>
              <tr>
                <td><img style='height: 20px; width: 20px;' class="img-circle" src="<?php echo $list['profile']?>"></td>
                <td><?php echo $list['first_name']." ".$list['last_name']?></td>
                <td><?php echo $list['telephone']?></td>
                <td><?php echo $list['parent_fname']." ".$list['parent_lname']?></td>
                <td><?php echo $list['email']?></td>
                <td><?php echo $list['registration_date']?></td>
                <td><?php echo $completed_conferences['total_conf']?></td>


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

                  <form id="myForm" action="core/connect_request.php" method="post">
                    <input type="hidden" name="conn_email" value="<?php echo $list['email']; ?>" />
                    <input type="hidden" name="patID" value="<?php echo $list['patient_id']; ?>" />
                    <a style="font-size: 12px;" href="#" onclick="document.getElementById('myForm').submit();">
                     <span class="glyphicon glyphicon-share-alt"></span>Προσκάλεσε</span></a>
                  </form>
                   
                  <?php }else if($conn_det['connection_state']==1){?>
                    <p style="color:green;font-size: 12px; "><span class="glyphicon glyphicon-ok"></span>  Συνδεδεμένοι</p>
                  <?php }else{?> 
                     <p style="font-size: 12px; color:grey;"> Προσκλήθηκε,<br>
                      <?php echo date('j',strtotime($conn_det['request_date'])) . ' ' .$greekMonths[intval(date('m',strtotime($conn_det['request_date'])))-1]?>
                      <span class="glyphicon glyphicon-time"></span></p>

                <td><form id="myForm2" action="core/resend_connect_request.php" method="post">
                  <input type="hidden" name="conn_email" value="<?php echo $list['email']; ?>" />
                  <input type="hidden" name="patID" value="<?php echo $list['patient_id']; ?>" />
                  <a href="#" onclick="document.getElementById('myForm2').submit();"><span class="glyphicon glyphicon-repeat"></span></a>
                </form></td>
                  <?php }?>
                </td>
              </tr>
              <?php } ?>
            </tbody>     
      </table>  
 
      <div class="col-md-4" >
      <ul id="paginate" class="pagination" >
       
         <?php // Ok, we write the page links  
            if ($_GET['page'] <=1 ) {
              echo '<li class="disabled"><a href="#">«</a></li>';
            }else if ($_GET['page'] >1){
              $n=$_GET['page']-1;
              echo '<li><a href="members.php?page='.$n. '">«</a></li>';
            }


          for($i=1; $i<=$page_count; $i++) {
              if($i == $requested_page) {
                  echo '<li class="active"><a href="#">'.$i.' <span class="sr-only">(current)</span></a></li>';
              } else {
                  echo '<li><a href="members.php?page='.$i.'">'.$i.'</a></li> ';
              }
          }
          if ($_GET['page'] < $page_count) {
            $n=$_GET['page']+1;
            echo '<li><a href="members.php?page='.$n. '">»</a></li>';
          }else{
            echo '<li class="disabled"><a href="#">»</a></li>';
          }
          ?>
        </ul>
      </div>

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

      <script type="text/javascript">
      alert("hello");
        $("#paginate li").click(function(){
          

    var pageNum = <?php echo $currentPage; ?>;

    if ( this.id == "prev" )
         pageNum = Math.max(1, pageNum--);
    else if ( this.id == "next" )
         pageNum = Math.min(<?php echo $pages ?>, pageNum++);
    else 
         pageNum = this.id;

    $("#content").load("parent.php?page=" + pageNum, Hide_Load());

});
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
        <button type="button" class="btn btn-danger" data-dismiss="modal">Όχι</button>
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