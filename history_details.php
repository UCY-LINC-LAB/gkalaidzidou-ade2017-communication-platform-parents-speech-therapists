<!DOCTYPE html>
<html>
<head>
  <title>logoucon | ιστορικά</title>
  <link rel="icon" type="image/png" href="img/logo.png">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/plug-ins/3cfcc339e89/integration/bootstrap/3/dataTables.bootstrap.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <!--table scripts-->
  <script language="JavaScript" src="https://code.jquery.com/jquery-1.11.1.min.js" type="text/javascript"></script>
  <script language="JavaScript" src="https://cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js" type="text/javascript"></script>
  <script language="JavaScript" src="https://cdn.datatables.net/plug-ins/3cfcc339e89/integration/bootstrap/3/dataTables.bootstrap.js" type="text/javascript"></script>

  <!-- Bootstrap Core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/bootstrap.css" rel="stylesheet">

  <!--  jQuery -->
  <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

  <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">




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


</head>

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
   
<!--[if lte IE 8]><script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/flot/0.8.2/excanvas.min.js"></script><![endif]-->
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/flot/0.8.2/jquery.flot.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/flot/0.8.2/jquery.flot.symbol.min.js"></script>
<script type="text/javascript" src="http://raw.github.com/markrcote/flot-axislabels/master/jquery.flot.axislabels.js"></script>
<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/flot/0.8.2/jquery.flot.time.min.js"></script>
 
<script type="text/javascript">
//Rome, Italy
var d1 = [[1262304000000, 12], [1264982400000, 13], [1267401600000, 15], [1270080000000, 18], [1272672000000, 23], [1275350400000, 27], [1277942400000, 30], [1280620800000, 30], [1283299200000, 27], [1285891200000, 22], [1288569600000, 16], [1291161600000, 13]];
// Paris, France
var d2 = [[1262304000000, 6], [1264982400000, 7], [1267401600000, 12], [1270080000000, 16], [1272672000000, 20], [1275350400000, 23], [1277942400000, 25], [1280620800000, 24], [1283299200000, 21], [1285891200000, 16], [1288569600000, 10], [1291161600000, 7]];
// Madrid, Spain
var d3 = [[1262304000000, 11], [1264982400000, 13], [1267401600000, 16], [1270080000000, 18], [1272672000000, 22], [1275350400000, 28], [1277942400000, 33], [1280620800000, 32], [1283299200000, 28], [1285891200000, 21], [1288569600000, 15], [1291161600000, 11]];

var data1 = [
    {label: "",  data: d1, points: { symbol: "circle", fillColor: "#058DC7" }, color: '#058DC7'},
    {label: "",  data: d2, points: { symbol: "diamond", fillColor: "#AA4643" }, color: '#AA4643'},
    {label: "",  data: d3, points: { symbol: "square", fillColor: "#50B432" }, color: '#50B432'}
];
 
$(document).ready(function () {
    $.plot($("#placeholder"), data1, {
        xaxis: {
            min: (new Date(2009, 11, 18)).getTime(),
            max: (new Date(2010, 11, 15)).getTime(),
            mode: "time",
            tickSize: [1, "month"],
            monthNames: ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12"],
            tickLength: 0,
            axisLabel: 'Month',
            axisLabelUseCanvas: true,
            axisLabelFontSizePixels: 12,
            axisLabelFontFamily: 'Verdana, Arial, Helvetica, Tahoma, sans-serif',
            axisLabelPadding: 5
        },
        yaxis: {
            axisLabel: 'Temperature (C)',
            axisLabelUseCanvas: true,
            axisLabelFontSizePixels: 12,
            axisLabelFontFamily: 'Verdana, Arial, Helvetica, Tahoma, sans-serif',
            axisLabelPadding: 5
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
        var monthArray = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
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
                    "<b>" + item.series.label + "</b><br /> " + x + " = " + y + "mm",
                    z);
            }
        } else {
            $("#flot-tooltip").remove();
            previousPoint = null;            
        }
    });
});
</script>

