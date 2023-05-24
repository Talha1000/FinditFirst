<?php
// Establish database connection
$db_host = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "lost_item";

$conn = mysqli_connect($db_host, $db_username, $db_password, $db_name);

// Handle form submission
if(isset($_POST['update'])){
    $itemId = $_POST['item_id'];
    $status = $_POST['status'];
    
    // Update item status in the database
    $query = "UPDATE lost_items SET status='$status' WHERE id='$itemId'";
    mysqli_query($conn, $query);
    
    // Redirect to item details page after status update
    header("Location: item_details.php?id=$itemId");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Item Status</title>
</head>
<body>
    <h2>Update Item Status</h2>
    <?php if(isset($_GET['id'])){
        $itemId = $_GET['id'];
        $query = "SELECT * FROM lost_items WHERE id = '$itemId'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        
        if($row){ ?>
            <p><strong>Description:</strong> <?php echo $row['description']; ?></p>
            <p><strong>Date of Loss:</strong> <?php echo $row['date_of_loss']; ?></p>
            <p><strong>Location:</strong> <?php echo $row['location']; ?></p>
            <p><strong>Contact Information:</strong> <?php echo $row['contact_info']; ?></p>
            
            <form method="POST" action="">
                <input type="hidden" name="item_id" value="<?php echo $itemId; ?>">
                <label for="status">Status:</label>
                <select name="status" id="status">
                    <option value="lost" <?php if($row['status'] == 'lost') echo 'selected'; ?>>Lost</option>
                    <option value="found" <?php if($row['status'] == 'found') echo 'selected'; ?>>Found</option>
                    <option value="claimed" <?php if($row['status'] == 'claimed') echo 'selected'; ?>>Claimed</option>
                </select>
                <input type="submit" name="update" value="Update">
            </form>
        <?php } else {
            // Item not found
            echo "<p>Item not found.</p>";
        }
    } else {
        // No item ID specified
        echo "<p>No item specified.</p>";
    }
    ?>
</body>
</html>
