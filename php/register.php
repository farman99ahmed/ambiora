<?php

use PHPMailer\PHPMailer\PHPMailer;
require '../vendor/autoload.php';

/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
include_once('config.php');
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Escape user inputs for security
$name = mysqli_real_escape_string($link, $_REQUEST['name']);
$email = mysqli_real_escape_string($link, $_REQUEST['email']);
$mobile = mysqli_real_escape_string($link, $_REQUEST['mobile']);
$comm = mysqli_real_escape_string($link, $_REQUEST['comm']);
$message = mysqli_real_escape_string($link, $_REQUEST['message']);
 
// attempt insert query execution

$sql="INSERT INTO registers(name, email, mobile, comm, message) VALUES ('$name', '$email', '$mobile', '$comm', '$message')";


if(mysqli_query($link, $sql)){
	$last_id = mysqli_insert_id($link);
	
	

    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->Host = 'smtp.hostinger.com';
    $mail->Port = 587;
    $mail->SMTPAuth = true;
    $mail->Username = 'notifications@ambiorafest.com';
    $mail->Password = 'Ambiora@123';
    $mail->setFrom('notifications@ambiorafest.com', 'Ambiora TechFest 2019');
    $mail->addAddress($email, $name);
    if ($mail->addReplyTo('ambiora2019@gmail.com', 'Ambiora TechFest 2019')) {
        $mail->Subject = 'Thank you for showing your interest in Ambiora TechFest 2019';
        $mail->isHTML(false);
        $mail->Body = <<<EOT
Dear {$_POST['name']}


Thank you for showing your interest in Ambiora TechFest 2019. We will contact you shortly.

EOT;
        if (!$mail->send()) {
            $msg = 'Sorry, something went wrong. Please try again later.';
        } else {
            $msg = 'Message sent! Thanks for contacting us.';
        }
    } else {
        $msg = 'Invalid email address, message ignored.';
    }

	
	
	echo "<script>
alert('Data recorded successfully. The ticket # is : $last_id');
window.location.href='../index.html';
</script>";


} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
// close connection
mysqli_close($link);
?>