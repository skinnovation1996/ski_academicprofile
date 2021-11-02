<?php
include("connectdb.php");
session_start();

$user_check = $_SESSION['user_login'];
$user_role = $_SESSION['user_role'];

if($user_role == "Admin" || $user_role == "Super Admin" || $user_role == "Academic Lecturer" || $user_role == "Consultant" || $user_role == "Teacher"){
    $ses_sql = mysqli_query($conn,"select admin_id, admin_name, role, university from tbl_admin where admin_id = '$user_check'");
   
    $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
    
    $login_session = $row['admin_id'];
    $your_name = $row['admin_name'];
    $login_super_owner = $row['admin_id'];
    $user_role= $row['role'];
    $owner_university = $row['university'];
    if($login_session == "super_admin")
        $navbar = "superadmin-navbar.php";
    else
        $navbar = "admin-navbar.php";
    
    if(!isset($_SESSION['user_login'])){
       header("location:login.php");
    }
}else if($user_role == "Student"){
    $ses_sql = mysqli_query($conn,"select std_reg_num, std_name, super_owner from tbl_students where std_reg_num = '$user_check' ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $row['std_reg_num'];
   $your_name = $row['std_name'];
   $login_super_owner = $row['super_owner'];
   $user_role = "Student";
   $navbar = "student-navbar.php";
   
   if(!isset($_SESSION['user_login'])){
      header("location:login.php");
   }
}else{
    header("location:login.php");
}

?>