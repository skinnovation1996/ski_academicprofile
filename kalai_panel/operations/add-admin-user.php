<?php
require_once("../assets/php/chk-session.php");
include("../assets/php/connectdb.php");
include("../assets/php/password.php");
date_default_timezone_set("Asia/Kuala_Lumpur");

$errorCode = "";
$errorMsg = "";
$successMsg = "";


if(isset($_POST['submit-button'])){
    $user_id = mysqli_real_escape_string($conn,$_POST['user_id']);

    //Check USER ID
    $sql = mysqli_query($conn, "SELECT admin_id FROM tbl_admin WHERE admin_id='$user_id'");
    $rows = mysqli_num_rows($sql);

    if($rows != NULL){
        $errorCode = "USER_ID_ALREADY_EXISTS";
        $errorMsg = "User ID already exists in our system.";
        $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
        $_SESSION['academicprofile_success_msg'] = "";
        header("location:../add-admin.php");
    }
    $name = mysqli_real_escape_string($conn,$_POST['name']);
    $role = mysqli_real_escape_string($conn,$_POST['role']);
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

    $password = md5(mysqli_real_escape_string($conn,$_POST['passwordinput']));

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

    if($tmpprofile_pic != NULL){
        if(!file_exists("../uploads/admins/$user_id/")){
            mkdir("../uploads/admins/$user_id/", 0777, true);
        }
                    
        if(file_exists("../uploads/admins/$user_id/" . basename($profile_pic))){
            $errorCode = "FILE_ALREADY_EXISTS";
            $errorMsg = "$profile_pic - File already exists in our server. Please rename and try again!";
            $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
            $_SESSION['academicprofile_success_msg'] = "";
            header("location:../add-admin.php");
        }
        else if($filesize1 > 3000000){
            $errorCode = "FILE_SIZE_TOO_LARGE";
            $errorMsg = "$profile_pic - The selected file size is too large! Maximum 3MB allowed";
            $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
            $_SESSION['academicprofile_success_msg'] = "";
            header("location:../add-admin.php");
        }else if(!in_array($ext,$allowed)) {
			$errorCode = "UNSUPPORTED_FILE_SIZE";
            $errorMsg = "$profile_pic - Unsupported file format (only JPG/PNG/JPEG/BMP/GIF)!";
            $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
            $_SESSION['academicprofile_success_msg'] = "";
            header("location:../add-admin.php");
        } 
                        
        if (move_uploaded_file($tmpprofile_pic, "../uploads/admins/$user_id/" . basename($profile_pic))) {
            $file_uploaded1 = $profile_pic;
        } else {
            $errorCode = "UPLOAD_FAILED";
            $errorMsg = "$profile_pic - File upload failed. Please try again later.";
            $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
            $_SESSION['academicprofile_success_msg'] = "";
            header("location:../add-admin.php");
        }
    }else{
        $file_uploaded1 = "default-avatar.png";
    }

    if($tmpfront_pic != NULL){
        if(!file_exists("../uploads/admins/$user_id/")){
            mkdir("../uploads/admins/$user_id/", 0777, true);
        }
                    
        if(file_exists("../uploads/admins/$user_id/" . basename($front_pic))){
            $errorCode = "FILE_ALREADY_EXISTS";
            $errorMsg = "$front_pic - File already exists in our server. Please rename and try again!";
            $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
            $_SESSION['academicprofile_success_msg'] = "";
            header("location:../add-admin.php");
        }
        else if($filesize2 > 3000000){
            $errorCode = "FILE_SIZE_TOO_LARGE";
            $errorMsg = "$front_pic - The selected file size is too large! Maximum 3MB allowed";
            $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
            $_SESSION['academicprofile_success_msg'] = "";
            header("location:../add-admin.php");
        }else if(!in_array($ext2,$allowed2)) {
			$errorCode = "UNSUPPORTED_FILE_SIZE";
            $errorMsg = "$front_pic - Unsupported file format (only JPG/PNG/JPEG/BMP/GIF)!";
            $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
            $_SESSION['academicprofile_success_msg'] = "";
            header("location:../add-admin.php");
        } 
                        
        if (move_uploaded_file($tmpfront_pic, "../uploads/admins/$user_id/" . basename($front_pic))) {
            $file_uploaded2 = $front_pic;
        } else {
            $errorCode = "UPLOAD_FAILED";
            $errorMsg = "$profile_pic - File upload failed. Please try again later.";
            $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
            $_SESSION['academicprofile_success_msg'] = "";
            header("location:../add-admin.php");
        }
    }else{
        $file_uploaded2 = "default.jpg";
    }
    
    if($errorCode == NULL){

        $query = "INSERT INTO tbl_admin (admin_id, admin_name, role, tagline, department, faculty, 
        university, city, postcode, education_level, tel, fax, country, specializations, 
        email, facebook, instagram, linkedin, twitter, location, profile_pic, front_pic, admin_password) 
        VALUES('$user_id','$name','$role','$tagline','$department','$faculty','$university','$city','$postcode','$academic_level'
        '$tel','$fax','$country','$specializations','$email','$facebook','$instagram',
        '$linkedin','$twitter', 'Coming soon', '$file_uploaded1','$file_uploaded2','$password')";

        $sql = mysqli_query($conn, $query);

        if($sql === false){
            $errorCode = "SQL_DB_FAILED";
            $errorMsg = "There's a problem with MySQL Database. Please contact administrator.<br>Error Details: ". mysqli_error();
            $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
            $_SESSION['academicprofile_success_msg'] = "";
            header("location:../add-admin.php");
        }

    }

    if($errorCode == NULL){
        $_SESSION['academicprofile_success_msg'] = "You have successfully added the admin profile!";
        $_SESSION['academicprofile_error_msg'] = NULL;
        header("location:../admin_manager.php");
    } 
}else{
    echo "Nothing to see here!";
}
?>