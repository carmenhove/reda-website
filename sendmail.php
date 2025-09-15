<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// load PHPMailer classes (adjust path if needed)
require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

// Collect form data
$first_name = $_POST['first_name'] ?? '';
$last_name  = $_POST['last_name'] ?? '';
$email      = $_POST['email'] ?? '';
$message    = $_POST['message'] ?? '';

$to      = "reda.consulting@protonmail.com"; // where you want to receive emails
$nameto  = "Reda Consulting, LLC";
$subject = "New contact form submission";
$body    = "
  <h3>New message from your contact form</h3>
  <p><strong>Name:</strong> $first_name $last_name</p>
  <p><strong>Email:</strong> $email</p>
  <p><strong>Message:</strong><br>$message</p>
";

$altmess = "Name: $first_name $last_name\nEmail: $email\nMessage:\n$message";

sendmail($to, $nameto, $subject, $body, $altmess);

function sendmail($to, $nameto, $subject, $message, $altmess) {
  $from     = "youremail@domain.tld";  // your email
  $namefrom = "Your Name";             // name shown in inbox

  $mail = new PHPMailer();
  $mail->SMTPDebug = 0;
  $mail->CharSet   = 'UTF-8';
  $mail->isSMTP();
  $mail->SMTPAuth   = true;
  $mail->Host       = "smtp.protonmail.ch"; // your SMTP server
  $mail->Port       = 587;
  $mail->Username   = $from;
  $mail->Password   = "Letsgo!234";       // your email password
  $mail->SMTPSecure = "ssl";

  $mail->setFrom($from, $namefrom);
  $mail->addAddress($to, $nameto);
  $mail->Subject = $subject;
  $mail->isHTML(true);
  $mail->Body    = $message;
  $mail->AltBody = $altmess;

  if ($mail->send()) {
    echo "Message sent successfully!";
  } else {
    echo "Mailer Error: " . $mail->ErrorInfo;
  }
}
