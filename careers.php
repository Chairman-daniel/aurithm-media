<?php

require("./mailing/mailfunction.php");
require("./mailing/mailingvariables.php");

$name = $_POST["name"];
$phone = $_POST['phone'];
$email = $_POST["email"];
$applyfor = $_POST["status"];
$experience = $_POST["experience"];
$otherdetails = $_POST["details"];

$filename = $_FILES["fileToUpload"]["name"];
$filetype = $_FILES["fileToUpload"]["type"];
$filesize = $_FILES["fileToUpload"]["size"];
$tempfile = $_FILES["fileToUpload"]["tmp_name"];

$uploadDirectory = __DIR__ . "/tmp-uploads/"; // Path to tmp-uploads folder
$filenameWithDirectory = $uploadDirectory . $name . ".pdf";  // Path for uploaded file

// Email body for the company (receiver)
$body = "<ul><li>Name: " . $name . "</li><li>Phone: " . $phone . "</li><li>Email: " . $email . "</li><li>Apply For: " . $applyfor . "</li><li>Experience: " . $experience . " Yrs.</li><li>Resume(Attached Below):</li></ul>";

// Email body for the job seeker (confirmation message)
$seekerBody = "<p>Dear " . $name . ",</p>
               <p>We have received your job application for the position of " . $applyfor . ".</p>
               <p>Thank you for trusting us. We will review your application and get back to you shortly.</p>
               <p>Best regards,<br>Your Company Name</p>";


// Move the uploaded file to the desired directory
if (move_uploaded_file($tempfile, $filenameWithDirectory)) {
    // Send email to the company with job application details
    $companyStatus = mailfunction("danielodilaa@gmail.com", "New Job Application", $body, $filenameWithDirectory);

    // Send confirmation email to the job seeker
    $seekerStatus = mailfunction($email, "Thank you for your application", $seekerBody); // Job seeker email

    // Check if both emails were sent successfully
    if ($companyStatus && $seekerStatus) {
        echo '<center><h1>Thanks! We will contact you soon.</h1></center>';
    } else {
        echo '<center><h1>Error sending message! Please try again.</h1></center>';
    }
} else {
    echo "<center><h1>Error uploading file! Please try again.</h1></center>";
}
