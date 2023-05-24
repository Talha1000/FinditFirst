<!DOCTYPE html>
<html>
<head>
    <title>My Profile</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>

body {
    font-family: Arial, sans-serif;
    background-color: #f2f2f2;
    margin: 0;
    padding: 20px;
}

.container {
    max-width: 800px;
    margin: 0 auto;
    background-color: #fff;
    padding: 40px;
    border-radius: 4px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

h1 {
    font-size: 32px;
    margin-bottom: 20px;
}

.profile-card {
    background-color: #f5f5f5;
    padding: 20px;
    border-radius: 4px;
}

h2 {
    font-size: 24px;
    margin-bottom: 10px;
}

p {
    font-size: 16px;
    margin-bottom: 8px;
}
</style>
<body>
    <div class="container">
        <h1>My Profile</h1>

        <?php
        // Include your database connection code here

        // Assuming you have fetched the user's profile data from the database
        $userProfile = [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'age' => 30,
            'bio' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            // Add more profile data as needed
        ];
        ?>

        <div class="profile-card">
            <h2><?php echo $userProfile['name']; ?></h2>
            <p>Email: <?php echo $userProfile['email']; ?></p>
            <p>Age: <?php echo $userProfile['age']; ?></p>
            <p>Bio: <?php echo $userProfile['bio']; ?></p>
            <!-- Add more profile information here -->
        </div>
    </div>
</body>
</html>
