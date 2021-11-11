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
    $catcode = mysqli_real_escape_string($conn,$_POST['catcode']);
    $code = mysqli_real_escape_string($conn,$_POST['code']);
    $title = mysqli_real_escape_string($conn,$_POST['title']);
    $funder = mysqli_real_escape_string($conn,$_POST['funder']);
    $amount = mysqli_real_escape_string($conn,$_POST['amount']);
    if($amount == NULL){
        $amount = 0;
    }
    $duration = mysqli_real_escape_string($conn,$_POST['duration']);
    $status = mysqli_real_escape_string($conn,$_POST['status']);

    if($errorCode == NULL){

        $query = "UPDATE tbl_grant SET grant_title='$title', category_code='$catcode', grant_code='$code', grant_funder='$funder',
        grant_amount='$amount', grant_duration='$duration', grant_status='$status' where id='$sqlgetid' AND super_owner='$super_owner'";

        $sql = mysqli_query($conn, $query);

        if($sql === false){
            $errorCode = "SQL_DB_FAILED";
            $errorMsg = "There's a problem with MySQL Database. Please contact administrator.<br>Error Details: ". mysqli_error();
            $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
            $_SESSION['academicprofile_success_msg'] = NULL;
            header("location:../grants.php");
        }

    }

    if($errorCode == NULL){
        $_SESSION['academicprofile_success_msg'] = "You have successfully updated the research grant!";
        $_SESSION['academicprofile_error_msg'] = NULL;
        header("location:../grants.php");
    } 
}else{
    echo "Nothing to see here!";
}
?>