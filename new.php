<!DOCTYPE html>
<html>
<head>

 <script
        src="https://code.jquery.com/jquery-3.1.1.js"
        integrity="sha256-16cdPddA6VdVInumRGo6IbivbERE8p7CQR3HzTBuELA="
        crossorigin="anonymous"></script>

  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">



</head>

<body>
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbarCollapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <a class="navbar-brand" href="/index.php">MyBrand</a>
            </div>

            <div class="collapse navbar-collapse navbarCollapse">
                <ul class="nav navbar-nav navbar-right">
                    <li class="active">
                        <a href="/index.php">Home</a>
                    </li>

                    <li>
                        <a href="#"> Links</a>
                    </li>

                    <li>
                        <a href="#">About</a>
                    </li>
                    <li>
                        <a href="#">Contact</a>
                    </li>

                    <li>
                        <a href="#">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

<div id="links">Links</div>

    <script type="text/javascript">
  $(".nav a").on("click", function(){
   $(".nav").find(".active").removeClass("active");
   $(this).parent().addClass("active");
});
</script>
</body>
</html>
