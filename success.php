<!DOCTYPE html>
<html>
<head>
    <title>Success Page</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <style>
        body {
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 40px;
            text-align: center;
            background-color: #fff;
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .success-icon {
            font-size: 64px;
            color: #4CAF50;
            margin-bottom: 20px;
        }

        .success-message {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .go-home-link {
            color: #2196F3;
            text-decoration: none;
        }
		
		.go-submission-link {
            color: #2196F3;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <span class="success-icon">&#10004;</span>
        <h2 class="success-message">Success!</h2>
        <p>Your action has been completed successfully.</p>
        <p><a href="home.html" class="go-home-link">Go back to home page</a></p>
		<p><a href="submission.php" class="go-submission-link">Submit another lost item</a></p>
    </div>
</body>
</html>
