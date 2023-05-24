<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel - User Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 800px;
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
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        a {
            display: inline-block;
            padding: 8px 12px;
            background-color: #3498db;
            color: #fff;
            text-decoration: none;
            font-size: 14px;
            border-radius: 4px;
            margin-right: 8px;
            transition: background-color 0.3s ease;
        }

        a:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>User Management</h2>
        <table>
            <tr>
                <th>Username</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
            <?php
            // Establish database connection
            $db_host = "localhost";
            $db_username = "root";
            $db_password = "";
            $db_name = "lost_item";

            $conn = mysqli_connect($db_host, $db_username, $db_password, $db_name);

            // Retrieve user accounts
            $query = "SELECT * FROM user";
            $result = mysqli_query($conn, $query);
            $users = mysqli_fetch_all($result, MYSQLI_ASSOC);

            // Display user accounts
            foreach($users as $user){ ?>
                <tr>
                    <td><?php echo $user['username']; ?></td>
                    <td><?php echo $user['email']; ?></td>
                    <td>
                        <a href="admin_edit_user.php?id=<?php echo $user['id']; ?>">Edit</a>
                        <a href="admin_delete_user.php?id=<?php echo $user['id']; ?>">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>



