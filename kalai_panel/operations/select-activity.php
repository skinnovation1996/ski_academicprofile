<?php
require_once("../assets/php/chk-session.php");
include("../assets/php/connectdb.php");
include("../assets/php/password.php");
date_default_timezone_set("Asia/Kuala_Lumpur");

$errorCode = "";
$errorMsg = "";
$successMsg = "";


if(isset($_POST['submit-button'])){
    $owner = $login_session;
    $super_owner = $login_super_owner;
    $activity = mysqli_real_escape_string($conn,$_POST['activity']);
    $datetime = date('Y-m-d H:i:s');

    if($errorCode == NULL){

        $query = "UPDATE tbl_students set std_activity='$activity' where std_reg_num='$owner' AND super_owner='$super_owner'";

        $sql = mysqli_query($conn, $query);

        if($sql === false){
            $errorCode = "SQL_DB_FAILED";
            $errorMsg = "There's a problem with MySQL Database. Please contact administrator.<br>Error Details: ". mysqli_error();
            $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
            $_SESSION['academicprofile_success_msg'] = NULL;
            header("location:../student-activity.php");
        }

    }

    if($errorCode == NULL){
        $_SESSION['academicprofile_success_msg'] = "You have successfully set your student activity!";
        $_SESSION['academicprofile_error_msg'] = NULL;
        header("location:../student-activity.php");
    } 
}else{
    echo "Nothing to see here!";
}
?>