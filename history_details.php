<?php
include 'core/init.php';
session_start(); 

if ( $_SESSION['logged_in'] != true){
  header('Location: login.php');
}

$therapist_id=$_SESSION["therapist_id"];  

//   convert date language to greek                 
date_default_timezone_set('Europe/Athens');

setlocale(LC_TIME, 'el_GR.UTF-8');

$greekDays = array( "Κυριακή", "Δευτέρα", "Τρίτη", "Τετάρτη", "Πέμπτη", "Παρασκευή", "Σάββατο" ); 
$greekMonths = array('Ιανουαρίου','Φεβρουαρίου','Μαρτίου','Απριλίου','Μαΐου','Ιουνίου','Ιουλίου','Αυγούστου','Σεπτεμβρίου','Οκτωβρίου','Νοεμβρίου','Δεκεμβρίου');  

if(isset($_POST['patient'])){
  $patient_id=$_POST['patient'];
}else{
  $patient_id='';
}
  $patient_info = mysqli_query($conn,"SELECT  distinct * FROM patient patList where patList.therapist_id='".$therapist_id."' and 
    patList.patient_id='".$patient_id."'");

  if (!$patient_info) { // add this check.
      die('Invalid query: ' . mysql_error());
  }
  $info = mysqli_fetch_array($patient_info);
  $patientName=$info['first_name'].' '.$info['last_name'];

?>
<!DOCTYPE html>
<html>
<head>
  <title>logoucon | ιστορικά</title>
  <link rel="icon" type="image/png" href="img/logo.png">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <script src="https://code.jquery.com/jquery-3.1.1.js" integrity="sha256-16cdPddA6VdVInumRGo6IbivbERE8p7CQR3HzTBuELA=" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">

  <!--text editor-->
  <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
  <script type="text/javascript">

      tinymce.init({
      selector: 'textarea',
      height: 20,
      menubar: false,
      plugins: [
        'advlist autolink lists link image charmap print preview anchor',
        'searchreplace visualblocks code fullscreen',
        'insertdatetime media table contextmenu paste code'
      ],
      toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
      content_css: '//www.tinymce.com/css/codepen.min.css'
    });
  </script>


  <!--Search and select option in modal-->
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
  <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
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

  .btn-clr2{
      background-color: #E2CB35;
      color:white;
  }
  td{
      height: 70px;
      vertical-align: middle;   }

  /*sidebar style*/    
  .blogShort{ border-bottom:1px solid #ddd;}
  .nav-sidebar { 
      width: 100%;
      padding: 30px 0; 
      border-right: 1px solid #ddd;

  }
  .nav-sidebar a {
      color: #333;
      border-bottom: 1px solid #ddd;
      -webkit-transition: all 0.08s linear;
      -moz-transition: all 0.08s linear;
      -o-transition: all 0.08s linear;
      transition: all 0.08s linear;
  }
  .nav-sidebar .active a { 
      cursor: default;
      background-color: #098680; 
      color: #fff; 

  }
  .nav-sidebar .active a:hover {
      background-color: #098680;   
  }
  .nav-sidebar .text-overflow a,
  .nav-sidebar .text-overflow .media-body {
      white-space: nowrap;
      overflow: hidden;
      -o-text-overflow: ellipsis;
      text-overflow: ellipsis; 
  }
  </style>

  <style type="text/css">
    #placeholder { width: 600px; height: 300px; position: relative; margin: 0 auto; }
    .legend table, .legend > div { height: 82px !important; opacity: 1 !important; right: -200px; top: 10px; width: 116px !important; }
    .legend table { padding: 5px; }
    #flot-tooltip { font-size: 12px; font-family: Verdana, Arial, sans-serif; position: absolute; display: none; background-color: #FFF; opacity: 0.8; -moz-border-radius: 5px; -webkit-border-radius: 5px; -khtml-border-radius: 5px; border-radius: 5px; }
  </style>
   
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/flot/0.8.2/jquery.flot.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/flot/0.8.2/jquery.flot.symbol.min.js"></script>
<script type="text/javascript" src="http://raw.github.com/markrcote/flot-axislabels/master/jquery.flot.axislabels.js"></script>
<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/flot/0.8.2/jquery.flot.time.min.js"></script>
 
<script type="text/javascript">
<?php 
   $score = mysqli_query($conn,"SELECT  distinct * FROM  conference_score_bar as cs, conference as c
    where c.therapist_id='".$therapist_id."' and c.conference_id=cs.conference_id and c.patient_id='".$patient_id."' ");

  if (!$score) { // add this check.
      die('Invalid query: ' . mysql_error());
  } ?>


//Rome, Italy
//var d1 = [[1262304000000, 5], [1264982400000, 13], [1267401600000, 15], [1270080000000, 18], [1272672000000, 23], [1275350400000, 27], [1277942400000, 30], [1280620800000, 30], [1283299200000, 27], [1285891200000, 22]];
// Paris, France
//var d2 = [[1262304000000, 3], [1264982400000, 7], [1267401600000, 12], [1270080000000, 16], [1272672000000, 20], [1275350400000, 23], [1277942400000, 25], [1280620800000, 24], [1283299200000, 21], [1285891200000, 16]];
// Madrid, Spain
//var d3 = [[1262304000000, 2], [1264982400000, 13], [1267401600000, 16], [1270080000000, 18], [1272672000000, 22], [1275350400000, 28], [1277942400000, 33], [1280620800000, 32], [1283299200000, 28], [1285891200000, 21]];

var d3 = [
 <?php $count=0;
   $ax = array("1262304000000", "1264982400000", "1267401600000","1270080000000","1272672000000","1275350400000","1277942400000","1280620800000","1283299200000",
  "1285891200000"); 

 while ($score_list = mysqli_fetch_array($score)) { 
    if($score_list['title']=='Prosoxh'){
      if($count!=0)
        echo (',');
      echo  ('['.$ax[$count].','.$score_list['score'].']');
      $count++;
    }
 }
 mysqli_data_seek($score, 0 );
 ?>];


var d2 = [
<?php $count=0;
   $ax = array("1262304000000", "1264982400000", "1267401600000","1270080000000","1272672000000","1275350400000","1277942400000","1280620800000","1283299200000",
  "1285891200000"); 
 while ($score_list = mysqli_fetch_array($score)) { 
    if($score_list['title']=='Apodosh'){
      if($count!=0)
        echo (',');
      echo  ('['.$ax[$count].', '.$score_list['score'].']');
      $count++;
    }
 }
 mysqli_data_seek($score, 0 );?>
];


var d1 = [
<?php $count=0;
   $ax = array("1262304000000", "1264982400000", "1267401600000","1270080000000","1272672000000","1275350400000","1277942400000","1280620800000","1283299200000",
  "1285891200000"); 
 while ($score_list = mysqli_fetch_array($score)) { 
    if($score_list['title']=='Simperifora'){
      if($count!=0)
        echo (',');
      echo  ('['.$ax[$count].', '.$score_list['score'].']');
      $count++;
    }
 }
?>
];

var data1 = [
    {label: "Συμπεριφορά",  data: d1, points: { symbol: "circle", fillColor: "#058DC7" }, color: '#058DC7'},
    {label: "Απόδοση στόχου",  data: d2, points: { symbol: "diamond", fillColor: "#AA4643" }, color: '#AA4643'},
    {label: "Προσοχή",  data: d3, points: { symbol: "square", fillColor: "#50B432" }, color: '#50B432'}
];
 
$(document).ready(function () {
    $.plot($("#placeholder"), data1, {
        xaxis: {
            min: (new Date(2009, 11, 18)).getTime(),
            max: (new Date(2010, 11, 15)).getTime(),
            mode: "time",
            tickSize: [1, "month"],
            monthNames: ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10","11","12"],
            tickLength: 0,
            axisLabel: 'Month',
            axisLabelUseCanvas: true,
            axisLabelFontSizePixels: 10,
            axisLabelFontFamily: 'Verdana, Arial, Helvetica, Tahoma, sans-serif',
            axisLabelPadding: 5
        },
        yaxis: {
            axisLabel: 'Temperature (C)',
            axisLabelUseCanvas: true,
            axisLabelFontSizePixels: 12,
            axisLabelFontFamily: 'Verdana, Arial, Helvetica, Tahoma, sans-serif',
            axisLabelPadding: 2,
            ticks: [[1,' 1'], [2,'2'], [3,'3'], [4,'4'], [5,'5']]
        },
        series: {
            lines: { show: true },
            points: {
                radius: 3,
                show: true,
                fill: true
            },
        },
        grid: {
            hoverable: true,
            borderWidth:0
        },
        legend: {
            labelBoxBorderColor: "none",
                position: "right"
        }
    });
 
    function showTooltip(x, y, contents, z) {
        $('<div id="flot-tooltip">' + contents + '</div>').css({
            top: y - 30,
            left: x - 135,
            'border-color': z,
        }).appendTo("body").fadeIn(200);
    }
     
    function getMonthName(numericMonth) {
        var monthArray = ["12/09/2016", "12/09/2016", "12/09/2016", "12/09/2016", "12/09/2016", "12/09/2016", "12/09/2016", "12/09/2016", "12/09/2016", "12/09/2016"];
        var alphaMonth = monthArray[numericMonth];
         
        return alphaMonth;
    }
     
    function convertToDate(timestamp) {
        var newDate = new Date(timestamp);
        var dateString = newDate.getMonth();
        var monthName = getMonthName(dateString);
         
        return monthName;
    }
 
    var previousPoint = null;
     
    $("#placeholder").bind("plothover", function (event, pos, item) {
        if (item) {
            if ((previousPoint != item.dataIndex) || (previousLabel != item.series.label)) {
                previousPoint = item.dataIndex;
                previousLabel = item.series.label;
             
                $("#flot-tooltip").remove();
 
                var x = convertToDate(item.datapoint[0]),
                y = item.datapoint[1];
                z = item.series.color;
                     
                showTooltip(item.pageX, item.pageY,
                    "<b>" + item.series.label + "</b>:  " + y + " <b>/5</b><br>" + x,
                    z);
            }
        } else {
            $("#flot-tooltip").remove();
            previousPoint = null;            
        }
    });

    var xaxisLabel = $("<div class='axisLabel xaxisLabel'></div>")
  .text("Αριθμός Συνεδρίας")
  .appendTo($('#placeholder'));

var yaxisLabel = $("<div class='axisLabel yaxisLabel'></div>")
  .text("Βαθμολογία")
  .appendTo($('#placeholder'));


});
</script>

<style type="text/css">

.axisLabel {
    position: absolute;
    text-align: center;
    font-size: 12px;
    font-weight: bold;
}

.xaxisLabel {
    bottom: -30px;
    left: 0;
    right: 0;
}

.yaxisLabel {
    top: 67%;
    left: -40px;
    transform: rotate(-90deg);
    -o-transform: rotate(-90deg);
    -ms-transform: rotate(-90deg);
    -moz-transform: rotate(-90deg);
    -webkit-transform:  rotate(-90deg);
    transform-origin: 0 0;
    -o-transform-origin: 0 0;
    -ms-transform-origin: 0 0;
    -moz-transform-origin: 0 0;
    -webkit-transform-origin: 0 0;
}


.carousel-indicators-numbers {
    li {
      text-indent: 0;
      margin: 0 2px;
      width: 30px;
      height: 30px;
      border: none;
      border-radius: 100%;
      line-height: 30px;
      color: #fff;
      background-color: #999;
      transition: all 0.25s ease;
      &.active, &:hover {
        margin: 0 2px;
        width: 30px;
        height: 30px;
        background-color: #337ab7;        
      }
    }
}
/* carousel */
#quote-carousel 
{
  padding: 0 10px 30px 10px;
  margin-top: 30px;
}

/* Control buttons  */
#quote-carousel .carousel-control
{
  background: none;
  color: #222;
  font-size: 2.3em;
  text-shadow: none;
  margin-top: 30px;
}
/* Previous button  */
#quote-carousel .carousel-control.left 
{
  left: -50px;
}
/* Next button  */
#quote-carousel .carousel-control.right 
{
  right: -50px !important;
}
/* Changes the position of the indicators */
#quote-carousel .carousel-indicators 
{
  right: 50%;
  top: auto;
  bottom: 0px;
  margin-right: -19px;
}
/* Changes the color of the indicators */
#quote-carousel .carousel-indicators li 
{
  background: #c0c0c0;
}
#quote-carousel .carousel-indicators .active 
{
  background: #333333;
}
#quote-carousel img
{
  width: 250px;
  height: 100px
}
/* End carousel */

.item blockquote {
    border-left: none; 
    margin: 0;
}

.item blockquote img {
    margin-bottom: 10px;
}

.item blockquote p:before {
    content: "\f10d";
    font-family: 'Fontawesome';
    float: left;
    margin-right: 10px;
}
/**
  MEDIA QUERIES
*/

/* Small devices (tablets, 768px and up) */
@media (min-width: 768px) { 
    #quote-carousel 
    {
      margin-bottom: 0;
      padding: 0 40px 30px 40px;
    }
    
}

/* Small devices (tablets, up to 768px) */
@media (max-width: 768px) { 
    
    /* Make the indicators larger for easier clicking with fingers/thumb on mobile */
    
    #quote-carousel .carousel-indicators {
        bottom: -20px !important;  
    }
    #quote-carousel .carousel-indicators li {
        display: inline-block;
        margin: 0px 5px;
        width: 15px;
        height: 15px;
    }
    #quote-carousel .carousel-indicators li.active {
        margin: 0px 5px;
        width: 20px;
        height: 20px;
    }
}

