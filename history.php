<!DOCTYPE html>
<html>
<head>
  <title>logoucon | ιστορικά</title>
  <link rel="icon" type="image/png" href="img/logo.png">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">


  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <!--table scripts-->
  <script language="JavaScript" src="https://code.jquery.com/jquery-1.11.1.min.js" type="text/javascript"></script>
  <script language="JavaScript" src="https://cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js" type="text/javascript"></script>
  <script language="JavaScript" src="https://cdn.datatables.net/plug-ins/3cfcc339e89/integration/bootstrap/3/dataTables.bootstrap.js" type="text/javascript"></script>
  <link rel="stylesheet" type="text/css" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/plug-ins/3cfcc339e89/integration/bootstrap/3/dataTables.bootstrap.css">

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

</style>
<body>
  <?php include_once('navbar.php');?>


<div class="container">
    <div class="row" style="margin-bottom: 30px; margin-top: 10px;">
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

        <div class="col-md-6">
          <button type="button" class="btn btn-default btn-responsive" data-toggle="modal" data-target="#add"><span class="glyphicon glyphicon-plus"></span> Προσθήκη</button>
        </div>          
    </div>

    
    <div class="col-md-12 table-responsive">
       <table class="table table-list-search table-hover">
          <thead>
              <tr>
                  <th></th>
                  <th>Εγγεγραμμένος</th>
                  <th>Όνομα Κηδεμόνα</th>
                  <th>Ημερομηνία Εγγραφής</th>
                  <th>Αριθμός Επισκέψεων</th>
                  <th>Αριθμός Ασκήσεων</th>
                  <th></th>
                  
              </tr>
          </thead>
          <tbody>
              <tr>
                  <td><img style='height: 20px; width: 20px;' class="img-circle" src="img/profile.jpg"></td>
                  <td>Ελευθερία Ιωάννου</td>
                  <td>--</td>
                  <td>12/09/09</td>
                  <td>12</td>
                  <td>2</td>
                  <td><a href="history_details.php" class="btn btn-default btn-xs btn-clr2">Προβολή</a></td>

              </tr>
              <tr>
                  <td><img style='height: 20px; width: 20px;' class="img-circle" src="img/profile.jpg"></td>
                  <td>Ελευθερία Ιωάννου</td>
                  <td>Πέτρος Ιωάννου</td>
                  <td>12/09/09</td>
                  <td>10</td>
                  <td>5</td>
                   <td><a href="history_details.php" class="btn btn-default btn-xs btn-clr2">Προβολή</a></td>

              </tr>
          </tbody>
      </table>   
    </div>
  </div>
</div>
</body>
</html>