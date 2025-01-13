<?php
        session_start();
        require_once '../src/config/database.php';
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
            $username = $_POST['username'];
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

            $stmt = $conn->prepare("INSERT INTO users (username, password, email) VALUES (:username, :password, :email)");
            $stmt->bindParam(":username",$username);
            $stmt->bindParam(":password",$password);
            $stmt->bindParam(":email",$_POST['email']);

            if ($stmt->execute()) {
                $_SESSION['user_id'] = $conn->lastInsertId();
                
                $sql_get = "SELECT * FROM users WHERE id = " . $_SESSION['user_id'];
                $result = $conn->query($sql_get);
                $user = $result->fetch(PDO::FETCH_ASSOC);

                $_SESSION['username'] = $user['username'];
                $_SESSION['plan'] = $user['plan'];
                // session_write_close();
    
                header("Location: /");
                // echo "Your user ID is: " .$_SESSION['user_id'];
                // echo "<br/>";
                // echo "Your username is: " .$_SESSION['username'];
                // echo "<br/>";
                // echo "Your plan is: " .$_SESSION['plan'];
                // echo "Registration successful. <a href='/'>HOME</a>";
            } else {
                echo "Error: " . $conn->error;
            }
        }
  ?>