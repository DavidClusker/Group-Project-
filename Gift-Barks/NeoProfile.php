<?php
session_start();

if (isset($_SESSION['username'])) {
    echo $_SESSION['username']; // Output the username
} else {
    echo "Guest"; // Fallback if no username is set or for an  admin
}
?>