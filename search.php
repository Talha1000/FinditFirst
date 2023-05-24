<?php
// Establish database connection
$db_host = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "lost_item";

$conn = mysqli_connect($db_host, $db_username, $db_password, $db_name);

// Handle form submission
if(isset($_GET['search'])){
    $category = $_GET['category'];
    $name = $_GET['name'];
    $location = $_GET['location'];
    $startDate = $_GET['start_date'];
    $endDate = $_GET['end_date'];
    $keywords = $_GET['keywords'];

    // Construct the search query
    $query = "SELECT * FROM item_categories WHERE 1=1";

    // Get the column names dynamically
    $result = mysqli_query($conn, "DESCRIBE item_categories");
    $columns = array();

    while($row = mysqli_fetch_assoc($result)){
        $columns[] = $row['Field'];
    }

    if(in_array('name', $columns) && !empty($name)){
        $query .= " AND name='$name'";
    }

    if(!empty($category)){
        $query .= " AND category='$category'";
    }
    if(!empty($location)){
        $query .= " AND location='$location'";
    }
    if(!empty($startDate) && !empty($endDate)){
        $query .= " AND date_of_loss BETWEEN '$startDate' AND '$endDate'";
    }
    if(!empty($keywords)){
        $query .= " AND (description LIKE '%$keywords%' OR contact_info LIKE '%$keywords%')";
    }
    
    // Execute the search query
    $result = mysqli_query($conn, $query);
	
	header("Location: list_items.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Item Search</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <style>
        body {
    font-family: 'Helvetica Neue', Arial, sans-serif;
    background-color: #080B1A;
    margin: 0;
    padding: 20px;
    color: #fff;
}

.container {
    max-width: 800px;
    margin: 0 auto;
    background-color: #1A2233;
    padding: 40px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

h2 {
    font-size: 32px;
    margin-bottom: 20px;
    color: #2196F3;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
}

form {
    margin-bottom: 20px;
    text-align: center;
}

input[type="text"],
input[type="date"],
input[type="submit"] {
    width: 300px;
    padding: 12px;
    border-radius: 4px;
    border: none;
    font-size: 16px;
    margin-bottom: 10px;
    box-sizing: border-box;
    background-color: #f9f9f9;
    border: 2px solid #3498db;
    color: #333;
}

input[type="text"]:focus,
input[type="date"]:focus {
    outline: none;
    border-color: #2980b9;
}

input[type="submit"] {
    background-color: #3498db;
    color: #fff;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

input[type="submit"]:hover {
    background-color: #BF2C34;
}

.no-results {
    text-align: center;
    color: #999;
    font-style: italic;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    background-color: #fff;
    color: #333;
}

th,
td {
    padding: 10px;
    text-align: left;
    border-bottom: 1px solid #ccc;
}

th {
    background-color: #f4f4f4;
    font-weight: bold;
}

tr:nth-child(even) {
    background-color: #f9f9f9;
}

.go-home-link {
    color: #2196F3;
    text-decoration: none;
}

label {
    display: block;
    margin-bottom: 10px;
    font-weight: bold;
}

select {
    width: 25%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
    background-color: #f9f9f9;
    color: #333;
}



    </style>
</head>
<body>
    <div class="container">
        <h2>Item Search</h2>
        <form method="GET" action="">
            <label for="category">Category:</label>
            <select name="category" id="category">
                 <option value="electronics">Electronics</option>
    <option value="jewelry">Jewelry</option>
    <option value="clothing">Clothing</option>
    <option value="documents">Documents</option>
    <option value="books">Books</option>
    <option value="toys">Toys</option>
    <option value="sports">Sports Equipment</option>
    <option value="musical-instruments">Musical Instruments</option>
    <option value="art">Art Supplies</option>
    <option value="furniture">Furniture</option>
    <option value="vehicles">Vehicles</option>
    <option value="accessories">Accessories</option>
    <option value="tools">Tools</option>
    <option value="pets">Pets</option>
    <option value="cosmetics">Cosmetics</option>
    <option value="household">Household Items</option>
    <option value="kitchenware">Kitchenware</option>
    <option value="plants">Plants</option>
    <option value="outdoor">Outdoor Equipment</option>
    <option value="collectibles">Collectibles</option>
    <option value="antiques">Antiques</option>
    <option value="cameras">Cameras</option>
    <option value="phones">Phones</option>
    <option value="computers">Computers</option>
    <option value="tablets">Tablets</option>
    <option value="video-games">Video Games</option>
    <option value="movies">Movies</option>
    <option value="music">Music</option>
    <option value="watches">Watches</option>
    <option value="bags">Bags</option>
    <option value="shoes">Shoes</option>
    <option value="accessories">Accessories</option>
    <option value="baby-items">Baby Items</option>
    <option value="office-supplies">Office Supplies</option>
    <option value="travel">Travel Accessories</option>
    <option value="garden">Gardening Tools</option>
    <option value="fitness">Fitness Equipment</option>
    <option value="health">Health Products</option>
    <option value="food">Food and Beverages</option>
    <option value="beverages">Beverages</option>
    <option value="hobbies">Hobbies</option>
    <option value="instruments">Instruments</option>
    <option value="costumes">Costumes</option>
    <option value="party">Party Supplies</option>
    <option value="stationery">Stationery</option>
    <option value="crafts">Craft Supplies</option>
    <option value="gifts">Gifts</option>
    <option value="journals">Journals</option>
    <option value="magazines">Magazines</option>
    <option value="home-decor">Home Decor</option>
            </select><br>
			<label for="name">Name:</label>
            <input type="text" name="name" id="name" placeholder="Name"><br>
            <label for="location">Location:</label>
            <input type="text" name="location" id="location" placeholder="Location"><br>
            <label for="start_date">Start Date:</label>
            <input type="date" name="start_date" id="start_date">
            <label for="end_date">End Date:</label>
            <input type="date" name="end_date" id="end_date"><br>
            <label for="keywords">Keywords:</label>
            <input type="text" name="keywords" id="keywords" placeholder="Keywords"><br>
            <input type="submit" name="search" value="Search">
        </form>

        <?php if(isset($result)){ ?>
            <h3>Search Results</h3>
            <?php if(mysqli_num_rows($result) > 0){ ?>
                <table>
                    <tr>
                        <th>Item Description</th>
                        <th>Date of Loss</th>
                        <th>Location</th>
                        <th>Contact Info</th>
                    </tr>
                    <?php while($row = mysqli_fetch_assoc($result)){ ?>
                        <tr>
                            <td><?php echo $row['description']; ?></td>
                            <td><?php echo $row['date_of_loss']; ?></td>
                            <td><?php echo $row['location']; ?></td>
                            <td><?php echo $row['contact_info']; ?></td>
                        </tr>
                    <?php } ?>
                </table>
            <?php } else { ?>
                <p class="no-results">No results found.</p>
            <?php } ?>
        <?php } ?>
		<p><a href="home.html" class="go-home-link">Go back to the home page</a></p>
    </div>
	<script>
        // JavaScript code here
        window.addEventListener('DOMContentLoaded', function() {
            const searchForm = document.getElementById('searchForm');
            const searchResults = document.getElementById('searchResults');

            searchForm.addEventListener('submit', function(event) {
                event.preventDefault();
                searchResults.innerHTML = '<p>Loading...</p>';

                // Simulate AJAX request (replace with your actual AJAX code)
                setTimeout(function() {
                    // Simulated search results
                    const results = [
                        { description: 'Item 1', date_of_loss: '2023-05-21', location: 'Location 1', contact_info: 'Contact 1' },
                        { description: 'Item 2', date_of_loss: '2023-05-22', location: 'Location 2', contact_info: 'Contact 2' }
                    ];

                    let html = '<h3>Search Results</h3>';
                    if (results.length > 0) {
                        html += '<table>';
                        html += '<tr><th>Item Description</th><th>Date of Loss</th><th>Location</th><th>Contact Info</th></tr>';

                        results.forEach(function(result) {
                            html += '<tr>';
                            html += '<td>' + result.description + '</td>';
                            html += '<td>' + result.date_of_loss + '</td>';
                            html += '<td>' + result.location + '</td>';
                            html += '<td>' + result.contact_info + '</td>';
                            html += '</tr>';
                        });

                        html += '</table>';
                    } else {
                        html += '<p class="no-results">No results found.</p>';
                    }

                    searchResults.innerHTML = html;
                }, 1500); // Simulate delay for demonstration purposes
            });
        });
    </script>
</body>
</html>



