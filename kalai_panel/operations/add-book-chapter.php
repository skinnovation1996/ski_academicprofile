<?php
require_once("../assets/php/chk-session.php");
include("../assets/php/connectdb.php");
include("../assets/php/password.php");
date_default_timezone_set("Asia/Kuala_Lumpur");

$errorCode = "";
$errorMsg = "";
$successMsg = "";


if(isset($_POST['submit-button'])){
    $owner =  mysqli_real_escape_string($conn,$_POST['owner']);
    $super_owner = $login_super_owner;
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
    $booktitle = mysqli_real_escape_string($conn,$_POST['booktitle']);
    $editor = mysqli_real_escape_string($conn,$_POST['editor']);
    $edition = mysqli_real_escape_string($conn,$_POST['edition']);
    $pagenum = mysqli_real_escape_string($conn,$_POST['pagenum']);
    $publisher = mysqli_real_escape_string($conn,$_POST['publisher']);
    $location = mysqli_real_escape_string($conn,$_POST['location']);

    $file = $_FILES['chapterfile']['name'];
    $tmpfile = $_FILES['chapterfile']['tmp_name'];
    $filesize = $_FILES['chapterfile']['size'];
        
    $allowed= array("pdf","doc","docx","rtf");
    $ext = pathinfo($file, PATHINFO_EXTENSION);

    if($tmpfile != NULL){
        if(!file_exists("../uploads/bookchapters/")){
            mkdir("../uploads/bookchapters/", 0777, true);
        }
                    
        if(file_exists("../uploads/bookchapters/" . basename($file))){
            $errorCode = "FILE_ALREADY_EXISTS";
            $errorMsg = "$file - File already exists in our server. Please rename and try again!";
            $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
            $_SESSION['academicprofile_success_msg'] = "";
            header("location:../book-chapters.php");
        }
        else if($filesize > 3000000){
            $errorCode = "FILE_SIZE_TOO_LARGE";
            $errorMsg = "$file - The selected file size is too large! Maximum 3MB allowed";
            $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
            $_SESSION['academicprofile_success_msg'] = "";
            header("location:../book-chapters.php");
        }else if(!in_array($ext,$allowed)) {
			$errorCode = "UNSUPPORTED_FILE_SIZE";
            $errorMsg = "$file - Unsupported file format (only PDF/DOC/DOCX/RTF)!";
            $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
            $_SESSION['academicprofile_success_msg'] = "";
            header("location:../book-chapters.php");
        } 
        if (move_uploaded_file($tmpfile, "../uploads/bookchapters/" . basename($file))) {
            $file_uploaded = $file;
        } else {
            $errorCode = "UPLOAD_FAILED";
            $errorMsg = "$file - File upload failed. Please try again later.";
            $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
            $_SESSION['academicprofile_success_msg'] = "";
            header("location:../book-chapters.php");
        }
    }else{
        $file_uploaded = NULL;
    }

    if($errorCode == NULL){

        $query = "INSERT INTO tbl_bookchapters (authors, chapter_title, book_year, book_editor, book_title, 
        book_edition, chapter_pagenum, publisher_location, publisher_name, chapter_file, chapter_owner, super_owner) VALUES ('$authors','$title','$year',
        '$editor','$booktitle','$edition','$pagenum','$location','$publisher','$file','$owner','$super_owner')";

        $sql = mysqli_query($conn, $query);

        if($sql === false){
            $errorCode = "SQL_DB_FAILED";
            $errorMsg = "There's a problem with MySQL Database. Please contact administrator.<br>Error Details: ". mysqli_error();
            $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
            $_SESSION['academicprofile_success_msg'] = "";
            header("location:../book-chapters.php");
        }

    }

    if($errorCode == NULL){
        $_SESSION['academicprofile_success_msg'] = "You have successfully added the book chapter!";
        $_SESSION['academicprofile_error_msg'] = NULL;
        header("location:../book-chapters.php");
    } 
}else{
    echo "Nothing to see here!";
}
?>