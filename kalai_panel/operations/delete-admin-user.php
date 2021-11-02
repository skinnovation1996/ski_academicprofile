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
    $sql = mysqli_query($conn, "SELECT * from tbl_admin WHERE id='$sqlgetid'");
    $row = mysqli_fetch_array($sql);
    $super_owner = $row['admin_id'];
    $old_file = $row['profile_pic'];
    $old_file2 = $row['front_pic'];

    if($errorCode == NULL){

        //DELETE ALL INFORMATION!
        $sql = mysqli_query($conn, "DELETE FROM tbl_abstract WHERE super_owner='$super_owner'");
        $sql2 = mysqli_query($conn, "ALTER TABLE tbl_abstract drop `id`");
        $sql3 = mysqli_query($conn, "ALTER TABLE tbl_abstract add `id` int not null auto_increment primary key first");

        $sql = mysqli_query($conn, "DELETE FROM tbl_books WHERE super_owner='$super_owner'");
        $sql2 = mysqli_query($conn, "ALTER TABLE tbl_books drop `id`");
        $sql3 = mysqli_query($conn, "ALTER TABLE tbl_books add `id` int not null auto_increment primary key first");

        $sql = mysqli_query($conn, "DELETE FROM tbl_bookchapters WHERE super_owner='$super_owner'");
        $sql2 = mysqli_query($conn, "ALTER TABLE tbl_bookchapters drop `id`");
        $sql3 = mysqli_query($conn, "ALTER TABLE tbl_bookchapters add `id` int not null auto_increment primary key first");

        $sql = mysqli_query($conn, "DELETE FROM tbl_community WHERE super_owner='$super_owner'");
        $sql2 = mysqli_query($conn, "ALTER TABLE tbl_community drop `id`");
        $sql3 = mysqli_query($conn, "ALTER TABLE tbl_community add `id` int not null auto_increment primary key first");

        $sql = mysqli_query($conn, "DELETE FROM tbl_community_category WHERE super_owner='$super_owner'");
        $sql2 = mysqli_query($conn, "ALTER TABLE tbl_community_category drop `id`");
        $sql3 = mysqli_query($conn, "ALTER TABLE tbl_community_category add `id` int not null auto_increment primary key first");

        $sql = mysqli_query($conn, "DELETE FROM tbl_teaching WHERE super_owner='$super_owner'");
        $sql2 = mysqli_query($conn, "ALTER TABLE tbl_teaching drop `id`");
        $sql3 = mysqli_query($conn, "ALTER TABLE tbl_teaching add `id` int not null auto_increment primary key first");

        $query = "DELETE FROM tbl_value WHERE id='$sqlgetid' AND super_owner='$super_owner'";

        $sql = mysqli_query($conn, $query);

        if($sql === false){
            $errorCode = "SQL_DB_FAILED";
            $errorMsg = "There's a problem with MySQL Database. Please contact administrator.<br>Error Details: ". mysqli_error();
            $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
            $_SESSION['academicprofile_success_msg'] = "";
            header("location:../value.php");
        }

    }

    if($errorCode == NULL){
        unlink("../uploads/values/" . basename($old_file));
        $sql2 = mysqli_query($conn, "ALTER TABLE tbl_value drop `id`");

        $sql3 = mysqli_query($conn, "ALTER TABLE tbl_value add `id` int not null auto_increment primary key first");

        $_SESSION['academicprofile_success_msg'] = "You have successfully removed the value!";
        $_SESSION['academicprofile_error_msg'] = NULL;
        header("location:../value.php");
    } 
}else{
    echo "Nothing to see here!";
}
?>