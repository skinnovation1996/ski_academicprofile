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

    $select = mysqli_query($conn, "SELECT * from tbl_community_category where id='$sqlgetid' AND super_owner='$super_owner'");
    $row=mysqli_fetch_array($select);

    $type = $row['category'];

    $select2 = "SELECT program_title from tbl_community where id='$sqlgetid' AND super_owner='$super_owner'";
    $select2sql = mysqli_query($conn, $select2) or die("Problem selecting MYSQL Query: ".mysqli_error());
    $row2=mysqli_fetch_array($select2sql);

    $programtitle = $row2['program_title'];
    $notspecified = "Not Specified";

    if($errorCode == NULL){

        $query = "DELETE FROM tbl_community_category WHERE id='$sqlgetid' AND super_owner='$super_owner'";

        $sql = mysqli_query($conn, $query);

        if($sql === false){
            $errorCode = "SQL_DB_FAILED";
            $errorMsg = "There's a problem with MySQL Database. Please contact administrator.<br>Error Details: ". mysqli_error();
            $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
            $_SESSION['academicprofile_success_msg'] = NULL;
            header("location:../community-categories.php");
        }

    }

    if($errorCode == NULL){
        //DON'T FORGET DELETE ANY COMMUNITY INTERESTS FROM THAT CATEGORY!
        mysqli_query($conn, "DELETE from tbl_community where category='$type' AND super_owner='$super_owner'");
        mysqli_query($conn, "UPDATE tbl_students SET std_activity='$notspecified' WHERE std_activity='$programtitle' AND super_owner='$super_owner'");
        mysqli_query($conn, "ALTER TABLE tbl_community_category DROP `id`");
        mysqli_query($conn, "ALTER TABLE tbl_community_category ADD `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST;");
        mysqli_query($conn, "ALTER TABLE tbl_community DROP `id`");
        mysqli_query($conn, "ALTER TABLE tbl_community ADD `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST;");

        $_SESSION['academicprofile_success_msg'] = "You have successfully removed the community interest category!";
        $_SESSION['academicprofile_error_msg'] = NULL;
        header("location:../community-categories.php");
    } 
}else{
    echo "Nothing to see here!";
}
?>