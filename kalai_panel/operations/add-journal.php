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
    $year = mysqli_real_escape_string($conn,$_POST['year']);
    $names = mysqli_real_escape_string($conn,$_POST['names']);
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

    $title = mysqli_real_escape_string($conn,$_POST['title']);
    $volume = mysqli_real_escape_string($conn,$_POST['volume']);
    $pagenum = mysqli_real_escape_string($conn,$_POST['pagenum']);
    $file = $_FILES['journalfile']['name'];
    $tmpfile = $_FILES['journalfile']['tmp_name'];
    $filesize = $_FILES['journalfile']['size'];
        
    $allowed= array("pdf","doc","docx","rtf");
    $ext = pathinfo($file, PATHINFO_EXTENSION);

    $credits = 10;

    //Check credits
    if($user_role != "Student"){
        if($owner_credits < $credits){
            $errorCode = "NOT_ENOUGH_CREDITS";
            $errorMsg = "You don't have enough credits to perform this action. <a href='topup-credits.php'><b>Please reload your credits.</b></a>";
            $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
            $_SESSION['academicprofile_success_msg'] = NULL;
            header("location:../journals.php");
        }
        $new_credits = $owner_credits - $credits;
    }
    
    if($errorCode == NULL){

        if($tmpfile != NULL){
            if(!file_exists("../uploads/journals/")){
                mkdir("../uploads/journals/", 0777, true);
            }
                        
            if(file_exists("../uploads/journals/" . basename($file))){
                $errorCode = "FILE_ALREADY_EXISTS";
                $errorMsg = "$file - File already exists in our server. Please rename and try again!";
                $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
                $_SESSION['academicprofile_success_msg'] = NULL;
                header("location:../journals.php");
            }
            else if($filesize > 3000000){
                $errorCode = "FILE_SIZE_TOO_LARGE";
                $errorMsg = "$file - The selected file size is too large! Maximum 3MB allowed";
                $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
                $_SESSION['academicprofile_success_msg'] = NULL;
                header("location:../journals.php");
            }else if(!in_array($ext,$allowed)) {
                $errorCode = "UNSUPPORTED_FILE_SIZE";
                $errorMsg = "$file - Unsupported file format (only PDF/DOC/DOCX/RTF)!";
                $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
                $_SESSION['academicprofile_success_msg'] = NULL;
                header("location:../journals.php");
            } 
            if (move_uploaded_file($tmpfile, "../uploads/journals/" . basename($file))) {
                $file_uploaded = $file;
            } else {
                $errorCode = "UPLOAD_FAILED";
                $errorMsg = "$file - File upload failed. Please try again later.";
                $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
                $_SESSION['academicprofile_success_msg'] = NULL;
                header("location:../journals.php");
            }
        }else{
            $file_uploaded = NULL;
        }
    }

    if($errorCode == NULL){

        $query = "INSERT INTO tbl_journals (authors, journal_year, journal_title, journal_name, 
        journal_volume, journal_pagenum, journal_owner, journal_file, super_owner) VALUES 
        ('$authors','$year','$title','$names','$volume','$pagenum','$owner','$file_uploaded','$super_owner')";

        $sql = mysqli_query($conn, $query);

        if($sql === false){
            $errorCode = "SQL_DB_FAILED";
            $errorMsg = "There's a problem with MySQL Database. Please contact administrator.<br>Error Details: ". mysqli_error();
            $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
            $_SESSION['academicprofile_success_msg'] = NULL;
            header("location:../journals.php");
        }

    }

    if($errorCode == NULL){
        //deduct credits
        if($user_role != "Student"){
            $sql = mysqli_query($conn, "UPDATE tbl_admin SET credits='$new_credits' WHERE admin_id='$super_owner'");
        }
        
        $_SESSION['academicprofile_success_msg'] = "You have successfully added the journal!";
        $_SESSION['academicprofile_error_msg'] = NULL;
        header("location:../journals.php");
    } 
}else{
    echo "Nothing to see here!";
}
?>