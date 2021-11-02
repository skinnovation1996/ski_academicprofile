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

if($row['front_pic'] != "default.jpg"){
    $front_url = "kalai_panel/uploads/admins/$super_owner/".$row['front_pic'];
}else{
    $front_url = "assets/img/default.jpg";
}
$thismonth = date('m');
$thisyear = date('Y');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title><?php echo $user_name;?> - Academic Profile Management</title>
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

  <style>
      #hero{
        background: url("<?php echo $front_url;?>") top center;
        background-size: cover;
      }
    </style>

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
        <ul>
          <li><a href="index.php"><i class="bx bx-arrow-back"></i> <span>Back to Main Menu</span></a></li>
          <li class="active"><a href="#about"><i class="bx bx-envelope"></i> About</a></li>
          <li><a href="#experience"><i class="bx bxs-graduation"></i> <span>Experience</span></a></li>
          <li><a href="#teaching"><i class="bx bxs-school"></i> <span>Teaching</span></a></li>
          <li><a href="#knowledge"><i class="bx bx-brain"></i> Knowledge</a></li>
          <li><a href="#interests"><i class="bx bx-server"></i> Interests</a></li>
          <li><a href="#value"><i class="bx bx-server"></i> Value</a></li>
          <li><a href="#cc"><i class="bx bx-donate-heart"></i> Community Contributions</a></li>
          <li><a href="research.php?userid=<?php echo $userid;?>"><i class="bx bx-atom"></i> Research</a></li>
          <li><a href="publications.php?userid=<?php echo $userid;?>"><i class="bx bx-book"></i> Publications</a></li>
          <li><a href="students.php?userid=<?php echo $userid;?>"><i class="bx bx-group"></i> Students</a></li>
        </ul>
      </nav><!-- .nav-menu -->
      <button type="button" class="mobile-nav-toggle d-xl-none"><i class="icofont-navigation-menu"></i></button>

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex flex-column justify-content-center align-items-center">
    <div class="hero-container" data-aos="fade-in">
    </div>
  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container">

        <div class="section-title">
          <h2>About</h2>
        </div>

        <div class="row">
          <div class="col-lg-4" data-aos="fade-right">
            <img src="kalai_panel/uploads/admins/<?php echo $super_owner;?>/<?php echo $profile_pic;?>" style="width: 80%; height: 80%;" class="img-fluid" alt="">
          </div>
          <div class="col-lg-8 pt-4 pt-lg-0 content" data-aos="fade-left">
            <h3><?php echo $user_name;?>, <?php echo $row['education_level'];?></h3>
            <p class="font-italic">
              <?php echo $row['tagline'];?>
            </p>
            <div class="row">
              <div class="col-lg-6">
                <ul>
                  <li><i class="icofont-rounded-right"></i> <strong>Department:</strong> <?php echo $department = $row['department'];?></li>
                  <li><i class="icofont-rounded-right"></i> <strong>Faculty:</strong> <?php echo $faculty = $row['faculty'];?></li>
                  <li><i class="icofont-rounded-right"></i> <strong>University:</strong> <?php echo $university = $row['university'];?></li>
                  <li><i class="icofont-rounded-right"></i> <strong>City:</strong> <?php echo $city = $row['city'];?>, <?php echo $country = $row['country'];?></li>
                </ul>
              </div>
              <div class="col-lg-6">
                <ul>
                  <li><i class="icofont-rounded-right"></i> <strong>Tel.:</strong> <?php echo $row['tel'];?></li>
                  <li><i class="icofont-rounded-right"></i> <strong>Fax:</strong> <?php echo $row['fax'];?></li>
                  <li><i class="icofont-rounded-right"></i> <strong>Email:</strong> <a title="" href="mailto:<?php echo $row['email'];?>"><?php echo $email = $row['email'];?></a></li>
                  <li><i class="icofont-rounded-right"></i> <strong>Specialization:</strong> <?php echo $row['specializations'];?></li>
                </ul>
              </div>
            </div>
          </div>
        </div>

      </div>
    </section><!-- End About Section -->

    <!-- ======= Experiences Section ======= -->
    <section id="experience" class="resume">
      <div class="container">

        <div class="section-title">
          <h2>Experience</h2>
        </div>

        <div class="row">
            <div class="col-lg-6" data-aos="fade-up">
                <h3 class="resume-title">Academic Qualification</h3>
                <?php
                $AQSQL = mysqli_query($conn, "SELECT * FROM tbl_academic_qualification WHERE super_owner='$super_owner'");
                $rows = mysqli_num_rows($AQSQL);
                $i = 0;

                while($row = mysqli_fetch_array($AQSQL)){
                    $title = $row['academic_title'];
                    $award = $row['academic_award_uni'];
                    $date = $row['academic_date'];
                ?>
                <div class="resume-item">
                    <h4><?php echo $title;?></h4>
                    <p><em><?php echo "$award - $date";?></em></p>
                </div>
                <?php
                }
                ?>
            </div>
            <div class="col-lg-6" data-aos="fade-up">
            <h3 class="resume-title">Professional Membership</h3>
            <?php
            $PMSQL = mysqli_query($conn, "SELECT * FROM tbl_pro_member WHERE super_owner='$super_owner'");
            $rows = mysqli_num_rows($PMSQL);
            $i = 0;

            while($row = mysqli_fetch_array($PMSQL)){
                $member = $row['membership_body'];
                $status = $row['membership_status'];
                $startdate = $row['membership_startdate'];
                $enddate = $row['membership_enddate'];
            ?>
            <div class="resume-item">
                <h4><?php echo $member;?></h4>
                <h5><?php echo "$startdate - $enddate";?></h5>
                <p><em><?php echo "$status";?></em></p>
            </div>
            <?php
            }
            ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6" data-aos="fade-up">
                <h3 class="resume-title">Career History</h3>
                <?php
                $CHSQL = mysqli_query($conn, "SELECT * FROM tbl_career_history WHERE super_owner='$super_owner' ORDER BY id DESC");
                $rows = mysqli_num_rows($CHSQL);
                $i = 0;

                while($row = mysqli_fetch_array($CHSQL)){
                    $title = $row['career_title'];
                    $organization = $row['career_organization'];
                    $startdate = $row['career_startdate'];
                    $enddate = $row['career_enddate'];
                ?>
                <div class="resume-item">
                    <h4><?php echo $title;?></h4>
                    <h5><?php echo "$startdate - $enddate";?></h5>
                    <p><em><?php echo "$organization";?></em></p>
                </div>
                <?php
                }
                ?>
            </div>
            <div class="col-lg-6" data-aos="fade-up">
            <h3 class="resume-title">Administrative Appointment</h3>
            <?php
            $AASQL = mysqli_query($conn, "SELECT * FROM tbl_admin_appointment WHERE super_owner='$super_owner' ORDER BY id DESC");
            $rows = mysqli_num_rows($AASQL);
            $i = 0;

            while($row = mysqli_fetch_array($AASQL)){
                $position = $row['admin_position'];
                $startdate = $row['admin_startdate'];
                $enddate = $row['admin_enddate'];
            ?>
            <div class="resume-item">
                <h4><?php echo $position;?></h4>
                <h5><?php echo "$startdate - $enddate";?></h5>
            </div>
            <?php
            }
            ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12" data-aos="fade-up">
                <h3 class="resume-title">Scholarly Activities</h3>
                <?php
                $sqltype = mysqli_query($conn, "SELECT distinct tbl_scholarly_activities.scholarly_type, tbl_scholarly_types.scholarly_type_title 
                FROM tbl_scholarly_types INNER JOIN tbl_scholarly_activities ON tbl_scholarly_types.scholarly_type_title=tbl_scholarly_activities.scholarly_type WHERE 
                tbl_scholarly_activities.super_owner='$super_owner' AND tbl_scholarly_types.super_owner='$super_owner'");
                $typerows = mysqli_num_rows($sqltype);
                while($typerow = mysqli_fetch_array($sqltype)){

                    $i = 0;
                    $type = $typerow['scholarly_type_title'];
                    echo "<h3>". $type .":</h3></br>";
                    $sasql = mysqli_query($conn, "SELECT * FROM tbl_scholarly_activities WHERE scholarly_type='$type' AND super_owner='$super_owner'");
                    $rows = mysqli_num_rows($sasql);

                    while($row = mysqli_fetch_array($sasql)){
                        $event = $row['scholarly_event'];
                        $date = $row['scholarly_date'];
                        $location = $row['scholarly_location'];

                ?>
                <div class="resume-item">
                    <h4><?php echo $event;?></h4>
                    <h5><?php echo "$date";?></h5>
                    <p><em><?php echo "$location";?></em></p>
                </div>
                <?php
                    }
                }
                ?>
            </div>
        </div>

      </div>
    </section><!-- End Experience Section -->

    <!-- ======= Teaching Section ======= -->
    <section id="teaching" class="skills section-bg">
      <div class="container">

        <div class="section-title">
          <h2>Teaching Subjects</h2>
        </div>

        <div class="row">
            <table id="teaching-list" class="table table-hover table-striped" data-aos="fade-up">
                <thead>
                    <th width="5%" style="text-align:center">No</th>
                    <th width="10%" style="text-align:center">Year</th>
                    <th width="10%" style="text-align:center">Semester</th>
                    <th width="10%" style="text-align:center">Code</th>
                    <th width="60%" style="text-align:center">Course Name</th>
                    <th width="10%" style="text-align:center">Type</th>
                </thead>
                <tbody>
                    <?php
                    $courseSQL = mysqli_query($conn, "SELECT * FROM tbl_teaching WHERE super_owner='$super_owner' ORDER BY academic_year, semester DESC");
                    $rows = mysqli_num_rows($courseSQL);
                        
                    if($rows){
                        $count = 1;
                        while($row=mysqli_fetch_array($courseSQL)){
                            $i++;
                            $year = $row['academic_year'];
                            $semester = $row['semester'];
                            $code = $row['course_code'];
                            $title = $row['course_title'];
                            $typecode = $row['graduate_code'];
                            switch($typecode){
                                case 0: $type = "Undergraduate"; break;
                                case 1: $type = "Masters"; break;
                                case 2: $type = "PhD"; break;
                                default: $type = "Status";
                            }
                    ?>
                    <tr>
                        <td><?php echo $count++;?></td>
                        <td><?php echo $year;?></td>
                        <td><?php echo $semester;?></td>
                        <td><?php echo $code;?></td>
                        <td><?php echo $title;?></td>
                        <td><?php echo $type;?></td>
                    </tr>
                    <?php } }else{ echo "<tr><td colspan='6'>No teaching subjects available</td></tr>";} ?>
                </tbody>
            </table>
        </div>
    </div>

    </div>
    </section><!-- End Knowledge Section -->

    <!-- ======= Knowledge Section ======= -->
    <section id="knowledge" class="skills">
      <div class="container">

        <div class="section-title">
          <h2>Knowledge</h2>
        </div>

        <div class="row">
            <div class="col-lg-12 d-flex justify-content-center" data-aos="fade-up">
                <a href="knowledgearchive.php?userid=<?php echo $userid;?>" class="btn btn-primary" role="button">Knowledge Archive</a><br>
            </div>
        </div>
        <div class="row">
            <table id="knowledge-list" class="table table-hover table-striped" data-aos="fade-up">
                <thead>
                    <th width="5%" style="text-align:center">No</th>
                    <th width="25%" style="text-align:center">Theme</th>
                    <th width="60%" style="text-align:center">Title</th>
                    <th width="15%" style="text-align:center">Date</th>
                </thead>
                <tbody>
                    <?php
                    $knwlSQL = mysqli_query($conn, "SELECT * FROM tbl_knowledge WHERE super_owner='$super_owner' AND MONTH(knowledge_date)=$thismonth AND YEAR(knowledge_date)=$thisyear LIMIT 0,10");
                    $rows = mysqli_num_rows($knwlSQL);
                        
                    if($rows){
                        $count = 1;
                        while($row=mysqli_fetch_array($knwlSQL)){
                            $id = $row['id'];
                    ?>
                    <tr>
                        <td><?php echo $count++;?></td>
                        <td><?php echo $row['knowledge_theme'];?></td>
                        <td><a href="#knowledge" onclick="window.open('knowledgeinfo.php?id=<?php echo $id;?>&userid=<?php echo $userid;?>','_blank','height=800,width=800,top=25,left=25,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');"><b><?php echo $row['knowledge_title'];?></b></a></td>
                        <td><?php echo date_format(new DateTime($row['knowledge_date']), "d M Y");?></td>
                    </tr>
                    <?php } }else{ echo "<tr><td colspan='4'>No knowledges available</td></tr>";} ?>
                </tbody>
            </table>
        </div>
    </div>

    </div>
    </section><!-- End Knowledge Section -->

    <!-- ======= Interests Section ======= -->
    <section id="interests" class="skills section-bg">
      <div class="container">

        <div class="section-title">
          <h2>Interests</h2>
        </div>

        <div class="row">
            <table id="interest-list" class="table table-hover table-striped" data-aos="fade-up">
                <thead>
                    <th width="5%" style="text-align:center">No</th>
                    <th width="25%" style="text-align:center">Category</th>
                    <th width="70%" style="text-align:center">Title</th>
                </thead>
                <tbody>
                    <?php
                    $interestSQL = mysqli_query($conn, "SELECT * FROM tbl_interest WHERE super_owner='$super_owner'");
                    $rows = mysqli_num_rows($interestSQL);
                        
                    if($rows){
                        $count = 1;
                        while($row=mysqli_fetch_array($interestSQL)){
                            $id = $row['id'];
                            $categorycode = $row['interest_category'];
                            switch($categorycode){
                                case 0:
                                    $category = "Academic";
                                    break;
                                case 1:
                                    $category = "Research";
                                    break;
                                case 2:
                                    $category = "Social";
                                    break;
                                case 3:
                                    $category = "Religion";
                                    break;
                                default:
                                    $category = "Unknown";
                            }
                    ?>
                    <tr>
                        <td><?php echo $count++;?></td>
                        <td><?php echo $category;?></td>
                        <td><a href="#interests" onclick="window.open('interestinfo.php?id=<?php echo $id;?>&userid=<?php echo $userid;?>','_blank','height=800,width=800,top=25,left=25,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');"><b><?php echo $row['interest_title'];?></b></a></td>
                    </tr>
                    <?php } }else{ echo "<tr><td colspan='3'>No interests available</td></tr>";} ?>
                </tbody>
            </table>
        </div>
    </div>

    </div>
    </section><!-- End Interests Section -->

    <!-- ======= Values Section ======= -->
    <section id="value" class="skills">
      <div class="container">

        <div class="section-title">
          <h2>Values</h2>
        </div>

        <div class="row">
            <div class="col-lg-12 d-flex justify-content-center" data-aos="fade-up">
                <a href="valuearchive.php?userid=<?php echo $userid;?>" class="btn btn-primary" role="button">Value Archive</a><br>
            </div>
        </div>
        <div class="row">
            <table id="value-list" class="table table-hover table-striped" data-aos="fade-up">
                <thead>
                    <th width="5%" style="text-align:center">No</th>
                    <th width="70%" style="text-align:center">Title</th>
                    <th width="15%" style="text-align:center">Date</th>
                </thead>
                <tbody>
                    <?php
                    $valueSQL = mysqli_query($conn, "SELECT * FROM tbl_value WHERE YEARWEEK(value_date) = YEARWEEK(NOW()) AND  super_owner='$super_owner' LIMIT 0,15");
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

    </div>
    </section><!-- End Value Section -->

    <!-- ======= Community Contribution Section ======= -->
    <section id="cc" class="skills">
      <div class="container">

        <div class="section-title">
          <h2>Community Contribution</h2>
        </div>

        <div class="row">
            <table id="cc-list" class="table table-hover table-striped" data-aos="fade-up">
                <thead>
                    <th width="5%" style="text-align:center">No</th>
                    <th width="15%" style="text-align:center">Category</th>
                    <th width="60%" style="text-align:center">Title</th>
                    <th width="15%" style="text-align:center">Date</th>
                </thead>
                <tbody>
                    <?php
                    $ciSQL = mysqli_query($conn, "SELECT * FROM tbl_community WHERE super_owner='$super_owner' ORDER BY program_date DESC");
                    $rows = mysqli_num_rows($ciSQL);
                        
                    if($rows){
                        $count = 1;
                        while($row=mysqli_fetch_array($ciSQL)){
                            $id = $row['id'];
                    ?>
                    <tr>
                        <td><?php echo $count++;?></td>
                        <td><?php echo $row['category'];?></td>
                        <td><a href="#cc" onclick="window.open('communityinfo.php?id=<?php echo $id;?>&userid=<?php echo $userid;?>','_blank','height=800,width=800,top=25,left=25,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');"><b><?php echo $row['program_title'];?></b></a></td>
                        <td><?php echo date_format(new DateTime($row['program_date']), "d M Y");?></td>
                    </tr>
                    <?php } }else{ echo "<tr><td colspan='4'>No community contributions available</td></tr>";} ?>
                </tbody>
            </table>
        </div>
    </div>

    </div>
    </section><!-- End Value Section -->
    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container">

        <div class="section-title">
          <h2>Contact</h2>
          <p>You can contact me</p>
        </div>

        <div class="row" data-aos="fade-in">

          <div class="col-lg-5 d-flex align-items-stretch">
            <div class="info">
              <div class="address">
                <i class="icofont-google-map"></i>
                <h4>Location:</h4>
                <p><?php echo "$faculty, $university, $city, $country";?></p>
              </div>

              <div class="email">
                <i class="icofont-envelope"></i>
                <h4>Email:</h4>
                <p><?php echo $email;?></p>
              </div>

              <div class="phone">
                <i class="icofont-phone"></i>
                <h4>Call:</h4>
                <p>+603-8911 8374</p>
              </div>

              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d996.157302056418!2d101.77194305152892!3d2.922501066995166!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31cdc919a002ace9%3A0x8f3513c5e5b4fdf!2sFaculty%20of%20Engineering%20%26%20Built%20Environment%20(New%20Building)!5e0!3m2!1sen!2smy!4v1630486041065!5m2!1sen!2smy" frameborder="0" style="border:0; width: 100%; height: 290px;" allowfullscreen></iframe>
            </div>

          </div>

          <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch">
            <form action="forms/contact.php" method="post" role="form" class="php-email-form">
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="name">Your Name</label>
                  <input type="text" name="name" class="form-control" id="name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                  <div class="validate"></div>
                </div>
                <div class="form-group col-md-6">
                  <label for="name">Your Email</label>
                  <input type="email" class="form-control" name="email" id="email" data-rule="email" data-msg="Please enter a valid email" />
                  <div class="validate"></div>
                </div>
              </div>
              <div class="form-group">
                <label for="name">Subject</label>
                <input type="text" class="form-control" name="subject" id="subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                <div class="validate"></div>
              </div>
              <div class="form-group">
                <label for="name">Message</label>
                <textarea class="form-control" name="message" rows="10" data-rule="required" data-msg="Please write something for us"></textarea>
                <div class="validate"></div>
              </div>
              <input type="hidden" name="user_id" id="user_id" value="<?php echo $userid;?>" />
              <div class="mb-3">
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Your message has been sent. Thank you!</div>
              </div>
              <div class="text-center"><button type="submit">Send Message</button></div>
            </form>
          </div>

        </div>

      </div>
    </section><!-- End Contact Section -->

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
        $('#teaching-list').DataTable({
            pageLength: 10
        });
        $('#knowledge-list').DataTable({
            pageLength: 10
        });
        $('#interest-list').DataTable({
            pageLength: 10
        });
        $('#value-list').DataTable({
            pageLength: 10
        });
        $('#cc-list').DataTable({
            pageLength: 10
        });
    });
    </script>
</body>

</html>