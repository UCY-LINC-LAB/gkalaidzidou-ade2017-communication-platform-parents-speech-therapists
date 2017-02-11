<!DOCTYPE html>
<html>
<head>
 
<style>
.navbar {
  background-color: #ebebeb !important; 

  border-color: transparent; 
  border-radius: 0%;
  box-shadow: 0 0 6px 3px rgba(0,0,0,.35);
   
}
/** Default navbar **/
.navbar-default .navbar-nav>li>a { 
  padding-top: 25px; 
  padding-bottom: 25px; 
  min-height: 69px; 
  color: black;
}
.navbar-default .navbar-nav > li > a:hover {color: #DDBE42;}
.navbar-default .navbar-nav > .active > a,
.navbar-default .navbar-nav > .active > a:hover,
.navbar-default .navbar-nav > .active > a:focus {
  background-color: transparent;
  color: #DDBE42;
}
.navbar-default .navbar-nav > .open > a,
.navbar-default .navbar-nav > .open > a:hover,
.navbar-default .navbar-nav > .open > a:focus {
 /* background-color: transparent;*/
  color: #DDBE42;
}
.navbar-default .navbar-nav .open .dropdown-menu {
  background-color: #ebebeb !important;
}
.navbar-default .navbar-nav .open .dropdown-menu > li > a{
  color: #1e1e15 !important;
  padding: 12px 12px 12px 12px !important;
}
.navbar-default .navbar-nav .open .dropdown-menu > li > a:hover,
.navbar-default .navbar-nav .open .dropdown-menu > li > a:focus {
  color: #DDBE42 !important;
  /*background-color: transparent !important;*/
}
.navbar-default .navbar-nav .open .dropdown-menu > .active > a,
  .navbar-default .navbar-nav .open .dropdown-menu > .active > a:hover,
  .navbar-default .navbar-nav .open .dropdown-menu > .active > a:focus {
    color: #DDBE42 !important;
    background-color: transparent !important;
  }

.navbar-default .navbar-toggle:hover,
.navbar-default .navbar-toggle:focus {
 /* border-color: transparent;
  background-color: transparent;*/
}
.navbar-form { padding-top: 10px !important;}
.navbar-text { margin-top: 25px; }
.navbar-default .navbar-text { color: #CBAF3B;}
.navbar-default .navbar-brand {
  font-size: 21px;
  color: #CBAF3B;
  margin-top: 10px;
}
.navbar-default .navbar-brand:hover,
.navbar-default .navbar-brand:focus {
  color: #DDBE42;
}
.img-circle {
    border-radius: 50%;
  }
@media (min-width: 979px) {
  ul.nav li.dropdown:hover > ul.dropdown-menu {
    display: block;
    background-color: #ebebeb !important;
    border: none;
    box-shadow: 0 6px 3px rgba(0,0,0,.35);
  }
} 
</style>
<script >
  $('.navbar-nav li').click(function(e) {
    alert(5);
    $('.navbar-nav li.active').removeClass('active');
    var $this = $(this);

    if (!$this.hasClass('active')) {
        $this.addClass('active');

    }
    e.preventDefault();
});
</script>

</head>

<body>
<nav class="navbar navbar-default">
      <div class="container">
        <div class="navbar-header" style="margin-right: 10px;">
          <!--<a href=""><img style="height:65px; width: 130px;" src="img/logo.png" style=""></a>-->
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Menu</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div id="navbar" class="collapse navbar-collapse" >
          <ul class="nav navbar-nav">
            <li ><a href="home.php"><b>ΗΜΕΡΟΛΟΓΙΟ</b></a></li>
            <li ><a href="parent.php"><b>ΕΓΓΕΓΡΑΜΜΕΝΟΙ</b></a>
              <!--<ul class="dropdown-menu">
                <li><a href="#">Εμφάνιση καταλόγου</a></li>
                <li><a href="#">Προσθήκη νέου</a></li>
              </ul>-->
            </li>
            <li class="dropdown">
              <a href="history_details.php"><b>ΙΣΤΟΡΙΚΑ</b></a>
              <!--<ul class="dropdown-menu">
                <li><a href="#">Εμφάνιση καταλόγου</a></li>
                <li><a href="#">Προσθήκη νέου</a></li>
              </ul>-->
            </li>
            <!--
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><b>ΙΣΤΟΡΙΚΑ</b></a>
              <ul class="dropdown-menu">
                <li><a href="history.php">Εμφάνιση</a></li>
                <li><a href="#">Προσθήκη</a></li>
              </ul>
            </li>-->
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><b>ΑΣΚΗΣΕΙΣ</b></a>
              <ul class="dropdown-menu">
                <li><a href="#">Εμφάνιση</a></li>
                <li><a href="#">Δημιουργία νέου</a></li>
              </ul>
            </li>
          </ul>

          <ul class="nav navbar-nav navbar-right">
          <li><a href=""> <span class="glyphicon glyphicon-bell" style="font-size: 15px; border-radius: 50%; border: 1px solid rgb(205, 209, 215); padding: 5px;"></span> </a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
              <img style='height: 20px; width: 20px;' class="img-circle" src="img/profile.jpg">
              <b>Μαρία Ιακώβου</b><span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#"> <span class="glyphicon glyphicon-log-out"></span> Ρυθμίσεις</a></li>
                <li><a href="login.php"><span class="glyphicon glyphicon-cog"></span> Έξοδος</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
</body>
</html>
