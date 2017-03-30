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

<!--<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>-->

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-json/2.6.0/jquery.json.min.js"></script>

  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

  <style type="text/css">
  div {
    display: block;
}
    .left { 
      width: 25%; 
      
      padding: 1em; 
      float:left;
    } 
    .right { 
      width: 25%; 
      padding: 1em; 
      float:left;
    } 
    .center { 
      width: 50%; 
      height: 400px;
      border:1px solid #f0f0f0;
      padding: 1em; 
      float:left;
    } 
    .assetImage{
      border: 1px solid #f0f0f0;
      padding:7px;
      height: 70px; 
      width: 70px;
      margin-bottom: 5px;
    }
    .scrollStyle{
      max-height: 200px;
      overflow-y:auto;
      overflow-x: auto;
    }
  </style>

  <script type="text/javascript">
/*    $(document).ready(function () {
    //Counter
    counter = 0;
    //Make element draggable
    $(".drag").draggable({
        helper: 'clone',
        containment: 'frame',
        //When first dragged
        stop: function (ev, ui) {
            var pos = $(ui.helper).offset();
            objName = "#clonediv" + counter
            $(objName).css({
                "left": pos.left,
                "top": pos.top
            });
            $(objName).removeClass("drag");
            //When an existiung object is dragged
            $(objName).draggable({
                containment: 'parent',
                stop: function (ev, ui) {
                    var pos = $(ui.helper).offset();
                    console.log($(this).attr("id"));
                    console.log(pos.left)
                    console.log(pos.top)
                }
            });
        }
    });
    //Make element droppable
    $("#frame").droppable({
        drop: function (ev, ui) {
            if (ui.helper.attr('id').search(/drag[0-9]/) != -1) {
                counter++;
                var element = $(ui.draggable).clone();
                element.addClass("tempclass");
                $(this).append(element);
                $(".tempclass").attr("id", "clonediv" + counter);
                $("#clonediv" + counter).removeClass("tempclass");
                //Get the dynamically item id
                draggedNumber = ui.helper.attr('id').search(/drag([0-9])/)
                itemDragged = "dragged" + RegExp.$1
                console.log(itemDragged)
                $("#clonediv" + counter).addClass(itemDragged);
            }
        }
    });
});*/
  </script>

  <script type="text/javascript">
    $(function() {

/*

$('#droppable').each(function() {
    //$(this).whateverYouWantToDo();
    alert("hello");
});

$("#press").click(function(){
/*  var listOfDrag = [];
      $(".center").each(function(){
        listOfDrag.push({id: $(this).attr("id")});
      });
alert(JSON.stringify(listOfDrag));

   var x =$("#source_x").val(); 
    var y = $("#source_y").val();
    
    alert("x is: " + x + " y is: " + y);
});*/

 // var sPositions = localStorage.positions || "{}",
  //positions = JSON.parse(sPositions);


/*$('[id^="element"]').each(function() {
alert();
  });*/


var position=[];


      counter=0;
    $('[id^="element"]').draggable({
        revert: "invalid",  
        helper: "clone",
        containment: '#droppable',
        cursor : "move",
        scroll: false,
        //When first dragged 
        stop: function (ev, ui) {

          /*
           positions[this.id] = ui.position;
        localStorage.positions = JSON.stringify(positions);
       alert(JSON.stringify(positions))

    var order = { positions: positions };
*/
            var pos = $(ui.helper).offset();
            objName = "#clonediv" + counter
            $(objName).css({
                "left": pos.left,
                "top": pos.top
            });
          counter++;
        
           //// var newClone = $(ui.helper).clone();
           // $(this).after(newClone);
           // $(this).draggable('enable');
           //$(newClone).attr('id')='2';
            
            //console.log(newClone)
            //  $(this).append(newClone);
           // $(newClone).attr('id', 'element_3');
            //$(newClone).attr('class','dropped').draggable();
          //  $(newClone).css({width:'70px',height:'70px'});
/*
             var item={ coordTop:  pos.left };
                position.push(item);
                var order = { position: position };
                alert(JSON.stringify(order));
*/
            //alert($(this).attr("id"));
            /*$(objName).removeClass("drag");
            //When an existiung object is dragged
            $(objName).draggable({
                containment: 'parent',
                stop: function (ev, ui) {
                    var pos = $(ui.helper).offset();
                    console.log($(this).attr("id"));
                    console.log(pos.left)
                    console.log(pos.top)
                }
            });*/
        }
    });   

    $("#droppable").droppable({
        accept:'[id^="element"]',
        activeClass: "ui-state-default",
        hoverClass: "ui-state-hover",
       // accept:'[id^="element"]',
        drop: function(event, ui) {
             var newClone= $(this).append($(ui.helper).clone().draggable({
                  containment: "parent",
                  cursor: "move",
                  stop: handleDragStop,
                  start: handleDragStart
              }));
             var newID= "element_"+counter;
              $(newClone).attr('id', newID);

              var draggable = ui.draggable;

              function handleDragStop( event, ui ) {
                var offsetXPos = parseInt( ui.offset.left );
                var offsetYPos = parseInt( ui.offset.top );
                alert( "Drag stopped!\n\nOffset: (" + offsetXPos + ", " + offsetYPos +  draggable.attr('id') + ")\n");

                var positions =[];
                positions.push({id: 'elemenet_1', left: '12' , top: '8'});
                var flag=0;

                $.each(positions, function() {
                  if (this.id == 'elemenet_1') {
                      this.top = offsetYPos;
                      this.left = offsetXPos;
                      flag=1;
                  }
                  alert("top" + this.top + "id" +this.id );
              });

                if(flag==0)
                   positions.push({id: 'el1', left: offsetXPos , top: offsetYPos});
                alert(positions.length);
                

            }

              function handleDragStart( event, ui ) {
                var offsetXPos = parseInt( ui.offset.left );
                var offsetYPos = parseInt( ui.offset.top );
               // alert( "Drag start!\n\nOffset: (" + offsetXPos + ", " + offsetYPos +  draggable.attr('id') + ")\n");

            }
        }
  });
    
    $('#trash').droppable({
        drop: function(event, ui) {
            $(ui.draggable).remove();
        }
    });


});
  </script>


  <script type="text/javascript">
  function saveFun() {
/*
    var matches = [];
    var searchEles = document.getElementById("droppable").children;
    for(var i = 0; i < searchEles.length; i++) {
      alert("canvas");
        if(searchEles[i].tagName == 'IMG' || searchEles.tagName == 'INPUT') {
          alert("indise");
            if(searchEles[i].id.indexOf('element') == 0) {
                matches.push(searchEles[i]);
                alert();
            }
        }
    }
    */

    $('[id^="element"]').each(function() {
      //$(this).whateverYouWantToDo();
      alert("hehe");
});
}
  </script>
</head>

<body>
  <?php include_once('navbar.php');?>
  <div class="container">
    <div class="left">
      <div id="trash"><span class="glyphicon glyphicon-trash"> <b>Διαγραφή</b>

      <p></p>
      </div>

       <input type="button" value="Click me" id="press" onclick="saveFun()" >

    </div>
    <div class="center" id="droppable">
    </div>

    <div class="right">
      <!--<div class="row"><b>Βιβλιοθήκη</b></div>-->
      <div class="scrollStyle" id="library">
       <?php 
          $assets = mysqli_query($conn,"SELECT * FROM assets");

          if (!$assets) {
            die('Invalid query: ' . mysql_error());
          }

          while ($list = mysqli_fetch_array($assets)) {?>
            <img class="assetImage" src="<?php echo $list['path']?>" id="element_<?php echo $list['asset_id']?>" draggable="true"/>
      <?php } ?>
      </div>
    </div>

  </div>
</body>
</html>