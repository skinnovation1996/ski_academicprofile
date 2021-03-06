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
    $type = mysqli_real_escape_string($conn,$_POST['type']);
    $event = mysqli_real_escape_string($conn,$_POST['event']);
    $dateinput = mysqli_real_escape_string($conn,$_POST['date']);
    $location = mysqli_real_escape_string($conn,$_POST['location']);
    if($errorCode == NULL){

        $query = "INSERT INTO tbl_scholarly_activities (scholarly_type, scholarly_event, scholarly_date, scholarly_location, super_owner) 
        VALUES ('$type','$event','$dateinput','$location','$super_owner')";

        $sql = mysqli_query($conn, $query);

        if($sql === false){
            $errorCode = "SQL_DB_FAILED";
            $errorMsg = "There's a problem with MySQL Database. Please contact administrator.<br>Error Details: ". mysqli_error();
            $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
            $_SESSION['academicprofile_success_msg'] = NULL;
            header("location:../experience_sa.php");
        }

    }

    if($errorCode == NULL){
        $_SESSION['academicprofile_success_msg'] = "You have successfully added the scholarly activities experience!";
        $_SESSION['academicprofile_error_msg'] = NULL;
        header("location:../experience_sa.php");
    } 
}else{
    echo "Nothing to see here!";
}
?>