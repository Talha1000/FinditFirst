<?php
session_start();

// Establish database connection
$db_host = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "lost_item";

$conn = mysqli_connect($db_host, $db_username, $db_password, $db_name);

// Handle form submission
if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Fetch user data from database
    $query = "SELECT * FROM user WHERE username='$username'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    // Verify password
    if($row && $row['password'] === $password){
        // Authentication successful, set session variables
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['username'] = $row['username'];

        // Redirect to home page after successful login
        header("Location: home.html");
        exit();
    } else {
        // Invalid credentials
        $error = "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Login</title>
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
        <h2>User Login</h2>
        <form method="POST" action="">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" name="login" value="Login">
        </form>
        <p>Don't have an account? <a href="registration.php">Register here</a></p>
    </div>
</body>
</html>

