<?php
// Database connection settings
define('DB_HOST', 'localhost');      // Database host (e.g., localhost)
define('DB_USER', 'root');           // Database username (default is 'root' for local setups)
define('DB_PASS', '');               // Database password (leave empty for default local setups)
define('DB_NAME', 'blog');        // The name of your database

// Establishing the connection
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
