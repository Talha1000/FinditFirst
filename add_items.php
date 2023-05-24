<?php
// Establish database connection
$db_host = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "lost_item";

$conn = mysqli_connect($db_host, $db_username, $db_password, $db_name);

// Handle form submission
if (isset($_POST['submit'])) {
    $description = $_POST['description'];
    $dateOfLoss = $_POST['date_of_loss'];
    $location = $_POST['location'];
    $contactInfo = $_POST['contact_info'];

    // Insert the item into the database
    $query = "INSERT INTO lost_items (description, date_of_loss, location, contact_info) VALUES ('$description', '$dateOfLoss', '$location', '$contactInfo')";
    mysqli_query($conn, $query);

    // Redirect to a success page or perform any other desired action
    header("Location: report_success.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Report Lost Item</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h2 {
            font-size: 28px;
            margin-bottom: 20px;
            text-align: center;
            color: #3498db;
        }

        form label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        form input[type="text"],
        form textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        form input[type="submit"] {
            display: block;
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #3498db;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        form input[type="submit"]:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Report Lost Item</h2>
        <form method="POST" action="">
            <label for="description">Description:</label>
            <input type="text" name="description" id="description" required>
            <label for="date_of_loss">Date of Loss:</label>
            <input type="date" name="date_of_loss" id="date_of_loss" required>
            <label for="location">Location:</label>
            <input type="text" name="location" id="location" required>
            <label for="contact_info">Contact Information:</label>
            <textarea name="contact_info" id="contact_info" rows="4" required></textarea>
            <input type="submit" name="submit" value="Submit">
        </form>
    </div>
</body>
</html>
