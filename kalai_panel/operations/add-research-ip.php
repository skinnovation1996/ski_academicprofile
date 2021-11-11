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
    $id = mysqli_real_escape_string($conn,$_POST['id_input']);
    $title = mysqli_real_escape_string($conn,$_POST['title']);
    $members = mysqli_real_escape_string($conn,$_POST['members']);
    $year = mysqli_real_escape_string($conn,$_POST['year']);
    $level = mysqli_real_escape_string($conn,$_POST['level']);
    $country = mysqli_real_escape_string($conn,$_POST['country']);
    if($level==0){
        $country = "Malaysia";
    }

    $credits = 10;
    if($owner_credits < $credits){
        $errorCode = "NOT_ENOUGH_CREDITS";
        $errorMsg = "You don't have enough credits to perform this action. <a href='topup-credits.php'><b>Please reload your credits.</b></a>";
        $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
        $_SESSION['academicprofile_success_msg'] = NULL;
        header("location:../research-ip.php");
    }
    $new_credits = $owner_credits - $credits;

    if($errorCode == NULL){

        $query = "INSERT INTO tbl_research_ip (research_ip_id, research_ip_title, research_ip_members, research_ip_year, research_ip_level, research_ip_country, super_owner) 
        VALUES ('$id','$title','$members','$year','$level','$country','$super_owner')";

        $sql = mysqli_query($conn, $query);

        if($sql === false){
            $errorCode = "SQL_DB_FAILED";
            $errorMsg = "There's a problem with MySQL Database. Please contact administrator.<br>Error Details: ". mysqli_error();
            $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
            $_SESSION['academicprofile_success_msg'] = NULL;
            header("location:../research-ip.php");
        }

    }

    if($errorCode == NULL){
        $sql = mysqli_query($conn, "UPDATE tbl_admin SET credits='$new_credits' WHERE admin_id='$super_owner'");
        $_SESSION['academicprofile_success_msg'] = "You have successfully added the research intellectual property!";
        $_SESSION['academicprofile_error_msg'] = NULL;
        header("location:../research-ip.php");
    } 
}else{
    echo "Nothing to see here!";
}
?>