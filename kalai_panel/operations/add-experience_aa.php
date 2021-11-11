<?php
require_once("../assets/php/chk-session.php");
include("../assets/php/connectdb.php");
include("../assets/php/password.php");
date_default_timezone_set("Asia/Kuala_Lumpur");

$errorCode = "";
$errorMsg = "";
$successMsg = "";


if(isset($_POST['submit-button'])){
    $super_owner = $login_super_owner;
    $position = mysqli_real_escape_string($conn,$_POST['position']);
    $startdate = mysqli_real_escape_string($conn,$_POST['startdate']);
    $enddate = mysqli_real_escape_string($conn,$_POST['enddate']);
    if($enddate == NULL){
        $enddate = "Present";
    }

    if($errorCode == NULL){

        $query = "INSERT INTO tbl_admin_appointment (admin_position, admin_startdate, admin_enddate, super_owner)
        VALUES ('$position','$startdate','$enddate','$super_owner')";

        $sql = mysqli_query($conn, $query);

        if($sql === false){
            $errorCode = "SQL_DB_FAILED";
            $errorMsg = "There's a problem with MySQL Database. Please contact administrator.<br>Error Details: ". mysqli_error();
            $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
            $_SESSION['academicprofile_success_msg'] = NULL;
            header("location:../experience_aa.php");
        }

    }

    if($errorCode == NULL){
        $_SESSION['academicprofile_success_msg'] = "You have successfully added the administrative appointment experience!";
        $_SESSION['academicprofile_error_msg'] = NULL;
        header("location:../experience_aa.php");
    } 
}else{
    echo "Nothing to see here!";
}
?>