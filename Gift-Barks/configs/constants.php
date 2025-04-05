<?php
// Database connection constants
if (!defined('LOCALHOST')) {
    define('LOCALHOST', 'localhost');
}
if (!defined('DB_USERNAME')) {
    define('DB_USERNAME', 'root');
}
if (!defined('DB_PASSWORD')) {
    define('DB_PASSWORD', '');
}
if (!defined('DB_NAME')) {
    define('DB_NAME', 'giftbarks');
}
define('SITEURL', 'http://localhost/giftbarks/');// Define the base URL of the site
if (!defined('LOCALHOST')) {
    define('LOCALHOST', 'localhost');
}
$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error($conn));// Connect to the database server
$db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error($conn));// Select the database

?>