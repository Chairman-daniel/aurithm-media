<?php
// require("./mailing/mailfunction.php");
// require("./mailing/mailingvariables.php");

// $name = $_POST["name"];
// $phone = $_POST['phone'];
// $email = $_POST["email"];
// $message = $_POST["message"];

// // Validate email
// if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
//     die('<center><h1>Invalid email address. Please go back and try again.</h1></center>');
// }
// //the body of the message
// $body = "<ul><li>Name: " . $name . "</li><li>Phone: " . $phone . "</li><li>Email: " . $email . "</li><li>Message: " . $message . "</li></ul>";

// $receiverEmail = "danielodilaa@gmail.com"; //email address to recieve the messages

// $status = mailfunction($receiverEmail, "Company", $body); //reciever
// if ($status) {
//     echo '<center><h1>Thanks! We will contact you soon.</h1></center>';
// } else {
//     echo '<center><h1>Error sending message! Please try again.</h1></center>';
// }

require("./mailing/mailfunction.php");
require("./mailing/mailingvariables.php");

$name = $_POST["name"];
$phone = $_POST['phone'];
$email = $_POST["email"];
$message = $_POST["message"];

// Validate email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die('<center><h1>Invalid email address. Please go back and try again.</h1></center>');
}

// The body of the message to the company
$bodyToCompany = "<ul><li>Name: " . $name . "</li><li>Phone: " . $phone . "</li><li>Email: " . $email . "</li><li>Message: " . $message . "</li></ul>";
$receiverEmail = "danielodilaa@gmail.com"; // Your email to receive messages

// Send email to the company
$statusToCompany = mailfunction($receiverEmail, "Company", $bodyToCompany);

// The body of the confirmation email to the client
$bodyToClient = "<p>Hi, " . $name . ",</p>";
$bodyToClient .= "<p>We just received your message and will get back to you shortly. Thank you for reaching out to us!</p>";
$bodyToClient .= "<p>Best regards,</p>";
$bodyToClient .= "<p>Your Company Name</p>";

// Send confirmation email to the client
$statusToClient = mailfunction($email, "We Received Your Message", $bodyToClient);

// Check if both emails were sent successfully
if ($statusToCompany && $statusToClient) {
    echo '<center><h1>Thanks! We will contact you soon.</h1></center>';
} else {
    echo '<center><h1>Error sending message! Please try again.</h1></center>';
}
?>