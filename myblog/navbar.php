<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet"> <!-- Google Font -->
    <style>
        body {
            font-family: 'Roboto', sans-serif; /* Set font for the entire page */
            margin: 0;
            padding: 0;
            background-color: #f4f4f4; /* Light background for the page */
            font-size: 20px;
        }

        .navbar {
            display: flex; /* Flexbox for horizontal layout */
            justify-content: space-between; /* Space between items */
            align-items: center; /* Center items vertically */
            padding: 1rem 2rem; /* Padding around the navbar */
            color: white; /* Text color */
            background: #bdc3c7;  /* fallback for old browsers */
background: -webkit-linear-gradient(to right, #2c3e50, #bdc3c7);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to right, #2c3e50, #bdc3c7); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

        }

        .navbar a {
            color: white; /* Link color */
            text-decoration: none; /* Remove underline */
            padding: 0.5rem 1rem; /* Padding around links */
            transition: background-color 0.3s; /* Smooth background color transition */
        }

        .navbar a:hover {
            background-color: rgba(255, 255, 255, 0.2); /* Light background on hover */
            border-radius: 5px; /* Rounded corners */
        }
        .navbar-brand{
            font-size: 20px;
        }
        .navbar-brand:hover {
            background-color: rgba(255, 255, 255, 0.2); /* Light background on hover */
            border-radius: 5px; /* Rounded corners */
        }

        @media (max-width: 768px) {
            .navbar {
                flex-direction: column; /* Stack items vertically on small screens */
                align-items: flex-start; /* Align items to the left */
            }

            .navbar a {
                width: 100%; /* Full width links */
                text-align: left; /* Left align text */
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="navbar-brand">My Blog</div>
        <div class="navbar-links">
            <a href="index.php">Home</a>
            <a href="dashboard.php">Create Post</a>
            <a href="register.php">Register</a>
            <a href="login.php">Login</a>
            <a href="logout.php">Logout</a>
        </div>
    </nav>
</body>
</html>