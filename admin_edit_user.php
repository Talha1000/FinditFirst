<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel - Edit User</title>
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
            color: #3498db;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input[type="text"], input[type="email"] {
            width: 100%;
            padding: 8px;
            font-size: 16px;
            border-radius: 4px;
            border: 1px solid #ddd;
        }

        input[type="submit"] {
            display: circle;
            width: 100%;
            padding: 12px;
            background-color: #3498db;
            color: #fff;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #2980b9;
        }

        p.success {
            color: green;
            text-align: center;
            margin-top: 10px;
        }

        p.error {
            color: red;
            text-align: center;
            margin-top: 10px;
        }
    </style>
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit User</h2>

        <?php
        // Establish database connection
        $db_host = "localhost";
        $db_username = "root";
        $db_password = "";
        $db_name = "lost_item";

        $conn = mysqli_connect($db_host, $db_username, $db_password, $db_name);

        // Check if user ID is provided
        if(isset($_GET['id'])){
            $user_id = $_GET['id'];

            // Retrieve user details from the database
            $query = "SELECT * FROM user WHERE id = $user_id";
            $result = mysqli_query($conn, $query);
            $user = mysqli_fetch_assoc($result);

            if($user){
                // Display user details in the edit form
        ?>
                <form method="POST" action="admin_update_user.php">
                    <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                    <label for="username">Username:</label>
                    <input type="text" name="username" id="username" value="<?php echo $user['username']; ?>"><br>
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" value="<?php echo $user['email']; ?>"><br>
                    <input type="submit" name="submit" value="Update">
                </form>
        <?php
            } else {
                echo "<p>User not found.</p>";
            }
        } else {
            echo "<p>Invalid user ID.</p>";
        }
        ?>
    </div>
</body>
</html>
