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
    $member = mysqli_real_escape_string($conn,$_POST['member']);
    $status = mysqli_real_escape_string($conn,$_POST['status']);
    $startdate = mysqli_real_escape_string($conn,$_POST['startdate']);
    $enddate = mysqli_real_escape_string($conn,$_POST['enddate']);
    if($enddate == NULL){
        $enddate = "Present";
    }

    if($errorCode == NULL){

        $query = "UPDATE tbl_pro_member SET membership_body='$member', membership_status='$status', 
        membership_startdate='$startdate', membership_enddate='$enddate' WHERE id='$sqlgetid' AND super_owner='$super_owner'";

        $sql = mysqli_query($conn, $query);

        if($sql === false){
            $errorCode = "SQL_DB_FAILED";
            $errorMsg = "There's a problem with MySQL Database. Please contact administrator.<br>Error Details: ". mysqli_error();
            $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
            $_SESSION['academicprofile_success_msg'] = NULL;
            header("location:../experience_pm.php");
        }

    }

    if($errorCode == NULL){
        $_SESSION['academicprofile_success_msg'] = "You have successfully updated the professional membership experience!";
        $_SESSION['academicprofile_error_msg'] = NULL;
        header("location:../experience_pm.php");
    } 
}else{
    echo "Nothing to see here!";
}
?>