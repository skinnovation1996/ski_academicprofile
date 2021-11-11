<?php
require_once("../assets/php/chk-session.php");
include("../assets/php/connectdb.php");
include("../assets/php/password.php");
date_default_timezone_set("Asia/Kuala_Lumpur");

$errorCode = "";
$errorMsg = "";
$successMsg = "";


if(isset($_POST['edit-button'])){
    $sqlgetid = $_POST['oldid'];
    $super_owner = $login_super_owner;
    $category = mysqli_real_escape_string($conn,$_POST['category']);
    $niche = mysqli_real_escape_string($conn,$_POST['niche']);
    $target = mysqli_real_escape_string($conn,$_POST['target']);
    $location = mysqli_real_escape_string($conn,$_POST['location']);
    $dateinput = mysqli_real_escape_string($conn,$_POST['date']);
    $title = mysqli_real_escape_string($conn,$_POST['title']);
    $members = mysqli_real_escape_string($conn,$_POST['members']);
    $funding = mysqli_real_escape_string($conn,$_POST['funding']);
    $workpartner = mysqli_real_escape_string($conn,$_POST['workpartner']);

    if($errorCode == NULL){

        $query = "UPDATE tbl_community set category='$category', category_niche='$niche', community_target='$target', community_location='$location', 
        program_date='$dateinput', program_title='$title', program_members='$members', program_funding='$funding', program_work_partner='$workpartner'
        WHERE id='$sqlgetid' AND super_owner='$super_owner'";

        $sql = mysqli_query($conn, $query);

        if($sql === false){
            $errorCode = "SQL_DB_FAILED";
            $errorMsg = "There's a problem with MySQL Database. Please contact administrator.<br>Error Details: ". mysqli_error();
            $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
            $_SESSION['academicprofile_success_msg'] = NULL;
            header("location:../community-interests.php");
        }

    }

    if($errorCode == NULL){
        $_SESSION['academicprofile_success_msg'] = "You have successfully updated the community interest!";
        $_SESSION['academicprofile_error_msg'] = NULL;
        header("location:../community-interests.php");
    } 
}else{
    echo "Nothing to see here!";
}
?>