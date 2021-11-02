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

if(empty($_GET['id'])){
	header('location:students_ug.php');
}
else{
	$sqlgetid = $_GET['id'];
}

$sqla = mysqli_query($conn, "SELECT * from tbl_students WHERE id='$sqlgetid' AND super_owner='$login_super_owner'"); 
$rows = mysqli_num_rows($sqla);
if($rows == NULL){
    header('location:students_ug.php');
}
$row=mysqli_fetch_array($sqla);
$selected_type = $row['std_type'];
if($selected_type == 0){
    $typename = "Undergraduates";
    $typesel = "FYP";
    $back_button = "students_ug.php";
}else if($selected_type == 1){
    $typename = "Masters";
    $typesel = "MA";
    $back_button = "students_masters.php";
}else if($selected_type == 2){
    $typename = "PhD";
    $typesel = "PHD";
    $back_button = "students_phd.php";
}else if($selected_type == 3){
    $typename = "Research Team Member";
    $typesel = "RA";
    $back_button = "students_research.php";
}

$selected_faculty = $row['std_faculty'];
$selected_status = $row['std_status'];
$selected_svstatus = $row['std_sv_status'];
$selected_funding = $row['std_funding_status'];

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

	<title>Edit Student - Academic Profile <?php echo $user_role;?></title>

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
                    <a class="navbar-brand" href="<?php echo $back_button;?>"><<</a><a class="navbar-brand" href="edit-student.php?id=<?php echo $sqlgetid;?>">Edit Student</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-left">
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<p class="hidden-lg hidden-md">Edit Student</p>
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
                                <h4 class="title">Edit Student</h4>
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
                                <form id="editdata" name="editdata" method="post" enctype="multipart/form-data" action="operations/edit-student.php">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Student Matric No.</label>
                                                <input type="text" name="regnum" id="regnum" class="form-control" placeholder="Student Matric No...." value="<?php echo $row['std_reg_num'];?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label>Full Name</label>
                                                <input type="text" name="name" id="name" class="form-control" placeholder="Full Name..." value="<?php echo $row['std_name'];?>" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Type (can't change)</label>
                                                <input type="text" name="typename" id="typename" class="form-control" value="<?php echo $typename;?>" readonly>
                                                <input type="hidden" name="type" id="type" value="<?php echo $typesel;?>" />
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Phone Number (optional)</label>
                                                <input type="text" name="phonenumber" id="phonenumber" class="form-control" placeholder="Phone Number (optional)..." value="<?php echo $row['std_phonenum'];?>">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>E-Mail (optional)</label>
                                                <input type="email" name="email" id="email" class="form-control" placeholder="E-Mail (optional)..." value="<?php echo $row['std_email'];?>">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Status</label>
                                                <select name="status" id="status" class="form-control">
                                                    <option value="0" <?php if($selected_status == 0) echo "selected";?>>Active</option>
                                                    <option value="1" <?php if($selected_status == 1) echo "selected";?>>Graduated</option>
                                                    <option value="2" <?php if($selected_status == 2) echo "selected";?>>Pending</option>
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
                                                <option value="FKAB" <?php if($selected_faculty=="FKAB"){ echo "selected";}?>>Faculty of Engineering and Built Environment (FKAB)</option>
                                                <option value="FSSK" <?php if($selected_faculty=="FSSK"){ echo "selected";}?>>Faculty of Social Sciences and Humanities (FSSK)</option>
                                                <option value="FF" <?php if($selected_faculty=="FF"){ echo "selected";}?>>Faculty of Pharmacy (FF)</option>
                                                <option value="FPend" <?php if($selected_faculty=="FPend"){ echo "selected";}?>>Faculty of Education (FPend)</option>
                                                <option value="FST" <?php if($selected_faculty=="FST"){ echo "selected";}?>>Faculty of Science and Technology (FST)</option>
                                                <option value="FPI" <?php if($selected_faculty=="FPI"){ echo "selected";}?>>Faculty of Islamic Studies (FPI)</option>
                                                <option value="FUU" <?php if($selected_faculty=="FUU"){ echo "selected";}?>>Faculty of Law (FUU)</option>
                                                <option value="PPUKM" <?php if($selected_faculty=="PPUKM"){ echo "selected";}?>>Faculty of Medicine (PPUKM)</option>
                                                <option value="FEP" <?php if($selected_faculty=="FEP"){ echo "selected";}?>>Faculty of Economics and Management (FEP)</option>
                                                <option value="FSK" <?php if($selected_faculty=="FSK"){ echo "selected";}?>>Faculty of Health Sciences (FSK)</option>
                                                <option value="FPerg" <?php if($selected_faculty=="FPerg"){ echo "selected";}?>>Faculty of Dentistry (FPerg)</option>
                                                <option value="FTSM" <?php if($selected_faculty=="FTSM"){ echo "selected";}?>>Faculty of Information Science and Technology (FTSM)</option>
                                                <option value="GSB" <?php if($selected_faculty=="GSB"){ echo "selected";}?>>UKM-GSB Graduate School of Business (GSB)</option>
                                                <option value="SELFUEL" <?php if($selected_faculty=="SELFUEL"){ echo "selected";}?>>Fuel Cell Institute (SELFUEL)</option>
                                                <option value="IMEN" <?php if($selected_faculty=="IMEN"){ echo "selected";}?>>Institute of Microengineering and Nanoelectronics (IMEN)</option>
                                                <option value="IPI" <?php if($selected_faculty=="IPI"){ echo "selected";}?>>Institute of Climate Change (IPI)</option>
                                                <option value="KITA" <?php if($selected_faculty=="KITA"){ echo "selected";}?>>Institute of Ethnic Studies (KITA)</option>
                                                <option value="IHEARS" <?php if($selected_faculty=="IHEARS"){ echo "selected";}?>>Institute of Ear, Hearing and Speech (INSTITUTE-HEARS)</option>
                                                <option value="IVI" <?php if($selected_faculty=="IVI"){ echo "selected";}?>>Institute of Visual Informatics (IVI)</option>
                                                <option value="LESTARI" <?php if($selected_faculty=="LESTARI"){ echo "selected";}?>>Institute for Environment and Development (LESTARI)</option>
                                                <option value="SERI" <?php if($selected_faculty=="SERI"){ echo "selected";}?>>Solar Energy Research Institute (SERI)</option>
                                                <option value="ATMA" <?php if($selected_faculty=="ATMA"){ echo "selected";}?>>Institute of The Malay World and Civilization (ATMA)</option>
                                                <option value="PERMATApintar" <?php if($selected_faculty=="PERMATApintar"){ echo "selected";}?>>Pusat PERMATApintar Negara</option>
                                                <option value="INBIOSIS" <?php if($selected_faculty=="INBIOSIS"){ echo "selected";}?>>Institute of Systems Biology (INBIOSIS)</option>
                                                <option value="IKMAS" <?php if($selected_faculty=="IKMAS"){ echo "selected";}?>>Institute of Malaysian and International Studies (IKMAS)</option>
                                                <option value="HADHARI" <?php if($selected_faculty=="HADHARI"){ echo "selected";}?>>Institute of Islam Hadhari (HADHARI)</option>
                                                <option value="UMBI" <?php if($selected_faculty=="UMBI"){ echo "selected";}?>>UKM Medical Molecular Biology Institute (UMBI)</option>
                                                <option value="Others">Others</option>
                                                </select>
                                            </div>
                                            <br>
                                            <input type="text" name="faculty_others" id="faculty_others" class="form-control" placeholder="State if Others" value="<?php echo $selected_faculty;?>">
                                            <?php }else{ ?>
                                            <input type="text" name="faculty" id="faculty" class="form-control" placeholder="Faculty/Institute..." required value="<?php echo $selected_faculty;?>">
                                            <?php } ?>
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
                                                <input type="text" name="startyear" id="startyear" class="form-control" placeholder="Start Year..."  value="<?php echo $row['std_start_year'];?>" required>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>End Year (required for completed)</label>
                                                <input type="text" name="endyear" id="endyear" class="form-control" placeholder="End Year..." value="<?php echo $row['std_end_year'];?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Research Title (optional)</label>
                                                <input type="text" name="researchtitle" id="researchtitle" class="form-control" placeholder="Research Title..." value="<?php echo $row['std_research_title'];?>" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Supervisor Status</label>
                                                <select name="sv_status" id="sv_status" class="form-control">
                                                    <option value="0" <?php if($selected_svstatus==0){ echo "selected='selected'";}?>>Main Supervisor</option>
                                                    <option value="1" <?php if($selected_svstatus==1){ echo "selected='selected'";}?>>Co-Supervisor</option>
                                                    <option value="2" <?php if($selected_svstatus==2){ echo "selected='selected'";}?>>Pending</option>
                                                    <option value="3" <?php if($selected_svstatus==3){ echo "selected='selected'";}?>>Committee</option>
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
                                                while($row2=mysqli_fetch_array($grantsql)){
                                                    $grant_code = $row2['grant_code'];?>
                                                    <option value="<?php echo $grant_code;?>" <?php if($selected_funding == $grant_code){ echo "selected";}?>> <?php echo $row2['grant_title'];?> (<?php echo $row2['grant_code'];?>)</option>
                                                <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>Student Picture (Max 3MB)</label>
                                                <input type="file" name="stdPicture" id="stdPicture"/>
                                                Original File: <?php if($row['std_picture'] != "no_image.jpg") echo $row['std_picture']; else echo "No image";?>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <input type="hidden" name="std_id" id="std_id" value="<?php echo $sqlgetid;?>"/>
                                    <button type="submit" name="edit-button" class="btn btn-info btn-fill pull-right">Submit</button>
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
