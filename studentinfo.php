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

//Temporarily have Super Owner Role
$super_owner_role = "Academic Lecturer";

//PERFORM SQL STATEMENTS
if($super_owner_role == "Academic Lecturer" || $super_owner_role == "Teacher"){
    $sqla = mysqli_query($conn, "SELECT * from tbl_students WHERE std_reg_num='$sqlgetid' AND super_owner='$super_owner'");
    $rows = mysqli_num_rows($sqla);

    //Invalid student id? Go back to index.php
    if(mysqli_num_rows($sqla) != 1){
        header('location:index.php');
    }
    $row=mysqli_fetch_assoc($sqla);
    $pagedesc = "Student";
    //Student Type
    switch($row['std_type']){
        case 0:
            $type = "Undergraduates";
            break;
        case 1:
            $type = "Masters";
            break;
        case 2:
            $type = "PhD";
            break;
        case 3:
            $type = "Research Team Member";
            $pagedesc = "Research Team Member";
            break;
        default:
            $type = "Unknown";
    }
}else{
    //COMING SOON
}




//Student Faculty (for UKM)
$selected_faculty = $row['std_faculty'];
if($selected_faculty=="FKAB")
    $faculty = "Faculty of Engineering and Built Environment (FKAB)";
else if($selected_faculty == "FSSK")
    $faculty = "Faculty of Social Sciences and Humanities (FSSK)";
else if($selected_faculty == "FF")
    $faculty = "Faculty of Pharmacy (FF)";
else if($selected_faculty == "FPend")
    $faculty = "Faculty of Education (FPend)";
else if($selected_faculty == "FST")
    $faculty = "Faculty of Science and Technology (FST)";
else if($selected_faculty == "FPI")
    $faculty = "Faculty of Islamic Studies (FPI)";
else if($selected_faculty == "FUU")
    $faculty = "Faculty of Law (FUU)";
else if($selected_faculty == "PPUKM")
    $faculty = "Faculty of Medicine (PPUKM)";
else if($selected_faculty == "FEP")
    $faculty = "Faculty of Economics and Management (FEP)";
else if($selected_faculty == "FSK")
    $faculty = "Faculty of Health Sciences (FSK)";
else if($selected_faculty == "FPerg")
    $faculty = "Faculty of Dentistry (FPerg)";
else if($selected_faculty == "FTSM")
    $faculty = "Faculty of Information Science and Technology (FTSM)";
else if($selected_faculty == "GSB")
    $faculty = "UKM-GSB Graduate School of Business (GSB)";
else if($selected_faculty == "SELFUEL")
    $faculty = "Fuel Cell Institute (SELFUEL)";
else if($selected_faculty == "IMEN")
    $faculty = "Institute of Microengineering and Nanoelectronics (IMEN)";
else if($selected_faculty == "IPI")
    $faculty = "Institute of Climate Change (IPI)";
else if($selected_faculty == "KITA")
    $faculty = "Institute of Ethnic Studies (KITA)";
else if($selected_faculty == "IHEARS")
    $faculty = "Institute of Ear, Hearing and Speech (INSTITUTE-HEARS)";
else if($selected_faculty == "IVI")
    $faculty = "Institute of Visual Informatics (IVI)";
else if($selected_faculty == "LESTARI")
    $faculty = "Institute for Environment and Development (LESTARI)";
else if($selected_faculty == "SERI")
    $faculty = "Solar Energy Research Institute (SERI)";
else if($selected_faculty == "ATMA")
    $faculty = "Institute of The Malay World and Civilization (ATMA)";
else if($selected_faculty=="PERMATApintar")
    $faculty = "Pusat PERMATApintar Negara";
else if($selected_faculty=="INBIOSIS")
    $faculty = "Institute of Systems Biology (INBIOSIS)";
else if($selected_faculty=="IKMAS")
    $faculty = "Institute of Malaysian and International Studies (IKMAS)";
else if($selected_faculty=="HADHARI")
    $faculty = "Institute of Islam Hadhari (HADHARI)";
else if($selected_faculty=="UMBI")
    $faculty = "UKM Medical Molecular Biology Institute (UMBI)";
else
    $faculty = $row['std_faculty'];

//Student status
switch($row['std_status']){
    case 0:
        $status = "Active";
        break;
    case 1:
        $status = "Graduated";
        break;
    case 2:
        $status = "Pending";
        break;
    default:
        $status = "Unknown/Terminated";
}
                                
//Supervisor Status
switch($row['std_sv_status']){
    case 0:
        $sv_status = "Main Supervisor";
        break;
    case 1:
        $sv_status = "Co-Supervisor";
        break;
    case 2:
        $sv_status = "Penyelia Bersama";
        break;
    case 3:
        $sv_status = "Committee";
        break;
    default:
        $sv_status = "Unknown";
}

