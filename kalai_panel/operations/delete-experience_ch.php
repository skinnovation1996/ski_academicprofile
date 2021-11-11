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

    if($errorCode == NULL){

        $query = "DELETE from tbl_career_history where id='$sqlgetid' AND super_owner='$super_owner'";

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
        $sql2 = mysqli_query($conn, "ALTER TABLE tbl_career_history drop `id`");

        $sql3 = mysqli_query($conn, "ALTER TABLE tbl_career_history add `id` int not null auto_increment primary key first");

        $_SESSION['academicprofile_success_msg'] = "You have successfully removed the career history experience!";
        $_SESSION['academicprofile_error_msg'] = NULL;
        header("location:../experience_ch.php");
    } 
}else{
    echo "Nothing to see here!";
}
?>