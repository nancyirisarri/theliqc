<?php

// Contact form error message
define('ERROR_MESSAGE', 'Something went wrong, please try to submit later.');

// Contact form message title
define('CONTACT_EMAIL_TITLE', 'TODO region file');

// Contact form success message
define('CONTACT_SUCCESS_MESSAGE', 'Thank you! We will get back to you as soon as possible.');

// define variables and set to empty values
$emailErr = $subjectErr = "";
$email = $subject = $message = $sex = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  //$email = "irisarri@strw.leidenuniv.nl";
  $email = "kids@strw.leidenuniv.nl";

  // Headers
  $headers = 'MIME-Version: 1.0' . "\r\n";
  $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
  $headers .= 'From: ' . $email;

  $exposure = $_POST['urlInput'];

  $message_body = $exposure . "<br><br>";

  // Split the string by using commas.
  $ccdList = explode(",", $_POST['ccdsInput']);

  foreach($ccdList as $ccd) {
    $message_body = $message_body . "<br>" . $ccd;
  }

  // Send mail
  if (mail($email, CONTACT_EMAIL_TITLE, $message_body, $headers)) {
    echo "<span style='font-size: 14px; font-family: Roboto, Arial, sans-serif;'>List sent successfully</span>";
  } else {
    echo "<span style='font-size: 14px; font-family: Roboto, Arial, sans-serif;'>List not sent!</span>";
  }
}

?>
