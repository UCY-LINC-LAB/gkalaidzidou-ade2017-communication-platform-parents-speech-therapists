    <html>
    <head>
<script src="//code.jquery.com/jquery-2.0.3.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
<script src="//raw.github.com/botmonster/jquery-bootpag/master/lib/jquery.bootpag.min.js"></script>
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">


    </head>
    <body>
<div id="dynamic_content">Pagination goes here</div>
<div id="show_paginator"></div>

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


    </body>
    </html>