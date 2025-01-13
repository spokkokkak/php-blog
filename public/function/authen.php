<?php
    session_start();

    if (isset($_SESSION['user_id'])) {
        // Display user information
        echo "<p class='text-center'> Hi, " . htmlspecialchars($_SESSION['username']) . " your member feature is: " . htmlspecialchars($_SESSION['plan']);
        echo ' |  <a href="function/logout.php">Logout</a>';
        echo '</p>';
    } else {
        // Redirect to login page if not logged in
        // header("Location: login.php");
        // exit;
    }

    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    } 
?>