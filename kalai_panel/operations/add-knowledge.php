<?php
require_once("../assets/php/chk-session.php");
include("../assets/php/connectdb.php");
include("../assets/php/password.php");
date_default_timezone_set("Asia/Kuala_Lumpur");

$errorCode = "";
$errorMsg = "";
$successMsg = "";


if(isset($_POST['submit-button'])){
    $super_owner = $login_super_owner;
    $title = mysqli_real_escape_string($conn,$_POST['title']);
    $theme = mysqli_real_escape_string($conn,$_POST['theme']);
    $notes = mysqli_real_escape_string($conn,$_POST['notes']);

    $datetime = date('Y-m-d H:i:s');
    $date = date("Y-m-d");

    if($errorCode == NULL){

        $query = "INSERT INTO tbl_knowledge(knowledge_theme, knowledge_title, knowledge_notes, knowledge_date, super_owner) 
        VALUES ('$theme','$title','$notes','$date','$super_owner')";

        $sql = mysqli_query($conn, $query);

        if($sql === false){
            $errorCode = "SQL_DB_FAILED";
            $errorMsg = "There's a problem with MySQL Database. Please contact administrator.<br>Error Details: ". mysqli_error();
            $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
            $_SESSION['academicprofile_success_msg'] = "";
            header("location:../knowledge.php");
        }

    }

    if($errorCode == NULL){
        $_SESSION['academicprofile_success_msg'] = "You have successfully added the knowledge!";
        $_SESSION['academicprofile_error_msg'] = NULL;
        header("location:../knowledge.php");
    } 
}else{
    echo "Nothing to see here!";
}
?>