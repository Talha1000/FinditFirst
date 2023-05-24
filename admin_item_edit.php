<?php
// Check if the admin is logged in
// Implement your authentication logic here
// ...

// Include database connection
require_once 'adminlogin.php';

// Check if item ID is provided
if (isset($_GET['id'])) {
    $itemId = $_GET['id'];

    // Fetch item details from the database
    $query = "SELECT * FROM items WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $itemId);
    $stmt->execute();
    $item = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($item) {
        // Item found, display the form for editing
        ?>

        <!DOCTYPE html>
        <html>
        <head>
            <title>Edit Item</title>
            <link rel="stylesheet" type="text/css" href="styles.css">
        </head>
        <body>
            <div class="container">
                <h1>Edit Item</h1>

                <form action="admin_update_item.php" method="post">
                    <input type="hidden" name="item_id" value="<?php echo $item['id']; ?>">

                    <label for="category">Category:</label>
                    <input type="text" name="category" id="category" value="<?php echo $item['category']; ?>" required>

                    <label for="description">Description:</label>
                    <textarea name="description" id="description" required><?php echo $item['description']; ?></textarea>

                    <label for="lost_date">Lost Date:</label>
                    <input type="date" name="lost_date" id="lost_date" value="<?php echo $item['lost_date']; ?>" required>

                    <label for="location">Location:</label>
                    <input type="text" name="location" id="location" value="<?php echo $item['location']; ?>" required>

                    <label for="contact_name">Contact Name:</label>
                    <input type="text" name="contact_name" id="contact_name" value="<?php echo $item['contact_name']; ?>" required>

                    <label for="contact_email">Contact Email:</label>
                    <input type="email" name="contact_email" id="contact_email" value="<?php echo $item['contact_email']; ?>" required>

                    <label for="contact_phone">Contact Phone:</label>
                    <input type="tel" name="contact_phone" id="contact_phone" value="<?php echo $item['contact_phone']; ?>" required>

                    <input type="submit" value="Update" class="button">
                </form>
            </div>
        </body>
        </html>

        <?php
    } else {
        // Item not found
        echo "Item not found.";
    }
} else {
    // Item ID not provided
    echo "Item ID not provided.";
}
?>
