<?php
session_start();

// Establish database connection
$db_host = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "lost_item";

$conn = mysqli_connect($db_host, $db_username, $db_password, $db_name);

// Handle form submission
if(isset($_POST['register'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Insert user data into database
    $query = "INSERT INTO user (username, email, password) VALUES ('$username', '$email', '$password')";
    mysqli_query($conn, $query);

    // Redirect to login page after successful registration
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<style>
body {
    background-color: #f2f2f2;
    font-family: Arial, sans-serif;
}

.container {
    max-width: 400px;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 4px;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
}

h2 {
    text-align: center;
    font-size: 24px;
    margin-bottom: 20px;
}

form {
    margin-bottom: 20px;
}

form input {
    display: block;
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    font-size: 16px;
    border-radius: 4px;
    border: 1px solid #ccc;
}

form input[type="submit"] {
    background-color: #3498db;
    color: #fff;
    border: none;
    cursor: pointer;
}

form input[type="submit"]:hover {
    background-color: #2980b9;
}

p {
    text-align: center;
    font-size: 14px;
}

p a {
    color: #3498db;
    text-decoration: none;
}

p a:hover {
    text-decoration: underline;
}
</style>
<body>
    <div class="container">
        <h2>User Registration</h2>
        <form method="POST" action="">
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" name="register" value="Register">
        </form>
        <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>
</body>
</html>