<style type="text/css">
.carousel-indicators-numbers li {
  text-indent: 0;
  margin: 0 2px;
  width: 30px;
  height: 30px;
  border: none;
  border-radius: 100%;
  line-height: 30px;
  color: #fff;
  background-color: #999;
  -webkit-transition: all 0.25s ease;
  transition: all 0.25s ease;
}
.carousel-indicators-numbers li.active, .carousel-indicators-numbers li:hover {
  margin: 0 2px;
  width: 30px;
  height: 30px;
  background-color: #337ab7;
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

</style>



<body>
  <?php include_once('navbar.php');?>

  <div class="container" style="margin-top: 40px;">
    <div class="row">
      <div class="col-sm-2">
       <img style='height: 20px; width: 20px;' src="img/profile.jpg"><b>  Ηλίας Χρίστου</b>
        <nav class="nav-sidebar">
            <ul class="nav tabs">
              <li class="active"><a href="#graph" data-toggle="tab">Γραφική Προόδου</a></li>
              <li class=""><a href="#history" data-toggle="tab">Ιστορικό</a></li>
              <li class=""><a href="#therapy" data-toggle="tab">Θεραπεία & Διάγνωση</a></li>
              <li class=""><a href="#exercises" data-toggle="tab">Ασκήσεις Σπιτιού</a></li>                                
            </ul>
        </nav>
      </div>
      <div class="col-sm-10">
        <div class="tab-content">
          <div class="tab-pane active" id="graph" role="tabpanel">
            <div id="placeholder"></div>
            <div class="container" style="margin-top: 20px;">
              <div class='col-md-10'>
                <div class="carousel slide " data-ride="carousel" id="quote-carousel" data-interval="false">
                  <!-- Bottom Carousel Indicators -->
                  <ol class="carousel-indicators carousel-indicators-numbers">
                    <li data-target="#quote-carousel" data-slide-to="0" class="active">1</li>
                    <li data-target="#quote-carousel" data-slide-to="1">2</li>
                    <li data-target="#quote-carousel" data-slide-to="2">3</li>
                  </ol>
                  
                  <!-- Carousel Slides / Quotes -->
                  <div class="carousel-inner polaroid" >
                    <!-- Quote 1 -->
                    <div class="item">
                        <div class="row text-center"><h4> 12/02/2017</h4></div>
                        <div class="row" style="margin-bottom: 20px;">
                          <div class="col-sm-3 text-center">
                           <div style="color:#058DC7; "><span><span data-value="0" class="glyphicon glyphicon-star"></span><span data-value="1" class="glyphicon glyphicon-star"></span><span data-value="2" class="glyphicon glyphicon-star"></span><span data-value="3" class="glyphicon glyphicon-star"></span><span data-value="5" class="glyphicon glyphicon-star-empty"></span></span></div>
                           <div style="color:#AA4643;"><span><span data-value="0" class="glyphicon glyphicon-star"></span><span data-value="1" class="glyphicon glyphicon-star"></span><span data-value="2" class="glyphicon glyphicon-star"></span><span data-value="3" class="glyphicon glyphicon-star"></span><span data-value="5" class="glyphicon glyphicon-star-empty"></span></span></div>
                           <div style="color:#50B432;"><span><span data-value="0" class="glyphicon glyphicon-star"></span><span data-value="1" class="glyphicon glyphicon-star"></span><span data-value="2" class="glyphicon glyphicon-star"></span><span data-value="3" class="glyphicon glyphicon-star"></span><span data-value="5" class="glyphicon glyphicon-star-empty"></span></span></div>
                          </div>
                          <div class="col-sm-9">
                            <p><span class="glyphicon glyphicon-pencil"></span><b> Στόχος: </b>Εξάσκηση του γράμματος ξ.</p>
                            <hr>
                            <p><span class="glyphicon glyphicon-comment"></span><b> Σχόλια:</b> Πολυ καλύτερα συγκριτικά με την προηγούμενη εβδομάδα.</p>
                          </div>
                        </div>
                    </div>
                    <!-- Quote 2 -->
                    <div class="item active">
                        <div class="row text-center" style=" " ><h4> 12/02/2017</h4></div>
                        <div class="row" style="margin-bottom: 20px;">
                          <div class="col-sm-3 text-center">
                           <div style="color:#058DC7; "><span><span data-value="0" class="glyphicon glyphicon-star"></span><span data-value="1" class="glyphicon glyphicon-star"></span><span data-value="2" class="glyphicon glyphicon-star"></span><span data-value="3" class="glyphicon glyphicon-star"></span><span data-value="5" class="glyphicon glyphicon-star-empty"></span></span></div>
                           <div style="color:#AA4643;"><span><span data-value="0" class="glyphicon glyphicon-star"></span><span data-value="1" class="glyphicon glyphicon-star"></span><span data-value="2" class="glyphicon glyphicon-star"></span><span data-value="3" class="glyphicon glyphicon-star"></span><span data-value="5" class="glyphicon glyphicon-star-empty"></span></span></div>
                           <div style="color:#50B432;"><span><span data-value="0" class="glyphicon glyphicon-star"></span><span data-value="1" class="glyphicon glyphicon-star"></span><span data-value="2" class="glyphicon glyphicon-star"></span><span data-value="3" class="glyphicon glyphicon-star"></span><span data-value="5" class="glyphicon glyphicon-star-empty"></span></span></div>
                          </div>
                          <div class="col-sm-9">
                            <p><span class="glyphicon glyphicon-pencil"></span><b> Στόχος: </b>Εξάσκηση του γράμματος ξ.</p>
                            <hr>
                            <p><span class="glyphicon glyphicon-comment"></span><b> Σχόλια:</b> Πολυ καλύτερα συγκριτικά με την προηγούμενη εβδομάδα.</p>
                          </div>
                        </div>
                    </div>
                  </div>
                  
                  <!-- Carousel Buttons Next/Prev -->
                  <a data-slide="prev" href="#quote-carousel" class="left carousel-control" style="color:#098680;"><i class="fa fa-chevron-left"></i></a>
                  <a data-slide="next" href="#quote-carousel" class="right carousel-control" style="color:#098680;"><i class="fa fa-chevron-right"></i></a>
                </div>                          
              </div>
            </div>
          </div><!--tab graph-->
          <div class="tab-pane" id="history" role="tabpanel">
            <form action="form_handler.php" method="post">
              <div class="row">
              <h4>Για δική μου χρήση</h4>
                <textarea cols="80" rows="10" id="content" name="content"> 
                </textarea>
                <div class="col-sm-12" style="">
                    <input class= "btn pull-right" type="submit" value="Αποθήκευση" style="background-color:#E2CB35; margin-top: 10px;" />
                </div>

              </div>
            </form>
            <div class="row" style="margin-bottom: 10px;">
              <h4>Για τον γονέα</h4>
              <textarea cols="80" rows="10" id="content" name="content"> 
              </textarea>
              <div class="col-sm-12" style="">
                  <input class= "btn pull-right" type="submit" value="Αποθήκευση" style="background-color:#E2CB35; margin-top: 10px;" />
              </div>
            </div>
          </div><!--tab history-->
          <div class="tab-pane" id="therapy" role="tabpanel">
            <form action="form_handler.php" method="post">
              <div class="row">
              <h4>Για δική μου χρήση</h4>
                <textarea cols="80" rows="10" id="content" name="content"> 
                </textarea>
                <div class="col-sm-12" style="">
                    <input class= "btn pull-right" type="submit" value="Αποθήκευση" style="background-color:#E2CB35; margin-top: 10px;" />
                </div>

              </div>
            </form>
            <div class="row" style="margin-bottom: 10px;">
              <h4>Για τον γονέα</h4>
              <textarea cols="80" rows="10" id="content" name="content"> 
              </textarea>
              <div class="col-sm-12" style="">
                  <input class= "btn pull-right" type="submit" value="Αποθήκευση" style="background-color:#E2CB35; margin-top: 10px;" />
              </div>
            </div>
          </div><!--tab therapy-->
          <div class="tab-pane" id="exercises" role="tabpanel">
            <div table-responsive">
             <table class="table table-list-search table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Τίτλος Άσκησης</th>
                        <th>Ημερομηνία Καταχώρησης</th>
                        <th>Αριθμός Επαναλήψεων</th>
                        <th>Σχόλια Κηδεμόνα</th>
                        <th></th>
                        
                    </tr>
                </thead>
                <tbody>
                    <tr>
                      <td>1</td>
                      <td>Γράμμα Ξ</td>
                      <td>12/09/09</td>
                      <td>4</td>
                      <td>--</td>
                      <td><a href="history_details.php" class="btn btn-default btn-xs btn-clr2">Προβολή</a></td>
                    </tr>
                    <tr>
                      <td>2</td>
                      <td>Γράμμα Σ</td>
                      <td>12/09/09</td>
                      <td>4</td>
                      <td>--</td>
                      <td><a href="history_details.php" class="btn btn-default btn-xs btn-clr2">Προβολή</a></td>
                    </tr>
                </tbody>
            </table>   
          </div>
          </div><!--tab exercises-->
        </div>
        
      </div>
    </div>

  </div>


</body>
</html>