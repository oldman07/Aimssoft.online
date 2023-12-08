<?php

// $data = array(
//   'name' => 'John Doe',
//   'email' => 'johndoe@example.com',
//   'subject' => 'Example Subject',
//   'message' => 'Example Message'
// );

$data = array(
  'userEmail' => $_POST['email'],
);
$options = array(
  'http' => array(
    'method' => 'POST',
    'header' => 'Content-type: application/x-www-form-urlencoded',
    'content' => http_build_query($data)
  )
);

$context = stream_context_create($options);
$result = file_get_contents('http://135.181.62.34:8095/auth-api/saveOTP', false, $context);
if ($result === false) {
  // Handle error
  echo "Error: " . $curl_error($ch);
} else {
  // Handle success
  $response = json_decode($result, true);
  if ($response['success']) {
    echo "Message sent successfully";
  } else {
    echo "Error: " . $response['error'];
  }
}

//This code creates an array of the data to be sent in the request, sets the appropriate headers and content, and sends the request using file_get_contents() with a stream context created from the options. The result of the request is stored in $result, which can then be handled according to whether it was successful or not.






















  // /**
  // * Requires the "PHP Email Form" library
  // * The "PHP Email Form" library is available only in the pro version of the template
  // * The library should be uploaded to: vendor/php-email-form/php-email-form.php
  // * For more info and help: https://bootstrapmade.com/php-email-form/
  // */

  // // Replace contact@example.com with your real receiving email address
  // $receiving_email_address = 'knabeel380@gmail.com';

  // if( file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php' )) {
  //   include( $php_email_form );
  // } else {
  //   die( 'Unable to load the "PHP Email Form" Library!');
  // }

  // $contact = new PHP_Email_Form;
  // $contact->ajax = true;
  
  // $contact->to = $receiving_email_address;
  // $contact->from_name = $_POST['name'];
  // $contact->from_email = $_POST['email'];
  // $contact->subject = $_POST['subject'];

  // // Uncomment below code if you want to use SMTP to send emails. You need to enter your correct SMTP credentials
  // /*
  // $contact->smtp = array(
  //   'host' => 'example.com',
  //   'username' => 'example',
  //   'password' => 'pass',
  //   'port' => '587'
  // );
  // */

  // $contact->add_message( $_POST['name'], 'From');
  // $contact->add_message( $_POST['email'], 'Email');
  // $contact->add_message( $_POST['message'], 'Message', 10);

  // echo $contact->send();
?>