//Funding Status
$grant_code = $row['std_funding_status'];
$sql2 = mysqli_query($conn, "select * from tbl_grant where grant_code='$grant_code' AND super_owner='$super_owner'"); $row2 = mysqli_fetch_assoc($sql2);

//Student Activity
$std_activity = $row['std_activity'];

//Research Outcome
$r_outcome = $row['std_research_outcome'];
                                        
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title><?php echo $pagedesc;?> Info - </title>
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
        <!-- ======= Student Info Section ======= -->
        <section id="studentinfo" class="resume">
        <div class="container">

            <div class="section-title">
                <h2><?php echo $pagedesc;?> Details</h2>
            </div>

            <div class="row">
                <div class="col-lg-8 pt-4 pt-lg-0 content" data-aos="fade-left">
                    <div align="center"><img src="kalai_panel/uploads/images/<?php echo $row['std_picture'];?>" width="177" height="236" align="center" style="border: 2px solid black;" /></div><br><br>
                    <h2><?php echo $row['std_name']." (".$row['std_reg_num'].")";?></h2>
                    <h3>Type: <?php echo $type;?></h3>
                    <h4>Status: <?php echo $status;?></h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul>
                                <li>Phone Number: <?php if($row['std_phonenum'] != "null") echo $row['std_phonenum']; else echo "Unknown";?><br></li>
                                <li>E-Mail Address: <?php if($row['std_email'] != "null") echo $row['std_email']; else echo "Unknown";?><br></li>
                                <li>Faculty/Institute: <?php echo $faculty;?><br></li>
                                <li>Funding Status: <?php echo $row2['grant_title'];?> (<?php echo $row2['grant_code'];?>)<br></li>
                                <li>Student Activity: <?php echo $std_activity;?></li>
                            </ul>
                        </div>
                    </div>
                </div>
                
            </div>

            <div class="row">
                <div class="col-lg-6" data-aos="fade-up">
                    <h3 class="resume-title">Research Info</h3>
                    <div class="resume-item">
                        <h4><?php echo $row['std_research_title'];?></h4>
                        <h5><?php echo $row['std_start_year']." - ".$row['std_end_year'];?></h5>
                        <p>Supervisor Status: <?php echo $sv_status;?><br>Research Outcome: <?php echo $r_outcome;?></p>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-up">
                    <h3 class="resume-title">Journals</h3>
                    <div class="row">
                    <?php
                        $sqlyear = mysqli_query($conn, "SELECT distinct journal_year FROM tbl_journals WHERE journal_owner='$sqlgetid' AND super_owner='$super_owner' ORDER BY journal_year DESC");
                        $yearrows = mysqli_num_rows($sqlyear);
                        if($yearrows != NULL){
                            while($yearrow = mysqli_fetch_array($sqlyear)){

                                $i = 0;
                                $journalyear = $yearrow['journal_year'];
                                echo "<h3>". $journalyear ."</h3></br>";
                                echo "<ol>";
                                $journalsql = mysqli_query($conn, "SELECT * FROM tbl_journals WHERE journal_year=$journalyear AND journal_owner='$sqlgetid' AND super_owner='$super_owner' ");
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
                        }else{
                            echo "<h5>No journals published</h5>";
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6" data-aos="fade-up">
                    <h3 class="resume-title">Proceedings</h3>
                    <div class="row">
                        <?php
                        $sqlyear = mysqli_query($conn, "SELECT distinct proceeding_year FROM tbl_proceedings WHERE proceeding_owner='$sqlgetid' AND super_owner='$super_owner' ORDER BY proceeding_year DESC");
                        $yearrows = mysqli_num_rows($sqlyear);
                        if($yearrows != NULL){
                            while($yearrow = mysqli_fetch_array($sqlyear)){

                                $i = 0;
                                $year = $yearrow['proceeding_year'];
                                echo "<h3>". $year ."</h3></br>";
                                echo "<ol>";
                                $prsql = mysqli_query($conn, "SELECT * FROM tbl_proceedings WHERE proceeding_year=$year AND proceeding_owner='$sqlgetid' AND super_owner='$super_owner' ");
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
                        }else{
                            echo "<h5>No proceedings published</h5>";
                        }
                        ?>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-up">
                    <h3 class="resume-title">Book Chapters</h3>
                    <div class="row">
                    <?php
                        $sqlyear = mysqli_query($conn, "SELECT distinct book_year FROM tbl_bookchapters WHERE chapter_owner='$sqlgetid' AND super_owner='$super_owner' ORDER BY book_year DESC");
                        $yearrows = mysqli_num_rows($sqlyear);
                        if($yearrows != NULL){
                            while($yearrow = mysqli_fetch_array($sqlyear)){

                                $i = 0;
                                $year = $yearrow['book_year'];
                                echo "<h3>". $year ."</h3></br>";
                                echo "<ol>";
                                $bcsql = mysqli_query($conn, "SELECT * FROM tbl_bookchapters WHERE book_year=$year AND chapter_owner='$sqlgetid' AND super_owner='$super_owner'");
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
                        }else{
                            echo "<h5>No book chapters published</h5>";
                        }
                        ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6" data-aos="fade-up">
                    <h3 class="resume-title">Books</h3>
                    <div class="row">
                        <?php
                        $sqlyear = mysqli_query($conn, "SELECT distinct book_year FROM tbl_books WHERE book_owner='$sqlgetid' AND super_owner='$super_owner' ORDER BY book_year DESC");
                        $yearrows = mysqli_num_rows($sqlyear);
                        if($yearrows != NULL){
                            while($yearrow = mysqli_fetch_array($sqlyear)){
            
                                $i = 0;
                                $year = $yearrow['book_year'];
                                echo "<h3>". $year ."</h3></br>";
                                echo "<ol>";
                                $booksql = mysqli_query($conn, "SELECT * FROM tbl_books WHERE book_year=$year AND book_owner='$sqlgetid' AND super_owner='$super_owner'");
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
                        }else{ echo "<h5>No books published</h5>"; }
                        ?>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-up">
                    <h3 class="resume-title">Popular Articles</h3>
                    <div class="row">
                    <?php
                        $pasql = mysqli_query($conn, "SELECT * from tbl_popular_article WHERE article_owner='$sqlgetid' AND super_owner='$super_owner'");
                        $parows = mysqli_num_rows($pasql);
                        if($parows != NULL){
                            echo "<ol>";
                            while($parow = mysqli_fetch_array($pasql)){
                                $i++;
                                switch($parow['article_platform']){
                                    case 0:
                                        $platform = "Newspaper";
                                        break;
                                    case 1:
                                        $platform = "Magazine";
                                        break;
                                    case 2:
                                        $platform = "Internet Website";
                                        break;
                                    case 3:
                                        $platform = "Books";
                                        break;
                                    case 4:
                                        $platform = "Social Media";
                                        break;
                                    default:
                                        $platform = "Others";
                                }
                                $title = $parow['article_title'];
                                $author = $parow['article_author'];
                                $file = $parow['article_file'];

                                $padesc = "<p style='margin-left: 12.5mm; text-indent: -12.5mm;'><li>$author. <i>$title</i> ($platform).";
                                echo "$padesc";
                                if($file != NULL){
                                    echo " <a href='kalai_panel/uploads/articles/$file'>Download File</a>";
                                }
                                echo "</li></br>";
                            }
                            echo "</ol>";
                        }else{ echo "<h5>No popular articles published</h5>"; }
                        ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6" data-aos="fade-up">
                    <h3 class="resume-title">Abstracts</h3>
                    <div class="row">
                        <?php
                        $sasql = mysqli_query($conn, "SELECT * from tbl_abstract WHERE abstract_owner='$sqlgetid' AND super_owner='$super_owner'");
                        $sarows = mysqli_num_rows($sasql);
                        if($sarows != NULL){
                            echo "<ol>";
                            while($sarow = mysqli_fetch_array($sasql)){
                                $i++;
                                $title = $sarow['abstract_title'];
                                $std_name = $sarow['abstract_stdname'];
                                $file = $sarow['abstract_file'];

                                $sadesc = "<p style='margin-left: 12.5mm; text-indent: -12.5mm;'><li>$std_name. <i>$title</i>.";
                                echo "$sadesc";
                                if($file != NULL){
                                        echo " <a href='kalai_panel/uploads/abstracts/$file'>Download File</a>";
                                }
                                echo "</li></br>";
            
                            }
                            echo "</ol>";
                        }else{ echo "<h5>No abstracts published</h5>"; }
                        ?>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-up">
                    <h3 class="resume-title">Thesis</h3>
                    <div class="row">
                    <?php
                        $thesissql = mysqli_query($conn, "SELECT * from tbl_thesis WHERE thesis_owner='$sqlgetid' AND super_owner='$super_owner'");
                        $thesisrows = mysqli_num_rows($thesissql);
                        if($thesisrows != NULL){
                            echo "<ol>";
                            while($thesisrow = mysqli_fetch_array($thesissql)){
                                $i++;
                                $title = $thesisrow['thesis_title'];
                                $std_name = $thesisrow['thesis_stdname'];
                                $year = $thesisrow['thesis_year'];
                                $file = $thesisrow['thesis_file'];

                                $thesisdesc = "<p style='margin-left: 12.5mm; text-indent: -12.5mm;'><li>$std_name. $year. <i>$title</i>.";
                                echo "$thesisdesc";
                                if($file != NULL){
                                    echo " <a href='kalai_panel/uploads/thesis/$file'>Download File</a>";
                                }
                                echo "</li></br>";
                            }
                            echo "</ol>";
                        }else{ echo "<h5>No thesis published</h5>"; }
                        ?>
                    </div>
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