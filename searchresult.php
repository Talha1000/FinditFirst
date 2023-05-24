<!DOCTYPE html>
<html>
<head>
    <title>Search Results</title>
    <style>
        .search-results {
            margin-top: 20px;
        }
        .search-results .item {
            padding: 10px;
            border: 1px solid #ccc;
            margin-bottom: 10px;
        }
        .search-results .item h3 {
            margin: 0;
            font-size: 18px;
        }
        .search-results .item p {
            margin: 0;
            color: #888;
        }
    </style>
</head>
<body>
    <h2>Search Results</h2>

    <?php
        if (isset($_POST['search'])) {
            $search = $_POST['search'];

            // Connect to MySQL
            $servername = "localhost";
            $username = "your_username";
            $password = "your_password";
            $dbname = "your_database";

            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Execute the search query
            $sql = "SELECT * FROM items WHERE name LIKE '%$search%'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo '<div class="search-results">';
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="item">';
                    echo '<h3>' . $row['name'] . '</h3>';
                    echo '<p>' . $row['description'] . '</p>';
                    echo '</div>';
                }
                echo '</div>';
            } else {
                echo 'No results found.';
            }

            // Close MySQL connection
            $conn->close();
        }
    ?>

    <form method="POST">
        <input type="text" name="search" placeholder="Search...">
        <input type="submit" value="Search">
    </form>
</body>
</html>