.glyphicon {
    font-size: 15px;
}

div.polaroid {
  box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.2);
}


/*number inside circle*/
.numberCircle {
    border-radius: 50%;
    width: 20px; 
    font-size: 15px;
    border: 2px solid #666;
}
.numberCircle span {
    text-align: center;
    line-height: 20px;
    display: block;
}
</style>

</head>


<body>
  <?php include_once('navbar.php');?>

  <div class="container" style="margin-top: 40px;">
    <div class="row">
      <div class="col-sm-2">
        <form name="form1" method="POST" action="history_details.php">
        <select  onchange="this.form.submit()" name="patient" class="selectpicker" data-style="" data-width="100%" data-show-subtext="true" data-live-search="true" > 
        <option selected><?php echo $patientName ?></option>
        <?php 
         $patient_list = mysqli_query($conn,"SELECT  distinct * FROM patient patList where patList.therapist_id='".$therapist_id."' ");

        if (!$patient_list) { // add this check.
            die('Invalid query: ' . mysql_error());
        }
        while ($list = mysqli_fetch_array($patient_list)) { ?>
        
        <option data-subtext="<?php echo $list['parent_fname']." ".$list['parent_lname']?>" value="<?php echo $list['patient_id']?>"  >
        <?php echo $list['first_name']." ".$list['last_name']?></option>
        <?php } ?>
        </select>

        
        </form>
      <!-- <img style='height: 20px; width: 20px;' src="img/profile.jpg"><b>  Ηλίας Χρίστου</b>-->

        <nav class="nav-sidebar">
            <ul class="nav tabs"  id="myTab">
              <li class="active"><a href="#graph" data-toggle="tab">Γραφική Προόδου</a></li>
              <li class=""><a href="#history" data-toggle="tab">Ιστορικό</a></li>
              <li class=""><a href="#therapy" data-toggle="tab">Διάγνωση & Θεραπεία  </a></li>
              <li class=""><a href="#exercises" data-toggle="tab">Ασκήσεις Σπιτιού</a></li>                                
            </ul>
        </nav>
      </div>
      <div class="col-sm-10">
        <div class="tab-content">
          <div class="tab-pane active" id="graph" role="tabpanel">
            <div id="placeholder" style="margin-left: 100px"></div>
            <div class="container" style="margin-top: 20px;">
              <div class='col-md-10'>
                <div class="carousel slide " data-ride="carousel" id="quote-carousel" data-interval="false">
                  <!-- Bottom Carousel Indicators -->
                  <ol class="carousel-indicators carousel-indicators-numbers">
                    <li data-target="#quote-carousel" data-slide-to="0" class="active"></li>
                  <?php                       
                      $conference_details = mysqli_query($conn,"SELECT  distinct * FROM conference as c where c.therapist_id='".$therapist_id."' and c.patient_id='".$patient_id."' ORDER BY conference_date ASC");

                      if (!$conference_details) { // add this check.
                        die('Invalid query: ' . mysqli_error($conn));
                      }
                      $num_rows = mysqli_num_rows($conference_details);

                      for ($x = 1; $x < $num_rows; $x++) {
                      ?>
                      <li data-target="#quote-carousel" data-slide-to="<?php echo $x ?>"></li>
                    <?php }?>
                  </ol>
                  
                  <!-- Carousel Slides / Quotes -->
                  <div class="carousel-inner polaroid" >

                      <?php 
                      $confCount=0;
                      while ($list = mysqli_fetch_array($conference_details)) {
                              $confCount++;
                              $scores = mysqli_query($conn,"SELECT  distinct * FROM conference_score_bar as s where  s.conference_id='".$list['conference_id']."' ");
                              if (!$scores) { // add this check.
                                die('Invalid query: ' . mysqli_error($conn));
                              }
                      ?>
                   
                    <?php if( $confCount==1) echo ( '<div class="item active" >'); else echo ( '<div class="item" >'); ?>
                        <div class="row text-center"></div>
                        <div class="row" style="margin-bottom: 20px;margin-top: 20px;">
                          <div class="col-sm-3 text-center" style="margin-top: 20px;">
                              <h4> <?php echo $greekDays[date("w",strtotime($list['conference_date']))]?><br>
                              <?php echo date('j',strtotime($list['conference_date'])) . ' ' . $greekMonths[intval(date('m',strtotime($list['conference_date'])))-1] ?><br>
                              <?php echo date('Y',strtotime($list['conference_date']))?><br>
                                </h4>
                              <i><?php echo "Συνεδρία".$confCount."<sup>η</sup>";?></i>
                              
                          </div>
                          <div class="col-sm-9">
                            <p><span class="glyphicon glyphicon-pencil"></span><b> Στόχος: </b><?php echo $list['target_description'];?></p>
                            <hr>
                            <p><span class="glyphicon glyphicon-comment"></span><b> Σχόλια:</b> <?php echo $list['comment'];?></p>
                            <hr>
                            <p><span class="glyphicon glyphicon-thumbs-up"></span><b> Αξιολόγηση:</b> 

                            <?php $comma=0;
                            while ($sclist = mysqli_fetch_array($scores)) {

                              $comma++;

                             echo ($sclist['title']." (<b>".$sclist['score']."</b> /5) ");
                            if($comma<mysqli_num_rows($scores))
                              echo ("<b> , </b>");
                            }?>
                            </p>
                          </div>
                        </div>
                    </div>
                     <?php } ?>
                  </div>

                  <!-- Carousel Buttons Next/Prev -->
                  <a data-slide="prev" href="#quote-carousel" class="left carousel-control" style="color:#098680;"><i class="fa fa-chevron-left"></i></a>
                  <a data-slide="next" href="#quote-carousel" class="right carousel-control" style="color:#098680;"><i class="fa fa-chevron-right"></i></a>

                </div>                          
              </div>
            </div>
          </div><!--end of tab graph-->
              <?php 
              $text = mysqli_query($conn,"SELECT * FROM patient_statement state where state.therapist_id='".$therapist_id."' and state.patient_id='".$patient_id."'");

              if (!$text) { // add this check.
                die('Invalid query: ' . mysqli_error());
                  echo "<script>";
                  echo " alert('Something is going wrong. Please try again.');      
                        window.location.href='". $_SERVER['HTTP_REFERER']."'; </script>";
              }

              $list = mysqli_fetch_array($text);
              ?>
          <div class="tab-pane" id="history" role="tabpanel">
            <form action="core/history_save.php" method="post">
              <input name="patient_id" value="<?php echo $patient_id?>" type="text" hidden>
              <div class="row">
              <h4>Για δική μου χρήση</h4>
                <textarea cols="80" rows="10" id="content" name="contentTherapist"> <?php echo $list['history_ftherapist']?>
                </textarea>
                <div class="col-sm-12" style="">
                    <input class= "btn pull-right btn-success" type="submit" name="history_ftherapist" value="Αποθήκευση" style=" margin-top: 10px; margin-left: 10px;" />
                    <input class= "btn pull-right" type="button" onclick="window.print();" value="Εκτύπωση" style="background-color:#E2CB35; margin-top: 10px;" />
                </div>
              </div>

            <div class="row" style="margin-bottom: 10px;">
              <h4>Για τον γονέα</h4>
              <textarea cols="80" rows="10" id="content" name="contentParent"> <?php echo $list['history_fparent']?>
              </textarea>
              <div class="col-sm-12" style="">
                  <input class= "btn pull-right btn-success" type="submit" name="history_fparent" value="Αποθήκευση" style=" margin-top: 10px; margin-left: 10px;" />
                   <input class= "btn pull-right" type="button" onclick="window.print();" value="Εκτύπωση" style="background-color:#E2CB35; margin-top: 10px;" />
              </div>
            </div>
          </form>
          </div><!--tab history-->
          <div class="tab-pane" id="therapy" role="tabpanel">
            <form action="core/diagnosis_save.php" method="post">
             <input name="patient_id" value="<?php echo $patient_id?>" type="text" hidden>
              <div class="row">
              <h4>Για δική μου χρήση</h4>
                <textarea cols="80" rows="10" id="content" name="contentTherapist">  <?php echo $list['diagnosis_ftherapist']?>
                </textarea>
                <div class="col-sm-12" style="">
                    <input class= "btn pull-right btn-success" type="submit" name="diagnosis_ftherapist" value="Αποθήκευση" style="margin-top: 10px; margin-left: 10px;" />
                     <input class= "btn pull-right" type="button" onclick="window.print();" value="Εκτύπωση" style="background-color:#E2CB35; margin-top: 10px;" />
                </div>
              </div>
            <div class="row" style="margin-bottom: 10px;">
              <h4>Για τον γονέα</h4>
              <textarea cols="80" rows="10" id="content" name="contentParent"> <?php echo $list['diagnosis_fparent']?>
              </textarea>
              <div class="col-sm-12" style="">
                  <input class= "btn pull-right btn-success" type="submit" name="diagnosis_fparent" value="Αποθήκευση" style="margin-top: 10px; margin-left: 10px; " />
                   <input class= "btn pull-right" type="button" onclick="window.print();" value="Εκτύπωση" style="background-color:#E2CB35; margin-top: 10px;" />
              </div>
            </div>
            </form>
          </div><!--tab therapy-->

          <div class="tab-pane" id="exercises" role="tabpanel">
            <div table-responsive">
             <table class="table table-list-search table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Τίτλος Άσκησης</th>
                        <th>Ημερομηνία Καταχώρησης</th>
                        <th>Οδηγίες</th>
                        <th>Αριθμός Επαναλήψεων</th>
                        <th>Σχόλια Κηδεμόνα</th>
                        <th></th>
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
                <td><?php echo $list['parent_comment']?></td>

                <td><p data-placement="top" data-toggle="tooltip" title="Edit">
                <button class="btn btn-clr1 btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" 
                  data-guide="<?php echo $list['guide']; ?>"
                  data-ex="<?php echo $list['exercise_id']; ?>"
                  data-pat="<?php echo $list['patient_id']; ?>"><span class="glyphicon glyphicon-pencil"></span></button></p></td>

                <td><p data-placement="top" data-toggle="tooltip" title="Delete">
                <button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete"
                 data-ex="<?php echo $list['exercise_id']; ?>"
                 data-pat="<?php echo $list['patient_id']; ?>"><span class="glyphicon glyphicon-trash"></span></button></p></td>
                <td>
                </td>
              </tr>
              <?php } ?>

                </tbody>
            </table>   
          </div>
          </div><!--tab exercises-->
        </div>
        
      </div>
    </div>

