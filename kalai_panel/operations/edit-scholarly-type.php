<?php
require_once("../assets/php/chk-session.php");
include("../assets/php/connectdb.php");
include("../assets/php/password.php");
date_default_timezone_set("Asia/Kuala_Lumpur");

$errorCode = "";
$errorMsg = "";
$successMsg = "";


if(isset($_POST['edit-button'])){
    $sqlgetid = mysqli_real_escape_string($conn,$_POST['oldid']);
    $title = mysqli_real_escape_string($conn,$_POST['title']);
    $super_owner = $login_super_owner;
    if($errorCode == NULL){

        $query = "UPDATE tbl_scholarly_types SET scholarly_type_title='$title' WHERE id='$sqlgetid' AND super_owner='$super_owner'";

        $sql = mysqli_query($conn, $query);

        if($sql === false){
            $errorCode = "SQL_DB_FAILED";
            $errorMsg = "There's a problem with MySQL Database. Please contact administrator.<br>Error Details: ". mysqli_error();
            $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
            $_SESSION['academicprofile_success_msg'] = "";
            header("location:../scholarly_types.php");
        }

    }

    if($errorCode == NULL){
        $_SESSION['academicprofile_success_msg'] = "You have successfully edited the scholarly type!";
        $_SESSION['academicprofile_error_msg'] = NULL;
        header("location:../scholarly_types.php");
    } 
}else{
    echo "Nothing to see here!";
}
?>