<?php
include("assets/php/connectdb.php");
date_default_timezone_set("Asia/Kuala_Lumpur");
$time = date("h:i:sa");
$date = date("d-m-Y");
$thismonth = date('m');
$thisyear = date('Y');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Academic Profile Management</title>
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

      <div class="profile"><br><br>
        <h1 class="text-light"><a href="index.php">Academic Profile Management System<br>Main Menu</a></h1>
      </div>

      <nav class="nav-menu">
        <ul>
          <li class="active"><a href="index.php"><i class="bx bx-home"></i> <span>Home</span></a></li>
        </ul>
      </nav><!-- .nav-menu -->
      <button type="button" class="mobile-nav-toggle d-xl-none"><i class="icofont-navigation-menu"></i></button>

    </div>
  </header><!-- End Header -->


  <main id="main">

  <!-- ======= About Section ======= -->
  <section id="about" class="about">
      <div class="container">

        <div class="section-title">
          <h2>About</h2>
        </div>

        <div class="row">
          <div class="col-lg-12 pt-4 pt-lg-0 content" data-aos="fade-left">
            <h3>About Academic Profile Management System</h3>
            <p class="font-italic">
              This system is used by the academic lecturers, consultants, academic supervisors and students around the world to manage their academic information, 
              publications, contributions and research related information.<br>
            </p>
            </div>
          </div>
        </div>

      </div>
    </section><!-- End About Section -->

    <!-- ======= List Of Profile Section ======= -->
    <section id="listprofile" class="skills section-bg">
      <div class="container">

        <div class="section-title">
          <h2>Profile List</h2>
        </div>

        <div class="row">
            <table id="tlist" class="table table-hover table-striped" data-aos="fade-up">
                <thead>
                    <th width="5%" style="text-align:center">No</th>
                    <th width="10%" style="text-align:center">Photo</th>
                    <th width="60%" style="text-align:center">Name</th>
                    <th width="10%" style="text-align:center">Role</th>
                    <th width="10%" style="text-align:center">Institution</th>
                </thead>
                <tbody>
                    <?php
                    $courseSQL = mysqli_query($conn, "SELECT * FROM tbl_admin WHERE admin_id NOT LIKE 'super_admin'");
                    $rows = mysqli_num_rows($courseSQL);
                        
                    if($rows){
                        $count = 1;
                        while($row=mysqli_fetch_array($courseSQL)){
                            $superOwner = $row['admin_id'];
                    ?>
                    <tr>
                        <td><?php echo $count++;?></td>
                        <td><?php if($row['profile_pic'] != NULL){ ?>
                            <img class="img" src="kalai_panel/uploads/admins/<?php echo $superOwner;?>/<?php echo $row['profile_pic'];?>" style="width: 75%; border: 1px solid gray" />
                        <?php }else{ ?>
                            <img class="img" src="kalai_panel/assets/img/default-avatar.png" style="width: 50%; border: 1px solid gray" />
                        <?php } ?></td>
                        <td><h3><a href="index2.php?userid=<?php echo $row['id'];?>"><?php echo $row['admin_name'];?></a></h3></td>
                        <td><?php $row['role'];?></td>
                        <td><?php echo $row['university'];?></td>
                    </tr>
                    <?php } } ?>
                </tbody>
            </table>
        </div>
    </div>

    </section><!-- End Knowledge Section -->

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