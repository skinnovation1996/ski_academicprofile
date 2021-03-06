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
    $old_file = $_POST['oldfile'];
    $owner =  $login_session;
    $super_owner = $login_super_owner;
    $title = mysqli_real_escape_string($conn,$_POST['title']);
    $author = mysqli_real_escape_string($conn,$_POST['author']);
    $platform = mysqli_real_escape_string($conn,$_POST['platform']);
    
    $file = $_FILES['articlefile']['name'];
    $tmpfile = $_FILES['articlefile']['tmp_name'];
    $filesize = $_FILES['articlefile']['size'];
        
    $allowed= array("pdf","doc","docx","rtf");
    $ext = pathinfo($file, PATHINFO_EXTENSION);

    if($tmpfile != NULL){
        if(!file_exists("../uploads/articles/")){
            mkdir("../uploads/articles/", 0777, true);
        }
                    
        if(file_exists("../uploads/articles/" . basename($file))){
            $errorCode = "FILE_ALREADY_EXISTS";
            $errorMsg = "$file - File already exists in our server. Please rename and try again!";
            $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
            $_SESSION['academicprofile_success_msg'] = NULL;
            header("location:../popular-articles.php");
        }
        else if($filesize > 3000000){
            $errorCode = "FILE_SIZE_TOO_LARGE";
            $errorMsg = "$file - The selected file size is too large! Maximum 3MB allowed";
            $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
            $_SESSION['academicprofile_success_msg'] = NULL;
            header("location:../popular-articles.php");
        }else if(!in_array($ext,$allowed)) {
			$errorCode = "UNSUPPORTED_FILE_SIZE";
            $errorMsg = "$file - Unsupported file format (only PDF/DOC/DOCX/RTF)!";
            $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
            $_SESSION['academicprofile_success_msg'] = NULL;
            header("location:../popular-articles.php");
        }
                        
        if (move_uploaded_file($tmpfile, "../uploads/articles/" . basename($file))) {
            $file_uploaded = $file;
            $sql = mysqli_query($conn, "UPDATE tbl_popular_article SET article_file='$file_uploaded' WHERE id='$sqlgetid' AND super_owner='$super_owner'");
            if($sql === false){
                $errorCode = "SQL_DB_FAILED";
                $errorMsg = "There's a problem with MySQL Database. Please contact administrator.<br>Error Details: ". mysqli_error();
                $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
                $_SESSION['academicprofile_success_msg'] = NULL;
                header("location:../popular-articles.php");
            }
            unlink("../uploads/articles/" . basename($old_file));
        } else {
            $errorCode = "UPLOAD_FAILED";
            $errorMsg = "$file - File upload failed. Please try again later.";
            $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
            $_SESSION['academicprofile_success_msg'] = NULL;
            header("location:../popular-articles.php");
        }
    }

    if($errorCode == NULL){

        $query = "UPDATE tbl_popular_article SET article_platform='$platform', article_title='$title', article_author='$author' 
        WHERE article_owner='$owner' AND id='$sqlgetid' AND super_owner='$super_owner'";

        $sql = mysqli_query($conn, $query);

        if($sql === false){
            $errorCode = "SQL_DB_FAILED";
            $errorMsg = "There's a problem with MySQL Database. Please contact administrator.<br>Error Details: ". mysqli_error();
            $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
            $_SESSION['academicprofile_success_msg'] = NULL;
            header("location:../popular-articles.php");
        }

    }

    if($errorCode == NULL){
        $_SESSION['academicprofile_success_msg'] = "You have successfully edited your popular article!";
        $_SESSION['academicprofile_error_msg'] = NULL;
        header("location:../popular-articles.php");
    } 
}else{
    echo "Nothing to see here!";
}
?>