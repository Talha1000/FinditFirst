<!DOCTYPE html>
<html>
<head>
    <title>Lost Item Management System</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Welcome to the Lost Item Management System</h1>
        <p>Report lost items, search for items, and connect with finders.</p>
        
        <div class="buttons">
            <a href="login.php" class="button">Login</a>
            <a href="register.php" class="button">Register</a>
        </div>
        
        <div class="options">
            <h2>What would you like to do?</h2>
            <ul>
                <li>
                    <a href="submit_item.php" class="option-card">
                        <img src="report-lost-item-icon.png" alt="Report Lost Item">
                        <span>Report a Lost Item</span>
                    </a>
                </li>
                <li>
                    <a href="search_items.php" class="option-card">
                        <img src="search-items-icon.png" alt="Search Lost Items">
                        <span>Search for Lost Items</span>
                    </a>
                </li>
                <li>
                    <a href="my_items.php" class="option-card">
                        <img src="manage-lost-items-icon.png" alt="Manage Lost Items">
                        <span>Manage My Lost Items</span>
                    </a>
                </li>
                <li>
                    <a href="found_items.php" class="option-card">
                        <img src="report-found-item-icon.png" alt="Report Found Item">
                        <span>Report a Found Item</span>
                    </a>
                </li>
                <li>
                    <a href="my_found_items.php" class="option-card">
                        <img src="manage-found-items-icon.png" alt="Manage Found Items">
                        <span>Manage My Found Items</span>
                    </a>
                </li>
                <li>
                    <a href="profile.php" class="option-card">
                        <img src="manage-profile-icon.png" alt="Manage Profile">
                        <span>Manage My Profile</span>
                    </a>
                </li>
                <li>
                    <a href="admin.php" class="option-card">
                        <img src="admin-panel-icon.png" alt="Admin Panel">
                        <span>Admin Panel</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</body>
</html>
