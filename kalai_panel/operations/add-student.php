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
    $regnum = mysqli_real_escape_string($conn,$_POST['regnum']);
    $name = mysqli_real_escape_string($conn,$_POST['name']);
    $typecode = mysqli_real_escape_string($conn,$_POST['type']);
    if($typecode == "FYP"){
        $type = "Undergraduates";
        $typesql = 0;
        $back_button = "students_ug.php";
    }else if($typecode == "MA"){
        $type = "Masters";
        $typesql = 1;
        $back_button = "students_masters.php";
    }else if($typecode == "PHD"){
        $type = "PhD";
        $typesql = 2;
        $back_button = "students_phd.php";
    }else if($typecode == "RA"){
        $type = "Research Team Member";
        $typesql = 3;
        $back_button = "students_research.php";
    }
    $phonenum = mysqli_real_escape_string($conn,$_POST['phonenumber']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $faculty = mysqli_real_escape_string($conn,$_POST['faculty']);
    if($faculty == "Others"){
        $faculty = mysqli_real_escape_string($conn,$_POST['faculty_others']);
    }
    $researchtitle = mysqli_real_escape_string($conn,$_POST['researchtitle']);
    $startyear = mysqli_real_escape_string($conn,$_POST['startyear']);
    $endyear = mysqli_real_escape_string($conn,$_POST['endyear']);
    $status = mysqli_real_escape_string($conn,$_POST['status']);
    $sv_status = mysqli_real_escape_string($conn,$_POST['sv_status']);
    $funding_status = mysqli_real_escape_string($conn,$_POST['funding_status']);
    $password = md5($regnum);

    $picture = $_FILES['stdPicture']['name'];
    $tmppicture = $_FILES['stdPicture']['tmp_name'];
    $filesize1 = $_FILES['stdPicture']['size'];
    $allowed= array("jpg","png","jpeg","bmp","gif");
    $ext = pathinfo($picture, PATHINFO_EXTENSION);
    $uploaderror=0;
    $activity = "Not Specified";
    $outcome = "Not Specified";
    

    if($tmppicture != NULL){
        if(!file_exists("../uploads/images/$regnum/")){
            mkdir("../uploads/images/$regnum/", 0777, true);
        }
                    
        if(file_exists("../uploads/images/$regnum/" . basename($picture))){
            $errorCode = "FILE_ALREADY_EXISTS";
            $errorMsg = "$picture - File already exists in our server. Please rename and try again!";
            $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
            $_SESSION['academicprofile_success_msg'] = "";
            header("location:../add-student.php");
        }
        else if($filesize1 > 3000000){
            $errorCode = "FILE_SIZE_TOO_LARGE";
            $errorMsg = "$picture - The selected file size is too large! Maximum 3MB allowed";
            $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
            $_SESSION['academicprofile_success_msg'] = "";
            header("location:../add-student.php");
        }else if(!in_array($ext,$allowed)) {
			$errorCode = "UNSUPPORTED_FILE_SIZE";
            $errorMsg = "$picture - Unsupported file format (only JPG/PNG/JPEG/BMP/GIF)!";
            $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
            $_SESSION['academicprofile_success_msg'] = "";
            header("location:../add-student.php");
        } 
                        
        if (move_uploaded_file($tmppicture, "../uploads/images/$regnum/" . basename($picture))) {
            $file_uploaded1 = $picture;
        } else {
            $errorCode = "UPLOAD_FAILED";
            $errorMsg = "$picture - File upload failed. Please try again later.";
            $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
            $_SESSION['academicprofile_success_msg'] = "";
            header("location:../add-student.php");
        }
    }else{
        $file_uploaded1 = "no_image.jpg";
    }

    if($errorCode == NULL){

        $query = "INSERT INTO tbl_students (std_reg_num, std_name, std_picture, std_type, std_phonenum, 
        std_email, std_research_title, std_start_year, std_end_year, std_status, std_sv_status, 
        std_funding_status, std_faculty, std_activity, std_research_outcome, std_password, std_firstlogin, super_owner) 
        VALUES('$regnum','$name','$file_uploaded1','$typesql','$phonenum','$email','$researchtitle',
        '$startyear','$endyear','$status','$sv_status','$funding_status','$faculty','$activity',
        '$outcome','$password', 1, '$super_owner')";

        $sql = mysqli_query($conn, $query);

        if($sql === false){
            $errorCode = "SQL_DB_FAILED";
            $errorMsg = "There's a problem with MySQL Database. Please contact administrator.<br>Error Details: ". mysqli_error();
            $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
            $_SESSION['academicprofile_success_msg'] = "";
            header("location:../add-student.php");
        }

    }

    if($errorCode == NULL){
        $_SESSION['academicprofile_success_msg'] = "You have successfully added the student! For students first-time login, they use matric number as password.";
        $_SESSION['academicprofile_error_msg'] = NULL;
        header("location:../$back_button");
    } 
}else{
    echo "Nothing to see here!";
}
?>