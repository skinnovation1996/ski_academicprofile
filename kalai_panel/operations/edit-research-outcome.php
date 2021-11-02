<?php
require_once("../assets/php/chk-session.php");
include("../assets/php/connectdb.php");
include("../assets/php/password.php");
date_default_timezone_set("Asia/Kuala_Lumpur");

$errorCode = "";
$errorMsg = "";
$successMsg = "";


if(isset($_POST['edit-button'])){
    $sqlgetid = $_POST['oldid'];
    $super_owner = $login_super_owner;
    $select = mysqli_query($conn, "SELECT research_title from tbl_research_outcome where id='$sqlgetid' AND super_owner='$super_owner'");
    $row=mysqli_fetch_array($select);

    $researchtitle = $row['research_title'];
    $owner = mysqli_real_escape_string($conn,$_POST['owner']);
    $title = mysqli_real_escape_string($conn,$_POST['title']);
    $url = mysqli_real_escape_string($conn,$_POST['url']);
    $ip = mysqli_real_escape_string($conn,$_POST['researchip']);

    if($errorCode == NULL){

        $query = "UPDATE tbl_research_outcome SET research_title='$title', research_link='$url', research_ip='$ip', research_owner='$owner' 
        WHERE id='$sqlgetid' AND super_owner='$super_owner'";

        $sql = mysqli_query($conn, $query);

        if($sql === false){
            $errorCode = "SQL_DB_FAILED";
            $errorMsg = "There's a problem with MySQL Database. Please contact administrator.<br>Error Details: ". mysqli_error();
            $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
            $_SESSION['academicprofile_success_msg'] = "";
            header("location:../research-outcomes.php");
        }

    }

    if($errorCode == NULL){
        //If the admin choose the owner "super_owner', please unset the Research Outcome for student
        if($owner == $super_owner){
            $notspecified = "Not Specified";
            $sql2 = mysqli_query($conn, "UPDATE tbl_students SET std_research_outcome='$notspecified' WHERE std_research_outcome='$researchtitle' AND super_owner='$super_owner'");
            $_SESSION['academicprofile_success_msg'] = "You have successfully updated the research outcome! In addition, all students' research outcomes are unset.";
        }else{
            $query = "UPDATE tbl_students set std_research_outcome='$title' where std_reg_num='$owner' AND std_research_outcome='$researchtitle' AND super_owner='$super_owner'";
            $sql = mysqli_query($conn, $query);
            $_SESSION['academicprofile_success_msg'] = "You have successfully updated the research outcome!";
        }
        $_SESSION['academicprofile_error_msg'] = NULL;
        header("location:../research-outcomes.php");
    } 
}else{
    echo "Nothing to see here!";
}
?>