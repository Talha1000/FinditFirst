<?php
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
    $query = "INSERT INTO admin (username, email, password) VALUES ('$username', '$email', '$password')";
    mysqli_query($conn, $query);

    // Redirect to login page after successful registration
    header("Location: adminlogin.php");
    exit();
}
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Registration</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 4px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        }

        h2 {
            text-align: center;
        }

        form {
            margin-top: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        .error-message {
            color: #ff0000;
        }

        .submit-btn {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
		
		.go-login-link {
            color: #2196F3;
            text-decoration: none;
        }
		
		.go-home-link {
            color: #2196F3;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Admin Registration</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" name="confirm_password" id="confirm_password" required>
            </div>
            <?php if (!empty($errors)) { ?>
                <div class="error-message">
                    <?php foreach ($errors as $error) { ?>
                        <p><?php echo $error; ?></p>
                    <?php } ?>
                </div>
            <?php } ?>
            <input type="submit" name="register" value="Register" class="submit-btn">
			 <p>Already have an account? <a href="adminlogin.php" class="go-login-link">Login here</a></p>
			 <p><a href="home.html" class="go-home-link">Go back to home page</a></p>
        </form>
    </div>
</body>
</html>
