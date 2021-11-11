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
    $year = mysqli_real_escape_string($conn,$_POST['year']);
    $semester = mysqli_real_escape_string($conn,$_POST['semester']);
    $code = mysqli_real_escape_string($conn,$_POST['code']);
    $title = mysqli_real_escape_string($conn,$_POST['title']);
    $type = mysqli_real_escape_string($conn,$_POST['type']);

    if($errorCode == NULL){

        $query = "UPDATE tbl_teaching SET academic_year='$year', semester='$semester', course_code='$code', course_title='$title',
        graduate_code='$type' where id='$sqlgetid' AND super_owner='$super_owner'";

        $sql = mysqli_query($conn, $query);

        if($sql === false){
            $errorCode = "SQL_DB_FAILED";
            $errorMsg = "There's a problem with MySQL Database. Please contact administrator.<br>Error Details: ". mysqli_error();
            $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
            $_SESSION['academicprofile_success_msg'] = NULL;
            header("location:../teaching.php");
        }

    }

    if($errorCode == NULL){
        $_SESSION['academicprofile_success_msg'] = "You have successfully updated the course!";
        $_SESSION['academicprofile_error_msg'] = NULL;
        header("location:../teaching.php");
    } 
}else{
    echo "Nothing to see here!";
}
?>