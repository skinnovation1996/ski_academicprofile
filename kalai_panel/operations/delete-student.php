<?php
require_once("../assets/php/chk-session.php");
include("../assets/php/connectdb.php");
include("../assets/php/password.php");
date_default_timezone_set("Asia/Kuala_Lumpur");

$errorCode = "";
$errorMsg = "";
$successMsg = "";


if(isset($_POST['delete-button'])){
    $sqlgetid = $_POST['oldid'];
    $super_owner = $login_super_owner;
    $sql = mysqli_query($conn, "SELECT * from tbl_students WHERE id='$sqlgetid' AND super_owner='$super_owner'");
    $row = mysqli_fetch_array($sql);
    $regnum = $row['std_reg_num'];
    $selected_type = $row['std_type'];
    if($selected_type == 0){
        $typename = "Undergraduates";
        $typesel = "FYP";
        $back_button = "students_ug.php";
    }else if($selected_type == 1){
        $typename = "Masters";
        $typesel = "MA";
        $back_button = "students_masters.php";
    }else if($selected_type == 2){
        $typename = "PhD";
        $typesel = "PHD";
        $back_button = "students_phd.php";
    }else if($selected_type == 3){
        $typename = "Research Team Member";
        $typesel = "RA";
        $back_button = "students_research.php";
    }
    $old_file = $row['std_picture'];

    if($errorCode == NULL){

        $query = "DELETE from tbl_students where id='$sqlgetid' and std_type='$typesql' AND super_owner='$super_owner'";

        $sql = mysqli_query($conn, $query);

        if($sql === false){
            $errorCode = "SQL_DB_FAILED";
            $errorMsg = "There's a problem with MySQL Database. Please contact administrator.<br>Error Details: ". mysqli_error();
            $_SESSION['academicprofile_error_msg'] = $errorMsg . " (Error Code: $errorCode)";
            $_SESSION['academicprofile_success_msg'] = NULL;
            header("location:../$back_button");
        }

    }

    if($errorCode == NULL){
        unlink("../uploads/images/$regnum/" . basename($old_file));
        //ALSO REMOVE ALL PUBLICATIONS, ASSIGNED RESEARCH OUTCOME AND STUDENT ACTIVITY FROM THIS STUDENT
        mysqli_query($conn, "DELETE from tbl_journals where journal_owner='$regnum' AND super_owner='$super_owner'");
        mysqli_query($conn, "DELETE from tbl_proceedings where proceeding_owner='$regnum' AND super_owner='$super_owner'");
        mysqli_query($conn, "DELETE from tbl_bookchapters where chapter_owner='$regnum' AND super_owner='$super_owner'");
        mysqli_query($conn, "DELETE from tbl_books where book_owner='$regnum' AND super_owner='$super_owner'");
        mysqli_query($conn, "DELETE from tbl_abstract where abstract_owner='$regnum' AND super_owner='$super_owner'");
        mysqli_query($conn, "DELETE from tbl_thesis where abstract_owner='$regnum' AND super_owner='$super_owner'");
        mysqli_query($conn, "DELETE from tbl_popular_article where article_owner='$regnum' AND super_owner='$super_owner'");
        mysqli_query($conn, "ALTER tbl_research_outcome SET research_owner='Student' where research_owner='$regnum' AND super_owner='$super_owner'");

        mysqli_query($conn, "ALTER TABLE tbl_students DROP `id`");
	    mysqli_query($conn, "ALTER TABLE tbl_students ADD `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST;");
        mysqli_query($conn, "ALTER TABLE tbl_journals DROP `id`");
	    mysqli_query($conn, "ALTER TABLE tbl_journals ADD `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST;");
        mysqli_query($conn, "ALTER TABLE tbl_bookchapters DROP `id`");
	    mysqli_query($conn, "ALTER TABLE tbl_bookchapters ADD `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST;");
        mysqli_query($conn, "ALTER TABLE tbl_books DROP `id`");
	    mysqli_query($conn, "ALTER TABLE tbl_books ADD `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST;");
        mysqli_query($conn, "ALTER TABLE tbl_proceedings DROP `id`");
	    mysqli_query($conn, "ALTER TABLE tbl_proceedings ADD `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST;");
        mysqli_query($conn, "ALTER TABLE tbl_abstract DROP `id`");
	    mysqli_query($conn, "ALTER TABLE tbl_abstract ADD `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST;");
        mysqli_query($conn, "ALTER TABLE tbl_thesis DROP `id`");
	    mysqli_query($conn, "ALTER TABLE tbl_thesis ADD `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST;");
        mysqli_query($conn, "ALTER TABLE tbl_popular_article DROP `id`");
	    mysqli_query($conn, "ALTER TABLE tbl_popular_article ADD `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST;");

        $_SESSION['academicprofile_success_msg'] = "You have successfully removed the student and their publications!";
        $_SESSION['academicprofile_error_msg'] = NULL;
        header("location:../$back_button");
    } 
}else{
    echo "Nothing to see here!";
}
?>