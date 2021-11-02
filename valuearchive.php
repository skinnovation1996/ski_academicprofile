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
$row=mysqli_fetch_assoc($sqla);
$super_owner = $row['admin_id'];
$user_name = $row['admin_name'];
$thismonth = date('m');
$thisyear = date('Y');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Value Archive - <?php echo $user_name;?> - Academic Profile Management</title>
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
  <link rel="stylesheet" href="assets/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="assets/vendor/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="assets/vendor/datatables.net-select-bs4/css/select.bootstrap4.min.css">

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

  <!-- ======= Mobile nav toggle button ======= -->
  <button type="button" class="mobile-nav-toggle d-xl-none"><i class="icofont-navigation-menu"></i></button>

  <!-- ======= Header ======= -->
  <header id="header">
    <div class="d-flex flex-column">

    <div class="profile">
        <img src="kalai_panel/uploads/admins/<?php echo $super_owner;?>/<?php echo $profile_pic = $row['profile_pic'];?>" alt="" class="img-fluid rounded-circle">
        <h1 class="text-light"><a href="index2.php?userid=<?php echo $userid;?>"><?php echo $user_name;?></a></h1>
        <div class="social-links mt-3 text-center">
          <a href="<?php echo $row['twitter'];?>" target="_new" class="twitter"><i class="bx bxl-twitter"></i></a>
          <a href="<?php echo $row['facebook'];?>" target="_new" class="facebook"><i class="bx bxl-facebook"></i></a>
          <a href="<?php echo $row['instagram'];?>" target="_new" class="instagram"><i class="bx bxl-instagram"></i></a>
          <a href="<?php echo $row['linkedin'];?>" target="_new" class="linkedin"><i class="bx bxl-linkedin"></i></a>
        </div>
    </div>

      <nav class="nav-menu">
        <h2 class="text-light">Value Archive</h2>
        <ul>
          <li><a href="index2.php?userid=<?php echo $userid;?>"><i class="bx bx-home"></i> <span>Back to Home</span></a></li>
        </ul>
      </nav><!-- .nav-menu -->
      <button type="button" class="mobile-nav-toggle d-xl-none"><i class="icofont-navigation-menu"></i></button>

    </div>
  </header><!-- End Header -->

  <main id="main">
    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Value Archive</h2>
          <ol>
            <li><a href="index2.php?userid=<?php echo $userid;?>">Home</a></li>
            <li>Value Archive</li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Value Archive Section ======= -->
    <section id="valuearchive" class="about">
      <div class="container">

        <div class="section-title">
          <h2>Value Archive</h2>
        </div>

        <div class="row">
            <table id="tlist" class="table table-hover table-striped" data-aos="fade-up">
                <thead>
                    <th width="5%" style="text-align:center">No</th>
                    <th width="70%" style="text-align:center">Title</th>
                    <th width="15%" style="text-align:center">Date</th>
                </thead>
                <tbody>
                    <?php
                    $valueSQL = mysqli_query($conn, "SELECT * from tbl_value WHERE super_owner='$super_owner' ORDER BY value_date DESC");
                    $rows = mysqli_num_rows($valueSQL);
                        
                    if($rows){
                        $count = 1;
                        while($row=mysqli_fetch_array($valueSQL)){
                            $id = $row['id'];
                    ?>
                    <tr>
                        <td><?php echo $count++;?></td>
                        <td><a href="#value" onclick="window.open('valueinfo.php?id=<?php echo $id;?>&userid=<?php echo $userid;?>','_blank','height=800,width=800,top=25,left=25,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');"><b><?php echo $row['value_title'];?></b></a></td>
                        <td><?php echo date_format(new DateTime($row['value_date']), "d M Y h:i:sa");?></td>
                    </tr>
                    <?php } }else{ echo "<tr><td colspan='3'>No values available</td></tr>";} ?>
                </tbody>
            </table>
        </div>

      </div>
    </section><!-- End About Section -->
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="container">
      <div class="copyright">
        &copy; 2021 <strong><span>Academic Profile Management</span></strong>
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/iportfolio-bootstrap-portfolio-websites-template/ -->
        Theme iPortfolio designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>
  </footer><!-- End  Footer -->

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

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
  <script src="assets/vendor/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="assets/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="assets/vendor/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
  <script src="assets/vendor/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
<script src="assets/vendor/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="assets/vendor/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="assets/vendor/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="assets/vendor/datatables.net-select/js/dataTables.select.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  <script>
    $(document).ready(function(){
        $('#tlist').DataTable({
            pageLength: 10
        });
    });
    </script>

</body>

</html>