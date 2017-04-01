<?php
include 'core/init.php';
session_start(); 

//if ( $_SESSION['logged_in'] != true){
 // header('Location: e-login.php');
//}

$therapist_id='1';//$_SESSION["user_ID"];

?>
<!DOCTYPE html>
<html>
<head>
  <title>logoucon | ασκήσεις</title>
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


<!--<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.no-icons.min.css" rel="stylesheet">-->
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

<!--folder menu-->
<link href='http://fonts.googleapis.com/css?family=News+Cycle:400,700' rel='stylesheet' type='text/css'>
<link href="http://fonts.googleapis.com/css?family=Lobster" rel="stylesheet" type="text/css">

  <style type="text/css">
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

    @media screen and (min-width: 768px) {
      #newFolder .modal-dialog  {width:300px;}
}
    #newFolder {
    top:20%;
    outline: none;
    }

  </style>

  <style type="text/css">
    * {
  margin: 0; padding: 0;
}
body {
  font-size: 100%;
}
.accordion {
  width: auto;
}
.accordion h1, h2, h3, h4 {
  cursor: pointer;
}
.accordion h1,h2, h3, h4 {
  font-family: "News Cycle";
}
.accordion h1 {
  background-color: transparent;
  font-size: 1.5rem;
  font-weight: normal;
  color: black;/*#1abc9c;*/
}
.accordion h1:hover {
  color: #378006;
}
.accordion h1:first-child {
  border-radius: 10px 10px 0 0;
}
.accordion h1:last-of-type {
  border-radius: 0 0 10px 10px;
}
.accordion div, .accordion p {
  display: none;
}
.accordion h2 {
  padding: 0px 25px;
  background-color: transparent;
  font-size: 1.1rem;
  color: #333;
}
.accordion h2:hover {
  color: #378006;
}
.accordion h3 {
  padding: 0px 30px;
  background-color: transparent;
  font-size: .9rem;
  color: #333; 
}
.accordion h3:hover {
  color: #378006;
}
.accordion h4 {
  padding: 5px 35px;
  background-color: transparent;
  font-size: .9rem;
  color: #af720a; 
}
.accordion h4:hover {
  color: #e0b040;
}
.accordion p {
  padding: 15px 35px;
  background-color: transparent;
  font-family: "Georgia";
  font-size: .8rem;
  color: #333;
  line-height: 1.3rem;
}



  </style>

  <script type="text/javascript">

    var positions =[];
    var flag=0;

    $(function() {
      counter=0;

    $('[id^="element"]').draggable({
        revert: "invalid",  
        helper: "clone",
        containment: '#droppable',
        cursor : "move",
        scroll: false,
        //When first dragged 
        stop: function (ev, ui) {
          counter++;
        }
    });   

    $("#droppable").droppable({
        accept:'[id^="element"]',
        activeClass: "ui-state-default",
        hoverClass: "ui-state-hover",
        drop: function(event, ui) {
             var newClone= $(this).append($(ui.helper).clone().draggable({
                  containment: "parent",
                  cursor: "move",
                  stop: handleDragStop
              }));
             var newID= "element_"+counter;
              $(newClone).attr('id', newID);

              //var draggable = ui.draggable;
              positions.push({id: newClone.attr('id'), left:  parseInt( ui.offset.left ) , top: parseInt( ui.offset.top )});
              
              function handleDragStop( event, ui ) {
                var offsetXPos = parseInt( ui.offset.left );
                var offsetYPos = parseInt( ui.offset.top );
                //alert( "Drag stopped!\n\nOffset: (" + offsetXPos + ", " + offsetYPos +  draggable.attr('id') + ")\n");
                flag=0;

                $.each(positions, function() {
                  if (this.id == newClone.attr('id')) {
                      this.top = offsetYPos;
                      this.left = offsetXPos;
                      flag=1;
                  }
              });

                if(flag==0)
                   positions.push({id: newClone.attr('id'), left: offsetXPos , top: offsetYPos});           
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
    alert(JSON.stringify(positions));

    $.post('core/updatecoords.php', 'data='+JSON.stringify(positions), function(response){
    alert(response);
        //if(response=="success")
          //  $("#respond").html('<div class="success">X and Y Coordinates Saved!</div>').hide().fadeIn(1000);
           // setTimeout(function(){ $('#respond').fadeOut(1000); }, 2000);
        }); 
}
  </script>

</head>

<body>
  <?php include_once('navbar.php');?>

  <div class="container">
    <div class="left"  style="clear: both">
    <!--
      <div id="trash"><span class="glyphicon glyphicon-trash"> <b>Διαγραφή</b>
      </div>
       <input type="button" value="Click me" id="press" onclick="saveFun()" >
       -->
    <button type="button" class="btn btn-xs left-block" style="background-color: transparent;" data-toggle="modal" data-target="#newFolder"><i class="fa fa-plus" aria-hidden="true"></i> Νέος Φάκελος</button>
    <hr>
    <aside class="accordion">
       <?php 
          $folders = mysqli_query($conn,"SELECT * FROM folder as f, exercise as e where f.therapist_id='".$therapist_id."' and e.folder_id=f.folder_id  ORDER BY f.folder_id");

          if (!$folders) {
            die('Invalid query: ' . mysqli_error($conn));
          }

          $prev="a";
          $first_time="1";

          while ($list_f = mysqli_fetch_array($folders)) {
            if($prev!=$list_f['folder_id']){
              if($first_time=="0"){ ?>
                </div>
              <?php } 
              $first_time="0";?>
              <h1><i class="fa fa-folder" aria-hidden="true"></i> <?php echo $list_f['name']; ?></h1>
               <div>
              <h2> <i class="fa fa-angle-right" aria-hidden="true"></i> <a href="www.google.com"><?php echo $list_f['ex_name'] ?></a> </h2>
              <?php $prev=$list_f['folder_id']; }else{ ?>
                  <h2> <a href="www.google.com"><?php echo $list_f['ex_name'] ?></a> </h2>
              <?php } ?>
      <?php } ?>
       </div>
    </aside>

    </div>

    <div class="center" id="droppable"></div>

    <div class="right">
      <!--<div class="row"><b>Βιβλιοθήκη</b></div>-->
      <div class="scrollStyle" id="library">
       <?php 
          $assets = mysqli_query($conn,"SELECT * FROM asset");

          if (!$assets) {
            die('Invalid query: ' . mysql_error());
          }

          while ($list = mysqli_fetch_array($assets)) {?>
            <img class="assetImage" src="<?php echo $list['path']?>" id="element_<?php echo $list['asset_id']?>" draggable="true"/>
      <?php } ?>
      </div>
    </div>

  </div>




<script type="text/javascript">
    var headers = ["H1","H2","H3","H4","H5","H6"];

$(".accordion").click(function(e) {
  var target = e.target,
      name = target.nodeName.toUpperCase();
  
  if($.inArray(name,headers) > -1) {
    var subItem = $(target).next();
    
    //slideUp all elements (except target) at current depth or greater
    var depth = $(subItem).parents().length;
    var allAtDepth = $(".accordion p, .accordion div").filter(function() {
      if($(this).parents().length >= depth && this !== subItem.get(0)) {
        return true; 
      }
    });
    //$(allAtDepth).slideUp("fast");
    
    //slideToggle target content and adjust bottom border if necessary
    subItem.slideToggle("fast",function() {
        $(".accordion :visible:last").css("border-radius","0 0 10px 10px");
    });
    $(target).css({"border-bottom-right-radius":"0", "border-bottom-left-radius":"0"});
  }
});
  </script>



  <!-- Modal -->
  <div class="modal fade" id="newFolder" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content" tabindex="-1">
       <form role="form"  action="core/create_folder.php" method="POST" class="form-horizontal">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Νέος Κατάλογος</h4>
        </div>
        <div class="modal-body">
          <div class="row">
              <label  class="col-sm-6"  style="margin-bottom: 10px;" for="title">Όνομα </label>
              <div class="col-sm-6">
                  <input type="text" class="form-control" id="folder_title" placeholder="" name="folder_title" value="new_folder" required/> 
              </div>
          </div>
        </div>
        <div class="modal-footer">
            <div>
                <input type="submit" class="btn" value="Δημιουργία">
            </div>
        </div>
        </form>
      </div>
      
    </div>
  </div>
  



</body>
</html>
