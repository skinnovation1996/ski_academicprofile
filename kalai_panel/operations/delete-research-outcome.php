<?php
require_once("../assets/php/chk-session.php");
include("../assets/php/connectdb.php");
include("../assets/php/password.php");
date_default_timezone_set("Asia/Kuala_Lumpur");

$errorCode = "";
$errorMsg = "";
$successMsg = "";


if(isset($_POST['delete-button'])){
    $super_owner = $login_super_owner;
    $sqlgetid = $_POST['oldid'];

    $selectsql = mysqli_query($conn, "SELECT research_title from tbl_research_outcome where id='$sqlgetid' AND super_owner='$super_owner'");
    $row=mysqli_fetch_array($selectsql);

    $researchtitle = $row['research_title'];
    $notspecified = "Not Specified";

    if($errorCode == NULL){

        $query = "DELETE FROM tbl_research_outcome WHERE id='$sqlgetid' AND super_owner='$super_owner'";

        $sql = mysqli_query($conn, $query);

        if($sql === false){
            $errorCode = "SQL_DB_FAILED";
            $errorMsg = "There's a problem with MySQL Database. Please contact administrator.<br>Error Details: ". mysqli_error();
            $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
            $_SESSION['academicprofile_success_msg'] = NULL;
            header("location:../research-outcomes.php");
        }

    }

    if($errorCode == NULL){
        //DON'T FORGET TO SET THEM TO NOT SPECIFIED FOR STUDENTS
        $sql1a = mysqli_query($conn, "UPDATE tbl_students SET std_research_outcome='$notspecified' WHERE std_research_outcome='$researchtitle' AND super_owner='$super_owner'");
        $sql2 = mysqli_query($conn, "ALTER TABLE tbl_research_outcome DROP `id`");
        $sql3 = mysqli_query($conn, "ALTER TABLE tbl_research_outcome ADD `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST;");

        $_SESSION['academicprofile_success_msg'] = "You have successfully removed the research outcome! In addition, all students' research outcomes are unset.";
        $_SESSION['academicprofile_error_msg'] = NULL;
        header("location:../research-outcomes.php");
    } 
}else{
    echo "Nothing to see here!";
}
?>