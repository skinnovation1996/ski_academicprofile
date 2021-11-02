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
    $notes = mysqli_real_escape_string($conn,$_POST['notes']);
    $publisher = mysqli_real_escape_string($conn,$_POST['publisher']);
    $location = mysqli_real_escape_string($conn,$_POST['location']);
    
    $file = $_FILES['bookfile']['name'];
    $tmpfile = $_FILES['bookfile']['tmp_name'];
    $filesize = $_FILES['bookfile']['size'];
          
    $allowed= array("pdf","doc","docx","rtf");
    $ext = pathinfo($bookfile, PATHINFO_EXTENSION);

    if($tmpfile != NULL){
        if(!file_exists("../uploads/books/")){
            mkdir("../uploads/books/", 0777, true);
        }
                    
        if(file_exists("../uploads/books/" . basename($file))){
            $errorCode = "FILE_ALREADY_EXISTS";
            $errorMsg = "$file - File already exists in our server. Please rename and try again!";
            $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
            $_SESSION['academicprofile_success_msg'] = "";
            header("location:../books.php");
        }
        else if($filesize > 3000000){
            $errorCode = "FILE_SIZE_TOO_LARGE";
            $errorMsg = "$file - The selected file size is too large! Maximum 3MB allowed";
            $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
            $_SESSION['academicprofile_success_msg'] = "";
            header("location:../books.php");
        }else if(!in_array($ext,$allowed)) {
			$errorCode = "UNSUPPORTED_FILE_SIZE";
            $errorMsg = "$file - Unsupported file format (only PDF/DOC/DOCX/RTF)!";
            $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
            $_SESSION['academicprofile_success_msg'] = "";
            header("location:../books.php");
        }
                        
        if (move_uploaded_file($tmpfile, "../uploads/books/" . basename($file))) {
            $file_uploaded = $file;
            $sql = mysqli_query($conn, "UPDATE tbl_books SET book_file='$file_uploaded' WHERE id='$sqlgetid' AND super_owner='$super_owner'");
            if($sql === false){
                $errorCode = "SQL_DB_FAILED";
                $errorMsg = "There's a problem with MySQL Database. Please contact administrator.<br>Error Details: ". mysqli_error();
                $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
                $_SESSION['academicprofile_success_msg'] = "";
                header("location:../books.php");
            }
            unlink("../uploads/books/" . basename($old_file));
        } else {
            $errorCode = "UPLOAD_FAILED";
            $errorMsg = "$file - File upload failed. Please try again later.";
            $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
            $_SESSION['academicprofile_success_msg'] = "";
            header("location:../books.php");
        }
    }

    if($errorCode == NULL){

        $query = "UPDATE tbl_books SET authors='$authors', book_title='$title', book_year='$year', book_notes='$notes',
        publisher_location='$location', publisher_name='$publisher' WHERE book_owner='$owner' AND id='$sqlgetid' AND super_owner='$super_owner'";

        $sql = mysqli_query($conn, $query);

        if($sql === false){
            $errorCode = "SQL_DB_FAILED";
            $errorMsg = "There's a problem with MySQL Database. Please contact administrator.<br>Error Details: ". mysqli_error();
            $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
            $_SESSION['academicprofile_success_msg'] = "";
            header("location:../books.php");
        }

    }

    if($errorCode == NULL){
        $_SESSION['academicprofile_success_msg'] = "You have successfully edited the book!";
        $_SESSION['academicprofile_error_msg'] = NULL;
        header("location:../books.php");
    } 
}else{
    echo "Nothing to see here!";
}
?>