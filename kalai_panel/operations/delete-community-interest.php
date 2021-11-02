<?php
require_once("../assets/php/chk-session.php");
include("../assets/php/connectdb.php");
include("../assets/php/password.php");
date_default_timezone_set("Asia/Kuala_Lumpur");

$errorCode = "";
$errorMsg = "";
$successMsg = "";


if(isset($_POST['delete-button'])){
    $sqlgetid = $_POST['oldid'];
    $super_owner = $login_super_owner;

    $sql = mysqli_query($conn, "SELECT program_title from tbl_community WHERE id='$sqlgetid' AND super_owner='$super_owner'");
    $row = mysqli_fetch_array($sql);
    $programtitle = $row['program_title'];
    $notspecified = "Not Specified";

    if($errorCode == NULL){

        $query = "DELETE FROM tbl_community WHERE id='$sqlgetid' AND super_owner='$super_owner'";

        $sql = mysqli_query($conn, $query);

        if($sql === false){
            $errorCode = "SQL_DB_FAILED";
            $errorMsg = "There's a problem with MySQL Database. Please contact administrator.<br>Error Details: ". mysqli_error();
            $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
            $_SESSION['academicprofile_success_msg'] = "";
            header("location:../community-interests.php");
        }

    }

    if($errorCode == NULL){
        //DON'T FORGET TO SET THEM TO NOT SPECIFIED FOR STUDENTS
        $sql1a = mysqli_query($conn, "UPDATE tbl_students SET std_activity='$notspecified' WHERE std_activity='$programtitle' AND super_owner='$super_owner'");
        
        $sql2 = mysqli_query($conn, "ALTER TABLE tbl_community drop `id`");

        $sql3 = mysqli_query($conn, "ALTER TABLE tbl_community add `id` int not null auto_increment primary key first");

        $_SESSION['academicprofile_success_msg'] = "You have successfully removed the community interest!";
        $_SESSION['academicprofile_error_msg'] = NULL;
        header("location:../community-interests.php");
    } 
}else{
    echo "Nothing to see here!";
}
?>