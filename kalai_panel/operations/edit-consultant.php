<?php
require_once("../assets/php/chk-session.php");
include("../assets/php/connectdb.php");
include("../assets/php/password.php");
date_default_timezone_set("Asia/Kuala_Lumpur");

$errorCode = "";
$errorMsg = "";
$successMsg = "";


if(isset($_POST['submit-button'])){
    $sqlgetid = mysqli_real_escape_string($conn,$_POST['id']);
    $user_id = mysqli_real_escape_string($conn,$_POST['user_id']);
    $name = mysqli_real_escape_string($conn,$_POST['name']);
    $tagline = mysqli_real_escape_string($conn,$_POST['tagline']);
    $department = mysqli_real_escape_string($conn,$_POST['department']);
    $faculty = mysqli_real_escape_string($conn,$_POST['faculty']);
    $university = mysqli_real_escape_string($conn,$_POST['university']);
    $city = mysqli_real_escape_string($conn,$_POST['city']);
    $tel = mysqli_real_escape_string($conn,$_POST['tel']);
    $fax = mysqli_real_escape_string($conn,$_POST['fax']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $country = mysqli_real_escape_string($conn,$_POST['country']);
    $postcode = mysqli_real_escape_string($conn,$_POST['postcode']);
    $academic_level = mysqli_real_escape_string($conn,$_POST['academic_level']);
    $specializations = mysqli_real_escape_string($conn,$_POST['specializations']);
    $facebook = mysqli_real_escape_string($conn,$_POST['facebook']);
    $instagram = mysqli_real_escape_string($conn,$_POST['instagram']);
    $twitter = mysqli_real_escape_string($conn,$_POST['twitter']);
    $linkedin = mysqli_real_escape_string($conn,$_POST['linkedin']);

    $location = mysqli_real_escape_string($conn,"Coming Soon");

    $profile_pic = $_FILES['profilePicture']['name'];
    $tmpprofile_pic = $_FILES['profilePicture']['tmp_name'];
    $filesize1 = $_FILES['profilePicture']['size'];
    $allowed = array("jpg","png","jpeg","bmp","gif");
    $ext = pathinfo($profile_pic, PATHINFO_EXTENSION);

    $front_pic = $_FILES['frontPicture']['name'];
    $tmpfront_pic = $_FILES['frontPicture']['tmp_name'];
    $filesize2 = $_FILES['frontPicture']['size'];
    $allowed2 = array("jpg","png","jpeg","bmp","gif");
    $ext2 = pathinfo($front_pic, PATHINFO_EXTENSION);

    $uploaderror=0;
    $old_file = $_POST['oldfile'];
    $old_file2 = $_POST['oldfile2'];

    if($tmpprofile_pic != NULL){
        if(!file_exists("../uploads/admins/$user_id/")){
            mkdir("../uploads/admins/$user_id/", 0777, true);
        }
                    
        if(file_exists("../uploads/admins/$user_id/" . basename($profile_pic))){
            $errorCode = "FILE_ALREADY_EXISTS";
            $errorMsg = "$profile_pic - File already exists in our server. Please rename and try again!";
            $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
            $_SESSION['academicprofile_success_msg'] = NULL;
            header("location:../edit-consultant.php?id=$sqlgetid");
        }
        else if($filesize1 > 3000000){
            $errorCode = "FILE_SIZE_TOO_LARGE";
            $errorMsg = "$profile_pic - The selected file size is too large! Maximum 3MB allowed";
            $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
            $_SESSION['academicprofile_success_msg'] = NULL;
            header("location:../edit-consultant.php?id=$sqlgetid");
        }else if(!in_array($ext,$allowed)) {
			$errorCode = "UNSUPPORTED_FILE_SIZE";
            $errorMsg = "$profile_pic - Unsupported file format (only JPG/PNG/JPEG/BMP/GIF)!";
            $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
            $_SESSION['academicprofile_success_msg'] = NULL;
            header("location:../edit-consultant.php?id=$sqlgetid");
        } 
                        
        if (move_uploaded_file($tmpprofile_pic, "../uploads/admins/$user_id/" . basename($profile_pic))) {
            $file_uploaded1 = $profile_pic;
            $sql = mysqli_query($conn, "UPDATE tbl_admin SET profile_pic='$file_uploaded1' WHERE id='$sqlgetid' admin_id='$user_id' AND role='Consultant'");
            if($sql === false){
                $errorCode = "SQL_DB_FAILED";
                $errorMsg = "There's a problem with MySQL Database. Please contact administrator.<br>Error Details: ". mysqli_error();
                $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
                $_SESSION['academicprofile_success_msg'] = NULL;
                header("location:../edit-consultant.php?id=$sqlgetid");
            }
            unlink("../uploads/admins/$user_id/" . basename($old_file));
        } else {
            $errorCode = "UPLOAD_FAILED";
            $errorMsg = "$profile_pic - File upload failed. Please try again later.";
            $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
            $_SESSION['academicprofile_success_msg'] = NULL;
            header("location:../edit-consultant.php?id=$sqlgetid");
        }
    }

    if($tmpfront_pic != NULL){
        if(!file_exists("../uploads/admins/$user_id/")){
            mkdir("../uploads/admins/$user_id/", 0777, true);
        }
                    
        if(file_exists("../uploads/admins/$user_id/" . basename($front_pic))){
            $errorCode = "FILE_ALREADY_EXISTS";
            $errorMsg = "$front_pic - File already exists in our server. Please rename and try again!";
            $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
            $_SESSION['academicprofile_success_msg'] = NULL;
            header("location:../edit-consultant.php?id=$sqlgetid");
        }
        else if($filesize2 > 3000000){
            $errorCode = "FILE_SIZE_TOO_LARGE";
            $errorMsg = "$front_pic - The selected file size is too large! Maximum 3MB allowed";
            $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
            $_SESSION['academicprofile_success_msg'] = NULL;
            header("location:../edit-consultant.php?id=$sqlgetid");
        }else if(!in_array($ext2,$allowed2)) {
			$errorCode = "UNSUPPORTED_FILE_SIZE";
            $errorMsg = "$front_pic - Unsupported file format (only JPG/PNG/JPEG/BMP/GIF)!";
            $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
            $_SESSION['academicprofile_success_msg'] = NULL;
            header("location:../edit-consultant.php?id=$sqlgetid");
        } 
                        
        if (move_uploaded_file($tmpfront_pic, "../uploads/admins/$user_id/" . basename($front_pic))) {
            $file_uploaded2 = $front_pic;
            $sql = mysqli_query($conn, "UPDATE tbl_admin SET front_pic='$file_uploaded2' WHERE id='$sqlgetid' AND admin_id='$user_id' AND role='Consultant'");
            if($sql === false){
                $errorCode = "SQL_DB_FAILED";
                $errorMsg = "There's a problem with MySQL Database. Please contact administrator.<br>Error Details: ". mysqli_error();
                $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
                $_SESSION['academicprofile_success_msg'] = NULL;
                header("location:../edit-consultant.php?id=$sqlgetid");
            }
            unlink("../uploads/admins/$user_id/" . basename($old_file2));
            $file_uploaded2 = $front_pic;
        } else {
            $errorCode = "UPLOAD_FAILED";
            $errorMsg = "$profile_pic - File upload failed. Please try again later.";
            $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
            $_SESSION['academicprofile_success_msg'] = NULL;
            header("location:../edit-consultant.php?id=$sqlgetid");
        }
    }

    if($errorCode == NULL){

        $query = "UPDATE tbl_admin SET admin_name='$name', tagline='$tagline', department='$department', faculty='$faculty', 
        university='$university', city='$city', postcode='$postcode', education_level='$academic_level', tel='$tel', fax='$fax', country='$country', specializations='$specializations', 
        email='$email', facebook='$facebook', instagram='$instagram', linkedin='$linkedin', twitter='$twitter', location='$location' 
        WHERE id='$sqlgetid' AND admin_id='$user_id' AND role='Consultant'";

        $sql = mysqli_query($conn, $query);

        exit;

        if($sql === false){
            $errorCode = "SQL_DB_FAILED";
            $errorMsg = "There's a problem with MySQL Database. Please contact administrator.<br>Error Details: ". mysqli_error();
            $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
            $_SESSION['academicprofile_success_msg'] = NULL;
            header("location:../edit-consultant.php?id=$sqlgetid");
        }

    }

    if($errorCode == NULL){
        $_SESSION['academicprofile_success_msg'] = "You have successfully edited the consultant!";
        $_SESSION['academicprofile_error_msg'] = NULL;
        header("location:../consultants.php");
    } 
}else{
    echo "Nothing to see here!";
}
?>