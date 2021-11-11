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
    $title = mysqli_real_escape_string($conn,$_POST['title']);
    $organization = mysqli_real_escape_string($conn,$_POST['organization']);
    $startdate = mysqli_real_escape_string($conn,$_POST['startdate']);
    $enddate = mysqli_real_escape_string($conn,$_POST['enddate']);
    if($enddate == NULL){
        $enddate = "Present";
    }

    if($errorCode == NULL){

        $query = "INSERT INTO tbl_career_history (career_title, career_organization, career_startdate, career_enddate, super_owner)
        VALUES ('$title','$organization','$startdate','$enddate','$super_owner')";

        $sql = mysqli_query($conn, $query);

        if($sql === false){
            $errorCode = "SQL_DB_FAILED";
            $errorMsg = "There's a problem with MySQL Database. Please contact administrator.<br>Error Details: ". mysqli_error();
            $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
            $_SESSION['academicprofile_success_msg'] = NULL;
            header("location:../experience_ch.php");
        }

    }

    if($errorCode == NULL){
        $_SESSION['academicprofile_success_msg'] = "You have successfully added the career history experience!";
        $_SESSION['academicprofile_error_msg'] = NULL;
        header("location:../experience_ch.php");
    } 
}else{
    echo "Nothing to see here!";
}
?>