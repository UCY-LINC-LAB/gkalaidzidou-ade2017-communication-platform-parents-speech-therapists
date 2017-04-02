<?php
include 'core/init.php';
session_start(); 

if($_SESSION['exercise_id']!=null){
  $exe=mysqli_query($conn,"SELECT * FROM exercise WHERE exercise_id='".$_SESSION['exercise_id']."' ");
  $exercise_info= mysqli_fetch_array($exe);

  $get_folder_id= mysqli_query($conn,"SELECT * FROM folder WHERE folder_id='".$_SESSION['folder_id']."' ");
    if(mysqli_num_rows($get_folder_id) > 0 ){   
        $folder_info =  mysqli_fetch_array($get_folder_id);
    }
}
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



  <!--Search and select option in modal-->
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
  <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>

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
     
      padding: 1em; 
      float:left;
    } 
    .drop_area{
       border:1px solid #f0f0f0;
    height:400px;
    position:relative;



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

          
             var newID= $(ui.draggable).attr('id') +"_"+counter;
             alert(newID);
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
    <button type="button" class="btn btn-xs left-block" style="background-color: transparent;" data-toggle="modal" data-target="#newFolder"><i class="fa fa-plus" aria-hidden="true"></i> Νέα Άσκηση</button>
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
                  <h2> <i class="fa fa-angle-right" aria-hidden="true"></i> <a href="www.google.com"><?php echo $list_f['ex_name'] ?></a> </h2>
              <?php } ?>
      <?php } ?>
       </div>
    </aside>

    </div>

    <div class="center" >
      <div>
        <h4><?php echo $folder_info['name'];?> <i class="fa fa-angle-right" aria-hidden="true"></i> <?php echo $exercise_info['ex_name'];?></h4>
      </div>

      <div id="droppable" class="drop_area" style=" position: relative;">
      <!--  <div id="trash"><span class="glyphicon glyphicon-trash"></div>-->

      <?php
        //Create a query to fetch our values from the database  
        $get_coords = mysqli_query($conn, "SELECT * FROM assets_of_exercise as ex, asset as a where ex.exercise_id='".$_SESSION['exercise_id']."' 
          and a.asset_id=ex.asset_id");
        //We then set variables from the * array that is fetched from the database
        while($row = mysqli_fetch_array($get_coords)) {
            $x = $row['x_pos'];
            $y = $row['y_pos'];
            $id = $row['asset_id'];

             echo ($x ."  " . $y . " " . $id . "  # " );


            //then echo our div element with CSS properties to set the left(x) and top(y) values of the element
            //echo '<div id="element_'.$id.'" class="element" style="left:'.$x.'px; top:'.$y.'px;"><img style="height:100px; width:100px;" src="1.jpg" alt="Nettuts+" />Move the Box<p></p></div>';

            echo '<img style="left:'.$x.'px; top:'.$y.'px; position:absolute; margin:auto;" class="assetImage" src="'.$row['path']. '" id="element_'.$row['asset_id'].'" draggable="true" />';
          
        }?>


      
      </div>


      <div class="row" style="margin: 10px; float: right;">
        <input onclick="saveFun()" class="btn btn-success btn-sm" value="Αποθήκευση">
      </div>

    </div>

    <div class="right">
      <div class="row" style="margin-left: 1px;">
      <h4>Βιβλιοθήκη</h4>
      
        
      </div>
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
          <h5 class="modal-title"><b>Δημιουργία άσκησης</b></h5>
        </div>
        <div class="modal-body">
          <div class="row" style="margin-bottom: 10px;">
              <label  class="col-sm-6"  style="margin-bottom: 10px;" for="title">Τίτλος </label>
              <div class="col-sm-6">
                  <input type="text" class="form-control" id="exer_title" placeholder="" name="exer_title" value="new_exer" required/> 
              </div>
          </div>
          <div class="row">
             <label  class="col-sm-4"  style="margin-bottom: 10px;" for="title">Κατάλογος </label>  
             <div class="col-sm-2">
             <button type="button" class="btn btn-xs" style="background-color: transparent;" onclick="displayCreateFolderDiv();">
             <i class="fa fa-plus" aria-hidden="true"></i></button>   
             </div>      
             <div class="col-sm-6" >
                <select  onchange="" name="folder_id" class="selectpicker" data-style="" data-width="100%" data-show-subtext="true" data-live-search="true" > 

                <?php 

                  $folders = mysqli_query($conn,"SELECT * FROM folder as f where f.therapist_id='".$therapist_id."' ORDER BY f.name");

                  if (!$folders) {
                    die('Invalid query: ' . mysqli_error($conn));
                  }

                while ($foldersList = mysqli_fetch_array($folders)) { ?>
                
                <option value="<?php echo $foldersList['folder_id'];?>"  >
                <?php echo $foldersList['name'];?></option>
                <?php } ?>
                </select>  
            </div>
          </div>
          
          <div class="row" style="margin-bottom: 10px;" id="newFold" hidden="">
            <hr>
            <label  class="col-sm-6"  style="margin-bottom: 10px;" for="title" >Δημιουργία Καταλόγου</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" placeholder="" name="newFolder_title" value=""/> 
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <div>
              <input type="submit" class="btn btn-success btn-sm" value="Δημιουργία">
          </div>
        </div>
        </form>
      </div>
      
    </div>
  </div>
  
   <script type="text/javascript">
     function displayCreateFolderDiv(){

      var div = document.getElementById('newFold');

      if(div.style.visibility == false){
        div.style.display = 'block';
      }
      else{
       div.style.display = 'none';
      }
     }
   </script>


</body>
</html>
