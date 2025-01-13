<?php
require_once '../src/config/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    session_start(); // Start the session

    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            // Set session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['plan'] = $user['plan'];
            session_write_close();

            // Redirect to the homepage
            header("Location: /");
            exit(); // Ensure the script stops here
        } else {
            // Invalid credentials
            echo "Invalid username or password.";
        }
    } catch (PDOException $e) {
        // Log the error instead of showing it to the user
        error_log("Database error: " . $e->getMessage());
        echo "An error occurred. Please try again later.";
    }
} else {
    echo "Invalid request method.";
}
?>
