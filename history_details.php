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

  <style type="text/css">
    .carousel-control.left,.carousel-control.right  {background:none;width:25px;}
    .carousel-control.left {left:-25px;}
    .carousel-control.right {right:-25px;}
    .broun-block {
        background: grey;
        padding-bottom: 34px;
    }
    .block-text {
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0 3px 0 #2c2222;
        color: #626262;
        font-size: 14px;
        margin-top: 27px;
        padding: 15px 18px;
    }
    .block-text a {
        color: #7d4702;
        font-size: 25px;
        font-weight: bold;
        line-height: 10px;
        text-decoration: none;
        text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
    }
    .mark {
        padding: 12px 0;background:none;
    }
    .block-text p {
        color: #585858;
        font-family: Georgia;
        font-style: italic;
        line-height: 10px;
    }

    .sprite-i-triangle {
        background-position: 0 -1298px;
        height: 44px;
        width: 50px;
    }
    .block-text ins {
        bottom: -44px;
        left: 50%;
        margin-left: -60px;
    }
    .block {
        display: block;
    }
    .zmin {
        z-index: 1;
    }
    .ab {
        position: absolute;
    }
    .person-text {
        padding: 10px 0 0;
        text-align: center;
        z-index: 2;
    }
    .person-text a {
        color: #ffcc00;
        display: block;
        font-size: 14px;
        margin-top: 3px;
        text-decoration: underline;
    }
    .person-text i {
        color: #fff;
        font-family: Georgia;
        font-size: 13px;
    }
    .rel {
        position: relative;
    }
    .carousel-inner{
      width:100%;
      max-height: 200px !important;
}
  </style>
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
    {label: "Προσοχή",  data: d1, points: { symbol: "circle", fillColor: "#058DC7" }, color: '#058DC7'},
    {label: "Απόδοση",  data: d2, points: { symbol: "diamond", fillColor: "#AA4643" }, color: '#AA4643'},
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


<!--carousel script-->
<script type="text/javascript">

