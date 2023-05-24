<?php
// Establish database connection
$db_host = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "lost_item";

$conn = mysqli_connect($db_host, $db_username, $db_password, $db_name);

// Handle form submission
if (isset($_POST['claim'])) {
    $itemId = $_POST['item_id'];
    $claimantName = $_POST['claimant_name'];

    // Update the lost_items table with the claimant's name
    $query = "UPDATE lost_items SET claimant_name = '$claimantName' WHERE id = '$itemId'";
    mysqli_query($conn, $query);

    // Redirect to a success page or perform any other desired action
    header("Location: claim_success.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Claim Item</title>
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

        p {
            margin-bottom: 10px;
        }

        strong {
            font-weight: bold;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
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
        <h2>Claim Item</h2>
        <?php
        if (isset($_GET['id'])) {
            $itemId = $_GET['id'];
            $query = "SELECT * FROM item_categories WHERE id = '$itemId'";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);

            if ($row) {
                ?>
                <p><strong>Description:</strong> <?php echo $row['description']; ?></p>
                <p><strong>Date of Loss:</strong> <?php echo $row['date_of_loss']; ?></p>
                <p><strong>Location:</strong> <?php echo $row['location']; ?></p>
                <p><strong>Contact Information:</strong> <?php echo $row['contact_info']; ?></p>

                <form method="POST" action="">
                        <input type="hidden" name="item_id" value="<?php echo $itemId; ?>">
                        <label for="claimant_name">Your Name:</label>
                        <input type="text" name="claimant_name" id="claimant_name" required>
                        <input type="submit" name="claim" value="Claim Item">
                </form>
            <?php
            } else {
                // Item not found
                echo "<p>Item not found.</p>";
            }
        } else {
            // No item ID specified
            echo "<p>No item specified.</p>";
        }
        ?>
		<p><a href="home.html" class="go-home-link">Go back to home page</a></p>
    </div>
</body>
</html>
