<?php
// Establish database connection
$db_host = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "lost_item";

$conn = mysqli_connect($db_host, $db_username, $db_password, $db_name);

// Check if form is submitted
if(isset($_POST['submit'])){
    // Retrieve form data
    $user_id = $_POST['user_id'];
    $username = $_POST['username'];
    $email = $_POST['email'];

    // Update user details in the database
    $query = "UPDATE user SET username = '$username', email = '$email' WHERE id = $user_id";
    $result = mysqli_query($conn, $query);

    if($result){
        echo "<p>User details updated successfully.</p>";
    } else {
        echo "<p>Failed to update user details. Please try again.</p>";
    }
	header("Location: adminpanel.php");
}
?>
