<?php
// Establish database connection
$db_host = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "lost_item";

$conn = mysqli_connect($db_host, $db_username, $db_password, $db_name);

// Check if the form is submitted
if(isset($_POST['submit'])){
	$id = $_POST['id'];
	$name = $_POST['name'];
    $description = $_POST['description'];
    $dateFound = $_POST['date_found'];
    $locationFound = $_POST['location_found'];
    $contactInfo = $_POST['contact_info'];
    $reporterName = $_POST['reporter_name'];
    $reporterEmail = $_POST['reporter_email'];
    
    // Insert the form data into the database
    $query = "INSERT INTO found_items (id, name, description, date_found, location_found, contact_info, reporter_name, reporter_email) 
              VALUES ('$id', '$name','$description', '$dateFound', '$locationFound', '$contactInfo', '$reporterName', '$reporterEmail')";
    
    if(mysqli_query($conn, $query)){
        // Successful insertion, redirect to a success page or display a success message
        header("Location: success.php");
        exit();
    } else {
        // Error occurred during insertion, display an error message or redirect to an error page
        echo "Error: " . mysqli_error($conn);
    }
}

// Close database connection
mysqli_close($conn);
?>


<!DOCTYPE html>
<html>
<head>
    <title>Report Found Item</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
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
            margin-bottom: 5px;
            font-weight: bold;
        }

        textarea,
        input[type="text"],
		input[type="date"],
        input[type="email"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            display: block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #3498db;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #2980b9;
        }
		
		.go-home-link {
            color: #2196F3;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Report Found Item</h2>
        <form method="POST" action="process_report.php">
		    <label for="name">Item Name:</label>
			<input type="text" name="name" id="name" required>
            <label for="description">Description:</label>
            <textarea name="description" id="description" rows="4" cols="50" required></textarea>
            <label for="start_date">Date Of Found:</label>
            <input type="date" name="start_date" id="start_date">
            <label for="location_found">Location Found:</label>
            <input type="text" name="location_found" id="location_found" required>
            <label for="contact_info">Contact Information:</label>
            <input type="text" name="contact_info" id="contact_info" required>
            <label for="reporter_name">Reporter Name:</label>
            <input type="text" name="reporter_name" id="reporter_name" required>
            <label for="reporter_email">Reporter Email:</label>
            <input type="email" name="reporter_email" id="reporter_email" required>
            <input type="submit" name="submit" value="Submit">
			<p><a href="home.html" class="go-home-link">Go back to home page</a></p>
        </form>
    </div>
</body>
</html>