</script>
<body>
  <?php include_once('navbar.php');?>

  <div class="container">
    <div class="row">
      <div class="col-sm-2">
        <nav class="nav-sidebar">
            <ul class="nav tabs">
              <li class="active"><a href="#tab1" data-toggle="tab">Γραφική Προόδου</a></li>
              <li class=""><a href="#tab2" data-toggle="tab">Ιστορικό</a></li>
              <li class=""><a href="#tab3" data-toggle="tab">Θεραπευτική Προσέγγιση</a></li>
              <li class=""><a href="#tab3" data-toggle="tab">Ασκήσεις</a></li>                                
            </ul>
        </nav>
      </div>
      <div class="col-sm-10" id="placeholder" style="margin-left: 50px;"></div>
    </div>

      <div class="carousel-reviews broun-block ">
        <div class="container">
          <div class="row">
              <div id="carousel-reviews" class="carousel slide" data-interval="false" data-ride="carousel">
                  <div class="carousel-inner">
                      <div class="item active">
                          <div class="col-md-3 col-sm-6">
                              <div class="block-text rel zmin">
                                  <div class="mark">My rating: <span class="rating-input"><span data-value="0" class="glyphicon glyphicon-star"></span><span data-value="1" class="glyphicon glyphicon-star"></span><span data-value="2" class="glyphicon glyphicon-star"></span><span data-value="3" class="glyphicon glyphicon-star"></span><span data-value="5" class="glyphicon glyphicon-star-empty"></span>  </span></div>
                                  <p>Never </p>
                              </div>
                          </div>
                          <div class="col-md-3 col-sm-6 hidden-xs">
                              <div class="block-text rel zmin">
                                  <a title="" href="#">The Purge: Anarchy</a>
                                  <div class="mark">My rating: <span class="rating-input"><span data-value="0" class="glyphicon glyphicon-star"></span><span data-value="1" class="glyphicon glyphicon-star"></span><span data-value="2" class="glyphicon glyphicon-star-empty"></span><span data-value="3" class="glyphicon glyphicon-star-empty"></span><span data-value="4" class="glyphicon glyphicon-star-empty"></span><span data-value="5" class="glyphicon glyphicon-star-empty"></span>  </span></div>
                                  <p>The</p>
                              </div>
                          </div>
                          <div class="col-md-4 col-sm-6 hidden-sm hidden-xs">
                              <div class="block-text rel zmin">
                                  <a title="" href="#">Planes: Fire & Rescue</a>
                                  <div class="mark">My rating: <span class="rating-input"><span data-value="0" class="glyphicon glyphicon-star"></span><span data-value="1" class="glyphicon glyphicon-star"></span><span data-value="2" class="glyphicon glyphicon-star"></span><span data-value="3" class="glyphicon glyphicon-star"></span><span data-value="4" class="glyphicon glyphicon-star"></span><span data-value="5" class="glyphicon glyphicon-star"></span>  </span></div>
                                  <p>What</p>
                              </div>
                          </div>
                      </div>
                      <div class="item">
                          <div class="col-md-4 col-sm-6">
                              <div class="block-text rel zmin">
                                  <a title="" href="#">Hercules</a>
                                  <div class="mark">My rating: <span class="rating-input"><span data-value="0" class="glyphicon glyphicon-star"></span><span data-value="1" class="glyphicon glyphicon-star"></span><span data-value="2" class="glyphicon glyphicon-star"></span><span data-value="3" class="glyphicon glyphicon-star"></span><span data-value="4" class="glyphicon glyphicon-star-empty"></span><span data-value="5" class="glyphicon glyphicon-star-empty"></span>  </span></div>
                                  <p>Never</p>
                              </div>
                          </div>
                          <div class="col-md-4 col-sm-6 hidden-xs">
                              <div class="block-text rel zmin">
                                  <a title="" href="#">The Purge: Anarchy</a>
                                  <div class="mark">My rating: <span class="rating-input"><span data-value="0" class="glyphicon glyphicon-star"></span><span data-value="1" class="glyphicon glyphicon-star"></span><span data-value="2" class="glyphicon glyphicon-star-empty"></span><span data-value="3" class="glyphicon glyphicon-star-empty"></span><span data-value="4" class="glyphicon glyphicon-star-empty"></span><span data-value="5" class="glyphicon glyphicon-star-empty"></span>  </span></div>
                                  <p>The </p>
                              </div>
                          </div>
                          <div class="col-md-4 col-sm-6 hidden-sm hidden-xs">
                              <div class="block-text rel zmin">
                                  <a title="" href="#">Planes: Fire & Rescue</a>
                                  <div class="mark">My rating: <span class="rating-input"><span data-value="0" class="glyphicon glyphicon-star"></span><span data-value="1" class="glyphicon glyphicon-star"></span><span data-value="2" class="glyphicon glyphicon-star"></span><span data-value="3" class="glyphicon glyphicon-star"></span><span data-value="4" class="glyphicon glyphicon-star"></span><span data-value="5" class="glyphicon glyphicon-star"></span>  </span></div>
                                  <p>What</p>
                              </div>
                          </div>
                      </div>
                      <div class="item">
                          <div class="col-md-4 col-sm-6">
                              <div class="block-text rel zmin">
                                  <a title="" href="#">Hercules</a>
                                  <div class="mark">My rating: <span class="rating-input"><span data-value="0" class="glyphicon glyphicon-star"></span><span data-value="1" class="glyphicon glyphicon-star"></span><span data-value="2" class="glyphicon glyphicon-star"></span><span data-value="3" class="glyphicon glyphicon-star"></span><span data-value="4" class="glyphicon glyphicon-star-empty"></span><span data-value="5" class="glyphicon glyphicon-star-empty"></span>  </span></div>
                                  <p>Never</p>
                              </div>
                          </div>
                          <div class="col-md-4 col-sm-6 hidden-xs">
                              <div class="block-text rel zmin">
                                  <a title="" href="#">The Purge: Anarchy</a>
                                  <div class="mark">My rating: <span class="rating-input"><span data-value="0" class="glyphicon glyphicon-star"></span><span data-value="1" class="glyphicon glyphicon-star"></span><span data-value="2" class="glyphicon glyphicon-star-empty"></span><span data-value="3" class="glyphicon glyphicon-star-empty"></span><span data-value="4" class="glyphicon glyphicon-star-empty"></span><span data-value="5" class="glyphicon glyphicon-star-empty"></span>  </span></div>
                                  <p>The</p>
                              </div>

                          </div>
                          <div class="col-md-4 col-sm-6 hidden-sm hidden-xs">
                              <div class="block-text rel zmin">
                                  <a title="" href="#">Planes: Fire & Rescue</a>
                                  <div class="mark">My rating: <span class="rating-input"><span data-value="0" class="glyphicon glyphicon-star"></span><span data-value="1" class="glyphicon glyphicon-star"></span><span data-value="2" class="glyphicon glyphicon-star"></span><span data-value="3" class="glyphicon glyphicon-star"></span><span data-value="4" class="glyphicon glyphicon-star"></span><span data-value="5" class="glyphicon glyphicon-star"></span>  </span></div>
                                  <p>What</p> 
                              </div>
                          </div>
                      </div>                    
                  </div>
                  <a class="left carousel-control" href="#carousel-reviews" role="button" data-slide="prev">
                      <span class="glyphicon glyphicon-chevron-left"></span>
                  </a>
                  <a class="right carousel-control" href="#carousel-reviews" role="button" data-slide="next">
                      <span class="glyphicon glyphicon-chevron-right"></span>
                  </a>
              </div>
          </div>
        </div>
      </div>
  </div>
</body>
</html>