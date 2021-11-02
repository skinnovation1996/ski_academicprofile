<?php
require_once("../assets/php/chk-session.php");
include("../assets/php/connectdb.php");
include("../assets/php/password.php");
date_default_timezone_set("Asia/Kuala_Lumpur");

$errorCode = "";
$errorMsg = "";
$successMsg = "";


if(isset($_POST['edit-button'])){
    //Get the POST
    $sqlgetid = $_POST['oldid'];
    $super_owner = $login_super_owner;
    $selectsql = mysqli_query($conn,"SELECT research_ip_id from tbl_research_ip where id='$sqlgetid' AND super_owner='$super_owner'");
    $row=mysqli_fetch_array($selectsql);
    $oldid = $row['research_ip_id'];

    $id = mysqli_real_escape_string($conn,$_POST['id_input']);
    $title = mysqli_real_escape_string($conn,$_POST['title']);
    $members = mysqli_real_escape_string($conn,$_POST['members']);
    $year = mysqli_real_escape_string($conn,$_POST['year']);
    $level = mysqli_real_escape_string($conn,$_POST['level']);
    $country = mysqli_real_escape_string($conn,$_POST['country']);
    if($level==0){
        $country = "Malaysia";
    }

    if($errorCode == NULL){

        $query = "UPDATE tbl_research_ip SET research_ip_id='$id', research_ip_title='$title', research_ip_members='$members',
        research_ip_year='$year', research_ip_level='$level', research_ip_country='$country' WHERE id='$sqlgetid' AND super_owner='$super_owner'";

        $sql = mysqli_query($conn, $query);

        if($sql === false){
            $errorCode = "SQL_DB_FAILED";
            $errorMsg = "There's a problem with MySQL Database. Please contact administrator.<br>Error Details: ". mysqli_error();
            $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
            $_SESSION['academicprofile_success_msg'] = "";
            header("location:../research-ip.php");
        }

    }

    if($errorCode == NULL){
        //ALSO UPDATE THE RESEARCH IP FROM TBL_RESEARCH_OUTCOME
        mysqli_query($conn, "UPDATE tbl_research_outcome SET research_ip='$id' WHERE research_ip='$oldid' AND super_owner='$super_owner'");
        $_SESSION['academicprofile_success_msg'] = "You have successfully updated the research intellectual property!";
        $_SESSION['academicprofile_error_msg'] = NULL;
        header("location:../research-ip.php");
    } 
}else{
    echo "Nothing to see here!";
}
?>