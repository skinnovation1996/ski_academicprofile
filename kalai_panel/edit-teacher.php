<?php
require_once("assets/php/chk-session.php");
require_once("assets/php/connectdb.php");
$uploaderror = 0;
$successmsg = "";
$errormsg = "";
$modalmessage = "";

//for SUPER ADMIN ONLY
if($user_role != "Super Admin"){
    header("location:index.php");
}

if(empty($_GET['id'])){
	header('location:teachers.php');
}
else{
	$sqlgetid = $_GET['id'];
}

$sqla = mysqli_query($conn, "SELECT * from tbl_admin WHERE id='$sqlgetid' AND role='Teacher' AND admin_id NOT LIKe 'super_admin'"); 
$rows = mysqli_num_rows($sqla);
if($rows == NULL){
    header('location:teachers.php');
}
$row=mysqli_fetch_array($sqla);
$admin_id = $row['admin_id'];

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

	<title>Edit Teacher - Academic Profile Super Admin</title>

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
                    Academic Profile Super Admin
                </a>
            </div>

            <?php $navactive = 4; include("assets/php/SuperAdmin-navbar.php");?>
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
                    <a class="navbar-brand" href="teachers.php"><<</a><a class="navbar-brand" href="edit-teacher.php?id=<?php echo $sqlgetid;?>">Edit Teacher</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-left">
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<p class="hidden-lg hidden-md">Edit Teacher</p>
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
                                <h4 class="title">Edit Teacher</h4>
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
                                <form id="adddata" name="adddata" method="post" enctype="multipart/form-data" action="operations/edit-teacher.php">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>User ID</label>
                                                <input type="text" name="user_id" id="user_id" class="form-control" placeholder="User ID..." value="<?php echo $row['admin_id'];?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>Full Name</label>
                                                <input type="text" name="name" id="name" class="form-control" placeholder="Full Name..." value="<?php echo $row['admin_name'];?>" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Tagline</label>
                                                <input type="text" name="tagline" id="tagline" class="form-control" placeholder="Tagline..." value="<?php echo $row['tagline'];?>" required>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Department/Faculty</label>
                                                <input type="text" name="department" id="department" class="form-control" placeholder="Department/Faculty..." value="<?php echo $row['department'];?>" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>School/Institute/University</label>
                                                <input type="text" name="university" id="university" class="form-control" placeholder="School/Institute/University..." value="<?php echo $row['university'];?>"  required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>City</label>
                                                <input type="text" name="city" id="city" class="form-control" placeholder="City..." value="<?php echo $row['city'];?>" required>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Postcode</label>
                                                <input type="text" name="postcode" id="postcode" class="form-control" placeholder="Postcode..." value="<?php echo $row['postcode'];?>" required>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Academic Level</label>
                                                <input type="text" name="academic_level" id="academic_level" class="form-control" placeholder="Academic Level..." value="<?php echo $row['education_level'];?>" required>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Phone Number (optional)</label>
                                                <input type="text" name="tel" id="tel" class="form-control" placeholder="Phone Number (optional)..." value="<?php echo $row['tel'];?>" >
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Fax Number (optional)</label>
                                                <input type="text" name="fax" id="fax" class="form-control" placeholder="Fax Number (optional)..." value="<?php echo $row['fax'];?>" >
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>E-Mail (optional)</label>
                                                <input type="email" name="email" id="email" class="form-control" placeholder="E-Mail (optional)..." value="<?php echo $row['email'];?>" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Country</label>
                                                <select name="country" id="country" class="form-control">
                                                    <?php $sql2 = mysqli_query($conn, "select country from tbl_countries");
                                                    while($row2=mysqli_fetch_assoc($sql2)){
                                                        $country = $row2['country'];
                                                        echo "<option value='$country'";
                                                        if($country=="Malaysia"){
                                                            echo " selected='selected'";
                                                        }
                                                        echo ">$country</option>";
                                                    }?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label>Specializations</label>
                                                <input type="text" name="specializations" id="specializations" class="form-control" placeholder="Specializations..." value="<?php echo $row['specializations'];?>" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Facebook (optional)</label>
                                                <input type="text" name="facebook" id="facebook" class="form-control" placeholder="Facebook (optional)..." value="<?php echo $row['facebook'];?>" >
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Instagram (optional)</label>
                                                <input type="text" name="instagram" id="instagram" class="form-control" placeholder="Instagram (optional)..." value="<?php echo $row['instagram'];?>" >
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Twitter (optional)</label>
                                                <input type="text" name="twitter" id="twitter" class="form-control" placeholder="Twitter (optional)..." value="<?php echo $row['twitter'];?>" >
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Linkedin (optional)</label>
                                                <input type="text" name="linkedin" id="linkedin" class="form-control" placeholder="Linkedin (optional)..." value="<?php echo $row['linkedin'];?>" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Profile Picture (Max 3MB)</label>
                                                <input type="file" name="profilePicture" id="profilePicture"/>
                                                Original File: <?php if($row['profile_pic'] != "no_image.jpg") echo $row['profile_pic']; else echo "No image";?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Front Page Picture (Max 3MB)</label>
                                                <input type="file" name="frontPicture" id="frontPicture"/>
                                                Original File: <?php if($row['front_pic'] != "no_image.jpg") echo $row['front_pic']; else echo "No image";?>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="id" value="<?php echo $sqlgetid;?>" id="id" />
                                    <input type="hidden" name="oldfile" value="<?php echo $row['profile_pic'];?>" id="oldfile" />
                                    <input type="hidden" name="oldfile2" value="<?php echo $$row['front_pic'];?>" id="oldfile2" />
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
