<?php
// Establish database connection
$db_host = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "lost_item";

$conn = mysqli_connect($db_host, $db_username, $db_password, $db_name);

// Handle form submission
if(isset($_POST['submit'])){
	$id = $_POST['id'];
	$name = $_POST['name'];
	$category = $_POST['category'];
    $itemDescription = $_POST['item_description'];
    $dateOfLoss = $_POST['date_of_loss'];
    $location = $_POST['location'];
    $contactInfo = $_POST['contact_info'];
    
    // Insert lost item data into database
    $query = "INSERT INTO item_categories (id, name, category, description, date_of_loss, location, contact_info) VALUES ('$id','$name','$category','$itemDescription', '$dateOfLoss', '$location', '$contactInfo')";
    mysqli_query($conn, $query);
    
    // Redirect to success page after successful submission
    header("Location: success.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Submit Lost Item</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<style>
body {
    background-color: #f2f2f2;
    font-family: Arial, sans-serif;
}

.container {
    max-width: 500px;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 4px;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
}

h2 {
    text-align: center;
    font-size: 24px;
    margin-bottom: 20px;
}

form {
    margin-bottom: 20px;
}

form input,
form textarea {
    display: block;
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    font-size: 16px;
    border-radius: 4px;
    border: 1px solid #ccc;
}

form input[type="submit"] {
    background-color: #3498db;
    color: #fff;
    border: none;
    cursor: pointer;
}

form input[type="submit"]:hover {
    background-color: #2980b9;
}

p {
    text-align: center;
    font-size: 14px;
}

.success-message {
            color: green;
            margin-top: 20px;
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
}



</style>
<body>
    <div class="container">
        <h2>Submit Lost Item</h2>
        <form method="POST" action="">
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
</select>
            <label for="id">ID: </label>
            <input type="number" name="id" placeholder="ID" required>
			<label for="name">Item Name: </label>
            <input type="text" name="item_name" placeholder="Item Name" required>
			<label for="date_of_loss">Date of Loss:</label>
            <input type="date" name="date_of_loss" id="date_of_loss" required>
			<label for="location">Location:</label>
			<input type="text" name="location" id="location" placeholder="Enter your location" required>
			<label for="address">Description:</label>
            <input type="text" name="description" placeholder="Description" required>
			<label for="address">Contact Info:</label>
			<input type="text" name="contact_info" placeholder="Contact Info" required>
            <textarea name="additional_info" placeholder="Additional Information" rows="4" required></textarea>
            <input type="submit" name="submit" value="Submit">
        </form>
        <p><a href="home.html" class="go-home-link">Go back to home page</a></p>
		<p class="success-message" style="display: none;">Your item has been submitted successfully!</p>
    </div>
</body>
</html>

