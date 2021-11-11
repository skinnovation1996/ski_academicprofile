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
    $owner = mysqli_real_escape_string($conn,$_POST['owner']);
    $title = mysqli_real_escape_string($conn,$_POST['title']);
    $url = mysqli_real_escape_string($conn,$_POST['url']);
    $ip = mysqli_real_escape_string($conn,$_POST['researchip']);

    if($errorCode == NULL){

        $query = "INSERT INTO tbl_research_outcome (research_title, research_link, research_ip, research_owner, super_owner) 
        VALUES ('$title','$url','$ip','$owner','$super_owner')";

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
        //set the research outcome to the particular Student
        if($owner != $login_session){
            $query = "UPDATE tbl_students set std_research_outcome='$title' where std_reg_num='$owner' AND super_owner='$super_owner'";
            $sql = mysqli_query($conn, $query);
        }
        $_SESSION['academicprofile_success_msg'] = "You have successfully added the research outcome!";
        $_SESSION['academicprofile_error_msg'] = NULL;
        header("location:../research-outcomes.php");
    } 
}else{
    echo "Nothing to see here!";
}
?>