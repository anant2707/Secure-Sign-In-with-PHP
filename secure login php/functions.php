<?php
require_once 'config.php';

// Function to sanitize input to prevent XSS
function sanitize_input($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

// Function to register a new user
function register_user($username, $password) {
    global $mysqli;

    $username = sanitize_input($username);

    // Prepare a select statement
    $sql = "SELECT id FROM users WHERE username = ?";

    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("s", $param_username);
        $param_username = $username;

        // Execute the statement
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows == 1) {
            return "This username is already taken.";
        } else {
            // Prepare an insert statement
            $sql = "INSERT INTO users (username, password) VALUES (?, ?)";

            if ($stmt = $mysqli->prepare($sql)) {
                $stmt->bind_param("ss", $param_username, $param_password);
                $param_username = $username;
                $param_password = password_hash($password, PASSWORD_DEFAULT); // Create a password hash

                if ($stmt->execute()) {
                    return true;
                } else {
                    return "Something went wrong. Please try again later.";
                }
            }
        }

        // Close statement
        $stmt->close();
    }

    return "Something went wrong. Please try again later.";
}

// Function to log in a user
function login_user($username, $password) {
    global $mysqli;

    $username = sanitize_input($username);

    // Prepare a select statement
    $sql = "SELECT id, username, password FROM users WHERE username = ?";

    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("s", $param_username);
        $param_username = $username;

        // Execute the statement
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows == 1) {
            $stmt->bind_result($id, $username, $hashed_password);
            $stmt->fetch();

            if (password_verify($password, $hashed_password)) {
                session_start();
                $_SESSION['id'] = $id;
                $_SESSION['username'] = $username;
                return true;
            } else {
                return "The password you entered was not valid.";
            }
        } else {
            return "No account found with that username.";
        }

        // Close statement
        $stmt->close();
    }

    return "Something went wrong. Please try again later.";
}
?>
