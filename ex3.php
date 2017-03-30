<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Layout</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <link rel="stylesheet" href="../themes/default/css/test4.css" type="text/css" charset="utf-8"/>
    <script src="../themes/default/js/layout.js"></script>

    <style type="text/css">
      #element {background:#666;border:1px #000 solid;cursor:move;height:110px;width:110px;padding:10px 10px 10px 10px;}
#snaptarget { height:610px; width:1000px;}
.draggable { width: 90px; height: 80px; float: left; margin: 0 0 0 0; font-size: .9em; }
.wrapper
{ 
background-image:linear-gradient(0deg, transparent 24%, rgba(255, 255, 255, .05) 25%, rgba(255, 255, 255, .05) 26%, transparent 27%, transparent 74%, rgba(255, 255, 255, .05) 75%, rgba(255, 255, 255, .05) 76%, transparent 77%, transparent), linear-gradient(90deg, transparent 24%, rgba(255, 255, 255, .05) 25%, rgba(255, 255, 255, .05) 26%, transparent 27%, transparent 74%, rgba(255, 255, 255, .05) 75%, rgba(255, 255, 255, .05) 76%, transparent 77%, transparent);
height:100%;
background-size:45px 45px;
border: 1px solid black;
background-color: #434343;
margin: 20px 0px 0px 20px;
}
    </style>

    <script type="text/javascript">
      $(function() 
  {
    $('[id^="element"]').draggable({ snap: ".ui-widget-header",grid: [ 1, 1 ]});
  });
    $(document).ready(function() {
        $('[id^="element"]').draggable({ 
                containment: '#snaptarget', 
                scroll: false
         }).mousemove(function(){
                var coord = $(this).position();
                var width = $(this).width();
               var height = $(this).height();
                $("p.position").text( "(" + coord.left + "," + coord.top + ")" );
                $("p.size").text( "(" + width + "," + height + ")" );
         }).mouseup(function(){
                var coord = $(this).position();
                var width = $(this).width();
                var height = $(this).height();
                $.post('/test/layout_view.php', {x: coord.left, y: coord.top, w: width, h: height});
               
                });
        });
    </script>
  </head>
<body>
    <div id="snaptarget" class="wrapper">
        <div id="element" class="draggable ui-widget-content">
          <p class="position"></p>
          <p class="size"></p>
        </div>
    </div> 
    <div></div>
</body>
</html>