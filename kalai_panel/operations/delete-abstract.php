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

    $sql = mysqli_query($conn, "SELECT * from tbl_abstract WHERE id='$sqlgetid' AND super_owner='$super_owner'");
    $row = mysqli_fetch_array($sql);
    $old_file = $row['abstract_file'];

    if($errorCode == NULL){

        $query = "DELETE FROM tbl_abstract WHERE id='$sqlgetid' AND super_owner='$login_super_owner'";

        $sql = mysqli_query($conn, $query);

        if($sql === false){
            $errorCode = "SQL_DB_FAILED";
            $errorMsg = "There's a problem with MySQL Database. Please contact administrator.<br>Error Details: ". mysqli_error();
            $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
            $_SESSION['academicprofile_success_msg'] = NULL;
            header("location:../abstracts.php");
        }

    }

    if($errorCode == NULL){
        unlink("../uploads/abstracts/" . basename($old_file));
        $sql2 = mysqli_query($conn, "ALTER TABLE tbl_abstract drop `id`");

        $sql3 = mysqli_query($conn, "ALTER TABLE tbl_abstract add `id` int not null auto_increment primary key first");

        $_SESSION['academicprofile_success_msg'] = "You have successfully removed your abstract!";
        $_SESSION['academicprofile_error_msg'] = NULL;
        header("location:../abstracts.php");
    } 
}else{
    echo "Nothing to see here!";
}
?>