<?php
// Establish database connection
$db_host = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "lost_item";

$conn = mysqli_connect($db_host, $db_username, $db_password, $db_name);

// Handle form submission
if(isset($_POST['submit'])){
    $category = $_POST['category'];
    $location = $_POST['location'];
    $keyword = $_POST['keyword'];
    
    // Construct the SQL query based on the provided search criteria
    $query = "SELECT * FROM lost_items WHERE 1=1";
    
    if(!empty($category)){
        $query .= " AND category_id = '$category'";
    }
    
    if(!empty($location)){
        $query .= " AND location LIKE '%$location%'";
    }
    
    if(!empty($keyword)){
        $query .= " AND (description LIKE '%$keyword%' OR contact_info LIKE '%$keyword%')";
    }
    
    $result = mysqli_query($conn, $query);
    $items = mysqli_fetch_all($result, MYSQLI_ASSOC);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Search Items</title>
</head>
<body>
    <h2>Search Items</h2>
    <form method="POST" action="">
        <label for="category">Category:</label>
        <select name="category" id="category">
            <option value="">-- All Categories --</option>
            <?php
            // Retrieve item categories
            $query = "SELECT * FROM item_categories";
            $result = mysqli_query($conn, $query);
            $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
            
            foreach($categories as $category){
                echo "<option value='" . $category['id'] . "'>" . $category['name'] . "</option>";
            }
            ?>
        </select><br>
        <label for="location">Location:</label>
        <input type="text" name="location" id="location"><br>
        <label for="keyword">Keyword:</label>
        <input type="text" name="keyword" id="keyword"><br>
        <input type="submit" name="submit" value="Search">
    </form>
    
    <?php if(isset($items)){ ?>
        <h3>Search Results</h3>
        <?php if(empty($items)){ ?>
            <p>No items found.</p>
        <?php } else { ?>
            <table>
                <tr>
                    <th>Description</th>
                    <th>Date of Loss</th>
                    <th>Location</th>
                    <th>Contact Information</th>
                </tr>
                <?php foreach($items as $item){ ?>
                    <tr>
                        <td><?php echo $item['description']; ?></td>
                        <td><?php echo $item['date_of_loss']; ?></td>
                        <td><?php echo $item['location']; ?></td>
                        <td><?php echo $item['contact_info']; ?></td>
                    </tr>
                <?php } ?>
            </table>
        <?php } ?>
    <?php } ?>
</body>
</html>
