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

	<title>Journals - Academic Profile <?php echo $user_role;?></title>

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

            <?php $navactive = 5; include("assets/php/$navbar");?>
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
                    <a class="navbar-brand" href="journals.php">Journals</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-left">
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<p class="hidden-lg hidden-md">Journals</p>
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
                                <h4 class="title">Journals</h4>
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
                                    	<th width="45%" style="text-align:center">Journal Title</th>
                                        <th width="40%" style="text-align:center">Authors</th>
                                        <th width="10%" style="text-align:center">Year</th>
                                        <th width="10%" style="text-align:center">Actions</th>
                                    </thead>
                                    <tbody>
                                    <button type= "button" data-toggle="modal" data-target="#AddData" class="add-data btn btn-success btn-sm">+ Add New Journal</button>
                                        <?php
                                        if($user_role != "Student"){
                                            $sql = mysqli_query($conn, "SELECT * from tbl_journals WHERE super_owner='$login_super_owner' ORDER BY journal_year DESC");
                                        }else if($user_role == "Student"){
                                            $sql = mysqli_query($conn, "SELECT * from tbl_journals WHERE journal_owner='$login_session' AND super_owner='$login_super_owner' ORDER BY journal_year DESC");
                                        }
                                        $rows = mysqli_num_rows($sql);
                                              
                                        if($rows){
                                            $count = 1;
                                            while($row=mysqli_fetch_array($sql)){
                                                if($user_role == "Student"){
                                                    if($row['authors'] == $your_name){
                                                        $authorsinput = "";
                                                    }else{
                                                        $authorsinput = str_replace("$your_name, ","",$row['authors']);
                                                    }
                                                }else{
                                                    $authorsinput = $row['authors'];
                                                }
                                                
                                        ?>
                                        <tr>
                                            <td><?php echo $count++;?></td>
                                            <td><?php echo $row['journal_title'];?></a></td>
                                            <td><?php echo $row['authors'];?></td>
                                            <td><?php echo $row['journal_year'];?></td>
                                            <td><button type="button" data-toggle="modal" data-id="<?php echo $row['id'];?>" data-authors="<?php echo $authorsinput;?>" data-title="<?php echo $row['journal_title'];?>" 
                                            data-year="<?php echo $row['journal_year'];?>" data-name="<?php echo $row['journal_name'];?>" data-volume="<?php echo $row['journal_volume'];?>"
                                            data-pagenum="<?php echo $row['journal_pagenum'];?>" data-owner="<?php echo $row['journal_owner'];?>" data-file="<?php echo $row['journal_file'];?>" 
                                            data-target="#EditData" class="edit-data btn btn-primary btn-sm">EDIT</button>
                                            <a class="btn btn-success btn-sm" role="button"
                                            <?php 
                                            if($row['journal_file'] == NULL){ 
                                                echo "disabled";
                                            }
                                            else{
                                                $file = $row['journal_file'];
                                                echo "href='uploads/journals/$file'";
                                            }
                                            ?>>DOWNLOAD</a>
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
		  	<form id="adddata" name="adddata" method="post" enctype="multipart/form-data" action="operations/add-journal.php">
        		<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Add Journal</h4>
				</div>
				<div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Authors</label>
                                <input type="text" name="authors" id="authors" class="form-control" <?php if($user_role != "Student"){ echo "placeholder='Authors...' required"; }else { echo "placeholder='Authors (leave blank if you work alone)...'"; }?>>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Journal Title (HTML Tags Allowed)</label>
                                <input type="text" name="title" id="title" class="form-control" placeholder="Journal Title..." required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Journal Name</label>
                                <input type="text" name="names" id="names" class="form-control" placeholder="Journal Name..." required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Journal Year</label>
                                <input type="text" name="year" id="year" class="form-control" placeholder="Year..." required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Volume (optional)</label>
                                <input type="text" name="volume" id="volume" class="form-control" placeholder="Volume...">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Page Number(s) (optional)</label>
                                <input type="text" name="pagenum" id="pagenum" class="form-control" placeholder="Page Number(s)...">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>File (optional, Max 3MB)</label>
                                <input type="file" name="journalfile" id="journalfile">
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="owner" id="owner" value="<?php echo $login_session;?>" />
					
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
		  	<form id="editdata" name="editdata" method="post" enctype="multipart/form-data" action="operations/edit-journal.php">
        		<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Edit Journal</h4>
				</div>
				<div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Authors</label>
                                <input type="text" name="authors" id="authors" class="form-control" <?php if($user_role != "Student"){ echo "placeholder='Authors...' required"; }else { echo "placeholder='Authors (leave blank if you work alone)...'"; }?>>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Journal Title (HTML Tags Allowed)</label>
                                <input type="text" name="title" id="title" class="form-control" placeholder="Journal Title..." required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Journal Name</label>
                                <input type="text" name="names" id="names" class="form-control" placeholder="Journal Name..." required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Journal Year</label>
                                <input type="text" name="year" id="year" class="form-control" placeholder="Year..." required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Volume (optional)</label>
                                <input type="text" name="volume" id="volume" class="form-control" placeholder="Volume...">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Page Number(s) (optional)</label>
                                <input type="text" name="pagenum" id="pagenum" class="form-control" placeholder="Page Number(s)...">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>File (optional, Max 3MB)</label>
                                <input type="file" name="journalfile" id="journalfile">
                                Original File: <span name="ori_file" id="ori_file"></span>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="owner" id="owner" value="<?php echo $login_session;?>" />
                    <input type="hidden" name="oldid" id="oldid" value=""/>
                    <input type="hidden" name="oldfile" id="oldfile"/>
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
        <form action="operations/delete-journal.php" method="post" class="form-horizontal" enctype="multipart/form-data">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Are You Sure?</h4>
        </div>
        <div class="modal-body">
          <p>WARNING! Are you sure to delete this journal?</p>
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
				var dataAuthors = $(this).data('authors');
                var dataYear = $(this).data('year');
                var dataName = $(this).data('name');
                var dataVolume = $(this).data('volume');
                var dataPageNum = $(this).data('pagenum');
                var dataFile = $(this).data('file');
				$(".modal-body #title").val( dataTitle );
                $(".modal-body #authors").val( dataAuthors );
                $(".modal-body #year").val( dataYear );
                $(".modal-body #names").val( dataName );
                $(".modal-body #volume").val( dataVolume );
                $(".modal-body #pagenum").val( dataPageNum );
                $(".modal-body #oldfile").val( dataFile );
                document.getElementById("#ori_file").innerHTML=dateFile;
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
