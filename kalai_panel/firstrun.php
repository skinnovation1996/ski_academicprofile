<?php
include("assets/php/connectdb.php");
include("assets/php/chk-session.php");

//for STUDENT ONLY
if($user_role != "Student"){
header("location:index.php");
}
   
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $password = mysqli_real_escape_string($conn,$_POST['password']);
    $confirm = mysqli_real_escape_string($conn,$_POST['confirm']); 

    if($password == $confirm){
    $password = md5($password);
    $sql = "UPDATE tbl_students SET std_password = '$password', std_firstlogin=0 WHERE std_reg_num='$login_session' AND super_owner='$login_super_owner'";
    $result = mysqli_query($conn,$sql);
    session_destroy();
    echo"<script language=\"javascript\">alert(\"Success update password! $login_session, you can now log in again\");location.href='index.php'</script>";

    }else{
        echo"<script language=\"javascript\">alert(\"Password did not match the confirm password field!\");</script>";
    }
}

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>FIRST-TIME CHANGE PASSWORD - Academic Profile Student Panel</title>
      <link rel="stylesheet" href="includes/css/style.css">
</head>

<body>
  <div class="login-page">
      <h1 style="text-align:center; color:white;">Welcome, <?php echo $login_session;?>! Please enter your new password</h1>
  <div class="form">
    <form id="changepass" name="changepass" method="post" class="login-form" action="firstrun.php">
      <input type="password" name="password" placeholder="new password" required/>
      <input type="password" name="confirm" placeholder="confirm password" required/>
      <button type="submit" form="changepass" value="login">set password</button>
      <p class="message"><a href="logout.php">log out</a></p>
    </form>
  </div>
</div>
  <script src='includes/js/jquery.js'></script>

</body>
</html>
