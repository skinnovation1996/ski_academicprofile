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
    $old_file1 = $_POST['oldfile1'];
    $old_file2 = $_POST['oldfile2'];
    $super_owner = $login_super_owner;
    $name = mysqli_real_escape_string($conn,$_POST['name']);
    $services = mysqli_real_escape_string($conn,$_POST['services']);
    $equipments = mysqli_real_escape_string($conn,$_POST['equipments']);
    $file1 = $_FILES['facilityfile1']['name'];
    $tmpfile1 = $_FILES['facilityfile1']['tmp_name'];
    $filesize1 = $_FILES['facilityfile1']['size'];
        
    $ext1 = pathinfo($file1, PATHINFO_EXTENSION);

    $file2 = $_FILES['facilityfile2']['name'];
    $tmpfile2 = $_FILES['facilityfile2']['tmp_name'];
    $filesize2 = $_FILES['facilityfile2']['size'];
        
    $ext2 = pathinfo($file2, PATHINFO_EXTENSION);

    $uploaderror=0;

    if($tmpfile1 != NULL){
        if(!file_exists("../uploads/facilities1/")){
            mkdir("../uploads/facilities1/", 0777, true);
        }
                    
        if(file_exists("../uploads/facilities1/" . basename($file1))){
            $errorCode = "FILE_ALREADY_EXISTS";
            $errorMsg = "$file1 - File already exists in our server. Please rename and try again!";
            $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
            $_SESSION['academicprofile_success_msg'] = NULL;
            header("location:../research-facilities.php");
        }
        else if($filesize1 > 3000000){
            $errorCode = "FILE_SIZE_TOO_LARGE";
            $errorMsg = "$file1 - The selected file size is too large! Maximum 3MB allowed";
            $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
            $_SESSION['academicprofile_success_msg'] = NULL;
            header("location:../research-facilities.php");
        }
                        
        if (move_uploaded_file($tmpfile1, "../uploads/facilities1/" . basename($file1))) {
            $file_uploaded1 = $file1;
            $sql = mysqli_query($conn, "UPDATE tbl_research_facilities SET facility_file1='$file_uploaded1' WHERE id='$sqlgetid' AND super_owner='$super_owner'");
        } else {
            $errorCode = "UPLOAD_FAILED";
            $errorMsg = "$file1 - File upload failed. Please try again later.";
            $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
            $_SESSION['academicprofile_success_msg'] = NULL;
            header("location:../research-facilities.php");
        }
    }

    if($tmpfile2 != NULL){
        if(!file_exists("../uploads/facilities2/")){
            mkdir("../uploads/facilities2/", 0777, true);
        }
                    
        if(file_exists("../uploads/facilities2/" . basename($file2))){
            $errorCode = "FILE_ALREADY_EXISTS";
            $errorMsg = "$file2 - File already exists in our server. Please rename and try again!";
            $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
            $_SESSION['academicprofile_success_msg'] = NULL;
            header("location:../research-facilities.php");
        }
        else if($filesize2 > 3000000){
            $errorCode = "FILE_SIZE_TOO_LARGE";
            $errorMsg = "$file2 - The selected file size is too large! Maximum 3MB allowed";
            $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
            $_SESSION['academicprofile_success_msg'] = NULL;
            header("location:../research-facilities.php");
        }
                        
        if (move_uploaded_file($tmpfile2, "../uploads/facilities2/" . basename($file2))) {
            $file_uploaded2 = $file2;
            $sql = mysqli_query($conn, "UPDATE tbl_research_facilities SET facility_file2='$file_uploaded2' WHERE id='$sqlgetid'");
        } else {
            $errorCode = "UPLOAD_FAILED";
            $errorMsg = "$file2 - File upload failed. Please try again later.";
            $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
            $_SESSION['academicprofile_success_msg'] = NULL;
            header("location:../research-facilities.php");
        }
    }

    if($errorCode == NULL){

        $query = "UPDATE tbl_research_facilities SET facility_name='$name', facility_services='$services', facility_equipment='$equipments' WHERE id='$sqlgetid' AND super_owner='$super_owner'";

        $sql = mysqli_query($conn, $query);

        if($sql === false){
            $errorCode = "SQL_DB_FAILED";
            $errorMsg = "There's a problem with MySQL Database. Please contact administrator.<br>Error Details: ". mysqli_error();
            $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
            $_SESSION['academicprofile_success_msg'] = NULL;
            header("location:../research-facilities.php");
        }

    }

    if($errorCode == NULL){
        $_SESSION['academicprofile_success_msg'] = "You have successfully updated the research facility!";
        $_SESSION['academicprofile_error_msg'] = NULL;
        header("location:../research-facilities.php");
    } 
}else{
    echo "Nothing to see here!";
}
?>