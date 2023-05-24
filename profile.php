<!DOCTYPE html>
<html>
<head>
    <title>FinditFirst - Profile</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <div class="header bg-primary text-white py-4">
            <h1 class="display-4">FinditFirst</h1>
        </div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="home.html">Home</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="submission.php">Report Lost Item</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="search.php">Search Lost Items</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="list_items.php">Manage Lost Items</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="reportitem.php">Report Found Item</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="claim_items.php">Claim Item</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </nav>
        <h1 class="display-4 mt-4">Profile</h1>
        
        <?php
        session_start();

        // Database connection
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "lost_item";
        
        $conn = mysqli_connect($servername, $username, $password, $database);
        
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        
        // Check if user is logged in
        if (!isset($_SESSION['user_id'])) {
            echo "Please login to view your profile.";
        } else {
            // Retrieve user information from the database
            $userId = $_SESSION['user_id'];
            $query = "SELECT * FROM user WHERE id = $userId";
            $result = mysqli_query($conn, $query);
            
            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $Name = $row['username'];
                $email = $row['email'];
                
                // Display user information
                echo "<h2>Welcome, $Name</h2>";
                echo "<p>Email: $email</p>";
            } else {
                echo "Failed to retrieve user information.";
            }
        }
        
        mysqli_close($conn);
        ?>

        <div class="footer bg-dark text-white py-3 mt-4">
            <p class="m-0">&copy; <?php echo date("Y"); ?> FinditFirst. All rights reserved. | <a href="privacy_policy.php" class="text-white">Privacy Policy</a> | <a href="#" class="text-white">Terms of Service</a></p>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
