<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>jQuery UI Dialog - Modal form</title>


  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


  <script src="https://raw.githubusercontent.com/eligrey/FileSaver.js/master/FileSaver.js"></script>

   <script src="html2canvas.js"></script>



<style type="text/css">
  body {
    font-family: "Lucida Grande", "Lucida Sans", Arial, sans-serif;
    font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;

}
</style>
  
  <script type="text/javascript">
    $(function() { 
    $("#btnSave").click(function() { 
        html2canvas($("#widget"), {
            onrendered: function(canvas) {
                theCanvas = canvas;
                document.body.appendChild(canvas);

                canvas.toBlob(function(blob) {
          saveAs(blob, "Dashboard.png"); 
        });
            }
        });
    });
}); 

  </script>
</head>
<body>
 
<span id="widget" class="widget" field="AGE" roundby="20" description="Patient age, in years">
   <div>
   <b style="background-color: red"> hello</b>
     <img style='height: 140px; width: 100px; margin-left: 100px;' src="img/2.jpg">
     </div>
</span>
<br/>
<input type="button" id="btnSave" value="Save PNG"/>

<div id="img-out"></div>
 
</body>
</html>