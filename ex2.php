<?php
include 'core/init.php';
session_start(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Simple Draggable Element Persistence with jQuery</title>
 

<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-json/2.6.0/jquery.json.min.js"></script>

  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  

  <script type="text/javascript">
       $(document).ready(function() {
    cntb1 = 0;
    cntb2 = 0;
    cntb3 = 0;
 $(".droppable").droppable({
    accept: '#b1, #b2, #b3',        
        drop: function(event, ui) {
        if(ui.draggable.attr('id')=='b1'){
                cntb1++;    //counts clones
                $(this).append($(ui.helper).clone());               
                $(".droppable .drag").addClass("component");
                $(".component").removeClass("drag");
                $(".component").resizable({aspectRatio: 'true' }).parent().draggable({ //parent() -> both draggable & resizable work
                        containment: '.droppable', //cursor: 'move', grid: [3,3]                        
                }).attr('id', 'b1c'+cntb1); //change id
                $("#status1").append('b1c'+cntb1);
            }
        else if(ui.draggable.attr('id')=='b2'){
                cntb2++;    //counts clones
                $(this).append($(ui.helper).clone());               
                $(".droppable .drag").addClass("component");
                $(".component").removeClass("drag");
                $(".component").resizable({aspectRatio: 'true' }).parent().draggable({ //parent() -> both draggable & resizable work
                        containment: '.droppable', //cursor: 'move', grid: [3,3]                        
                }).attr('id', 'b2c'+cntb2); //change id
                $("#status2").append('b2c'+cntb2);
            }
        else if(ui.draggable.attr('id')=='b3'){
                cntb3++;    //counts clones
                $(this).append($(ui.helper).clone());               
                $(".droppable .drag").addClass("component");
                $(".component").removeClass("drag");
                $(".component").resizable({aspectRatio: 'true' }).parent().draggable({ //parent() -> both draggable & resizable work
                        containment: '.droppable', //cursor: 'move', grid: [3,3]                        
                }).attr('id', 'b3c'+cntb3); //change id
                $("#status3").append('b3c'+cntb3);
            }

    }
}); 

$(".drag").draggable({ 
            helper:'clone', 
            appendTo: 'body', //para maka drag padung gawas sa accordion
            cursor: 'move' 
            });
$( "#accordion" ).accordion({                   
            autoHeight: false,                  
            collapsible: true,
            active: false
});
});
  </script>
</head>

<body>
 <div id="accordion">
 <h3><a href="#">Buttons</a></h3>   
     <div class="div-table">         
        <div class="div-table-row">
        <div class="div-table-col"><img src="button_final/button_1.gif" id="b1" class="drag"/></div>
        <div class="div-table-col"><img src="button_final/button_2.gif" id="b2" class="drag"/></div>
        <div class="div-table-col"><img src="button_final/button_3.gif" id="b3" class="drag"/></div>
        </div>
          </div>
</div>
<div id="frame" style="border:dotted; height:500px; width:60%; float:left" class="droppable">
<h3 id="status1" style="height:30%;"></h3>
<h3 id="status2" style="height:30%;"></h3>
<h3 id="status3" style="height:30%;"></h3></div>
</body>
</html>
