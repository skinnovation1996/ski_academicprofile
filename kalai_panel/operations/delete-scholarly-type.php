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

    $select = "SELECT * from tbl_scholarly_types where id='$sqlgetid' AND super_owner='$super_owner'";
    $selectsql = mysqli_query($conn, $select) or die("Problem selecting MYSQL Query: ".mysqli_error());
    $row=mysqli_fetch_array($selectsql);

    $type = $row['scholarly_type_title'];

    if($errorCode == NULL){

        $query = "DELETE from tbl_scholarly_types where id='$sqlgetid' AND super_owner='$super_owner'";

        $sql = mysqli_query($conn, $query);

        if($sql === false){
            $errorCode = "SQL_DB_FAILED";
            $errorMsg = "There's a problem with MySQL Database. Please contact administrator.<br>Error Details: ". mysqli_error();
            $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
            $_SESSION['academicprofile_success_msg'] = NULL;
            header("location:../scholarly_types.php");
        }

    }

    if($errorCode == NULL){
        $sql2 = mysqli_query($conn, "DELETE from tbl_scholarly_activities where scholarly_type='$type' AND super_owner='$super_owner'");

        $sql3 = mysqli_query($conn, "ALTER TABLE tbl_scholarly_types DROP `id`");

        $sql4 = mysqli_query($conn, "ALTER TABLE tbl_scholarly_types ADD `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST;");

        $sql5 = mysqli_query($conn, "ALTER TABLE tbl_scholarly_activities DROP `id`");

        $sql5 = mysqli_query($conn, "ALTER TABLE tbl_scholarly_activities ADD `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST;");

        $_SESSION['academicprofile_success_msg'] = "You have successfully removed the scholarly type!";
        $_SESSION['academicprofile_error_msg'] = NULL;
        header("location:../scholarly_types.php");
    } 
}else{
    echo "Nothing to see here!";
}
?>