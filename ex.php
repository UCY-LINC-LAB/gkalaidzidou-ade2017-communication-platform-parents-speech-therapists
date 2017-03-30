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

<!--<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.7.2.custom.min.js"></script>
<script type="text/javascript" src="js/jquery.json-2.2.min.js"></script>
-->
<style type="text/css">
html, body {
	
	margin:0 0 0 0;
	padding:0 0 0 0;
}
 
#glassbox {
   	background:#333;
    border:1px solid #000;
    height:400px;
    margin:30px auto auto auto;
    position:relative;
    width:960px;
    -moz-border-radius: 10px;
    -webkit-border-radius: 10px;    
}
 
.element {
    background:#666;
    border:1px #000 solid;
    cursor:move;
    height:143px;
    padding:10px 10px 10px 10px;
    width:202px;
    -moz-border-radius: 10px;
    -webkit-border-radius: 10px;
}

#respond{
    color:#fff;
    margin:0 auto 0 auto;
    width:960px;    
}
</style>

 <script type="text/javascript">
/*
 $(document).ready(function() {
 	var sPositions = localStorage.positions || "{}",
  positions = JSON.parse(sPositions);

 	$('[id^="element"]').each(function() {
        $(this).draggable({ 
                containment: '#glassbox', 
                scroll: false
         }).mousemove(function(){
                var coord = $(this).position();
                $("p:last").text( "left: " + coord.left + ", top: " + coord.top );
                //alert($(ui.draggable).attr("id")); 
         }).mouseup(function(){ 
                var coords=[];
                var coord = $(this).position();

                var item={ coordId: (this.id) , coordTop:  coord.left, coordLeft: coord.top  };
                coords.push(item);
                var order = { coords: coords };

                $.post('core/updatecoords.php', 'data='+JSON.stringify(order), function(response){
         				alert(JSON.stringify(order));
                        if(response=="success")
                            $("#respond").html('<div class="success">X and Y Coordinates Saved!</div>').hide().fadeIn(1000);
                            setTimeout(function(){ $('#respond').fadeOut(1000); }, 2000);
                        }); 
                });
                         
        });
 });
*/
 $(document).ready(function() {

var sPositions = localStorage.positions || "{}",
    positions = JSON.parse(sPositions);

$.each(positions, function (id, pos) {
    $("#" + id).css(pos)
})
$('[id^="element"]').draggable({
	
    containment: "#glassbox",
    scroll: false,
    stop: function (event, ui) {
        positions[this.id] = ui.position
        localStorage.positions = JSON.stringify(positions)
        alert(JSON.stringify(positions))

 		var order = { positions: positions };

        $.post('core/updatecoords.php', 'data='+JSON.stringify(positions), function(response){
		alert(response);
        if(response=="success")
            $("#respond").html('<div class="success">X and Y Coordinates Saved!</div>').hide().fadeIn(1000);
            setTimeout(function(){ $('#respond').fadeOut(1000); }, 2000);
        }); 
    }
});
    });
/*
 
    $(document).ready(function() {
        $("#element").draggable({ 
                containment: '#glassbox', 
                scroll: false
         }).mousemove(function(){
                var coord = $(this).position();
                $("p:last").text( "left: " + coord.left + ", top: " + coord.top );
         }).mouseup(function(){ 
                var coords=[];
                var coord = $(this).position();
                var item={ coordTop:  coord.left, coordLeft: coord.top  };
                coords.push(item);
                var order = { coords: coords };

                $.post('core/updatecoords.php', 'data='+JSON.stringify(order), function(response){
         				alert(JSON.stringify(order));
                        if(response=="success")
                            $("#respond").html('<div class="success">X and Y Coordinates Saved!</div>').hide().fadeIn(1000);
                            setTimeout(function(){ $('#respond').fadeOut(1000); }, 2000);
                        }); 
                });
                         
        });

        

*/
</script>      
</head>

<body>
	    <div id="glassbox">
<?php
        //Create a query to fetch our values from the database  
        $get_coords = mysqli_query($conn, "SELECT * FROM coords");
        //We then set variables from the * array that is fetched from the database
        while($row = mysqli_fetch_array($get_coords)) {
            $x = $row['x_pos'];
            $y = $row['y_pos'];
            $id = $row['id'];


            //then echo our div element with CSS properties to set the left(x) and top(y) values of the element
            echo '<div id="element_'.$id.'" class="element" style="left:'.$x.'px; top:'.$y.'px;"><img style="height:100px; width:100px;" src="1.jpg" alt="Nettuts+" />Move the Box<p></p></div>';

           // echo '<p>'.$id.' '.$x.' ''</p>';
           
        }           
?>
    </div>
 
    <div id="respond"></div>
</body>
</html>
