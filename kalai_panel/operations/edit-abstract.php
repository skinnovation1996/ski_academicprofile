<?php
require_once("../assets/php/chk-session.php");
include("../assets/php/connectdb.php");
include("../assets/php/password.php");
date_default_timezone_set("Asia/Kuala_Lumpur");

$errorCode = "";
$errorMsg = "";
$successMsg = "";


if(isset($_POST['edit-button'])){
    $super_owner = $login_super_owner;
    $sqlgetid = $_POST['oldid'];
    $old_file = $_POST['oldfile'];
    $owner = $login_session;
    $title = mysqli_real_escape_string($conn,$_POST['title']);
    $author = $your_name;

    $file = $_FILES['abstractfile']['name'];
    $tmpfile = $_FILES['abstractfile']['tmp_name'];
    $filesize = $_FILES['abstractfile']['size'];
        
    $allowed= array("pdf","doc","docx","rtf");
    $ext = pathinfo($file, PATHINFO_EXTENSION);

    if($tmpfile != NULL){
        if(!file_exists("../uploads/abstracts/")){
            mkdir("../uploads/abstracts/", 0777, true);
        }
                    
        if(file_exists("../uploads/abstracts/" . basename($file))){
            $errorCode = "FILE_ALREADY_EXISTS";
            $errorMsg = "$file - File already exists in our server. Please rename and try again!";
            $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
            $_SESSION['academicprofile_success_msg'] = "";
            header("location:../abstracts.php");
        }
        else if($filesize > 3000000){
            $errorCode = "FILE_SIZE_TOO_LARGE";
            $errorMsg = "$file - The selected file size is too large! Maximum 3MB allowed";
            $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
            $_SESSION['academicprofile_success_msg'] = "";
            header("location:../abstracts.php");
        }else if(!in_array($ext,$allowed)) {
			$errorCode = "UNSUPPORTED_FILE_SIZE";
            $errorMsg = "$file - Unsupported file format (only PDF/DOC/DOCX/RTF)!";
            $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
            $_SESSION['academicprofile_success_msg'] = "";
            header("location:../abstracts.php");
        }
                        
        if (move_uploaded_file($tmpfile, "../uploads/abstracts/" . basename($file))) {
            $file_uploaded = $file;
            $sql = mysqli_query($conn, "UPDATE tbl_abstracts SET abstract_file='$file_uploaded' WHERE id='$sqlgetid' AND super_owner='$super_owner'");
            if($sql === false){
                $errorCode = "SQL_DB_FAILED";
                $errorMsg = "There's a problem with MySQL Database. Please contact administrator.<br>Error Details: ". mysqli_error();
                $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
                $_SESSION['academicprofile_success_msg'] = "";
                header("location:../abstracts.php");
            }
            unlink("../uploads/abstracts/" . basename($old_file));
        } else {
            $errorCode = "UPLOAD_FAILED";
            $errorMsg = "$file - File upload failed. Please try again later.";
            $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
            $_SESSION['academicprofile_success_msg'] = "";
            header("location:../abstracts.php");
        }
    }

    if($errorCode == NULL){

        $query = "UPDATE tbl_abstract SET abstract_title='$title', abstract_stdname='$author' WHERE abstract_owner='$login_session' AND id='$sqlgetid' AND super_owner='$super_owner'";

        $sql = mysqli_query($conn, $query);

        if($sql === false){
            $errorCode = "SQL_DB_FAILED";
            $errorMsg = "There's a problem with MySQL Database. Please contact administrator.<br>Error Details: ". mysqli_error();
            $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
            $_SESSION['academicprofile_success_msg'] = "";
            header("location:../abstracts.php");
        }

    }

    if($errorCode == NULL){
        $_SESSION['academicprofile_success_msg'] = "You have successfully edited your abstract!";
        $_SESSION['academicprofile_error_msg'] = NULL;
        header("location:../abstracts.php");
    } 
}else{
    echo "Nothing to see here!";
}
?>