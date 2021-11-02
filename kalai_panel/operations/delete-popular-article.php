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

    $sql = mysqli_query($conn, "SELECT * from tbl_popular_article WHERE id='$sqlgetid' AND super_owner='$super_owner'");
    $row = mysqli_fetch_array($sql);
    $old_file = $row['article_file'];

    if($errorCode == NULL){

        $query = "DELETE FROM tbl_popular_article WHERE id='$sqlgetid' AND super_owner='$super_owner'";

        $sql = mysqli_query($conn, $query);

        if($sql === false){
            $errorCode = "SQL_DB_FAILED";
            $errorMsg = "There's a problem with MySQL Database. Please contact administrator.<br>Error Details: ". mysqli_error();
            $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
            $_SESSION['academicprofile_success_msg'] = "";
            header("location:../popular-articles.php");
        }

    }

    if($errorCode == NULL){
        unlink("../uploads/articles/" . basename($old_file));
        $sql2 = mysqli_query($conn, "ALTER TABLE tbl_popular_article drop `id`");

        $sql3 = mysqli_query($conn, "ALTER TABLE tbl_popular_article add `id` int not null auto_increment primary key first");

        $_SESSION['academicprofile_success_msg'] = "You have successfully removed your popular article!";
        $_SESSION['academicprofile_error_msg'] = NULL;
        header("location:../popular-articles.php");
    } 
}else{
    echo "Nothing to see here!";
}
?>