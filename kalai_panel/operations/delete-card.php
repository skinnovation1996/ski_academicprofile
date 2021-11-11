<?php
require_once("../assets/php/chk-session.php");
include("../assets/php/connectdb.php");
include("../assets/php/password.php");
date_default_timezone_set("Asia/Kuala_Lumpur");

$errorCode = "";
$errorMsg = "";
$successMsg = "";


if(isset($_POST['delete-button'])){
    $owner = $login_session;
    $super_owner = $login_super_owner;
    $card_id = mysqli_real_escape_string($conn,$_POST['oldid']);

    if($errorCode == NULL){

        $query = "DELETE FROM tbl_cards WHERE card_id='$card_id' AND admin_id='$owner'";

        $sql = mysqli_query($conn, $query);

        if($sql === false){
            $errorCode = "SQL_DB_FAILED";
            $errorMsg = "There's a problem with MySQL Database. Please contact administrator.<br>Error Details: ". mysqli_error();
            $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
            $_SESSION['academicprofile_success_msg'] = NULL;
            header("location:../my-cards.php");
        }

    }

    if($errorCode == NULL){
        $_SESSION['academicprofile_success_msg'] = "You have successfully removed your payment card!";
        $_SESSION['academicprofile_error_msg'] = NULL;
        header("location:../my-cards.php");
    } 
}else{
    echo "Nothing to see here!";
}
?>