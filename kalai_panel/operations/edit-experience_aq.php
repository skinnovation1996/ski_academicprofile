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
    $title = mysqli_real_escape_string($conn,$_POST['title']);
    $award = mysqli_real_escape_string($conn,$_POST['award']);
    $dateinput = mysqli_real_escape_string($conn,$_POST['date']);

    if($errorCode == NULL){

        $query = "UPDATE tbl_academic_qualification SET academic_title='$title', 
        academic_award_uni='$award', academic_date='$dateinput' WHERE id='$sqlgetid' AND super_owner='$super_owner'";

        $sql = mysqli_query($conn, $query);

        if($sql === false){
            $errorCode = "SQL_DB_FAILED";
            $errorMsg = "There's a problem with MySQL Database. Please contact administrator.<br>Error Details: ". mysqli_error();
            $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
            $_SESSION['academicprofile_success_msg'] = NULL;
            header("location:../experience_aq.php");
        }

    }

    if($errorCode == NULL){
        $_SESSION['academicprofile_success_msg'] = "You have successfully updated the academic qualification experience!";
        $_SESSION['academicprofile_error_msg'] = NULL;
        header("location:../experience_aq.php");
    } 
}else{
    echo "Nothing to see here!";
}
?>