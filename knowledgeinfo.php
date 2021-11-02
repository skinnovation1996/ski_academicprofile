<?php
include("assets/php/connectdb.php");
date_default_timezone_set("Asia/Kuala_Lumpur");
$time = date("h:i:sa");
$date = date("d-m-Y");
if(empty($_GET['userid'])){
	header('location:index.php');
}
else{
	$userid = $_GET['userid'];
}

$sqla = mysqli_query($conn, "SELECT * from tbl_admin WHERE id='$userid' AND admin_id NOT LIKE 'super_admin'"); 
$rows = mysqli_num_rows($sqla);

//Invalid id? Go back to index.php
if($rows != 1){
    header('location:index.php');
}
$rowa=mysqli_fetch_assoc($sqla);
$super_owner = $rowa['admin_id'];

$thismonth = date('m');
$thisyear = date('Y');
if(empty($_GET['id'])){
	header('location:index.php');
}
else{
	$sqlgetid = $_GET['id'];
}

$sqla = mysqli_query($conn, "SELECT * from tbl_knowledge WHERE id='$sqlgetid' AND super_owner='$super_owner'"); 
$rows = mysqli_num_rows($sqla);

//Invalid id? Go back to index.php
if($rows != 1){
    header('location:index.php');
}

$row=mysqli_fetch_assoc($sqla);
$theme = $row['knowledge_theme'];
$title = $row['knowledge_title'];
$notes = $row['knowledge_notes'];
$date = strtotime($row['knowledge_date']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Knowledge Info - Academic Profile Management</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: iPortfolio - v1.5.1
  * Template URL: https://bootstrapmade.com/iportfolio-bootstrap-portfolio-websites-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>
<body>
    <main id="main">
        <!-- ======= Knowledge Info Section ======= -->
        <section id="knowledgeinfo" class="about">
        <div class="container">

            <div class="section-title">
                <h2>Knowledge Details</h2>
            </div>

            <div class="row">
                <div class="col-lg-12 pt-4 pt-lg-0 content" data-aos="fade-left">
                    <h2><?php echo $title;?></h2>
                    <h3>Theme: <?php echo $theme;?></h3>
                    <h4>Date: <?php echo date('j F Y',$date);?></h4>
                    <p class="font-italic"><?php echo $notes;?></p>
                </div>
                
            </div>
            <button class="btn btn-danger" onclick="window.close()">Close</button>
        </div>
        </section><!-- End About Section -->
    </main><!-- End #main -->

  <!-- Vendor JS Files -->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="assets/vendor/counterup/counterup.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/venobox/venobox.min.js"></script>
  <script src="assets/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="assets/vendor/typed.js/typed.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>