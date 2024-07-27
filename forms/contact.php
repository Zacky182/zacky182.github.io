<?php
  /**
  * Requires the "PHP Email Form" library
  * The "PHP Email Form" library is available only in the pro version of the template
  * The library should be uploaded to: vendor/php-email-form/php-email-form.php
  * For more info and help: https://bootstrapmade.com/php-email-form/
  */

  // Replace contact@example.com with your real receiving email address
  // Enable error reporting for debugging
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);

  // Replace with your real receiving email address
  $receiving_email_address = 'ammarmuzacky@gmail.com';

  // Check if the request method is POST
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the PHP Email Form library exists
    if (file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php')) {
      include($php_email_form);
    } else {
      die('Unable to load the "PHP Email Form" Library!');
    }

    // Initialize the PHP Email Form library
    $contact = new PHP_Email_Form;
    $contact->ajax = true;

    // Set email properties
    $contact->to = $receiving_email_address;
    $contact->from_name = $_POST['name'];
    $contact->from_email = $_POST['email'];
    $contact->subject = $_POST['subject'];

    // Uncomment below code if you want to use SMTP to send emails. You need to enter your correct SMTP credentials
    /*
    $contact->smtp = array(
      'host' => 'example.com',
      'username' => 'example',
      'password' => 'pass',
      'port' => '587'
    );
    */

    // Add messages
    $contact->add_message($_POST['name'], 'From');
    $contact->add_message($_POST['email'], 'Email');
    $contact->add_message($_POST['message'], 'Message', 10);

    // Send the email and echo the result
    echo $contact->send();
  } else {
    // Respond with a 405 Method Not Allowed if the request is not POST
    http_response_code(405);
    echo 'Method Not Allowed';
  }
?>
