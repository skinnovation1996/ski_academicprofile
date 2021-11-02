<?php
require_once("assets/php/chk-session.php");
require_once("assets/php/connectdb.php");
$uploaderror = 0;
$modalmessage = "";
$time = date("h:i:sa");
$date = date("Y-m-d");
$datetime = date('Y-m-d H:i:s');

if($user_role != "Student"){
    $sqla = mysqli_query($conn, "SELECT * from tbl_admin WHERE admin_id='$login_session'"); 
    $row_user=mysqli_fetch_array($sqla);
    $admin_id = $row_user['admin_id'];
    $user_profile_pic = $row_user['profile_pic'];
    if($user_profile_pic != NULL){
        $pic_directory = "uploads/admins/$admin_id/$user_profile_pic";
    }else{
        $pic_directory = "assets/img/default-avatar.png";
    }
}else if($user_role == "Student"){
    $sqla = mysqli_query($conn, "SELECT * from tbl_students WHERE std_reg_num='$login_session'"); 
    $row_user=mysqli_fetch_array($sqla);
    $std_id = $row_user['std_reg_num'];
    $user_profile_pic = $row_user['std_picture'];
    if($user_profile_pic != "no_image.jpg"){
        $pic_directory = "uploads/images/$std_id/$user_profile_pic";
    }else{
        $pic_directory = "assets/img/default-avatar.png";
    }
    
}
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Index - Academic Profile <?php echo $user_role;?></title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="assets/css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet"/>


    <!--     Data Table     -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">


    <!--     Fonts and icons     -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
    <style>
    .ct-label {
        font-size: 15px;
        font-weight: bold;
    }
    </style>

