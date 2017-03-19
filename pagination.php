    <?php include 'core/init.php';
session_start(); 

//if ( $_SESSION['logged_in'] != true){
 // header('Location: e-login.php');
//}

$therapist_id='1';//$_SESSION["user_ID"];?>
    <html>
    <head>
<script src="//code.jquery.com/jquery-2.0.3.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
<script src="//raw.github.com/botmonster/jquery-bootpag/master/lib/jquery.bootpag.min.js"></script>
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">


    </head>
    <body>

<?php
// Requested page
$requested_page = isset($_GET['page']) ? intval($_GET['page']) : 1;

// Get the product count
$r = mysqli_query($conn,"SELECT COUNT(*) FROM patient WHERE therapist_id='1'");
$d = mysqli_fetch_row($r);
$product_count = $d[0];

$products_per_page = 2;

// 55 products => $page_count = 3
$page_count = ceil($product_count / $products_per_page);

// You can check if $requested_page is > to $page_count OR < 1,
// and redirect to the page one.

$first_product_shown = ($requested_page - 1) * $products_per_page;

// Ok, we write the page links  
echo '<p>';
for($i=1; $i<=$page_count; $i++) {
    if($i == $requested_page) {
        echo $i;
    } else {
        echo '<a href="pagination.php?page='.$i.'">'.$i.'</a> ';
    }
}
echo '</p>';

// Then we retrieve the data for this requested page
$r = mysqli_query($conn,"SELECT * FROM patient WHERE therapist_id='1' LIMIT $first_product_shown, $products_per_page");

while($d = mysqli_fetch_assoc($r)) {
    //var_dump($d);
  echo $d['patient_id'];
}
?>
    </body>
    </html>