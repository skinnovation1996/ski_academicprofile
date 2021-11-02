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
    $owner =  mysqli_real_escape_string($conn,$_POST['owner']);
    $title = mysqli_real_escape_string($conn,$_POST['title']);
    $authorsinput = mysqli_real_escape_string($conn,$_POST['authors']);

    if($user_role == "Student"){
        if($authorsinput != NULL){
            $authors = "$your_name, $authorsinput";
        }
        else{
            $authors = "$your_name";
        }
    }else{
        $authors = $authorsinput;
    }
    $year = mysqli_real_escape_string($conn,$_POST['year']);
    $conference_name = mysqli_real_escape_string($conn,$_POST['conference_name']);
    $conference_location = mysqli_real_escape_string($conn,$_POST['conference_location']);
    $conference_date = mysqli_real_escape_string($conn,$_POST['conference_date']);
    $volume = mysqli_real_escape_string($conn,$_POST['volume']);
    $pagenum = mysqli_real_escape_string($conn,$_POST['pagenum']);

    $file = $_FILES['proceedingfile']['name'];
    $tmpfile = $_FILES['proceedingfile']['tmp_name'];
    $filesize = $_FILES['proceedingfile']['size'];
        
    $allowed= array("pdf","doc","docx","rtf");
    $ext = pathinfo($file, PATHINFO_EXTENSION);

    if($tmpfile != NULL){
        if(!file_exists("../uploads/proceedings/")){
            mkdir("../uploads/proceedings/", 0777, true);
        }
                    
        if(file_exists("../uploads/proceedings/" . basename($file))){
            $errorCode = "FILE_ALREADY_EXISTS";
            $errorMsg = "$file - File already exists in our server. Please rename and try again!";
            $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
            $_SESSION['academicprofile_success_msg'] = "";
            header("location:../proceedings.php");
        }
        else if($filesize > 3000000){
            $errorCode = "FILE_SIZE_TOO_LARGE";
            $errorMsg = "$file - The selected file size is too large! Maximum 3MB allowed";
            $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
            $_SESSION['academicprofile_success_msg'] = "";
            header("location:../proceedings.php");
        }else if(!in_array($ext,$allowed)) {
			$errorCode = "UNSUPPORTED_FILE_SIZE";
            $errorMsg = "$file - Unsupported file format (only PDF/DOC/DOCX/RTF)!";
            $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
            $_SESSION['academicprofile_success_msg'] = "";
            header("location:../proceedings.php");
        } 
        if (move_uploaded_file($tmpfile, "../uploads/proceedings/" . basename($file))) {
            $file_uploaded = $file;
        } else {
            $errorCode = "UPLOAD_FAILED";
            $errorMsg = "$file - File upload failed. Please try again later.";
            $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
            $_SESSION['academicprofile_success_msg'] = "";
            header("location:../proceedings.php");
        }
    }else{
        $file_uploaded = NULL;
    }

    if($errorCode == NULL){

        $query = "INSERT INTO tbl_proceedings (authors, proceeding_year, proceeding_title, conference_name, 
        conference_location, proceeding_volume, proceeding_pagenum, conference_date, proceeding_owner, proceeding_file, super_owner) 
        VALUES ('$authors','$year','$title','$conference_name','$conference_location','$volume','$pagenum','$conference_date','$owner',
        '$file_uploaded','$super_owner')";

        $sql = mysqli_query($conn, $query);

        if($sql === false){
            $errorCode = "SQL_DB_FAILED";
            $errorMsg = "There's a problem with MySQL Database. Please contact administrator.<br>Error Details: ". mysqli_error();
            $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
            $_SESSION['academicprofile_success_msg'] = "";
            header("location:../proceedings.php");
        }

    }

    if($errorCode == NULL){
        $_SESSION['academicprofile_success_msg'] = "You have successfully added the proceeding!";
        $_SESSION['academicprofile_error_msg'] = NULL;
        header("location:../proceedings.php");
    } 
}else{
    echo "Nothing to see here!";
}
?>