</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-color="blue" data-image="assets/img/sidebar-3.jpg">

    <!--

        Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
        Tip 2: you can also add an image using data-image tag

    -->

    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="index.php" class="simple-text">
                    Academic Profile <?php echo $user_role;?>
                </a>
            </div>

            <?php $navactive = 1; include("assets/php/$navbar");?>
    	</div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php">Home</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-left">
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<p class="hidden-lg hidden-md">Home</p>
                            </a>
                        </li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li>
                           <a href="change-pass.php">
                               <p>Change Password</p>
                            </a>
                        </li>
                        <li>
                            <a href="logout.php">
                                <p>Log out</p>
                            </a>
                        </li>
						<li class="separator hidden-lg hidden-md"></li>
                    </ul>
                </div>
            </div>
        </nav>


        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <?php if($login_session != "super_admin"){ ?>
                    <div class="col-md-12">
                        <div class="card card-user">
                            <div class="image">
                                <img src="https://ununsplash.imgix.net/photo-1431578500526-4d9613015464?fit=crop&fm=jpg&h=300&q=75&w=400" alt="..."/>
                            </div>
                            <div class="content">
                                <div class="author">
                                    <img class="avatar border-gray" src="<?php echo $pic_directory;?>" alt="..."/>

                                    <h4 class="title"><?php echo $your_name;?><br />
                                        <small><?php echo $user_role;?></small>
                                    </h4>
                                    <h5><?php
                                    if($user_role == "Student"){ 
                                        //Get Info from Super Owner
                                        $sql1 = mysqli_query($conn, "SELECT * FROM tbl_admin WHERE admin_id='$login_super_owner'");
                                        $row_sa = mysqli_fetch_assoc($sql1);
                                        //Student Type
                                        switch($row_user['std_type']){
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
                                                break;
                                            default:
                                                $type = "Unknown";
                                        }

                                        //Student Faculty
                                        $selected_faculty = $row_user['std_faculty'];
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
                                            $faculty = $row_user['std_faculty'];

                                        //Student status
                                        switch($row_user['std_status']){
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
                                        switch($row_user['std_sv_status']){
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

                                        //Student Activity
                                        $std_activity = $row_user['std_activity'];

                                        //Research Outcome
                                        $r_outcome = $row_user['std_research_outcome'];

                                        //Funding Status
                                        $grant_code = $row_user['std_funding_status'];
                                        $sql2 = mysqli_query($conn, "SELECT * from tbl_grant where grant_code='$grant_code'"); 
                                        $row2 = mysqli_fetch_assoc($sql2);?>
                                    <?php } ?>
                                    <div class="row" style="font-size: 18px; text-align: justify; display: inline;">
                                        <div class="col-md-6">
                                            <b>E-Mail Address:</b> <?php if($user_role != "Student") echo $row_user['email']; else echo $row_user['std_email'];?></br>
                                            <b>Phone Number:</b> <?php if($user_role != "Student") echo $row_user['tel']; else echo $row_user['std_phonenum'];?></br>
                                            <?php if($user_role != "Student"){ ?>
                                            <b>Fax Number:</b> <?php echo $row_user['fax'];?></br>
                                            <?php } ?>
                                            <b>Department:</b> <?php if($user_role != "Student") echo $row_user['department']; else echo $row_sa['department']; ?></br>
                                            <b>Faculty/Institute:</b> <?php if($user_role != "Student") echo $row_user['faculty']; else echo $faculty;?></br>
                                            <b>University:</b> <?php if($user_role != "Student") echo $row_user['university']; else echo $row_sa['university'];?></br>
                                            <b>City & Country:</b> <?php if($user_role != "Student") echo $row_user['city'].", ".$row_user['country']; else echo $row_sa['city'].", ".$row_sa['country'];?></br>
                                        </div>
                                        <div class="col-md-6">
                                            <?php if($user_role == "Student"){ ?>
                                            <b>Research Title:</b> <?php echo $row_user['std_research_title'];?></br>
                                            <b>Start Year:</b> <?php echo $row_user['std_start_year'];?></br>
                                            <b>End Year:</b> <?php if($row_user['std_end_year'] != '0') echo $row_user['std_end_year']; else echo "Ongoing";?></br>
                                            <b>Status:</b> <?php echo $status;?></br>
                                            <b>Supervisor Status:</b> <?php echo $sv_status;?></br>
                                            <b>Funding Status:</b> <?php echo $row2['grant_title'];?> (<?php echo $row2['grant_code'];?>)</br>
                                            <b>Student Activity:</b> <?php echo $std_activity;?></br>
                                            <b>Research Outcome: </b> <?php echo $r_outcome;?></br>
                                            <?php }else{ ?>
                                                <b>Education Level:</b> <?php echo $row_user['education_level'];?></br>
                                                <b>Specializations:</b> <?php echo $row_user['specializations'];?></br>
                                                <b>No. of Students:</b> <?php 
                                                $sql2 = mysqli_query($conn, "SELECT id FROM tbl_students WHERE super_owner='$login_session'");
                                                $numStudents = mysqli_num_rows($sql2);
                                                echo $numStudents;
                                               ?></br>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    </h5>
                                </div>
                                <hr>
                                <p>
                                   
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Home Page</h4>
                                <p class="category">Welcome To Academic Profile Management Dashboard Page!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul>
                        <li>
                            <a href="../index.php">
                                Main Home Page
                            </a>
                        </li>
                        <li>
                            <a href="http://www.ukm.my/pkas/">
                                PKAS
                            </a>
                        </li>
                    </ul>
                </nav>
                <p class="copyright pull-right">
                    &copy; <script>document.write(new Date().getFullYear())</script> Academic Profile Management System<br>
                    Theme &copy; <script>document.write(new Date().getFullYear())</script> <a href="http://www.creative-tim.com">Creative Tim</a>, made with love for a better web
                </p>
            </div>
        </footer>

    </div>
</div>


</body>

    <!--   Core JS Files   -->
    <script src="assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

	<!--  Checkbox, Radio & Switch Plugins -->
	<script src="assets/js/bootstrap-checkbox-radio-switch.js"></script>

	<!--  Charts Plugin -->
	<script src="assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="assets/js/bootstrap-notify.js"></script>

    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>

	<!-- DataTables Plugin -->
	 <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script><script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>


</html>