<script type="text/javascript">
$(function() {
    $('.pop').on('click', function() {
      $('.imagepreview').attr('src', $(this).find('img').attr('src'));
      $('#imagemodal').modal('show');   
    });   
});
</script>

<script>
$('#myTab a').click(function (e) {
    e.preventDefault();
    $(this).tab('show');
});

// store the currently selected tab in the hash value
$("ul.nav-tabs > li > a").on("shown.bs.tab", function (e) {
    var id = $(e.target).attr("href").substr(1);
    $.cookie('activeTab', id);
});

    // on load of the page: switch to the currently selected tab
    var hash = $.cookie('activeTab');
    if (hash != null) {
        $('#myTab a[href="#' + hash + '"]').tab('show');
    }
</script>

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


<!--Modal to edit guide for parent-->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove "  style="font-size: 0.6em;" aria-hidden="true"></span></button>
        <h4 class="modal-title custom_align" id="Heading">Τροποποίηση στις Οδηγίες</h4>
      </div>
      <div class="modal-body">
        <div id="modal-loader" style="display: none; text-align: center;"></div>
        <div id="dynamic-content">
        <form role="form"  action="core/update_shared_exercise.php" method="POST" class="form-horizontal">
            <div class="row">
                <label  class="col-sm-6"  style="margin-bottom: 10px;" for="guide">Οδηγίες</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" style="margin-bottom: 10px;"
                    id="guide" placeholder="" name="guide" required/> 
                </div>
            </div>
            <input type="hidden" name="exercise_id" id="exercise_id"  value="">
            <input type="hidden" name="patient_id" id="patient_id"  value="">
         </div>   
      </div>
      <div class="modal-footer">
        <div>
            <input type="submit" class="btn btn-success btn-sm" value="Αποθήκευση">
        </div>
      </div>
       </form>
    </div><!-- /.modal-content --> 
  </div><!-- /.modal-dialog --> 
</div><!-- /.modal- --> 
 
<!--Modal for delete patient-->
<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        <h4 class="modal-title custom_align" id="Heading">Διαγραφή άσκησης</h4>
      </div>
      <form role="form"  action="core/delete_shared_exercise.php" method="POST" class="form-horizontal">
      <div class="modal-body">
       <div class="alert alert-danger" ><span class="glyphicon glyphicon-warning-sign"></span> Είστε σίγουροι για ην διαγραφή;</div>
        <input type="hidden" name="ex_id" id="ex_id"  value="">
        <input type="hidden" name="pat_id" id="pat_id"  value="">
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

    modal.find('.modal-body #guide').val(button.data('guide'))
    modal.find('.modal-body #exercise_id').val(button.data('ex'))
    modal.find('.modal-body #patient_id').val(button.data('pat'))
  })

   $('#delete').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var modal = $(this)

    modal.find('.modal-body #ex_id').val(button.data('ex'))
    modal.find('.modal-body #pat_id').val(button.data('pat'))
  })

</script>

</body>
</html>