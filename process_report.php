<?php
// Establish database connection
$db_host = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "lost_item";

$conn = mysqli_connect($db_host, $db_username, $db_password, $db_name);

// Check for connection errors
if (mysqli_connect_errno()) {
    die("Failed to connect to MySQL: " . mysqli_connect_error());
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve and sanitize form data
	$id = isset($_POST['id']) ? $_POST['id'] : '';
    $itemName = isset($_POST['item_name']) ? $_POST['item_name'] : '';
    $description = isset($_POST['description']) ? $_POST['description'] : '';
    $dateFound = isset($_POST['date_found']) ? $_POST['date_found'] : '';
    $locationFound = isset($_POST['location_found']) ? $_POST['location_found'] : '';
    $contactInfo = isset($_POST['contact_info']) ? $_POST['contact_info'] : '';
    $reporterName = isset($_POST['reporter_name']) ? $_POST['reporter_name'] : '';
    $reporterEmail = isset($_POST['reporter_email']) ? $_POST['reporter_email'] : '';

    // Insert the report into the database
    $query = "INSERT INTO found_items (name, description, date_found, location_found, contact_info, reporter_name, reporter_email)
              VALUES ('$itemName', '$description', '$dateFound', '$locationFound', '$contactInfo', '$reporterName', '$reporterEmail')";
    mysqli_query($conn, $query);

    // Close database connection
    mysqli_close($conn);

}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Save Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 500px;
            margin: 0 auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h2 {
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
            color: #3498db;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            resize: vertical;
        }

        input[type="submit"] {
            background-color: #3498db;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #2186c9;
        }
		
		input[type="submit"] {
            padding: 5px 10px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        
        a {
            color: #4CAF50;
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
        <h2>Save Report</h2>
    <p><strong>ID:</strong> <?php echo $id; ?></p>
    <p><strong>Name:</strong> <?php echo $itemName; ?></p>
    <p><strong>Description:</strong> <?php echo $description; ?></p>
    <p><strong>Date of Found:</strong> <?php echo $dateFound; ?></p>
    <p><strong>Location:</strong> <?php echo $locationFound; ?></p>
    <p><strong>Contact Information:</strong> <?php echo $contactInfo; ?></p>
	<p><strong>Reporter Name:</strong> <?php echo $reporterName; ?></p>
	<p><strong>Reporter Email:</strong> <?php echo $reporterEmail; ?></p>

            <input type="submit" value="Save Report">
			<a href="reportitem.php">Submit Another Report</a>
			<p><a href="home.html" class="go-home-link">Go back to home page</a></p>
    </body>
</html>
