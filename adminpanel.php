<?php
// Check if admin is logged in, else redirect to login page
session_start();

// Establish database connection
$db_host = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "lost_item";

$conn = mysqli_connect($db_host, $db_username, $db_password, $db_name);

// Handle logout
if(isset($_GET['logout'])){
    session_destroy();
    header("Location: adminlogin.php");
    exit();
}

// Retrieve and display user accounts
$query = "SELECT * FROM user";
$result = mysqli_query($conn, $query);
$users = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Retrieve and display item listings
$query = "SELECT * FROM lost_items";
$result = mysqli_query($conn, $query);
$items = mysqli_fetch_all($result, MYSQLI_ASSOC);

        // Redirect to home page after successful login
        header("Location: admin_item_edit.php");
        exit();
    } else {
        // Invalid credentials
        $error = "Invalid username or password";
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
</head>
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

h3 {
    font-size: 24px;
    margin-bottom: 16px;
}

.section {
    margin-bottom: 40px;
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

.editable {
    cursor: pointer;
}

.editable input {
    width: 100%;
}

.editable input,
.editable input:focus {
    border: none;
    background-color: transparent;
    outline: none;
}

.save-btn,
.cancel-btn {
    display: none;
    margin-top: 5px;
}

.editable.active .save-btn,
.editable.active .cancel-btn {
    display: inline-block;
}

.editable.active span {
    display: none;
}
</style>

<body>
    <h2>Welcome, Admin!</h2>
    <a href="adminpanel.php?logout=true">Logout</a>
    
    <h3>User Accounts</h3>
    <table>
        <tr>
            <th>Username</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
        <?php foreach($users as $user){ ?>
            <tr>
                <td class="editable" data-field="username" data-id="<?php echo $user['id']; ?>">
                    <span><?php echo $user['username']; ?></span>
                    <input type="text" value="<?php echo $user['username']; ?>">
                    <button class="save-btn">Save</button>
                    <button class="cancel-btn">Cancel</button>
                </td>
                <td class="editable" data-field="email" data-id="<?php echo $user['id']; ?>">
                    <span><?php echo $user['email']; ?></span>
                    <input type="text" value="<?php echo $user['email']; ?>">
                    <button class="save-btn">Save</button>
                    <button class="cancel-btn">Cancel</button>
                </td>
                <td>
                    <a href="admin_edit_user.php?id=<?php echo $user['id']; ?>">Edit</a>
                    <a href="admin_delete_user.php?id=<?php echo $user['id']; ?>">Delete</a>
                </td>
            </tr>
        <?php } ?>
    </table>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var editableFields = document.getElementsByClassName('editable');

            for (var i = 0; i < editableFields.length; i++) {
                var field = editableFields[i];
                var span = field.querySelector('span');
                var input = field.querySelector('input');
                var saveBtn = field.querySelector('.save-btn');
                var cancelBtn = field.querySelector('.cancel-btn');

                // Activate editing mode
                span.addEventListener('click', function() {
                    var parent = this.parentNode;
                    parent.classList.add('active');
                    parent.querySelector('input').focus();
                });

                // Save changes
                saveBtn.addEventListener('click', function() {
                    var parent = this.parentNode;
                    var id = parent.getAttribute('data-id');
                    var field = parent.getAttribute('data-field');
                    var value = parent.querySelector('input').value;

                    // Perform AJAX request to update the database
                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', 'admin_update_user.php', true);
                    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === 4 && xhr.status === 200) {
                            // Update the displayed value
                            parent.querySelector('span').textContent = value;
                            parent.classList.remove('active');
                        }
                    };
                    xhr.send('id=' + id + '&field=' + field + '&value=' + value);
                });

                // Cancel editing
                cancelBtn.addEventListener('click', function() {
                    var parent = this.parentNode;
                    parent.classList.remove('active');
                });
            }
        });
    </script>
</body>
</html>
