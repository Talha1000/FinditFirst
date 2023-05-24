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

// Retrieve item details based on ID
if (isset($_GET['id'])) {
    $itemId = $_GET['id'];

    // Fetch item data from the database
    $query = "SELECT * FROM item_categories WHERE id = '$itemId'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    // Check if item exists
    if ($row) {
        $id = isset($row['id']) ? $row['id'] : '';
        $name = isset($row['name']) ? $row['name'] : '';
        $category = isset($row['category']) ? $row['category'] : '';
        $description = isset($row['description']) ? $row['description'] : '';
        $dateOfLoss = isset($row['date_of_loss']) ? $row['date_of_loss'] : '';
        $location = isset($row['location']) ? $row['location'] : '';
        $contactInfo = isset($row['contact_info']) ? $row['contact_info'] : '';
    } else {
        // Item not found, redirect to list_items.php
        header("Location: list_items.php");
        exit();
    }
} else {
    // No item ID specified, redirect to list_items.php
    header("Location: list_items.php");
    exit();
}

// Retrieve messages related to the item
$query = "SELECT * FROM item_messages";
$messagesResult = mysqli_query($conn, $query);

// Handle form submission for communication
if (isset($_POST['send_message'])) {
	$item_id = isset($_POST['item_id']) ? $_POST['item_id'] : '';
    $senderName = isset($_POST['sender_name']) ? $_POST['sender_name'] : '';
    $message = isset($_POST['message']) ? $_POST['message'] : '';

    // Insert the message into the database
    $query = "INSERT INTO item_messages (item_id, sender_name,message) VALUES ('$item_id','$senderName','$message')";
    mysqli_query($conn, $query);

    // Redirect to item details page after sending the message
    header("Location: item_details.php?id=$itemId");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Item Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        
        h2 {
            color: #333;
        }
        
        p {
            margin-bottom: 10px;
        }
        
        ul {
            list-style-type: none;
            padding: 0;
        }
        
        li {
            margin-bottom: 10px;
        }
        
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        
        input[type="text"],
        textarea {
            width: 100%;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
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
    </style>
</head>
<body>
    <h2>Item Details</h2>
    <p><strong>ID:</strong> <?php echo $id; ?></p>
    <p><strong>Name:</strong> <?php echo $name; ?></p>
    <p><strong>Description:</strong> <?php echo $description; ?></p>
    <p><strong>Date of Loss:</strong> <?php echo $dateOfLoss; ?></p>
    <p><strong>Location:</strong> <?php echo $location; ?></p>
    <p><strong>Contact Information:</strong> <?php echo $contactInfo; ?></p>

    <h3>Communication</h3>
    <?php if (mysqli_num_rows($messagesResult) > 0) { ?>
        <ul>
            <?php while ($messageRow = mysqli_fetch_assoc($messagesResult)) { ?>
                <li>
                    <strong><?php echo $messageRow['sender_name']; ?>:</strong> <?php echo $messageRow['message']; ?>
                </li>
            <?php } ?>
        </ul>
    <?php } else { ?>
        <p>No messages found.</p>
    <?php } ?>

    <h4>Send Message</h4>
    <form method="POST" action="">
        <input type="hidden" name="item_id" value="<?php echo $itemId; ?>">
        <label for="sender_name">Your Name:</label>
        <input type="text" name="sender_name" id="sender_name">
        <label for="message">Message:</label>
        <textarea name="message" id="message" rows="4" cols="50"></textarea>
        <input type="submit" name="send_message" value="Send Message">
    </form>

    <a href="list_items.php">Back to List</a>
</body>
</html>
