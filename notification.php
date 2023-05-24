<?php
// Database connection details
$db_host = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "lost_item";

$conn = mysqli_connect($db_host, $db_username, $db_password, $db_name);

// Retrieve user information
$user_id = $_GET['$user_id'];
$query = "SELECT * FROM user WHERE id = $user_id";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

// Send notification email
$to = $user['email'];
$subject = "Lost Item Update";
$message = "Dear " . $user['username'] . ",\n\nYour lost item has been found! Please contact us to arrange for its recovery.\n\nThank you.";
$headers = "From: your_email@example.com";
$mailSent = mail($to, $subject, $message, $headers);

if ($mailSent) {
    echo "Notification email sent successfully.";
} else {
    echo "Failed to send notification email.";
}
?>
