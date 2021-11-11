<?php
include("../assets/php/connectdb.php");
require '../assets/vendor/sendgrid-php/sendgrid-php.php';

$SENDGRID_API_KEY = 'VOID';

$sendgrid = new SendGrid(getenv('VOID')); //api key from SendGrid
$sg_email = new SendGrid\Mail\Mail();

$userid = $_POST['user_id'];
$sqla = mysqli_query($conn, "SELECT * from tbl_admin WHERE id='$userid' AND admin_id NOT LIKE 'super_admin'"); 
$row=mysqli_fetch_assoc($sqla);
$super_owner = $row['admin_id'];
$user_name = $row['admin_name'];

$receiving_email_address = $row['email'];

$sender_name = $_POST['name'];
$sender_subject = $_POST['subject'];
$sender_email_address = $_POST['email'];
$message = $_POST['message'];

$sg_email->setFrom("$sender_email_address", "$sender_name");
$sg_email->setSubject("$sender_subject");
$sg_email->addTo("$receiving_email_address", "$user_name");
$sg_email->addContent("text/html", "$message");
try {
    $response = $sendgrid->send($sg_email);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Unable Caught exception: '. $e->getMessage() ."\n";
}
?>
