<?php
require_once("assets/php/chk-session.php");
require_once("assets/php/connectdb.php");
$uploaderror = 0;
$successmsg = "";
$errormsg = "";
$modalmessage = "";

//not for SUPER ADMIN
if($user_role == "Super Admin"){
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

	<title>Research Outcomes - Academic Profile <?php echo $user_role;?></title>

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

            <?php $navactive = 14; include("assets/php/$navbar");?>
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
                    <a class="navbar-brand" href="research-outcomes.php">Research Outcomes</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-left">
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<p class="hidden-lg hidden-md">Research Outcomes</p>
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
                                <h4 class="title">Research Outcomes</h4>
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
                                <?php if($user_role != "Student"){ ?>
                                <table id="tlist" class="table table-hover table-striped">
                                    <thead>
                                        <th width="5%" style="text-align:center">No</th>
                                    	<th width="60%" style="text-align:center">Research Title</th>
                                        <th width="25%" style="text-align:center">Research URL</th>
										<th width="20%" style="text-align:center">Owner (Matric No)</th>
                                        <th width="10%" style="text-align:center">Actions</th>
                                    </thead>
                                    <tbody>
                                    <button type= "button" data-toggle="modal" data-target="#AddData" class="add-data btn btn-success btn-sm">+ Add New Research Outcome</button>
                                    <?php if($user_role != "Student"){ ?>
                                    <a href="research-ip.php" role="button" class="btn btn-primary btn-sm">Manage Intellectual Properties</a>
                                    <?php } ?>
                                        <?php
                                        $sql = mysqli_query($conn, "SELECT * from tbl_research_outcome WHERE super_owner='$login_super_owner'");
                                        $rows = mysqli_num_rows($sql);
                                              
                                        if($rows){
                                            $count = 1;
                                            while($row=mysqli_fetch_array($sql)){
                                        ?>
                                        <tr>
                                            <td><?php echo $count++;?></td>
                                            <td><?php echo $row['research_title'];?></td>
                                            <td><?php echo $row['research_link'];?></td>
                                            <td><?php echo $row['research_owner'];?></td>
                                            <td><button type="button" data-toggle="modal" data-id="<?php echo $row['id'];?>" data-title="<?php echo $row['research_title'];?>" data-link="<?php echo $row['research_link'];?>" 
                                            data-owner="<?php echo $row['research_owner'];?>" data-ip="<?php echo $row['research_ip'];?>" data-target="#EditData" class="edit-data btn btn-primary btn-sm">EDIT</button>
                                            <button type="button" data-toggle="modal" data-id="<?php echo $row['id'];?>" data-target="#ConfirmDelete" class="delete-data btn btn-danger btn-sm">DELETE</button></td>
                                        </tr>
                                        <?php } } ?>
                                    </tbody>
                                </table>
                                <?php }else if($user_role == "Student"){ 
                                    $sqla = mysqli_query($conn, "select std_research_outcome from tbl_students WHERE std_reg_num='$login_session' AND super_owner='$login_super_owner'"); 
                                    $row=mysqli_fetch_assoc($sqla);
                                    $youroutcome = $row['std_research_outcome'];
                                    ?>
                                    <form id="selectoutcome" name="selectoutcome" method="post" enctype="multipart/form-data" action="operations/select-outcome.php">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Your Chosen Research Outcome</label>
                                                    <select name="outcome" id="outcome" class="form-control">
                                                        <option value="Not Specified">Not Specified</option>    
                                                        <?php 
                                                        $sql2 = mysqli_query($conn, "SELECT * from tbl_research_outcome where (research_owner='Student' OR research_owner='$login_session') AND super_owner='$login_super_owner'");
                                                        while($row2=mysqli_fetch_assoc($sql2)){
                                                            $title = $row2['research_title'];
                                                            $owner = $row2['research_owner'];
                                                            echo "<option value='$title'";
                                                            if($title == $youroutcome){
                                                                echo " selected='selected'";
                                                            }
                                                            echo ">$title</option>";
                                                        }?>
                                                    </select>
                                                </div>
                                            </div>
                                        
                                        </div>
                                        
                                        <button type="submit" name="submit-button" class="btn btn-info btn-fill pull-right">Submit</button>
                                        <div class="clearfix"></div>
                                    </form>


                                <?php } ?>
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

<?php if($user_role != "Student"){ ?>
<!-- Add Data Modal -->
<div class="modal fade" id="AddData" role="dialog">
	<div class="modal-dialog">
    
    	<!-- Modal content-->
      	<div class="modal-content">
		  	<form id="adddata" name="adddata" method="post" enctype="multipart/form-data" action="operations/add-research-outcome.php">
        		<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Add Research Outcome</h4>
				</div>
				<div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" name="title" id="title" class="form-control" placeholder="Title..." required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Research IP</label>
                                <select name="researchip" id="researchip" class="form-control">
                                    <option value='None'>None</option>
                                    <?php $sql2 = mysqli_query($conn, "SELECT research_ip_id, research_ip_title from tbl_research_ip WHERE super_owner='$login_super_owner'");
                                    while($row=mysqli_fetch_assoc($sql2)){
                                        $id = $row['research_ip_id'];
                                        $title = $row['research_ip_title'];
                                        echo "<option value='$id'>$title ($id)</option>";
                                    }?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Research URL/Link</label>
                                <input type="text" name="url" id="url" class="form-control" placeholder="Research URL/Link..." required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Research Owner</label>
                                <select name="owner" id="owner" class="form-control">
                                    <option value='<?php echo $login_super_owner;?>'><?php echo $your_name;?></option>
                                    <?php
                                    $sql2 = mysqli_query($conn, "SELECT std_reg_num, std_name FROM tbl_students WHERE super_owner='$login_session'");
                                    while($row3 = mysqli_fetch_assoc($sql2)){
                                        $stdid = $row3['std_reg_num'];
                                        $stdname = $row3['std_name'];

                                    ?>
                                    <option value='<?php echo $stdid;?>'><?php echo "$stdname ($stdid -- Student)";?></option>
                                    <?php
                                    }
                                    ?>
                                    
                                </select>
                            </div>
                        </div>
                    </div>
					
				</div>
        		<div class="modal-footer">
					<input type="submit" name="submit-button" id="submit-button" value="Submit" class="btn btn-success" />
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        		</div>
        	</form>
      	</div>
      
    </div>
</div>

<!-- Edit Data Modal -->
<div class="modal fade" id="EditData" role="dialog">
	<div class="modal-dialog">
    
    	<!-- Modal content-->
      	<div class="modal-content">
		  	<form id="editdata" name="editdata" method="post" enctype="multipart/form-data" action="operations/edit-research-outcome.php">
        		<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Edit Research Outcome</h4>
				</div>
				<div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" name="title" id="title" class="form-control" placeholder="Title..." required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Research IP</label>
                                <select name="researchip" id="researchip" class="form-control">
                                    <option value='None'>None</option>
                                    <?php $sql2 = mysqli_query($conn, "SELECT research_ip_id, research_ip_title from tbl_research_ip WHERE super_owner='$login_super_owner'");
                                    while($row=mysqli_fetch_assoc($sql2)){
                                        $id = $row['research_ip_id'];
                                        $title = $row['research_ip_title'];
                                        echo "<option value='$id'>$title ($id)</option>";
                                    }?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Research URL/Link</label>
                                <input type="text" name="url" id="url" class="form-control" placeholder="Research URL/Link..." required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Research Owner</label>
                                <select name="owner" id="owner" class="form-control">
                                    <option value='<?php echo $login_super_owner;?>'><?php echo $your_name;?></option>
                                    <?php
                                    $sql2 = mysqli_query($conn, "SELECT std_reg_num, std_name FROM tbl_students WHERE super_owner='$login_session'");
                                    while($row3 = mysqli_fetch_assoc($sql2)){
                                        $stdid = $row3['std_reg_num'];
                                        $stdname = $row3['std_name'];
                                    ?>
                                    <option value='<?php echo $stdid;?>'><?php echo "$stdname ($stdid -- Student)";?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="oldid" id="oldid" value=""/>
                </div>
				
        		<div class="modal-footer">
					<input type="submit" name="edit-button" id="edit-button" value="Submit" class="btn btn-success" />
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        		</div>
        	</form>
      	</div>
      
    </div>
</div>

<!-- Confirm Delete Modal -->
  <div class="modal fade" id="ConfirmDelete" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <form action="operations/delete-research-outcome.php" method="post" class="form-horizontal" enctype="multipart/form-data">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Are You Sure?</h4>
        </div>
        <div class="modal-body">
          <p>WARNING! Are you sure to delete this research outcome?</p>
          <input type="hidden" name="oldid" id="oldid" value=""/>
        </div>
        <div class="modal-footer">
          <button type="submit" name="delete-button" id="delete-button" class="btn btn-danger">Delete</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
        </form>
      </div>
      
    </div>
  </div>

<?php } ?>

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

	<script type="text/javascript">
    	$(document).ready(function(){

            $('#tlist').DataTable();

        	$(document).on("click", ".edit-data", function () {
                var dataId = $(this).data('id');
				var dataTitle = $(this).data('title');
				var dataLink = $(this).data('link');
                var dataIP = $(this).data('ip');
                var dataOwner = $(this).data('owner');
                $(".modal-body #oldid").val( dataId );
				$(".modal-body #title").val( dataTitle );
                $(".modal-body #url").val( dataLink );
                $(".modal-body #researchip").val( dataIP );
                $(".modal-body #owner").val( dataOwner );
            });

            $(document).on("click", ".delete-data", function () {
                var dataId = $(this).data('id');
                $(".modal-body #oldid").val( dataId );
            });
    	});
	</script>

    <?php
    if($modalmessage != NULL){?>
        <script type='text/javascript'>
        $('#ModalMessage').modal('show');
        </script><?php
    }
    ?>

</html>
