<?php
// Establish database connection
$db_host = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "lost_item";

$conn = mysqli_connect($db_host, $db_username, $db_password, $db_name);

// Retrieve the total number of reported items
$query = "SELECT COUNT(*) AS total_items FROM lost_items";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$totalItems = $row['total_items'];

// Retrieve the number of items per category
$query = "SELECT ic.name AS category_name, COUNT(*) AS item_count 
          FROM lost_items li
          INNER JOIN item_categories ic ON li.category_id = ic.id
          GROUP BY li.category_id";
$result = mysqli_query($conn, $query);
$categories = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Retrieve the trend of reported items over time (monthly)
$query = "SELECT DATE_FORMAT(date_of_loss, '%Y-%m') AS month, COUNT(*) AS item_count
          FROM lost_items
          GROUP BY DATE_FORMAT(date_of_loss, '%Y-%m')
          ORDER BY month ASC";
$result = mysqli_query($conn, $query);
$trends = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reports and Statistics</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 800px;
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

        h3 {
            font-size: 24px;
            margin-bottom: 15px;
            color: #333;
        }

        p {
            margin-bottom: 10px;
        }

        ul {
            list-style-type: none;
            padding: 0;
            margin-bottom: 15px;
        }

        li {
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ccc;
        }

        th {
            background-color: #f9f9f9;
            font-weight: bold;
        }

        .no-items {
            color: #888;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Reports and Statistics</h2>
        
        <h3>Total Reported Items: <?php echo $totalItems; ?></h3>
        
        <h3>Items by Category:</h3>
        <?php if(empty($categories)){ ?>
            <p class="no-items">No items found.</p>
        <?php } else { ?>
            <ul>
                <?php foreach($categories as $category){ ?>
                    <li><?php echo $category['category_name']; ?>: <?php echo $category['item_count']; ?> items</li>
                <?php } ?>
            </ul>
        <?php } ?>
        
        <h3>Trend of Reported Items:</h3>
        <?php if(empty($trends)){ ?>
            <p class="no-items">No items found.</p>
        <?php } else { ?>
            <table>
                <tr>
                    <th>Month</th>
                    <th>Item Count</th>
                </tr>
                <?php foreach($trends as $trend){ ?>
                    <tr>
                        <td><?php echo $trend['month']; ?></td>
                        <td><?php echo $trend['item_count']; ?></td>
                    </tr>
                <?php } ?>
            </table>
        <?php } ?>
    </div>
</body>
</html>

