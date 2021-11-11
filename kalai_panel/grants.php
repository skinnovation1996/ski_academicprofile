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

	<title>Research Grants - Academic Profile <?php echo $user_role;?></title>

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

            <?php $navactive = 4; include("assets/php/Admin-navbar.php");?>
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
                    <a class="navbar-brand" href="grants.php">Research Grants</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-left">
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<p class="hidden-lg hidden-md">Research Grants</p>
                            </a>
                        </li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li>
                           <a href="my-profile.php">
                               <p>My Profile</p>
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
                                <h4 class="title">Research Grants</h4>
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
                                <table id="tlist" class="table table-hover table-striped">
                                    <thead>
                                        <th width="5%" style="text-align:center">No</th>
                                    	<th width="10%" style="text-align:center">Type</th>
                                    	<th width="10%" style="text-align:center">Grant Code</th>
                                        <th width="55%" style="text-align:center">Grant Title</th>
                                        <th width="10%" style="text-align:center">Status</th>
                                        <th width="10%" style="text-align:center">Actions</th>
                                    </thead>
                                    <tbody>
                                    <button type= "button" data-toggle="modal" data-target="#AddData" class="add-data btn btn-success btn-sm">+ Add New Grant</button>
                                        <?php
                                        $sql = mysqli_query($conn, "SELECT * from tbl_grant WHERE super_owner='$login_super_owner'");
                                        $rows = mysqli_num_rows($sql);
                                              
                                        if($rows){
                                            $count = 1;
                                            while($row=mysqli_fetch_array($sql)){
                                                switch($row['category_code']){
                                                    case 0:
                                                        $category = "Leader";
                                                        break;
                                                    case 1:
                                                        $category = "Co-Researcher";
                                                        break;
                                                    default:
                                                        $category = "Group Member";
                                                }

                                                switch($row['grant_status']){
                                                    case 0:
                                                        $status = "Ongoing";
                                                        break;
                                                    case 1:
                                                        $status = "Completed";
                                                        break;
                                                    default:
                                                        $status = "Status";
                                                }
                                        ?>
                                        <tr>
                                            <td><?php echo $count++;?></td>
                                            <td><?php echo $category;?></td>
                                            <td><?php echo $row['grant_code'];?></td>
                                            <td><?php echo $row['grant_title'];?></td>
                                            <td><?php echo $status;?></td>
                                            <td><button type="button" data-toggle="modal" data-id="<?php echo $row['id'];?>" data-category="<?php echo $row['category_code'];?>" data-status="<?php echo $row['grant_status'];?>" 
                                            data-code="<?php echo $row['grant_code'];?>" data-title="<?php echo $row['grant_title'];?>" data-funder="<?php echo $row['grant_funder'];?>" 
                                            data-amount="<?php echo $row['grant_amount'];?>" data-duration="<?php echo $row['grant_duration'];?>" data-target="#EditData" class="edit-data btn btn-primary btn-sm">EDIT</button>
                                            <button type="button" data-toggle="modal" data-id="<?php echo $row['id'];?>" data-target="#ConfirmDelete" class="delete-data btn btn-danger btn-sm">DELETE</button></td>
                                        </tr>
                                        <?php } } ?>
                                    </tbody>
                                </table>

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


<!-- Add Data Modal -->
<div class="modal fade" id="AddData" role="dialog">
	<div class="modal-dialog">
    
    	<!-- Modal content-->
      	<div class="modal-content">
		  	<form id="adddata" name="adddata" method="post" enctype="multipart/form-data" action="operations/add-grant.php">
        		<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Add Research Grant</h4>
                    <p class="category">Your first research grant is free. For each research grant added, 30 credits will be deducted from your credit balance.</p>
				</div>
				<div class="modal-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Grant Category</label>
                                <select name="catcode" id="catcode" class="form-control" required>
                                    <option value="0">Leader</option>
                                    <option value="1">Co-Researcher</option>
                                    <option value="2">Group Member</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group">
                                <label>Grant Title (HTML Tags Allowed)</label>
                                <input type="text" name="title" id="title" class="form-control" placeholder="Grant Title..." required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Grant Code</label>
                                <input type="text" name="code" id="code" class="form-control" placeholder="Grant Code..." required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Grant Funder</label>
                                <input type="text" name="funder" id="funder" class="form-control" placeholder="Grant Funder..." required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Amount (optional)</label>
                                <input type="number" name="amount" id="amount" class="form-control" placeholder="Amount...">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Duration (start-end year)</label>
                                <input type="text" name="duration" id="duration" class="form-control" placeholder="Duration..." required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" id="status" class="form-control" required>
                                    <option value="0">Ongoing</option>
                                    <option value="1">Completed</option>
                                    <option value="2">Status</option>
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
		  	<form id="editdata" name="editdata" method="post" enctype="multipart/form-data" action="operations/edit-grant.php">
        		<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Edit Research Grant</h4>
				</div>
				<div class="modal-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Grant Category</label>
                                <select name="catcode" id="catcode" class="form-control" required>
                                    <option value="0">Leader</option>
                                    <option value="1">Co-Researcher</option>
                                    <option value="2">Group Member</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group">
                                <label>Grant Title (HTML Tags Allowed)</label>
                                <input type="text" name="title" id="title" class="form-control" placeholder="Grant Title..." required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Grant Code</label>
                                <input type="text" name="code" id="code" class="form-control" placeholder="Grant Code..." required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Grant Funder</label>
                                <input type="text" name="funder" id="funder" class="form-control" placeholder="Grant Funder..." required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Amount (optional)</label>
                                <input type="number" name="amount" id="amount" class="form-control" placeholder="Amount...">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Duration (start-end year)</label>
                                <input type="text" name="duration" id="duration" class="form-control" placeholder="Duration..." required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" id="status" class="form-control" required>
                                    <option value="0">Ongoing</option>
                                    <option value="1">Completed</option>
                                    <option value="2">Status</option>
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
        <form action="operations/delete-grant.php" method="post" class="form-horizontal" enctype="multipart/form-data">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Are You Sure?</h4>
        </div>
        <div class="modal-body">
          <p>WARNING! Are you sure to delete this research grant?</p>
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
                $(".modal-body #oldid").val( dataId );

				var dataTitle = $(this).data('title');
				var dataCategory = $(this).data('category');
                var dataCode = $(this).data('code');
                var dataFunder = $(this).data('funder');
                var dataAmount = $(this).data('amount');
                var dataDuration = $(this).data('duration');
                var dataStatus = $(this).data('status');
				$(".modal-body #title").val( dataTitle );
                $(".modal-body #catcode").val( dataCategory );
                $(".modal-body #code").val( dataCode );
                $(".modal-body #funder").val( dataFunder );
                $(".modal-body #amount").val( dataAmount );
                $(".modal-body #duration").val( dataDuration );
                $(".modal-body #status").val( dataStatus );
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
