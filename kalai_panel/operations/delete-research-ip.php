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
    $sqlgetid = $_GET['oldid'];

    $selectsql = mysqli_query($conn, "SELECT research_ip_id from tbl_research_ip where id='$sqlgetid' AND super_owner='$super_owner'");
    $row=mysqli_fetch_array($selectsql);

    $id = $row['research_ip_id'];
    $notspecified = "None";

    if($errorCode == NULL){

        $query = "DELETE FROM tbl_research_ip WHERE id='$sqlgetid' AND super_owner='$super_owner'";

        $sql = mysqli_query($conn, $query);

        if($sql === false){
            $errorCode = "SQL_DB_FAILED";
            $errorMsg = "There's a problem with MySQL Database. Please contact administrator.<br>Error Details: ". mysqli_error();
            $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
            $_SESSION['academicprofile_success_msg'] = "";
            header("location:../research-ip.php");
        }

    }

    if($errorCode == NULL){
        //DON'T FORGET TO SET THEM TO NONE FOR RESEARCH OUTCOMES
        $sql1a = mysqli_query($conn, "UPDATE tbl_research_outcome SET research_ip='$notspecified' WHERE research_ip='$id' AND super_owner='$super_owner'");
        $sql2 = mysqli_query($conn, "ALTER TABLE tbl_research_ip DROP `id`");
        $sql3 = mysqli_query($conn, "ALTER TABLE tbl_research_ip ADD `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST;");

        $_SESSION['academicprofile_success_msg'] = "You have successfully removed the research intellectual property!";
        $_SESSION['academicprofile_error_msg'] = NULL;
        header("location:../research-ip.php");
    } 
}else{
    echo "Nothing to see here!";
}
?>