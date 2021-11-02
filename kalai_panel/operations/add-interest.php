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
    $title = mysqli_real_escape_string($conn,$_POST['title']);
    $category = mysqli_real_escape_string($conn,$_POST['category']);
    $notes = mysqli_real_escape_string($conn,$_POST['notes']);
    $file = $_FILES['interestfile']['name'];
    $tmpfile = $_FILES['interestfile']['tmp_name'];
    $filesize = $_FILES['interestfile']['size'];
        
    $ext = pathinfo($file, PATHINFO_EXTENSION);

    $uploaderror=0;

    if($tmpfile != NULL){
        if(!file_exists("../uploads/interests/")){
            mkdir("../uploads/interests/", 0777, true);
        }
                    
        if(file_exists("../uploads/interests/" . basename($file))){
            $errorCode = "FILE_ALREADY_EXISTS";
            $errorMsg = "$file - File already exists in our server. Please rename and try again!";
            $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
            $_SESSION['academicprofile_success_msg'] = "";
            header("location:../interests.php");
        }
        else if($filesize > 3000000){
            $errorCode = "FILE_SIZE_TOO_LARGE";
            $errorMsg = "$file - The selected file size is too large! Maximum 3MB allowed";
            $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
            $_SESSION['academicprofile_success_msg'] = "";
            header("location:../interests.php");
        }
                        
        if (move_uploaded_file($tmpfile, "../uploads/interests/" . basename($file))) {
            $file_uploaded = $file;
        } else {
            $errorCode = "UPLOAD_FAILED";
            $errorMsg = "$file - File upload failed. Please try again later.";
            $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
            $_SESSION['academicprofile_success_msg'] = "";
            header("location:../interests.php");
        }
    }else{
        $file_uploaded = NULL;
    }
    

    if($errorCode == NULL){

        $query = "INSERT INTO tbl_interest (interest_category, interest_title, interest_notes, interest_file, super_owner)
        VALUES ('$category','$title','$notes','$file_uploaded','$super_owner')";

        $sql = mysqli_query($conn, $query);

        if($sql === false){
            $errorCode = "SQL_DB_FAILED";
            $errorMsg = "There's a problem with MySQL Database. Please contact administrator.<br>Error Details: ". mysqli_error();
            $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
            $_SESSION['academicprofile_success_msg'] = "";
            header("location:../interests.php");
        }

    }

    if($errorCode == NULL){
        $_SESSION['academicprofile_success_msg'] = "You have successfully added the interest!";
        $_SESSION['academicprofile_error_msg'] = NULL;
        header("location:../interests.php");
    } 
}else{
    echo "Nothing to see here!";
}
?>