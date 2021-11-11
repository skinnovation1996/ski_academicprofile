<?php
require_once("../assets/php/chk-session.php");
include("../assets/php/connectdb.php");
include("../assets/php/password.php");
date_default_timezone_set("Asia/Kuala_Lumpur");

$errorCode = "";
$errorMsg = "";
$successMsg = "";


if(isset($_POST['submit-button'])){
    $owner = $login_session;
    $super_owner = $login_super_owner;
    $card_id = mysqli_real_escape_string($conn,$_POST['oldid']);
    $card_num = mysqli_real_escape_string($conn,$_POST['card_num']);
    $cvv = mysqli_real_escape_string($conn,$_POST['cvv2']);
    $expiry_date = date_format(date_create($_POST['expiry_date']), "Y-m-01");
    $name = mysqli_real_escape_string($conn,$_POST['name']);

    //get type
    if(preg_match("/^4[0-9]{12}(?:[0-9]{3})?/", $card_num)){
        $type = "Visa";
    }else if(preg_match("/^(5[1-5][0-9]{14}|2(22[1-9][0-9]{12}|2[3-9][0-9]{13}|[3-6][0-9]{14}|7[0-1][0-9]{13}|720[0-9]{12}))/", $card_num)){
        $type = "MasterCard";
    }else if(preg_match("/^3[47][0-9]{13}/", $card_num)){
        $type = "AMEX";
    }else{
        $type = "Others";
    }
    
    if($errorCode == NULL){

        $query = "UPDATE tbl_cards SET card_num='$card_num', cvv='$cvv', expiry_date='$expiry_date', type='$type' WHERE admin_id='$owner' AND card_id='$card_id'";

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
        $_SESSION['academicprofile_success_msg'] = "You have successfully updated your payment card!";
        $_SESSION['academicprofile_error_msg'] = NULL;
        header("location:../my-cards.php");
    } 
}else{
    echo "Nothing to see here!";
}
?>