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

    $sql = mysqli_query($conn, "SELECT * from tbl_journals WHERE id='$sqlgetid' AND super_owner='$super_owner'");
    $row = mysqli_fetch_array($sql);
    $old_file = $row['journal_file'];

    if($errorCode == NULL){

        $query = "DELETE FROM tbl_journals WHERE id='$sqlgetid' AND super_owner='$super_owner'";

        $sql = mysqli_query($conn, $query);

        if($sql === false){
            $errorCode = "SQL_DB_FAILED";
            $errorMsg = "There's a problem with MySQL Database. Please contact administrator.<br>Error Details: ". mysqli_error();
            $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
            $_SESSION['academicprofile_success_msg'] = "";
            header("location:../journals.php");
        }

    }

    if($errorCode == NULL){
        unlink("../uploads/journals/" . basename($old_file));
        $sql2 = mysqli_query($conn, "ALTER TABLE tbl_journals drop `id`");

        $sql3 = mysqli_query($conn, "ALTER TABLE tbl_journals add `id` int not null auto_increment primary key first");

        $_SESSION['academicprofile_success_msg'] = "You have successfully removed the journal!";
        $_SESSION['academicprofile_error_msg'] = NULL;
        header("location:../journals.php");
    } 
}else{
    echo "Nothing to see here!";
}
?>