<?php
   include("assets/php/connectdb.php");
   session_start();
  
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      $myusername = mysqli_real_escape_string($conn,$_POST['regnum']);
      $mypassword = mysqli_real_escape_string($conn,$_POST['password']);
      $mypassword = md5($mypassword);

      $user_role = mysqli_real_escape_string($conn,$_POST['role']);

      if($user_role == "Admin"){
        $sql = "SELECT * FROM tbl_admin WHERE admin_id = '$myusername' && admin_password ='$mypassword'";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($result);
        $count = mysqli_num_rows($result);
          
        if($count == 1) {
            $_SESSION['user_login'] = $myusername;
            $_SESSION['user_role'] = $row['role'];
            $_SESSION['user_super_owner'] = $myusername;
        
            header('location:index.php');
        }else {
           echo"<script language=\"javascript\">alert(\"Invalid username or password!\");</script>";
        }
      }else if($user_role == "Student"){
        $sql = "SELECT * FROM tbl_students WHERE std_reg_num = '$myusername' && std_password ='$mypassword'";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($result);
        $count = mysqli_num_rows($result);
          
        if($count == 1) {
            $_SESSION['user_login'] = $myusername;
            $_SESSION['user_role'] = "Student";
            $_SESSION['user_super_owner'] = $row['super_owner'];
          
           if($row['std_firstlogin'] == 1){
             header('location:firstrun.php');
           }
           else{
             header('location:index.php');
           }
        }else {
           echo"<script language=\"javascript\">alert(\"Invalid username or password!\");</script>";
        }
      }
   }

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>LOGIN - Academic Profile System Panel</title>
      <link rel="stylesheet" href="assets/css/login-style.css">
</head>

<body>
  <div class="login-page">
    <h1 style="text-align:center; color:white;">Academic Profile SYSTEM PANEL LOGIN</h1>
  <div class="form">
    <form id="login" name="login" method="post" class="login-form" action="">
      <input type="text" name="regnum" placeholder="User id" required/>
      <input type="password" name="password" placeholder="Password" required/>
      <select name="role">
          <option value="Admin">Academic Lecturer/Consultant/Teacher</option>
          <option value="Student">Student/Client</option>
        </select>
      <button type="submit" form="login" value="login">login</button>
      <p class="message"><a href="../index.php">go back</a></p>
    </form>
  </div>
</div>
  <script src='assets/js/jquery-login.js'></script>

</body>
</html>
