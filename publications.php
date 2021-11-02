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

  <title>Publications - <?php echo $user_name;?> - Academic Profile Management</title>
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
        <h2 class="text-light">Publications</h2>
        <ul>
          <li><a href="index2.php?userid=<?php echo $userid;?>"><i class="bx bx-home"></i> <span>Back to Home</span></a></li>
          <li class="active"><a href="#journals"><i class="bx bx-envelope"></i> Journals</a></li>
          <li><a href="#proceedings"><i class="bx bx-user"></i> <span>Proceedings</span></a></li>
          <li><a href="#bookchapters"><i class="bx bx-file-blank"></i> <span>Book Chapters</span></a></li>
          <li><a href="#books"><i class="bx bx-server"></i> Books</a></li>
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
          <h2>Publications</h2>
          <ol>
            <li><a href="index2.php?userid=<?php echo $userid;?>">Home</a></li>
            <li>Publications</li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Publications Section ======= -->
    <section id="journals" class="about">
      <div class="container">

        <div class="section-title">
          <h2>Journals</h2>
        </div>

        <div class="row">
            <?php
                $sqlyear = mysqli_query($conn, "SELECT distinct journal_year FROM tbl_journals WHERE journal_owner='$super_owner' AND super_owner='$super_owner' ORDER BY journal_year DESC");
                $yearrows = mysqli_num_rows($sqlyear);
                while($yearrow = mysqli_fetch_array($sqlyear)){

                    $i = 0;
                    $journalyear = $yearrow['journal_year'];
                    echo "<h3>". $journalyear ."</h3></br>";
                    echo "<ol>";
                    $journalsql = mysqli_query($conn, "SELECT * FROM tbl_journals WHERE journal_year=$journalyear AND journal_owner='$super_owner' AND super_owner='$super_owner'");
                    $journalrows = mysqli_num_rows($journalsql);

                    while($journalrow = mysqli_fetch_array($journalsql)){
                        $i++;
                        $authors = $journalrow['authors'];
                        $title = $journalrow['journal_title'];
                        $name = $journalrow['journal_name'];
                        $vol = $journalrow['journal_volume'];
                        $pagenum = $journalrow['journal_pagenum'];
                        $file = $journalrow['journal_file'];
                        $journaldesc = "<p style='margin-left: 12.5mm; text-indent: -12.5mm;'><li>$authors. $journalyear. $title. <i>$name</i> ";
                        if($vol != NULL){
                            $journaldesc .= "$vol";
                            if($pagenum != NULL){
                                $journaldesc .= ": $pagenum";
                            }
                        }
                        echo "$journaldesc.";
                        if($file != NULL){
                            echo " <a href='kalai_panel/uploads/journals/$file'>Download File</a>";
                        }
                        echo "</li></br>";
                    }
                    echo "</ol>";
                }
            ?>
        </div>

      </div>
    </section><!-- End About Section -->

    <!-- ======= Proceedings Section ======= -->
    <section id="proceedings" class="about section-bg">
      <div class="container">

        <div class="section-title">
          <h2>Proceedings</h2>
        </div>

        <div class="row">
            <?php
            $sqlyear = mysqli_query($conn, "SELECT distinct proceeding_year FROM tbl_proceedings WHERE proceeding_owner='$super_owner' AND super_owner='$super_owner' ORDER BY proceeding_year DESC");
            $yearrows = mysqli_num_rows($sqlyear);
            while($yearrow = mysqli_fetch_array($sqlyear)){

                $i = 0;
                $year = $yearrow['proceeding_year'];
                echo "<h3>". $year ."</h3></br>";
                echo "<ol>";
                $prsql = mysqli_query($conn, "SELECT * FROM tbl_proceedings WHERE proceeding_year=$year AND proceeding_owner='$super_owner' AND super_owner='$super_owner'");
                $prrows = mysqli_num_rows($prsql);

                while($prrow = mysqli_fetch_array($prsql)){
                    $i++;
                    $authors = $prrow['authors'];
                    $title = $prrow['proceeding_title'];
                    $conf_name = $prrow['conference_name'];
                    $conf_date = $prrow['conference_date'];
                    $conf_location = $prrow['conference_location'];
                    $vol = $prrow['proceeding_volume'];
                    $pagenum = $prrow['proceeding_pagenum'];
                    $file = $prrow['proceeding_file'];
                    $prdesc = "<p style='margin-left: 12.5mm; text-indent: -12.5mm;'><li>$authors. $year. $title. <i>$conf_name";
                    if($conf_location != NULL){
                        $prdesc .= ", $conf_location";
                    }
                    if($conf_date != NULL){
                        $prdesc .= " ($conf_date)";
                    }

                    if($vol == NULL || $pagenum == NULL){
                        $prdesc .= "</i>. ";
                    }
                    else{
                        $prdesc .= "</i>, ";
                    }
                    

                    if($vol != NULL){
                        $prdesc .= "$vol;";
                    }
                    if($pagenum != NULL){
                        $prdesc .= " hlm. $pagenum";
                    }
                    echo "$prdesc.";
                    if($file != NULL){
                        echo " <a href='kalai_panel/uploads/proceedings/$file'>Download File</a>";
                    }
                    echo "</li></br>";
                }
                echo "</ol>";
            }
            ?>
        </div>
      </div>
    </section><!-- End Proceedings Section -->

    <!-- ======= Book Chapters Section ======= -->
    <section id="bookchapters" class="about">
      <div class="container">

        <div class="section-title">
          <h2>Book Chapters</h2>
        </div>

        <div class="row">
            <?php
            $sqlyear = mysqli_query($conn, "SELECT distinct book_year FROM tbl_bookchapters WHERE chapter_owner='$super_owner' AND super_owner='$super_owner' ORDER BY book_year DESC");
            $yearrows = mysqli_num_rows($sqlyear);
            while($yearrow = mysqli_fetch_array($sqlyear)){

                $i = 0;
                $year = $yearrow['book_year'];
                echo "<h3>". $year ."</h3></br>";
                echo "<ol>";
                $bcsql = mysqli_query($conn, "SELECT * FROM tbl_bookchapters WHERE book_year=$year AND chapter_owner='$super_owner' AND super_owner='$super_owner'");
                $bcrows = mysqli_num_rows($bcsql);

                while($bcrow = mysqli_fetch_array($bcsql)){
                    $i++;
                    $authors = $bcrow['authors'];
                    $title = $bcrow['chapter_title'];
                    $book_editor = $bcrow['book_editor'];
                    $book_title = $bcrow['book_title'];
                    $book_edition = $bcrow['book_edition'];
                    $pagenum = $bcrow['chapter_pagenum'];
                    $location = $bcrow['publisher_location'];
                    $publisher = $bcrow['publisher_name'];
                    $file = $bcrow['chapter_file'];

                    $bcdesc = "<p style='margin-left: 12.5mm; text-indent: -12.5mm;'><li>$authors. $year. $title.  Dlm. $book_editor (pnyt.). <i>$book_title</i>";
                    if($book_edition != NULL){
                        $bcdesc .= ", $book_edition,";
                    }else{
                        $bcdesc .= ",";
                    }
                    $bcdesc .= " hlm. $pagenum. $location: $publisher.";
                    echo "$bcdesc";
                    if($file != NULL){
                        echo " <a href='kalai_panel/uploads/bookchapters/$file'>Download File</a>";
                    }
                    echo "</li></br>";
                }
                echo "</ol>";
            }
            ?>
        </div>

    </div>
    </section><!-- End Book Chapters Section -->

    <!-- ======= Books Section ======= -->
    <section id="books" class="about section-bg">
      <div class="container">

        <div class="section-title">
          <h2>Books</h2>
        </div>

        <div class="row">
            <?php
                $sqlyear = mysqli_query($conn, "SELECT distinct book_year FROM tbl_books WHERE book_owner='$super_owner' AND super_owner='$super_owner' ORDER BY book_year DESC");
                $yearrows = mysqli_num_rows($sqlyear);
                while($yearrow = mysqli_fetch_array($sqlyear)){

                    $i = 0;
                    $year = $yearrow['book_year'];
                    echo "<h3>". $year ."</h3></br>";
                    echo "<ol>";
                    $booksql = mysqli_query($conn, "SELECT * FROM tbl_books WHERE book_year=$year AND book_owner='$super_owner' AND super_owner='$super_owner'");
                    $bookrows = mysqli_num_rows($booksql);

                    while($bookrow = mysqli_fetch_array($booksql)){
                        $i++;
                        $authors = $bookrow['authors'];
                        $title = $bookrow['book_title'];
                        $year = $bookrow['book_year'];
                        $notes = $bookrow['book_notes'];
                        $location = $bookrow['publisher_location'];
                        $publisher = $bookrow['publisher_name'];
                        $file = $bookrow['book_file'];

                        $bookdesc = "<p style='margin-left: 12.5mm; text-indent: -12.5mm;'><li>$authors. $year. <i>$title</i>.";
                        if($notes != NULL){
                            $bookdesc .= "$notes.";
                        }
                        
                        $bookdesc .= " $location: $publisher.";
                        echo "$bookdesc";
                        if($file != NULL){
                                echo " <a href='kalai_panel/uploads/books/$file'>Download File</a>";
                            }
                        echo "</li></br>";
                    }
                    echo "</ol>";
                }
                
                ?>
        </div>

    </div>
    </section><!-- End Books Section -->
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="container">
      <div class="copyright">
        &copy; 2021 <strong><span>Academic Profile Management System</span></strong>
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

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>