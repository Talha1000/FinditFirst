<?php
// Establish database connection
$db_host = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "lost_item";

$conn = mysqli_connect($db_host, $db_username, $db_password, $db_name);

// Retrieve list of lost items
$query = "SELECT * FROM item_categories";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>List of Lost Items</title>
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

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin-bottom: 20px;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        li strong {
            font-size: 18px;
        }

        li span {
            display: block;
            margin-top: 10px;
            color: #888;
        }

        li a {
            text-decoration: none;
            color: #3498db;
        }

        li a:hover {
            text-decoration: underline;
        }

        .no-items {
            text-align: center;
            color: #888;
            margin-top: 40px;
        }

        .back-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #e74c3c;
            color: #fff;
            text-decoration: none;
            font-size: 16px;
            border-radius: 4px;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }

        .back-button:hover {
            background-color: #c0392b;
        }
		
		.go-home-link {
            color: #2196F3;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>List of Lost Items</h2>
        <?php if(mysqli_num_rows($result) > 0){ ?>
            <ul>
                <?php while($row = mysqli_fetch_assoc($result)){ ?>
                    <li>
                        <strong><?php echo $row['description']; ?></strong>
                        <span>Date of Loss: <?php echo $row['date_of_loss']; ?></span>
                        <span>Location: <?php echo $row['location']; ?></span>
                        <a href="item_details.php?id=<?php echo $row['id']; ?>">View Details</a>
                    </li>
                <?php } ?>
            </ul>
        <?php } else { ?>
            <p class="no-items">No lost items found.</p>
        <?php } ?>
		<p><a href="home.html" class="go-home-link">Go back to home page</a></p>
        <a href="home.html" class="back-button">Back</a>
    </div>
</body>
</html>

