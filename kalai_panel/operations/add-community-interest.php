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
    $category = mysqli_real_escape_string($conn,$_POST['category']);
    $niche = mysqli_real_escape_string($conn,$_POST['niche']);
    $target = mysqli_real_escape_string($conn,$_POST['target']);
    $location = mysqli_real_escape_string($conn,$_POST['location']);
    $dateinput = mysqli_real_escape_string($conn,$_POST['date']);
    $title = mysqli_real_escape_string($conn,$_POST['title']);
    $members = mysqli_real_escape_string($conn,$_POST['members']);
    $funding = mysqli_real_escape_string($conn,$_POST['funding']);
    $workpartner = mysqli_real_escape_string($conn,$_POST['workpartner']);

    $credits = 10;
    if($owner_credits < $credits){
        $errorCode = "NOT_ENOUGH_CREDITS";
        $errorMsg = "You don't have enough credits to perform this action. <a href='topup-credits.php'><b>Please reload your credits.</b></a>";
        $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
        $_SESSION['academicprofile_success_msg'] = NULL;
        header("location:../community-interests.php");
    }
    $new_credits = $owner_credits - $credits;

    if($errorCode == NULL){

    $query = "INSERT INTO tbl_community (category, category_niche, community_target, community_location, program_date, 
    program_title, program_members, program_funding, program_work_partner, super_owner) VALUES('$category','$niche','$target','$location',
    '$dateinput','$title','$members','$funding','$workpartner','$super_owner')";

        $sql = mysqli_query($conn, $query);

        if($sql === false){
            $errorCode = "SQL_DB_FAILED";
            $errorMsg = "There's a problem with MySQL Database. Please contact administrator.<br>Error Details: ". mysqli_error();
            $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
            $_SESSION['academicprofile_success_msg'] = NULL;
            header("location:../community-interests.php");
        }

    }

    if($errorCode == NULL){
        $sql = mysqli_query($conn, "UPDATE tbl_admin SET credits='$new_credits' WHERE admin_id='$super_owner'");
        $_SESSION['academicprofile_success_msg'] = "You have successfully added the community interest!";
        $_SESSION['academicprofile_error_msg'] = NULL;
        header("location:../community-interests.php");
    } 
}else{
    echo "Nothing to see here!";
}
?>