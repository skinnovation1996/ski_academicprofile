<?php
require_once("assets/php/chk-session.php");
require_once("assets/php/connectdb.php");
$uploaderror = 0;
$successmsg = "";
$errormsg = "";
$modalmessage = "";

//for ADMIN ONLY
if($user_role == "Student" || $user_role == "Client" || $user_role == "Super Admin"){
    header("location:index.php");
}

if(isset($_SESSION['academicprofile_success_msg'])){
    $successmsg = $_SESSION['academicprofile_success_msg'];
    $_SESSION['academicprofile_success_msg'] = "";
    $_SESSION['academicprofile_error_msg'] = "";
}
if(isset($_SESSION['academicprofile_error_msg'])){
    $errormsg = $_SESSION['academicprofile_error_msg'];
    $_SESSION['academicprofile_success_msg'] = "";
    $_SESSION['academicprofile_error_msg'] = "";
}


?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Add Student - Academic Profile <?php echo $user_role;?></title>

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

            <?php $navactive = 9; include("assets/php/Admin-navbar.php");?>
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
                    <a class="navbar-brand" href="students_ug.php"><<</a><a class="navbar-brand" href="add-student.php">Add New Student</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-left">
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<p class="hidden-lg hidden-md">Add New Student</p>
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
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Add New Student</h4>
                            </div>
                            <div class="content table-responsive">
                                <?php if($successmsg != NULL){ ?>
                                    <div class="alert alert-success">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        &times;
                                        </button>
                                        <span>
                                        <b> Success - </b> <?php echo $successmsg;?></span>
                                    </div>
                                    <?php }
                                    if($errormsg != NULL){ ?>
                                    <div class="alert alert-danger">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        &times;
                                        </button>
                                        <span>
                                        <b> Error - </b> <?php echo $errormsg;?></span>
                                    </div>
                                    <?php } ?>
                                <form id="adddata" name="adddata" method="post" enctype="multipart/form-data" action="operations/add-student.php">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Student Matric No.</label>
                                                <input type="text" name="regnum" id="regnum" class="form-control" placeholder="Student Matric No...." required>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label>Full Name</label>
                                                <input type="text" name="name" id="name" class="form-control" placeholder="Full Name..." required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Type</label>
                                                <select name="type" id="type" class="form-control">
                                                    <option value="FYP">Undergraduates</option>
                                                    <option value="MA">Masters</option>
                                                    <option value="PhD">PhD</option>
                                                    <option value="RA">Research Team Member</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Phone Number (optional)</label>
                                                <input type="text" name="phonenumber" id="phonenumber" class="form-control" placeholder="Phone Number (optional)...">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>E-Mail (optional)</label>
                                                <input type="email" name="email" id="email" class="form-control" placeholder="E-Mail (optional)...">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Status</label>
                                                <select name="status" id="status" class="form-control">
                                                    <option value="0">Active</option>
                                                    <option value="1">Graduated</option>
                                                    <option value="2">Pending</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Faculty/Institute</label>
                                                <?php 
                                                //Check if Lecturer University is from UKM
                                                if($owner_university == "UKM" || $owner_university == "Universiti Kebangsaan Malaysia" || $owner_university == "Universiti Kebangsaan Malaysia (UKM)" 
                                                || $owner_university == "National University of Malaysia" || $owner_university == "National University of Malaysia (UKM)"){ ?>
                                                <select name="faculty" id="faculty" class="form-control">
                                                    <option value="FKAB">Faculty of Engineering and Built Environment (FKAB)</option>
                                                    <option value="FSSK">Faculty of Social Sciences and Humanities (FSSK)</option>
                                                    <option value="FF">Faculty of Pharmacy (FF)</option>
                                                    <option value="FPend">Faculty of Education (FPend)</option>
                                                    <option value="FST">Faculty of Science and Technology (FST)</option>
                                                    <option value="FPI">Faculty of Islamic Studies (FPI)</option>
                                                    <option value="FUU">Faculty of Law (FUU)</option>
                                                    <option value="PPUKM">Faculty of Medicine (PPUKM)</option>
                                                    <option value="FEP">Faculty of Economics and Management (FEP)</option>
                                                    <option value="FSK">Faculty of Health Sciences (FSK)</option>
                                                    <option value="FPerg">Faculty of Dentistry (FPerg)</option>
                                                    <option value="FTSM">Faculty of Information Science and Technology (FTSM)</option>
                                                    <option value="GSB">UKM-GSB Graduate School of Business (GSB)</option>
                                                    <option value="SELFUEL">Fuel Cell Institute (SELFUEL)</option>
                                                    <option value="IMEN">Institute of Microengineering and Nanoelectronics (IMEN)</option>
                                                    <option value="IPI">Institute of Climate Change (IPI)</option>
                                                    <option value="KITA">Institute of Ethnic Studies (KITA)</option>
                                                    <option value="IHEARS">Institute of Ear, Hearing and Speech (INSTITUTE-HEARS)</option>
                                                    <option value="IVI">Institute of Visual Informatics (IVI)</option>
                                                    <option value="LESTARI">Institute for Environment and Development (LESTARI)</option>
                                                    <option value="SERI">Solar Energy Research Institute (SERI)</option>
                                                    <option value="ATMA">Institute of The Malay World and Civilization (ATMA)</option>
                                                    <option value="PERMATApintar">Pusat PERMATApintar Negara</option>
                                                    <option value="INBIOSIS">Institute of Systems Biology (INBIOSIS)</option>
                                                    <option value="IKMAS">Institute of Malaysian and International Studies (IKMAS)</option>
                                                    <option value="HADHARI">Institute of Islam Hadhari (HADHARI)</option>
                                                    <option value="UMBI">UKM Medical Molecular Biology Institute (UMBI)</option>
                                                    <option value="Others">Others</option>
                                                </select>
                                                <br>
                                                <input type="text" name="faculty_others" id="faculty_others" class="form-control" placeholder="State if Others">
                                                <?php }else{ ?>
                                                <input type="text" name="faculty" id="faculty" class="form-control" placeholder="Faculty/Institute..." required>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>University</label>
                                                <input type="text" name="university" id="university" class="form-control" placeholder="University" value="<?php echo $owner_university;?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Start Year</label>
                                                <input type="text" name="startyear" id="startyear" class="form-control" placeholder="Start Year..." required>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>End Year (required for completed)</label>
                                                <input type="text" name="endyear" id="endyear" class="form-control" placeholder="End Year...">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Research Title (optional)</label>
                                                <input type="text" name="researchtitle" id="researchtitle" class="form-control" placeholder="Research Title..." required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Supervisor Status</label>
                                                <select name="sv_status" id="sv_status" class="form-control">
                                                    <option value="0">Main Supervisor</option>
                                                    <option value="1">Co-Supervisor</option>
                                                    <option value="2">Pending</option>
                                                    <option value="3">Committee</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Funding Status</label>
                                                <select name="funding_status" id="funding_status" class="form-control">
                                                <?php 
                                                $grantsql = mysqli_query($conn, "SELECT * from tbl_grant where grant_status=0 AND super_owner='$login_super_owner' ORDER BY id DESC");
                                                $numrows = mysqli_num_rows($grantsql);
                                                while($row=mysqli_fetch_array($grantsql)){?>
                                                    <option value="<?php echo $row['grant_code'];?>"><?php echo $row['grant_title'];?> (<?php echo $row['grant_code'];?>)</option>
                                                <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input type="password" class="form-control" placeholder="Use matric number as password..." readonly name="passwordinput" id="passwordinput"/>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Student Picture (Max 3MB, JPG/BMP/GIF only)</label>
                                                <input type="file" name="stdPicture" id="stdPicture"/>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    
                                    <button type="submit" name="submit-button" class="btn btn-info btn-fill pull-right">Submit</button>
                                    <div class="clearfix"></div>
                                </form>

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
<!-- Modal Message -->
  <div class="modal fade" id="ModalMessage" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><?php if($uploaderror == 1){ echo "Error";}else{ echo "Success";}?></h4>
        </div>
        <div class="modal-body">
          <p><?php echo $modalmessage;?></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
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
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>


    <?php
    if($modalmessage != NULL){?>
        <script type='text/javascript'>
        $('#ModalMessage').modal('show');
        </script><?php
    }
    ?>

</html>
