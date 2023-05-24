<?php
// Check if admin is logged in, else redirect to login page
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: adminlogin.php");
    exit();
}

// Establish database connection
$db_host = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "lost_item";

$conn = mysqli_connect($db_host, $db_username, $db_password, $db_name);

// Get the user ID from the query parameter
$user_id = $_GET['id'];

// Retrieve user details from the database
$query = "SELECT * FROM user WHERE id = $user_id";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

// Handle form submission
if (isset($_POST['confirm'])) {
    // Delete the user from the database
    $delete_query = "DELETE FROM user WHERE id = $user_id";
    $delete_result = mysqli_query($conn, $delete_query);

    if ($delete_result) {
        // Deletion successful, redirect back to admin panel
        header("Location: adminpanel.php");
        exit();
    } else {
        // Deletion failed, display error message
        $error = "Failed to delete user.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Delete User</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 40px;
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h2 {
            font-size: 28px;
            margin-bottom: 20px;
            text-align: center;
            color: #e74c3c;
        }

        p.error {
            font-size: 18px;
            text-align: center;
            color: #e74c3c;
        }

        p.confirm {
            font-size: 18px;
            text-align: center;
            color: #333;
        }

        .btn-wrapper {
            display: flex;
            justify-content: center;
            margin-top: 30px;
        }

        .btn {
            padding: 10px 20px;
            background-color: #e74c3c;
            color: #fff;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-decoration: none;
        }

        .btn:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if (isset($user)) { ?>
            <h2>Delete User</h2>
            <p class="confirm">Are you sure you want to delete the following user?</p>
            <p class="confirm">Username: <?php echo $user['username']; ?></p>
            <p class="confirm">Email: <?php echo $user['email']; ?></p>
            <form method="POST" action="">
                <div class="btn-wrapper">
                    <input type="submit" name="confirm" value="Confirm" class="btn">
                    <a href="admin_panel.php" class="btn">Cancel</a>
                </div>
            </form>
        <?php } else { ?>
            <h2>User Not Found</h2>
            <p class="error">The user you are trying to delete does not exist.</p>
            <div class="btn-wrapper">
                <a href="admin_panel.php" class="btn">Back to Admin Panel</a>
            </div>
        <?php } ?>
    </div>
</body>
</html>
