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
    $catcode = mysqli_real_escape_string($conn,$_POST['catcode']);
    $code = mysqli_real_escape_string($conn,$_POST['code']);
    $title = mysqli_real_escape_string($conn,$_POST['title']);
    $funder = mysqli_real_escape_string($conn,$_POST['funder']);
    $amount = mysqli_real_escape_string($conn,$_POST['amount']);
    if($amount == NULL){
        $amount = 0;
    }
    $duration = mysqli_real_escape_string($conn,$_POST['duration']);
    $status = mysqli_real_escape_string($conn,$_POST['status']);

    $credits = 30;

    //Check your first grant
    $sql = mysqli_query($conn, "SELECT * from tbl_grant WHERE super_owner='$login_super_owner'");
    $numOfGrants = mysqli_num_rows($sql);

    if($numOfGrants > 1){
        if($owner_credits < $credits){
            $errorCode = "NOT_ENOUGH_CREDITS";
            $errorMsg = "You don't have enough credits to perform this action. <a href='topup-credits.php'><b>Please reload your credits.</b></a>";
            $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
            $_SESSION['academicprofile_success_msg'] = NULL;
            header("location:../grants.php");
        }
        $new_credits = $owner_credits - $credits;
    }
    
    if($errorCode == NULL){

        $query = "INSERT INTO tbl_grant (grant_title, category_code, grant_code, grant_funder, 
        grant_amount, grant_duration, grant_status, super_owner) VALUES('$title' , '$catcode' , '$code','$funder',
        '$amount','$duration','$status','$super_owner')";

        $sql = mysqli_query($conn, $query);

        if($sql === false){
            $errorCode = "SQL_DB_FAILED";
            $errorMsg = "There's a problem with MySQL Database. Please contact administrator.<br>Error Details: ". mysqli_error();
            $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
            $_SESSION['academicprofile_success_msg'] = NULL;
            header("location:../grants.php");
        }

    }

    if($errorCode == NULL){
         //deduct credits
         $sql = mysqli_query($conn, "UPDATE tbl_admin SET credits='$new_credits' WHERE admin_id='$super_owner'");
        $_SESSION['academicprofile_success_msg'] = "You have successfully added the research grant!";
        $_SESSION['academicprofile_error_msg'] = NULL;
        header("location:../grants.php");
    } 
}else{
    echo "Nothing to see here!";
}
?>