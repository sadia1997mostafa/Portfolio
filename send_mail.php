<?php
// send_mail.php
include 'backend/db.php';

// simple sanitization
$name    = trim($_POST['name'] ?? '');
$email   = trim($_POST['email'] ?? '');
$subject = trim($_POST['subject'] ?? '');
$message = trim($_POST['message'] ?? '');

if (!$name || !$email || !$subject || !$message) {
    die("Please fill all fields.");
}

// Insert into DB (prepared statement)
$stmt = $conn->prepare("INSERT INTO messages (name, email, subject, message) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $name, $email, $subject, $message);
$inserted = $stmt->execute();
$stmt->close();

if (!$inserted) {
    die("Failed to save message.");
}

// Send email to you
$to = "nasimac300@gmail.com"; // your email
$headers = "From: " . $email . "\r\n" .
           "Reply-To: " . $email . "\r\n" .
           "MIME-Version: 1.0\r\n" .
           "Content-Type: text/plain; charset=UTF-8\r\n";

$mailBody = "New contact message\n\n";
$mailBody .= "Name: {$name}\n";
$mailBody .= "Email: {$email}\n";
$mailBody .= "Subject: {$subject}\n";
$mailBody .= "Message:\n{$message}\n";

// Try PHP mail() (may not work on local XAMPP without SMTP setup)
if (mail($to, $subject, $mailBody, $headers)) {
    // success
    header("Location: thank_you.html"); // or back to your portfolio with a success message
    exit;
} else {
    // If mail() fails (common on local), still redirect or show success because DB saved
    header("Location: thank_you.html");
    exit;
}

/*
=== Production note: use PHPMailer with SMTP for reliable delivery ===
Install via Composer: composer require phpmailer/phpmailer
Then replace mail() with PHPMailer SMTP code (Gmail SMTP or your provider) to ensure emails are delivered.
*/
?>
